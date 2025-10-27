<x-app-layout>
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
            
            /* Dark Mode Colors */
            --dark-bg-primary: #0f172a;
            --dark-bg-secondary: #1e293b;
            --dark-bg-tertiary: #334155;
            --dark-text-primary: #f8fafc;
            --dark-text-secondary: #cbd5e1;
            --dark-border: #475569;
            
            /* Light Mode Colors */
            --light-bg-primary: #ffffff;
            --light-bg-secondary: #f8fafc;
            --light-bg-tertiary: #f1f5f9;
            --light-text-primary: #0f172a;
            --light-text-secondary: #475569;
            --light-border: #e2e8f0;
            
            /* Dynamic Colors */
            --bg-primary: var(--light-bg-primary);
            --bg-secondary: var(--light-bg-secondary);
            --bg-tertiary: var(--light-bg-tertiary);
            --text-primary: var(--light-text-primary);
            --text-secondary: var(--light-text-secondary);
            --border-primary: var(--light-border);
            
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
            
            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-3xl: 2rem;
            
            /* Shadows */
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            
            /* Transitions */
            --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            
            /* Typography */
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            --font-size-5xl: 3rem;
            
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
            --font-weight-extrabold: 800;
        }
        
        /* Dark mode */
        [data-theme="dark"] {
            --bg-primary: var(--dark-bg-primary);
            --bg-secondary: var(--dark-bg-secondary);
            --bg-tertiary: var(--dark-bg-tertiary);
            --text-primary: var(--dark-text-primary);
            --text-secondary: var(--dark-text-secondary);
            --border-primary: var(--dark-border);
        }
        
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        /* Enhanced Payment Details Styles */
        .payment-header {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            margin-bottom: var(--space-8);
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-2xl);
        }
        
        .payment-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            pointer-events: none;
        }
        
        .payment-title {
            font-size: var(--font-size-3xl);
            font-weight: var(--font-weight-extrabold);
            margin: 0 0 var(--space-2) 0;
            letter-spacing: -0.025em;
        }
        
        .payment-subtitle {
            font-size: var(--font-size-lg);
            opacity: 0.9;
            margin: 0;
            font-weight: var(--font-weight-medium);
        }
        
        .back-btn {
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
            margin-top: var(--space-4);
        }
        
        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
            text-decoration: none;
        }
        
        .info-card {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-primary);
            transition: var(--transition-base);
            position: relative;
            overflow: hidden;
        }
        
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
        }
        
        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        
        .info-card h3 {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            margin: 0 0 var(--space-6) 0;
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .info-card-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-lg);
            background: var(--primary-50);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-lg);
        }
        
        [data-theme="dark"] .info-card-icon {
            background: rgba(99, 102, 241, 0.1);
        }
        
        .info-content {
            background: var(--bg-secondary);
            padding: var(--space-5);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-primary);
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-3) 0;
            border-bottom: 1px solid var(--border-primary);
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: var(--font-weight-semibold);
            color: var(--text-secondary);
            font-size: var(--font-size-sm);
        }
        
        .info-value {
            font-weight: var(--font-weight-medium);
            color: var(--text-primary);
            font-size: var(--font-size-sm);
        }
        
        .status-badge {
            padding: var(--space-2) var(--space-4);
            border-radius: var(--radius-lg);
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-semibold);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
        }
        
        .status-verified {
            background: var(--success-100);
            color: var(--success-dark);
            border: 1px solid var(--success-200);
        }
        
        .status-pending {
            background: var(--warning-100);
            color: var(--warning-dark);
            border: 1px solid var(--warning-200);
        }
        
        .receipt-section {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-primary);
            margin-top: var(--space-8);
        }
        
        .receipt-container {
            background: var(--bg-secondary);
            border-radius: var(--radius-xl);
            padding: var(--space-8);
            text-align: center;
            border: 2px dashed var(--border-primary);
            transition: var(--transition-base);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--space-4);
        }
        
        .receipt-container:hover {
            border-color: var(--primary);
            background: var(--primary-50);
        }
        
        [data-theme="dark"] .receipt-container:hover {
            background: rgba(99, 102, 241, 0.05);
        }
        
        .receipt-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--space-4);
            color: var(--text-secondary);
        }
        
        .receipt-icon {
            width: 64px;
            height: 64px;
            background: var(--primary-100);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }
        
        .receipt-text {
            text-align: center;
        }
        
        .receipt-title {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-semibold);
            color: var(--text-primary);
            margin: 0 0 var(--space-1) 0;
        }
        
        .receipt-description {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            margin: 0;
        }
        
        .view-full-btn {
            padding: var(--space-3) var(--space-4);
            border-radius: var(--radius-lg);
            font-weight: var(--font-weight-semibold);
            font-size: var(--font-size-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            transition: var(--transition-bounce);
            border: 2px solid transparent;
            text-decoration: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-width: 140px;
            white-space: nowrap;
            background: var(--primary);
            color: white;
            border-color: var(--primary-dark);
        }
        
        .view-full-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, currentColor 0%, currentColor 100%);
            opacity: 0;
            transition: var(--transition-base);
        }
        
        .view-full-btn:hover::before {
            opacity: 0.1;
        }
        
        .view-full-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: var(--shadow-xl);
            background: var(--primary-dark);
            color: white;
            text-decoration: none;
        }
        
        .actions-section {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-primary);
            margin-top: var(--space-8);
        }
        
        .actions-grid {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-3);
            margin-top: var(--space-4);
        }
        
        .action-btn {
            padding: var(--space-3) var(--space-4);
            border-radius: var(--radius-lg);
            font-weight: var(--font-weight-semibold);
            font-size: var(--font-size-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            transition: var(--transition-bounce);
            border: 2px solid transparent;
            text-decoration: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-width: 140px;
            white-space: nowrap;
        }
        
        .action-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, currentColor 0%, currentColor 100%);
            opacity: 0;
            transition: var(--transition-base);
        }
        
        .action-btn:hover::before {
            opacity: 0.1;
        }
        
        .action-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }
        
        .btn-verify {
            background: var(--success);
            color: white;
            border-color: var(--success-dark);
        }
        
        .btn-verify:hover {
            background: var(--success-dark);
            color: white;
        }
        
        .btn-reject {
            background: var(--danger);
            color: white;
            border-color: var(--danger-dark);
        }
        
        .btn-reject:hover {
            background: var(--danger-dark);
            color: white;
        }
        
        .btn-flag {
            background: var(--warning);
            color: white;
            border-color: var(--warning-dark);
        }
        
        .btn-flag:hover {
            background: var(--warning-dark);
            color: white;
        }
        
        .audit-section {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-primary);
            margin-top: var(--space-8);
        }
        
        .audit-link {
            padding: var(--space-3) var(--space-4);
            border-radius: var(--radius-lg);
            font-weight: var(--font-weight-semibold);
            font-size: var(--font-size-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            transition: var(--transition-bounce);
            border: 2px solid transparent;
            text-decoration: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-width: 140px;
            white-space: nowrap;
            background: var(--primary);
            color: white;
            border-color: var(--primary-dark);
        }
        
        .audit-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, currentColor 0%, currentColor 100%);
            opacity: 0;
            transition: var(--transition-base);
        }
        
        .audit-link:hover::before {
            opacity: 0.1;
        }
        
        .audit-link:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: var(--shadow-xl);
            background: var(--primary-dark);
            color: white;
            text-decoration: none;
        }
        
        [data-theme="dark"] .audit-link {
            background: #6366f1;
            border-color: #4f46e5;
        }
        
        [data-theme="dark"] .audit-link:hover {
            background: #4f46e5;
            border-color: #3730a3;
        }
        
        /* Alert Styles */
        .alert {
            padding: var(--space-4);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-6);
            border: 1px solid;
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-weight: var(--font-weight-medium);
        }
        
        .alert-success {
            background: var(--success-50);
            color: var(--success-dark);
            border-color: var(--success-200);
        }
        
        .alert-error {
            background: var(--danger-50);
            color: var(--danger-dark);
            border-color: var(--danger-200);
        }
        
        /* Modal Enhancements */
        .modal-overlay {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
        }
        
        .modal-content {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-2xl);
            border: 1px solid var(--border-primary);
        }
        
        /* Ensure modals are properly hidden and positioned */
        .modal-hidden {
            display: none !important;
        }
        
        .modal-overlay-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .payment-header {
                padding: var(--space-6);
                margin-bottom: var(--space-6);
            }
            
            .payment-title {
                font-size: var(--font-size-2xl);
            }
            
            .info-card {
                padding: var(--space-4);
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @endpush

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Enhanced Payment Header -->
            <div class="payment-header">
                <h1 class="payment-title">Payment Details</h1>
                <p class="payment-subtitle">Payment ID: #{{ $payment->id }} • {{ $payment->created_at->format('M d, Y h:i A') }}</p>
                <a href="{{ route('admin.payments.index') }}" class="back-btn">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Payments
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Payment Information Card -->
                <div class="info-card">
                    <h3>
                        <div class="info-card-icon">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        Payment Information
                    </h3>
                    <div class="info-content">
                        <div class="info-row">
                            <span class="info-label">Payment ID</span>
                            <span class="info-value">#{{ $payment->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Amount</span>
                            <span class="info-value" style="color: var(--success); font-weight: var(--font-weight-bold); font-size: var(--font-size-lg);">₱{{ number_format($payment->amount, 2) }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Payment Method</span>
                            <span class="info-value">{{ ucfirst($payment->payment_method) }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Reference Number</span>
                            <span class="info-value">{{ $payment->transaction_id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="status-badge {{ $payment->verified_at ? 'status-verified' : 'status-pending' }}">
                                @if($payment->verified_at)
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                {{ $payment->verified_at ? 'Verified' : 'Pending' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Submitted At</span>
                            <span class="info-value">{{ $payment->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        @if($payment->verified_at)
                        <div class="info-row">
                            <span class="info-label">Verified At</span>
                            <span class="info-value">{{ $payment->verified_at->format('M d, Y h:i A') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Customer Information Card -->
                <div class="info-card">
                    <h3>
                        <div class="info-card-icon">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        Customer Information
                    </h3>
                    <div class="info-content">
                        <div class="info-row">
                            <span class="info-label">Name</span>
                            <span class="info-value">{{ $payment->booking->user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $payment->booking->user->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Contact Number</span>
                            <span class="info-value">{{ $payment->booking->user->contact_number }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Booking ID</span>
                            <span class="info-value">#{{ $payment->booking->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Hike Date</span>
                            <span class="info-value">{{ $payment->booking->hike->date->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($payment->receipt_url)
                <!-- Enhanced Receipt Section -->
                <div class="receipt-section">
                    <h3>
                        <div class="info-card-icon">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        Payment Receipt
                    </h3>
                    <div class="receipt-container">
                        <div class="receipt-placeholder">
                            <div class="receipt-icon">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="receipt-text">
                                <h4 class="receipt-title">Payment Receipt Available</h4>
                                <p class="receipt-description">Click the button below to view the payment receipt in full size</p>
                            </div>
                        </div>
                        <button onclick="openImageModal('{{ $payment->receipt_url }}')" 
                                class="view-full-btn">
                            View Full Size
                        </button>
                    </div>
                </div>
            @endif

            <!-- Enhanced Actions Section -->
            <div class="actions-section">
                <h3>
                    <div class="info-card-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    Payment Actions
                </h3>
                <div class="actions-grid">
                    @if(!$payment->verified_at)
                        <form action="{{ route('admin.payments.verify', $payment) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to verify this payment? This action cannot be undone.')"
                                    class="action-btn btn-verify">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Verify Payment
                            </button>
                        </form>
                    @endif

                    <button type="button" 
                            class="action-btn btn-reject" 
                            onclick="toggleRejectForm()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Reject Payment
                    </button>

                    <button type="button" 
                            class="action-btn btn-flag" 
                            onclick="toggleFlagForm()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 2H21l-3 6 3 6h-8.5l-1-2H5a2 2 0 00-2 2zm9-13.5V9"></path>
                        </svg>
                        Flag for Review
                    </button>
                </div>
            </div>

            <!-- Flag for Review Inline Form -->
            <div id="flagForm" class="modal-hidden" style="margin-top: var(--space-6);">
                <div class="info-card">
                    <h3>
                        <div class="info-card-icon" style="background: var(--warning-100); color: var(--warning-600);">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        Flag Payment for Review
                    </h3>
                    <p style="color: var(--text-secondary); margin-bottom: var(--space-4);">
                        Please describe the issue or concern with this payment that requires review.
                    </p>
                    
                    <form method="POST" action="{{ route('admin.payments.flag', $payment) }}" id="flagPaymentForm">
                        @csrf
                        <div style="margin-bottom: var(--space-4);">
                            <label for="issue_description" style="display: block; font-weight: 600; margin-bottom: var(--space-2); color: var(--text-primary);">
                                Issue Description *
                            </label>
                            <textarea 
                                id="issue_description" 
                                name="issue_description" 
                                rows="4" 
                                required
                                placeholder="Describe the issue or concern with this payment..."
                                style="width: 100%; padding: var(--space-3); border: 2px solid var(--border-color); border-radius: var(--border-radius); font-size: 14px; line-height: 1.5; resize: vertical; min-height: 100px;"
                                oninput="updateFlagCharCount(this)"></textarea>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: var(--space-2);">
                                <small id="flagCharCount" style="color: var(--text-secondary);">0 characters (minimum 10 required)</small>
                                <small id="flagValidation" style="color: var(--error-600); display: none;">Please provide at least 10 characters</small>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: var(--space-3); justify-content: flex-end;">
                            <button type="button" 
                                    onclick="toggleFlagForm()" 
                                    class="action-btn"
                                    style="background: var(--neutral-200); color: var(--text-primary); border: 1px solid var(--border-color);">
                                Cancel
                            </button>
                            <button type="submit" 
                                    id="flagSubmitBtn"
                                    class="action-btn btn-flag"
                                    disabled>
                                <span id="flagBtnText">Flag for Review</span>
                                <span id="flagBtnLoading" style="display: none;">
                                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Reject Payment Inline Form -->
            <div id="rejectForm" class="modal-hidden" style="margin-top: var(--space-6);">
                <div class="info-card">
                    <h3>
                        <div class="info-card-icon" style="background: var(--error-100); color: var(--error-600);">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        Reject Payment - Important Notice
                    </h3>
                    <div style="background: var(--error-50); border: 1px solid var(--error-200); border-radius: var(--border-radius); padding: var(--space-4); margin-bottom: var(--space-4);">
                        <p style="color: var(--error-700); font-weight: 600; margin-bottom: var(--space-2);">⚠️ Warning: This action cannot be undone</p>
                        <p style="color: var(--error-600); font-size: 14px;">
                            Rejecting this payment will permanently mark it as rejected and notify the customer. Please ensure you have a valid reason for rejection.
                        </p>
                    </div>
                    
                    <form method="POST" action="{{ route('admin.payments.reject', $payment) }}" id="rejectPaymentForm">
                        @csrf
                        @method('PATCH')
                        <div style="margin-bottom: var(--space-4);">
                            <label for="rejection_reason" style="display: block; font-weight: 600; margin-bottom: var(--space-2); color: var(--text-primary);">
                                Rejection Reason *
                            </label>
                            <textarea 
                                id="rejection_reason" 
                                name="rejection_reason" 
                                rows="4" 
                                required
                                placeholder="Provide a clear reason for rejecting this payment..."
                                style="width: 100%; padding: var(--space-3); border: 2px solid var(--border-color); border-radius: var(--border-radius); font-size: 14px; line-height: 1.5; resize: vertical; min-height: 100px;"
                                oninput="updateRejectCharCount(this)"></textarea>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: var(--space-2);">
                                <small id="rejectCharCount" style="color: var(--text-secondary);">0 characters (minimum 10 required)</small>
                                <small id="rejectValidation" style="color: var(--error-600); display: none;">Please provide at least 10 characters</small>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: var(--space-3); justify-content: flex-end;">
                            <button type="button" 
                                    onclick="toggleRejectForm()" 
                                    class="action-btn"
                                    style="background: var(--neutral-200); color: var(--text-primary); border: 1px solid var(--border-color);">
                                Cancel
                            </button>
                            <button type="submit" 
                                    id="rejectSubmitBtn"
                                    class="action-btn btn-reject"
                                    disabled>
                                <span id="rejectBtnText">Reject Payment</span>
                                <span id="rejectBtnLoading" style="display: none;">
                                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Enhanced Audit Trail Section -->
            <div class="audit-section">
                <h3>
                    <div class="info-card-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    Audit Trail
                </h3>
                <p style="color: var(--text-secondary); margin-bottom: var(--space-6);">View detailed history and changes for this payment.</p>
                <div style="text-align: center;">
                    <button onclick="toggleAuditTrail()" class="audit-link">
                        <span id="auditTrailButtonText">View Audit Trail</span>
                    </button>
                </div>

                <!-- Inline Audit Trail Content -->
                <div id="auditTrailContent" style="display: none; margin-top: var(--space-6);">
                    <div style="border-top: 1px solid var(--border-color); padding-top: var(--space-6);">
                        <h4 style="font-size: 1.1rem; font-weight: 600; margin-bottom: var(--space-4); color: var(--text-primary);">Activity Timeline</h4>
                        
                        <div class="flow-root">
                            <ul role="list" style="margin-bottom: -2rem;">
                                @foreach($auditTrail as $event)
                                    <li>
                                        <div style="position: relative; padding-bottom: 2rem;">
                                            @if(!$loop->last)
                                                <span style="position: absolute; top: 1rem; left: 1rem; margin-left: -1px; height: 100%; width: 2px; background-color: var(--border-color);" aria-hidden="true"></span>
                                            @endif
                                            <div style="position: relative; display: flex; gap: 0.75rem;">
                                                <div>
                                                    <span style="height: 2rem; width: 2rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 8px solid var(--bg-primary);
                                                        {{ $event['action'] === 'Payment Verified' ? 'background-color: #10b981;' :
                                                           ($event['action'] === 'Flagged for Review' ? 'background-color: #f59e0b;' :
                                                           ($event['action'] === 'Payment Refunded' ? 'background-color: #ef4444;' : 'background-color: #6b7280;')) }}">
                                                        <!-- Icon based on action -->
                                                        @if($event['action'] === 'Payment Verified')
                                                            <svg style="height: 1.25rem; width: 1.25rem; color: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                        @elseif($event['action'] === 'Flagged for Review')
                                                            <svg style="height: 1.25rem; width: 1.25rem; color: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                            </svg>
                                                        @elseif($event['action'] === 'Payment Refunded')
                                                            <svg style="height: 1.25rem; width: 1.25rem; color: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                                            </svg>
                                                        @else
                                                            <svg style="height: 1.25rem; width: 1.25rem; color: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                                                            </svg>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div style="min-width: 0; flex: 1; padding-top: 0.375rem; display: flex; justify-content: space-between; gap: 1rem;">
                                                    <div>
                                                        <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0;">
                                                            {{ $event['action'] }}
                                                            <span style="font-weight: 500; color: var(--text-primary);">
                                                                {{ $event['details'] }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div style="text-align: right; font-size: 0.875rem; white-space: nowrap; color: var(--text-secondary);">
                                                        <time datetime="{{ $event['timestamp'] }}">
                                                            {{ $event['timestamp']->format('M d, Y h:i A') }}
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal for Receipt Viewing -->
    <div id="imageModal" class="modal-hidden modal-overlay-fixed bg-black bg-opacity-75">
        <div class="relative max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="Receipt" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white bg-red-600 hover:bg-red-700 rounded-full p-2 transition-all z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <script>
        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('modal-hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('modal-hidden');
        }

        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Inline Form Toggle Functions
        function toggleFlagForm() {
            const flagForm = document.getElementById('flagForm');
            const isHidden = flagForm.classList.contains('modal-hidden');
            
            if (isHidden) {
                flagForm.classList.remove('modal-hidden');
                document.getElementById('issue_description').focus();
                // Hide reject form if it's open
                document.getElementById('rejectForm').classList.add('modal-hidden');
            } else {
                flagForm.classList.add('modal-hidden');
                document.getElementById('issue_description').value = '';
            }
        }

        function toggleAuditTrail() {
            const auditContent = document.getElementById('auditTrailContent');
            const buttonText = document.getElementById('auditTrailButtonText');
            const isHidden = auditContent.style.display === 'none';
            
            if (isHidden) {
                auditContent.style.display = 'block';
                buttonText.textContent = 'Hide Audit Trail';
            } else {
                auditContent.style.display = 'none';
                buttonText.textContent = 'View Audit Trail';
            }
        }

        function toggleRejectForm() {
            const rejectForm = document.getElementById('rejectForm');
            const isHidden = rejectForm.classList.contains('modal-hidden');
            
            if (isHidden) {
                rejectForm.classList.remove('modal-hidden');
                document.getElementById('rejection_reason').focus();
                // Hide flag form if it's open
                document.getElementById('flagForm').classList.add('modal-hidden');
            } else {
                rejectForm.classList.add('modal-hidden');
                document.getElementById('rejection_reason').value = '';
            }
        }

        // Character counter functions
        function updateFlagCharCount(textarea) {
            const charCount = document.getElementById('flagCharCount');
            const validation = document.getElementById('flagValidation');
            const submitBtn = document.getElementById('flagSubmitBtn');
            const length = textarea.value.length;
            
            charCount.textContent = `${length} characters (minimum 10 required)`;
            
            if (length >= 10) {
                validation.style.display = 'none';
                submitBtn.disabled = false;
                charCount.style.color = 'var(--success-600)';
            } else {
                validation.style.display = 'block';
                submitBtn.disabled = true;
                charCount.style.color = 'var(--text-secondary)';
            }
        }

        function updateRejectCharCount(textarea) {
            const charCount = document.getElementById('rejectCharCount');
            const validation = document.getElementById('rejectValidation');
            const submitBtn = document.getElementById('rejectSubmitBtn');
            const length = textarea.value.length;
            
            charCount.textContent = `${length} characters (minimum 10 required)`;
            
            if (length >= 10) {
                validation.style.display = 'none';
                submitBtn.disabled = false;
                charCount.style.color = 'var(--success-600)';
            } else {
                validation.style.display = 'block';
                submitBtn.disabled = true;
                charCount.style.color = 'var(--text-secondary)';
            }
        }

        // Form submission handling
        document.addEventListener('DOMContentLoaded', function() {
            // Flag form validation and submission
            const flagForm = document.getElementById('flagPaymentForm');
            if (flagForm) {
                flagForm.addEventListener('submit', function(e) {
                    const textarea = document.getElementById('issue_description');
                    if (textarea.value.trim().length < 10) {
                        e.preventDefault();
                        return false;
                    }
                    
                    // Show loading state
                    const submitBtn = document.getElementById('flagSubmitBtn');
                    const btnText = document.getElementById('flagBtnText');
                    const btnLoading = document.getElementById('flagBtnLoading');
                    
                    submitBtn.disabled = true;
                    btnText.style.display = 'none';
                    btnLoading.style.display = 'flex';
                });
            }

            // Reject form validation and submission
            const rejectForm = document.getElementById('rejectPaymentForm');
            if (rejectForm) {
                rejectForm.addEventListener('submit', function(e) {
                    const textarea = document.getElementById('rejection_reason');
                    if (textarea.value.trim().length < 10) {
                        e.preventDefault();
                        return false;
                    }
                    
                    // Confirmation dialog
                    if (!confirm('Are you sure you want to reject this payment? This action cannot be undone.')) {
                        e.preventDefault();
                        return false;
                    }
                    
                    // Show loading state
                    const submitBtn = document.getElementById('rejectSubmitBtn');
                    const btnText = document.getElementById('rejectBtnText');
                    const btnLoading = document.getElementById('rejectBtnLoading');
                    
                    submitBtn.disabled = true;
                    btnText.style.display = 'none';
                    btnLoading.style.display = 'flex';
                });
            }
        });
    </script>
</x-app-layout>