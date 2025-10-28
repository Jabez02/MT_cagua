<x-app-layout>
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            --light-bg: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.95);
            --border-color: rgba(226, 232, 240, 0.8);
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --border-radius: 12px;
            --border-radius-sm: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dashboard-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .page-header {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--info-color));
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .filters-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
        }

        .filters-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filters-title i {
            color: var(--primary-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-sm);
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .btn {
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #2563eb);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .data-table-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .table-title i {
            color: var(--primary-color);
        }

        .table {
            margin: 0;
            background: transparent;
        }

        .table thead th {
            background: rgba(248, 250, 252, 0.8);
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table tbody td {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-color);
            vertical-align: middle;
            color: var(--text-primary);
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: rgba(59, 130, 246, 0.05);
        }

        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-approved {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .status-rejected {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .rating-stars {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .rating-stars i {
            color: #fbbf24;
            font-size: 1rem;
        }

        .rating-number {
            margin-left: 0.5rem;
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .comment-preview {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--text-secondary);
            font-style: italic;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--info-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
            border-radius: var(--border-radius-sm);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-success {
            border: 2px solid var(--success-color);
            color: var(--success-color);
            background: transparent;
        }

        .btn-outline-success:hover {
            background: var(--success-color);
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-danger {
            border: 2px solid var(--danger-color);
            color: var(--danger-color);
            background: transparent;
        }

        .btn-outline-danger:hover {
            background: var(--danger-color);
            color: white;
            transform: translateY(-1px);
        }

        .pagination-wrapper {
            padding: 1.5rem 2rem;
            background: rgba(248, 250, 252, 0.5);
            border-top: 1px solid var(--border-color);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--text-secondary);
        }

        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-bottom: 1px solid var(--border-color);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .modal-title {
            color: var(--text-primary);
            font-weight: 600;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            background: rgba(248, 250, 252, 0.5);
            border-top: 1px solid var(--border-color);
            border-radius: 0 0 var(--border-radius) var(--border-radius);
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem 0;
            }
            
            .page-header {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .filters-card {
                padding: 1.5rem;
            }
            
            .table-responsive {
                border-radius: var(--border-radius-sm);
            }
        }
    </style>

    <div class="dashboard-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-star"></i>
                    Manage Reviews
                </h1>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $reviews->where('is_verified', true)->count() }}</div>
                    <div class="stat-label">Approved Reviews</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $reviews->where('is_verified', false)->where('status', '!=', 'rejected')->count() }}</div>
                    <div class="stat-label">Pending Reviews</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $reviews->where('status', 'rejected')->count() }}</div>
                    <div class="stat-label">Rejected Reviews</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ number_format($reviews->avg('rating'), 1) }}</div>
                    <div class="stat-label">Average Rating</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-card">
                <h3 class="filters-title">
                    <i class="bi bi-funnel"></i>
                    Filter Reviews
                </h3>
                <form method="GET" action="{{ route('admin.reviews.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search reviews..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-select">
                            <option value="">All Ratings</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i>
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Reviews Table -->
            <div class="data-table-card">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="bi bi-table"></i>
                        Reviews List
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Hike</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <strong>{{ $review->user->name }}</strong>
                                    </div>
                                </td>
                                <td><strong>{{ $review->booking->trail ?? 'N/A' }}</strong></td>
                                <td>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                        <span class="rating-number">{{ $review->rating }}/5</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="comment-preview" title="{{ $review->comment }}">
                                        {{ Str::limit($review->comment, 50) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ 
                                        $review->is_verified ? 'approved' : 
                                        ($review->status === 'rejected' ? 'rejected' : 'pending')
                                    }}">
                                        {{ $review->is_verified ? 'Approved' : 
                                           ($review->status === 'rejected' ? 'Rejected' : 'Pending')
                                        }}
                                    </span>
                                </td>
                                <td><strong>{{ $review->created_at->format('M d, Y') }}</strong></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if(!$review->is_verified && $review->status !== 'rejected')
                                        <form action="{{ route('admin.reviews.verify', $review->id) }}" method="POST" class="d-inline approve-form">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Approve Review">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $review->id }}" title="Reject Review">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        @endif
                                    </div>

                                    <!-- Reject Modal -->
                                    @if(!$review->is_verified && $review->status !== 'rejected')
                                    <div class="modal fade" id="rejectModal{{ $review->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $review->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel{{ $review->id }}">Reject Review</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST" class="reject-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="rejection_reason{{ $review->id }}" class="form-label">Reason for Rejection</label>
                                                            <textarea name="rejection_reason" id="rejection_reason{{ $review->id }}" class="form-control" rows="3" placeholder="Please provide a reason for rejecting this review..." required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Reject Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="bi bi-star"></i>
                                    <h5>No reviews found</h5>
                                    <p class="text-muted mb-3">No reviews match your current filters.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($reviews->hasPages())
                <div class="pagination-wrapper">
                    <div class="d-flex justify-content-center">
                        {{ $reviews->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add loading state to buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn && !form.classList.contains('approve-form') && !form.classList.contains('reject-form')) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Processing...';
                }
            });
        });

        // Add confirmation for approve actions
        document.querySelectorAll('.approve-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to approve this review?')) {
                    e.preventDefault();
                }
            });
        });

        // Add loading state for reject forms
        document.querySelectorAll('.reject-form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Rejecting...';
                }
            });
        });
    </script>
    @endpush
</x-app-layout>