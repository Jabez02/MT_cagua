@push('styles')
<style>
    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
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

    .reviews-container {
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

    .btn-new-review {
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

    .btn-new-review:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    .reviews-card {
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

    .review-card {
        background: white;
        border-radius: var(--border-radius-sm);
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .review-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .review-header {
        display: flex;
        justify-content: between;
        align-items: flex-start;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .review-trail {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 0.25rem 0;
    }

    .review-date {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin: 0;
    }

    .review-badges {
        display: flex;
        gap: 0.5rem;
        flex-shrink: 0;
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

    .status-verified {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-hidden {
        background: rgba(107, 114, 128, 0.1);
        color: var(--secondary-color);
        border: 1px solid rgba(107, 114, 128, 0.2);
    }

    .rating-display {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .stars {
        display: flex;
        gap: 0.125rem;
    }

    .star {
        width: 1.25rem;
        height: 1.25rem;
        color: #fbbf24;
    }

    .star.empty {
        color: #d1d5db;
    }

    .rating-text {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.875rem;
    }

    .review-content {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .review-actions {
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

    .btn-edit {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .btn-edit:hover {
        background: var(--warning-color);
        color: white;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        background: var(--danger-color);
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
    .btn-new-review:focus,
    .page-link:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* High Contrast Mode Support */
    @media (prefers-contrast: high) {
        .review-card {
            border: 2px solid var(--text-primary);
        }
        
        .status-badge {
            border-width: 2px;
        }
    }

    /* Reduced Motion Support */
    @media (prefers-reduced-motion: reduce) {
        .review-card,
        .action-btn,
        .btn-new-review,
        .page-link {
            transition: none;
        }
        
        .review-card:hover,
        .action-btn:hover,
        .btn-new-review:hover,
        .page-link:hover {
            transform: none;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .reviews-container {
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
        
        .btn-new-review {
            width: 100%;
            justify-content: center;
        }
        
        .review-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .review-badges {
            align-self: flex-start;
        }
        
        .review-actions {
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
        
        .review-card {
            padding: 1rem;
        }
        
        .review-trail {
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
        .reviews-container {
            background: white;
        }
        
        .btn-new-review,
        .review-actions,
        .pagination-wrapper {
            display: none !important;
        }
        
        .review-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid #000;
        }
        
        .status-badge {
            border: 1px solid #000;
            background: transparent !important;
            color: #000 !important;
        }
    }
</style>
@endpush

<x-app-layout>
    <div class="reviews-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                    {{ __('My Reviews') }}
                </h1>
                <a href="{{ route('user.bookings.index') }}" 
                   class="btn-new-review"
                   role="button"
                   aria-label="{{ __('View your bookings to write reviews') }}">
                    <i class="bi bi-calendar-check" aria-hidden="true"></i>
                    {{ __('My Bookings') }}
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

            <!-- Reviews Content -->
            <div class="reviews-card">
                @if($reviews->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-star" aria-hidden="true"></i>
                        <h3>{{ __('No Reviews Yet') }}</h3>
                        <p>{{ __('You haven\'t written any reviews yet. Complete a hike first, then you can write a review from your bookings page.') }}</p>
                        <a href="{{ route('user.bookings.index') }}" 
                           class="btn-new-review"
                           role="button"
                           aria-label="{{ __('View your bookings to write reviews') }}">
                            <i class="bi bi-calendar-check" aria-hidden="true"></i>
                            {{ __('View My Bookings') }}
                        </a>
                    </div>
                @else
                    <div class="p-4">
                        @foreach($reviews as $review)
                            <article class="review-card" role="article">
                                <div class="review-header">
                                    <div class="flex-grow-1">
                                        <h2 class="review-trail">{{ $review->hike->trail }}</h2>
                                        <p class="review-date">
                                            {{ $review->hike->date->format('M d, Y') }} {{ __('at') }} {{ $review->hike->start_time->format('h:i A') }}
                                        </p>
                                    </div>
                                    <div class="review-badges">
                                        @if($review->is_verified)
                                            <span class="status-badge status-verified" role="status" aria-label="{{ __('Review status: Verified') }}">
                                                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                                {{ __('Verified') }}
                                            </span>
                                        @else
                                            <span class="status-badge status-pending" role="status" aria-label="{{ __('Review status: Pending verification') }}">
                                                <i class="bi bi-clock" aria-hidden="true"></i>
                                                {{ __('Pending') }}
                                            </span>
                                        @endif
                                        
                                        @if(!$review->is_public)
                                            <span class="status-badge status-hidden" role="status" aria-label="{{ __('Review visibility: Hidden') }}">
                                                <i class="bi bi-eye-slash" aria-hidden="true"></i>
                                                {{ __('Hidden') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="rating-display">
                                    <div class="stars" role="img" aria-label="{{ __('Rating: :rating out of 5 stars', ['rating' => $review->rating]) }}">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill star {{ $i <= $review->rating ? '' : 'empty' }}" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                    <span class="rating-text">{{ $review->rating }}/5</span>
                                </div>

                                @if($review->review)
                                    <div class="review-content">
                                        {{ Str::limit($review->review, 200) }}
                                    </div>
                                @endif

                                <div class="review-actions">
                                    <a href="{{ route('user.reviews.show', $review) }}" 
                                       class="action-btn btn-view"
                                       role="button"
                                       aria-label="{{ __('View full review for :trail', ['trail' => $review->hike->trail]) }}">
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                        {{ __('View') }}
                                    </a>
                                    
                                    @if(!$review->is_verified)
                                        <a href="{{ route('user.reviews.edit', $review) }}" 
                                           class="action-btn btn-edit"
                                           role="button"
                                           aria-label="{{ __('Edit review for :trail', ['trail' => $review->hike->trail]) }}">
                                            <i class="bi bi-pencil" aria-hidden="true"></i>
                                            {{ __('Edit') }}
                                        </a>
                                        
                                        <form action="{{ route('user.reviews.destroy', $review) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('Are you sure you want to delete this review?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="action-btn btn-delete"
                                                    aria-label="{{ __('Delete review for :trail', ['trail' => $review->hike->trail]) }}">
                                                <i class="bi bi-trash" aria-hidden="true"></i>
                                                {{ __('Delete') }}
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
            @if($reviews->hasPages())
                <div class="pagination-wrapper">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>