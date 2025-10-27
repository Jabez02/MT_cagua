@extends('admin.layouts.app')

@push('styles')
<!-- Google Fonts - Inter for modern typography -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    /* Modern Admin Dashboard Design System */
    :root {
        /* Brand Colors */
        --primary: #4f46e5;
        --primary-light: #6366f1;
        --primary-dark: #4338ca;
        --primary-50: #eef2ff;
        --primary-100: #e0e7ff;
        --primary-500: #6366f1;
        --primary-600: #4f46e5;
        --primary-700: #4338ca;
        
        --success: #10b981;
        --success-light: #34d399;
        --success-dark: #059669;
        --success-50: #ecfdf5;
        --success-100: #d1fae5;
        
        --warning: #f59e0b;
        --warning-light: #fbbf24;
        --warning-dark: #d97706;
        --warning-50: #fffbeb;
        --warning-100: #fef3c7;
        
        --danger: #ef4444;
        --danger-light: #f87171;
        --danger-dark: #dc2626;
        --danger-50: #fef2f2;
        --danger-100: #fee2e2;
        
        --info: #3b82f6;
        --info-light: #60a5fa;
        --info-dark: #2563eb;
        --info-50: #eff6ff;
        --info-100: #dbeafe;
        
        /* Neutral Colors */
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        
        /* Background Colors */
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --bg-tertiary: #f1f5f9;
        
        /* Text Colors */
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-tertiary: #94a3b8;
        
        /* Border Colors */
        --border-primary: #e2e8f0;
        --border-secondary: #cbd5e1;
        
        /* Typography */
        --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        --font-size-xs: 0.75rem;
        --font-size-sm: 0.875rem;
        --font-size-base: 1rem;
        --font-size-lg: 1.125rem;
        --font-size-xl: 1.25rem;
        --font-size-2xl: 1.5rem;
        --font-size-3xl: 1.875rem;
        --font-weight-normal: 400;
        --font-weight-medium: 500;
        --font-weight-semibold: 600;
        --font-weight-bold: 700;
        --line-height-tight: 1.25;
        --line-height-normal: 1.5;
        --line-height-relaxed: 1.75;
        
        /* Spacing */
        --space-1: 0.25rem;
        --space-2: 0.5rem;
        --space-3: 0.75rem;
        --space-4: 1rem;
        --space-5: 1.25rem;
        --space-6: 1.5rem;
        --space-8: 2rem;
        --space-10: 2.5rem;
        --space-12: 3rem;
        --space-16: 4rem;
        --space-20: 5rem;
        
        /* Border Radius */
        --radius-sm: 0.375rem;
        --radius-base: 0.5rem;
        --radius-md: 0.75rem;
        --radius-lg: 1rem;
        --radius-xl: 1.5rem;
        --radius-2xl: 2rem;
        --radius-full: 9999px;
        
        /* Shadows */
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-base: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        
        /* Transitions */
        --transition-base: all 0.2s ease-in-out;
        --transition-bounce: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Global Styles */
    body {
        font-family: var(--font-family);
        background-color: var(--bg-secondary);
        color: var(--text-primary);
        line-height: var(--line-height-normal);
    }

    /* Booking Edit Page Container */
    .booking-edit-container {
        background: var(--bg-secondary);
        min-height: 100vh;
        padding: var(--space-6) 0;
    }

    /* Breadcrumb Navigation */
    .breadcrumb-nav {
        margin-bottom: var(--space-6);
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        list-style: none;
        margin: 0;
        padding: var(--space-3) var(--space-6);
        background: var(--bg-primary);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-primary);
    }

    .breadcrumb-item {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        color: var(--text-secondary);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
    }

    .breadcrumb-item.active {
        color: var(--primary);
        font-weight: var(--font-weight-semibold);
    }

    .breadcrumb-separator {
        color: var(--text-tertiary);
        font-size: var(--font-size-xs);
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-2xl);
        padding: var(--space-8);
        margin-bottom: var(--space-8);
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }

    .page-title {
        font-size: var(--font-size-3xl);
        font-weight: var(--font-weight-bold);
        color: white;
        margin: 0 0 var(--space-2) 0;
        display: flex;
        align-items: center;
        gap: var(--space-3);
        position: relative;
        z-index: 1;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: var(--font-size-lg);
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .header-actions {
        display: flex;
        gap: var(--space-3);
        margin-top: var(--space-6);
        position: relative;
        z-index: 1;
    }

    .header-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: var(--space-3) var(--space-6);
        border-radius: var(--radius-lg);
        text-decoration: none;
        font-weight: var(--font-weight-semibold);
        font-size: var(--font-size-sm);
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        transition: var(--transition-bounce);
        backdrop-filter: blur(10px);
    }

    .header-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
        color: white;
        text-decoration: none;
    }

    /* Modern Card Design */
    .modern-card {
        background: var(--bg-primary);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-primary);
        overflow: hidden;
        transition: var(--transition-base);
        margin-bottom: var(--space-6);
    }

    .modern-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .card-header-modern {
        background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
        padding: var(--space-6);
        border-bottom: 1px solid var(--border-primary);
    }

    .section-title {
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-bold);
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: var(--space-3);
    }

    .section-icon {
        width: 24px;
        height: 24px;
        color: var(--primary);
    }

    .card-body-modern {
        padding: var(--space-6);
    }

    /* Form Styles */
    .form-group {
        margin-bottom: var(--space-6);
    }

    .form-label {
        display: block;
        font-weight: var(--font-weight-semibold);
        color: var(--text-primary);
        font-size: var(--font-size-sm);
        margin-bottom: var(--space-2);
    }

    .form-control-modern {
        width: 100%;
        padding: var(--space-3) var(--space-4);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-base);
        font-family: var(--font-family);
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-base);
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        background: var(--bg-primary);
    }

    .form-control-modern:disabled {
        background: var(--gray-50);
        color: var(--text-tertiary);
        cursor: not-allowed;
    }

    .form-select-modern {
        width: 100%;
        padding: var(--space-3) var(--space-4);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-base);
        font-family: var(--font-family);
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-base);
        cursor: pointer;
    }

    .form-select-modern:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .form-textarea-modern {
        width: 100%;
        padding: var(--space-3) var(--space-4);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-base);
        font-family: var(--font-family);
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-base);
        resize: vertical;
        min-height: 120px;
    }

    .form-textarea-modern:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .form-help-text {
        font-size: var(--font-size-xs);
        color: var(--text-secondary);
        margin-top: var(--space-1);
    }

    /* Info Display */
    .info-display {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: var(--space-4);
        border: 1px solid var(--border-primary);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: var(--space-3) 0;
        border-bottom: 1px solid var(--border-primary);
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        font-weight: var(--font-weight-semibold);
        color: var(--text-secondary);
        font-size: var(--font-size-sm);
        min-width: 140px;
        flex-shrink: 0;
    }

    .info-value {
        color: var(--text-primary);
        font-weight: var(--font-weight-medium);
        text-align: right;
        flex: 1;
    }

    .info-value.highlight {
        color: var(--primary);
        font-weight: var(--font-weight-bold);
        font-size: var(--font-size-lg);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: var(--space-3);
        justify-content: flex-end;
        margin-top: var(--space-8);
        padding-top: var(--space-6);
        border-top: 1px solid var(--border-primary);
    }

    .btn-modern {
        padding: var(--space-3) var(--space-6);
        border-radius: var(--radius-lg);
        font-weight: var(--font-weight-semibold);
        font-size: var(--font-size-sm);
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        transition: var(--transition-bounce);
        border: none;
        cursor: pointer;
        text-decoration: none;
        min-width: 120px;
        justify-content: center;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }

    .btn-secondary {
        background: var(--gray-100);
        color: var(--text-primary);
        border: 1px solid var(--border-primary);
    }

    .btn-secondary:hover {
        background: var(--gray-200);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: var(--text-primary);
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .booking-edit-container {
            padding: var(--space-4) 0;
        }

        .page-header {
            padding: var(--space-6);
            margin-bottom: var(--space-6);
        }

        .page-title {
            font-size: var(--font-size-2xl);
        }

        .header-actions {
            flex-direction: column;
            gap: var(--space-2);
        }

        .header-btn {
            justify-content: center;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-modern {
            justify-content: center;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
</style>
@endpush

@section('content')
<div class="booking-edit-container">
    <div class="container-fluid">
        <!-- Breadcrumb Navigation -->
        <nav class="breadcrumb-nav animate-fade-in-up">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house-door"></i>
                    <span>Admin</span>
                </li>
                <li class="breadcrumb-separator">
                    <i class="bi bi-chevron-right"></i>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.bookings.index') }}" style="color: var(--text-secondary); text-decoration: none;">Bookings</a>
                </li>
                <li class="breadcrumb-separator">
                    <i class="bi bi-chevron-right"></i>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.bookings.show', $booking) }}" style="color: var(--text-secondary); text-decoration: none;">Booking #{{ $booking->id }}</a>
                </li>
                <li class="breadcrumb-separator">
                    <i class="bi bi-chevron-right"></i>
                </li>
                <li class="breadcrumb-item active">
                    Edit
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header animate-fade-in-up">
            <h1 class="page-title">
                <i class="bi bi-pencil-square"></i>
                {{ __('Edit Booking #:id', ['id' => $booking->id]) }}
            </h1>
            <p class="page-subtitle">Modify booking details and staff assignments</p>
            <div class="header-actions">
                <a href="{{ route('admin.bookings.show', $booking) }}" class="header-btn">
                    <i class="bi bi-arrow-left"></i>
                    {{ __('Back to Details') }}
                </a>
            </div>
        </div>

        <!-- Form Content -->
        <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" class="animate-fade-in-up">
            @csrf
            @method('PATCH')

            <!-- Booking Information Card -->
            <div class="modern-card">
                <div class="card-header-modern">
                    <h3 class="section-title">
                        <i class="bi bi-info-circle section-icon"></i>
                        {{ __('Booking Information') }}
                    </h3>
                </div>
                <div class="card-body-modern">
                    <div class="info-display">
                        <div class="info-row">
                            <span class="info-label">{{ __('Booking ID') }}</span>
                            <span class="info-value highlight">#{{ $booking->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">{{ __('Customer') }}</span>
                            <span class="info-value">{{ $booking->user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">{{ __('Email') }}</span>
                            <span class="info-value">{{ $booking->user->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">{{ __('Booking Date') }}</span>
                            <span class="info-value">{{ $booking->created_at->format('F j, Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">{{ __('Total Amount') }}</span>
                            <span class="info-value highlight">₱{{ number_format($booking->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Assignment Notice -->
            <div class="modern-card">
                <div class="card-header-modern">
                    <h3 class="section-title">
                        <i class="bi bi-info-circle section-icon"></i>
                        {{ __('Staff Assignment') }}
                    </h3>
                </div>
                <div class="card-body-modern">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ __('You can only assign or reassign guides and porters to this booking. For status changes, use the Approve/Reject/Cancel buttons on the booking details page.') }}
                    </div>
                </div>
            </div>

            <!-- Guide Assignment Card -->
            <div class="modern-card">
                <div class="card-header-modern">
                    <h3 class="section-title">
                        <i class="bi bi-person-badge section-icon"></i>
                        {{ __('Guide Assignment') }}
                    </h3>
                </div>
                <div class="card-body-modern">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="guide_id" class="form-label">{{ __('Assigned Guide') }}</label>
                                <select name="guide_id" id="guide_id" class="form-select-modern">
                                    <option value="">{{ __('Select a guide...') }}</option>
                                    @foreach($guides as $guide)
                                        <option value="{{ $guide->id }}" {{ $booking->guide_id == $guide->id ? 'selected' : '' }}>
                                            {{ $guide->name }} - {{ $guide->contact_number }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-help-text">
                                    {{ __('Choose a guide to lead this hiking expedition') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if($booking->guide)
                                <div class="info-display">
                                    <div class="info-row">
                                        <span class="info-label">{{ __('Current Guide') }}</span>
                                        <span class="info-value">{{ $booking->guide->name }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">{{ __('Contact') }}</span>
                                        <span class="info-value">{{ $booking->guide->contact_number }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Porter Assignment Card -->
            <div class="modern-card">
                <div class="card-header-modern">
                    <h3 class="section-title">
                        <i class="bi bi-backpack section-icon"></i>
                        {{ __('Porter Assignment') }}
                    </h3>
                </div>
                <div class="card-body-modern">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="porter_id" class="form-label">{{ __('Assigned Porter') }}</label>
                                <select name="porter_id" id="porter_id" class="form-select-modern">
                                    <option value="">{{ __('Select a porter...') }}</option>
                                    @foreach($porters as $porter)
                                        <option value="{{ $porter->id }}" {{ $booking->porter_id == $porter->id ? 'selected' : '' }}>
                                            {{ $porter->name }} - {{ $porter->contact_number }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-help-text">
                                    {{ __('Choose a porter to assist with equipment and supplies') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if($booking->porter)
                                <div class="info-display">
                                    <div class="info-row">
                                        <span class="info-label">{{ __('Current Porter') }}</span>
                                        <span class="info-value">{{ $booking->porter->name }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">{{ __('Contact') }}</span>
                                        <span class="info-value">{{ $booking->porter->contact_number }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn-modern btn-secondary">
                    <i class="bi bi-x-circle"></i>
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="btn-modern btn-primary">
                    <i class="bi bi-check-circle"></i>
                    {{ __('Update Booking') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection