<nav class="user-navbar">
    <div class="user-nav-container">
        <!-- Logo Section -->
        <div class="user-nav-brand">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <div class="brand-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="brand-text">Mt. Cagua</span>
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" type="button" aria-label="Toggle navigation">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="user-nav-menu">
            <!-- Primary Navigation -->
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Home</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="7" height="7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="14" y="3" width="7" height="7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="14" y="14" width="7" height="7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="3" y="14" width="7" height="7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                


                <li class="nav-item">
                    <a href="{{ route('user.bookings.index') }}" class="nav-link {{ request()->routeIs('user.bookings.*') ? 'active' : '' }}">
                        <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>My Bookings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.reviews.index') }}" class="nav-link {{ request()->routeIs('user.reviews.*') ? 'active' : '' }}">
                        <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>My Reviews</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('chat.index') }}" class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                        <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Messages</span>
                        <span id="user-unread-messages-count" class="message-badge d-none">0</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.announcements.index') }}" class="nav-link {{ request()->routeIs('user.announcements.*') ? 'active' : '' }}">
                        <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 8C18 6.4087 17.3679 4.88258 16.2426 3.75736C15.1174 2.63214 13.5913 2 12 2C10.4087 2 8.88258 2.63214 7.75736 3.75736C6.63214 4.88258 6 6.4087 6 8C6 15 3 17 3 17H21C21 17 18 15 18 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Announcements</span>
                    </a>
                </li>
            </ul>

            <!-- User Profile Section -->
            <div class="user-profile-section">
                <div class="user-profile-dropdown">
                    <button class="profile-toggle" type="button" aria-expanded="false">
                        <div class="profile-avatar">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="profile-info">
                            <span class="profile-name">{{ Auth::user()->name }}</span>
                            <span class="profile-role">Hiker</span>
                        </div>
                        <svg class="dropdown-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="profile-dropdown-menu">
                        <a href="{{ route('user.profile.show') }}" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>View Profile</span>
                        </a>
                        <a href="{{ route('user.profile.edit') }}" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.5 2.50023C18.8978 2.1024 19.4374 1.87891 20 1.87891C20.5626 1.87891 21.1022 2.1024 21.5 2.50023C21.8978 2.89805 22.1213 3.43762 22.1213 4.00023C22.1213 4.56284 21.8978 5.1024 21.5 5.50023L12 15.0002L8 16.0002L9 12.0002L18.5 2.50023Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Edit Profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 17L21 12L16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Log Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div class="mobile-nav-overlay">
        <div class="mobile-nav-menu">
            <div class="mobile-nav-header">
                <div class="mobile-user-info">
                    <div class="mobile-avatar">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="mobile-user-details">
                        <span class="mobile-user-name">{{ Auth::user()->name }}</span>
                        <span class="mobile-user-role">Hiker</span>
                    </div>
                </div>
                <button class="mobile-close-btn" type="button" aria-label="Close menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line x1="18" y1="6" x2="6" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="6" y1="6" x2="18" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <ul class="mobile-nav-links">
                <li><a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('dashboard') }}" class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>

                <li><a href="{{ route('user.bookings.index') }}" class="mobile-nav-link {{ request()->routeIs('user.bookings.*') ? 'active' : '' }}">My Bookings</a></li>
                <li><a href="{{ route('user.reviews.index') }}" class="mobile-nav-link {{ request()->routeIs('user.reviews.*') ? 'active' : '' }}">My Reviews</a></li>
                <li><a href="{{ route('chat.index') }}" class="mobile-nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">Messages</a></li>
                <li><a href="{{ route('user.announcements.index') }}" class="mobile-nav-link {{ request()->routeIs('user.announcements.*') ? 'active' : '' }}">Announcements</a></li>
                <li><a href="{{ route('user.profile.show') }}" class="mobile-nav-link">View Profile</a></li>
                <li><a href="{{ route('user.profile.edit') }}" class="mobile-nav-link">Edit Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="mobile-logout-form">
                        @csrf
                        <button type="submit" class="mobile-nav-link logout-btn">Log Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
/* User Navigation Bar Styles */
:root {
    --user-nav-primary: #2563eb;
    --user-nav-primary-dark: #1d4ed8;
    --user-nav-secondary: #64748b;
    --user-nav-accent: #0ea5e9;
    --user-nav-success: #10b981;
    --user-nav-warning: #f59e0b;
    --user-nav-danger: #ef4444;
    --user-nav-bg: #ffffff;
    --user-nav-bg-secondary: #f8fafc;
    --user-nav-border: #e2e8f0;
    --user-nav-text: #1e293b;
    --user-nav-text-muted: #64748b;
    --user-nav-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    --user-nav-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --user-nav-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    --user-nav-radius: 0.75rem;
    --user-nav-radius-sm: 0.5rem;
}

