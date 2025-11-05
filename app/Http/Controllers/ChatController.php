<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use App\Events\UserTyping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ChatController extends Controller
{
    /**
     * Get all conversations for the authenticated user
     */
    public function getConversations(): JsonResponse
    {
        $user = Auth::user();
        
        $conversations = Conversation::with(['latestMessage', 'user', 'admin'])
            ->where(function ($query) use ($user) {
                if ($user->usertype === 'admin') {
                    $query->forAdmin($user->id);
                } else {
                    $query->forUser($user->id);
                }
            })
            ->active()
            ->orderBy('last_message_at', 'desc')
            ->get()
            ->map(function ($conversation) use ($user) {
                return [
                    'id' => $conversation->id,
                    'title' => $conversation->title,
                    'type' => $conversation->type,
                    'status' => $conversation->status,
                    'last_message_at' => $conversation->last_message_at,
                    'unread_count' => $conversation->getUnreadCountForUser($user->id),
                    'latest_message' => $conversation->latestMessage ? [
                        'id' => $conversation->latestMessage->id,
                        'content' => $conversation->latestMessage->content,
                        'message_type' => $conversation->latestMessage->message_type,
                        'created_at' => $conversation->latestMessage->created_at,
                        'sender' => [
                            'id' => $conversation->latestMessage->sender->id,
                            'name' => $conversation->latestMessage->sender->name,
                        ]
                    ] : null,
                    'participant' => $user->usertype === 'admin' 
                        ? ($conversation->user ? [
                            'id' => $conversation->user->id,
                            'name' => $conversation->user->name,
                            'email' => $conversation->user->email,
                        ] : null)
                        : ($conversation->admin ? [
                            'id' => $conversation->admin->id,
                            'name' => $conversation->admin->name,
                            'email' => $conversation->admin->email,
                        ] : null)
                ];
            });

        return response()->json([
            'conversations' => $conversations
        ]);
    }

    /**
     * Get messages for a specific conversation
     */
    public function getMessages(Request $request, $conversationId): JsonResponse
    {
        $user = Auth::user();
        
        $conversation = Conversation::with(['user', 'admin'])->findOrFail($conversationId);
        
        // Check if user has access to this conversation
        if ($user->usertype === 'admin' && $conversation->admin_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        if ($user->usertype !== 'admin' && $conversation->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $page = $request->get('page', 1);
        $perPage = $request->get('per_page', 50);

        $messages = Message::with(['sender', 'replyToMessage.sender'])
            ->where('conversation_id', $conversationId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Mark messages as read for the current user
        $conversation->markAsReadForUser($user->id);

        return response()->json([
            'messages' => $messages->items(),
            'pagination' => [
                'current_page' => $messages->currentPage(),
                'last_page' => $messages->lastPage(),
                'per_page' => $messages->perPage(),
                'total' => $messages->total(),
                'has_more' => $messages->hasMorePages()
            ]
        ]);
    }

    /**
     * Send a new message
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'content' => 'required_without:attachment|string|max:10000',
            'message_type' => 'in:text,image,file,system',
            'reply_to_message_id' => 'nullable|exists:messages,id',
            'attachment' => 'nullable|file|max:10240' // 10MB max
        ]);

        $user = Auth::user();
        $conversationId = $request->conversation_id;
        
        // Verify user has access to this conversation
        $conversation = Conversation::findOrFail($conversationId);
        if ($conversation->user_id !== $user->id && $conversation->admin_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Handle file attachment
        $attachmentPath = null;
        $messageType = $request->message_type ?? 'text';
        
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentPath = $file->store('chat-attachments', 'public');
            
            // Determine message type based on file
            $mimeType = $file->getMimeType();
            if (str_starts_with($mimeType, 'image/')) {
                $messageType = 'image';
            } else {
                $messageType = 'file';
            }
        }

        // Create the message
        $message = Message::create([
            'user_id' => $user->id, // maintain compatibility with legacy schema
            'conversation_id' => $conversationId,
            'sender_type' => ($user->usertype === 'admin') ? 'admin' : 'user',
            'sender_id' => $user->id,
            'message' => $request->content ?? '',
            'message_type' => $messageType,
            'reply_to_message_id' => $request->reply_to_message_id,
            'delivery_status' => 'sent'
        ]);

        // Persist attachment record if present
        if ($attachmentPath) {
            $message->attachments()->create([
                'original_name' => $file->getClientOriginalName(),
                'file_name' => basename($attachmentPath),
                'file_path' => $attachmentPath,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        // Update conversation's last message timestamp
        $conversation->update([
            'last_message_at' => now()
        ]);

        // Load relationships for response
        $message->load(['sender', 'replyToMessage.sender', 'attachments']);

        // No broadcasting in polling-only mode

        return response()->json([
            'message' => $message,
            'conversation_id' => $conversationId
        ], 201);
    }

    /**
     * Start or get a conversation with a specific user
     */
    public function startConversation(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

        // For admins, recipient is required (a user). For customers, pick an available admin if not provided.
        if ($user->usertype === 'admin') {
            $request->validate([
                'recipient_id' => 'required|exists:users,id'
            ]);
            $recipientId = $request->recipient_id;
            $recipient = User::findOrFail($recipientId);
        } else {
            $recipientId = $request->input('recipient_id');
            if (!$recipientId) {
                $recipient = User::where('usertype', 'admin')->firstOrFail();
                $recipientId = $recipient->id;
            } else {
                $recipient = User::findOrFail($recipientId);
            }
        }

        // Check if conversation already exists
        $conversation = Conversation::where(function ($query) use ($user, $recipient) {
            $query->where('user_id', $user->id)->where('admin_id', $recipient->id);
        })->orWhere(function ($query) use ($user, $recipient) {
            $query->where('user_id', $recipient->id)->where('admin_id', $user->id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'title' => $user->usertype === 'admin' 
                    ? "Chat with {$recipient->name}" 
                    : "Support Chat",
                'type' => 'support',
                'status' => 'active',
                'user_id' => $user->usertype === 'admin' ? $recipient->id : $user->id,
                'admin_id' => $user->usertype === 'admin' ? $user->id : $recipient->id,
                'participants' => [$user->id, $recipient->id],
                'last_message_at' => now()
            ]);

            // If an initial message was provided, create it.
            if ($request->filled('content')) {
                $message = Message::create([
                    'user_id' => $user->id,
                    'conversation_id' => $conversation->id,
                    'sender_type' => ($user->usertype === 'admin') ? 'admin' : 'user',
                    'sender_id' => $user->id,
                    'message' => $request->input('content'),
                    'message_type' => 'text',
                    'delivery_status' => 'sent'
                ]);
                $message->load(['sender']);
            }
        }

            $conversation->load(['user', 'admin', 'latestMessage']);

            return response()->json([
                'conversation' => $conversation
            ]);
        } catch (\Throwable $e) {
            \Log::error('Failed to start conversation', [
                'user_id' => Auth::id(),
                'request' => $request->all(),
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'Failed to start conversation'], 500);
        }
    }

    /**
     * Handle typing indicator
     */
    public function typing(Request $request): JsonResponse
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'is_typing' => 'required|boolean'
        ]);

        $user = Auth::user();
        $conversationId = $request->conversation_id;
        
        // Verify user has access to this conversation
        $conversation = Conversation::findOrFail($conversationId);
        
        if ($user->usertype === 'admin' && $conversation->admin_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        if ($user->usertype !== 'admin' && $conversation->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Broadcast typing indicator
        broadcast(new UserTyping($user, $conversationId, $request->is_typing))->toOthers();

        return response()->json(['status' => 'success']);
    }

    /**
     * Add reaction to a message
     */
    public function addReaction(Request $request, $messageId): JsonResponse
    {
        $request->validate([
            'emoji' => 'required|string|max:10'
        ]);

        $user = Auth::user();
        $message = Message::findOrFail($messageId);
        
        // Verify user has access to this message's conversation
        $conversation = $message->conversation;
        
        if ($user->usertype === 'admin' && $conversation->admin_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        if ($user->usertype !== 'admin' && $conversation->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->addReaction($request->emoji, $user->id);

        return response()->json([
            'message' => $message->fresh(),
            'reactions' => $message->reactions
        ]);
    }

    /**
     * Remove reaction from a message
     */
    public function removeReaction(Request $request, $messageId): JsonResponse
    {
        $request->validate([
            'emoji' => 'required|string|max:10'
        ]);

        $user = Auth::user();
        $message = Message::findOrFail($messageId);
        
        // Verify user has access to this message's conversation
        $conversation = $message->conversation;
        
        if ($user->usertype === 'admin' && $conversation->admin_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        if ($user->usertype !== 'admin' && $conversation->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->removeReaction($request->emoji, $user->id);

        return response()->json([
            'message' => $message->fresh(),
            'reactions' => $message->reactions
        ]);
    }
}
