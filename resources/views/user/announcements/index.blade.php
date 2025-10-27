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

    .announcements-container {
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
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .page-title i {
        color: var(--primary-color);
        font-size: 1.75rem;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    .announcements-card {
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
        margin-bottom: 0;
    }

    .announcement-card {
        background: white;
        border-radius: var(--border-radius-sm);
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        position: relative;
    }

    .announcement-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .announcement-card.important {
        border-left: 4px solid var(--danger-color);
        background: rgba(239, 68, 68, 0.02);
    }

    .announcement-card.general {
        border-left: 4px solid var(--info-color);
        background: rgba(59, 130, 246, 0.02);
    }

    .announcement-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .announcement-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 0.25rem 0;
        line-height: 1.3;
    }

    .announcement-meta {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .announcement-date {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .announcement-badges {
        display: flex;
        gap: 0.5rem;
        flex-shrink: 0;
        align-items: flex-start;
    }

    .priority-badge {
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

    .priority-high {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .priority-medium {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .priority-low {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info-color);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .type-badge {
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

    .type-important {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .type-general {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .announcement-content {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .announcement-actions {
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
        .announcement-card {
            border: 2px solid var(--text-primary);
        }
        
        .priority-badge,
        .type-badge {
            border-width: 2px;
        }
    }

    /* Reduced Motion Support */
    @media (prefers-reduced-motion: reduce) {
        .announcement-card,
        .action-btn,
        .page-link {
            transition: none;
        }
        
        .announcement-card:hover,
        .action-btn:hover,
        .page-link:hover {
            transform: none;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .announcements-container {
            padding: 1rem 0;
        }
        
        .page-header {
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 1.75rem;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .announcement-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .announcement-badges {
            align-self: flex-start;
            flex-wrap: wrap;
        }
        
        .announcement-actions {
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
    }

    @media (max-width: 576px) {
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .announcement-card {
            padding: 1rem;
        }
        
        .announcement-title {
            font-size: 1.125rem;
        }
        
        .empty-state {
            padding: 3rem 1rem;
        }
        
        .empty-state i {
            font-size: 3rem;
        }
        
        .announcement-badges {
            gap: 0.25rem;
        }
        
        .priority-badge,
        .type-badge {
            font-size: 0.6875rem;
            padding: 0.25rem 0.5rem;
        }
    }

    /* Print Styles */
    @media print {
        .announcements-container {
            background: white;
        }
        
        .announcement-actions,
        .pagination-wrapper {
            display: none !important;
        }
        
        .announcement-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid #000;
        }
        
        .priority-badge,
        .type-badge {
            border: 1px solid #000;
            background: transparent !important;
            color: #000 !important;
        }
    }
</style>
@endpush

<x-app-layout>
    <div class="announcements-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-megaphone-fill" aria-hidden="true"></i>
                    {{ __('Announcements') }}
                </h1>
                <p class="page-subtitle">{{ __('Stay updated with the latest news and important information') }}</p>
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

            <!-- Announcements Content -->
            <div class="announcements-card">
                @if($announcements->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-megaphone" aria-hidden="true"></i>
                        <h3>{{ __('No Announcements') }}</h3>
                        <p>{{ __('There are no announcements at this time. Check back later for updates!') }}</p>
                    </div>
                @else
                    <div class="p-4">
                        @foreach($announcements as $announcement)
                            <article class="announcement-card {{ strtolower($announcement->type) }}" role="article">
                                <div class="announcement-header">
                                    <div class="flex-grow-1">
                                        <h2 class="announcement-title">{{ $announcement->title }}</h2>
                                        <div class="announcement-meta">
                                            <p class="announcement-date">
                                                <i class="bi bi-calendar3" aria-hidden="true"></i>
                                                {{ $announcement->created_at->format('M d, Y \a\t h:i A') }}
                                            </p>
                                            @if($announcement->updated_at->ne($announcement->created_at))
                                                <p class="announcement-date">
                                                    <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                                                    {{ __('Updated') }}: {{ $announcement->updated_at->format('M d, Y \a\t h:i A') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="announcement-badges">
                                        @if(isset($announcement->priority))
                                            <span class="priority-badge priority-{{ strtolower($announcement->priority) }}" 
                                                  role="status" 
                                                  aria-label="{{ __('Priority: :priority', ['priority' => $announcement->priority]) }}">
                                                @if($announcement->priority === 'high')
                                                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                                                @elseif($announcement->priority === 'medium')
                                                    <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>
                                                @else
                                                    <i class="bi bi-info-circle-fill" aria-hidden="true"></i>
                                                @endif
                                                {{ ucfirst($announcement->priority) }}
                                            </span>
                                        @endif
                                        
                                        <span class="type-badge type-{{ strtolower($announcement->type) }}" 
                                              role="status" 
                                              aria-label="{{ __('Type: :type', ['type' => $announcement->type]) }}">
                                            @if($announcement->type === 'important')
                                                <i class="bi bi-exclamation-diamond-fill" aria-hidden="true"></i>
                                            @else
                                                <i class="bi bi-info-square-fill" aria-hidden="true"></i>
                                            @endif
                                            {{ ucfirst($announcement->type) }}
                                        </span>
                                    </div>
                                </div>

                                @if($announcement->content)
                                    <div class="announcement-content">
                                        {{ Str::limit($announcement->content, 200) }}
                                    </div>
                                @endif

                                <div class="announcement-actions">
                                    <a href="{{ route('user.announcements.show', $announcement) }}" 
                                       class="action-btn btn-view"
                                       role="button"
                                       aria-label="{{ __('Read full announcement: :title', ['title' => $announcement->title]) }}">
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                        {{ __('Read More') }}
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($announcements->hasPages())
                <div class="pagination-wrapper">
                    {{ $announcements->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>