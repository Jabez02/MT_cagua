@extends('layouts.app')

@section('title', 'Chat')

@section('content')
<div class="chat-container">
    <!-- Chat Sidebar -->
    <div class="chat-sidebar">
        <div class="chat-header">
            <h2>{{ Auth::user()->usertype === 'admin' ? 'Support Chats' : 'Messages' }}</h2>
            @if(Auth::user()->usertype !== 'admin')
                <button id="newChatBtn" class="btn-new-chat">
                    <i class="bi bi-plus-lg"></i>
                    New Chat
                </button>
            @endif
        </div>
        
        <div class="conversations-list" id="conversationsList">
            <!-- Conversations will be loaded here -->
        </div>
    </div>

    <!-- Chat Main Area -->
    <div class="chat-main">
        <div class="chat-welcome" id="chatWelcome">
            <div class="welcome-content">
                <i class="bi bi-chat-dots"></i>
                <h3>{{ Auth::user()->usertype === 'admin' ? 'Select a conversation to start chatting' : 'Welcome to Support Chat' }}</h3>
                <p>{{ Auth::user()->usertype === 'admin' ? 'Choose a conversation from the sidebar to view messages.' : 'Start a conversation with our support team.' }}</p>
            </div>
        </div>

        <div class="chat-area" id="chatArea" style="display: none;">
            <!-- Chat Header -->
            <div class="chat-area-header">
                <div class="participant-info">
                    <div class="participant-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="participant-details">
                        <h4 id="participantName">Loading...</h4>
                        <span class="participant-status" id="participantStatus">Online</span>
                    </div>
                </div>
                <div class="chat-actions">
                    <button class="btn-chat-action" title="More options">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                </div>
            </div>

            <!-- Messages Container -->
            <div class="messages-container" id="messagesContainer">
                <div class="messages-list" id="messagesList">
                    <!-- Messages will be loaded here -->
                </div>
                
                <!-- Typing Indicator -->
                <div class="typing-indicator" id="typingIndicator" style="display: none;">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span class="typing-text">Someone is typing...</span>
                </div>
            </div>

            <!-- Message Input -->
            <div class="message-input-container">
                <form id="messageForm" class="message-form">
                    <input type="hidden" id="conversationId" name="conversation_id">
                    <input type="hidden" id="replyToMessageId" name="reply_to_message_id">
                    
                    <!-- Reply Preview -->
                    <div class="reply-preview" id="replyPreview" style="display: none;">
                        <div class="reply-content">
                            <div class="reply-header">
                                <span>Replying to <strong id="replyToSender"></strong></span>
                                <button type="button" class="btn-cancel-reply" id="cancelReplyBtn">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <div class="reply-message" id="replyToContent"></div>
                        </div>
                    </div>

                    <div class="input-area">
                        <div class="input-actions">
                            <button type="button" class="btn-input-action" id="attachFileBtn" title="Attach file">
                                <i class="bi bi-paperclip"></i>
                            </button>
                            <button type="button" class="btn-input-action" id="emojiBtn" title="Add emoji">
                                <i class="bi bi-emoji-smile"></i>
                            </button>
                        </div>
                        
                        <div class="input-wrapper">
                            <textarea 
                                id="messageInput" 
                                name="content" 
                                placeholder="Type a message..." 
                                rows="1"
                                maxlength="10000"
                                required
                            ></textarea>
                            <input type="file" id="fileInput" name="attachment" style="display: none;" accept="image/*,application/pdf,.doc,.docx,.txt">
                        </div>
                        
                        <button type="submit" class="btn-send" id="sendBtn">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- New Chat Modal (for users) -->
@if(Auth::user()->usertype !== 'admin')
<div class="modal fade" id="newChatModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Start New Chat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="newChatForm">
                    <div class="mb-3">
                        <label for="adminSelect" class="form-label">Select Support Agent</label>
                        <select class="form-select" id="adminSelect" name="recipient_id" required>
                            <option value="">Choose an admin...</option>
                            <!-- Admin options will be loaded here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="initialMessage" class="form-label">Initial Message</label>
                        <textarea class="form-control" id="initialMessage" name="content" rows="3" placeholder="How can we help you?" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="startChatBtn">Start Chat</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- File Preview Modal -->
<div class="modal fade" id="filePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filePreviewTitle">File Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="filePreviewContent">
                    <!-- File preview content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary" id="downloadFileBtn" download>Download</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@vite(['resources/js/app.js'])
<script src="{{ asset('js/chat.js') }}"></script>
<script>
    // Initialize chat with user data
    window.chatConfig = {
        userId: {{ Auth::id() }},
        userRole: '{{ Auth::user()->usertype }}',
        userName: '{{ Auth::user()->name }}',
        csrfToken: '{{ csrf_token() }}',
        routes: {
            conversations: '{{ route('chat.conversations') }}',
            messages: '{{ route('chat.messages', ':id') }}',
            sendMessage: '{{ route('chat.send-message') }}',
            startConversation: '{{ route('chat.start-conversation') }}',
            typing: '{{ route('chat.typing') }}',
            addReaction: '{{ route('chat.add-reaction', ':id') }}',
            removeReaction: '{{ route('chat.remove-reaction', ':id') }}'
        }
    };
</script>
@endpush