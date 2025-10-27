<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fs-3 fw-bold text-primary mb-1">
                    <i class="bi bi-calendar-check me-2"></i>{{ __('My Bookings') }}
                </h1>
                <p class="text-muted mb-0 fs-6">Manage and track your hiking adventures</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('user.bookings.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i>{{ __('Create Booking') }}
                </a>
                <a href="{{ route('hikes.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-list me-1"></i>{{ __('Browse Hikes') }}
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #f6c23e 0%, #e0a800 100%);
            --info-gradient: linear-gradient(135deg, #36b9cc 0%, #1a8a98 100%);
            --danger-gradient: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.12);
            --border-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        .bookings-container {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem 0;
            position: relative;
        }
        
        .bookings-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .modern-card {
            border-radius: var(--border-radius);
            border: 1px solid var(--glass-border);
            transition: var(--transition);
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }
        
        .modern-card:hover {
            box-shadow: var(--card-shadow-hover);
        }
        
        .filter-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.05) 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }
        
        .booking-card {
            border: none;
            border-radius: 16px;
            margin-bottom: 1.5rem;
            transition: var(--transition);
            background: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            position: relative;
        }
        
        .booking-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-gradient);
        }
        
        .booking-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .booking-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .status-badge {
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            text-transform: uppercase;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .status-approved {
            background: var(--success-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
        }
        
        .status-pending {
            background: var(--warning-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(246, 194, 62, 0.3);
        }
        
        .status-completed {
            background: var(--info-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(54, 185, 204, 0.3);
        }
        
        .status-rejected {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }
        
        .status-cancelled {
            background: var(--danger-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .payment-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
            margin-top: 0.5rem;
        }
        
        .action-btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: var(--transition);
            border: none;
            backdrop-filter: blur(10px);
        }
        
        .action-btn:hover {
            transform: translateY(-1px);
        }
        
        .btn-view {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-cancel {
            background: var(--danger-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .btn-review {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }
        
        .btn-reviewed {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            cursor: default;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .btn-reviewed:hover {
            transform: none;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #e9ecef;
            margin-bottom: 1.5rem;
        }
        
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            background: var(--primary-gradient);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            border-bottom: none;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: var(--transition);
            padding: 0.75rem 1rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            outline: none;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            backdrop-filter: blur(20px);
            font-weight: 500;
        }
        
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }
        
        .page-link {
            border-radius: 8px;
            margin: 0 2px;
            border: none;
            color: #667eea;
            font-weight: 500;
        }
        
        .page-link:hover, .page-link:focus {
            background: var(--primary-gradient);
            color: white;
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }
        
        .page-item.active .page-link {
            background: var(--primary-gradient);
            border: none;
        }
        
        /* Focus indicators for accessibility */
        .action-btn:focus, .btn:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }
        
        .status-badge:focus {
            outline: 2px solid currentColor;
            outline-offset: 2px;
        }
        
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .booking-card {
                border: 2px solid #000;
            }
            
            .status-badge {
                border: 2px solid currentColor;
            }
        }
        
        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* Screen reader only content */
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
        
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .page-header h1 {
                font-size: 1.75rem;
            }
            
            .btn-new-booking {
                width: 100%;
                justify-content: center;
            }
            
            .filter-section {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            
            .filter-section .form-select {
                width: 100%;
            }
            
            .booking-card {
                margin-bottom: 1rem;
            }
            
            .booking-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
                padding: 1rem;
            }
            
            .booking-content {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .booking-actions {
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid var(--border-color);
            }
            
            .action-btn {
                font-size: 0.875rem;
                padding: 0.5rem 1rem;
            }
            
            .status-badge, .payment-badge {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
            
            .pagination {
                justify-content: center;
            }
            
            .pagination .page-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.875rem;
            }
        }
        
        @media (max-width: 576px) {
            .container-fluid {
                padding: 0.5rem;
            }
            
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .booking-card {
                padding: 1rem;
            }
            
            .booking-content {
                gap: 0.75rem;
            }
            
            .info-item {
                padding: 0.75rem;
            }
            
            .info-label {
                font-size: 0.75rem;
            }
            
            .info-value {
                font-size: 0.875rem;
            }
            
            .action-btn {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
            
            .modal-dialog {
                margin: 0.5rem;
            }
            
            .modal-content {
                border-radius: 0.5rem;
            }
        }
        
        /* Print Styles */
        @media print {
            .btn-new-booking,
            .filter-section,
            .booking-actions,
            .pagination {
                display: none !important;
            }
            
            .booking-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #000;
                margin-bottom: 1rem;
            }
            
            .status-badge,
            .payment-badge {
                border: 1px solid #000;
                background: transparent !important;
                color: #000 !important;
            }
        }
    </style>

    <div class="bookings-container">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success mb-4 shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div>
                        <h3 class="fs-5 fw-bold text-primary mb-1">
                            <i class="bi bi-funnel me-2"></i>Filter Bookings
                        </h3>
                        <p class="text-muted mb-0 small">Organize your bookings by payment status</p>
                    </div>
                    
                    <form method="GET" action="{{ route('user.bookings.index') }}" class="d-flex align-items-center gap-3">
                        <label for="payment_status" class="form-label mb-0 fw-medium text-nowrap">Payment Status:</label>
                        <select name="payment_status" id="payment_status" 
                            class="form-select form-select-sm"
                            style="min-width: 200px;"
                            onchange="this.form.submit()"
                            aria-label="Filter by payment status">
                            @foreach($paymentStatusOptions as $value => $label)
                                <option value="{{ $value }}" {{ request('payment_status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            <!-- Bookings Grid -->
            <div class="row">
                @forelse($bookings as $booking)
                    <div class="col-12">
                        <div class="booking-card">
                            <div class="booking-header">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-5 fw-bold text-primary mb-1">
                                            <i class="bi bi-geo-alt me-2"></i>
                                            @if($booking->hike)
                                                {{ $booking->hike->trail }}
                                            @else
                                                {{ $booking->trail ?? 'Custom Booking' }}
                                            @endif
                                        </h4>
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            @if($booking->hike)
                                                {{ $booking->hike->date->format('l, F j, Y') }} at {{ $booking->hike->start_time->format('h:i A') }}
                                            @else
                                                {{ $booking->trek_date ? $booking->trek_date->format('l, F j, Y') : 'Date not specified' }}
                                                @if($booking->start_time)
                                                    at {{ $booking->start_time->format('h:i A') }}
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-end">
                                        <div class="fs-4 fw-bold text-success mb-1">₱{{ number_format($booking->total_amount, 2) }}</div>
                                        <small class="text-muted">Total Amount</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <!-- Tourist Information -->
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-people-fill text-primary me-2"></i>
                                            <span class="fw-medium">Participants</span>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            @if($booking->foreign_tourists > 0)
                                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                                    <i class="bi bi-person-fill me-1"></i>{{ $booking->foreign_tourists }} Foreign
                                                </span>
                                            @endif
                                            @if($booking->local_tourists > 0)
                                                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                                    <i class="bi bi-person me-1"></i>{{ $booking->local_tourists }} Local
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Status Information -->
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-flag-fill text-primary me-2"></i>
                                            <span class="fw-medium">Booking Status</span>
                                        </div>
                                        @if($booking->status === 'approved')
                                             <span class="status-badge status-approved" role="status" aria-label="Booking status: Approved">
                                                 <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Approved
                                             </span>
                                         @elseif($booking->status === 'pending')
                                             <span class="status-badge status-pending" role="status" aria-label="Booking status: Pending">
                                                 <i class="bi bi-clock me-1" aria-hidden="true"></i>Pending
                                             </span>
                                         @elseif($booking->status === 'completed')
                                             <span class="status-badge status-completed" role="status" aria-label="Booking status: Completed">
                                                 <i class="bi bi-check-all me-1" aria-hidden="true"></i>Completed
                                             </span>
                                         @elseif($booking->status === 'rejected')
                                             <span class="status-badge status-rejected" role="status" aria-label="Booking status: Rejected">
                                                 <i class="bi bi-x-octagon me-1" aria-hidden="true"></i>Rejected
                                             </span>
                                         @elseif($booking->status === 'cancelled')
                                             <span class="status-badge status-cancelled" role="status" aria-label="Booking status: Cancelled">
                                                 <i class="bi bi-x-circle me-1" aria-hidden="true"></i>Cancelled
                                             </span>
                                         @else
                                             <span class="status-badge status-unknown" role="status" aria-label="Booking status: {{ ucfirst($booking->status) }}">
                                                 <i class="bi bi-question-circle me-1" aria-hidden="true"></i>{{ ucfirst($booking->status) }}
                                             </span>
                                         @endif
                                    </div>
                                    
                                    <!-- Payment Status -->
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-credit-card-fill text-primary me-2"></i>
                                            <span class="fw-medium">Payment</span>
                                        </div>
                                        @if($booking->payments->isNotEmpty())
                                            @if($booking->payments->first()->refunded)
                                                <span class="payment-badge bg-secondary text-white" role="status" aria-label="Payment status: Refunded">
                                                    <i class="bi bi-arrow-counterclockwise me-1" aria-hidden="true"></i>Refunded
                                                </span>
                                            @elseif($booking->payments->first()->verified_at)
                                                <span class="payment-badge bg-success text-white" role="status" aria-label="Payment status: Verified">
                                                    <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Verified
                                                </span>
                                            @else
                                                <span class="payment-badge bg-warning text-white" role="status" aria-label="Payment status: Pending">
                                                    <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Pending
                                                </span>
                                            @endif
                                        @else
                                            <span class="payment-badge bg-light text-dark" role="status" aria-label="Payment status: No payment">
                                                <i class="bi bi-dash-circle me-1" aria-hidden="true"></i>No Payment
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-gear-fill text-primary me-2"></i>
                                            <span class="fw-medium">Actions</span>
                                        </div>
                                        <div class="d-flex flex-column gap-2">
                                            <a href="{{ route('user.bookings.show', $booking) }}" 
                                               class="action-btn btn-view text-decoration-none text-center"
                                               role="button"
                                               aria-label="View details for {{ $booking->hike ? $booking->hike->trail : 'Custom' }} booking">
                                                <i class="bi bi-eye me-1" aria-hidden="true"></i>View Details
                                            </a>
                                            @if($booking->status === 'completed' && $booking->hike)
                                                @php
                                                    $hasReviewed = $booking->user->reviews()->where('hike_id', $booking->hike->id)->exists();
                                                @endphp
                                                @if(!$hasReviewed)
                                                    <a href="{{ route('user.reviews.create', $booking->hike) }}" 
                                                       class="action-btn btn-review text-decoration-none text-center"
                                                       role="button"
                                                       aria-label="Write review for {{ $booking->hike->trail }}">
                                                        <i class="bi bi-star me-1" aria-hidden="true"></i>Write Review
                                                    </a>
                                                @else
                                                    <span class="action-btn btn-reviewed text-center">
                                                        <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Reviewed
                                                    </span>
                                                @endif
                                            @endif
                                            @if(in_array($booking->status, ['pending', 'approved']))
                                                <button type="button" 
                                                        class="action-btn btn-cancel"
                                                        onclick="showCancelModal('{{ $booking->id }}')"
                                                        aria-label="Cancel booking for {{ $booking->hike ? $booking->hike->trail : 'Custom' }}">
                                                    <i class="bi bi-x-lg me-1" aria-hidden="true"></i>Cancel Booking
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-calendar-x"></i>
                            </div>
                            <h3 class="fs-4 fw-bold text-muted mb-3">No Bookings Found</h3>
                            <p class="text-muted mb-4">You haven't made any bookings yet. Start exploring our amazing hiking trails!</p>
                            <a href="{{ route('hikes.index') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                                <i class="bi bi-plus-lg me-2"></i>Book Your First Hike
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

                    <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $bookings->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <!-- Cancel Booking Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="cancelModalLabel">
                        <i class="bi bi-exclamation-triangle me-2"></i>Cancel Booking
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="cancelForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body p-4">
                        <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <div>
                                <strong>Important:</strong> This action cannot be undone. Please provide a reason for cancellation.
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="cancellation_reason" class="form-label fw-medium">
                                <i class="bi bi-chat-text me-1"></i>Reason for Cancellation <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" 
                                      id="cancellation_reason" 
                                      name="cancellation_reason" 
                                      rows="4" 
                                      placeholder="Please explain why you're cancelling this booking..."
                                      required
                                      aria-describedby="reasonHelp"></textarea>
                            <div id="reasonHelp" class="form-text">
                                <i class="bi bi-lightbulb me-1"></i>
                                This information helps us improve our services and may be used for refund processing.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg me-1"></i>Keep Booking
                        </button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="bi bi-check-lg me-1"></i>Confirm Cancellation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showCancelModal(bookingId) {
            const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
            const form = document.getElementById('cancelForm');
            form.action = `/user/bookings/${bookingId}/cancel`;
            
            // Clear previous input
            document.getElementById('cancellation_reason').value = '';
            
            // Show modal
            modal.show();
            
            // Focus on textarea when modal is shown
            document.getElementById('cancelModal').addEventListener('shown.bs.modal', function () {
                document.getElementById('cancellation_reason').focus();
            });
        }

        function hideCancelModal() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('cancelModal'));
            if (modal) {
                modal.hide();
            }
        }

        // Add form validation
        document.getElementById('cancelForm').addEventListener('submit', function(e) {
            const reason = document.getElementById('cancellation_reason').value.trim();
            if (reason.length < 10) {
                e.preventDefault();
                alert('Please provide a more detailed reason for cancellation (at least 10 characters).');
                document.getElementById('cancellation_reason').focus();
            }
        });

        // Auto-resize textarea
        document.getElementById('cancellation_reason').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    </script>
</x-app-layout>