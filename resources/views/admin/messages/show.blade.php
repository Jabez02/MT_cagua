@extends('admin.layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('css/attachments.css') }}" rel="stylesheet">

<style>
    :root {
        --primary: #4f46e5;
        --primary-light: #6366f1;
        --primary-dark: #4338ca;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --border-radius: 12px;
        --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--gray-50);
    }

    .message-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .message-header {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 2rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary);
    }

    .header-top {
        display: flex;
        justify-content: between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 2rem;
    }

    .header-content {
        flex: 1;
    }

    .message-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0 0 0.5rem 0;
        line-height: 1.3;
    }

    .message-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        color: var(--gray-600);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-item i {
        color: var(--gray-500);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: 8px;
        margin-top: 1rem;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.125rem;
    }

    .user-details h4 {
        margin: 0;
        font-weight: 500;
        color: var(--gray-900);
    }

    .user-details p {
        margin: 0;
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
        flex-shrink: 0;
        align-items: center;
    }

    .quick-actions {
        display: flex;
        gap: 0.5rem;
        margin-right: 1rem;
    }

    .btn-quick-action {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        background: white;
        color: var(--gray-700);
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-quick-action:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
        transform: translateY(-1px);
    }

    .btn-quick-action.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .btn-quick-action.active:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    .btn-quick-action i {
        font-size: 0.875rem;
    }

    .action-text {
        font-size: 0.75rem;
    }

    @media (max-width: 768px) {
        .quick-actions {
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .action-text {
            display: none;
        }
        
        .btn-quick-action {
            padding: 0.5rem;
            min-width: 36px;
            justify-content: center;
        }
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-replied {
        background: #d1fae5;
        color: #065f46;
    }

    .status-closed {
        background: var(--gray-200);
        color: var(--gray-700);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-lg);
    }

    .btn-secondary {
        background: white;
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
    }

    .btn-secondary:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-danger {
        background: var(--danger);
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }

    .message-thread {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .message-content {
        padding: 2rem;
        border-bottom: 1px solid var(--gray-200);
    }

    .message-text {
        background: var(--gray-50);
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 3px solid var(--info);
        white-space: pre-wrap;
        line-height: 1.6;
        color: var(--gray-800);
    }

    .reply-section {
        padding: 2rem;
        background: #f0f9ff;
        border-left: 3px solid var(--success);
    }

    .reply-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .reply-header h4 {
        margin: 0;
        color: var(--gray-900);
        font-weight: 600;
    }

    .reply-text {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        white-space: pre-wrap;
        line-height: 1.6;
        color: var(--gray-800);
        box-shadow: var(--shadow);
    }

    .reply-form {
        padding: 2rem;
        background: var(--gray-50);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--gray-900);
    }

    .form-textarea {
        width: 100%;
        padding: 1rem;
        border: 1px solid var(--gray-300);
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.875rem;
        line-height: 1.5;
        resize: vertical;
        min-height: 120px;
    }

    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgb(79 70 229 / 0.1);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .navigation-bar {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 1rem 2rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav-title {
        font-weight: 600;
        color: var(--gray-900);
        margin: 0;
    }

    @media (max-width: 768px) {
        .message-container {
            padding: 1rem 0.5rem;
        }
        
        .header-top {
            flex-direction: column;
            gap: 1rem;
        }
        
        .header-actions {
            width: 100%;
            justify-content: flex-start;
        }
        
        .message-meta {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            justify-content: center;
        }
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/attachments.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const replyTextarea = document.getElementById('reply');
    const messageId = {{ $message->id }};
    const autosaveKey = `message_reply_draft_${messageId}`;
    let autosaveTimer;
    let isTyping = false;
    
    // Auto-save functionality
    if (replyTextarea) {
        // Load saved draft on page load
        const savedDraft = localStorage.getItem(autosaveKey);
        if (savedDraft && replyTextarea.value.trim() === '') {
            replyTextarea.value = savedDraft;
            showDraftNotification();
        }
        
        // Auto-save while typing
        replyTextarea.addEventListener('input', function() {
            isTyping = true;
            clearTimeout(autosaveTimer);
            
            autosaveTimer = setTimeout(() => {
                if (this.value.trim() !== '') {
                    localStorage.setItem(autosaveKey, this.value);
                    showAutosaveIndicator();
                } else {
                    localStorage.removeItem(autosaveKey);
                }
                isTyping = false;
            }, 1000);
        });
        
        // Clear draft when form is submitted
        const replyForm = replyTextarea.closest('form');
        if (replyForm) {
            replyForm.addEventListener('submit', function() {
                localStorage.removeItem(autosaveKey);
            });
        }
        
        // Character counter
        const charCounter = document.createElement('div');
        charCounter.className = 'char-counter';
        charCounter.style.cssText = `
            text-align: right;
            font-size: 0.75rem;
            color: var(--gray-500);
            margin-top: 0.5rem;
        `;
        replyTextarea.parentNode.appendChild(charCounter);
        
        function updateCharCounter() {
            const count = replyTextarea.value.length;
            charCounter.textContent = `${count} characters`;
            if (count > 1000) {
                charCounter.style.color = 'var(--warning)';
            } else if (count > 1500) {
                charCounter.style.color = 'var(--danger)';
            } else {
                charCounter.style.color = 'var(--gray-500)';
            }
        }
        
        replyTextarea.addEventListener('input', updateCharCounter);
        updateCharCounter();
    }
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Only activate shortcuts when not typing in textarea
        if (e.target.tagName === 'TEXTAREA' || e.target.tagName === 'INPUT') return;
        
        switch(e.key.toLowerCase()) {
            case 'r':
                e.preventDefault();
                if (replyTextarea) {
                    replyTextarea.focus();
                    replyTextarea.scrollIntoView({ behavior: 'smooth' });
                }
                break;
            case 'escape':
                e.preventDefault();
                window.location.href = '{{ route("admin.messages.index") }}';
                break;
            case 'c':
                if (e.ctrlKey || e.metaKey) return; // Don't interfere with copy
                e.preventDefault();
                const closeButton = document.querySelector('button[type="submit"]:has(i.bi-x-circle)');
                if (closeButton) {
                    closeButton.click();
                }
                break;
        }
    });
    
    // Show keyboard shortcuts help
    const helpButton = document.createElement('button');
    helpButton.type = 'button';
    helpButton.className = 'btn btn-secondary';
    helpButton.innerHTML = '<i class="bi bi-question-circle"></i> Shortcuts';
    helpButton.style.cssText = 'position: fixed; bottom: 20px; right: 20px; z-index: 1000;';
    helpButton.onclick = showKeyboardShortcuts;
    document.body.appendChild(helpButton);
    
    function showDraftNotification() {
        const notification = document.createElement('div');
        notification.className = 'draft-notification';
        notification.innerHTML = `
            <div style="
                background: #fef3c7;
                color: #92400e;
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                border-left: 4px solid #f59e0b;
            ">
                <i class="bi bi-info-circle"></i>
                <span>Draft restored from previous session</span>
                <button type="button" onclick="this.parentElement.parentElement.remove()" style="
                    background: none;
                    border: none;
                    color: #92400e;
                    margin-left: auto;
                    cursor: pointer;
                ">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `;
        replyTextarea.parentNode.insertBefore(notification, replyTextarea);
    }
    
    function showAutosaveIndicator() {
        let indicator = document.querySelector('.autosave-indicator');
        if (!indicator) {
            indicator = document.createElement('div');
            indicator.className = 'autosave-indicator';
            indicator.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: var(--success);
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 20px;
                font-size: 0.875rem;
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.3s;
            `;
            document.body.appendChild(indicator);
        }
        
        indicator.innerHTML = '<i class="bi bi-check-circle"></i> Draft saved';
        indicator.style.opacity = '1';
        
        setTimeout(() => {
            indicator.style.opacity = '0';
        }, 2000);
    }
    
    function showKeyboardShortcuts() {
        const modal = document.createElement('div');
        modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        `;
        
        modal.innerHTML = `
            <div style="
                background: white;
                padding: 2rem;
                border-radius: 12px;
                max-width: 400px;
                width: 90%;
                box-shadow: var(--shadow-lg);
            ">
                <h3 style="margin: 0 0 1.5rem 0; color: var(--gray-900);">Keyboard Shortcuts</h3>
                <div style="display: grid; gap: 1rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Focus reply box</span>
                        <kbd style="background: var(--gray-100); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">R</kbd>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Close message</span>
                        <kbd style="background: var(--gray-100); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">C</kbd>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Back to messages</span>
                        <kbd style="background: var(--gray-100); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Esc</kbd>
                    </div>
                </div>
                <button type="button" onclick="this.closest('div[style*=\"position: fixed\"]').remove()" 
                        style="
                            margin-top: 1.5rem;
                            width: 100%;
                            padding: 0.75rem;
                            background: var(--primary);
                            color: white;
                            border: none;
                            border-radius: 8px;
                            cursor: pointer;
                        ">
                    Got it
                </button>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }
    
    // Enhanced attachment preview
    window.previewImage = function(filename, url) {
        const modal = document.createElement('div');
        modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            cursor: zoom-out;
        `;
        
        modal.innerHTML = `
            <div style="
                max-width: 90%;
                max-height: 90%;
                position: relative;
            ">
                <img src="${url}" alt="${filename}" style="
                    max-width: 100%;
                    max-height: 100%;
                    object-fit: contain;
                    border-radius: 8px;
                    box-shadow: var(--shadow-lg);
                ">
                <div style="
                    position: absolute;
                    top: -40px;
                    left: 0;
                    right: 0;
                    text-align: center;
                    color: white;
                    font-weight: 500;
                ">${filename}</div>
                <button onclick="this.closest('div[style*=\"position: fixed\"]').remove()" style="
                    position: absolute;
                    top: -40px;
                    right: 0;
                    background: rgba(255, 255, 255, 0.2);
                    border: none;
                    color: white;
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.tagName === 'IMG') {
                modal.remove();
            }
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                modal.remove();
            }
        });
    };
});
</script>
@endpush

@section('content')
<div class="message-container">
    <!-- Navigation Bar -->
    <div class="navigation-bar">
        <h1 class="nav-title">Message Details</h1>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Back to Messages
        </a>
    </div>

    <!-- Message Header -->
    <div class="message-header">
        <div class="header-top">
            <div class="header-content">
                <h2 class="message-title">{{ $message->subject }}</h2>
                <div class="message-meta">
                    <div class="meta-item">
                        <i class="bi bi-calendar"></i>
                        <span>{{ $message->created_at->format('M d, Y \a\t h:i A') }}</span>
                    </div>
                    @if($message->read_at)
                        <div class="meta-item">
                            <i class="bi bi-eye"></i>
                            <span>Read {{ $message->read_at->format('M d, Y \a\t h:i A') }}</span>
                        </div>
                    @endif
                    @if($message->replied_at)
                        <div class="meta-item">
                            <i class="bi bi-reply"></i>
                            <span>Replied {{ $message->replied_at->format('M d, Y \a\t h:i A') }}</span>
                        </div>
                    @endif
                </div>
                
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($message->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h4>{{ $message->user->name ?? 'Unknown User' }}</h4>
                        <p>{{ $message->user->email ?? 'No email' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="header-actions">
                <!-- Quick Action Buttons -->
                <div class="quick-actions">
                    <button type="button" 
                            class="btn-quick-action {{ $message->is_important ? 'active' : '' }}" 
                            onclick="toggleImportance({{ $message->id }})"
                            title="{{ $message->is_important ? 'Remove from important' : 'Mark as important' }}">
                        <i class="bi bi-star{{ $message->is_important ? '-fill' : '' }}"></i>
                        <span class="action-text">{{ $message->is_important ? 'Important' : 'Mark Important' }}</span>
                    </button>
                    
                    @if(!$message->is_archived)
                        <button type="button" 
                                class="btn-quick-action" 
                                onclick="archiveMessage({{ $message->id }})"
                                title="Archive message">
                            <i class="bi bi-archive"></i>
                            <span class="action-text">Archive</span>
                        </button>
                    @else
                        <button type="button" 
                                class="btn-quick-action" 
                                onclick="unarchiveMessage({{ $message->id }})"
                                title="Unarchive message">
                            <i class="bi bi-archive-fill"></i>
                            <span class="action-text">Unarchive</span>
                        </button>
                    @endif
                    
                    <button type="button" 
                            class="btn-quick-action" 
                            onclick="showForwardModal({{ $message->id }})"
                            title="Forward message">
                        <i class="bi bi-forward"></i>
                        <span class="action-text">Forward</span>
                    </button>
                </div>
                
                <span class="status-badge status-{{ $message->status }}">
                    @if($message->status === 'pending')
                        <i class="bi bi-clock"></i>
                        Pending
                    @elseif($message->status === 'replied')
                        <i class="bi bi-check-circle"></i>
                        Replied
                    @else
                        <i class="bi bi-x-circle"></i>
                        Closed
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Message Thread -->
    <div class="message-thread">
        <!-- Original Message -->
        <div class="message-content">
            <h3 style="margin: 0 0 1rem 0; color: var(--gray-900); font-weight: 600;">Original Message</h3>
            <div class="message-text">{{ $message->message }}</div>
            
            @if($message->attachments->count() > 0)
                <div class="mt-4">
                    <div class="attachment-header">
                        <h4 class="attachment-title">
                            <i class="bi bi-paperclip"></i>
                            Attachments
                            <span class="attachment-count">{{ $message->attachments->count() }}</span>
                        </h4>
                    </div>
                    <div class="attachment-grid">
                        @foreach($message->attachments as $attachment)
                            <div class="attachment-card">
                                <div class="attachment-icon-wrapper file-type-{{ $attachment->extension }}">
                                    @if($attachment->isImage())
                                        <i class="bi bi-image attachment-icon"></i>
                                    @elseif(in_array($attachment->extension, ['pdf']))
                                        <i class="bi bi-file-earmark-pdf attachment-icon"></i>
                                    @elseif(in_array($attachment->extension, ['doc', 'docx']))
                                        <i class="bi bi-file-earmark-word attachment-icon"></i>
                                    @elseif(in_array($attachment->extension, ['xls', 'xlsx']))
                                        <i class="bi bi-file-earmark-excel attachment-icon"></i>
                                    @elseif(in_array($attachment->extension, ['ppt', 'pptx']))
                                        <i class="bi bi-file-earmark-ppt attachment-icon"></i>
                                    @elseif(in_array($attachment->extension, ['zip', 'rar', '7z']))
                                        <i class="bi bi-file-earmark-zip attachment-icon"></i>
                                    @elseif(in_array($attachment->extension, ['txt']))
                                        <i class="bi bi-file-earmark-text attachment-icon"></i>
                                    @else
                                        <i class="bi bi-file-earmark attachment-icon"></i>
                                    @endif
                                </div>
                                
                                <div class="attachment-info">
                                    <h6 class="attachment-name" title="{{ $attachment->original_name }}">
                                        {{ $attachment->original_name }}
                                    </h6>
                                    <div class="attachment-meta">
                                        <span class="attachment-size">{{ $attachment->formatted_file_size }}</span>
                                        <span class="attachment-type">{{ strtoupper($attachment->extension) }}</span>
                                    </div>
                                </div>
                                
                                <div class="attachment-actions">
                                    @if($attachment->isImage())
                                        <button type="button" 
                                                class="btn btn-preview" 
                                                onclick="previewImage('{{ $attachment->original_name }}', '{{ route('admin.messages.attachments.download', $attachment) }}')"
                                                title="Preview Image">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @endif
                                    <a href="{{ route('admin.messages.attachments.download', $attachment) }}" 
                                       class="btn btn-download"
                                       title="Download File">
                                        <i class="bi bi-download"></i>
                                        <span>Download</span>
                                    </a>
                                </div>
                                
                                @if($attachment->isImage())
                                    <div class="attachment-preview">
                                        <div class="image-preview-placeholder">
                                            <i class="bi bi-image"></i>
                                            <span>Click to preview</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        @if($message->reply)
            <!-- Admin Reply -->
            <div class="reply-section">
                <div class="reply-header">
                    <i class="bi bi-reply" style="color: var(--success);"></i>
                    <h4>Your Reply</h4>
                    <span style="color: var(--gray-600); font-size: 0.875rem;">
                        {{ $message->replied_at->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>
                <div class="reply-text">{{ $message->reply }}</div>
            </div>
        @endif

        @if($message->status === 'pending')
            <!-- Reply Form -->
            <div class="reply-form">
                <h4 style="margin: 0 0 1.5rem 0; color: var(--gray-900); font-weight: 600;">
                    <i class="bi bi-reply" style="color: var(--primary);"></i>
                    Reply to Message
                </h4>
                
                <form action="{{ route('admin.messages.reply', $message) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="reply" class="form-label">Your Reply</label>
                        <textarea 
                            name="reply" 
                            id="reply" 
                            class="form-textarea" 
                            placeholder="Type your reply here..."
                            required>{{ old('reply') }}</textarea>
                        @error('reply')
                            <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i>
                            Send Reply
                        </button>
                        
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('reply').value = '';">
                            <i class="bi bi-arrow-clockwise"></i>
                            Clear
                        </button>
                    </div>
                </form>

                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--gray-200);">
                    <form action="{{ route('admin.messages.close', $message) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to close this message without replying?')">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-x-circle"></i>
                            Close Without Reply
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Forward Modal -->
<div id="forwardModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Forward Message</h3>
            <button type="button" class="modal-close" onclick="closeForwardModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <form id="forwardForm" onsubmit="forwardMessage(event)">
            <div class="modal-body">
                <div class="form-group">
                    <label for="forward_to" class="form-label">Forward to User:</label>
                    <select id="forward_to" name="forward_to" class="form-select" required>
                        <option value="">Select a user...</option>
                        @foreach(\App\Models\User::where('usertype', 'user')->orderBy('name')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="forward_note" class="form-label">Forward Note (Optional):</label>
                    <textarea id="forward_note" name="forward_note" class="form-textarea" rows="3" 
                              placeholder="Add a note to explain why you're forwarding this message..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeForwardModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-forward"></i>
                    Forward Message
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    border-radius: 8px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid var(--gray-200);
}

.modal-header h3 {
    margin: 0;
    color: var(--gray-900);
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--gray-500);
    padding: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
}

.modal-close:hover {
    background: var(--gray-100);
    color: var(--gray-700);
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding: 1.5rem;
    border-top: 1px solid var(--gray-200);
}

.form-select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--gray-300);
    border-radius: 6px;
    font-size: 0.875rem;
    background: white;
}

.form-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgb(79 70 229 / 0.1);
}
</style>

<script>
// Quick Action Functions
function toggleImportance(messageId) {
    fetch(`/admin/messages/${messageId}/toggle-importance`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const button = document.querySelector(`button[onclick="toggleImportance(${messageId})"]`);
            const icon = button.querySelector('i');
            const text = button.querySelector('.action-text');
            
            if (data.is_important) {
                button.classList.add('active');
                icon.className = 'bi bi-star-fill';
                text.textContent = 'Important';
                button.title = 'Remove from important';
            } else {
                button.classList.remove('active');
                icon.className = 'bi bi-star';
                text.textContent = 'Mark Important';
                button.title = 'Mark as important';
            }
            
            showNotification(data.message, 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to update importance status', 'error');
    });
}

function archiveMessage(messageId) {
    if (!confirm('Are you sure you want to archive this message?')) return;
    
    fetch(`/admin/messages/${messageId}/archive`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            // Redirect to messages list after archiving
            setTimeout(() => {
                window.location.href = '/admin/messages';
            }, 1500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to archive message', 'error');
    });
}

function unarchiveMessage(messageId) {
    fetch(`/admin/messages/${messageId}/unarchive`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const button = document.querySelector(`button[onclick="unarchiveMessage(${messageId})"]`);
            const icon = button.querySelector('i');
            const text = button.querySelector('.action-text');
            
            button.setAttribute('onclick', `archiveMessage(${messageId})`);
            button.title = 'Archive message';
            icon.className = 'bi bi-archive';
            text.textContent = 'Archive';
            
            showNotification(data.message, 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to unarchive message', 'error');
    });
}

function showForwardModal(messageId) {
    document.getElementById('forwardModal').style.display = 'flex';
    document.getElementById('forwardForm').dataset.messageId = messageId;
}

function closeForwardModal() {
    document.getElementById('forwardModal').style.display = 'none';
    document.getElementById('forwardForm').reset();
}

function forwardMessage(event) {
    event.preventDefault();
    
    const form = event.target;
    const messageId = form.dataset.messageId;
    const formData = new FormData(form);
    
    fetch(`/admin/messages/${messageId}/forward`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeForwardModal();
            showNotification(data.message, 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to forward message', 'error');
    });
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add notification styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('forwardModal');
    if (event.target === modal) {
        closeForwardModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeForwardModal();
    }
});
</script>
@endsection