<x-app-layout>
<style>
    /* Modern UI Variables */
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --primary-light: #dbeafe;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1f2937;
        --gray: #6b7280;
        --light-gray: #f3f4f6;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --radius-sm: 0.375rem;
        --radius: 0.5rem;
        --radius-lg: 0.75rem;
        --radius-xl: 1rem;
        --space-2: 0.5rem;
        --space-3: 0.75rem;
        --space-4: 1rem;
        --space-6: 1.5rem;
        --font-size-sm: 0.875rem;
        --font-size-base: 1rem;
        --font-size-lg: 1.125rem;
        --font-size-xl: 1.25rem;
        --font-weight-medium: 500;
        --font-weight-semibold: 600;
        --font-weight-bold: 700;
        --transition-base: all 0.3s ease;
        --transition-bounce: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    /* Global Styles */
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .booking-details-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .booking-details-container::before {
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

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
        position: relative;
        z-index: 1;
    }

    /* Header */
    .page-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border-radius: var(--radius-xl);
        padding: var(--space-6);
        margin-bottom: var(--space-6);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-title {
        color: white;
        font-size: 2rem;
        font-weight: var(--font-weight-bold);
        margin: 0 0 var(--space-2) 0;
        display: flex;
        align-items: center;
        gap: var(--space-3);
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: var(--font-size-lg);
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: var(--space-3);
        margin-top: var(--space-6);
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        text-decoration: none;
        padding: var(--space-3) var(--space-4);
        border-radius: var(--radius);
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        gap: var(--space-2);
        font-weight: var(--font-weight-medium);
        transition: var(--transition-base);
        backdrop-filter: blur(10px);
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    /* Cards */
    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        margin-bottom: var(--space-6);
        overflow: hidden;
        transition: var(--transition-base);
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
        color: white;
        padding: var(--space-6);
        border: none;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
        pointer-events: none;
    }

    .card-title {
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-bold);
        margin: 0;
        display: flex;
        align-items: center;
        gap: var(--space-3);
        position: relative;
        z-index: 1;
    }

    .card-body {
        padding: var(--space-6);
    }

    /* Status Timeline */
    .status-timeline {
        position: relative;
        padding-left: 2rem;
    }

    .status-timeline::before {
        content: '';
        position: absolute;
        left: -0.25rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--primary), var(--primary-light));
    }

    .timeline-item {
        position: relative;
        padding-bottom: var(--space-6);
        margin-left: 1rem;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-icon {
        position: absolute;
        left: -1.25rem;
        top: 0.25rem;
        width: 2rem;
        height: 2rem;
        background: var(--white);
        border: 3px solid var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--font-size-sm);
        color: var(--primary);
        z-index: 2;
        transition: var(--transition-bounce);
    }

    /* Desktop responsive adjustments */
    @media (min-width: 1200px) {
        .timeline-icon {
            width: 2.5rem;
            height: 2.5rem;
            left: -1.375rem;
            font-size: 1rem;
        }
        
        .status-timeline {
            padding-left: 2.5rem;
        }
        
        .status-timeline::before {
            left: -0.375rem;
        }
        
        .timeline-item {
            margin-left: 1.25rem;
        }
    }

    @media (min-width: 992px) and (max-width: 1199px) {
        .timeline-icon {
            width: 2.25rem;
            height: 2.25rem;
            left: -1.25rem;
            font-size: 0.9rem;
        }
        
        .status-timeline {
            padding-left: 2.25rem;
        }
        
        .status-timeline::before {
            left: -0.25rem;
        }
        
        .timeline-item {
            margin-left: 1.125rem;
        }
    }

    /* Tablet responsive adjustments */
    @media (min-width: 769px) and (max-width: 991px) {
        .timeline-icon {
            width: 2rem;
            height: 2rem;
            left: -1.25rem;
            font-size: 0.875rem;
        }
        
        .status-timeline {
            padding-left: 2rem;
        }
        
        .status-timeline::before {
            left: -0.25rem;
        }
        
        .timeline-item {
            margin-left: 1rem;
        }
    }

    /* Mobile tablet responsive adjustments */
    @media (max-width: 768px) {
        .timeline-icon {
            left: -1rem;
            width: 1.5rem;
            height: 1.5rem;
            font-size: 0.75rem;
            border-width: 2px;
        }
        
        .status-timeline {
            padding-left: 1.5rem;
        }
        
        .status-timeline::before {
            left: -0.125rem;
        }
        
        .timeline-item {
            margin-left: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .timeline-icon {
            left: -0.875rem;
            width: 1.25rem;
            height: 1.25rem;
            font-size: 0.625rem;
            border-width: 2px;
        }
        
        .status-timeline {
            padding-left: 1.25rem;
        }
        
        .status-timeline::before {
            left: -0.0625rem;
        }
        
        .timeline-item {
            margin-left: 0.5rem;
        }
        
        .timeline-content h4 {
            font-size: 1rem;
        }
        
        .timeline-content p {
            font-size: 0.875rem;
        }
    }

    .timeline-item.completed .timeline-icon {
        background: var(--success);
        border-color: var(--success);
        color: white;
        animation: pulse 2s infinite;
    }

    .timeline-item.current .timeline-icon {
        background: var(--warning);
        border-color: var(--warning);
        color: white;
        animation: bounce 1s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }

    .timeline-content h4 {
        font-size: var(--font-size-lg);
        font-weight: var(--font-weight-semibold);
        color: var(--dark);
        margin: 0 0 var(--space-2) 0;
    }

    .timeline-content {
        margin-left: 1rem;
        padding-left: var(--space-3);
    }

    .timeline-content p {
        color: var(--gray);
        margin: 0;
        font-size: var(--font-size-sm);
    }

    .timeline-date {
        color: var(--gray);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        margin-top: var(--space-2);
    }

    /* Desktop responsive adjustments for content */
    @media (min-width: 1200px) {
        .timeline-content {
            margin-left: 1.5rem;
            padding-left: var(--space-4);
        }
    }

    @media (min-width: 992px) and (max-width: 1199px) {
        .timeline-content {
            margin-left: 1.25rem;
            padding-left: var(--space-3);
        }
    }

    /* Tablet responsive adjustments for content */
    @media (min-width: 769px) and (max-width: 991px) {
        .timeline-content {
            margin-left: 1rem;
            padding-left: var(--space-3);
        }
    }

    /* Mobile responsive adjustments for content */
    @media (max-width: 768px) {
        .timeline-content {
            margin-left: 0.5rem;
            padding-left: var(--space-2);
        }
    }

    @media (max-width: 480px) {
        .timeline-content {
            margin-left: 0.375rem;
            padding-left: var(--space-2);
        }
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-2) var(--space-4);
        border-radius: var(--radius);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-badge.pending {
        background: rgba(251, 191, 36, 0.1);
        color: #d97706;
        border: 1px solid rgba(251, 191, 36, 0.2);
    }

    .status-badge.confirmed {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-badge.cancelled {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* Quick Actions */
    .quick-actions {
        display: flex;
        gap: var(--space-3);
        flex-wrap: wrap;
        margin-top: var(--space-6);
    }

    .btn-action {
        padding: var(--space-3) var(--space-4);
        border-radius: var(--radius);
        border: none;
        font-weight: var(--font-weight-semibold);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        transition: var(--transition-bounce);
        cursor: pointer;
        font-size: var(--font-size-sm);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
        color: white;
        box-shadow: var(--shadow);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    .btn-secondary {
        background: var(--light-gray);
        color: var(--gray);
        border: 1px solid rgba(107, 114, 128, 0.2);
    }

    .btn-secondary:hover {
        background: var(--gray);
        color: white;
        transform: translateY(-2px);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        color: white;
        box-shadow: var(--shadow);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    /* Payment Progress */
    .payment-progress {
        background: var(--light-gray);
        border-radius: var(--radius);
        padding: var(--space-4);
        margin: var(--space-4) 0;
    }

    .progress-bar {
        background: var(--light-gray);
        height: 8px;
        border-radius: 4px;
        overflow: hidden;
        margin: var(--space-3) 0;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--success) 0%, #10b981 100%);
        border-radius: 4px;
        transition: width 0.5s ease;
        position: relative;
    }

    .progress-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .progress-text {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        color: var(--gray);
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: var(--space-4);
        margin: var(--space-4) 0;
    }

    .info-item {
        background: rgba(255, 255, 255, 0.5);
        padding: var(--space-4);
        border-radius: var(--radius);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: var(--transition-base);
    }

    .info-item:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateY(-2px);
    }

    .info-label {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: var(--space-2);
    }

    .info-value {
        font-size: var(--font-size-lg);
        font-weight: var(--font-weight-semibold);
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: var(--space-2);
    }

    /* Map Container */
    .map-container {
        height: 300px;
        border-radius: var(--radius);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        background: var(--light-gray);
    }

    .map-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: var(--gray);
        font-size: var(--font-size-lg);
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .card-header,
        .card-body {
            padding: var(--space-4);
        }

        .page-title {
            font-size: 1.5rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            flex-direction: column;
        }

        .btn-action {
            justify-content: center;
        }

        .header-actions {
            margin-top: var(--space-4);
        }

        .timeline-item {
            margin-left: 0.5rem;
        }

        .timeline-icon {
            left: -1.75rem;
        }
    }

    /* Notification System Styles */
    .notification-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050; /* Lower than Bootstrap modal z-index (1055) */
        max-width: 400px;
        width: 100%;
        pointer-events: none; /* Allow clicks to pass through container */
    }

    .notification {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        margin-bottom: var(--space-3);
        overflow: hidden;
        pointer-events: auto; /* Re-enable clicks on actual notifications */
        transform: translateX(100%);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        border-left: 4px solid var(--primary);
    }

    .notification.show {
        transform: translateX(0);
    }

    .notification.success {
        border-left-color: var(--success);
    }

    .notification.error {
        border-left-color: var(--danger);
    }

    .notification.warning {
        border-left-color: var(--warning);
    }

    .notification.info {
        border-left-color: var(--primary);
    }

    .notification-content {
        padding: var(--space-4);
        display: flex;
        align-items: flex-start;
        gap: var(--space-3);
    }

    .notification-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 12px;
        color: white;
    }

    .notification.success .notification-icon {
        background: var(--success);
    }

    .notification.error .notification-icon {
        background: var(--danger);
    }

    .notification.warning .notification-icon {
        background: var(--warning);
    }

    .notification.info .notification-icon {
        background: var(--primary);
    }

    .notification-message {
        flex: 1;
        font-size: var(--font-size-sm);
        color: var(--dark);
        line-height: 1.5;
    }

    .notification-close {
        background: none;
        border: none;
        color: var(--gray);
        cursor: pointer;
        padding: 0;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: var(--transition-base);
        flex-shrink: 0;
    }

    .notification-close:hover {
        background: var(--light-gray);
        color: var(--dark);
    }

    /* Animations */
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    .notification.slide-in {
        animation: slideInRight 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .notification.slide-out {
        animation: slideOutRight 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    /* Mobile Responsive Notifications */
    @media (max-width: 768px) {
        .notification-container {
            top: 10px;
            right: 10px;
            left: 10px;
            max-width: none;
        }

        .notification-content {
            padding: var(--space-3);
        }

        .notification-message {
            font-size: 0.8rem;
        }
    }

    /* Staff Information Cards */
    .staff-info-card {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: var(--radius-lg);
        padding: var(--space-4);
        transition: var(--transition-base);
        height: 100%;
        box-shadow: var(--shadow-sm);
    }

    .staff-info-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        border-color: var(--primary);
    }

    .staff-header {
        display: flex;
        align-items: center;
        gap: var(--space-3);
        margin-bottom: var(--space-4);
        padding-bottom: var(--space-3);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .staff-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: white;
        flex-shrink: 0;
    }

    .staff-icon.guide {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
    }

    .staff-icon.porter {
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
    }

    .staff-details {
        flex: 1;
    }

    .staff-name {
        font-size: var(--font-size-lg);
        font-weight: var(--font-weight-semibold);
        color: var(--dark);
        margin: 0 0 var(--space-2) 0;
    }

    .staff-role {
        color: var(--gray);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .staff-contact {
        margin-bottom: var(--space-4);
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        margin-bottom: var(--space-2);
        color: var(--gray);
        font-size: var(--font-size-sm);
    }

    .contact-item:last-child {
        margin-bottom: 0;
    }

    .contact-item i {
        width: 1rem;
        text-align: center;
        color: var(--primary);
    }

    .staff-description {
        background: rgba(37, 99, 235, 0.05);
        border-radius: var(--radius);
        padding: var(--space-3);
        border-left: 3px solid var(--primary);
    }

    .staff-description p {
        margin: 0;
        font-size: var(--font-size-sm);
        color: var(--dark);
        line-height: 1.5;
    }

    /* Mobile responsive for staff cards */
    @media (max-width: 768px) {
        .staff-info-card {
            margin-bottom: var(--space-4);
        }

        .staff-header {
            flex-direction: column;
            text-align: center;
            gap: var(--space-2);
        }

        .staff-icon {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 1rem;
        }

        .staff-name {
            font-size: var(--font-size-base);
        }

        .contact-item {
            justify-content: center;
        }
    }
</style>

<div class="booking-details-container">
    <!-- Notification Container for Real-time Updates -->
    <div id="notification-container" class="notification-container"></div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">
                        <i class="bi bi-calendar-check"></i>
                        Booking Details
                    </h1>
                    <p class="page-subtitle">View and manage your hiking booking information</p>
                    <div class="header-actions">
                        <a href="{{ route('user.bookings.index') }}" class="btn-back">
                            <i class="bi bi-arrow-left"></i>
                            Back to My Bookings
                        </a>
                    </div>
                </div>

                <!-- Booking Progress Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="bi bi-graph-up"></i>
                            Booking Progress
                        </h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Track your booking journey. Current status: 
                            <span class="status-badge {{ $booking->status === 'payment_pending' || ($booking->status === 'confirmed' && (!$booking->payment || $booking->payment->status !== 'verified')) ? 'payment_pending' : strtolower($booking->status) }}">
                                <i class="bi bi-{{ $booking->status === 'pending' ? 'clock' : (($booking->status === 'confirmed' && $booking->payment && $booking->payment->status === 'verified') ? 'check-circle' : ($booking->status === 'payment_pending' || ($booking->status === 'confirmed' && (!$booking->payment || $booking->payment->status !== 'verified')) ? 'credit-card' : 'x-circle')) }}"></i>
                                @if($booking->status === 'payment_pending' || ($booking->status === 'confirmed' && (!$booking->payment || $booking->payment->status !== 'verified')))
                                    Payment Pending
                                @elseif($booking->status === 'confirmed' && $booking->payment && $booking->payment->status === 'verified')
                                    Confirmed
                                @else
                                    {{ ucfirst($booking->status) }}
                                @endif
                            </span>
                        </p>
                        
                        <!-- Interactive Status Timeline -->
                        <div class="status-timeline">
                            <div class="timeline-item completed">
                                <div class="timeline-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>Booking Submitted</h4>
                                    <p>Your booking request has been received</p>
                                    <div class="timeline-date">{{ $booking->created_at->format('M d, Y H:i') }}</div>
                                </div>
                            </div>
                            
                            <div class="timeline-item {{ $booking->status !== 'pending' ? 'completed' : 'current' }}">
                                <div class="timeline-icon">
                                    <i class="bi bi-{{ $booking->status !== 'pending' ? 'check' : 'hourglass-split' }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>Admin Approval</h4>
                                    <p>{{ $booking->status === 'pending' ? 'Under Review' : 'Approved by Admin' }}</p>
                                    @if($booking->status !== 'pending')
                                        <div class="timeline-date">{{ $booking->updated_at->format('M d, Y H:i') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="timeline-item {{ $booking->payment && $booking->payment->status === 'verified' ? 'completed' : ($booking->status === 'payment_pending' || $booking->status === 'confirmed' ? 'current' : '') }}">
                                <div class="timeline-icon">
                                    <i class="bi bi-{{ $booking->payment && $booking->payment->status === 'verified' ? 'check' : 'credit-card' }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>Payment {{ $booking->payment && $booking->payment->status === 'verified' ? 'Verified' : 'Pending' }}</h4>
                                    <p>{{ $booking->payment && $booking->payment->status === 'verified' ? 'Payment confirmed and verified' : 'Awaiting payment verification' }}</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item {{ $booking->trek_date <= now() ? 'completed' : '' }}">
                                <div class="timeline-icon">
                                    <i class="bi bi-{{ $booking->trek_date <= now() ? 'check' : 'calendar-event' }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>Trek Day</h4>
                                    <p>{{ $booking->trek_date <= now() ? 'Trek completed' : 'Scheduled' }}</p>
                                    <div class="timeline-date">{{ \Carbon\Carbon::parse($booking->trek_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="quick-actions">
                            @if($booking->status === 'pending')
                                <button class="btn-action btn-secondary" onclick="showBookingNotification('You can contact support for booking updates', 'info')">
                                    <i class="bi bi-headset"></i>
                                    Contact Support
                                </button>
                            @endif
                            
                            @if($booking->status === 'payment_pending' || ($booking->status === 'confirmed' && (!$booking->payment || $booking->payment->status !== 'verified')))
                                <a href="{{ route('user.bookings.payment', $booking) }}" class="btn-action btn-primary">
                                    <i class="bi bi-credit-card"></i>
                                    Upload Payment
                                </a>
                            @endif
                            
                            @if($booking->status === 'pending' || ($booking->status === 'confirmed' && $booking->trek_date > now()->addDays(2)))
                                <button class="btn-action btn-danger" data-bs-toggle="modal" data-bs-target="#cancelBookingModal">
                                    <i class="bi bi-x-circle"></i>
                                    Cancel Booking
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Trek Information Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="bi bi-mountain"></i>
                            Trek Information
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Trail</div>
                                <div class="info-value">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $booking->trail }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Date</div>
                                <div class="info-value">
                                    <i class="bi bi-calendar"></i>
                                    {{ \Carbon\Carbon::parse($booking->trek_date)->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Start Time</div>
                                <div class="info-value">
                                    <i class="bi bi-clock"></i>
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Duration</div>
                                <div class="info-value">
                                    <i class="bi bi-hourglass-split"></i>
                                    Day hike
                                </div>
                            </div>
                        </div>

                        <!-- Interactive Map -->
                        <div class="mt-4">
                            <h5 class="mb-3">
                                <i class="bi bi-map"></i>
                                Trail Location
                            </h5>
                            <div class="map-container">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15941.077892918198!2d122.11084146356167!3d18.214755317831326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33867132d482c7c7%3A0x793f607f01545202!2sMt.%20Cagua%20Crater!5e1!3m2!1sen!2sph!4v1761578200448!5m2!1sen!2sph" 
                                        width="600" 
                                        height="450" 
                                        style="border:0; width: 100%; border-radius: 0.5rem;" 
                                        allowfullscreen="" 
                                        loading="lazy" 
                                        referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staff Assignment Card -->
                @if($booking->guide || $booking->porter)
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="bi bi-people"></i>
                            Your Trek Team
                        </h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-4 text-muted">Meet your assigned trek team members who will guide and assist you during your adventure.</p>
                        
                        <div class="row">
                            @if($booking->guide)
                            <div class="col-md-6 mb-4">
                                <div class="staff-info-card">
                                    <div class="staff-header">
                                        <div class="staff-icon guide">
                                            <i class="bi bi-compass"></i>
                                        </div>
                                        <div class="staff-details">
                                            <h4 class="staff-name">{{ $booking->guide->name }}</h4>
                                            <p class="staff-role">Your Trek Guide</p>
                                        </div>
                                    </div>
                                    <div class="staff-contact">
                                        <div class="contact-item">
                                            <i class="bi bi-telephone"></i>
                                            <span>{{ $booking->guide->contact_number }}</span>
                                        </div>
                                        @if($booking->guide->email)
                                        <div class="contact-item">
                                            <i class="bi bi-envelope"></i>
                                            <span>{{ $booking->guide->email }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="staff-description">
                                        <p><strong>Experience:</strong> Professional trek guide with extensive knowledge of Mt. Cagua trails and safety protocols.</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($booking->porter)
                            <div class="col-md-6 mb-4">
                                <div class="staff-info-card">
                                    <div class="staff-header">
                                        <div class="staff-icon porter">
                                            <i class="bi bi-backpack"></i>
                                        </div>
                                        <div class="staff-details">
                                            <h4 class="staff-name">{{ $booking->porter->name }}</h4>
                                            <p class="staff-role">Your Porter</p>
                                        </div>
                                    </div>
                                    <div class="staff-contact">
                                        <div class="contact-item">
                                            <i class="bi bi-telephone"></i>
                                            <span>{{ $booking->porter->contact_number }}</span>
                                        </div>
                                        @if($booking->porter->email)
                                        <div class="contact-item">
                                            <i class="bi bi-envelope"></i>
                                            <span>{{ $booking->porter->email }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="staff-description">
                                        <p><strong>Role:</strong> Assists with equipment, supplies, and provides additional support during your trek.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if(!$booking->guide && !$booking->porter)
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="bi bi-clock-history display-4 text-muted"></i>
                            </div>
                            <h5 class="text-muted">Staff Assignment Pending</h5>
                            <p class="text-muted mb-0">Your guide and porter will be assigned closer to your trek date. You'll be notified once they're assigned.</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Booking Status Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="bi bi-info-circle"></i>
                            Booking Status
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Status</div>
                                <div class="info-value">
                                    <span class="status-badge {{ $booking->status === 'payment_pending' || ($booking->status === 'confirmed' && (!$booking->payment || $booking->payment->status !== 'verified')) ? 'payment_pending' : strtolower($booking->status) }}">
                                <i class="bi bi-{{ $booking->status === 'pending' ? 'clock' : (($booking->status === 'confirmed' && $booking->payment && $booking->payment->status === 'verified') ? 'check-circle' : ($booking->status === 'payment_pending' || ($booking->status === 'confirmed' && (!$booking->payment || $booking->payment->status !== 'verified')) ? 'credit-card' : 'x-circle')) }}"></i>
                                @if($booking->status === 'payment_pending' || ($booking->status === 'confirmed' && (!$booking->payment || $booking->payment->status !== 'verified')))
                                    Payment Pending
                                @elseif($booking->status === 'confirmed' && $booking->payment && $booking->payment->status === 'verified')
                                    Confirmed
                                @else
                                    {{ ucfirst($booking->status) }}
                                @endif
                            </span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Payment Status</div>
                                <div class="info-value">
                                    @if($booking->payment && $booking->payment->status === 'verified')
                                        <span class="status-badge confirmed">
                                            <i class="bi bi-check-circle"></i>
                                            Payment Verified
                                        </span>
                                    @elseif($booking->payment && $booking->payment->status === 'pending_verification')
                                        <span class="status-badge payment_pending">
                                            <i class="bi bi-clock"></i>
                                            Pending Verification
                                        </span>
                                    @elseif($booking->payment && $booking->payment->status === 'rejected')
                                        <span class="status-badge rejected">
                                            <i class="bi bi-x-circle"></i>
                                            Payment Rejected
                                        </span>
                                    @else
                                        <span class="status-badge payment_pending">
                                            <i class="bi bi-credit-card"></i>
                                            Payment Required
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Payment Progress Indicator -->
                        @if(!$booking->payment || $booking->payment->status !== 'verified')
                            <div class="payment-progress">
                                <div class="progress-text">
                                    <span>Payment Progress</span>
                                    <span>{{ !$booking->payment ? '25%' : '75%' }}</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ !$booking->payment ? '25%' : '75%' }}"></div>
                                </div>
                                <small class="text-muted">
                                    {{ !$booking->payment ? 'Upload payment proof to continue' : 'Payment under review' }}
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Booking Modal -->
<div class="modal fade" id="cancelBookingModal" tabindex="-1" aria-labelledby="cancelBookingModalLabel" aria-hidden="true" style="z-index: 10001;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="cancelBookingModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Cancel Booking
                </h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="display-1 text-warning mb-3">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h4 class="mb-3">Are you sure you want to cancel this booking?</h4>
                    <p class="text-muted mb-0">This action cannot be undone.</p>
                </div>
                
                <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-info-circle-fill text-warning me-3 mt-1"></i>
                        <div>
                            <strong>Cancellation Policy:</strong>
                            <p class="mb-0 mt-1">Any payments made will be processed according to our cancellation policy. Please review the terms and conditions for refund details.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left me-1"></i>
                    Keep Booking
                </button>
                <form method="POST" action="{{ route('user.bookings.cancel', $booking) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Final confirmation: Cancel this booking?')">
                        <i class="bi bi-x-circle me-1"></i>
                        Cancel Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Real-time Booking Notification System
    class BookingNotificationSystem {
        constructor() {
            this.container = document.getElementById('notification-container');
            this.bookingId = {{ $booking->id }};
            this.lastStatusCheck = Date.now();
            this.init();
        }

        init() {
            // Try WebSocket connection first, fallback to polling
            this.setupWebSocket() || this.setupPolling();
        }

        setupWebSocket() {
            // WebSocket implementation would go here
            // For now, return false to use polling
            return false;
        }

        setupPolling() {
            // Check for updates every 30 seconds
            setInterval(() => {
                this.checkForUpdates();
            }, 30000);
        }

        async checkForUpdates() {
            try {
                const response = await fetch(`/api/bookings/${this.bookingId}/status`);
                const data = await response.json();
                
                if (data.lastUpdated > this.lastStatusCheck) {
                    this.handleStatusUpdate(data);
                    this.lastStatusCheck = data.lastUpdated;
                }
            } catch (error) {
                console.log('Status check failed:', error);
            }
        }

        handleStatusUpdate(data) {
            const { status, payment, message } = data;
            
            // Update page elements
            this.updateStatusBadges(status, payment);
            this.updateTimeline(status, payment);
            
            // Show notification
            this.showNotification(
                message || `Your booking status has been updated to: ${status}`,
                status === 'confirmed' ? 'success' : status === 'cancelled' ? 'error' : 'info'
            );
        }

        updateStatusBadges(status, payment) {
            const statusBadges = document.querySelectorAll('.status-badge');
            statusBadges.forEach(badge => {
                const isPaymentPending = status === 'payment_pending' || (status === 'confirmed' && (!payment || payment.status !== 'verified'));
                const isConfirmed = status === 'confirmed' && payment && payment.status === 'verified';
                
                badge.className = `status-badge ${isPaymentPending ? 'payment_pending' : status.toLowerCase()}`;
                badge.innerHTML = `
                    <i class="bi bi-${status === 'pending' ? 'clock' : (isConfirmed ? 'check-circle' : (isPaymentPending ? 'credit-card' : 'x-circle'))}"></i>
                    ${isPaymentPending ? 'Payment Pending' : (isConfirmed ? 'Confirmed' : status.charAt(0).toUpperCase() + status.slice(1))}
                `;
            });
        }

        updateTimeline(status, payment) {
            const timelineItems = document.querySelectorAll('.timeline-item');
            
            // Update timeline based on new status
            timelineItems.forEach((item, index) => {
                const icon = item.querySelector('.timeline-icon i');
                
                switch(index) {
                    case 0: // Booking Submitted - always completed
                        item.className = 'timeline-item completed';
                        break;
                    case 1: // Admin Approval
                        if (status !== 'pending') {
                            item.className = 'timeline-item completed';
                            icon.className = 'bi bi-check';
                        }
                        break;
                    case 2: // Payment
                        if (payment && payment.status === 'verified') {
                            item.className = 'timeline-item completed';
                            icon.className = 'bi bi-check';
                        }
                        break;
                }
            });
        }

        showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            const icons = {
                success: 'check-circle-fill',
                error: 'x-circle-fill',
                warning: 'exclamation-triangle-fill',
                info: 'info-circle-fill'
            };

            notification.innerHTML = `
                <div class="notification-content">
                    <div class="notification-icon">
                        <i class="bi bi-${icons[type]}"></i>
                    </div>
                    <div class="notification-message">${message}</div>
                    <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            `;

            this.container.appendChild(notification);

            // Trigger animation
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }, 5000);
        }
    }

    // Initialize notification system when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the booking notification system
        window.bookingNotifications = new BookingNotificationSystem();
        
        // Initialize Bootstrap modal with proper error handling
        const cancelBookingModal = document.getElementById('cancelBookingModal');
        let modalInstance = null;
        
        if (cancelBookingModal) {
            try {
                // Create modal instance
                modalInstance = new bootstrap.Modal(cancelBookingModal, {
                    backdrop: 'static',
                    keyboard: true,
                    focus: true
                });
                
                // Handle modal events
                cancelBookingModal.addEventListener('show.bs.modal', function (event) {
                    console.log('Cancel booking modal is opening');
                });
                
                cancelBookingModal.addEventListener('shown.bs.modal', function (event) {
                    console.log('Cancel booking modal is fully visible');
                    // Focus on the "Keep Booking" button for better UX
                    const keepButton = cancelBookingModal.querySelector('[data-bs-dismiss="modal"]');
                    if (keepButton) {
                        keepButton.focus();
                    }
                });
                
                cancelBookingModal.addEventListener('hide.bs.modal', function (event) {
                    console.log('Cancel booking modal is closing');
                });
                
            } catch (error) {
                console.error('Error initializing cancel booking modal:', error);
            }
        }
        
        // Handle trigger button clicks
        const cancelButton = document.querySelector('[data-bs-target="#cancelBookingModal"]');
        if (cancelButton && modalInstance) {
            cancelButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                try {
                    modalInstance.show();
                } catch (error) {
                    console.error('Error showing cancel booking modal:', error);
                    // Fallback: try to show modal using data attributes
                    cancelButton.setAttribute('data-bs-toggle', 'modal');
                    cancelButton.setAttribute('data-bs-target', '#cancelBookingModal');
                }
            });
    });

    // Global function for manual notifications
    window.showBookingNotification = function(message, type = 'info') {
        if (window.bookingNotifications) {
            window.bookingNotifications.showNotification(message, type);
        }
    };
</script>
</x-app-layout>