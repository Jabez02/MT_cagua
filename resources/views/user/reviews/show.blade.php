@push('styles')
<style>
    .review-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 2rem;
        margin: -1.5rem -1.5rem 2rem -1.5rem;
    }

    .booking-card {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .booking-card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .trail-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .booking-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .meta-icon {
        width: 16px;
        height: 16px;
        color: #007bff;
    }

    .rating-section {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    .rating-display {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin: 1rem 0;
    }

    .star-icon {
        width: 32px;
        height: 32px;
        transition: all 0.2s ease;
    }

    .star-filled {
        color: #ffc107;
        filter: drop-shadow(0 2px 4px rgba(255,193,7,0.3));
    }

    .star-empty {
        color: #dee2e6;
    }

    .rating-text {
        font-size: 1.1rem;
        font-weight: 500;
        color: #495057;
        margin-top: 0.5rem;
    }

    .review-content {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .review-text {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #495057;
        margin: 0;
    }

    .image-gallery {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .gallery-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .info-section {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .info-item {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #007bff;
    }

    .info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 500;
        color: #495057;
        margin: 0;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-icon {
        width: 20px;
        height: 20px;
        color: #007bff;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-enhanced {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        border: none;
    }

    .btn-back:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108,117,125,0.3);
    }

    .btn-edit {
        background: #007bff;
        color: white;
        border: none;
    }

    .btn-edit:hover {
        background: #0056b3;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
    }

    .status-badges {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .badge-enhanced {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    @media (max-width: 768px) {
        .review-header {
            padding: 1.5rem;
            margin: -1rem -1rem 1.5rem -1rem;
        }

        .booking-meta {
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }
</style>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-body">
            {{ __('Review Details') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="review-header">
                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                        <div>
                            <h1 class="h3 mb-2 fw-bold">{{ __('Your Review') }}</h1>
                            <p class="mb-0 opacity-75">{{ __('Review details and information') }}</p>
                        </div>
                        <div class="status-badges">
                            <span class="badge-enhanced {{ $review->is_verified ? 'bg-success' : 'bg-warning text-dark' }}">
                                <i class="fas {{ $review->is_verified ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                                {{ $review->is_verified ? __('Verified') : __('Pending') }}
                            </span>
                            @if(!$review->is_public)
                                <span class="badge-enhanced bg-secondary">
                                    <i class="fas fa-eye-slash me-1"></i>
                                    {{ __('Hidden') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Booking Details Card -->
                    <div class="booking-card">
                        <h3 class="trail-title">
                            <i class="fas fa-mountain text-primary me-2"></i>
                            {{ $review->booking->trail }}
                        </h3>
                        <div class="booking-meta">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt meta-icon"></i>
                                <span>{{ \Carbon\Carbon::parse($review->booking->trek_date)->format('M d, Y') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-clock meta-icon"></i>
                                <span>{{ \Carbon\Carbon::parse($review->booking->start_time)->format('h:i A') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-users meta-icon"></i>
                                <span>{{ $review->booking->number_of_participants }} {{ __('participants') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-hashtag meta-icon"></i>
                                <span>{{ __('Booking') }} #{{ $review->booking->id }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Rating Section -->
                    <div class="rating-section">
                        <h4 class="section-title justify-content-center">
                            <i class="fas fa-star section-icon"></i>
                            {{ __('Your Rating') }}
                        </h4>
                        <div class="rating-display">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star star-icon {{ $i <= $review->rating ? 'star-filled' : 'star-empty' }}"></i>
                            @endfor
                        </div>
                        <div class="rating-text">
                            {{ $review->rating }}/5 - 
                            @if($review->rating == 5)
                                {{ __('Excellent') }}
                            @elseif($review->rating == 4)
                                {{ __('Very Good') }}
                            @elseif($review->rating == 3)
                                {{ __('Good') }}
                            @elseif($review->rating == 2)
                                {{ __('Fair') }}
                            @else
                                {{ __('Poor') }}
                            @endif
                        </div>
                    </div>

                    <!-- Review Content -->
                    <div class="review-content">
                        <h4 class="section-title">
                            <i class="fas fa-comment-alt section-icon"></i>
                            {{ __('Your Review') }}
                        </h4>
                        <p class="review-text">{{ $review->comment }}</p>
                    </div>

                    <!-- Image Gallery -->
                    @if($review->images && count($review->images) > 0)
                        <div class="image-gallery">
                            <h4 class="section-title">
                                <i class="fas fa-images section-icon"></i>
                                {{ __('Photos') }}
                            </h4>
                            <div class="gallery-grid">
                                @foreach($review->images as $image)
                                    <div class="gallery-item" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ Storage::url($image) }}">
                                        <img src="{{ Storage::url($image) }}" alt="{{ __('Review Photo') }}" class="gallery-image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Review Information -->
                    <div class="info-section">
                        <h4 class="section-title">
                            <i class="fas fa-info-circle section-icon"></i>
                            {{ __('Review Information') }}
                        </h4>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">{{ __('Submitted') }}</div>
                                <div class="info-value">{{ $review->created_at->format('M d, Y h:i A') }}</div>
                            </div>
                            @if($review->updated_at != $review->created_at)
                                <div class="info-item">
                                    <div class="info-label">{{ __('Last Updated') }}</div>
                                    <div class="info-value">{{ $review->updated_at->format('M d, Y h:i A') }}</div>
                                </div>
                            @endif
                            @if($review->is_verified)
                                <div class="info-item">
                                    <div class="info-label">{{ __('Verified By') }}</div>
                                    <div class="info-value">{{ $review->moderator->name }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">{{ __('Verified At') }}</div>
                                    <div class="info-value">{{ $review->moderated_at->format('M d, Y h:i A') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <a href="{{ route('user.reviews.index') }}" class="btn-enhanced btn-back">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('Back to Reviews') }}
                        </a>
                        @if(!$review->is_verified)
                            <a href="{{ route('user.reviews.edit', $review) }}" class="btn-enhanced btn-edit">
                                <i class="fas fa-edit"></i>
                                {{ __('Edit Review') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ __('Review Photo') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="{{ __('Review Photo') }}" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    // Image modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        
        if (imageModal) {
            imageModal.addEventListener('show.bs.modal', function(event) {
                const trigger = event.relatedTarget;
                const imageSrc = trigger.getAttribute('data-image');
                modalImage.src = imageSrc;
            });
        }
    });
</script>
@endpush