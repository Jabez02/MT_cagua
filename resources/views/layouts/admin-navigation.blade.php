<nav class="admin-navbar">
    <div class="admin-nav-container">
        <!-- Admin Brand Section -->
        <div class="admin-nav-brand">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand-link">
                <div class="admin-brand-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z" fill="currentColor"/>
                        <path d="M19 15L20.09 21.26L29 22L20.09 22.74L19 29L17.91 22.74L9 22L17.91 21.26L19 15Z" fill="currentColor" opacity="0.7"/>
                        <path d="M5 15L6.09 21.26L15 22L6.09 22.74L5 29L3.91 22.74L-5 22L3.91 21.26L5 15Z" fill="currentColor" opacity="0.5"/>
                    </svg>
                </div>
                <div class="admin-brand-text">
                    <span class="admin-brand-title">Mt. Cagua</span>
                    <span class="admin-brand-subtitle">Admin Panel</span>
                </div>
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="admin-mobile-toggle" type="button" aria-label="Toggle admin navigation">
            <span class="admin-hamburger-line"></span>
            <span class="admin-hamburger-line"></span>
            <span class="admin-hamburger-line"></span>
        </button>

        <!-- Admin Navigation Menu -->
        <div class="admin-nav-menu">
            <!-- Primary Admin Navigation -->
            <ul class="admin-nav-links">
                <li class="admin-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <div class="admin-nav-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 13H11V3H3V13ZM3 21H11V15H3V21ZM13 21H21V11H13V21ZM13 3V9H21V3H13Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="admin-nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('chat.index') }}" class="admin-nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                        <div class="admin-nav-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 2H4C2.9 2 2.01 2.9 2.01 4L2 22L6 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM18 14H6V12H18V14ZM18 11H6V9H18V11ZM18 8H6V6H18V8Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="admin-nav-text">Messages</span>
                        <span id="admin-unread-messages-count" class="admin-message-badge d-none">0</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.bookings.index') }}" class="admin-nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                        <div class="admin-nav-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3H18V1H16V3H8V1H6V3H5C3.89 3 3.01 3.9 3.01 5L3 19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 19H5V8H19V19ZM7 10H12V15H7V10Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="admin-nav-text">Bookings</span>
                    </a>
                </li>



                <li class="admin-nav-item">
                    <a href="{{ route('admin.reviews.index') }}" class="admin-nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                        <div class="admin-nav-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="admin-nav-text">Reviews</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.manage-user.index') }}" class="admin-nav-link {{ request()->routeIs('admin.manage-user.*') ? 'active' : '' }}">
                        <div class="admin-nav-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 7C16 9.21 14.21 11 12 11C9.79 11 8 9.21 8 7C8 4.79 9.79 3 12 3C14.21 3 16 4.79 16 7ZM12 13C16.42 13 20 15.79 20 19V21H4V19C4 15.79 7.58 13 12 13Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="admin-nav-text">Users</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="admin-nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                        <div class="admin-nav-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 4H4C2.89 4 2.01 4.89 2.01 6L2 18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4ZM20 18H4V12H20V18ZM20 8H4V6H20V8Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="admin-nav-text">Payments</span>
                    </a>
                </li>
            </ul>

            <!-- Admin Profile Section -->
            <div class="admin-profile-section">
                <div class="admin-profile-dropdown">
                    <button class="admin-profile-toggle" type="button" aria-expanded="false">
                        <div class="admin-profile-avatar">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="admin-profile-info">
                            <span class="admin-profile-name">{{ Auth::user()->name }}</span>
                            <span class="admin-profile-role">Administrator</span>
                        </div>
                        <div class="admin-dropdown-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 10L12 15L17 10H7Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </button>

                    <!-- Admin Profile Dropdown Menu -->
                    <div class="admin-profile-dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="admin-dropdown-item">
                            <div class="admin-dropdown-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <span>Profile Settings</span>
                        </a>
                        
                        <div class="admin-dropdown-divider"></div>
                        
                        <form method="POST" action="{{ route('logout') }}" class="admin-logout-form">
                            @csrf
                            <button type="submit" class="admin-dropdown-item admin-logout-btn">
                                <div class="admin-dropdown-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 7L15.59 8.41L18.17 11H8V13H18.17L15.59 15.59L17 17L22 12L17 7ZM4 5H12V3H4C2.9 3 2 3.9 2 5V19C2 20.1 2.9 21 4 21H12V19H4V5Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Overlay -->
    <div class="admin-mobile-nav-overlay"></div>
    <div class="admin-mobile-nav-menu">
        <div class="admin-mobile-nav-header">
            <div class="admin-mobile-brand">
                <div class="admin-brand-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z" fill="currentColor"/>
                    </svg>
                </div>
                <span>Admin Panel</span>
            </div>
            <button class="admin-mobile-close" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="currentColor"/>
                </svg>
            </button>
        </div>

        <div class="admin-mobile-nav-content">
            <ul class="admin-mobile-nav-links">
                <li><a href="{{ route('admin.dashboard') }}" class="admin-mobile-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('chat.index') }}" class="admin-mobile-nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">Messages</a></li>
                <li><a href="{{ route('admin.bookings.index') }}" class="admin-mobile-nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">Bookings</a></li>
                <li><a href="{{ route('admin.reviews.index') }}" class="admin-mobile-nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">Reviews</a></li>
                <li><a href="{{ route('admin.manage-user.index') }}" class="admin-mobile-nav-link {{ request()->routeIs('admin.manage-user.*') ? 'active' : '' }}">Users</a></li>
                <li><a href="{{ route('admin.payments.index') }}" class="admin-mobile-nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">Payments</a></li>
            </ul>

            <div class="admin-mobile-profile">
                <div class="admin-mobile-profile-info">
                    <div class="admin-mobile-avatar">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div>
                        <div class="admin-mobile-name">{{ Auth::user()->name }}</div>
                        <div class="admin-mobile-role">Administrator</div>
                    </div>
                </div>
                <div class="admin-mobile-actions">
                    <a href="{{ route('profile.edit') }}" class="admin-mobile-action">Profile Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="admin-mobile-action admin-mobile-logout">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
