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
            justify-content: space-between;
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

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-label {
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-value {
            font-size: 1.125rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
            width: fit-content;
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

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--info-color), #0891b2);
            color: white;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            text-align: center;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
    </style>

    <div class="dashboard-container">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-person-badge"></i>
                    Porter Details
                </h1>
                <p class="text-secondary mt-2 mb-0">View porter information and booking history</p>
            </div>

            <!-- Porter Information Card -->
            <div class="content-card">
                <div class="card-header">
                    <div>
                        <h3 class="mb-0">{{ $porter->name }}</h3>
                        <p class="text-secondary mb-0">Porter Profile</p>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('admin.porters.edit', $porter) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                            Edit
                        </a>
                        <form action="{{ route('admin.porters.toggle-status', $porter) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="btn btn-sm {{ $porter->status === 'available' ? 'btn-warning' : 'btn-success' }}">
                                <i class="bi bi-{{ $porter->status === 'available' ? 'pause' : 'play' }}"></i>
                                {{ $porter->status === 'available' ? 'Mark Unavailable' : 'Mark Available' }}
                            </button>
                        </form>
                        <a href="{{ route('admin.porters.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i>
                            Back to List
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Full Name</span>
                                    <span class="info-value">{{ $porter->name }}</span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Contact Number</span>
                                    <span class="info-value">{{ $porter->contact_number }}</span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Status</span>
                                    <span class="badge {{ $porter->getStatusBadgeClass() }}">
                                        {{ $porter->getStatusLabel() }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Max Weight Capacity</span>
                                    <span class="badge badge-info">{{ $porter->getCapacityDisplay() }}</span>
                                </div>

                                @if($porter->address)
                                    <div class="info-item" style="grid-column: 1 / -1;">
                                        <span class="info-label">Address</span>
                                        <span class="info-value">{{ $porter->address }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="stats-number">{{ $porter->total_hikes }}</div>
                                <div class="stats-label">Total Hikes Completed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Card -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="mb-0">Recent Bookings</h3>
                </div>

                @if($porter->bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer</th>
                                    <th>Hike</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($porter->bookings()->latest()->take(10)->get() as $booking)
                                    <tr>
                                        <td>
                                            <strong>#{{ $booking->id }}</strong>
                                        </td>
                                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                        <td>{{ $booking->hike->name ?? 'N/A' }}</td>
                                        <td>{{ $booking->hike_date ? $booking->hike_date->format('M d, Y') : 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.bookings.show', $booking) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        <h4>No Bookings Yet</h4>
                        <p>This porter hasn't been assigned to any bookings yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>