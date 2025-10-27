@push('styles')
<style>
    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --secondary-color: #6b7280;
        --light-bg: #f8fafc;
        --border-color: #e5e7eb;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-muted: #9ca3af;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --border-radius: 0.75rem;
        --border-radius-sm: 0.5rem;
    }

    .messages-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-title i {
        color: var(--primary-color);
        font-size: 1.75rem;
    }

    .btn-new-message {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-sm);
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-md);
    }

    .btn-new-message:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    .messages-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
    }

    .empty-state p {
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    .message-card {
        background: white;
        border-radius: var(--border-radius-sm);
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        position: relative;
    }

    .message-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .message-card.unread {
        border-left: 4px solid var(--primary-color);
        background: rgba(79, 70, 229, 0.02);
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .message-subject {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 0.25rem 0;
        line-height: 1.3;
    }

    .message-meta {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .message-date {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin: 0;
    }

    .message-badges {
        display: flex;
        gap: 0.5rem;
        flex-shrink: 0;
        align-items: flex-start;
    }

    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .status-open {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-closed {
        background: rgba(107, 114, 128, 0.1);
        color: var(--secondary-color);
        border: 1px solid rgba(107, 114, 128, 0.2);
    }

    .status-replied {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info-color);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .unread-indicator {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 0.75rem;
        height: 0.75rem;
        background: var(--primary-color);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .message-preview {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        font-style: italic;
    }

    .message-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .action-btn {
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius-sm);
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-view {
        background: var(--primary-color);
        color: white;
    }

    .btn-view:hover {
        background: var(--primary-hover);
        color: white;
        transform: translateY(-1px);
    }

    .btn-close {
        background: rgba(107, 114, 128, 0.1);
        color: var(--secondary-color);
        border: 1px solid rgba(107, 114, 128, 0.3);
    }

    .btn-close:hover {
        background: var(--secondary-color);
        color: white;
        transform: translateY(-1px);
    }

    .pagination-wrapper {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-top: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .pagination {
        justify-content: center;
        margin: 0;
    }

    .page-link {
        color: var(--primary-color);
        border: 1px solid var(--border-color);
        padding: 0.75rem 1rem;
        margin: 0 0.125rem;
        border-radius: var(--border-radius-sm);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-1px);
    }

    .page-item.active .page-link {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    /* Accessibility Improvements */
    .action-btn:focus,
    .btn-new-message:focus,
    .page-link:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* Screen Reader Only Content */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    /* High Contrast Mode Support */
    @media (prefers-contrast: high) {
        .message-card {
            border: 2px solid var(--text-primary);
        }
        
        .status-badge {
            border-width: 2px;
        }
        
        .unread-indicator {
            border: 2px solid white;
        }
    }

    /* Reduced Motion Support */
    @media (prefers-reduced-motion: reduce) {
        .message-card,
        .action-btn,
        .btn-new-message,
        .page-link {
            transition: none;
        }
        
        .message-card:hover,
        .action-btn:hover,
        .btn-new-message:hover,
        .page-link:hover {
            transform: none;
        }
        
        .unread-indicator {
            animation: none;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .messages-container {
            padding: 1rem 0;
        }
        
        .page-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 1.75rem;
        }
        
        .btn-new-message {
            width: 100%;
            justify-content: center;
        }
        
        .message-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .message-badges {
            align-self: flex-start;
        }
        
        .message-actions {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .action-btn {
            width: 100%;
            justify-content: center;
        }
        
        .pagination-wrapper {
            padding: 1rem;
        }
        
        .page-link {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .unread-indicator {
            position: static;
            margin-left: auto;
            margin-top: 0.25rem;
        }
    }

    @media (max-width: 576px) {
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .message-card {
            padding: 1rem;
        }
        
        .message-subject {
            font-size: 1.125rem;
        }
        
        .empty-state {
            padding: 3rem 1rem;
        }
        
        .empty-state i {
            font-size: 3rem;
        }
    }

    /* Print Styles */
    @media print {
        .messages-container {
            background: white;
        }
        
        .btn-new-message,
        .message-actions,
        .pagination-wrapper {
            display: none !important;
        }
        
        .message-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid #000;
        }
        
        .status-badge {
            border: 1px solid #000;
            background: transparent !important;
            color: #000 !important;
        }
        
        .unread-indicator {
            display: none;
        }
    }
</style>
@endpush

<x-app-layout>
    <div class="messages-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                    {{ __('My Messages') }}
                </h1>
                <a href="{{ route('user.messages.create') }}" 
                   class="btn-new-message"
                   role="button"
                   aria-label="{{ __('Send a new message') }}">
                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    {{ __('New Message') }}
                </a>
            </div>

            <!-- Session Messages -->
            @if (session('success'))
                <div class="alert alert-success mb-4 shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2" aria-hidden="true"></i>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mb-4 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle me-2" aria-hidden="true"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Messages Content -->
            <div class="messages-card">
                @if($messages->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                        <h3>{{ __('No Messages Yet') }}</h3>
                        <p>{{ __('You don\'t have any messages yet. Start a conversation with our support team!') }}</p>
                        <a href="{{ route('user.messages.create') }}" 
                           class="btn-new-message"
                           role="button"
                           aria-label="{{ __('Send your first message') }}">
                            <i class="bi bi-plus-lg" aria-hidden="true"></i>
                            {{ __('Send Your First Message') }}
                        </a>
                    </div>
                @else
                    <div class="p-4">
                        @foreach($messages as $message)
                            <article class="message-card {{ !$message->is_read ? 'unread' : '' }}" role="article">
                                @if(!$message->is_read)
                                    <div class="unread-indicator" 
                                         role="img" 
                                         aria-label="{{ __('Unread message') }}"
                                         title="{{ __('Unread message') }}"></div>
                                @endif
                                
                                <div class="message-header">
                                    <div class="flex-grow-1">
                                        <h2 class="message-subject">{{ $message->subject }}</h2>
                                        <div class="message-meta">
                                            <p class="message-date">
                                                {{ __('Created') }}: {{ $message->created_at->format('M d, Y \a\t h:i A') }}
                                            </p>
                                            @if($message->updated_at->ne($message->created_at))
                                                <p class="message-date">
                                                    {{ __('Last Update') }}: {{ $message->updated_at->format('M d, Y \a\t h:i A') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="message-badges">
                                        @if($message->status === 'open')
                                            <span class="status-badge status-open" role="status" aria-label="{{ __('Message status: Open') }}">
                                                <i class="bi bi-envelope-open" aria-hidden="true"></i>
                                                {{ __('Open') }}
                                            </span>
                                        @else
                                            <span class="status-badge status-closed" role="status" aria-label="{{ __('Message status: Closed') }}">
                                                <i class="bi bi-envelope-x" aria-hidden="true"></i>
                                                {{ __('Closed') }}
                                            </span>
                                        @endif
                                        
                                        @if($message->replies_count > 0 && !$message->is_read)
                                            <span class="status-badge status-replied" role="status" aria-label="{{ __('Message has new replies') }}">
                                                <i class="bi bi-reply-fill" aria-hidden="true"></i>
                                                {{ __('New Reply') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($message->message)
                                    <div class="message-preview">
                                        "{{ Str::limit($message->message, 150) }}"
                                    </div>
                                @endif

                                <div class="message-actions">
                                    <a href="{{ route('user.messages.show', $message) }}" 
                                       class="action-btn btn-view"
                                       role="button"
                                       aria-label="{{ __('View message: :subject', ['subject' => $message->subject]) }}">
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                        {{ __('View') }}
                                    </a>
                                    
                                    @if($message->status === 'open')
                                        <form action="{{ route('user.messages.close', $message) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('Are you sure you want to close this message?') }}')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="action-btn btn-close"
                                                    aria-label="{{ __('Close message: :subject', ['subject' => $message->subject]) }}">
                                                <i class="bi bi-x-circle" aria-hidden="true"></i>
                                                {{ __('Close') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($messages->hasPages())
                <div class="pagination-wrapper">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>