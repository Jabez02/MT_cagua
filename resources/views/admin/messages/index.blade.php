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
        --bg-accent: #f0f9ff;
        
        /* Text Colors */
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-tertiary: #94a3b8;
        --text-inverse: #ffffff;
        
        /* Border Colors */
        --border-primary: #e2e8f0;
        --border-secondary: #cbd5e1;
        --border-accent: #e0e7ff;
        
        /* Typography */
        --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        --font-size-xs: 0.75rem;
        --font-size-sm: 0.875rem;
        --font-size-base: 1rem;
        --font-size-lg: 1.125rem;
        --font-size-xl: 1.25rem;
        --font-size-2xl: 1.5rem;
        --font-size-3xl: 1.875rem;
        --font-size-4xl: 2.25rem;
        
        --font-weight-normal: 400;
        --font-weight-medium: 500;
        --font-weight-semibold: 600;
        --font-weight-bold: 700;
        --font-weight-extrabold: 800;
        
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
        
        /* Shadows */
        --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        
        /* Transitions */
        --transition-base: all 0.2s ease-in-out;
        --transition-fast: all 0.15s ease-in-out;
        --transition-slow: all 0.3s ease-in-out;
    }

    /* Global Styles */
    body {
        font-family: var(--font-family);
        background-color: var(--bg-secondary);
        color: var(--text-primary);
        line-height: var(--line-height-normal);
    }

    /* Messages Page Container */
    .messages-page {
        background: var(--bg-secondary);
        min-height: 100vh;
        padding: var(--space-6) 0;
    }

    .messages-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 var(--space-6);
    }

    /* Breadcrumb Navigation */
    .breadcrumb-nav {
        margin-bottom: var(--space-6);
        animation: fadeInUp 0.6s ease-out;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        font-size: var(--font-size-sm);
        color: var(--text-secondary);
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .breadcrumb-item {
        display: flex;
        align-items: center;
        gap: var(--space-2);
    }

    .breadcrumb-item.active {
        color: var(--text-primary);
        font-weight: var(--font-weight-medium);
    }

    .breadcrumb-separator {
        color: var(--text-tertiary);
    }

    /* Page Header */
    .page-header {
        background: var(--bg-primary);
        border-radius: var(--radius-2xl);
        padding: var(--space-8);
        margin-bottom: var(--space-6);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-primary);
        animation: fadeInUp 0.6s ease-out 0.1s both;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: var(--space-6);
    }

    .header-left h1 {
        font-size: var(--font-size-3xl);
        font-weight: var(--font-weight-bold);
        color: var(--text-primary);
        margin: 0 0 var(--space-2) 0;
        line-height: var(--line-height-tight);
    }

    .header-left p {
        font-size: var(--font-size-lg);
        color: var(--text-secondary);
        margin: 0;
        line-height: var(--line-height-relaxed);
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: var(--space-4);
    }

    .unread-counter {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        background: var(--primary-50);
        color: var(--primary-700);
        padding: var(--space-3) var(--space-4);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        border: 1px solid var(--primary-100);
    }

    .header-btn {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-3) var(--space-4);
        background: var(--primary);
        color: var(--text-inverse);
        border: none;
        border-radius: var(--radius-lg);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        text-decoration: none;
        transition: var(--transition-base);
        cursor: pointer;
    }

    .header-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: var(--text-inverse);
        text-decoration: none;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: var(--space-6);
        margin-bottom: var(--space-8);
    }

    .stat-card {
        background: var(--bg-primary);
        border-radius: var(--radius-2xl);
        padding: var(--space-6);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-primary);
        display: flex;
        align-items: center;
        gap: var(--space-4);
        transition: var(--transition-base);
        animation: fadeInUp 0.6s ease-out calc(0.2s + var(--delay, 0s)) both;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .stat-card:nth-child(1) { --delay: 0s; }
    .stat-card:nth-child(2) { --delay: 0.1s; }
    .stat-card:nth-child(3) { --delay: 0.2s; }
    .stat-card:nth-child(4) { --delay: 0.3s; }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--font-size-xl);
        flex-shrink: 0;
    }

    .stat-icon.pending {
        background: var(--warning-100);
        color: var(--warning-dark);
    }

    .stat-icon.replied {
        background: var(--success-100);
        color: var(--success-dark);
    }

    .stat-icon.closed {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .stat-icon.total {
        background: var(--primary-100);
        color: var(--primary-700);
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: var(--font-size-3xl);
        font-weight: var(--font-weight-bold);
        color: var(--text-primary);
        line-height: var(--line-height-tight);
        margin-bottom: var(--space-1);
    }

    .stat-label {
        font-size: var(--font-size-sm);
        color: var(--text-secondary);
        font-weight: var(--font-weight-medium);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Filters Card */
    .filters-card {
        background: var(--bg-primary);
        border-radius: var(--radius-2xl);
        padding: var(--space-6);
        margin-bottom: var(--space-6);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-primary);
        animation: fadeInUp 0.6s ease-out 0.5s both;
    }

    .filters-header {
        margin-bottom: var(--space-6);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .filters-header h3 {
        font-size: var(--font-size-lg);
        font-weight: var(--font-weight-semibold);
        color: var(--text-primary);
        margin: 0;
    }

    .btn-toggle {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-2) var(--space-3);
        background: var(--bg-secondary);
        color: var(--text-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-md);
        font-size: var(--font-size-xs);
        font-weight: var(--font-weight-medium);
        text-decoration: none;
        transition: var(--transition-base);
        cursor: pointer;
    }

    .btn-toggle:hover {
        background: var(--primary-50);
        color: var(--primary-700);
        border-color: var(--primary-200);
    }

    .filters-content {
        display: flex;
        flex-direction: column;
        gap: var(--space-4);
    }

    .filter-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: var(--space-6);
        align-items: end;
    }

    .advanced-filters {
        padding-top: var(--space-4);
        border-top: 1px solid var(--border-primary);
        margin-top: var(--space-4);
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: var(--space-2);
    }

    .filter-group label {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        color: var(--text-primary);
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input-wrapper i {
        position: absolute;
        left: var(--space-3);
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: var(--font-size-sm);
    }

    .search-input-wrapper input {
        width: 100%;
        padding: var(--space-3) var(--space-3) var(--space-3) var(--space-10);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-sm);
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-base);
    }

    .search-input-wrapper input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-50);
    }

    .date-input-wrapper {
        position: relative;
    }

    .date-input-wrapper i {
        position: absolute;
        left: var(--space-3);
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: var(--font-size-sm);
        pointer-events: none;
    }

    .date-input-wrapper input {
        width: 100%;
        padding: var(--space-3) var(--space-3) var(--space-3) var(--space-10);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-sm);
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-base);
    }

    .date-input-wrapper input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-50);
    }

    .filter-select {
        padding: var(--space-3) var(--space-4);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-sm);
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-base);
        cursor: pointer;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-50);
    }

    .filter-actions {
        display: flex;
        gap: var(--space-3);
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-3) var(--space-4);
        background: var(--bg-secondary);
        color: var(--text-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        text-decoration: none;
        transition: var(--transition-base);
        cursor: pointer;
    }

    .btn-secondary:hover {
        background: var(--bg-tertiary);
        color: var(--text-primary);
        border-color: var(--border-secondary);
        text-decoration: none;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-3) var(--space-4);
        background: var(--primary);
        color: var(--text-inverse);
        border: 1px solid var(--primary);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        text-decoration: none;
        transition: var(--transition-base);
        cursor: pointer;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        color: var(--text-inverse);
        text-decoration: none;
    }

    /* Bulk Actions Bar */
    .bulk-actions-bar {
        background: var(--primary);
        color: var(--text-inverse);
        padding: var(--space-4) var(--space-6);
        margin-bottom: var(--space-6);
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-lg);
        animation: slideInDown 0.3s ease-out;
        position: sticky;
        top: var(--space-4);
        z-index: 100;
    }

    .bulk-actions-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: var(--space-6);
    }

    .bulk-selection-info {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
    }

    .bulk-actions-buttons {
        display: flex;
        gap: var(--space-3);
    }

    .btn-bulk {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-2) var(--space-4);
        background: rgba(255, 255, 255, 0.2);
        color: var(--text-inverse);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: var(--radius-lg);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        text-decoration: none;
        transition: var(--transition-base);
        cursor: pointer;
    }

    .btn-bulk:hover {
        background: rgba(255, 255, 255, 0.3);
        color: var(--text-inverse);
        text-decoration: none;
        transform: translateY(-1px);
    }

    .btn-bulk-cancel {
        background: rgba(239, 68, 68, 0.2);
        border-color: rgba(239, 68, 68, 0.3);
    }

    .btn-bulk-cancel:hover {
        background: rgba(239, 68, 68, 0.3);
    }

    /* Sortable Headers */
    .sortable-header {
        cursor: pointer;
        user-select: none;
        position: relative;
        transition: var(--transition-base);
    }

    .sortable-header:hover {
        background: var(--bg-secondary);
        color: var(--text-primary);
    }

    .sort-icon {
        margin-left: var(--space-2);
        font-size: var(--font-size-xs);
        opacity: 0.5;
        transition: var(--transition-base);
    }

    .sortable-header:hover .sort-icon {
        opacity: 1;
    }

    .sortable-header.sorted .sort-icon {
        opacity: 1;
        color: var(--primary);
    }

    /* Bulk Checkboxes */
    .bulk-checkbox,
    .message-checkbox {
        width: 16px;
        height: 16px;
        border-radius: var(--radius-sm);
        border: 2px solid var(--border-secondary);
        background: var(--bg-primary);
        cursor: pointer;
        transition: var(--transition-base);
    }

    .bulk-checkbox:checked,
    .message-checkbox:checked {
        background: var(--primary);
        border-color: var(--primary);
    }

    .bulk-checkbox:hover,
    .message-checkbox:hover {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-50);
    }

    /* Message Preview Tooltip */
    .message-preview-tooltip {
        position: absolute;
        background: var(--bg-primary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
        padding: var(--space-4);
        max-width: 400px;
        z-index: 1000;
        animation: fadeIn 0.2s ease-out;
    }

    .preview-content {
        display: flex;
        flex-direction: column;
        gap: var(--space-3);
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: var(--space-3);
        padding-bottom: var(--space-2);
        border-bottom: 1px solid var(--border-primary);
    }

    .preview-body {
        color: var(--text-secondary);
        font-size: var(--font-size-sm);
        line-height: var(--line-height-relaxed);
        max-height: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .preview-footer {
        padding-top: var(--space-2);
        border-top: 1px solid var(--border-primary);
        color: var(--text-tertiary);
        font-size: var(--font-size-xs);
    }

    /* Help Button Styles */
        .btn-help {
            background: #6c757d;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
            margin-left: 8px;
        }

        .btn-help:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }

        /* Keyboard Help Modal Styles */
        .keyboard-help-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            backdrop-filter: blur(4px);
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-header h3 {
            margin: 0;
            color: #2c3e50;
            font-size: 20px;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #6c757d;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: #f8f9fa;
            color: #495057;
        }

        .modal-body {
            padding: 24px;
        }

        .shortcuts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .shortcut-group h4 {
            margin: 0 0 16px 0;
            color: #495057;
            font-size: 16px;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 8px;
        }

        .shortcut-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .shortcut-item:last-child {
            border-bottom: none;
        }

        .shortcut-item kbd {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 4px 8px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            color: #495057;
            margin: 0 2px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .shortcut-item span {
            color: #6c757d;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                margin: 20px;
            }
            
            .shortcuts-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .modal-header {
                padding: 16px 20px;
            }
            
            .modal-body {
                padding: 20px;
            }
        }
    .btn-action.reply {
        background: var(--success-100);
        color: var(--success-dark);
    }

    .btn-action.reply:hover {
        background: var(--success);
        color: var(--text-inverse);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    /* Row Selection Highlight */
    .table-row.selected {
        background: var(--primary-50);
        border-left: 4px solid var(--primary);
    }

    /* Table Responsive Design */
    .table-card {
        background: var(--bg-primary);
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-primary);
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out 0.4s both;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--space-6);
        border-bottom: 1px solid var(--border-primary);
        background: var(--bg-secondary);
    }

    .table-header h3 {
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-semibold);
        color: var(--text-primary);
        margin: 0;
    }

    .table-actions {
        display: flex;
        gap: var(--space-3);
    }

    .table-container {
        overflow-x: auto;
        position: relative;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: var(--font-size-sm);
        min-width: 800px; /* Ensure minimum width for proper layout */
    }

    .data-table th {
        background: var(--bg-secondary);
        padding: var(--space-4) var(--space-6);
        text-align: left;
        font-weight: var(--font-weight-semibold);
        color: var(--text-secondary);
        border-bottom: 1px solid var(--border-primary);
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .data-table td {
        padding: var(--space-4) var(--space-6);
        border-bottom: 1px solid var(--border-primary);
        vertical-align: middle;
    }

    .data-table tr:hover {
        background: var(--bg-secondary);
    }

    .sortable-header.active-sort {
        background: var(--primary-100);
        color: var(--primary-800);
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--space-2);
    }

    .sort-icon {
        font-size: var(--font-size-xs);
        opacity: 0.6;
        transition: var(--transition-base);
    }

    .sortable-header:hover .sort-icon,
    .sortable-header.active-sort .sort-icon {
        opacity: 1;
    }

    /* User Info Styles */
    .user-info {
        display: flex;
        align-items: center;
        gap: var(--space-3);
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-full);
        background: var(--primary);
        color: var(--text-inverse);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        flex-shrink: 0;
    }

    .user-name {
        font-weight: var(--font-weight-medium);
        color: var(--text-primary);
        font-size: var(--font-size-sm);
    }

    .user-email {
        color: var(--text-secondary);
        font-size: var(--font-size-xs);
    }

    /* Message Subject Styles */
    .message-subject {
        display: flex;
        align-items: center;
        gap: var(--space-2);
    }

    .unread-indicator {
        width: 8px;
        height: 8px;
        border-radius: var(--radius-full);
        background: var(--primary);
        flex-shrink: 0;
    }

    .subject-text {
        color: var(--text-primary);
        font-weight: var(--font-weight-medium);
    }

    /* Status Badge Styles */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: var(--space-1);
        padding: var(--space-1) var(--space-3);
        border-radius: var(--radius-full);
        font-size: var(--font-size-xs);
        font-weight: var(--font-weight-medium);
    }

    .status-pending {
        background: var(--warning-100);
        color: var(--warning-dark);
    }

    .status-replied {
        background: var(--success-100);
        color: var(--success-dark);
    }

    .status-closed {
        background: var(--gray-100);
        color: var(--gray-700);
    }

    /* Date Info Styles */
    .date-info {
        display: flex;
        flex-direction: column;
        gap: var(--space-1);
    }

    .date {
        font-weight: var(--font-weight-medium);
        color: var(--text-primary);
        font-size: var(--font-size-sm);
    }

    .time {
        color: var(--text-secondary);
        font-size: var(--font-size-xs);
    }

    /* Action Buttons Styles */
    .action-buttons {
        display: flex;
        gap: var(--space-2);
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-primary);
        background: var(--bg-primary);
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition-base);
        cursor: pointer;
    }

    .btn-action:hover {
        background: var(--primary);
        color: var(--text-inverse);
        border-color: var(--primary);
        text-decoration: none;
        transform: translateY(-1px);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .table-container {
            border-radius: 0;
            margin: 0 calc(-1 * var(--space-6));
        }
        
        .data-table {
            min-width: 700px;
        }
        
        .data-table th,
        .data-table td {
            padding: var(--space-3) var(--space-4);
        }
    }

    @media (max-width: 768px) {
        .table-header {
            flex-direction: column;
            gap: var(--space-4);
            align-items: stretch;
        }
        
        .table-actions {
            justify-content: center;
        }
        
        .data-table {
            min-width: 600px;
        }
        
        .data-table th,
        .data-table td {
            padding: var(--space-2) var(--space-3);
            font-size: var(--font-size-xs);
        }
        
        /* Hide actions column on mobile */
        .data-table th:nth-child(6),
        .data-table td:nth-child(6) {
            display: none;
        }
        
        /* Compact user info */
        .user-avatar {
            width: 28px;
            height: 28px;
            font-size: var(--font-size-xs);
        }
        
        .user-name,
        .user-email {
            font-size: var(--font-size-xs);
        }
    }

    @media (max-width: 640px) {
        .data-table {
            min-width: 500px;
        }
        
        /* Stack user info vertically */
        .user-info {
            flex-direction: column;
            align-items: flex-start;
            gap: var(--space-1);
        }
        
        .user-avatar {
            width: 24px;
            height: 24px;
            font-size: var(--font-size-2xs);
        }
        
        /* Compact date display */
        .date-info {
            gap: 0;
        }
        
        .date-info .time {
            font-size: var(--font-size-2xs);
        }
        
        /* Hide status column on very small screens */
        .data-table th:nth-child(4),
        .data-table td:nth-child(4) {
            display: none;
        }
    }

    /* Empty State Styles */
    .empty-state {
        text-align: center;
        padding: var(--space-12) var(--space-6);
        color: var(--text-secondary);
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: var(--space-4);
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-2);
    }

    .empty-state p {
        font-size: var(--font-size-base);
        margin: 0;
    }

    /* Pagination Styles */
    .pagination-wrapper {
        padding: var(--space-6);
        border-top: 1px solid var(--border-primary);
        background: var(--bg-secondary);
    }

    /* Animations */
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

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
</style>
@endpush