/* Admin Navigation Variables */
:root {
    --admin-primary: #1e40af;
    --admin-primary-dark: #1e3a8a;
    --admin-secondary: #3b82f6;
    --admin-accent: #60a5fa;
    --admin-success: #10b981;
    --admin-warning: #f59e0b;
    --admin-danger: #ef4444;
    --admin-dark: #1f2937;
    --admin-light: #f8fafc;
    --admin-white: #ffffff;
    --admin-gray-50: #f9fafb;
    --admin-gray-100: #f3f4f6;
    --admin-gray-200: #e5e7eb;
    --admin-gray-300: #d1d5db;
    --admin-gray-400: #9ca3af;
    --admin-gray-500: #6b7280;
    --admin-gray-600: #4b5563;
    --admin-gray-700: #374151;
    --admin-gray-800: #1f2937;
    --admin-gray-900: #111827;
    --admin-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    --admin-shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --admin-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --admin-shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --admin-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    --admin-radius: 0.75rem;
    --admin-radius-sm: 0.5rem;
    --admin-radius-lg: 1rem;
}

/* Admin Navbar Base */
.admin-navbar {
    background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: var(--admin-shadow-lg);
    position: sticky;
    top: 0;
    z-index: 1000;
    backdrop-filter: blur(10px);
}

.admin-nav-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 4.5rem;
}

/* Admin Brand Section */
.admin-nav-brand {
    flex-shrink: 0;
}

.admin-brand-link {
    display: flex;
    align-items: center;
    gap: 1rem;
    text-decoration: none;
    color: var(--admin-white);
    transition: var(--admin-transition);
}

.admin-brand-link:hover {
    color: var(--admin-accent);
    text-decoration: none;
    transform: translateY(-1px);
}

.admin-brand-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: rgba(255, 255, 255, 0.15);
    border-radius: var(--admin-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--admin-white);
    box-shadow: var(--admin-shadow);
    backdrop-filter: blur(10px);
}

