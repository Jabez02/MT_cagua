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
        }

        .content-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-body {
            padding: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .badge-info {
            background: rgba(6, 182, 212, 0.1);
            color: var(--info-color);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: var(--border-radius-sm);
            border: 1px solid var(--border-color);
        }

        .info-label {
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1.125rem;
            color: var(--text-primary);
            font-weight: 600;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background: var(--light-bg);
            font-weight: 600;
            color: var(--text-primary);
        }

        .table tbody tr:hover {
            background: var(--light-bg);
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius-sm);
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success-color);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--danger-color);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
    </style>

    <div class="dashboard-container">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-person-badge"></i>
                    Guide Details
                </h1>
                <p class="text-secondary mt-2 mb-0">Detailed information for {{ $guide->name }}</p>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Guide Information Card -->
            <div class="content-card">
                <div class="card-header">
                    <div>
                        <h3 class="mb-0">{{ $guide->name }}</h3>
                        <p class="text-secondary mb-0">Guide Information</p>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('admin.guides.edit', $guide) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i>
                            Edit Guide
                        </a>
                        <form action="{{ route('admin.guides.toggle-status', $guide) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="btn {{ $guide->status === 'available' ? 'btn-warning' : 'btn-success' }}">
                                <i class="bi bi-{{ $guide->status === 'available' ? 'pause' : 'play' }}"></i>
                                {{ $guide->status === 'available' ? 'Mark Unavailable' : 'Mark Available' }}
                            </button>
                        </form>
                        <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Back to List
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $guide->name }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Contact Number</div>
                            <div class="info-value">{{ $guide->contact_number }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span class="badge {{ $guide->getStatusBadgeClass() }}">
                                    {{ $guide->getStatusLabel() }}
                                </span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Total Treks</div>
                            <div class="info-value">
                                <span class="badge badge-info">{{ $guide->total_hikes }}</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Member Since</div>
                            <div class="info-value">{{ $guide->created_at->format('M d, Y') }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Last Updated</div>
                            <div class="info-value">{{ $guide->updated_at->format('M d, Y') }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Address</div>
                                <div class="info-value">{{ $guide->address }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Specializations</div>
                                <div class="info-value">
                                    @if($guide->specializations)
                                        {{ $guide->specializations }}
                                    @else
                                        <span class="text-secondary">No specializations listed</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Card -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="mb-0">Recent Bookings</h3>
                    <p class="text-secondary mb-0">Latest 10 bookings assigned to this guide</p>
                </div>

                @if($guide->bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Trail</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guide->bookings as $booking)
                                    <tr>
                                        <td>
                                            <strong>#{{ $booking->id }}</strong>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $booking->trail ?? 'Custom Booking' }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            @if($booking->user)
                                                <div>
                                                    <strong>{{ $booking->user->name }}</strong>
                                                    <div class="text-secondary small">{{ $booking->user->email }}</div>
                                                </div>
                                            @else
                                                <span class="text-secondary">User not found</span>
                                            @endif
                                        </td>
                                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge badge-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.bookings.show', $booking) }}" 
                                               class="btn btn-sm btn-primary" title="View Booking">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-x display-1 text-secondary"></i>
                        <h4 class="mt-3">No Bookings Yet</h4>
                        <p class="text-secondary">This guide hasn't been assigned to any bookings yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>