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

    /* Booking Detail Page Container */
    .booking-detail-container {
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

    .header-btn.btn-primary {
        background: rgba(255, 255, 255, 0.9);
        color: var(--primary);
    }

    .header-btn.btn-primary:hover {
        background: white;
        color: var(--primary-dark);
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

    /* Info Rows */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: var(--space-4) 0;
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

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-2) var(--space-4);
        border-radius: var(--radius-full);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pending {
        background: var(--warning-100);
        color: var(--warning-dark);
        border: 1px solid var(--warning-light);
    }

    .badge-approved {
        background: var(--success-100);
        color: var(--success-dark);
        border: 1px solid var(--success-light);
    }

    .badge-rejected {
        background: var(--danger-100);
        color: var(--danger-dark);
        border: 1px solid var(--danger-light);
    }

    .badge-cancelled {
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
    }

    /* Fee Breakdown Section */
    .fee-breakdown {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: var(--space-6);
        margin-top: var(--space-6);
        border: 1px solid var(--border-primary);
    }

    .fee-breakdown .info-row {
        border-bottom: 1px solid var(--border-secondary);
    }

    .fee-total {
        background: var(--primary-50);
        border-radius: var(--radius-md);
        padding: var(--space-4);
        margin-top: var(--space-4);
        border: 1px solid var(--primary-100);
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: var(--space-8);
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 12px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--border-primary);
    }

    .timeline-item {
        position: relative;
        margin-bottom: var(--space-6);
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -20px;
        top: 4px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--primary);
        border: 3px solid var(--bg-primary);
        box-shadow: var(--shadow-sm);
    }

    .timeline-dot.bg-success {
        background: var(--success);
    }

    .timeline-content p {
        margin: 0 0 var(--space-1) 0;
        font-size: var(--font-size-sm);
    }

    .timeline-content p:first-child {
        font-weight: var(--font-weight-semibold);
        color: var(--text-primary);
    }

    .timeline-content p.small {
        color: var(--text-secondary);
        font-size: var(--font-size-xs);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: var(--space-3);
        justify-content: flex-end;
        margin-top: var(--space-6);
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
    }

    .btn-success {
        background: var(--success);
        color: white;
    }

    .btn-success:hover {
        background: var(--success-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }

    .btn-danger {
        background: var(--danger);
        color: white;
    }

    .btn-danger:hover {
        background: var(--danger-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }

    /* Health Issues Alert */
    .health-alert {
        background: var(--danger-50);
        border: 1px solid var(--danger-200);
        border-left: 4px solid var(--danger);
        border-radius: var(--radius-lg);
        padding: var(--space-6);
        margin-bottom: var(--space-6);
    }

    .health-alert .section-title {
        color: var(--danger-dark);
        margin-bottom: var(--space-4);
    }

    .health-alert p {
        color: var(--danger-dark);
        margin: 0;
        font-weight: var(--font-weight-medium);
    }

    /* Staff Assignment */
    .staff-card {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: var(--space-5);
        border: 1px solid var(--border-primary);
    }

    .staff-title {
        font-size: var(--font-size-base);
        font-weight: var(--font-weight-bold);
        color: var(--text-primary);
        margin: 0 0 var(--space-3) 0;
    }

    .staff-name {
        font-size: var(--font-size-lg);
        font-weight: var(--font-weight-semibold);
        color: var(--primary);
        margin: 0 0 var(--space-1) 0;
    }

    .staff-contact {
        color: var(--text-secondary);
        font-size: var(--font-size-sm);
        margin: 0;
    }

    /* Status Overview Styles */
    .status-overview {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
    }

    .status-display {
        text-align: center;
    }

    .status-badge-large {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-badge-large.badge-approved {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
    }

    .status-badge-large.badge-rejected {
        background: linear-gradient(135deg, #dc3545, #e74c3c);
        color: white;
    }

    .status-badge-large.badge-cancelled {
        background: linear-gradient(135deg, #ffc107, #fd7e14);
        color: #212529;
    }

    .status-badge-large.badge-pending {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
    }

    .booking-summary {
        color: white;
    }

    .booking-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: white;
    }

    .booking-meta {
        font-size: 0.95rem;
        opacity: 0.9;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-end;
    }

    .quick-actions .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        min-width: 100px;
    }

    /* Info Grid Styles */
    .info-grid {
        display: grid;
        gap: 1rem;
    }

    .info-section {
        padding: 1rem 0;
    }

    .info-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #495057;
    }

    .info-section-content {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Payment Info Styles */
    .payment-info {
        border-top: 1px solid #e9ecef;
        padding-top: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .booking-detail-container {
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

        .info-row {
            flex-direction: column;
            gap: var(--space-2);
        }

        .info-label {
            min-width: auto;
        }

        .info-value {
            text-align: left;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-modern {
            justify-content: center;
        }

        .status-overview .row {
            text-align: center;
        }

        .status-overview .col-md-3,
        .status-overview .col-md-6,
        .status-overview .col-md-3 {
            margin-bottom: 1rem;
        }

        .booking-meta {
            justify-content: center;
            font-size: 0.85rem;
        }

        .quick-actions {
            align-items: center;
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
        }

        .quick-actions .btn-sm {
            min-width: auto;
            flex: 1;
            max-width: 120px;
        }

        .info-grid {
            gap: 0.75rem;
        }
    }

    /* Payment Proof Styles */
    .payment-proof {
        border-top: 1px solid #e9ecef;
        padding-top: 1rem;
    }

    .payment-proof-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 1rem;
    }

    .payment-status-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .receipt-preview {
        text-align: center;
    }

    .receipt-image-container {
        position: relative;
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .receipt-image-container:hover {
        transform: scale(1.02);
    }

    .receipt-image {
        max-width: 100%;
        max-height: 300px;
        width: auto;
        height: auto;
        display: block;
    }

    .receipt-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s ease;
        font-size: 0.9rem;
    }

    .receipt-image-container:hover .receipt-overlay {
        opacity: 1;
    }

    .receipt-overlay i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .receipt-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .no-receipt,
    .no-payment {
        text-align: center;
    }

    /* Modal Styles for Receipt */
    .receipt-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .receipt-modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 90%;
        max-height: 90%;
    }

    .receipt-modal img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .receipt-modal-close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    .receipt-modal-close:hover {
        color: #bbb;
    }

    /* Payment Verification Styles */
    .payment-verification {
        border: 2px solid #ffc107;
        border-radius: 12px;
        padding: 1.5rem;
        background: linear-gradient(135deg, #fff9e6 0%, #fff3cd 100%);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.15);
    }

    .verification-header .verification-title {
        color: #856404;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .verification-checklist {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin: 1rem 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .checklist-title {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e9ecef;
    }

    .verification-items {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .verification-item {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 1rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .verification-item:hover {
        border-color: #007bff;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.1);
    }

    .verification-check {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        font-weight: 600;
        color: #495057;
    }

    .verification-check i {
        font-size: 1.2rem;
        margin-right: 0.75rem;
        color: #007bff;
    }

    .verification-details {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-left: 2rem;
    }

    .verification-details span {
        font-size: 0.9rem;
    }

    .verification-details .expected,
    .verification-details .received,
    .verification-details .method,
    .verification-details .timestamp,
    .verification-details .reference {
        color: #6c757d;
        font-weight: 500;
    }

    .verification-details .status-check {
        display: flex;
        align-items: center;
        font-weight: 600;
        margin-top: 0.25rem;
    }

    .verification-details .status-check i {
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    .verification-actions {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .verification-form .form-label {
        font-weight: 600;
        color: #495057;
    }

    .verification-form .btn {
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .verification-form .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
<div class="booking-detail-container">
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
                <li class="breadcrumb-item active">
                    Booking #{{ $booking->id }}
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header animate-fade-in-up">
            <h1 class="page-title">
                <i class="bi bi-clipboard-check"></i>
                {{ __('Booking #:id Details', ['id' => $booking->id]) }}
            </h1>
            <p class="page-subtitle">Complete booking information and management options</p>
            <div class="header-actions">
                <a href="{{ route('admin.bookings.index') }}" class="header-btn">
                    <i class="bi bi-arrow-left"></i>
                    {{ __('Back to Bookings') }}
                </a>
                <a href="{{ route('admin.bookings.edit', $booking) }}" class="header-btn btn-primary">
                    <i class="bi bi-pencil"></i>
                    {{ __('Edit Booking') }}
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Status Overview Card - Top Priority -->
            <div class="col-12">
                <div class="modern-card status-overview animate-fade-in-up">
                    <div class="card-body-modern">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="status-display">
                                    <span class="status-badge-large {{ $booking->status === 'approved' ? 'badge-approved' : ($booking->status === 'rejected' ? 'badge-rejected' : ($booking->status === 'cancelled' ? 'badge-cancelled' : 'badge-pending')) }}">
                                        <i class="bi bi-{{ $booking->status === 'approved' ? 'check-circle' : ($booking->status === 'rejected' ? 'x-circle' : ($booking->status === 'cancelled' ? 'slash-circle' : 'clock')) }}"></i>
                                        {{ __(ucfirst($booking->status)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="booking-summary">
                                    <h3 class="booking-title">{{ $booking->hike ? $booking->hike->trail : ($booking->trail ?? 'Custom Booking') }}</h3>
                                    <p class="booking-meta">
                                        @if($booking->hike)
                                            <i class="bi bi-calendar3"></i> {{ $booking->hike->date->format('M d, Y') }} at {{ $booking->hike->start_time->format('h:i A') }}
                                        @else
                                            <i class="bi bi-calendar3"></i> {{ $booking->trek_date ? \Carbon\Carbon::parse($booking->trek_date)->format('M d, Y') : 'Date not specified' }}
                                            @if($booking->start_time)
                                                at {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}
                                            @endif
                                        @endif
                                        <span class="mx-2">•</span>
                                        <i class="bi bi-people"></i> {{ $booking->foreign_tourists + $booking->local_tourists }} tourists
                                        <span class="mx-2">•</span>
                                        ₱{{ number_format($booking->total_amount, 2) }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="quick-actions">
                                    @if($booking->status === 'pending')
                                        @if($booking->hike_id === null)
                                            <!-- Custom Booking Approval -->
                                            <div class="custom-booking-actions mb-3">
                                                <h6 class="text-warning mb-2">
                                                    <i class="bi bi-exclamation-triangle"></i>
                                                    Custom Booking Review Required
                                                </h6>
                                                <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" class="d-inline me-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-modern btn-success btn-sm">
                                                        <i class="bi bi-check-lg"></i>
                                                        {{ __('Approve Custom Booking') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-modern btn-danger btn-sm" 
                                                            onclick="return confirm('Are you sure you want to reject this custom booking?')">
                                                        <i class="bi bi-x-lg"></i>
                                                        {{ __('Reject') }}
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <!-- Regular Booking Approval -->
                                            <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-modern btn-success btn-sm">
                                                    <i class="bi bi-check-lg"></i>
                                                    {{ __('Approve') }}
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                    @if($booking->status !== 'cancelled')
                                        <button type="button" class="btn-modern btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#cancelBookingModal">
                                            <i class="bi bi-slash-circle"></i>
                                            {{ __('Cancel') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Row -->
            <div class="col-lg-8">
                <!-- Guest Information -->
                <div class="modern-card animate-fade-in-up">
                    <div class="card-header-modern">
                        <h2 class="section-title">
                            <i class="bi bi-person section-icon"></i>
                            {{ __('Guest Information') }}
                        </h2>
                    </div>
                    <div class="card-body-modern">
                        <div class="info-grid">
                            <div class="info-row">
                                <span class="info-label">{{ __('Name') }}</span>
                                <span class="info-value">{{ $booking->user->name }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">{{ __('Email') }}</span>
                                <span class="info-value">{{ $booking->user->email }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">{{ __('Contact') }}</span>
                                <span class="info-value">{{ $booking->user->contact_number }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">{{ __('Nationality') }}</span>
                                <span class="info-value">{{ $booking->user->nationality }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trip Details -->
                <div class="modern-card animate-fade-in-up mt-4">
                    <div class="card-header-modern">
                        <h2 class="section-title">
                            <i class="bi bi-map section-icon"></i>
                            {{ __('Trip Details') }}
                        </h2>
                    </div>
                    <div class="card-body-modern">
                        <div class="info-grid">
                            <div class="info-row">
                                <span class="info-label">{{ __('Foreign Tourists') }}</span>
                                <span class="info-value">{{ $booking->foreign_tourists }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">{{ __('Local Tourists') }}</span>
                                <span class="info-value">{{ $booking->local_tourists }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">{{ __('Length of Stay') }}</span>
                                <span class="info-value">{{ $booking->length_of_stay }} days</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">{{ __('Transportation') }}</span>
                                <span class="info-value">{{ $booking->transportation }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">{{ __('Meeting Place') }}</span>
                                <span class="info-value">{{ $booking->meeting_place }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Special Requests & Health Issues -->
                @if($booking->special_requests || $booking->health_issues)
                    <div class="modern-card animate-fade-in-up mt-4">
                        <div class="card-header-modern">
                            <h2 class="section-title">
                                <i class="bi bi-chat-right-text section-icon"></i>
                                {{ __('Additional Information') }}
                            </h2>
                        </div>
                        <div class="card-body-modern">
                            @if($booking->special_requests)
                                <div class="info-section">
                                    <h4 class="info-section-title">{{ __('Special Requests') }}</h4>
                                    <p class="info-section-content">{{ $booking->special_requests }}</p>
                                </div>
                            @endif
                            @if($booking->health_issues && !empty($booking->health_issues))
                                <div class="info-section {{ $booking->special_requests ? 'mt-4' : '' }}">
                                    <h4 class="info-section-title text-warning">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        {{ __('Health Issues') }}
                                    </h4>
                                    <p class="info-section-content">
                                        @if(is_array($booking->health_issues))
                                            {{ implode(', ', array_map('ucfirst', $booking->health_issues)) }}
                                        @else
                                            {{ $booking->health_issues }}
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Payment Information -->
                <div class="modern-card animate-fade-in-up">
                    <div class="card-header-modern">
                        <h2 class="section-title">
                            <i class="bi bi-credit-card section-icon"></i>
                            {{ __('Payment Details') }}
                        </h2>
                    </div>
                    <div class="card-body-modern">
                        <!-- Fee Breakdown -->
                        <div class="fee-breakdown">
                            <div class="info-row">
                                <span class="info-label">{{ __('Tourist Fee') }}</span>
                                <span class="info-value">₱{{ number_format($booking->tourist_fee, 2) }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">{{ __('Guide Fee') }}</span>
                                <span class="info-value">₱{{ number_format($booking->guide_fee, 2) }}</span>
                            </div>
                            @if($booking->porter_fee > 0)
                                <div class="info-row">
                                    <span class="info-label">{{ __('Porter Fee') }}</span>
                                    <span class="info-value">₱{{ number_format($booking->porter_fee, 2) }}</span>
                                </div>
                            @endif
                            <div class="info-row">
                                <span class="info-label">{{ __('Processing Fee') }}</span>
                                <span class="info-value">₱{{ number_format($booking->processing_fee, 2) }}</span>
                            </div>
                            <div class="fee-total">
                                <div class="info-row">
                                    <span class="info-label">{{ __('Total Amount') }}</span>
                                    <span class="info-value highlight">₱{{ number_format($booking->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="payment-info mt-4">
                            <div class="info-row">
                                <span class="info-label">{{ __('Down Payment') }}</span>
                                <span class="info-value">₱{{ number_format($booking->down_payment, 2) }}</span>
                            </div>
                            @if($booking->status === 'rejected')
                                <div class="info-row">
                                    <span class="info-label">{{ __('Payment Status') }}</span>
                                    <span class="info-value text-muted">
                                        <i class="bi bi-x-circle me-1"></i>
                                        {{ __('No payment required - booking rejected') }}
                                    </span>
                                </div>
                            @else
                                <div class="info-row">
                                    <span class="info-label">{{ __('Payment Method') }}</span>
                                    <span class="info-value">{{ ucfirst($booking->payment_method) }}</span>
                                </div>
                                @if($booking->payment_reference)
                                    <div class="info-row">
                                        <span class="info-label">{{ __('Payment Reference') }}</span>
                                        <span class="info-value">{{ $booking->payment_reference }}</span>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Payment Proof Section -->
                        @if($booking->payments()->exists())
                            @php $payment = $booking->payments()->first(); @endphp
                            <div class="payment-proof mt-4">
                                <h4 class="payment-proof-title">
                                    <i class="bi bi-receipt me-2"></i>
                                    {{ __('Payment Proof') }}
                                </h4>
                                
                                <div class="payment-status-card">
                                    <div class="info-row">
                                        <span class="info-label">{{ __('Transaction ID') }}</span>
                                        <span class="info-value">{{ $payment->transaction_id }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">{{ __('Payment Status') }}</span>
                                        <span class="status-badge badge-{{ $payment->status }}">
                                            {{ __(ucfirst($payment->status)) }}
                                        </span>
                                    </div>
                                    @if($payment->verified_at)
                                        <div class="info-row">
                                            <span class="info-label">{{ __('Verified At') }}</span>
                                            <span class="info-value">{{ $payment->verified_at->format('M d, Y H:i:s') }}</span>
                                        </div>
                                    @endif
                                </div>

                                @if($payment->receipt_url)
                                    <div class="receipt-preview mt-3">
                                        <div class="receipt-image-container">
                                            <img src="{{ $payment->receipt_url }}" 
                                                 alt="Payment Receipt" 
                                                 class="receipt-image"
                                                 onclick="openReceiptModal('{{ $payment->receipt_url }}')">
                                            <div class="receipt-overlay">
                                                <i class="bi bi-zoom-in"></i>
                                                <span>{{ __('Click to view full size') }}</span>
                                            </div>
                                        </div>
                                        <div class="receipt-actions mt-2">
                                            <a href="{{ $payment->receipt_url }}" 
                                               target="_blank" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                                {{ __('View Full Size') }}
                                            </a>
                                            <a href="{{ $payment->receipt_url }}" 
                                               download 
                                               class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-download"></i>
                                                {{ __('Download') }}
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Payment Verification Section -->
                                    @if($booking->status === 'payment_verification_pending' && $payment->status === 'pending')
                                        <div class="payment-verification mt-4">
                                            <div class="verification-header">
                                                <h5 class="verification-title">
                                                    <i class="bi bi-shield-check me-2"></i>
                                                    {{ __('Payment Verification Required') }}
                                                </h5>
                                                <div class="alert alert-warning">
                                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                                    {{ __('This payment requires admin verification before the booking can be confirmed.') }}
                                                </div>
                                            </div>

                                            <div class="verification-checklist">
                                                <h6 class="checklist-title">{{ __('Verification Checklist') }}</h6>
                                                <div class="verification-items">
                                                    <div class="verification-item">
                                                        <div class="verification-check">
                                                            <i class="bi bi-currency-dollar"></i>
                                                            <span class="check-label">{{ __('Payment Amount') }}</span>
                                                        </div>
                                                        <div class="verification-details">
                                                            <span class="expected">{{ __('Expected: ₱:amount', ['amount' => number_format($booking->down_payment, 2)]) }}</span>
                                                            <span class="received">{{ __('Received: ₱:amount', ['amount' => number_format($payment->amount, 2)]) }}</span>
                                                            @if($payment->amount >= $booking->down_payment)
                                                                <span class="status-check text-success">
                                                                    <i class="bi bi-check-circle-fill"></i>
                                                                    {{ __('Amount matches or exceeds requirement') }}
                                                                </span>
                                                            @else
                                                                <span class="status-check text-danger">
                                                                    <i class="bi bi-x-circle-fill"></i>
                                                                    {{ __('Amount is insufficient') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="verification-item">
                                                        <div class="verification-check">
                                                            <i class="bi bi-credit-card"></i>
                                                            <span class="check-label">{{ __('Payment Method') }}</span>
                                                        </div>
                                                        <div class="verification-details">
                                                            <span class="method">{{ __('Method: :method', ['method' => ucfirst($payment->payment_method ?? $booking->payment_method)]) }}</span>
                                                            <span class="status-check text-success">
                                                                <i class="bi bi-check-circle-fill"></i>
                                                                {{ __('Payment method is valid') }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="verification-item">
                                                        <div class="verification-check">
                                                            <i class="bi bi-clock"></i>
                                                            <span class="check-label">{{ __('Payment Timestamp') }}</span>
                                                        </div>
                                                        <div class="verification-details">
                                                            <span class="timestamp">{{ __('Submitted: :date', ['date' => $payment->created_at->format('M d, Y H:i:s')]) }}</span>
                                                            @php
                                                                $hoursAgo = $payment->created_at->diffInHours(now());
                                                                $isRecent = $hoursAgo <= 72; // Within 72 hours
                                                            @endphp
                                                            @if($isRecent)
                                                                <span class="status-check text-success">
                                                                    <i class="bi bi-check-circle-fill"></i>
                                                                    {{ __('Payment submitted within acceptable timeframe') }}
                                                                </span>
                                                            @else
                                                                <span class="status-check text-warning">
                                                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                                                    {{ __('Payment submitted :hours hours ago - verify timing', ['hours' => $hoursAgo]) }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="verification-item">
                                                        <div class="verification-check">
                                                            <i class="bi bi-hash"></i>
                                                            <span class="check-label">{{ __('Payment Reference') }}</span>
                                                        </div>
                                                        <div class="verification-details">
                                                            @if($payment->transaction_id)
                                                                <span class="reference">{{ __('Transaction ID: :id', ['id' => $payment->transaction_id]) }}</span>
                                                                <span class="status-check text-success">
                                                                    <i class="bi bi-check-circle-fill"></i>
                                                                    {{ __('Transaction ID provided') }}
                                                                </span>
                                                            @else
                                                                <span class="status-check text-warning">
                                                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                                                    {{ __('No transaction ID provided') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="verification-actions mt-4">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <form action="{{ route('admin.bookings.verify-payment', $booking) }}" method="POST" class="verification-form">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="action" value="approve">
                                                            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                                            
                                                            <div class="mb-3">
                                                                <label for="verification_notes" class="form-label">{{ __('Verification Notes') }}</label>
                                                                <textarea name="verification_notes" id="verification_notes" class="form-control" rows="3" 
                                                                          placeholder="{{ __('Add any notes about the verification process...') }}"></textarea>
                                                            </div>
                                                            
                                                            <button type="submit" class="btn btn-success w-100" 
                                                                    onclick="return confirm('{{ __('Are you sure you want to approve this payment? This will confirm the booking.') }}')">
                                                                <i class="bi bi-shield-check me-2"></i>
                                                                {{ __('Verify & Approve Payment') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="no-receipt mt-3">
                                        <div class="alert alert-warning">
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            {{ __('No payment receipt uploaded') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="no-payment mt-4">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    {{ __('No payment information available') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Staff Assignment -->
                @if($booking->guide || $booking->porter)
                    <div class="modern-card animate-fade-in-up mt-4">
                        <div class="card-header-modern">
                            <h2 class="section-title">
                                <i class="bi bi-people section-icon"></i>
                                {{ __('Staff Assignment') }}
                            </h2>
                        </div>
                        <div class="card-body-modern">
                            @if($booking->guide)
                                <div class="staff-card">
                                    <h4 class="staff-title">{{ __('Assigned Guide') }}</h4>
                                    <p class="staff-name">{{ $booking->guide->name }}</p>
                                    <p class="staff-contact">{{ __('Contact') }}: {{ $booking->guide->contact_number }}</p>
                                </div>
                            @endif

                            @if($booking->porter)
                                <div class="staff-card {{ $booking->guide ? 'mt-3' : '' }}">
                                    <h4 class="staff-title">{{ __('Assigned Porter') }}</h4>
                                    <p class="staff-name">{{ $booking->porter->name }}</p>
                                    <p class="staff-contact">{{ __('Contact') }}: {{ $booking->porter->contact_number }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Booking Timeline -->
                <div class="modern-card animate-fade-in-up mt-4">
                    <div class="card-header-modern">
                        <h2 class="section-title">
                            <i class="bi bi-clock-history section-icon"></i>
                            {{ __('Booking Timeline') }}
                        </h2>
                    </div>
                    <div class="card-body-modern">
                        <div class="timeline">
                            @if($booking->created_at)
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <p>{{ __('Booking Created') }}</p>
                                        <p class="small">{{ $booking->created_at->format('M d, Y H:i:s') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($booking->approved_at)
                                <div class="timeline-item">
                                    <div class="timeline-dot bg-success"></div>
                                    <div class="timeline-content">
                                        <p>{{ __('Booking Approved') }}</p>
                                        <p class="small">{{ $booking->approved_at->format('M d, Y H:i:s') }}</p>
                                        @if($booking->approver)
                                            <p class="small">{{ __('by') }} {{ $booking->approver->name }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

    <!-- Receipt Modal -->
    <div id="receiptModal" class="receipt-modal">
        <span class="receipt-modal-close">&times;</span>
        <div class="receipt-modal-content">
            <img id="receiptModalImage" src="" alt="Payment Receipt">
        </div>
    </div>

    <script>
        // Receipt Modal Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('receiptModal');
            const modalImg = document.getElementById('receiptModalImage');
            const closeBtn = document.querySelector('.receipt-modal-close');
            
            // Open modal when receipt image is clicked
            document.querySelectorAll('.receipt-image-container').forEach(container => {
                container.addEventListener('click', function() {
                    const img = this.querySelector('.receipt-image');
                    if (img) {
                        modal.style.display = 'block';
                        modalImg.src = img.src;
                    }
                });
            });
            
            // Close modal when X is clicked
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
            
            // Close modal when clicking outside the image
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
            
            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'block') {
                    modal.style.display = 'none';
                }
            });
        });
    </script>

    <!-- Cancel Booking Modal -->
    <div class="modal fade" id="cancelBookingModal" tabindex="-1" aria-labelledby="cancelBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelBookingModalLabel">
                        <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                        {{ __('Cancel Booking') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="bi bi-info-circle me-2"></i>
                            {{ __('You are about to cancel booking #') }}{{ $booking->id }} {{ __('for') }} {{ $booking->user->name }}.
                        </div>
                        
                        <div class="mb-3">
                            <label for="cancellation_reason" class="form-label">{{ __('Reason for Cancellation') }} <span class="text-danger">*</span></label>
                            <select name="reason" id="cancellation_reason" class="form-select" required>
                                <option value="">{{ __('Select a reason') }}</option>
                                <option value="Bad weather conditions">{{ __('Bad weather conditions') }}</option>
                                <option value="Trail closure">{{ __('Trail closure') }}</option>
                                <option value="Safety concerns">{{ __('Safety concerns') }}</option>
                                <option value="Staff unavailability">{{ __('Staff unavailability') }}</option>
                                <option value="Equipment issues">{{ __('Equipment issues') }}</option>
                                <option value="Emergency situation">{{ __('Emergency situation') }}</option>
                                <option value="Other">{{ __('Other') }}</option>
                            </select>
                        </div>

                        <div class="mb-3" id="other_reason_container" style="display: none;">
                            <label for="other_reason" class="form-label">{{ __('Please specify') }}</label>
                            <textarea name="other_reason" id="other_reason" class="form-control" rows="3" placeholder="{{ __('Please provide details...') }}"></textarea>
                        </div>

                        @if($booking->payment && $booking->payment->status === 'verified')
                            <div class="mb-3">
                                <div class="alert alert-info">
                                    <i class="bi bi-credit-card me-2"></i>
                                    {{ __('This booking has a verified payment of') }} ₱{{ number_format($booking->payment->amount, 2) }}.
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="refund_required" id="refund_required" value="1">
                                    <label class="form-check-label" for="refund_required">
                                        <strong>{{ __('Process refund for this cancellation') }}</strong>
                                        <br>
                                        <small class="text-muted">{{ __('Check this box to automatically process a refund to the customer') }}</small>
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">{{ __('Additional Notes') }} <small class="text-muted">({{ __('Optional') }})</small></label>
                            <textarea name="admin_notes" id="admin_notes" class="form-control" rows="3" placeholder="{{ __('Any additional information for internal records...') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-slash-circle me-2"></i>
                            {{ __('Cancel Booking') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show/hide other reason textarea
        document.getElementById('cancellation_reason').addEventListener('change', function() {
            const otherContainer = document.getElementById('other_reason_container');
            const otherTextarea = document.getElementById('other_reason');
            
            if (this.value === 'Other') {
                otherContainer.style.display = 'block';
                otherTextarea.required = true;
            } else {
                otherContainer.style.display = 'none';
                otherTextarea.required = false;
                otherTextarea.value = '';
            }
        });

        // Show/hide other rejection reason textarea for payment verification
        const rejectionReasonSelect = document.getElementById('rejection_reason');
        if (rejectionReasonSelect) {
            rejectionReasonSelect.addEventListener('change', function() {
                const otherContainer = document.getElementById('other_rejection_reason');
                const otherTextarea = document.getElementById('other_rejection_details');
                
                if (this.value === 'other') {
                    otherContainer.style.display = 'block';
                    otherTextarea.required = true;
                } else {
                    otherContainer.style.display = 'none';
                    otherTextarea.required = false;
                    otherTextarea.value = '';
                }
            });
        }
    </script>
@endsection