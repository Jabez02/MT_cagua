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

        .status-open {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-full {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .status-closed {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        .difficulty-easy {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .difficulty-moderate {
            background: rgba(6, 182, 212, 0.1);
            color: #0891b2;
            border: 1px solid rgba(6, 182, 212, 0.2);
        }

        .difficulty-hard {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .difficulty-extreme {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
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

        .btn-outline-secondary {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: var(--secondary-color);
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

        .capacity-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .capacity-bar {
            width: 60px;
            height: 6px;
            background: rgba(226, 232, 240, 0.5);
            border-radius: 3px;
            overflow: hidden;
        }

        .capacity-fill {
            height: 100%;
            border-radius: 3px;
            transition: var(--transition);
        }

        .capacity-low {
            background: var(--success-color);
        }

        .capacity-medium {
            background: var(--warning-color);
        }

        .capacity-high {
            background: var(--danger-color);
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
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <h1 class="page-title">
                        <i class="bi bi-mountain"></i>
                        Manage Hikes
                    </h1>
                    <a href="{{ route('admin.hikes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        Add New Hike
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $hikes->where('status', 'open')->count() }}</div>
                    <div class="stat-label">Open Hikes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $hikes->where('status', 'full')->count() }}</div>
                    <div class="stat-label">Full Hikes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $hikes->sum('current_bookings') }}</div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">₱{{ number_format($hikes->sum('price'), 0) }}</div>
                    <div class="stat-label">Total Value</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-card">
                <h3 class="filters-title">
                    <i class="bi bi-funnel"></i>
                    Filter Hikes
                </h3>
                <form method="GET" action="{{ route('admin.hikes.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search hikes..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="difficulty" class="form-label">Difficulty</label>
                        <select name="difficulty" id="difficulty" class="form-select">
                            <option value="">All Difficulties</option>
                            <option value="easy" {{ request('difficulty') === 'easy' ? 'selected' : '' }}>Easy</option>
                            <option value="moderate" {{ request('difficulty') === 'moderate' ? 'selected' : '' }}>Moderate</option>
                            <option value="hard" {{ request('difficulty') === 'hard' ? 'selected' : '' }}>Hard</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="full" {{ request('status') === 'full' ? 'selected' : '' }}>Full</option>
                            <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
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

            <!-- Hikes Table -->
            <div class="data-table-card">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="bi bi-table"></i>
                        Hikes List
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>Trail</th>
                                <th>Capacity</th>
                                <th>Price</th>
                                <th>Difficulty</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hikes as $hike)
                            <tr>
                                <td><strong>{{ $hike->date->format('M d, Y') }}</strong></td>
                                <td>{{ $hike->start_time->format('h:i A') }}</td>
                                <td>{{ $hike->trail }}</td>
                                <td>
                                    <div class="capacity-indicator">
                                        <span class="text-muted">{{ $hike->current_bookings }}/{{ $hike->capacity }}</span>
                                        <div class="capacity-bar">
                                            @php
                                                $percentage = $hike->capacity > 0 ? ($hike->current_bookings / $hike->capacity) * 100 : 0;
                                                $fillClass = $percentage < 50 ? 'capacity-low' : ($percentage < 80 ? 'capacity-medium' : 'capacity-high');
                                            @endphp
                                            <div class="capacity-fill {{ $fillClass }}" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>₱{{ number_format($hike->price, 2) }}</strong></td>
                                <td>
                                    <span class="status-badge difficulty-{{ $hike->difficulty }}">
                                        {{ ucfirst($hike->difficulty) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $hike->status }}">
                                        {{ ucfirst($hike->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.hikes.show', $hike->id) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.hikes.edit', $hike->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit Hike">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.hikes.destroy', $hike->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Hike">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="empty-state">
                                    <i class="bi bi-mountain"></i>
                                    <h5>No hikes found</h5>
                                    <p class="text-muted mb-3">No hikes match your current filters.</p>
                                    <a href="{{ route('admin.hikes.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i>
                                        Create Your First Hike
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($hikes->hasPages())
                <div class="pagination-wrapper">
                    <div class="d-flex justify-content-center">
                        {{ $hikes->links() }}
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
                if (submitBtn && !form.classList.contains('delete-form')) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Processing...';
                }
            });
        });

        // Add confirmation for delete actions
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this hike? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>