.admin-brand-text {
    display: flex;
    flex-direction: column;
}

.admin-brand-title {
    font-weight: 700;
    font-size: 1.25rem;
    line-height: 1.2;
    color: var(--admin-white);
}

.admin-brand-subtitle {
    font-size: 0.75rem;
    color: var(--admin-accent);
    font-weight: 500;
    opacity: 0.9;
}

/* Mobile Menu Toggle */
.admin-mobile-toggle {
    display: none;
    flex-direction: column;
    gap: 0.25rem;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    padding: 0.75rem;
    cursor: pointer;
    border-radius: var(--admin-radius-sm);
    transition: var(--admin-transition);
    backdrop-filter: blur(10px);
}

.admin-mobile-toggle:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
}

.admin-hamburger-line {
    width: 1.5rem;
    height: 2px;
    background: var(--admin-white);
    border-radius: 1px;
    transition: var(--admin-transition);
}

.admin-mobile-toggle.active .admin-hamburger-line:nth-child(1) {
    transform: rotate(45deg) translate(0.375rem, 0.375rem);
}

.admin-mobile-toggle.active .admin-hamburger-line:nth-child(2) {
    opacity: 0;
}

.admin-mobile-toggle.active .admin-hamburger-line:nth-child(3) {
    transform: rotate(-45deg) translate(0.375rem, -0.375rem);
}

/* Admin Navigation Menu */
.admin-nav-menu {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex: 1;
    justify-content: space-between;
    margin-left: 2rem;
    min-width: 0;
}

.admin-nav-links {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    list-style: none;
    margin: 0;
    padding: 0;
    flex-wrap: nowrap;
    flex-shrink: 1;
}

.admin-nav-item {
    position: relative;
}

.admin-nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: rgba(255, 255, 255, 0.8);
    border-radius: var(--admin-radius-sm);
    transition: var(--admin-transition);
    position: relative;
    overflow: hidden;
    white-space: nowrap;
    min-width: max-content;
    font-weight: 500;
}

.admin-nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    opacity: 0;
    transition: var(--admin-transition);
    z-index: -1;
}

.admin-nav-link:hover {
    color: var(--admin-white);
    text-decoration: none;
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
    box-shadow: var(--admin-shadow);
}

.admin-nav-link:hover::before {
    opacity: 1;
}

.admin-nav-link.active {
    color: var(--admin-white);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: var(--admin-shadow-md);
    backdrop-filter: blur(10px);
}

.admin-nav-link.active::before {
    opacity: 1;
}

.admin-nav-icon {
    flex-shrink: 0;
    transition: var(--admin-transition);
}

.admin-nav-link:hover .admin-nav-icon {
    transform: scale(1.1);
}

.admin-nav-text {
    font-size: 0.875rem;
}

.admin-message-badge {
    background: var(--admin-danger);
    color: var(--admin-white);
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.125rem 0.375rem;
    border-radius: 9999px;
    min-width: 1.25rem;
    height: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 2s infinite;
    box-shadow: var(--admin-shadow);
}

/* Admin Profile Section */
.admin-profile-section {
    position: relative;
}

.admin-profile-dropdown {
    position: relative;
}

.admin-profile-toggle {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    padding: 0.5rem 1rem;
    border-radius: var(--admin-radius);
    cursor: pointer;
    transition: var(--admin-transition);
    white-space: nowrap;
    min-width: max-content;
    backdrop-filter: blur(10px);
}

.admin-profile-toggle:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-1px);
    box-shadow: var(--admin-shadow);
}

.admin-profile-avatar {
    width: 2.25rem;
    height: 2.25rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--admin-white);
    box-shadow: var(--admin-shadow);
}

.admin-profile-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    text-align: left;
    white-space: nowrap;
    min-width: max-content;
}

.admin-profile-name {
    font-weight: 600;
    color: var(--admin-white);
    font-size: 0.875rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 120px;
}