@section('content')
<div class="messages-page">
    <div class="messages-container">
        <!-- Breadcrumb Navigation -->
        <nav class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house-door"></i>
                    <span>Admin</span>
                </li>
                <li class="breadcrumb-separator">
                    <i class="bi bi-chevron-right"></i>
                </li>
                <li class="breadcrumb-item active">
                    Messages
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div class="header-left">
                    <h1>Messages</h1>
                    <p>Manage customer inquiries and communications</p>
                </div>
                <div class="header-actions">
                    <div class="unread-counter">
                        <i class="bi bi-envelope"></i>
                        <span>{{ \App\Models\Message::where('status', 'pending')->count() }} Unread</span>
                    </div>
                    <button onclick="refreshTable()" class="header-btn">
                        <i class="bi bi-arrow-clockwise"></i>
                        Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ \App\Models\Message::where('status', 'pending')->count() }}</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon replied">
                    <i class="bi bi-reply"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ \App\Models\Message::where('status', 'replied')->count() }}</div>
                    <div class="stat-label">Replied</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon closed">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ \App\Models\Message::where('status', 'closed')->count() }}</div>
                    <div class="stat-label">Closed</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="bi bi-envelope-open"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ \App\Models\Message::count() }}</div>
                    <div class="stat-label">Total Messages</div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
         <div class="filters-card">
             <div class="filters-header">
                 <h3>Filter Messages</h3>
                 <button type="button" class="btn-toggle" onclick="toggleAdvancedFilters()">
                     <i class="bi bi-gear"></i>
                     Advanced
                 </button>
             </div>
             <div class="filters-content">
                 <div class="filter-row">
                     <div class="filter-group">
                         <label for="search">Search Messages</label>
                         <div class="search-input-wrapper">
                             <i class="bi bi-search"></i>
                             <input type="text" id="search" placeholder="Search by user, subject, or content..." value="{{ request('search') }}">
                         </div>
                     </div>
                     <div class="filter-group">
                         <label for="status">Status</label>
                         <select id="status" class="filter-select">
                             <option value="">All Statuses</option>
                             <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                             <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
                             <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                         </select>
                     </div>
                     <div class="filter-group">
                         <label for="sort">Sort By</label>
                         <select id="sort" class="filter-select">
                             <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest First</option>
                             <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                         </select>
                     </div>
                 </div>
                 
                 <!-- Advanced Filters (Initially Hidden) -->
                 <div class="advanced-filters" id="advancedFilters" style="display: none;">
                     <div class="filter-row">
                         <div class="filter-group">
                             <label for="user-search">User Search</label>
                             <div class="search-input-wrapper">
                                 <i class="bi bi-person"></i>
                                 <input type="text" id="user-search" placeholder="Search by user name or email..." value="{{ request('user_search') }}">
                             </div>
                         </div>
                         <div class="filter-group">
                             <label for="date-from">Date From</label>
                             <div class="date-input-wrapper">
                                 <i class="bi bi-calendar"></i>
                                 <input type="date" id="date-from" value="{{ request('date_from') }}">
                             </div>
                         </div>
                         <div class="filter-group">
                             <label for="date-to">Date To</label>
                             <div class="date-input-wrapper">
                                 <i class="bi bi-calendar"></i>
                                 <input type="date" id="date-to" value="{{ request('date_to') }}">
                             </div>
                         </div>
                     </div>
                     <div class="filter-row">
                         <div class="filter-group">
                             <label for="priority">Priority</label>
                             <select id="priority" class="filter-select">
                                 <option value="">All Priorities</option>
                                 <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                                 <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                                 <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                             </select>
                         </div>
                         <div class="filter-group">
                             <label for="has-reply">Has Reply</label>
                             <select id="has-reply" class="filter-select">
                                 <option value="">All Messages</option>
                                 <option value="yes" {{ request('has_reply') === 'yes' ? 'selected' : '' }}>With Reply</option>
                                 <option value="no" {{ request('has_reply') === 'no' ? 'selected' : '' }}>Without Reply</option>
                             </select>
                         </div>
                         <div class="filter-group">
                             <label for="replied-by">Replied By</label>
                             <select id="replied-by" class="filter-select">
                                <option value="">All Admins</option>
                                @foreach(\App\Models\User::where('usertype', 'admin')->get() as $admin)
                                    <option value="{{ $admin->id }}" {{ request('replied_by') == $admin->id ? 'selected' : '' }}>
                                        {{ $admin->name }}
                                    </option>
                                @endforeach
                            </select>
                         </div>
                     </div>
                 </div>
                 
                 <div class="filter-actions">
                     <button type="button" class="btn-secondary" onclick="clearFilters()">
                         <i class="bi bi-x"></i>
                         Clear All
                     </button>
                     <button type="button" class="btn-outline" onclick="exportMessages()">
                         <i class="bi bi-download"></i>
                         Export
                     </button>
                     <button type="button" class="btn-primary" onclick="applyFilters()">
                         <i class="bi bi-funnel"></i>
                         Apply Filters
                     </button>
                 </div>
             </div>
         </div>

        <!-- Bulk Actions Bar (Hidden by default) -->
        <div id="bulkActionsBar" class="bulk-actions-bar" style="display: none;">
            <div class="bulk-actions-content">
                <div class="bulk-selection-info">
                    <span id="selectedCount">0</span> messages selected
                </div>
                <div class="bulk-actions-buttons">
                    <button type="button" class="btn-bulk btn-bulk-reply" onclick="bulkReply()">
                        <i class="bi bi-reply"></i>
                        Bulk Reply
                    </button>
                    <button type="button" class="btn-bulk btn-bulk-close" onclick="bulkClose()">
                        <i class="bi bi-x-circle"></i>
                        Mark as Closed
                    </button>
                    <button type="button" class="btn-bulk btn-bulk-pending" onclick="bulkPending()">
                        <i class="bi bi-clock"></i>
                        Mark as Pending
                    </button>
                    <button type="button" class="btn-bulk btn-bulk-cancel" onclick="clearSelection()">
                        <i class="bi bi-x"></i>
                        Cancel
                    </button>
                </div>
            </div>
        </div>

         <!-- Messages Table -->
         <div class="table-card">
             <div class="table-header">
                 <h3>Messages List</h3>
                 <div class="table-actions">
                     <button class="btn-secondary" onclick="refreshTable()">
                         <i class="bi bi-arrow-clockwise"></i>
                         Refresh
                     </button>
                 </div>
             </div>
             <div class="table-container">
                 @if($messages->count() > 0)
                     <table class="data-table">
                         <thead>
                             <tr>
                                 <th style="width: 40px;">
                                     <input type="checkbox" id="selectAll" class="bulk-checkbox" onchange="toggleSelectAll()">
                                 </th>
                                 <th style="width: 200px;" onclick="sortTable('user')" class="sortable-header" data-sort="user">
                                     <div class="header-content">
                                         <span>User</span>
                                         <i class="bi bi-chevron-expand sort-icon"></i>
                                     </div>
                                 </th>
                                 <th onclick="sortTable('subject')" class="sortable-header" data-sort="subject">
                                     <div class="header-content">
                                         <span>Subject</span>
                                         <i class="bi bi-chevron-expand sort-icon"></i>
                                     </div>
                                 </th>
                                 <th style="width: 120px;" onclick="sortTable('status')" class="sortable-header" data-sort="status">
                                     <div class="header-content">
                                         <span>Status</span>
                                         <i class="bi bi-chevron-expand sort-icon"></i>
                                     </div>
                                 </th>
                                 <th style="width: 140px;" onclick="sortTable('created_at')" class="sortable-header active-sort" data-sort="created_at">
                                     <div class="header-content">
                                         <span>Date</span>
                                         <i class="bi bi-chevron-down sort-icon"></i>
                                     </div>
                                 </th>
                                 <th style="width: 120px;">
                                     <div class="header-content">
                                         <span>Actions</span>
                                     </div>
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($messages as $message)
                                 <tr class="table-row {{ $message->status === 'pending' ? 'unread' : '' }}" 
                                     data-message-id="{{ $message->id }}"
                                     onmouseover="showMessagePreview({{ $message->id }})"
                                     onmouseout="hideMessagePreview()">
                                     <td>
                                         <input type="checkbox" class="message-checkbox" value="{{ $message->id }}" onchange="updateBulkActions()">
                                     </td>
                                     <td>
                                         <div class="user-info">
                                             <div class="user-avatar">
                                                 {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                             </div>
                                             <div>
                                                 <div class="user-name">{{ $message->user->name }}</div>
                                                 <div class="user-email">{{ $message->user->email }}</div>
                                             </div>
                                         </div>
                                     </td>
                                     <td>
                                         <div class="message-subject">
                                             @if($message->status === 'pending')
                                                 <div class="unread-indicator"></div>
                                             @endif
                                             <div class="subject-text">{{ Str::limit($message->subject, 50) }}</div>
                                         </div>
                                     </td>
                                     <td>
                                         <span class="status-badge status-{{ $message->status }}">
                                             @if($message->status === 'pending')
                                                 <i class="bi bi-clock"></i>
                                             @elseif($message->status === 'replied')
                                                 <i class="bi bi-reply"></i>
                                             @else
                                                 <i class="bi bi-check-circle"></i>
                                             @endif
                                             {{ ucfirst($message->status) }}
                                         </span>
                                     </td>
                                     <td>
                                         <div class="date-info">
                                             <div class="date">{{ $message->created_at->format('M j, Y') }}</div>
                                             <div class="time">{{ $message->created_at->format('g:i A') }}</div>
                                         </div>
                                     </td>
                                     <td>
                                         <div class="action-buttons">
                                             <a href="{{ route('admin.messages.show', $message) }}" class="btn-action view" title="View Message">
                                                 <i class="bi bi-eye"></i>
                                             </a>
                                             @if($message->status === 'pending')
                                                 <button class="btn-action reply" title="Quick Reply" onclick="quickReply({{ $message->id }})">
                                                     <i class="bi bi-reply"></i>
                                                 </button>
                                             @endif
                                         </div>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>

                     <!-- Message Preview Tooltip -->
                     <div id="messagePreview" class="message-preview-tooltip" style="display: none;">
                         <div class="preview-content">
                             <div class="preview-header">
                                 <strong id="previewSubject"></strong>
                                 <span id="previewStatus" class="status-badge"></span>
                             </div>
                             <div class="preview-body" id="previewMessage"></div>
                             <div class="preview-footer">
                                 <small id="previewDate"></small>
                             </div>
                         </div>
                     </div>

                     <!-- Pagination -->
                     <div class="pagination-wrapper">
                         {{ $messages->links() }}
                     </div>
                 @else
                     <div class="empty-state">
                         <div class="empty-icon">
                             <i class="bi bi-inbox"></i>
                         </div>
                         <h3>No Messages Found</h3>
                         <p>There are no messages matching your current filters.</p>
                     </div>
                 @endif
             </div>
         </div>
     </div>
</div>

@push('scripts')
<script>
    /* JavaScript Functions */
    function clearFilters() {
         document.getElementById('search').value = '';
         document.getElementById('status').value = '';
         document.getElementById('sort').value = 'newest';
         
         // Clear advanced filters
         document.getElementById('user-search').value = '';
         document.getElementById('date-from').value = '';
         document.getElementById('date-to').value = '';
         document.getElementById('priority').value = '';
         document.getElementById('has-reply').value = '';
         document.getElementById('replied-by').value = '';
         
         applyFilters();
     }

     function applyFilters() {
         const search = document.getElementById('search').value;
         const status = document.getElementById('status').value;
         const sort = document.getElementById('sort').value;
         const userSearch = document.getElementById('user-search').value;
         const dateFrom = document.getElementById('date-from').value;
         const dateTo = document.getElementById('date-to').value;
         const priority = document.getElementById('priority').value;
         const hasReply = document.getElementById('has-reply').value;
         const repliedBy = document.getElementById('replied-by').value;
         
         const params = new URLSearchParams();
         if (search) params.append('search', search);
         if (status) params.append('status', status);
         if (sort && sort !== 'newest') params.append('sort', sort);
         if (userSearch) params.append('user_search', userSearch);
         if (dateFrom) params.append('date_from', dateFrom);
         if (dateTo) params.append('date_to', dateTo);
         if (priority) params.append('priority', priority);
         if (hasReply) params.append('has_reply', hasReply);
         if (repliedBy) params.append('replied_by', repliedBy);
         
         window.location.href = '{{ route("admin.messages.index") }}' + (params.toString() ? '?' + params.toString() : '');
     }

     function toggleAdvancedFilters() {
         const advancedFilters = document.getElementById('advancedFilters');
         const toggleBtn = event.target.closest('.btn-toggle');
         
         if (advancedFilters.style.display === 'none' || !advancedFilters.style.display) {
             advancedFilters.style.display = 'block';
             toggleBtn.innerHTML = '<i class="bi bi-gear-fill"></i> Hide Advanced';
         } else {
             advancedFilters.style.display = 'none';
             toggleBtn.innerHTML = '<i class="bi bi-gear"></i> Advanced';
         }
     }

     function exportMessages() {
         const params = new URLSearchParams(window.location.search);
         params.append('export', 'csv');
         window.location.href = '{{ route("admin.messages.index") }}?' + params.toString();
     }

     function refreshTable() {
         window.location.reload();
     }

     // Bulk Actions Functions
     function toggleSelectAll() {
         const selectAllCheckbox = document.getElementById('selectAll');
         const messageCheckboxes = document.querySelectorAll('.message-checkbox');
         
         messageCheckboxes.forEach(checkbox => {
             checkbox.checked = selectAllCheckbox.checked;
             const row = checkbox.closest('.table-row');
             if (checkbox.checked) {
                 row.classList.add('selected');
             } else {
                 row.classList.remove('selected');
             }
         });
         
         updateBulkActions();
     }

     function updateBulkActions() {
         const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');
         const bulkActionsBar = document.getElementById('bulkActionsBar');
         const selectedCount = document.getElementById('selectedCount');
         
         if (checkedBoxes.length > 0) {
             bulkActionsBar.style.display = 'block';
             selectedCount.textContent = checkedBoxes.length;
         } else {
             bulkActionsBar.style.display = 'none';
         }
         
         // Update select all checkbox state
         const allCheckboxes = document.querySelectorAll('.message-checkbox');
         const selectAllCheckbox = document.getElementById('selectAll');
         
         if (checkedBoxes.length === allCheckboxes.length) {
             selectAllCheckbox.checked = true;
             selectAllCheckbox.indeterminate = false;
         } else if (checkedBoxes.length > 0) {
             selectAllCheckbox.checked = false;
             selectAllCheckbox.indeterminate = true;
         } else {
             selectAllCheckbox.checked = false;
             selectAllCheckbox.indeterminate = false;
         }
     }

     function clearSelection() {
         const checkboxes = document.querySelectorAll('.message-checkbox, #selectAll');
         checkboxes.forEach(checkbox => checkbox.checked = false);
         
         const rows = document.querySelectorAll('.table-row');
         rows.forEach(row => row.classList.remove('selected'));
         
         updateBulkActions();
     }

     function bulkReply() {
         const selectedIds = Array.from(document.querySelectorAll('.message-checkbox:checked'))
             .map(checkbox => checkbox.value);
         
         if (selectedIds.length === 0) return;
         
         // Open bulk reply modal or redirect to bulk reply page
         const url = '{{ route("admin.messages.index") }}?bulk_reply=' + selectedIds.join(',');
         window.location.href = url;
     }

     function bulkClose() {
         const selectedIds = Array.from(document.querySelectorAll('.message-checkbox:checked'))
             .map(checkbox => checkbox.value);
         
         if (selectedIds.length === 0) return;
         
         if (confirm(`Are you sure you want to close ${selectedIds.length} messages?`)) {
             // Send AJAX request to bulk close messages
             fetch('{{ route("admin.messages.bulk-action") }}', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                 },
                 body: JSON.stringify({
                     action: 'close',
                     message_ids: selectedIds
                 })
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     window.location.reload();
                 } else {
                     alert('Error: ' + data.message);
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 alert('An error occurred while processing the request.');
             });
         }
     }

     function bulkPending() {
         const selectedIds = Array.from(document.querySelectorAll('.message-checkbox:checked'))
             .map(checkbox => checkbox.value);
         
         if (selectedIds.length === 0) return;
         
         if (confirm(`Are you sure you want to mark ${selectedIds.length} messages as pending?`)) {
             // Send AJAX request to bulk mark as pending
             fetch('{{ route("admin.messages.bulk-action") }}', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                 },
                 body: JSON.stringify({
                     action: 'pending',
                     message_ids: selectedIds
                 })
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     window.location.reload();
                 } else {
                     alert('Error: ' + data.message);
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 alert('An error occurred while processing the request.');
             });
         }
     }

     // Message Preview Functions
     let previewTimeout;
     
     function showMessagePreview(messageId) {
         clearTimeout(previewTimeout);
         
         previewTimeout = setTimeout(() => {
             // Fetch message preview data
             fetch(`/admin/messages/${messageId}/preview`)
                 .then(response => response.json())
                 .then(data => {
                     const preview = document.getElementById('messagePreview');
                     const previewSubject = document.getElementById('previewSubject');
                     const previewStatus = document.getElementById('previewStatus');
                     const previewMessage = document.getElementById('previewMessage');
                     const previewDate = document.getElementById('previewDate');
                     
                     previewSubject.textContent = data.subject;
                     previewStatus.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                     previewStatus.className = `status-badge status-${data.status}`;
                     previewMessage.textContent = data.message.substring(0, 200) + (data.message.length > 200 ? '...' : '');
                     previewDate.textContent = new Date(data.created_at).toLocaleDateString();
                     
                     // Position tooltip near cursor
                     const event = window.event || event;
                     preview.style.left = (event.pageX + 10) + 'px';
                     preview.style.top = (event.pageY + 10) + 'px';
                     preview.style.display = 'block';
                 })
                 .catch(error => {
                     console.error('Error fetching preview:', error);
                 });
         }, 500); // 500ms delay before showing preview
     }

     function hideMessagePreview() {
         clearTimeout(previewTimeout);
         const preview = document.getElementById('messagePreview');
         preview.style.display = 'none';
     }

     // Sortable Table Functions
     let currentSort = { column: null, direction: 'asc' };

     function sortTable(column) {
         // Toggle sort direction if same column, otherwise default to ascending
         if (currentSort.column === column) {
             currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
         } else {
             currentSort.column = column;
             currentSort.direction = 'asc';
         }

         // Update visual indicators
         document.querySelectorAll('.sortable-header').forEach(header => {
             header.classList.remove('sorted');
             const icon = header.querySelector('.sort-icon');
             icon.className = 'bi bi-chevron-expand sort-icon';
         });

         const currentHeader = document.querySelector(`[onclick="sortTable('${column}')"]`);
         currentHeader.classList.add('sorted');
         const currentIcon = currentHeader.querySelector('.sort-icon');
         currentIcon.className = `bi bi-chevron-${currentSort.direction === 'asc' ? 'up' : 'down'} sort-icon`;

         // Apply sort to URL parameters
         const params = new URLSearchParams(window.location.search);
         params.set('sort_column', column);
         params.set('sort_direction', currentSort.direction);
         
         window.location.href = window.location.pathname + '?' + params.toString();
     }

     // Quick Reply Function
     function quickReply(messageId) {
         const replyText = prompt('Enter your quick reply:');
         if (replyText && replyText.trim()) {
             fetch(`/admin/messages/${messageId}/quick-reply`, {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                 },
                 body: JSON.stringify({
                     reply: replyText.trim()
                 })
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     window.location.reload();
                 } else {
                     alert('Error: ' + data.message);
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 alert('An error occurred while sending the reply.');
             });
         }
     }

     // Enhanced Keyboard Shortcuts and Accessibility
     document.addEventListener('keydown', function(e) {
         // Don't trigger shortcuts when typing in inputs
         if (e.target.matches('input, textarea, select')) {
             return;
         }

         // Help modal toggle with '?' key
         if (e.key === '?' && !e.ctrlKey && !e.shiftKey && !e.altKey) {
             e.preventDefault();
             toggleKeyboardHelp();
             return;
         }

         // Ctrl/Cmd + A to select all
         if ((e.ctrlKey || e.metaKey) && e.key === 'a') {
             e.preventDefault();
             document.getElementById('selectAll').checked = true;
             toggleSelectAll();
         }
         
         // Escape to clear selection or close modals
         if (e.key === 'Escape') {
             clearSelection();
             hideMessagePreview();
             
             // Also close help modal if open
             const modal = document.getElementById('keyboard-help-modal');
             if (modal && modal.style.display === 'flex') {
                 toggleKeyboardHelp();
             }
         }
         
         // Ctrl/Cmd + R to refresh
         if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
             e.preventDefault();
             refreshTable();
         }

         // F5 to refresh (alternative)
         if (e.key === 'F5') {
             e.preventDefault();
             refreshTable();
         }

         // Ctrl/Cmd + F to focus search
         if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
             e.preventDefault();
             document.getElementById('search').focus();
         }

         // Delete key to bulk close selected messages
         if (e.key === 'Delete' && getSelectedMessages().length > 0) {
             e.preventDefault();
             if (confirm('Are you sure you want to close the selected messages?')) {
                 bulkClose();
             }
         }

         // Enter key to bulk reply to selected messages
         if (e.key === 'Enter' && getSelectedMessages().length > 0) {
             e.preventDefault();
             bulkReply();
         }

         // Arrow keys for navigation
         if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
             e.preventDefault();
             navigateMessages(e.key === 'ArrowDown' ? 1 : -1);
         }

         // Number keys for quick actions
         if (e.key >= '1' && e.key <= '9') {
             const selectedMessages = getSelectedMessages();
             if (selectedMessages.length > 0) {
                 switch(e.key) {
                     case '1':
                         bulkReply();
                         break;
                     case '2':
                         bulkClose();
                         break;
                     case '3':
                         bulkPending();
                         break;
                 }
             }
         }

         // Ctrl/Cmd + Shift + A to toggle advanced filters
         if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'A') {
             e.preventDefault();
             toggleAdvancedFilters();
         }

         // Ctrl/Cmd + Shift + E to export
         if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'E') {
             e.preventDefault();
             exportMessages();
         }
     });

     // Message Navigation Function
     let currentMessageIndex = -1;
     
     function navigateMessages(direction) {
         const messageRows = document.querySelectorAll('.table-row');
         if (messageRows.length === 0) return;

         // Remove previous highlight
         messageRows.forEach(row => row.classList.remove('keyboard-focus'));

         // Calculate new index
         currentMessageIndex += direction;
         if (currentMessageIndex < 0) currentMessageIndex = messageRows.length - 1;
         if (currentMessageIndex >= messageRows.length) currentMessageIndex = 0;

         // Highlight current message
         const currentRow = messageRows[currentMessageIndex];
         currentRow.classList.add('keyboard-focus');
         currentRow.scrollIntoView({ behavior: 'smooth', block: 'center' });

         // Show preview for current message
         const messageId = currentRow.dataset.messageId;
         if (messageId) {
             showMessagePreview(messageId);
         }
     }

     // Helper function to get selected message IDs
     function getSelectedMessages() {
         return Array.from(document.querySelectorAll('.message-checkbox:checked')).map(cb => cb.value);
     }

     // Accessibility improvements
     function initializeAccessibility() {
         // Add ARIA labels and roles
         document.querySelectorAll('.sortable-header').forEach(header => {
             header.setAttribute('role', 'button');
             header.setAttribute('tabindex', '0');
             header.setAttribute('aria-label', `Sort by ${header.textContent.trim()}`);
             
             // Add keyboard support for sortable headers
             header.addEventListener('keydown', function(e) {
                 if (e.key === 'Enter' || e.key === ' ') {
                     e.preventDefault();
                     this.click();
                 }
             });
         });

         // Add ARIA labels to checkboxes
         document.querySelectorAll('.message-checkbox').forEach(checkbox => {
             const row = checkbox.closest('.table-row');
             const userName = row.querySelector('.user-name')?.textContent || 'Unknown';
             const subject = row.querySelector('.subject-text')?.textContent || 'No subject';
             checkbox.setAttribute('aria-label', `Select message from ${userName}: ${subject}`);
         });

         // Add ARIA labels to action buttons
         document.querySelectorAll('.btn-action').forEach(button => {
             const title = button.getAttribute('title');
             if (title) {
                 button.setAttribute('aria-label', title);
             }
         });

         // Add live region for status updates
         const liveRegion = document.createElement('div');
         liveRegion.setAttribute('aria-live', 'polite');
         liveRegion.setAttribute('aria-atomic', 'true');
         liveRegion.className = 'sr-only';
         liveRegion.id = 'status-updates';
         document.body.appendChild(liveRegion);

         // Announce keyboard shortcuts on page load
         setTimeout(() => {
             announceToScreenReader('Messages page loaded. Use Ctrl+F to search, Ctrl+A to select all, arrow keys to navigate.');
         }, 1000);
     }

     // Screen reader announcements
     function announceToScreenReader(message) {
         const liveRegion = document.getElementById('status-updates');
         if (liveRegion) {
             liveRegion.textContent = message;
             setTimeout(() => {
                 liveRegion.textContent = '';
             }, 1000);
         }
     }

     // Enhanced bulk actions with announcements
     function enhancedBulkReply() {
         const count = getSelectedMessages().length;
         if (count === 0) {
             announceToScreenReader('No messages selected for bulk reply.');
             return;
         }
         announceToScreenReader(`Initiating bulk reply for ${count} messages.`);
         bulkReply();
     }

     function enhancedBulkClose() {
         const count = getSelectedMessages().length;
         if (count === 0) {
             announceToScreenReader('No messages selected for bulk close.');
             return;
         }
         announceToScreenReader(`Closing ${count} messages.`);
         bulkClose();
     }

     function enhancedBulkPending() {
         const count = getSelectedMessages().length;
         if (count === 0) {
             announceToScreenReader('No messages selected for bulk pending.');
             return;
         }
         announceToScreenReader(`Marking ${count} messages as pending.`);
         bulkPending();
     }

     // Focus management
     function manageFocus() {
         // Trap focus in bulk actions bar when visible
         const bulkBar = document.getElementById('bulkActionsBar');
         if (bulkBar && bulkBar.style.display !== 'none') {
             const focusableElements = bulkBar.querySelectorAll('button, [tabindex="0"]');
             const firstElement = focusableElements[0];
             const lastElement = focusableElements[focusableElements.length - 1];

             document.addEventListener('keydown', function trapFocus(e) {
                 if (e.key === 'Tab') {
                     if (e.shiftKey) {
                         if (document.activeElement === firstElement) {
                             e.preventDefault();
                             lastElement.focus();
                         }
                     } else {
                         if (document.activeElement === lastElement) {
                             e.preventDefault();
                             firstElement.focus();
                         }
                     }
                 }
             });
         }
     }

     // Toggle keyboard shortcuts help modal
     function toggleKeyboardHelp() {
         let modal = document.getElementById('keyboard-help-modal');
         
         if (!modal) {
             // Create the modal
             modal = document.createElement('div');
             modal.id = 'keyboard-help-modal';
             modal.className = 'keyboard-help-modal';
             modal.innerHTML = `
                 <div class="modal-overlay" onclick="toggleKeyboardHelp()"></div>
                 <div class="modal-content">
                     <div class="modal-header">
                         <h3>Keyboard Shortcuts</h3>
                         <button class="modal-close" onclick="toggleKeyboardHelp()" aria-label="Close help">
                             <i class="bi bi-x-lg"></i>
                         </button>
                     </div>
                     <div class="modal-body">
                         <div class="shortcuts-grid">
                             <div class="shortcut-group">
                                 <h4>Navigation</h4>
                                 <div class="shortcut-item">
                                     <kbd>Ctrl</kbd> + <kbd>F</kbd>
                                     <span>Focus search</span>
                                 </div>
                                 <div class="shortcut-item">
                                     <kbd>↑</kbd> <kbd>↓</kbd>
                                     <span>Navigate messages</span>
                                 </div>
                                 <div class="shortcut-item">
                                     <kbd>F5</kbd> or <kbd>Ctrl</kbd> + <kbd>R</kbd>
                                     <span>Refresh table</span>
                                 </div>
                             </div>
                             <div class="shortcut-group">
                                 <h4>Selection</h4>
                                 <div class="shortcut-item">
                                     <kbd>Ctrl</kbd> + <kbd>A</kbd>
                                     <span>Select all messages</span>
                                 </div>
                                 <div class="shortcut-item">
                                     <kbd>Esc</kbd>
                                     <span>Clear selection</span>
                                 </div>
                             </div>
                             <div class="shortcut-group">
                                 <h4>Actions</h4>
                                 <div class="shortcut-item">
                                     <kbd>Enter</kbd>
                                     <span>Bulk reply to selected</span>
                                 </div>
                                 <div class="shortcut-item">
                                     <kbd>Delete</kbd>
                                     <span>Bulk close selected</span>
                                 </div>
                                 <div class="shortcut-item">
                                     <kbd>1</kbd> <kbd>2</kbd> <kbd>3</kbd>
                                     <span>Quick bulk actions</span>
                                 </div>
                             </div>
                             <div class="shortcut-group">
                                 <h4>Advanced</h4>
                                 <div class="shortcut-item">
                                     <kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>A</kbd>
                                     <span>Toggle advanced filters</span>
                                 </div>
                                 <div class="shortcut-item">
                                     <kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>E</kbd>
                                     <span>Export messages</span>
                                 </div>
                                 <div class="shortcut-item">
                                     <kbd>?</kbd>
                                     <span>Toggle this help</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             `;
             document.body.appendChild(modal);
         }
         
         modal.style.display = modal.style.display === 'flex' ? 'none' : 'flex';
         
         // Focus management
         if (modal.style.display === 'flex') {
             modal.querySelector('.modal-close').focus();
         }
     }
     document.addEventListener('DOMContentLoaded', function() {
         // Initialize accessibility features
         initializeAccessibility();
         
         document.getElementById('search').addEventListener('input', debounce(applyFilters, 500));
         document.getElementById('status').addEventListener('change', applyFilters);
         document.getElementById('sort').addEventListener('change', applyFilters);
         
         // Add event listeners for message checkboxes
         document.querySelectorAll('.message-checkbox').forEach(checkbox => {
             checkbox.addEventListener('change', function() {
                 const row = this.closest('.table-row');
                 if (this.checked) {
                     row.classList.add('selected');
                 } else {
                     row.classList.remove('selected');
                 }
                 updateBulkActions();
                 manageFocus();
             });
         });
         
         // Initialize sort indicators based on current URL parameters
         const urlParams = new URLSearchParams(window.location.search);
         const sortColumn = urlParams.get('sort_column');
         const sortDirection = urlParams.get('sort_direction');
         
         if (sortColumn && sortDirection) {
             currentSort.column = sortColumn;
             currentSort.direction = sortDirection;
             
             const header = document.querySelector(`[onclick="sortTable('${sortColumn}')"]`);
             if (header) {
                 header.classList.add('sorted');
                 const icon = header.querySelector('.sort-icon');
                 icon.className = `bi bi-chevron-${sortDirection === 'asc' ? 'up' : 'down'} sort-icon`;
             }
         }

         // Add keyboard shortcuts help button
         const helpButton = document.createElement('button');
         helpButton.className = 'btn-help';
         helpButton.innerHTML = '<i class="bi bi-question-circle"></i>';
         helpButton.title = 'Keyboard Shortcuts (Press ? to toggle)';
         helpButton.setAttribute('aria-label', 'Show keyboard shortcuts help');
         helpButton.onclick = toggleKeyboardHelp;
         
         // Add help button to the header actions
         const headerActions = document.querySelector('.header-actions');
         if (headerActions) {
             headerActions.appendChild(helpButton);
         }
     });

     function debounce(func, wait) {
         let timeout;
         return function executedFunction(...args) {
             const later = () => {
                 clearTimeout(timeout);
                 func(...args);
             };
             clearTimeout(timeout);
             timeout = setTimeout(later, wait);
         };
     }
 </script>
 @endpush
 @endsection