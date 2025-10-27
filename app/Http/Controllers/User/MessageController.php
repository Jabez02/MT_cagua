<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of the user's messages.
     */
    public function index()
    {
        $messages = Auth::user()
            ->messages()
            ->latest()
            ->paginate(10);

        return view('user.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        return view('user.messages.create');
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|max:10240|mimes:pdf,doc,docx,txt,jpg,jpeg,png,gif,zip,rar',
        ]);

        $message = Auth::user()->messages()->create([
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
            ->route('user.messages.show', $message)
            ->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        // Ensure the user can only view their own messages
        if ($message->user_id !== Auth::id()) {
            abort(403);
        }

        // Mark message as read if it hasn't been read yet
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('user.messages.show', compact('message'));
    }

    /**
     * Close the specified message.
     */
    public function close(Message $message)
    {
        // Ensure the user can only close their own messages
        if ($message->user_id !== Auth::id()) {
            abort(403);
        }

        $message->update(['status' => Message::STATUS_CLOSED]);

        return redirect()
            ->route('user.messages.index')
            ->with('success', 'Message closed successfully.');
    }

    /**
     * Download a message attachment.
     */
    public function downloadAttachment(MessageAttachment $attachment)
    {
        // Ensure the user can only download attachments from their own messages
        if ($attachment->message->user_id !== Auth::id()) {
            abort(403);
        }

        $filePath = storage_path('app/public/' . $attachment->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $attachment->original_name);
    }

    /**
     * Get unread messages count for notification badge.
     */
    public function unreadCount()
    {
        $count = Auth::user()
            ->messages()
            ->whereNull('read_at')
            ->count();
            
        return response()->json(['count' => $count]);
    }
}