.admin-profile-role {
    font-size: 0.75rem;
    color: var(--admin-accent);
    white-space: nowrap;
    font-weight: 500;
}

.admin-dropdown-arrow {
    color: rgba(255, 255, 255, 0.7);
    transition: var(--admin-transition);
}

.admin-profile-toggle[aria-expanded="true"] .admin-dropdown-arrow {
    transform: rotate(180deg);
}

/* Admin Profile Dropdown Menu */
.admin-profile-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 0.5rem;
    background: var(--admin-white);
    border: 1px solid var(--admin-gray-200);
    border-radius: var(--admin-radius);
    box-shadow: var(--admin-shadow-xl);
    min-width: 14rem;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-0.5rem);
    transition: var(--admin-transition);
    z-index: 1000;
    backdrop-filter: blur(10px);
}

.admin-profile-dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.admin-dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: var(--admin-gray-700);
    font-size: 0.875rem;
    transition: var(--admin-transition);
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-weight: 500;
}

.admin-dropdown-item:hover {
    background: var(--admin-gray-50);
    color: var(--admin-primary);
    text-decoration: none;
}

.admin-dropdown-icon {
    color: var(--admin-gray-500);
    transition: var(--admin-transition);
}

.admin-dropdown-item:hover .admin-dropdown-icon {
    color: var(--admin-primary);
}

.admin-dropdown-divider {
    height: 1px;
    background: var(--admin-gray-200);
    margin: 0.5rem 0;
}

.admin-logout-form {
    margin: 0;
}

.admin-logout-btn {
    width: 100%;
}

/* Mobile Navigation */
.admin-mobile-nav-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
    transition: var(--admin-transition);
}

.admin-mobile-nav-menu {
    position: fixed;
    top: 0;
    right: -100%;
    width: 320px;
    height: 100vh;
    background: var(--admin-white);
    z-index: 9999;
    transition: var(--admin-transition);
    box-shadow: var(--admin-shadow-xl);
    display: none;
    flex-direction: column;
}

.admin-mobile-nav-overlay.show {
    opacity: 1;
    visibility: visible;
}

.admin-mobile-nav-menu.show {
    right: 0;
    display: flex;
}

.admin-mobile-nav-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--admin-gray-200);
    background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
}

.admin-mobile-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--admin-white);
    font-weight: 600;
}

.admin-mobile-close {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    padding: 0.5rem;
    border-radius: var(--admin-radius-sm);
    color: var(--admin-white);
    cursor: pointer;
    transition: var(--admin-transition);
}

.admin-mobile-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

.admin-mobile-nav-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 1.5rem;
}

.admin-mobile-nav-links {
    list-style: none;
    margin: 0;
    padding: 0;
    flex: 1;
}

.admin-mobile-nav-links li {
    margin-bottom: 0.5rem;
}

.admin-mobile-nav-link {
    display: block;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: var(--admin-gray-700);
    border-radius: var(--admin-radius-sm);
    transition: var(--admin-transition);
    font-weight: 500;
}

.admin-mobile-nav-link:hover,
.admin-mobile-nav-link.active {
    background: var(--admin-primary);
    color: var(--admin-white);
    text-decoration: none;
}

.admin-mobile-profile {
    border-top: 1px solid var(--admin-gray-200);
    padding-top: 1.5rem;
    margin-top: 1.5rem;
}

.admin-mobile-profile-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.admin-mobile-avatar {
    width: 2.5rem;
    height: 2.5rem;
    background: var(--admin-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--admin-white);
}

.admin-mobile-name {
    font-weight: 600;
    color: var(--admin-gray-900);
}

.admin-mobile-role {
    font-size: 0.75rem;
    color: var(--admin-gray-500);
}

.admin-mobile-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.admin-mobile-action {
    display: block;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: var(--admin-gray-700);
    border-radius: var(--admin-radius-sm);
    transition: var(--admin-transition);
    border: none;
    background: none;
    text-align: left;
    cursor: pointer;
    font-weight: 500;
    width: 100%;
}

