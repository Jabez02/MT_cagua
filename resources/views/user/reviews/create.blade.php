<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold">
            {{ __('Write a Review') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <div class="mb-4">
                        <h3 class="fs-5 fw-medium">{{ $hike->trail }}</h3>
                        <p class="text-muted small">
                            {{ $hike->date->format('M d, Y') }} at {{ $hike->start_time->format('h:i A') }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('user.reviews.store', $hike) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="d-flex gap-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}" class="d-none" {{ old('rating') == $i ? 'checked' : '' }}>
                                        <svg class="star-icon text-secondary" 
                                            width="32" height="32" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Review</label>
                            <textarea id="comment" name="comment" rows="4" 
                                class="form-control"
                                placeholder="Share your experience about this hike...">{{ old('comment') }}</textarea>
                            <div class="form-text">
                                Minimum 10 characters. Your review will be visible to others after moderation.
                            </div>
                            @error('comment')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('user.reviews.index') }}" 
                               class="btn btn-light">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .star-icon {
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-icon:hover {
            color: var(--bs-warning) !important;
        }
        input[type="radio"]:checked + .star-icon {
            color: var(--bs-warning) !important;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Add interactivity to star rating
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('input[name="rating"]');
            stars.forEach((star, index) => {
                star.addEventListener('change', () => {
                    const value = star.value;
                    stars.forEach((s, i) => {
                        const svg = s.nextElementSibling;
                        if (i < value) {
                            svg.classList.remove('text-secondary');
                            svg.classList.add('text-warning');
                        } else {
                            svg.classList.remove('text-warning');
                            svg.classList.add('text-secondary');
                        }
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>