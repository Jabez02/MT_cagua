@extends('layouts.admin')

@section('content')
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --border-radius-sm: 0.375rem;
            --border-radius-md: 0.5rem;
            --border-radius-lg: 0.75rem;
            --spacing-xs: 0.5rem;
            --spacing-sm: 0.75rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
        }

        .dashboard-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding: var(--spacing-lg) 0;
        }

        .page-header {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .page-title i {
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .user-banner {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 2rem;
            box-shadow: var(--shadow-md);
        }

        .user-info h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--spacing-xs);
        }

        .user-meta {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            flex-wrap: wrap;
        }

        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-approved {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: var(--success-color);
            border: 1px solid #a7f3d0;
        }

        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: var(--warning-color);
            border: 1px solid #fcd34d;
        }

        .status-rejected {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: var(--danger-color);
            border: 1px solid #fca5a5;
        }

        .verification-badge {
            padding: 0.25rem 0.5rem;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            font-size: 0.75rem;
        }

        .verified {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: var(--primary-color);
        }

        .unverified {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: var(--text-secondary);
        }

        .info-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            overflow: hidden;
            margin-bottom: var(--spacing-xl);
        }

        .info-card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            padding: var(--spacing-lg) var(--spacing-xl);
            border-bottom: 1px solid var(--border-color);
        }

        .info-card-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .info-card-body {
            padding: var(--spacing-xl);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-lg);
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            text-align: center;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: var(--spacing-xs);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .data-table-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            overflow: hidden;
            margin-bottom: var(--spacing-xl);
        }

        .table-header {
            background: var(--light-bg);
            padding: var(--spacing-lg) var(--spacing-xl);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .table-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .table-title i {
            color: var(--primary-color);
        }

        .table-count {
            font-size: 0.875rem;
            color: var(--text-muted);
            background: var(--card-bg);
            padding: 0.25rem 0.75rem;
            border-radius: var(--border-radius-sm);
            border: 1px solid var(--border-color);
        }

        .table {
            margin: 0;
        }

        .table th {
            background: var(--light-bg);
            color: var(--text-primary);
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            padding: var(--spacing-lg);
        }

        .table td {
            padding: var(--spacing-lg);
            border-color: var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: var(--light-bg);
        }

        .booking-status {
            padding: 0.25rem 0.75rem;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .booking-completed {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: var(--success-color);
        }

        .booking-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: var(--warning-color);
        }

        .booking-cancelled {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: var(--danger-color);
        }

        .action-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .action-card-header {
            background: var(--light-bg);
            padding: var(--spacing-lg) var(--spacing-xl);
            border-bottom: 1px solid var(--border-color);
        }

        .action-card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .action-card-body {
            padding: var(--spacing-xl);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #047857 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #b45309 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #b91c1c 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-secondary {
            background: var(--card-bg);
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--light-bg);
            border-color: var(--secondary-color);
            color: var(--text-primary);
            transform: translateY(-1px);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .btn-grid {
            display: grid;
            gap: var(--spacing-sm);
        }

        .btn-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-sm);
        }

        .empty-state {
            text-align: center;
            padding: var(--spacing-xl);
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--text-muted);
            margin-bottom: var(--spacing-md);
        }

        .alert {
            border-radius: var(--border-radius-md);
            border: none;
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .modal-content {
            border-radius: var(--border-radius-lg);
            border: none;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            background: var(--light-bg);
            border-bottom: 1px solid var(--border-color);
            border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
        }

        .modal-title {
            font-weight: 600;
            color: var(--text-primary);
        }

        .modal-footer {
            background: var(--light-bg);
            border-top: 1px solid var(--border-color);
            border-radius: 0 0 var(--border-radius-lg) var(--border-radius-lg);
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: var(--spacing-md) 0;
            }
            
            .page-header, .info-card-body, .user-banner, .action-card-body {
                padding: var(--spacing-lg);
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .btn-row {
                grid-template-columns: 1fr;
            }
            
            .user-avatar {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .user-info h2 {
                font-size: 1.25rem;
            }
        }
    </style>

    <div class="dashboard-container">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="page-title">
                        <i class="bi bi-person-circle"></i>
                        User Details
                    </h1>
                    <a href="{{ route('admin.manage-user.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Back to Users
                    </a>
                </div>
            </div>

            <!-- User Banner -->
            <div class="user-banner">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-4">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="user-info">
                            <h2>{{ $user->name }}</h2>
                            <div class="user-meta">
                                <span class="status-badge status-{{ $user->status }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                                <span class="verification-badge {{ $user->email_verified_at ? 'verified' : 'unverified' }}">
                                    <i class="bi bi-{{ $user->email_verified_at ? 'check-circle' : 'clock' }} me-1"></i>
                                    {{ $user->email_verified_at ? 'Verified Email' : 'Unverified Email' }}
                                </span>
                                <span class="text-muted">Member since {{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $user->bookings->count() }}</div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $user->bookings->where('status', 'completed')->count() }}</div>
                    <div class="stat-label">Completed Bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">₱{{ number_format($user->bookings->sum('total_amount'), 2) }}</div>
                    <div class="stat-label">Total Spent</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $user->reviews->count() }}</div>
                    <div class="stat-label">Reviews</div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Left Column: User Information -->
                <div class="col-lg-8">
                    <!-- Basic Information -->
                    <div class="info-card">
                        <div class="info-card-header">
                            <h3 class="info-card-title">
                                <i class="bi bi-person-badge"></i>
                                Basic Information
                            </h3>
                        </div>
                        <div class="info-card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Full Name</div>
                                    <div class="info-value">{{ $user->name }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Email Address</div>
                                    <div class="info-value">{{ $user->email }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Contact Number</div>
                                    <div class="info-value">{{ $user->contact_number ?? '—' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Address</div>
                                    <div class="info-value">{{ $user->address ?? '—' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Nationality</div>
                                    <div class="info-value">{{ $user->nationality ? ucfirst($user->nationality) : '—' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact Information -->
                    <div class="info-card">
                        <div class="info-card-header">
                            <h3 class="info-card-title">
                                <i class="bi bi-telephone-plus"></i>
                                Emergency Contact
                            </h3>
                        </div>
                        <div class="info-card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Contact Name</div>
                                    <div class="info-value">{{ $user->emergency_contact_name ?? '—' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Contact Number</div>
                                    <div class="info-value">{{ $user->emergency_contact_number ?? '—' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking History -->
                    <div class="data-table-card">
                        <div class="table-header">
                            <h3 class="table-title">
                                <i class="bi bi-calendar-check"></i>
                                Booking History
                            </h3>
                            <span class="table-count">{{ $user->bookings->count() }} total</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Trail</th>
                                        <th>Participants</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($user->bookings as $booking)
                                        <tr>
                                            <td><strong>{{ $booking->hike?->date?->format('M d, Y') ?? '—' }}</strong></td>
                                            <td>{{ $booking->hike?->trail ?? '—' }}</td>
                                            <td><strong>{{ (int) $booking->foreign_tourists + (int) $booking->local_tourists }}</strong></td>
                                            <td>
                                                <span class="booking-status booking-{{ $booking->status }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td><strong>₱{{ number_format($booking->total_amount, 2) }}</strong></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="empty-state">
                                                <i class="bi bi-calendar-x"></i>
                                                <h5>No bookings found</h5>
                                                <p class="text-muted mb-0">This user has not made any bookings yet.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Actions -->
                <div class="col-lg-4">
                    <div class="action-card">
                        <div class="action-card-header">
                            <h3 class="action-card-title">
                                <i class="bi bi-gear"></i>
                                Account Actions
                            </h3>
                        </div>
                        <div class="action-card-body">
                            <div class="btn-grid">
                                <div class="btn-row">
                                    <form action="{{ route('admin.manage-user.approve', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success w-100" {{ $user->status === 'approved' ? 'disabled' : '' }}>
                                            <i class="bi bi-check-circle"></i>
                                            Approve
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-warning w-100" {{ $user->status === 'rejected' ? 'disabled' : '' }} data-bs-toggle="modal" data-bs-target="#confirmRejectModal">
                                        <i class="bi bi-x-circle"></i>
                                        Reject
                                    </button>
                                </div>
                                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                    <i class="bi bi-trash"></i>
                                    Delete User
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reject Confirmation Modal -->
            <div class="modal fade" id="confirmRejectModal" tabindex="-1" aria-labelledby="confirmRejectLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmRejectLabel">
                                <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                                Confirm Rejection
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-3">Are you sure you want to reject this user account?</p>
                            <div class="alert alert-warning">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Note:</strong> This action will prevent the user from accessing their account and making bookings.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x"></i>
                                Cancel
                            </button>
                            <form action="{{ route('admin.manage-user.reject', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-x-circle"></i>
                                    Reject User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteLabel">
                                <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                                Confirm Deletion
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-3">Are you sure you want to permanently delete this user account?</p>
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Warning:</strong> This action cannot be undone. All user data, including bookings and reviews, will be permanently deleted.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x"></i>
                                Cancel
                            </button>
                            <form action="{{ route('admin.manage-user.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                    Delete User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
@endsection