.user-navbar {
    background: var(--user-nav-bg);
    border-bottom: 1px solid var(--user-nav-border);
    box-shadow: var(--user-nav-shadow);
    position: sticky;
    top: 0;
    z-index: 1000;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

.user-nav-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 4rem;
}

/* Brand Section */
.user-nav-brand {
    flex-shrink: 0;
}

.brand-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    color: var(--user-nav-text);
    font-weight: 600;
    font-size: 1.25rem;
    transition: var(--user-nav-transition);
}

.brand-link:hover {
    color: var(--user-nav-primary);
    text-decoration: none;
}

.brand-icon {
    width: 2rem;
    height: 2rem;
    background: linear-gradient(135deg, var(--user-nav-primary), var(--user-nav-accent));
    border-radius: var(--user-nav-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: var(--user-nav-shadow);
}

.brand-text {
    background: linear-gradient(135deg, var(--user-nav-primary), var(--user-nav-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
    display: none;
    flex-direction: column;
    gap: 0.25rem;
    background: none;
    border: none;
    padding: 0.5rem;
    cursor: pointer;
    border-radius: var(--user-nav-radius-sm);
    transition: var(--user-nav-transition);
}

.mobile-menu-toggle:hover {
    background: var(--user-nav-bg-secondary);
}

.hamburger-line {
    width: 1.5rem;
    height: 2px;
    background: var(--user-nav-text);
    border-radius: 1px;
    transition: var(--user-nav-transition);
}

.mobile-menu-toggle.active .hamburger-line:nth-child(1) {
    transform: rotate(45deg) translate(0.375rem, 0.375rem);
}

.mobile-menu-toggle.active .hamburger-line:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active .hamburger-line:nth-child(3) {
    transform: rotate(-45deg) translate(0.375rem, -0.375rem);
}

/* Navigation Menu */
.user-nav-menu {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex: 1;
    justify-content: space-between;
    margin-left: 2rem;
    min-width: 0;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    list-style: none;
    margin: 0;
    padding: 0;
    flex-wrap: nowrap;
    flex-shrink: 1;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: var(--user-nav-text-muted);
    font-weight: 500;
    border-radius: var(--user-nav-radius-sm);
    transition: var(--user-nav-transition);
    position: relative;
    overflow: hidden;
    white-space: nowrap;
    min-width: max-content;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, var(--user-nav-primary), var(--user-nav-accent));
    opacity: 0;
    transition: var(--user-nav-transition);
    z-index: -1;
}

.nav-link:hover {
    color: var(--user-nav-primary);
    text-decoration: none;
    background: var(--user-nav-bg-secondary);
    transform: translateY(-1px);
}

.nav-link.active {
    color: white;
    background: linear-gradient(135deg, var(--user-nav-primary), var(--user-nav-accent));
    box-shadow: var(--user-nav-shadow);
}

.nav-link.active::before {
    opacity: 1;
}

.nav-icon {
    flex-shrink: 0;
    transition: var(--user-nav-transition);
}

.nav-link:hover .nav-icon {
    transform: scale(1.1);
}

.message-badge {
    background: var(--user-nav-danger);
    color: white;
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
}

/* User Profile Section */
.user-profile-section {
    position: relative;
    flex-shrink: 0;
}

.profile-toggle {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: none;
    border: none;
    padding: 0.5rem;
    border-radius: var(--user-nav-radius);
    cursor: pointer;
    transition: var(--user-nav-transition);
    white-space: nowrap;
    min-width: max-content;
}

.profile-toggle:hover {
    background: var(--user-nav-bg-secondary);
}

.profile-avatar {
    width: 2.5rem;
    height: 2.5rem;
    background: linear-gradient(135deg, var(--user-nav-primary), var(--user-nav-accent));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: var(--user-nav-shadow);
}

.profile-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    text-align: left;
    white-space: nowrap;
    min-width: max-content;
}

.profile-name {
    font-weight: 600;
    color: var(--user-nav-text);
    font-size: 0.875rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 120px;
}

.profile-role {
    font-size: 0.75rem;
    color: var(--user-nav-text-muted);
    white-space: nowrap;
}

.dropdown-arrow {
    color: var(--user-nav-text-muted);
    transition: var(--user-nav-transition);
}

.profile-toggle[aria-expanded="true"] .dropdown-arrow {
    transform: rotate(180deg);
}

/* Profile Dropdown Menu */
.profile-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 0.5rem;
    background: var(--user-nav-bg);
    border: 1px solid var(--user-nav-border);
    border-radius: var(--user-nav-radius);
    box-shadow: var(--user-nav-shadow-lg);
    min-width: 12rem;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-0.5rem);
    transition: var(--user-nav-transition);
    z-index: 1000;
}

.profile-dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: var(--user-nav-text);
    font-size: 0.875rem;
    transition: var(--user-nav-transition);
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.dropdown-item:hover {
    background: var(--user-nav-bg-secondary);
    color: var(--user-nav-primary);
    text-decoration: none;
}

