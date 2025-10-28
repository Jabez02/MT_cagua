@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Session Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary me-3">
                        <i class="bi bi-arrow-left me-2"></i>Back to Reviews
                    </a>
                    <div>
                        <h1 class="h3 mb-1">Review Details</h1>
                        <p class="text-muted mb-0">Manage customer review</p>
                    </div>
                </div>
            </div>

            <!-- Review Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="card-title mb-1">{{ $review->booking->trail ?? 'N/A' }}</h4>
                            <p class="text-muted mb-0">
                                <i class="bi bi-calendar me-2"></i>{{ $review->booking->trek_date->format('M d, Y') }} 
                                <i class="bi bi-clock ms-3 me-2"></i>{{ $review->booking->start_time->format('h:i A') }}
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-flex flex-wrap justify-content-md-end gap-2">
                                @if($review->is_verified)
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>Verified
                                    </span>
                                @else
                                    <span class="badge bg-warning">
                                        <i class="bi bi-clock me-1"></i>Pending
                                    </span>
                                @endif
                                
                                @if($review->is_public)
                                    <span class="badge bg-info">
                                        <i class="bi bi-eye me-1"></i>Public
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-eye-slash me-1"></i>Hidden
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- User Information -->
                        <div class="col-lg-6 mb-4">
                            <h5 class="border-bottom pb-2 mb-3">
                                <i class="bi bi-person me-2"></i>User Information
                            </h5>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label text-muted">Name</label>
                                    <p class="fw-medium">{{ $review->user->name }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label text-muted">Email</label>
                                    <p class="fw-medium">{{ $review->user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="col-lg-6 mb-4">
                            <h5 class="border-bottom pb-2 mb-3">
                                <i class="bi bi-star me-2"></i>Rating
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : ' text-muted' }}"></i>
                                    @endfor
                                </div>
                                <span class="badge bg-primary fs-6">{{ $review->rating }}/5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Review Content -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3">
                            <i class="bi bi-chat-text me-2"></i>Review Content
                        </h5>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    </div>

                    <!-- Review Images -->
                    @if($review->images && count($review->images) > 0)
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3">
                            <i class="bi bi-images me-2"></i>Review Images
                        </h5>
                        <div class="row g-3">
                            @foreach($review->images as $image)
                            <div class="col-md-4 col-lg-3">
                                <div class="card">
                                    <img src="{{ Storage::url($image) }}" class="card-img-top" alt="Review Image" style="height: 200px; object-fit: cover;">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Review Information -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3">
                            <i class="bi bi-info-circle me-2"></i>Review Information
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Submitted</label>
                                <p class="fw-medium">
                                    <i class="bi bi-calendar-event me-2"></i>{{ $review->created_at->format('M d, Y h:i A') }}
                                </p>
                            </div>
                            @if($review->is_verified && $review->moderator)
                                <div class="col-md-3">
                                    <label class="form-label text-muted">Verified By</label>
                                    <p class="fw-medium">
                                        <i class="bi bi-person-check me-2"></i>{{ $review->moderator->name }}
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-muted">Verified At</label>
                                    <p class="fw-medium">
                                        <i class="bi bi-calendar-check me-2"></i>{{ $review->moderated_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card-footer bg-white">
                    <div class="d-flex flex-wrap gap-2 justify-content-between">
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Reviews
                        </a>
                        
                        <div class="d-flex flex-wrap gap-2">
                            @if(!$review->is_verified)
                                <form action="{{ route('admin.reviews.verify', $review) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle me-2"></i>Verify Review
                                    </button>
                                </form>
                            @endif

                            @if($review->is_public)
                                <form action="{{ route('admin.reviews.hide', $review) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">
                                        <i class="bi bi-eye-slash me-2"></i>Hide Review
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.reviews.publish', $review) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info">
                                        <i class="bi bi-eye me-2"></i>Publish Review
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this review?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-2"></i>Delete Review
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection