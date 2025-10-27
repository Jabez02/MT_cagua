@push('styles')
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
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="fs-5 fw-medium text-body">{{ $review->hike->trail }}</h3>
                                <p class="text-muted small">
                                    {{ $review->hike->date->format('M d, Y') }} {{ __('at') }} {{ $review->hike->start_time->format('h:i A') }}
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <span class="badge {{ $review->is_verified ? 'bg-success' : 'bg-warning' }}">
                                    {{ $review->is_verified ? __('Verified') : __('Pending') }}
                                </span>
                                @if(!$review->is_public)
                                    <span class="badge bg-secondary">{{ __('Hidden') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 py-6">
                        <div class="mb-4">
                            <h4 class="section-title">{{ __('Rating') }}</h4>
                            <div class="mt-1 flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-4">
                            <h4 class="section-title">{{ __('Your Review') }}</h4>
                            <p class="section-content">{{ $review->comment }}</p>
                        </div>

                        <div class="mb-4">
                            <h4 class="section-title">{{ __('Review Information') }}</h4>
                            <dl class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                <div>
                                    <dt class="info-label">{{ __('Submitted') }}</dt>
                                    <dd class="info-value">{{ $review->created_at->format('M d, Y h:i A') }}</dd>
                                </div>
                                @if($review->is_verified)
                                    <div>
                                        <dt class="info-label">{{ __('Verified By') }}</dt>
                                        <dd class="info-value">{{ $review->moderator->name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="info-label">{{ __('Verified At') }}</dt>
                                        <dd class="info-value">{{ $review->moderated_at->format('M d, Y h:i A') }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <a href="{{ route('user.reviews.index') }}" class="btn-back">{{ __('Back to Reviews') }}</a>
                            @if(!$review->is_verified)
                                <a href="{{ route('user.reviews.edit', $review) }}" class="btn-edit">{{ __('Edit Review') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>