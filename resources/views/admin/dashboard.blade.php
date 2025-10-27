<x-app-layout>
    @push('styles')
    <!-- Google Fonts - Inter for modern typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* Modern Admin Dashboard Design System with Dark Mode */
        :root {
            /* Brand Colors - Enhanced */
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
            
            /* Light Mode Colors */
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --bg-tertiary: #f3f4f6;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-tertiary: #9ca3af;
            --border-primary: #e5e7eb;
            --border-secondary: #d1d5db;
            
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
            
            /* Typography - Enhanced with Inter */
            --font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            --font-size-5xl: 3rem;
            
            --font-weight-light: 300;
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
            --font-weight-extrabold: 800;
            --font-weight-black: 900;
            
            --line-height-tight: 1.25;
            --line-height-snug: 1.375;
            --line-height-normal: 1.5;
            --line-height-relaxed: 1.625;
            
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
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-3xl: 2rem;
            --radius-full: 9999px;
            
            /* Shadows - Enhanced */
            --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            
            /* Glassmorphism */
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --glass-backdrop: blur(16px);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 200ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: 300ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        /* Dark Mode Variables */
        [data-theme="dark"] {
            --bg-primary: #1f2937;
            --bg-secondary: #111827;
            --bg-tertiary: #0f172a;
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --text-tertiary: #9ca3af;
            --border-primary: #374151;
            --border-secondary: #4b5563;
            
            --glass-bg: rgba(31, 41, 55, 0.25);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        
        /* Theme Toggle Button */
        /* Global Styles */
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: var(--font-family);
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            line-height: var(--line-height-normal);
            transition: var(--transition-base);
        }
        
        /* Dashboard Container */
        .dashboard-container {
            background: var(--bg-secondary);
            min-height: 100vh;
            padding: var(--space-6) 0;
            transition: var(--transition-base);
        }
        
        /* Breadcrumb Navigation */
        .breadcrumb-nav {
            background: var(--bg-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-4) var(--space-6);
            margin-bottom: var(--space-6);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-primary);
        }
        
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            margin: 0;
            padding: 0;
            list-style: none;
            font-size: var(--font-size-sm);
        }
        
        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            color: var(--text-secondary);
        }
        
        .breadcrumb-item.active {
            color: var(--text-primary);
            font-weight: var(--font-weight-semibold);
        }
        
        .breadcrumb-separator {
            color: var(--text-tertiary);
        }
        
        /* Header Styles - Enhanced */
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            margin-bottom: var(--space-8);
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-2xl);
        }
        
        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            pointer-events: none;
        }
        
        .dashboard-title {
            font-size: var(--font-size-5xl);
            font-weight: var(--font-weight-black);
            margin: 0 0 var(--space-2) 0;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, #ffffff 0%, rgba(255,255,255,0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .dashboard-subtitle {
            font-size: var(--font-size-lg);
            opacity: 0.9;
            margin: 0;
            font-weight: var(--font-weight-medium);
        }
        
        .header-actions {
            display: flex;
            gap: var(--space-4);
            flex-wrap: wrap;
            margin-top: var(--space-6);
        }
        
        .header-btn {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
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
            backdrop-filter: var(--glass-backdrop);
        }
        
        .header-btn:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px) scale(1.02);
            box-shadow: var(--shadow-xl);
            color: white;
            text-decoration: none;
        }
        
        .refresh-btn {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: white;
            width: 48px;
            height: 48px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-bounce);
            cursor: pointer;
            backdrop-filter: var(--glass-backdrop);
        }
        
        .refresh-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(180deg) scale(1.1);
        }
        
        /* Stats Grid - Enhanced */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }
        
        .stat-card {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-primary);
            transition: var(--transition-bounce);
            position: relative;
            overflow: hidden;
            backdrop-filter: var(--glass-backdrop);
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-2xl);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--accent-color);
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }
        
        .stat-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, var(--accent-color)10 0%, transparent 70%);
            opacity: 0.05;
            pointer-events: none;
        }
        
        .stat-card.primary { --accent-color: var(--primary); }
        .stat-card.success { --accent-color: var(--success); }
        .stat-card.warning { --accent-color: var(--warning); }
        .stat-card.danger { --accent-color: var(--danger); }
        .stat-card.info { --accent-color: var(--info); }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: var(--space-4);
        }
        
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-2xl);
            margin-bottom: var(--space-4);
            position: relative;
            overflow: hidden;
        }
        
        .stat-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--accent-color);
            opacity: 0.1;
            border-radius: inherit;
        }
        
        .stat-icon.primary { color: var(--primary-600); }
        .stat-icon.success { color: var(--success); }
        .stat-icon.warning { color: var(--warning); }
        .stat-icon.danger { color: var(--danger); }
        .stat-icon.info { color: var(--info); }
        
        .stat-value {
            font-size: var(--font-size-4xl);
            font-weight: var(--font-weight-black);
            color: var(--text-primary);
            margin: 0 0 var(--space-1) 0;
            line-height: var(--line-height-tight);
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--text-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-label {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            font-weight: var(--font-weight-semibold);
            margin: 0 0 var(--space-4) 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .stat-change {
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-bold);
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            backdrop-filter: blur(8px);
        }
        
        .stat-change.positive {
            background: var(--success-50);
            color: var(--success);
            border: 1px solid var(--success-100);
        }
        
        .stat-change.negative {
            background: var(--danger-50);
            color: var(--danger);
            border: 1px solid var(--danger-100);
        }
        
        .stat-change.neutral {
            background: var(--gray-100);
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }
        
        /* Dark mode adjustments for stat changes */
        [data-theme="dark"] .stat-change.positive {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        
        [data-theme="dark"] .stat-change.negative {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        [data-theme="dark"] .stat-change.neutral {
            background: var(--gray-800);
            color: var(--gray-400);
            border: 1px solid var(--gray-700);
        }
        
        /* Quick Actions Section */
        .quick-actions {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            margin-bottom: var(--space-8);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-primary);
        }
        
        .quick-actions h3 {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            margin: 0 0 var(--space-6) 0;
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-4);
        }
        
        .action-btn {
            background: var(--bg-secondary);
            border: 2px solid var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-4);
            text-decoration: none;
            color: var(--text-primary);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--space-3);
            transition: var(--transition-bounce);
            position: relative;
            overflow: hidden;
        }
        
        .action-btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
            color: var(--text-primary);
            text-decoration: none;
        }
        
        .action-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            opacity: 0;
            transition: var(--transition-base);
        }
        
        .action-btn:hover::before {
            opacity: 0.05;
        }
        
        .action-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-lg);
            background: var(--primary-50);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-xl);
            position: relative;
            z-index: 1;
        }
        
        [data-theme="dark"] .action-icon {
            background: rgba(99, 102, 241, 0.1);
        }
        
        .action-label {
            font-weight: var(--font-weight-semibold);
            font-size: var(--font-size-sm);
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        /* Recent Activity Section */
        .recent-activity {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            margin-bottom: var(--space-8);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-primary);
        }
        
        .recent-activity h3 {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            margin: 0 0 var(--space-6) 0;
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-4);
            border-radius: var(--radius-lg);
            transition: var(--transition-base);
            border: 1px solid transparent;
        }
        
        .activity-item:hover {
            background: var(--bg-secondary);
            border-color: var(--border-primary);
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-lg);
            flex-shrink: 0;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: var(--font-weight-semibold);
            color: var(--text-primary);
            margin: 0 0 var(--space-1) 0;
            font-size: var(--font-size-sm);
        }
        
        .activity-description {
            color: var(--text-secondary);
            font-size: var(--font-size-xs);
            margin: 0;
        }
        
        .activity-time {
            color: var(--text-tertiary);
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-medium);
        }
        
        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }
        
        .chart-card {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-primary);
            min-width: 350px;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-6);
        }
        
        .chart-title {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            margin: 0;
        }
        
        .chart-period {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            background: var(--bg-secondary);
            padding: var(--space-2) var(--space-4);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-primary);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: var(--space-4) 0;
            }
            
            .dashboard-header {
                padding: var(--space-6);
                margin-bottom: var(--space-6);
            }
            
            .dashboard-title {
                font-size: var(--font-size-3xl);
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: var(--space-4);
            }
            
            .charts-section {
                display: flex;
                overflow-x: auto;
                gap: var(--space-4);
                padding-bottom: var(--space-2);
                scroll-snap-type: x mandatory;
            }
            
            .chart-card {
                flex: 0 0 auto;
                width: 320px;
                scroll-snap-align: start;
            }
            
            .chart-container {
                height: 250px;
            }
            
            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .actions-grid {
                grid-template-columns: 1fr;
            }
            
            .header-actions {
                flex-direction: column;
                align-items: stretch;
            }
            
            .header-btn {
                justify-content: center;
            }
        }
        
        /* Loading States */
        .skeleton {
            background: linear-gradient(90deg, var(--bg-secondary) 25%, var(--bg-tertiary) 50%, var(--bg-secondary) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: var(--radius-md);
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .skeleton-text {
            height: 1em;
            margin-bottom: var(--space-2);
        }
        
        .skeleton-text:last-child {
            margin-bottom: 0;
            width: 60%;
        }
        
        /* Animations */
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
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out;
        }
        
        /* Stagger animation delays */
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        .stat-card:nth-child(5) { animation-delay: 0.5s; }
        
        /* Focus States for Accessibility */
        .header-btn:focus,
        .action-btn:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }
        
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            :root {
                --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.3);
                --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3);
                --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3);
            }
        }
        
        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
    @endpush

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-semibold text-body mb-0">
                {{ __('Admin Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="dashboard-container">
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
                    <li class="breadcrumb-item active">
                        Dashboard
                    </li>
                </ol>
            </nav>

            <!-- Enhanced Header -->
            <div class="dashboard-header animate-fade-in-up">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h1 class="dashboard-title">Admin Dashboard</h1>
                        <p class="dashboard-subtitle">Welcome back! Here's what's happening with your hiking tours.</p>
                    </div>
                    <button class="refresh-btn" onclick="window.location.reload()" aria-label="Refresh dashboard">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>
                
                <div class="header-actions">
                    <a href="{{ route('admin.manage-user.index') }}" class="header-btn">
                        <i class="bi bi-people"></i>
                        Manage Users
                    </a>
                    <a href="{{ route('admin.hikes.create') }}" class="header-btn">
                        <i class="bi bi-plus-circle"></i>
                        New Hike
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="header-btn">
                        <i class="bi bi-graph-up"></i>
                        View Reports
                    </a>
                </div>
            </div>

            <!-- Enhanced Stats Grid -->
            <div class="stats-grid">
                <!-- Total Users -->
                <div class="stat-card primary animate-fade-in-up">
                    <div class="stat-header">
                        <div class="stat-icon primary">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['total_users']) }}</div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-change {{ $percentageChanges['users_change'] >= 0 ? 'positive' : 'negative' }}">
                        <i class="bi bi-arrow-{{ $percentageChanges['users_change'] >= 0 ? 'up' : 'down' }}"></i>
                        {{ $percentageChanges['users_change'] >= 0 ? '+' : '' }}{{ $percentageChanges['users_change'] }}% this month
                    </div>
                </div>

                <!-- Total Bookings -->
                <div class="stat-card success animate-fade-in-up">
                    <div class="stat-header">
                        <div class="stat-icon success">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['total_bookings']) }}</div>
                    <div class="stat-label">Total Bookings</div>
                    <div class="stat-change {{ $percentageChanges['bookings_change'] >= 0 ? 'positive' : 'negative' }}">
                        <i class="bi bi-arrow-{{ $percentageChanges['bookings_change'] >= 0 ? 'up' : 'down' }}"></i>
                        {{ $percentageChanges['bookings_change'] >= 0 ? '+' : '' }}{{ $percentageChanges['bookings_change'] }}% this week
                    </div>
                </div>

                <!-- Active Hikes -->
                <div class="stat-card info animate-fade-in-up">
                    <div class="stat-header">
                        <div class="stat-icon info">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['active_hikes']) }}</div>
                    <div class="stat-label">Active Hikes</div>
                    <div class="stat-change neutral">
                        <i class="bi bi-dash"></i>
                        No change
                    </div>
                </div>

                <!-- Pending Reviews -->
                <div class="stat-card warning animate-fade-in-up">
                    <div class="stat-header">
                        <div class="stat-icon warning">
                            <i class="bi bi-star"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['pending_reviews']) }}</div>
                    <div class="stat-label">Pending Reviews</div>
                    <div class="stat-change {{ $percentageChanges['reviews_change'] >= 0 ? 'positive' : 'negative' }}">
                        <i class="bi bi-arrow-{{ $percentageChanges['reviews_change'] >= 0 ? 'up' : 'down' }}"></i>
                        {{ $percentageChanges['reviews_change'] >= 0 ? '+' : '' }}{{ $percentageChanges['reviews_change'] }}% today
                    </div>
                </div>

                <!-- Revenue This Month -->
                <div class="stat-card danger animate-fade-in-up">
                    <div class="stat-header">
                        <div class="stat-icon danger">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                    <div class="stat-value">₱{{ number_format($stats['revenue_this_month'], 0) }}</div>
                    <div class="stat-label">Revenue This Month</div>
                    <div class="stat-change {{ $percentageChanges['revenue_change'] >= 0 ? 'positive' : 'negative' }}">
                        <i class="bi bi-arrow-{{ $percentageChanges['revenue_change'] >= 0 ? 'up' : 'down' }}"></i>
                        {{ $percentageChanges['revenue_change'] >= 0 ? '+' : '' }}{{ $percentageChanges['revenue_change'] }}% vs last month
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="quick-actions animate-fade-in-up">
                <h3>
                    <i class="bi bi-lightning-charge"></i>
                    Quick Actions
                </h3>
                <div class="actions-grid">
                    <a href="{{ route('admin.manage-user.index') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="action-label">Manage Users</div>
                    </a>
                    
                    <a href="{{ route('admin.reviews.index') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="action-label">Review Hikes</div>
                    </a>
                    
                    <a href="{{ route('chat.index') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <div class="action-label">Messages</div>
                    </a>
                    
                    <a href="{{ route('admin.reports.index') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="action-label">Reports</div>
                    </a>

                    <a href="{{ route('admin.hikes.create') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <div class="action-label">New Hike</div>
                    </a>

                    <a href="{{ route('admin.bookings.index') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="action-label">Bookings</div>
                    </a>

                    <a href="{{ route('admin.guides.index') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div class="action-label">Manage Guides</div>
                    </a>

                    <a href="{{ route('admin.porters.index') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="bi bi-backpack"></i>
                        </div>
                        <div class="action-label">Manage Porters</div>
                    </a>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <!-- Bookings Chart -->
                <div class="chart-card animate-slide-in-right">
                    <div class="chart-header">
                        <h3 class="chart-title">Bookings Overview</h3>
                        <div class="chart-period">Last 30 days</div>
                    </div>
                    <div class="chart-container">
                        <canvas id="bookingsChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Revenue Chart -->
                <div class="chart-card animate-slide-in-right" style="animation-delay: 0.2s;">
                    <div class="chart-header">
                        <h3 class="chart-title">Revenue Trends</h3>
                        <div class="chart-period">Last 6 months</div>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="recent-activity animate-fade-in-up">
                <h3>
                    <i class="bi bi-activity"></i>
                    Recent Activity
                </h3>
                <ul class="activity-list">
                    @forelse($recentBookings as $booking)
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--primary-50); color: var(--primary);">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New Booking</div>
                            <div class="activity-description">
                                <strong>{{ $booking->user->name }}</strong> booked 
                                <strong>{{ $booking->hike->name ?? 'Unknown Hike' }}</strong>
                            </div>
                        </div>
                        <div class="activity-time">
                            {{ $booking->created_at->diffForHumans() }}
                        </div>
                    </li>
                    @empty
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gray-100); color: var(--gray-500);">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">No Recent Activity</div>
                            <div class="activity-description">No recent bookings to display</div>
                        </div>
                        <div class="activity-time">-</div>
                    </li>
                    @endforelse
                        </ul>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Chart.js for interactive charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Chart configurations
        function createBookingsChart() {
            const ctx = document.getElementById('bookingsChart');
            if (!ctx) return;

            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData['bookings']['labels']) !!},
                    datasets: [{
                        label: 'Bookings',
                        data: {!! json_encode($chartData['bookings']['data']) !!},
                        borderColor: 'rgb(99, 102, 241)',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: isDark ? '#f9fafb' : '#111827'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: isDark ? '#d1d5db' : '#6b7280'
                            },
                            grid: {
                                color: isDark ? '#374151' : '#e5e7eb'
                            }
                        },
                        x: {
                            ticks: {
                                color: isDark ? '#d1d5db' : '#6b7280'
                            },
                            grid: {
                                color: isDark ? '#374151' : '#e5e7eb'
                            }
                        }
                    }
                }
            });
        }

        function createRevenueChart() {
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return;

            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartData['revenue']['labels']) !!},
                    datasets: [{
                        label: 'Revenue (₱)',
                        data: {!! json_encode($chartData['revenue']['data']) !!},
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: isDark ? '#f9fafb' : '#111827'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: isDark ? '#d1d5db' : '#6b7280',
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            },
                            grid: {
                                color: isDark ? '#374151' : '#e5e7eb'
                            }
                        },
                        x: {
                            ticks: {
                                color: isDark ? '#d1d5db' : '#6b7280'
                            },
                            grid: {
                                color: isDark ? '#374151' : '#e5e7eb'
                            }
                        }
                    }
                }
            });
        }

        function updateChartsTheme(theme) {
            // Recreate charts with new theme
            Chart.helpers.each(Chart.instances, function(instance) {
                instance.destroy();
            });
            
            setTimeout(() => {
                createBookingsChart();
                createRevenueChart();
            }, 100);
        }

        // Enhanced unread message counter
        async function updateUnreadCount() {
            try {
                // Determine the correct endpoint based on user type
                const isAdmin = document.querySelector('.admin-navigation') !== null;
                const endpoint = isAdmin ? '/admin/messages/unread-count' : '/messages/unread-count';
                
                const response = await fetch(endpoint, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    credentials: 'same-origin'
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    // If we get HTML instead of JSON, user is likely not authenticated
                    console.warn('Received non-JSON response, user may not be authenticated');
                    return;
                }
                
                const data = await response.json();
                const count = data.count || 0;
                
                // Update navigation unread counts
                const navCountElements = document.querySelectorAll('.unread-count');
                navCountElements.forEach(element => {
                    element.textContent = count;
                    element.style.display = count > 0 ? 'inline-flex' : 'none';
                });
                
            } catch (error) {
                // Only log actual errors, not authentication redirects
                if (error.message.includes('Unexpected token')) {
                    console.warn('Authentication required for unread count endpoint');
                } else {
                    console.error('Error fetching unread count:', error);
                }
            }
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Create charts
            createBookingsChart();
            createRevenueChart();
            
            // Update unread count
            updateUnreadCount();
            setInterval(updateUnreadCount, 60000);
            
            // Enhanced keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'r' && (e.ctrlKey || e.metaKey)) {
                    e.preventDefault();
                    window.location.reload();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
