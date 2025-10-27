<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-bold text-primary mb-0">
                <i class="bi bi-speedometer2 me-2"></i>{{ __('Dashboard') }}
            </h2>
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

        .dashboard-container {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem 0;
            position: relative;
        }
        
        .dashboard-container::before {
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
        
        .dashboard-card {
            border-radius: var(--border-radius);
            border: 1px solid var(--glass-border);
            transition: var(--transition);
            height: 100%;
            overflow: hidden;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            box-shadow: var(--card-shadow);
            position: relative;
        }
        
        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            pointer-events: none;
            opacity: 0;
            transition: var(--transition);
        }
        
        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
        }
        
        .dashboard-card:hover::before {
            opacity: 1;
        }
        
        .card-header-custom {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 20px 25px;
            position: relative;
            overflow: hidden;
        }
        
        .card-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            pointer-events: none;
        }
        
        .card-header-custom::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(0deg); }
            50% { transform: translateX(0%) translateY(0%) rotate(180deg); }
        }
        
        .hero-card {
            background: var(--primary-gradient);
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }
        
        .hero-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .stat-card {
            border: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--glass-border);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            transition: var(--transition);
        }
        
        .stat-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: var(--card-shadow-hover);
        }
        
        .stat-card.primary::before {
            background: var(--primary-gradient);
        }
        
        .stat-card.success::before {
            background: var(--success-gradient);
        }
        
        .stat-card.info::before {
            background: var(--info-gradient);
        }
        
        .stat-card.warning::before {
            background: var(--warning-gradient);
        }
        
        .stat-icon {
            width: 4rem;
            height: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.75rem;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }
        
        .stat-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            opacity: 0.1;
            transition: var(--transition);
        }
        
        .stat-card:hover .stat-icon::before {
            opacity: 0.2;
            transform: scale(1.1);
        }
        
        .stat-icon.primary {
            color: #667eea;
        }
        
        .stat-icon.primary::before {
            background: var(--primary-gradient);
        }
        
        .stat-icon.success {
            color: #11998e;
        }
        
        .stat-icon.success::before {
            background: var(--success-gradient);
        }
        
        .stat-icon.info {
            color: #36b9cc;
        }
        
        .stat-icon.info::before {
            background: var(--info-gradient);
        }
        
        .stat-icon.warning {
            color: #f6c23e;
        }
        
        .stat-icon.warning::before {
            background: var(--warning-gradient);
        }
        
        .quick-action {
            border-radius: 12px;
            transition: var(--transition);
            text-decoration: none;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box, var(--primary-gradient) border-box;
            backdrop-filter: blur(10px);
        }
        
        .quick-action:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
            color: white;
        }
        
        .quick-action:hover::before {
            opacity: 1;
        }
        
        .quick-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }
        
        .content-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }
        
        .content-card:hover {
            box-shadow: var(--card-shadow-hover);
        }
        
        .list-group-item {
            border: none;
            border-radius: 12px !important;
            margin-bottom: 8px;
            background: rgba(248, 249, 250, 0.8);
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }
        
        .list-group-item:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .badge {
            font-weight: 500;
            letter-spacing: 0.5px;
            backdrop-filter: blur(10px);
        }
        
        .alert {
            border: none;
            border-radius: var(--border-radius);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
        }
        
        .btn {
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .text-gradient {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }
        
        /* Enhanced card headers with different gradients */
        .card-header-success {
            background: var(--success-gradient);
        }
        
        .card-header-info {
            background: var(--info-gradient);
        }
        
        .card-header-warning {
            background: var(--warning-gradient);
        }
        
        /* Pulse animation for important elements */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .pulse {
            animation: pulse 2s ease-in-out infinite;
        }
        
        /* Improved responsive design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem 0;
            }
            
            .stat-icon {
                width: 3rem;
                height: 3rem;
                font-size: 1.5rem;
            }
            
            .hero-card .card-body {
                padding: 2rem 1.5rem;
            }
            
            .quick-action {
                padding: 1rem 0.75rem;
            }
        }
        
        @media (max-width: 576px) {
            .dashboard-container {
                padding: 0.5rem 0;
            }
            
            .card-header-custom {
                padding: 15px 20px;
            }
            
            .stat-card .card-body {
                padding: 1.5rem 1rem;
            }
        }
    </style>

    <div class="dashboard-container">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mb-4 shadow-sm">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-4 shadow-sm">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Enhanced Hero Summary -->
            <div class="card dashboard-card hero-card mb-5">
                <div class="card-body d-flex justify-content-between align-items-center p-4 position-relative">
                    <div class="position-relative z-index-1">
                        <div class="text-white-50 fw-semibold mb-2 text-uppercase" style="letter-spacing: 1px;">{{ __('Welcome back') }}</div>
                        <h3 class="fs-2 fw-bold mb-2 text-white">{{ $user->name ?? Auth::user()->name }}</h3>
                        @if(isset($user) && $user->created_at)
                            <div class="text-white-50">
                                <i class="bi bi-calendar3 me-2"></i>{{ __('Member since') }} {{ $user->created_at->format('M d, Y') }}
                            </div>
                        @endif
                    </div>
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2); color: white; border: 2px solid rgba(255,255,255,0.3);">
                        <i class="bi bi-person-circle"></i>
                    </div>
                </div>
            </div>

            <!-- Enhanced Quick Actions -->
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <div class="card dashboard-card">
                        <div class="card-header-custom">
                            <h5 class="m-0 fw-bold text-white section-title">
                                <i class="bi bi-lightning-charge me-2"></i>{{ __('Quick Actions') }}
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-6 col-lg-auto">
                                    <a href="{{ route('user.bookings.create') }}" class="btn btn-primary w-100 quick-action py-3" title="{{ __('Create a new booking') }}" data-bs-toggle="tooltip">
                                        <i class="bi bi-plus-circle me-2 fs-5"></i> 
                                        <div class="fw-semibold">{{ __('Create Booking') }}</div>
                                    </a>
                                </div>
                                <div class="col-6 col-lg-auto">
                                    <a href="{{ route('hikes.index') }}" class="btn btn-outline-primary w-100 quick-action py-3" title="{{ __('Browse available hikes') }}" data-bs-toggle="tooltip">
                                        <i class="bi bi-geo-alt me-2 fs-5"></i> 
                                        <div class="fw-semibold">{{ __('Browse Hikes') }}</div>
                                    </a>
                                </div>
                                <div class="col-6 col-lg-auto">
                                    <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-primary w-100 quick-action py-3" title="{{ __('View your bookings') }}" data-bs-toggle="tooltip">
                                        <i class="bi bi-calendar-check me-2 fs-5"></i> 
                                        <div class="fw-semibold">{{ __('My Bookings') }}</div>
                                    </a>
                                </div>
                                <div class="col-6 col-lg-auto">
                                    <a href="{{ route('user.announcements.index') }}" class="btn btn-outline-primary w-100 quick-action py-3" title="{{ __('Latest announcements') }}" data-bs-toggle="tooltip">
                                        <i class="bi bi-megaphone me-2 fs-5"></i> 
                                        <div class="fw-semibold">{{ __('Announcements') }}</div>
                                    </a>
                                </div>
                                <div class="col-6 col-lg-auto">
                                    <a href="{{ route('chat.index') }}" class="btn btn-outline-primary w-100 quick-action py-3" title="{{ __('Your messages') }}" data-bs-toggle="tooltip">
                                        <i class="bi bi-chat-dots me-2 fs-5"></i> 
                                        <div class="fw-semibold">{{ __('Messages') }}</div>
                                    </a>
                                </div>
                                <div class="col-12 col-lg-auto">
                                    <a href="{{ route('user.profile.show') }}" class="btn btn-outline-secondary w-100 quick-action py-3" title="{{ __('Manage your profile') }}" data-bs-toggle="tooltip">
                                        <i class="bi bi-person-gear me-2 fs-5"></i> 
                                        <div class="fw-semibold">{{ __('Edit Profile') }}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Stats Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card stat-card primary">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs text-uppercase fw-bold text-muted mb-2" style="letter-spacing: 1px;">
                                        {{ __('Upcoming Bookings') }}
                                    </div>
                                    <div class="h4 mb-0 fw-bold text-gradient">{{ $stats['upcomingCount'] ?? 0 }}</div>
                                    <div class="small text-muted mt-2">
                                        <i class="bi bi-calendar-event me-1"></i>{{ __('Scheduled hikes') }}
                                    </div>
                                </div>
                                <div class="stat-icon primary">
                                    <i class="bi bi-calendar2-week"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs text-uppercase fw-bold text-warning mb-1">
                                        {{ __('Payments to Verify') }}
                                    </div>
                                    <div class="h5 mb-0 fw-bold">{{ $stats['pendingVerificationCount'] ?? 0 }}</div>
                                    <div class="small text-muted mt-2">
                                        <i class="bi bi-credit-card me-1"></i>{{ __('Pending verification') }}
                                    </div>
                                </div>
                                <div class="stat-icon warning">
                                    <i class="bi bi-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs text-uppercase fw-bold text-success mb-1">
                                        {{ __('Completed Hikes') }}
                                    </div>
                                    <div class="h5 mb-0 fw-bold">{{ $stats['completedCount'] ?? 0 }}</div>
                                    <div class="small text-muted mt-2">
                                        <i class="bi bi-flag me-1"></i>{{ __('Finished adventures') }}
                                    </div>
                                </div>
                                <div class="stat-icon success">
                                    <i class="bi bi-check2-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs text-uppercase fw-bold text-info mb-1">
                                        {{ __('Unread Messages') }}
                                    </div>
                                    <div class="h5 mb-0 fw-bold">{{ $stats['unreadMessages'] ?? 0 }}</div>
                                    <div class="small text-muted mt-2">
                                        <i class="bi bi-bell me-1"></i>{{ __('New notifications') }}
                                    </div>
                                </div>
                                <div class="stat-icon info">
                                    <i class="bi bi-envelope"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Upcoming Bookings -->
                <div class="col-lg-6">
                    <div class="card dashboard-card shadow-sm h-100">
                        <div class="card-header-custom d-flex justify-content-between align-items-center">
                            <h6 class="m-0 fw-bold text-white">
                                <i class="bi bi-calendar-check me-2"></i>{{ __('Upcoming Bookings') }}
                            </h6>
                            <a href="{{ route('user.bookings.index') }}" class="btn btn-sm btn-light">
                                <i class="bi bi-arrow-right me-1"></i>{{ __('View all') }}
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse ($upcomingBookings as $booking)
                                    <li class="list-group-item d-flex justify-content-between align-items-start p-3 border-bottom">
                                        <div>
                                            <div class="fw-bold">{{ $booking->hike->trail }}</div>
                                            <div class="text-muted small">
                                                <i class="bi bi-calendar3 me-1"></i>{{ $booking->hike->date->format('M d, Y') }} 
                                                <i class="bi bi-clock ms-2 me-1"></i>{{ $booking->hike->start_time->format('h:i A') }}
                                            </div>
                                            <span class="badge rounded-pill {{ $booking->status === 'approved' ? 'bg-success' : 'bg-warning' }} mt-2">
                                                <i class="bi {{ $booking->status === 'approved' ? 'bi-check-circle' : 'bi-hourglass-split' }} me-1"></i>
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('user.bookings.show', $booking) }}" class="btn btn-sm btn-primary rounded-pill">
                                                <i class="bi bi-eye me-1"></i>{{ __('Details') }}
                                            </a>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item p-4 text-center">
                                        <div class="text-muted">
                                            <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                                            {{ __('No upcoming bookings found.') }}
                                        </div>
                                        <a href="{{ route('hikes.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="bi bi-plus-circle me-1"></i>{{ __('Book a hike') }}
                                        </a>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Available Hikes -->
                <div class="col-lg-6">
                    <div class="card dashboard-card shadow-sm h-100">
                        <div class="card-header-custom d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #36b9cc 0%, #1a8a98 100%);">
                            <h6 class="m-0 fw-bold text-white">
                                <i class="bi bi-map me-2"></i>{{ __('Available Hikes') }}
                            </h6>
                            <a href="{{ route('hikes.index') }}" class="btn btn-sm btn-light">
                                <i class="bi bi-arrow-right me-1"></i>{{ __('Browse all') }}
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse ($availableHikes as $hike)
                                    <li class="list-group-item d-flex justify-content-between align-items-start p-3 border-bottom">
                                        <div>
                                            <div class="fw-bold">{{ $hike->trail }}</div>
                                            <div class="text-muted small">
                                                <i class="bi bi-calendar3 me-1"></i>{{ $hike->date->format('M d, Y') }} 
                                                <i class="bi bi-clock ms-2 me-1"></i>{{ $hike->start_time->format('h:i A') }}
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('user.bookings.create', $hike) }}" class="btn btn-sm btn-info text-white rounded-pill">
                                                <i class="bi bi-plus-circle me-1"></i>{{ __('Book now') }}
                                            </a>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item p-4 text-center">
                                        <div class="text-muted">
                                            <i class="bi bi-calendar2-x fs-3 d-block mb-2"></i>
                                            {{ __('No upcoming hikes are currently open.') }}
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Announcements -->
            <div class="row g-4 mt-3">
                <div class="col-12">
                    <div class="card dashboard-card shadow-sm">
                        <div class="card-header-custom d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #f6c23e 0%, #e0a800 100%);">
                            <h6 class="m-0 fw-bold text-white">
                                <i class="bi bi-megaphone me-2"></i>{{ __('Latest Announcements') }}
                            </h6>
                            <a href="{{ route('user.announcements.index') }}" class="btn btn-sm btn-light">
                                <i class="bi bi-arrow-right me-1"></i>{{ __('View all') }}
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse ($latestAnnouncements as $announcement)
                                    <li class="list-group-item p-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="fw-bold">{{ $announcement->title }}</div>
                                                <div class="text-muted small">
                                                    <span class="badge bg-secondary rounded-pill me-1">{{ ucfirst($announcement->type) }}</span>
                                                    <i class="bi bi-clock ms-1 me-1"></i>{{ $announcement->created_at->format('M d, Y H:i') }}
                                                </div>
                                                <p class="mb-2 mt-2">{{ Str::limit($announcement->content, 160) }}</p>
                                            </div>
                                            <a href="{{ route('user.announcements.show', $announcement) }}" class="btn btn-sm btn-warning text-dark rounded-pill">
                                                <i class="bi bi-book me-1"></i>{{ __('Read') }}
                                            </a>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item p-4 text-center">
                                        <div class="text-muted">
                                            <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
                                            {{ __('No announcements at the moment.') }}
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>