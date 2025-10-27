<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of all messages.
     */
    public function index(Request $request)
    {
        $query = Message::with(['user', 'admin']);
        
        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Apply user search filter
        if ($request->filled('user_search')) {
            $userSearch = $request->get('user_search');
            $query->whereHas('user', function ($userQuery) use ($userSearch) {
                $userQuery->where('name', 'like', "%{$userSearch}%")
                         ->orWhere('email', 'like', "%{$userSearch}%");
            });
        }

        // Apply date range filters
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->get('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->get('date_to'));
        }

        // Apply priority filter (if you have a priority column)
        if ($request->filled('priority')) {
            $query->where('priority', $request->get('priority'));
        }

        // Apply has reply filter
        if ($request->filled('has_reply')) {
            $hasReply = $request->get('has_reply');
            if ($hasReply === 'yes') {
                $query->whereNotNull('reply');
            } elseif ($hasReply === 'no') {
                $query->whereNull('reply');
            }
        }

        // Apply replied by filter
        if ($request->filled('replied_by')) {
            $query->where('replied_by', $request->get('replied_by'));
        }
        
        // Apply status filter
        if ($request->filled('status')) {
            $status = $request->get('status');
            $query->when($status === 'pending', fn($q) => $q->pending())
                  ->when($status === 'replied', fn($q) => $q->replied())
                  ->when($status === 'closed', fn($q) => $q->closed());
        }
        
        // Apply sorting
        $sort = $request->get('sort', 'newest');
        $sortColumn = $request->get('sort_column', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sortColumn && $sortDirection) {
            $query->orderBy($sortColumn, $sortDirection);
        } else {
            $query->latest();
        }

        // Handle export
        if ($request->filled('export') && $request->get('export') === 'csv') {
            return $this->exportMessages($query);
        }
        
        $messages = $query->paginate(15)->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for composing a new message.
     */
    public function compose()
    {
        $users = User::where('usertype', 'user')->orderBy('name')->get();
        return view('admin.messages.compose', compact('users'));
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|max:10240|mimes:pdf,doc,docx,txt,jpg,jpeg,png,gif,zip,rar',
        ]);

        // Create the message
        $message = Message::create([
            'user_id' => $validated['user_id'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => Message::STATUS_PENDING,
        ]);

        // Handle file attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('message_attachments', $fileName, 'public');

                MessageAttachment::create([
                    'message_id' => $message->id,
                    'original_name' => $originalName,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        return redirect()
            ->route('admin.messages.show', $message)
            ->with('success', 'Message sent successfully.');
    }

    /**
     * Export messages to CSV.
     */
    private function exportMessages($query)
    {
        $messages = $query->get();
        
        $filename = 'messages_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($messages) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID', 'User Name', 'User Email', 'Subject', 'Message', 
                'Status', 'Reply', 'Replied By', 'Created At', 'Replied At'
            ]);
            
            // CSV data
            foreach ($messages as $message) {
                fputcsv($file, [
                    $message->id,
                    $message->user->name,
                    $message->user->email,
                    $message->subject,
                    $message->message,
                    $message->status,
                    $message->reply,
                    $message->admin ? $message->admin->name : '',
                    $message->created_at->format('Y-m-d H:i:s'),
                    $message->replied_at ? $message->replied_at->format('Y-m-d H:i:s') : '',
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        $message->load(['user', 'admin']);
        
        // Mark message as read if it hasn't been read yet
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Reply to the specified message.
     */
    public function reply(Request $request, Message $message)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $message->update([
            'reply' => $validated['reply'],
            'replied_by' => Auth::id(),
            'replied_at' => now(),
            'status' => Message::STATUS_REPLIED,
        ]);

        return redirect()
            ->route('admin.messages.show', $message)
            ->with('success', 'Reply sent successfully.');
    }

    /**
     * Close the specified message.
     */
    public function close(Message $message)
    {
        $message->update(['status' => Message::STATUS_CLOSED]);

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message closed successfully.');
    }

    /**
     * Get unread messages count for notification badge.
     */
    public function unreadCount()
    {
        $count = Message::pending()->unread()->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Get message preview data for tooltip.
     */
    public function preview(Message $message)
    {
        return response()->json([
            'id' => $message->id,
            'subject' => $message->subject,
            'message' => $message->message,
            'status' => $message->status,
            'created_at' => $message->created_at,
            'user' => [
                'name' => $message->user->name,
                'email' => $message->user->email,
            ]
        ]);
    }

    /**
     * Quick reply to a message.
     */
    public function quickReply(Request $request, Message $message)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $message->update([
            'reply' => $validated['reply'],
            'replied_by' => Auth::id(),
            'replied_at' => now(),
            'status' => Message::STATUS_REPLIED,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reply sent successfully.'
        ]);
    }

    /**
     * Handle bulk actions on messages.
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:close,pending,reply',
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id',
            'reply_text' => 'required_if:action,reply|string|max:1000',
        ]);

        $messages = Message::whereIn('id', $validated['message_ids']);

        switch ($validated['action']) {
            case 'close':
                $messages->update(['status' => Message::STATUS_CLOSED]);
                $message = 'Messages closed successfully.';
                break;

            case 'pending':
                $messages->update(['status' => Message::STATUS_PENDING]);
                $message = 'Messages marked as pending successfully.';
                break;

            case 'reply':
                $messages->update([
                    'reply' => $validated['reply_text'],
                    'replied_by' => Auth::id(),
                    'replied_at' => now(),
                    'status' => Message::STATUS_REPLIED,
                ]);
                $message = 'Bulk reply sent successfully.';
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * Download a message attachment.
     */
    public function downloadAttachment(MessageAttachment $attachment)
    {
        $filePath = storage_path('app/public/' . $attachment->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $attachment->original_name);
    }

    /**
     * Toggle importance status of a message.
     */
    public function toggleImportance(Message $message)
    {
        $message->update(['is_important' => !$message->is_important]);

        return response()->json([
            'success' => true,
            'is_important' => $message->is_important,
            'message' => $message->is_important ? 'Message marked as important.' : 'Message unmarked as important.'
        ]);
    }

    /**
     * Archive a message.
     */
    public function archive(Message $message)
    {
        $message->update([
            'is_archived' => true,
            'archived_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message archived successfully.'
        ]);
    }

    /**
     * Unarchive a message.
     */
    public function unarchive(Message $message)
    {
        $message->update([
            'is_archived' => false,
            'archived_at' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message unarchived successfully.'
        ]);
    }

    /**
     * Forward a message to another admin or create a new message.
     */
    public function forward(Request $request, Message $message)
    {
        $validated = $request->validate([
            'forward_to' => 'required|exists:users,id',
            'forward_note' => 'nullable|string|max:500',
        ]);

        // Create a new message with forwarded content
        $forwardedMessage = Message::create([
            'user_id' => $validated['forward_to'],
            'subject' => 'Forwarded: ' . $message->subject,
            'message' => ($validated['forward_note'] ? "Forward Note: " . $validated['forward_note'] . "\n\n" : "") .
                        "--- Forwarded Message ---\n" .
                        "From: " . $message->user->name . " (" . $message->user->email . ")\n" .
                        "Subject: " . $message->subject . "\n" .
                        "Date: " . $message->created_at->format('Y-m-d H:i:s') . "\n\n" .
                        $message->message,
            'status' => Message::STATUS_PENDING,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message forwarded successfully.',
            'forwarded_message_id' => $forwardedMessage->id
        ]);
    }
}
