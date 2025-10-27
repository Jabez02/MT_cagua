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

        .status-banner {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-open {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: var(--success-color);
            border: 1px solid #a7f3d0;
        }

        .status-full {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: var(--warning-color);
            border: 1px solid #fcd34d;
        }

        .status-closed {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: var(--danger-color);
            border: 1px solid #fca5a5;
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
            font-size: 1.25rem;
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
            font-size: 2rem;
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

        .guest-info {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .guest-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .guest-details {
            display: flex;
            flex-direction: column;
        }

        .guest-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .guest-email {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .booking-status {
            padding: 0.25rem 0.75rem;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .booking-confirmed {
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

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .action-buttons {
            display: flex;
            gap: var(--spacing-sm);
            justify-content: center;
            padding: var(--spacing-xl);
            border-top: 1px solid var(--border-color);
            background: var(--light-bg);
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

        @media (max-width: 768px) {
            .dashboard-container {
                padding: var(--spacing-md) 0;
            }
            
            .page-header, .info-card-body, .status-banner {
                padding: var(--spacing-lg);
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .action-buttons .btn {
                width: 100%;
                justify-content: center;
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
                <h1 class="page-title">
                    <i class="bi bi-mountain"></i>
                    Hike Schedule Details
                </h1>
            </div>

            <!-- Status Banner -->
            <div class="status-banner">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                            <i class="bi bi-calendar-event text-primary"></i>
                        </div>
                        <div>
                            <h3 class="h5 mb-1">{{ $hike->date->format('F j, Y') }} - {{ $hike->start_time->format('g:i A') }}</h3>
                            <p class="text-muted mb-0">{{ $hike->trail }}</p>
                        </div>
                    </div>
                    <span class="status-badge status-{{ $hike->status }}">
                        {{ ucfirst($hike->status) }}
                    </span>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $hike->capacity - $hike->bookings->where('status', 'confirmed')->count() }}</div>
                    <div class="stat-label">Available Slots</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">₱{{ number_format($hike->bookings->where('status', 'confirmed')->sum('total_amount'), 2) }}</div>
                    <div class="stat-label">Total Revenue</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $hike->bookings->where('status', 'confirmed')->count() }}</div>
                    <div class="stat-label">Confirmed Bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $hike->bookings->where('status', 'pending')->count() }}</div>
                    <div class="stat-label">Pending Bookings</div>
                </div>
            </div>

            <!-- Schedule Information -->
            <div class="info-card">
                <div class="info-card-header">
                    <h2 class="info-card-title">
                        <i class="bi bi-info-circle"></i>
                        Schedule Information
                    </h2>
                </div>
                <div class="info-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Date</div>
                            <div class="info-value">{{ $hike->date->format('F j, Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Start Time</div>
                            <div class="info-value">{{ $hike->start_time->format('g:i A') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Trail</div>
                            <div class="info-value">{{ $hike->trail }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Capacity</div>
                            <div class="info-value">{{ $hike->capacity }} people</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Price</div>
                            <div class="info-value">₱{{ number_format($hike->price, 2) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Difficulty</div>
                            <div class="info-value">{{ ucfirst($hike->difficulty) }}</div>
                        </div>
                    </div>
                    @if($hike->notes)
                        <div class="mt-4">
                            <div class="info-label">Notes</div>
                            <div class="info-value">{{ $hike->notes }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Booking Details -->
            <div class="data-table-card">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="bi bi-people"></i>
                        Booking Details ({{ $hike->bookings->count() }} total)
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Guest</th>
                                <th>Contact</th>
                                <th>Guests</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Booked</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hike->bookings as $booking)
                            <tr>
                                <td>
                                    <div class="guest-info">
                                        <div class="guest-avatar">
                                            {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                        </div>
                                        <div class="guest-details">
                                            <div class="guest-name">{{ $booking->user->name }}</div>
                                            <div class="guest-email">{{ $booking->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $booking->user->contact_number ?? '—' }}</td>
                                <td><strong>{{ $booking->number_of_guests }}</strong></td>
                                <td><strong>₱{{ number_format($booking->total_amount, 2) }}</strong></td>
                                <td>
                                    <span class="booking-status booking-{{ $booking->status }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>{{ $booking->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="bi bi-calendar-x"></i>
                                    <h5>No bookings yet</h5>
                                    <p class="text-muted mb-0">This hike schedule has no bookings.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('admin.hikes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Back to Hikes
                    </a>
                    <a href="{{ route('admin.hikes.edit', $hike->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>
                        Edit Schedule
                    </a>
                    <a href="{{ route('admin.hikes.print', $hike->id) }}" class="btn btn-secondary" target="_blank">
                        <i class="bi bi-printer"></i>
                        Print Details
                    </a>
                    <form action="{{ route('admin.hikes.destroy', $hike->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this hike schedule?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                            Delete Schedule
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection