@push('styles')
<style>
    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --secondary-color: #6b7280;
        --light-bg: #f8fafc;
        --border-color: #e5e7eb;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-muted: #9ca3af;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --border-radius: 0.75rem;
        --border-radius-sm: 0.5rem;
    }

    .profile-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .page-title i {
        color: var(--primary-color);
        font-size: 1.75rem;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .card-header {
        background: rgba(248, 250, 252, 0.8);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .card-subtitle {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin: 0.25rem 0 0 0;
    }

    .btn-edit {
        background: var(--primary-color);
        border: 2px solid var(--primary-color);
        color: white;
        padding: 0.625rem 1.25rem;
        border-radius: var(--border-radius-sm);
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-edit:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-edit:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    .profile-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 2rem;
    }

    .info-item {
        background: rgba(248, 250, 252, 0.5);
        border-radius: var(--border-radius-sm);
        padding: 1.25rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(248, 250, 252, 0.8);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .info-label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .info-label i {
        color: var(--primary-color);
        font-size: 0.875rem;
    }

    .info-value {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 1rem;
        word-break: break-word;
    }

    .hike-history-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .hike-history-table th {
        background: rgba(248, 250, 252, 0.8);
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-bottom: 2px solid var(--border-color);
    }

    .hike-history-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-primary);
        vertical-align: middle;
    }

    .hike-history-table tr:hover {
        background: rgba(248, 250, 252, 0.5);
    }

    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .status-badge.approved,
    .status-badge.confirmed {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-badge.pending {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-badge.completed {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info-color);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .status-badge.cancelled,
    .status-badge.rejected {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-view {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius-sm);
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .btn-view:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .btn-view:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    .achievements-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        padding: 2rem;
    }

    .achievement-card {
        background: rgba(248, 250, 252, 0.8);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        text-align: center;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .achievement-card:hover {
        background: rgba(248, 250, 252, 1);
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .achievement-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        margin-bottom: 1rem;
        object-fit: cover;
        border: 3px solid var(--primary-color);
        padding: 0.25rem;
        background: white;
    }

    .achievement-title {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .achievement-description {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .achievement-date {
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 500;
    }

    .empty-state {
        background: rgba(248, 250, 252, 0.5);
        border: 2px dashed var(--border-color);
        border-radius: var(--border-radius);
        padding: 3rem 2rem;
        text-align: center;
        margin: 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .empty-state-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Pagination Styles */
    .pagination-wrapper {
        padding: 1rem 2rem;
        border-top: 1px solid var(--border-color);
        background: rgba(248, 250, 252, 0.5);
    }

    /* Accessibility Improvements */
    .btn-edit:focus,
    .btn-view:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* Screen Reader Only Content */
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

    /* High Contrast Mode Support */
    @media (prefers-contrast: high) {
        .profile-card,
        .info-item,
        .achievement-card {
            border-width: 2px;
        }
        
        .btn-edit,
        .btn-view {
            border-width: 3px;
        }
        
        .status-badge {
            border-width: 2px;
        }
    }

    /* Reduced Motion Support */
    @media (prefers-reduced-motion: reduce) {
        .info-item,
        .achievement-card,
        .btn-edit,
        .btn-view {
            transition: none;
        }
        
        .info-item:hover,
        .achievement-card:hover,
        .btn-edit:hover,
        .btn-view:hover {
            transform: none;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-container {
            padding: 1rem 0;
        }
        
        .page-header {
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 1.75rem;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .card-header {
            padding: 1rem 1.5rem;
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        
        .profile-info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .achievements-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .hike-history-table {
            font-size: 0.875rem;
        }
        
        .hike-history-table th,
        .hike-history-table td {
            padding: 0.75rem 0.5rem;
        }
        
        .empty-state {
            padding: 2rem 1rem;
            margin: 1rem;
        }
        
        .empty-state i {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .card-title {
            font-size: 1.25rem;
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .profile-info-grid {
            padding: 1rem;
        }
        
        .achievements-grid {
            grid-template-columns: 1fr;
            padding: 1rem;
        }
        
        .hike-history-table th,
        .hike-history-table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.75rem;
        }
        
        .btn-edit,
        .btn-view {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
        }
    }

    /* Print Styles */
    @media print {
        .profile-container {
            background: white;
        }
        
        .btn-edit,
        .btn-view {
            display: none !important;
        }
        
        .profile-card {
            border: 1px solid #000;
            background: white !important;
        }
        
        .status-badge {
            border: 1px solid #000;
            background: transparent !important;
            color: #000 !important;
        }
    }
</style>
@endpush

<x-app-layout>
    <div class="profile-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-person-circle" aria-hidden="true"></i>
                    {{ __('My Profile') }}
                </h1>
                <p class="page-subtitle">{{ __('View your personal information and hiking achievements') }}</p>
            </div>

            <!-- Profile Information -->
            <div class="profile-card">
                <header class="card-header">
                    <div>
                        <h2 class="card-title">
                            <i class="bi bi-person-vcard" aria-hidden="true"></i>
                            {{ __('Profile Information') }}
                        </h2>
                        <p class="card-subtitle">{{ __('Your personal details and contact information') }}</p>
                    </div>
                    <a href="{{ route('user.profile.edit') }}" class="btn-edit" role="button">
                        <i class="bi bi-pencil" aria-hidden="true"></i>
                        {{ __('Edit Profile') }}
                    </a>
                </header>
                <div class="profile-info-grid">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-person" aria-hidden="true"></i>
                            {{ __('Full Name') }}
                        </div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-envelope" aria-hidden="true"></i>
                            {{ __('Email Address') }}
                        </div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-telephone" aria-hidden="true"></i>
                            {{ __('Contact Number') }}
                        </div>
                        <div class="info-value">{{ $user->contact_number }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-geo-alt" aria-hidden="true"></i>
                            {{ __('Address') }}
                        </div>
                        <div class="info-value">{{ $user->address }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-person-exclamation" aria-hidden="true"></i>
                            {{ __('Emergency Contact Name') }}
                        </div>
                        <div class="info-value">{{ $user->emergency_contact_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-telephone-plus" aria-hidden="true"></i>
                            {{ __('Emergency Contact Number') }}
                        </div>
                        <div class="info-value">{{ $user->emergency_contact_number }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-flag" aria-hidden="true"></i>
                            {{ __('Nationality') }}
                        </div>
                        <div class="info-value">{{ ucfirst($user->nationality) }}</div>
                    </div>
                </div>
            </div>

            <!-- Hike History -->
            <div class="profile-card">
                <header class="card-header">
                    <div>
                        <h2 class="card-title">
                            <i class="bi bi-clock-history" aria-hidden="true"></i>
                            {{ __('Hike History') }}
                        </h2>
                        <p class="card-subtitle">{{ __('Your past and upcoming hiking adventures') }}</p>
                    </div>
                </header>
                @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="hike-history-table" role="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col">{{ __('Trail') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->hike->date instanceof \Carbon\Carbon ? $booking->hike->date->format('M d, Y') : $booking->hike->date }}</td>
                                        <td>{{ $booking->hike->trail }}</td>
                                        <td>
                                            @php
                                                $status = strtolower($booking->status);
                                                $statusClass = match ($status) {
                                                    'approved', 'confirmed' => 'approved',
                                                    'pending' => 'pending',
                                                    'completed' => 'completed',
                                                    'cancelled', 'rejected' => 'cancelled',
                                                    default => 'pending',
                                                };
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}" role="status" aria-label="{{ __('Booking status: :status', ['status' => ucfirst($booking->status)]) }}">
                                                @if($status === 'approved' || $status === 'confirmed')
                                                    <i class="bi bi-check-circle" aria-hidden="true"></i>
                                                @elseif($status === 'pending')
                                                    <i class="bi bi-clock" aria-hidden="true"></i>
                                                @elseif($status === 'completed')
                                                    <i class="bi bi-check-all" aria-hidden="true"></i>
                                                @else
                                                    <i class="bi bi-x-circle" aria-hidden="true"></i>
                                                @endif
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.bookings.show', $booking) }}" class="btn-view" role="button" aria-label="{{ __('View details for :trail hike', ['trail' => $booking->hike->trail]) }}">
                                                <i class="bi bi-eye" aria-hidden="true"></i>
                                                {{ __('View Details') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($bookings->hasPages())
                        <div class="pagination-wrapper">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                @else
                    <div class="empty-state" role="region" aria-label="{{ __('No hike history') }}">
                        <i class="bi bi-calendar-x" aria-hidden="true"></i>
                        <div class="empty-state-title">{{ __('No Hike History') }}</div>
                        <div class="empty-state-text">{{ __('You haven\'t booked any hikes yet. Start exploring our trails to build your hiking history!') }}</div>
                    </div>
                @endif
            </div>

            <!-- Achievements -->
            <div class="profile-card">
                <header class="card-header">
                    <div>
                        <h2 class="card-title">
                            <i class="bi bi-trophy" aria-hidden="true"></i>
                            {{ __('Achievements') }}
                        </h2>
                        <p class="card-subtitle">{{ __('Your earned badges and hiking milestones') }}</p>
                    </div>
                </header>
                @if($achievements->count() > 0)
                    <div class="achievements-grid">
                        @foreach($achievements as $achievement)
                            <div class="achievement-card" role="article" aria-label="{{ __('Achievement: :type', ['type' => ucfirst($achievement->badge_type)]) }}">
                                <img src="{{ asset($achievement->logo_path) }}" 
                                     alt="{{ __('Badge for :type achievement', ['type' => $achievement->badge_type]) }}" 
                                     class="achievement-icon" />
                                <div class="achievement-title">{{ ucfirst($achievement->badge_type) }}</div>
                                <div class="achievement-description">{{ $achievement->description }}</div>
                                <div class="achievement-date">
                                    <i class="bi bi-calendar-check" aria-hidden="true"></i>
                                    {{ __('Awarded') }}: {{ $achievement->awarded_at instanceof \Carbon\Carbon ? $achievement->awarded_at->format('M d, Y') : ($achievement->awarded_at ? $achievement->awarded_at : __('Date not available')) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state" role="region" aria-label="{{ __('No achievements') }}">
                        <i class="bi bi-award" aria-hidden="true"></i>
                        <div class="empty-state-title">{{ __('No Achievements Yet') }}</div>
                        <div class="empty-state-text">{{ __('Complete hikes and reach milestones to earn badges and achievements. Your journey starts with your first hike!') }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>