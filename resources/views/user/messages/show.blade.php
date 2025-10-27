<x-app-layout>
    @push('styles')
    <link href="{{ asset('css/attachments.css') }}" rel="stylesheet">
    <link href="{{ asset('css/message-details.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="{{ asset('js/attachments.js') }}"></script>
    <script src="{{ asset('js/message-details.js') }}"></script>
    @endpush

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-semibold mb-0">
                {{ __('Message Details') }}
            </h2>
            <a href="{{ route('user.messages.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>{{ __('Back to Messages') }}
            </a>
        </div>
    </x-slot>

    <div class="py-4" id="main-content">
        <div class="container">
            <!-- Enhanced Message Header -->
            <div class="message-header slide-up">
                <div class="message-header-content">
                    <h1 class="message-title">{{ $message->subject }}</h1>
                    <div class="message-meta">
                        <div class="status-indicator {{ $message->status }}" data-bs-toggle="tooltip" title="Current message status">
                            <div class="status-pulse"></div>
                            {{ ucfirst($message->status) }}
                        </div>
                        <div class="text-white-75">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $message->created_at->format('M d, Y') }}
                        </div>
                        <div class="text-white-75">
                            <i class="bi bi-clock me-1"></i>
                            {{ $message->created_at->format('H:i') }}
                        </div>
                        @if($message->reply)
                            <div class="text-white-75">
                                <i class="bi bi-reply me-1"></i>
                                {{ __('Replied') }} {{ $message->replied_at->diffForHumans() }}
                            </div>
                        @endif
                    </div>
                    <div class="message-actions">
                        <button type="button" class="action-btn tooltip-wrapper" data-tooltip="Copy message link">
                            <i class="bi bi-link-45deg"></i>
                            {{ __('Share') }}
                        </button>
                        @if($message->status === 'pending')
                            <form action="{{ route('user.messages.close', $message) }}" method="POST" class="d-inline">
                                @csrf
                                @method('POST')
                                <button type="submit" class="action-btn" onclick="return confirm('{{ __('Are you sure you want to close this message?') }}')" data-bs-toggle="tooltip" title="Close this message">
                                    <i class="bi bi-x-circle"></i>
                                    {{ __('Close Message') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Enhanced Message Content -->
            <div class="message-content-card card shadow fade-in">
                <div class="card-body">
                    <div class="message-body">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $message->message }}</p>
                    </div>

                        @if($message->attachments->count() > 0)
                            <div class="attachments-section slide-up">
                                <div class="attachments-header">
                                    <div class="attachments-title">
                                        <div class="attachments-icon">
                                            <i class="bi bi-paperclip"></i>
                                        </div>
                                        <div>
                                            <h4 class="fs-6 fw-semibold mb-0">{{ __('Attachments') }}</h4>
                                            <small class="text-muted">{{ $message->attachments->count() }} {{ $message->attachments->count() === 1 ? __('file') : __('files') }}</small>
                                        </div>
                                    </div>
                                    <div class="attachment-stats">
                                        <div class="stat-item">
                                            <i class="bi bi-files"></i>
                                            <span>{{ $message->attachments->count() }}</span>
                                        </div>
                                        <div class="stat-item">
                                            <i class="bi bi-hdd"></i>
                                            <span>{{ $message->attachments->sum('file_size') > 0 ? number_format($message->attachments->sum('file_size') / 1024 / 1024, 2) . ' MB' : 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    @foreach($message->attachments as $attachment)
                                        <div class="col-lg-6 col-xl-4">
                                            <div class="attachment-card 
                                                @if($attachment->isImage()) file-type-image
                                                @elseif(in_array($attachment->extension, ['pdf'])) file-type-pdf
                                                @elseif(in_array($attachment->extension, ['doc', 'docx'])) file-type-word
                                                @elseif(in_array($attachment->extension, ['xls', 'xlsx'])) file-type-excel
                                                @elseif(in_array($attachment->extension, ['zip', 'rar', '7z'])) file-type-archive
                                                @endif
                                                border rounded-3 p-3 h-100" 
                                                aria-label="Attachment: {{ $attachment->original_name }}" 
                                                role="article">
                                                <div class="d-flex flex-column h-100">
                                                    <div class="d-flex align-items-start mb-3">
                                                        <div class="attachment-icon me-3 flex-shrink-0">
                                                            @if($attachment->isImage())
                                                                <div class="icon-wrapper rounded-circle">
                                                                    <i class="bi bi-image text-white fs-4"></i>
                                                                </div>
                                                            @elseif(in_array($attachment->extension, ['pdf']))
                                                                <div class="icon-wrapper rounded-circle">
                                                                    <i class="bi bi-file-earmark-pdf text-white fs-4"></i>
                                                                </div>
                                                            @elseif(in_array($attachment->extension, ['doc', 'docx']))
                                                                <div class="icon-wrapper rounded-circle">
                                                                    <i class="bi bi-file-earmark-word text-white fs-4"></i>
                                                                </div>
                                                            @elseif(in_array($attachment->extension, ['xls', 'xlsx']))
                                                                <div class="icon-wrapper rounded-circle">
                                                                    <i class="bi bi-file-earmark-excel text-white fs-4"></i>
                                                                </div>
                                                            @elseif(in_array($attachment->extension, ['zip', 'rar', '7z']))
                                                                <div class="icon-wrapper rounded-circle">
                                                                    <i class="bi bi-file-earmark-zip text-white fs-4"></i>
                                                                </div>
                                                            @elseif(in_array($attachment->extension, ['txt', 'md']))
                                                                <div class="icon-wrapper bg-secondary rounded-circle">
                                                                    <i class="bi bi-file-earmark-text text-white fs-4"></i>
                                                                </div>
                                                            @else
                                                                <div class="icon-wrapper bg-secondary rounded-circle">
                                                                    <i class="bi bi-file-earmark text-white fs-4"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-grow-1 min-width-0">
                                                            <h6 class="mb-1 text-truncate fw-medium" title="{{ $attachment->original_name }}">
                                                                {{ $attachment->original_name }}
                                                            </h6>
                                                            <div class="d-flex align-items-center text-muted small">
                                                                <i class="bi bi-hdd me-1"></i>
                                                                <span>{{ $attachment->formatted_file_size }}</span>
                                                                <span class="mx-2">•</span>
                                                                <span class="text-uppercase fw-medium">{{ $attachment->extension }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    @if($attachment->isImage())
                                                        <div class="attachment-preview mb-3" onclick="previewImage('{{ $attachment->original_name }}', '{{ route('user.messages.attachments.download', $attachment) }}')" style="cursor: pointer;">
                                                            <div class="image-preview bg-light rounded-2 p-3 text-center">
                                                                <i class="bi bi-eye-fill text-primary fs-4 mb-2"></i>
                                                                <div class="text-primary fw-medium small">{{ __('Click to Preview') }}</div>
                                                                <small class="text-muted">{{ __('Image file') }}</small>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="mt-auto">
                                                        <div class="d-grid gap-2">
                                                            <a href="{{ route('user.messages.attachments.download', $attachment) }}" 
                                                               class="btn btn-download btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                               data-bs-toggle="tooltip" title="Download {{ $attachment->original_name }}">
                                                                <i class="bi bi-download me-2"></i>
                                                                {{ __('Download') }}
                                                            </a>
                                                            @if($attachment->isImage())
                                                                <button type="button" class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center" 
                                                                        onclick="previewImage('{{ $attachment->original_name }}', '{{ route('user.messages.attachments.download', $attachment) }}')"
                                                                        data-bs-toggle="tooltip" title="Preview image in lightbox">
                                                                    <i class="bi bi-eye me-2"></i>
                                                                    {{ __('Quick Preview') }}
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($message->reply)
                            <div class="reply-section slide-up">
                                <div class="reply-header">
                                    <div class="reply-icon">
                                        <i class="bi bi-reply-fill"></i>
                                    </div>
                                    <div>
                                        <h4 class="fs-6 fw-semibold mb-0">{{ __('Admin Reply') }}</h4>
                                        <small class="text-muted">
                                            {{ __('Replied at') }}: {{ $message->replied_at->format('M d, Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="alert alert-info mb-0 border-0" style="background: rgba(33, 150, 243, 0.1);">
                                    <p class="mb-0" style="white-space: pre-wrap;">{{ $message->reply }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>