.admin-mobile-action:hover {
    background: var(--admin-gray-100);
    color: var(--admin-primary);
    text-decoration: none;
}

.admin-mobile-logout {
    color: var(--admin-danger);
}

.admin-mobile-logout:hover {
    background: rgba(239, 68, 68, 0.1);
    color: var(--admin-danger);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .admin-nav-text {
        display: none;
    }
    
    .admin-nav-link {
        padding: 0.75rem;
    }
    
    .admin-profile-info {
        display: none;
    }
}

@media (max-width: 480px) {
    .admin-mobile-toggle {
        display: flex;
    }
    
    .admin-nav-menu {
        display: none;
    }
    
    .admin-nav-container {
        padding: 0 1rem;
    }
}

/* Animations */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

/* Print Styles */
@media print {
    .admin-navbar {
        display: none;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .admin-navbar {
        background: var(--admin-dark);
        border-bottom: 2px solid var(--admin-white);
    }
    
    .admin-nav-link {
        border: 1px solid transparent;
    }
    
    .admin-nav-link:hover,
    .admin-nav-link.active {
        border-color: var(--admin-white);
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Admin Profile Dropdown
    const adminProfileToggle = document.querySelector('.admin-profile-toggle');
    const adminProfileDropdown = document.querySelector('.admin-profile-dropdown-menu');
    
    if (adminProfileToggle && adminProfileDropdown) {
        adminProfileToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            adminProfileDropdown.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!adminProfileToggle.contains(e.target) && !adminProfileDropdown.contains(e.target)) {
                adminProfileToggle.setAttribute('aria-expanded', 'false');
                adminProfileDropdown.classList.remove('show');
            }
        });
    }
    
    // Mobile Navigation
    const adminMobileToggle = document.querySelector('.admin-mobile-toggle');
    const adminMobileOverlay = document.querySelector('.admin-mobile-nav-overlay');
    const adminMobileMenu = document.querySelector('.admin-mobile-nav-menu');
    const adminMobileClose = document.querySelector('.admin-mobile-close');
    
    function openMobileMenu() {
        adminMobileToggle?.classList.add('active');
        adminMobileOverlay?.classList.add('show');
        adminMobileMenu?.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMobileMenu() {
        adminMobileToggle?.classList.remove('active');
        adminMobileOverlay?.classList.remove('show');
        adminMobileMenu?.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    adminMobileToggle?.addEventListener('click', function() {
        if (this.classList.contains('active')) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    });
    
    adminMobileClose?.addEventListener('click', closeMobileMenu);
    adminMobileOverlay?.addEventListener('click', closeMobileMenu);
    
    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });
    
    // Update unread messages count
    function updateUnreadMessagesCount() {
        // Determine the correct endpoint based on user type
        const isAdmin = document.querySelector('.admin-navigation') !== null;
        const endpoint = isAdmin ? '/admin/messages/unread-count' : '/messages/unread-count';
        
        fetch(endpoint, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            credentials: 'same-origin'
        })
            .then(response => {
                // Check if response is ok and content-type is JSON
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    // If we get HTML instead of JSON, user is likely not authenticated
                    console.warn('Received non-JSON response, user may not be authenticated');
                    return null;
                }
                
                return response.json();
            })
            .then(data => {
                // If data is null (authentication issue), skip updating
                if (!data) {
                    return;
                }
                
                const badge = document.getElementById('admin-unread-messages-count');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.classList.remove('d-none');
                    } else {
                        badge.classList.add('d-none');
                    }
                }
            })
            .catch(error => {
                // Only log actual errors, not authentication redirects
                if (error.message.includes('Unexpected token')) {
                    console.warn('Authentication required for unread count endpoint');
                } else {
                    console.error('Error fetching unread messages count:', error);
                }
            });
    }
    
    // Update count on page load and every 30 seconds
    updateUnreadMessagesCount();
    setInterval(updateUnreadMessagesCount, 30000);
});
</script>

@push('scripts')
<script src="{{ asset('js/unread-messages.js') }}"></script>
@endpush