.dropdown-divider {
    height: 1px;
    background: var(--user-nav-border);
    margin: 0.5rem 0;
}

.logout-form {
    margin: 0;
}

.logout-btn {
    width: 100%;
}

/* Mobile Navigation */
.mobile-nav-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: var(--user-nav-transition);
}

.mobile-nav-overlay.show {
    opacity: 1;
    visibility: visible;
}

.mobile-nav-menu {
    position: absolute;
    top: 0;
    right: 0;
    width: 20rem;
    max-width: 90vw;
    height: 100vh;
    background: var(--user-nav-bg);
    box-shadow: var(--user-nav-shadow-lg);
    transform: translateX(100%);
    transition: var(--user-nav-transition);
    overflow-y: auto;
}

.mobile-nav-overlay.show .mobile-nav-menu {
    transform: translateX(0);
}

.mobile-nav-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem;
    border-bottom: 1px solid var(--user-nav-border);
}

.mobile-user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.mobile-avatar {
    width: 2.5rem;
    height: 2.5rem;
    background: linear-gradient(135deg, var(--user-nav-primary), var(--user-nav-accent));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.mobile-user-details {
    display: flex;
    flex-direction: column;
}

.mobile-user-name {
    font-weight: 600;
    color: var(--user-nav-text);
    font-size: 0.875rem;
}

.mobile-user-role {
    font-size: 0.75rem;
    color: var(--user-nav-text-muted);
}

.mobile-close-btn {
    background: none;
    border: none;
    padding: 0.5rem;
    cursor: pointer;
    border-radius: var(--user-nav-radius-sm);
    color: var(--user-nav-text-muted);
    transition: var(--user-nav-transition);
}

.mobile-close-btn:hover {
    background: var(--user-nav-bg-secondary);
    color: var(--user-nav-text);
}

.mobile-nav-links {
    list-style: none;
    margin: 0;
    padding: 1rem 0;
}

.mobile-nav-links li {
    margin: 0;
}

.mobile-nav-link {
    display: block;
    padding: 1rem 1.5rem;
    text-decoration: none;
    color: var(--user-nav-text);
    font-weight: 500;
    transition: var(--user-nav-transition);
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.mobile-nav-link:hover,
.mobile-nav-link.active {
    background: var(--user-nav-bg-secondary);
    color: var(--user-nav-primary);
    text-decoration: none;
}

.mobile-logout-form {
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .mobile-menu-toggle {
        display: flex;
    }
    
    .user-nav-menu {
        display: none;
    }
    
    .user-nav-container {
        padding: 0 1rem;
    }
    
    .brand-text {
        display: none;
    }
}

@media (max-width: 480px) {
    .user-nav-container {
        padding: 0 0.75rem;
    }
    
    .mobile-nav-menu {
        width: 100vw;
        max-width: 100vw;
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

/* Focus States for Accessibility */
.nav-link:focus,
.profile-toggle:focus,
.mobile-menu-toggle:focus,
.dropdown-item:focus,
.mobile-nav-link:focus {
    outline: 2px solid var(--user-nav-primary);
    outline-offset: 2px;
}

/* Print Styles */
@media print {
    .user-navbar {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileOverlay = document.querySelector('.mobile-nav-overlay');
    const mobileCloseBtn = document.querySelector('.mobile-close-btn');
    
    function toggleMobileMenu() {
        mobileToggle.classList.toggle('active');
        mobileOverlay.classList.toggle('show');
        document.body.style.overflow = mobileOverlay.classList.contains('show') ? 'hidden' : '';
    }
    
    function closeMobileMenu() {
        mobileToggle.classList.remove('active');
        mobileOverlay.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    if (mobileToggle) {
        mobileToggle.addEventListener('click', toggleMobileMenu);
    }
    
    if (mobileCloseBtn) {
        mobileCloseBtn.addEventListener('click', closeMobileMenu);
    }
    
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', function(e) {
            if (e.target === mobileOverlay) {
                closeMobileMenu();
            }
        });
    }
    
    // Profile dropdown toggle
    const profileToggle = document.querySelector('.profile-toggle');
    const profileDropdown = document.querySelector('.profile-dropdown-menu');
    
    function toggleProfileDropdown() {
        const isExpanded = profileToggle.getAttribute('aria-expanded') === 'true';
        profileToggle.setAttribute('aria-expanded', !isExpanded);
        profileDropdown.classList.toggle('show');
    }
    
    function closeProfileDropdown() {
        profileToggle.setAttribute('aria-expanded', 'false');
        profileDropdown.classList.remove('show');
    }
    
    if (profileToggle) {
        profileToggle.addEventListener('click', toggleProfileDropdown);
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (profileDropdown && !profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
            closeProfileDropdown();
        }
    });
    
    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
            closeProfileDropdown();
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            closeMobileMenu();
        }
    });
});
</script>

@push('scripts')
<script src="{{ asset('js/unread-messages.js') }}"></script>
@endpush