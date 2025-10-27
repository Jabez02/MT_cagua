<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold text-body mb-0">
            {{ __('Announcement Details') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-column gap-4">
                        <!-- Title -->
                        <div>
                            <h3 class="fs-3 fw-bold">{{ $announcement->title }}</h3>
                        </div>

                        <!-- Meta Information -->
                        <div class="d-flex flex-wrap gap-3 text-muted small">
                            <div class="d-flex align-items-center">
                                <span class="badge 
                                    {{ $announcement->type === 'emergency' ? 'bg-danger' : 
                                       ($announcement->type === 'weather' ? 'bg-primary' : 
                                       ($announcement->type === 'trail' ? 'bg-success' : 
                                       'bg-secondary')) }}">
                                    {{ ucfirst($announcement->type) }}
                                </span>
                            </div>
                            <div>
                                <span class="fw-semibold">{{ __('Posted by:') }}</span>
                                {{ $announcement->creator->name }}
                            </div>
                            <div>
                                <span class="fw-semibold">{{ __('Posted:') }}</span>
                                {{ $announcement->created_at->format('M d, Y H:i') }}
                            </div>
                            @if($announcement->expires_at)
                                <div>
                                    <span class="fw-semibold">{{ __('Expires:') }}</span>
                                    {{ $announcement->expires_at->format('M d, Y H:i') }}
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="announcement-content">
                            {!! nl2br(e($announcement->content)) !!}
                        </div>

                        <!-- Back Link -->
                        <div class="mt-4">
                            <a href="{{ route('user.announcements.index') }}" class="text-primary text-decoration-none">
                                ← {{ __('Back to Announcements') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>