@push('styles')
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
        box-shadow: var(--shadow-lg);
        color: white;
        text-decoration: none;
    }

    /* Modern Card Design */
    .modern-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: var(--transition-base);
        margin-bottom: var(--space-6);
        backdrop-filter: blur(20px);
    }

    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .card-header-modern {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: var(--space-6);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-bold);
        color: var(--dark);
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
        padding: var(--space-3) 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        gap: var(--space-4);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: var(--font-weight-medium);
        color: var(--gray);
        font-size: var(--font-size-sm);
        min-width: 120px;
        flex-shrink: 0;
    }

    .info-value {
        color: var(--dark);
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
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        text-transform: capitalize;
    }

    .status-badge.badge-approved,
    .status-badge.badge-confirmed,
    .status-badge.badge-completed {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-badge.badge-pending,
    .status-badge.badge-payment-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #92400e;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-badge.badge-cancelled,
    .status-badge.badge-rejected {
        background: rgba(239, 68, 68, 0.1);
        color: #991b1b;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* Alert Styles */
    .alert {
        padding: var(--space-4);
        border-radius: var(--radius-lg);
        margin-bottom: var(--space-6);
        display: flex;
        align-items: center;
        gap: var(--space-3);
        font-weight: var(--font-weight-medium);
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #991b1b;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* Grid Layout */
    .grid {
        display: grid;
        gap: var(--space-6);
    }

    .grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }

    .grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    @media (min-width: 768px) {
        .md\\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    /* Button Styles */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-3) var(--space-6);
        border-radius: var(--radius-lg);
        font-weight: var(--font-weight-semibold);
        font-size: var(--font-size-sm);
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    .btn-outline-danger {
        background: transparent;
        color: var(--danger);
        border: 1px solid var(--danger);
    }

    .btn-outline-danger:hover {
        background: var(--danger);
        color: white;
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    /* Animation */
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Beautiful Modal Styles */
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .modal-backdrop:not(.hidden) {
        opacity: 1;
        visibility: visible;
    }

    .modal-wrapper {
        width: 100%;
        max-width: 480px;
        margin: 20px;
        transform: scale(0.9) translateY(20px);
        transition: transform 0.3s ease;
    }

    .modal-backdrop:not(.hidden) .modal-wrapper {
        transform: scale(1) translateY(0);
    }

    .beautiful-modal {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
    }

    .modal-close {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 32px;
        height: 32px;
        border: none;
        background: rgba(107, 114, 128, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 10;
    }

    .modal-close:hover {
        background: rgba(107, 114, 128, 0.2);
        transform: scale(1.1);
    }

    .modal-close i {
        font-size: 14px;
        color: #6b7280;
    }

    .modal-content {
        padding: 32px;
        text-align: center;
    }

    .modal-icon-section {
        margin-bottom: 24px;
    }

    .danger-icon {
        width: 64px;
        height: 64px;
        background: #fee2e2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .danger-icon i {
        font-size: 28px;
        color: #dc2626;
    }

    .modal-text-section {
        margin-bottom: 32px;
    }

    .modal-heading {
        font-size: 20px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 12px 0;
    }

    .modal-description {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.5;
        margin: 0;
    }

    .modal-form {
        text-align: left;
    }

    .input-group {
        margin-bottom: 24px;
    }

    .input-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }

    .modern-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        line-height: 1.5;
        resize: vertical;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .modern-textarea:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .modern-textarea::placeholder {
        color: #9ca3af;
    }

    .modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .btn-cancel {
        padding: 10px 20px;
        border: 1px solid #d1d5db;
        background: white;
        color: #374151;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-cancel:hover {
        background: #f9fafb;
        border-color: #9ca3af;
    }

    .btn-confirm {
        padding: 10px 20px;
        border: none;
        background: #dc2626;
        color: white;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-confirm:hover {
        background: #b91c1c;
    }

    .btn-confirm:active {
        transform: translateY(1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
             /* Mobile-specific styles for better UX */
             .quick-actions-grid {
                 grid-template-columns: 1fr;
                 gap: 12px;
             }

             .quick-action-item {
                 padding: 12px;
                 border-radius: 8px;
             }

             .action-icon-wrapper {
                 width: 40px;
                 height: 40px;
                 font-size: 18px;
                 margin-right: 10px;
             }

             .action-title {
                 font-size: 13px;
             }

             .action-subtitle {
                 font-size: 11px;
             }

             .quick-action-btn {
                 width: 32px;
                 height: 32px;
                 font-size: 14px;
             }

             /* Progress timeline mobile adjustments */
             .progress-timeline {
                 padding: 16px;
                 margin: 16px 0;
             }

             .timeline-step {
                 padding: 12px 16px;
                 margin-bottom: 8px;
             }

             .step-icon {
                 width: 32px;
                 height: 32px;
                 font-size: 14px;
             }

             .step-title {
                 font-size: 13px;
             }

             .step-description {
                 font-size: 11px;
             }

             /* Payment status banner mobile */
             .payment-status-banner {
                 padding: 12px 16px;
                 margin: 12px 0;
                 border-radius: 8px;
             }

             .payment-banner-content h4 {
                 font-size: 16px;
             }

             .payment-banner-content p {
                 font-size: 13px;
             }

             /* Action cards mobile */
             .action-card {
                 padding: 16px;
                 margin: 12px 0;
                 border-radius: 8px;
             }

             .action-card h5 {
                 font-size: 16px;
             }

             .action-card p {
                 font-size: 13px;
             }

             /* Button adjustments for mobile */
             .btn-primary-action {
                 padding: 12px 20px;
                 font-size: 14px;
                 border-radius: 8px;
             }

             /* Touch-friendly spacing */
             .row > div {
                 margin-bottom: 16px;
             }

             /* Improved text readability on mobile */
             .card-body {
                 padding: 16px;
             }

             .card-body h6 {
                 font-size: 14px;
                 margin-bottom: 8px;
             }

             .card-body p, .card-body span {
                 font-size: 13px;
                 line-height: 1.5;
             }

             /* Modal improvements for mobile */
             .modal-dialog {
                 margin: 10px;
                 max-width: calc(100% - 20px);
             }

             .modal-content {
                 border-radius: 12px;
             }

             .modal-header {
                 padding: 16px;
             }

             .modal-body {
                 padding: 16px;
             }

             .modal-footer {
                 padding: 16px;
                 flex-direction: column;
                 gap: 8px;
             }

             .modal-footer .btn {
                  width: 100%;
                  margin: 0;
              }
         }

         .container {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .grid-cols-2 {
            grid-template-columns: 1fr;
        }
        
        .info-row {
            flex-direction: column;
            gap: var(--space-2);
        }
        
        .info-value {
            text-align: left;
        }
    }

    /* Progress Timeline Styles */
    .progress-timeline {
        background: rgba(255, 255, 255, 0.95);
        border-radius: var(--radius-xl);
        padding: var(--space-6);
        margin-bottom: var(--space-6);
        box-shadow: var(--shadow-lg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .timeline-header {
        text-align: center;
        margin-bottom: var(--space-6);
    }

    .timeline-title {
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-bold);
        color: var(--dark);
        margin: 0 0 var(--space-2) 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-3);
    }

    .timeline-subtitle {
        color: var(--gray);
        font-size: var(--font-size-sm);
        margin: 0;
    }

    .timeline-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        margin: 0 2rem;
    }

    .timeline-line {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 3px;
        background: #e5e7eb;
        border-radius: 2px;
        z-index: 1;
    }

    .timeline-progress {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background: linear-gradient(90deg, var(--primary) 0%, var(--primary-hover) 100%);
        border-radius: 2px;
        transition: width 0.8s ease;
        z-index: 2;
    }

    .timeline-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 3;
        background: white;
        padding: 0 1rem;
    }

    .step-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: var(--font-weight-bold);
        margin-bottom: var(--space-3);
        transition: all 0.3s ease;
        border: 3px solid #e5e7eb;
        background: white;
        color: var(--gray);
    }

    .step-circle.active {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        transform: scale(1.1);
    }

    .step-circle.completed {
        background: var(--success);
        border-color: var(--success);
        color: white;
    }

    .step-label {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        color: var(--gray);
        text-align: center;
        min-width: 80px;
    }

    .step-label.active {
        color: var(--primary);
        font-weight: var(--font-weight-bold);
    }

    .step-label.completed {
        color: var(--success);
        font-weight: var(--font-weight-semibold);
    }

    /* Payment Status Banner Styles */
    .payment-status-banner {
        display: flex;
        align-items: center;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        border: 2px solid;
        background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(255,255,255,0.7));
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .payment-required {
        border-color: #ffc107;
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    }

    .payment-verified {
        border-color: #28a745;
        background: linear-gradient(135deg, #d4edda, #a8e6cf);
    }

    .payment-pending {
        border-color: #17a2b8;
        background: linear-gradient(135deg, #d1ecf1, #a8d8ea);
    }

    .payment-rejected {
        border-color: #dc3545;
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    }

    .payment-not-required {
        border-color: #6c757d;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }

    .status-icon {
        font-size: 32px;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .payment-required .status-icon { color: #856404; }
    .payment-verified .status-icon { color: #155724; }
    .payment-pending .status-icon { color: #0c5460; }
    .payment-rejected .status-icon { color: #721c24; }
    .payment-not-required .status-icon { color: #495057; }

    .status-content {
        flex: 1;
    }

    .status-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 4px 0;
        color: #2c3e50;
    }

    .status-message {
        font-size: 14px;
        margin: 0;
        opacity: 0.8;
        color: #495057;
    }

    .status-action {
        margin-left: 16px;
    }

    .btn-payment-action {
        background: linear-gradient(135deg, #ffc107, #ffb300);
        color: #856404;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    .btn-payment-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
        color: #856404;
        text-decoration: none;
    }

    .btn-receipt-action {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .btn-receipt-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        color: white;
        text-decoration: none;
    }

    /* Payment Details Styles */
    .payment-details {
        background: rgba(255, 255, 255, 0.7);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .payment-highlight {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        margin: 12px -8px;
        padding: 12px 16px;
        border-radius: 8px;
        border-left: 4px solid #2196f3;
    }

    .payment-highlight .info-value.highlight {
        font-size: 18px;
        font-weight: 700;
        color: #1976d2;
    }

    .payment-transaction-details {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 2px dashed rgba(0, 0, 0, 0.1);
    }

    /* Enhanced Action Card Styles */
    .action-card-content {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 24px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 16px;
        border: 2px solid #dee2e6;
    }

    .action-icon {
        font-size: 48px;
        color: #007bff;
        flex-shrink: 0;
    }

    .action-text {
        flex: 1;
    }

    .action-title {
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 8px 0;
        color: #2c3e50;
    }

    .action-description {
        font-size: 14px;
        color: #6c757d;
        margin: 0 0 12px 0;
        line-height: 1.5;
    }

    .payment-methods {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .payment-method-tag {
        background: #007bff;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .action-buttons {
        flex-shrink: 0;
    }

    .btn-primary-action {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    .btn-primary-action:hover {
             transform: translateY(-3px);
             box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
             color: white;
             text-decoration: none;
         }

         /* Quick Actions Grid Styles */
         .quick-actions-grid {
             display: grid;
             grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
             gap: 16px;
             margin-top: 8px;
         }

         .quick-action-item {
             display: flex;
             align-items: center;
             padding: 16px;
             background: linear-gradient(135deg, #ffffff, #f8f9fa);
             border: 2px solid #e9ecef;
             border-radius: 12px;
             transition: all 0.3s ease;
             position: relative;
             overflow: hidden;
         }

         .quick-action-item:hover {
             transform: translateY(-2px);
             box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
             border-color: #007bff;
         }

         .action-icon-wrapper {
             width: 48px;
             height: 48px;
             border-radius: 12px;
             display: flex;
             align-items: center;
             justify-content: center;
             font-size: 20px;
             margin-right: 12px;
             flex-shrink: 0;
         }

         .action-icon-wrapper.support {
             background: linear-gradient(135deg, #17a2b8, #138496);
             color: white;
         }

         .action-icon-wrapper.receipt {
             background: linear-gradient(135deg, #28a745, #1e7e34);
             color: white;
         }

         .action-icon-wrapper.reschedule {
             background: linear-gradient(135deg, #ffc107, #e0a800);
             color: #856404;
         }

         .action-icon-wrapper.share {
             background: linear-gradient(135deg, #6f42c1, #5a32a3);
             color: white;
         }

         .action-icon-wrapper.emergency {
             background: linear-gradient(135deg, #dc3545, #c82333);
             color: white;
         }

         .action-icon-wrapper.weather {
             background: linear-gradient(135deg, #fd7e14, #e55a00);
             color: white;
         }

         .action-content {
             flex: 1;
         }

         .action-title {
             font-size: 14px;
             font-weight: 600;
             margin: 0 0 2px 0;
             color: #2c3e50;
         }

         .action-subtitle {
             font-size: 12px;
             color: #6c757d;
             margin: 0;
         }

         .quick-action-btn {
             width: 36px;
             height: 36px;
             border-radius: 8px;
             background: #f8f9fa;
             border: 2px solid #dee2e6;
             display: flex;
             align-items: center;
             justify-content: center;
             color: #495057;
             text-decoration: none;
             transition: all 0.3s ease;
             flex-shrink: 0;
         }

         .quick-action-btn:hover {
             background: #007bff;
             border-color: #007bff;
             color: white;
             transform: scale(1.1);
             text-decoration: none;
         }

    @media (max-width: 768px) {
        .timeline-container {
            padding: 0 1rem;
        }
        
        .modern-card {
            margin: 0 0.5rem 1rem 0.5rem;
        }
        
        .card-body-modern {
            padding: 1rem;
        }

        .section-title {
            font-size: 1.1rem;
            padding: 0 0.5rem;
        }
        
        .action-card-content {
            flex-direction: column;
            text-align: center;
            gap: 16px;
        }
        
        .payment-status-banner {
            flex-direction: column;
            text-align: center;
            gap: 12px;
        }
        
        .status-action {
            margin-left: 0;
        }

        .quick-actions-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .quick-action-item {
            padding: 12px;
        }

        .action-icon-wrapper {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
    }

    /* Tooltip Styles */
    .tooltip-wrapper {
        position: relative;
        display: inline-block;
    }

    .tooltip-icon {
        width: 16px;
        height: 16px;
        background: #6c757d;
        color: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
        cursor: help;
        margin-left: 4px;
        transition: all 0.3s ease;
    }

    .tooltip-icon:hover {
        background: #007bff;
        transform: scale(1.1);
    }

    .tooltip-content {
        position: absolute;
        bottom: 125%;
        left: 50%;
        transform: translateX(-50%);
        background: #2c3e50;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .tooltip-content::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 5px solid transparent;
        border-top-color: #2c3e50;
    }

    .tooltip-wrapper:hover .tooltip-content {
        opacity: 1;
        visibility: visible;
    }

    /* Help text styles */
    .help-text {
        font-size: 12px;
        color: #6c757d;
        margin-top: 4px;
        font-style: italic;
    }

    .help-text.error {
        color: #dc3545;
        font-weight: 500;
    }

    .help-text.success {
        color: #28a745;
        font-weight: 500;
    }

    .help-text.warning {
        color: #ffc107;
        font-weight: 500;
    }

    /* Status explanation styles */
    .status-explanation {
        background: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 12px 16px;
        margin: 8px 0;
        border-radius: 0 8px 8px 0;
        font-size: 13px;
        color: #495057;
    }

    .status-explanation.pending {
        border-left-color: #ffc107;
        background: #fff9e6;
    }

    .status-explanation.approved {
        border-left-color: #17a2b8;
        background: #e6f7ff;
    }

    .status-explanation.confirmed {
        border-left-color: #28a745;
        background: #e8f5e8;
    }

    .status-explanation.cancelled {
        border-left-color: #dc3545;
        background: #ffeaea;
    }

    .status-explanation.completed {
        border-left-color: #6f42c1;
        background: #f3e8ff;
    }
</style>
@endpush

<x-app-layout>
    <div class="booking-details-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header animate-fade-in-up">
                <h1 class="page-title">
                    <i class="bi bi-calendar-check"></i>
                    Booking Details
                </h1>
                <p class="page-subtitle">View and manage your hiking booking information</p>
                <div class="header-actions">
                    <a href="{{ route('user.bookings.index') }}" class="header-btn">
                        <i class="bi bi-arrow-left"></i>
                        Back to My Bookings
                    </a>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success animate-fade-in-up">
                    <i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger animate-fade-in-up">
                    <i class="bi bi-exclamation-triangle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger animate-fade-in-up">
                    <i class="bi bi-exclamation-triangle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Hike Information -->
                <div class="modern-card animate-fade-in-up">
                    <div class="card-header-modern">
                        <h2 class="section-title">
                            <i class="bi bi-mountain section-icon"></i>
                            Hike Information
                        </h2>
                    </div>
                    <div class="card-body-modern">
                        @if($booking->hike)
                            <div class="info-row">
                                <span class="info-label">Trail</span>
                                <span class="info-value">{{ $booking->hike->trail }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Date</span>
                                <span class="info-value">{{ $booking->hike->date->format('M d, Y') }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Start Time</span>
                                <span class="info-value">{{ $booking->hike->start_time->format('h:i A') }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Length of Stay</span>
                                <span class="info-value">{{ ucfirst(str_replace('_', ' ', $booking->length_of_stay)) }}</span>
                            </div>
                            @if($booking->hike->notes)
                                <div class="info-row">
                                    <span class="info-label">Notes</span>
                                    <span class="info-value">{{ $booking->hike->notes }}</span>
                                </div>
                            @endif
                        @else
                            <div class="info-row">
                                <span class="info-label">Trail</span>
                                <span class="info-value">{{ $booking->trail ?? 'Not specified' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Date</span>
                                <span class="info-value">{{ $booking->trek_date ? $booking->trek_date->format('M d, Y') : 'Not specified' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Start Time</span>
                                <span class="info-value">{{ $booking->start_time ? $booking->start_time->format('h:i A') : 'Not specified' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Length of Stay</span>
                                <span class="info-value">{{ ucfirst(str_replace('_', ' ', $booking->length_of_stay)) }}</span>
                            </div>
                            <div class="alert alert-warning mt-3">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                This booking is not associated with a specific hike. It may be a custom booking.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Booking Status -->
                <div class="modern-card animate-fade-in-up">
                    <div class="card-header-modern">
                        <h2 class="section-title">
                            <i class="bi bi-check-circle section-icon"></i>
                            Booking Status
                        </h2>
                    </div>
                    <div class="card-body-modern">
                        <div class="info-row">
                            <span class="info-label">
                                Status
                                <div class="tooltip-wrapper">
                                    <div class="tooltip-icon">?</div>
                                    <div class="tooltip-content">
                                        @if($booking->status === 'pending')
                                            Your booking is awaiting admin approval
                                        @elseif($booking->status === 'payment_pending')
                                            Payment required to confirm your booking
                                        @elseif($booking->status === 'confirmed')
                                            Your booking is confirmed and ready
                                        @elseif($booking->status === 'completed')
                                            Your hike has been completed
                                        @elseif($booking->status === 'cancelled')
                                            This booking has been cancelled
                                        @else
                                            Current status of your booking
                                        @endif
                                    </div>
                                </div>
                            </span>
                            <span class="status-badge badge-{{ $booking->status }}">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </div>
                        
                        <!-- Status Explanation -->
                        <div class="status-explanation {{ $booking->status }}">
                            @if($booking->status === 'pending')
                                @if($booking->hike_id === null)
                                    <strong>Custom Booking Under Review:</strong> Your custom booking request is being reviewed by our admin team. You'll receive an email notification once it's approved and payment becomes available.
                                @else
                                    <strong>What's next?</strong> Your booking is under review. You'll receive an email notification once it's approved or if additional information is needed.
                                @endif
                            @elseif($booking->status === 'payment_pending')
                                <strong>Action Required:</strong> Complete your payment to secure your booking. Payment must be made within 24 hours to avoid cancellation.
                            @elseif($booking->status === 'confirmed')
                                <strong>You're all set!</strong> Your booking is confirmed. Check your email for detailed instructions and what to bring on your hike.
                            @elseif($booking->status === 'completed')
                                <strong>Thank you!</strong> We hope you enjoyed your hiking experience. Don't forget to leave a review to help other hikers.
                            @elseif($booking->status === 'cancelled')
                                <strong>Booking Cancelled:</strong> This booking has been cancelled. If you have questions about refunds, please contact support.
                            @elseif($booking->status === 'rejected')
                                <strong>Booking Not Approved:</strong> Unfortunately, your booking request could not be approved. Please contact support for more information.
                            @endif
                        </div>
                        <div class="info-row">
                            <span class="info-label">Booking ID</span>
                            <span class="info-value">#{{ $booking->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tourists</span>
                            <span class="info-value">
                                @if($booking->foreign_tourists > 0)
                                    {{ $booking->foreign_tourists }} Foreign
                                    @if($booking->local_tourists > 0), @endif
                                @endif
                                @if($booking->local_tourists > 0)
                                    {{ $booking->local_tourists }} Local
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                Total Amount
                                <div class="tooltip-wrapper">
                                    <div class="tooltip-icon">?</div>
                                    <div class="tooltip-content">
                                        Includes all fees: guide, porter, permits, and taxes
                                    </div>
                                </div>
                            </span>
                            <span class="info-value highlight">₱{{ number_format($booking->total_amount, 2) }}</span>
                        </div>
                        <div class="help-text">
                            @if($booking->status === 'payment_pending')
                                <span class="warning">⚠️ Payment deadline: {{ $booking->created_at->addHours(24)->format('M d, Y h:i A') }}</span>
                            @elseif($booking->payment && $booking->payment->status === 'verified')
                                <span class="success">✅ Payment confirmed on {{ $booking->payment->verified_at->format('M d, Y') }}</span>
                            @endif
                        </div>
                        @if($booking->approved_at)
                            <div class="info-row">
                                <span class="info-label">Approved At</span>
                                <span class="info-value">{{ $booking->approved_at->format('M d, Y h:i A') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Information -->
                @if($booking->status !== 'pending' || $booking->hike_id !== null)
                <div class="modern-card animate-fade-in-up">
                    <div class="card-header-modern">
                        <h2 class="section-title">
                            <i class="bi bi-credit-card section-icon"></i>
                            Payment Information
                        </h2>
                    </div>
                    <div class="card-body-modern">
                        <!-- Payment Status Banner -->
                        @if($booking->status === 'payment_pending')
                            <div class="payment-status-banner payment-required">
                                <div class="status-icon">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <div class="status-content">
                                    <h3 class="status-title">Payment Required</h3>
                                    <p class="status-message">Complete your payment to secure your booking</p>
                                </div>
                                <div class="status-action">
                                    <a href="{{ route('user.bookings.payment', $booking) }}" class="btn-payment-action">
                                        <i class="bi bi-credit-card"></i>
                                        Pay Now
                                    </a>
                                </div>
                            </div>
                        @elseif($booking->payment && $booking->payment->status === 'verified')
                            <div class="payment-status-banner payment-verified">
                                <div class="status-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="status-content">
                                    <h3 class="status-title">Payment Verified</h3>
                                    <p class="status-message">Your payment has been confirmed</p>
                                </div>
                                @if($booking->payment->receipt_url)
                                    <div class="status-action">
                                        <a href="{{ $booking->payment->receipt_url }}" target="_blank" class="btn-receipt-action">
                                            <i class="bi bi-download"></i>
                                            Receipt
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @elseif($booking->payment && $booking->payment->status === 'pending')
                            <div class="payment-status-banner payment-pending">
                                <div class="status-icon">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div class="status-content">
                                    <h3 class="status-title">Payment Under Review</h3>
                                    <p class="status-message">We're verifying your payment proof</p>
                                </div>
                            </div>
                        @elseif($booking->payment && $booking->payment->status === 'rejected')
                            <div class="payment-status-banner payment-rejected">
                                <div class="status-icon">
                                    <i class="bi bi-x-circle-fill"></i>
                                </div>
                                <div class="status-content">
                                    <h3 class="status-title">Payment Rejected</h3>
                                    <p class="status-message">Your payment was rejected. Please resubmit payment proof.</p>
                                </div>
                                <div class="status-action">
                                    <a href="{{ route('user.bookings.payment', $booking) }}" class="btn-payment-action">
                                        <i class="bi bi-upload"></i>
                                        Resubmit Payment
                                    </a>
                                </div>
                            </div>
                        @elseif($booking->status === 'rejected')
                            <div class="payment-status-banner payment-not-required">
                                <div class="status-icon">
                                    <i class="bi bi-info-circle-fill"></i>
                                </div>
                                <div class="status-content">
                                    <h3 class="status-title">No Payment Required</h3>
                                    <p class="status-message">Booking was not approved</p>
                                </div>
                            </div>
                        @endif

                        <!-- Payment Details -->
                        <div class="payment-details">
                            <div class="info-row">
                                <span class="info-label">Hiking Fee</span>
                                <span class="info-value">₱{{ number_format($booking->hiking_fee, 2) }}</span>
                            </div>
                            @if($booking->guide_fee > 0)
                                <div class="info-row">
                                    <span class="info-label">Guide Fee</span>
                                    <span class="info-value">₱{{ number_format($booking->guide_fee, 2) }}</span>
                                </div>
                            @endif
                            @if($booking->porter_fee > 0)
                                <div class="info-row">
                                    <span class="info-label">Porter Fee</span>
                                    <span class="info-value">₱{{ number_format($booking->porter_fee, 2) }}</span>
                                </div>
                            @endif
                            <div class="info-row payment-highlight">
                                <span class="info-label">Down Payment Required</span>
                                <span class="info-value highlight">₱{{ number_format($booking->down_payment, 2) }}</span>
                            </div>
                            
                            @if($booking->payment)
                                <div class="payment-transaction-details">
                                    <div class="info-row">
                                        <span class="info-label">Payment Method</span>
                                        <span class="info-value">{{ ucfirst($booking->payment->payment_method) }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Reference</span>
                                        <span class="info-value">{{ $booking->payment->transaction_id }}</span>
                                    </div>
                                    @if($booking->payment->verified_at)
                                        <div class="info-row">
                                            <span class="info-label">Verified At</span>
                                            <span class="info-value">{{ $booking->payment->verified_at->format('M d, Y h:i A') }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Guide and Porter Details -->
                @if($booking->guide || $booking->porter)
                    <div class="modern-card animate-fade-in-up">
                        <div class="card-header-modern">
                            <h2 class="section-title">
                                <i class="bi bi-people section-icon"></i>
                                Assigned Staff
                            </h2>
                        </div>
                        <div class="card-body-modern">
                            @if($booking->guide)
                                <div class="info-row">
                                    <span class="info-label">Guide</span>
                                    <span class="info-value">{{ $booking->guide->name }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Guide Contact</span>
                                    <span class="info-value">{{ $booking->guide->contact_number }}</span>
                                </div>
                            @endif
                            @if($booking->porter)
                                <div class="info-row">
                                    <span class="info-label">Porter</span>
                                    <span class="info-value">{{ $booking->porter->name }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Porter Contact</span>
                                    <span class="info-value">{{ $booking->porter->contact_number }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Special Requests -->
                @if($booking->special_requests)
                    <div class="modern-card animate-fade-in-up">
                        <div class="card-header-modern">
                            <h2 class="section-title">
                                <i class="bi bi-chat-text section-icon"></i>
                                Special Requests
                            </h2>
                        </div>
                        <div class="card-body-modern">
                            <p class="info-value">{{ $booking->special_requests }}</p>
                        </div>
                    </div>
                @endif

                <!-- Cancellation Details -->
                @if($booking->status === 'cancelled')
                    <div class="modern-card animate-fade-in-up">
                        <div class="card-header-modern">
                            <h2 class="section-title">
                                <i class="bi bi-x-circle section-icon"></i>
                                Cancellation Details
                            </h2>
                        </div>
                        <div class="card-body-modern">
                            <p class="info-value">{{ $booking->cancellation_reason }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Quick Actions Section -->
            <div class="modern-card animate-fade-in-up">
                <div class="card-header-modern">
                    <h2 class="section-title">
                        <i class="bi bi-lightning-charge section-icon"></i>
                        Quick Actions
                    </h2>
                </div>
                <div class="card-body-modern">
                    <div class="quick-actions-grid">
                        <!-- Contact Support -->
                        <div class="quick-action-item">
                            <div class="action-icon-wrapper support">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div class="action-content">
                                <h4 class="action-title">Contact Support</h4>
                                <p class="action-subtitle">Get help with your booking</p>
                            </div>
                            <a href="mailto:support@mtcagua.com?subject=Booking Support - {{ $booking->booking_reference }}" class="quick-action-btn">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>

                        @if($booking->payment && $booking->payment->receipt_url)
                            <!-- View Receipt -->
                            <div class="quick-action-item">
                                <div class="action-icon-wrapper receipt">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <div class="action-content">
                                    <h4 class="action-title">Download Receipt</h4>
                                    <p class="action-subtitle">Get your payment receipt</p>
                                </div>
                                <a href="{{ $booking->payment->receipt_url }}" target="_blank" class="quick-action-btn">
                                    <i class="bi bi-download"></i>
                                </a>
                            </div>
                        @endif

                        @if(in_array($booking->status, ['approved', 'confirmed']) && $booking->hike_date > now())
                            <!-- Request Reschedule -->
                            <div class="quick-action-item">
                                <div class="action-icon-wrapper reschedule">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div class="action-content">
                                    <h4 class="action-title">Request Reschedule</h4>
                                    <p class="action-subtitle">Change your hiking date</p>
                                </div>
                                <button type="button" class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#rescheduleModal">
                                    <i class="bi bi-calendar-plus"></i>
                                </button>
                            </div>
                        @endif

                        <!-- Share Booking -->
                        <div class="quick-action-item">
                            <div class="action-icon-wrapper share">
                                <i class="bi bi-share"></i>
                            </div>
                            <div class="action-content">
                                <h4 class="action-title">Share Booking</h4>
                                <p class="action-subtitle">Share with friends</p>
                            </div>
                            <button type="button" class="quick-action-btn" onclick="shareBooking()">
                                <i class="bi bi-share-fill"></i>
                            </button>
                        </div>

                        @if($booking->status === 'confirmed')
                            <!-- Emergency Contact -->
                            <div class="quick-action-item">
                                <div class="action-icon-wrapper emergency">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="action-content">
                                    <h4 class="action-title">Emergency Contact</h4>
                                    <p class="action-subtitle">24/7 hiking support</p>
                                </div>
                                <a href="tel:+639123456789" class="quick-action-btn">
                                    <i class="bi bi-telephone"></i>
                                </a>
                            </div>
                        @endif

                        <!-- Weather Updates -->
                        <div class="quick-action-item">
                            <div class="action-icon-wrapper weather">
                                <i class="bi bi-cloud-sun"></i>
                            </div>
                            <div class="action-content">
                                <h4 class="action-title">Weather Updates</h4>
                                <p class="action-subtitle">Check hiking conditions</p>
                            </div>
                            <a href="https://weather.com" target="_blank" class="quick-action-btn">
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Cards -->
            @if($booking->status === 'payment_pending')
                <div class="modern-card animate-fade-in-up">
                    <div class="card-body-modern">
                        <div class="action-card-content">
                            <div class="action-icon">
                                <i class="bi bi-credit-card-2-front"></i>
                            </div>
                            <div class="action-text">
                                <h3 class="action-title">Complete Your Payment</h3>
                                <p class="action-description">
                                    Upload your payment proof to secure your hiking spot. 
                                    Down payment: <strong>₱{{ number_format($booking->down_payment, 2) }}</strong>
                                </p>
                                <div class="payment-methods">
                                    <span class="payment-method-tag">GCash</span>
                                    <span class="payment-method-tag">Bank Transfer</span>
                                    <span class="payment-method-tag">PayMaya</span>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('user.bookings.payment', $booking) }}" class="btn-primary-action">
                                    <i class="bi bi-upload"></i>
                                    Upload Payment Proof
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($booking->status === 'pending')
                <div class="modern-card animate-fade-in-up">
                    <div class="card-body-modern">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Manage Booking</h3>
                                <p class="text-gray-600">You can cancel this booking if needed.</p>
                            </div>
                            <button type="button" 
                                    onclick="showCancelModal()" 
                                    class="btn btn-outline-danger">
                                <i class="bi bi-x-circle"></i>
                                Cancel Booking
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Beautiful Cancel Booking Modal - Only show for pending bookings -->
    @if($booking->status === 'pending')
        <div id="cancelModal" class="modal-backdrop">
            <div class="modal-wrapper">
                <div class="beautiful-modal">
                    <!-- Close Button -->
                    <button type="button" onclick="hideCancelModal()" class="modal-close">
                        <i class="bi bi-x-lg"></i>
                    </button>

                    <!-- Modal Content -->
                    <div class="modal-content">
                        <!-- Icon Section -->
                        <div class="modal-icon-section">
                            <div class="danger-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>

                        <!-- Text Section -->
                        <div class="modal-text-section">
                            <h3 class="modal-heading">Cancel Booking</h3>
                            <p class="modal-description">
                                Are you sure you want to cancel this booking? This action cannot be undone and may affect your future reservations.
                            </p>
                        </div>

                        <!-- Form Section -->
                        <form action="{{ route('user.bookings.cancel', $booking) }}" method="POST" class="modal-form">
                            @csrf
                            @method('PATCH')
                            
                            <div class="input-group">
                                <label for="cancellation_reason" class="input-label">
                                    Reason for cancellation
                                </label>
                                <textarea 
                                    id="cancellation_reason" 
                                    name="cancellation_reason" 
                                    rows="3" 
                                    class="modern-textarea"
                                    placeholder="Please tell us why you're cancelling..."
                                    required
                                ></textarea>
                            </div>

                            <!-- Button Section -->
                            <div class="modal-buttons">
                                <button type="button" onclick="hideCancelModal()" class="btn-cancel">
                                    Keep Booking
                                </button>
                                <button type="submit" class="btn-confirm">
                                    Yes, Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            function showCancelModal() {
                document.getElementById('cancelModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function hideCancelModal() {
                document.getElementById('cancelModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Close modal when clicking outside
            document.getElementById('cancelModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideCancelModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideCancelModal();
                }
            });
        </script>
        @endpush
    @endif
</x-app-layout>