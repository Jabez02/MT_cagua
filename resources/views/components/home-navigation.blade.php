<!-- Modern Navigation Component -->
<nav class="navbar" role="navigation" aria-label="Main navigation">
    <div class="nav-container">
        <!-- Brand/Logo -->
        <div class="nav-brand">
            <a href="{{ route('home') }}" class="brand-link" aria-label="Mt. Cagua Adventures - Home">
                <svg class="brand-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 20L12 4L21 20H3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7 20L12 10L17 20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="brand-text">Mt. Cagua</span>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="nav-menu" id="nav-menu">
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ route('home') }}" 
                       class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="9,22 9,12 15,12 15,22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav-text">Home</span>
                    </a>
                </li>
                


                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                        <div class="nav-link-content">
                            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="12" y1="17" x2="12.01" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <span class="nav-text">About</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <div class="nav-link-content">
                            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2"/>
                                <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span class="nav-text">Contact</span>
                        </div>
                    </a>
                </li>
            </ul>

            <!-- Authentication Section -->
            <div class="nav-auth">
                @auth
                    <div class="user-menu dropdown">
                        <button class="user-toggle dropdown-toggle" type="button" aria-expanded="false">
                            <div class="user-avatar">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <svg class="dropdown-icon" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="6,9 12,15 18,9" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                            <a href="{{ route('user.bookings.index') }}" class="dropdown-item">My Bookings</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item logout-btn">Log Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="auth-buttons">
                        <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
                        @if (Route::has('register'))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                        @endif
                    </div>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-toggle" type="button" aria-label="Toggle mobile menu" aria-expanded="false">
            <div class="hamburger-container">
                <span class="hamburger-line hamburger-line-1"></span>
                <span class="hamburger-line hamburger-line-2"></span>
                <span class="hamburger-line hamburger-line-3"></span>
            </div>  
        </button>
    </div>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-overlay"></div>
</nav>

<style>
/* Navigation Styles */
.navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 70px;
    gap: 3rem;
}

/* Brand Styles */
.nav-brand {
    flex: 0 0 auto;
    margin-right: 1.5rem;
}

.nav-brand .brand-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    color: #1f2937;
    font-weight: 700;
    font-size: 1.25rem;
    transition: color 0.3s ease;
}

.nav-brand .brand-link:hover {
    color: #3b82f6;
}

.brand-icon {
    color: #3b82f6;
}

/* Navigation Menu */
.nav-menu {
    display: flex;
    align-items: center;
    gap: 2.5rem;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 1rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.75rem 1.25rem;
    color: #4b5563;
    text-decoration: none;
    font-weight: 500;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.nav-icon {
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.nav-text {
    white-space: nowrap;
}

.nav-link-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.nav-link:hover,
.nav-link.active {
    color: #3b82f6;
    background: rgba(59, 130, 246, 0.1);
}

/* Dropdown Styles */
.dropdown {
    position: relative;
}

.dropdown-icon {
    transition: transform 0.3s ease;
}

.dropdown.active .dropdown-icon {
    transform: rotate(180deg);
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 220px;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.75rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.dropdown.active .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: #4b5563;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.dropdown-icon-item {
    flex-shrink: 0;
    opacity: 0.7;
    transition: all 0.2s ease;
}

.dropdown-item:hover .dropdown-icon-item {
    opacity: 1;
    transform: scale(1.1);
}

.dropdown-item:hover {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.dropdown-divider {
    height: 1px;
    background: rgba(0, 0, 0, 0.1);
    margin: 0.5rem 0;
}

/* User Menu Dropdown - Desktop */
.user-menu {
    position: relative;
}

.user-menu .dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    left: auto;
    min-width: 220px;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.75rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    margin-top: 0.5rem;
    max-height: 0;
    overflow: hidden;
}

.user-menu.dropdown.active .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    max-height: 300px; /* Allow enough height for content */
}

/* Authentication Styles */
.nav-auth {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-menu .user-toggle {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 1rem;
    background: none;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.user-menu .user-toggle:hover {
    border-color: #3b82f6;
    background: rgba(59, 130, 246, 0.05);
}

.user-avatar {
    width: 32px;
    height: 32px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6b7280;
}

.user-name {
    font-weight: 500;
    color: #1f2937;
    font-size: 0.9rem;
}

.auth-buttons {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    border: 1px solid transparent;
    cursor: pointer;
}

.btn-outline {
    color: #4b5563;
    border-color: rgba(0, 0, 0, 0.2);
    background: transparent;
}

.btn-outline:hover {
    color: #3b82f6;
    border-color: #3b82f6;
    background: rgba(59, 130, 246, 0.05);
}

.btn-primary {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
}

.btn-primary:hover {
    background: #2563eb;
    border-color: #2563eb;
}

/* Mobile Toggle Button */
.mobile-toggle {
    display: none;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(59, 130, 246, 0.2);
    cursor: pointer;
    padding: 0.75rem;
    border-radius: 0.75rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1001;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

/* Ensure mobile toggle is hidden on desktop */
@media (min-width: 769px) {
    .mobile-toggle {
        display: none !important;
    }
}


.mobile-toggle:active {
    transform: scale(0.98);
}

.hamburger-container {
    width: 28px;
    height: 20px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.hamburger-line {
    width: 100%;
    height: 3px;
    background: #374151;
    border-radius: 3px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: center;
}

.hamburger-line-1 {
    transform-origin: top left;
}

.hamburger-line-3 {
    transform-origin: bottom left;
}

.menu-text {
    font-size: 0.8rem;
    font-weight: 600;
    color: #374151;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Hamburger Animation States - Clean X Design */
.mobile-toggle.active .hamburger-line-1 {
    transform: rotate(45deg) translate(6px, 6px);
    background: #000000ff;
    width: 85%;
}

.mobile-toggle.active .hamburger-line-2 {
    opacity: 0;
    transform: scaleX(0);
}

.mobile-toggle.active .hamburger-line-3 {
    transform: rotate(-45deg) translate(6px, -6px);
    background: #050000ff;
    width: 85%;
}

.mobile-toggle.active .menu-text {
    color: #ef4444;
    transform: scale(0.9);
}
z
/* Mobile Overlay */
.mobile-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 999;
    backdrop-filter: blur(4px);
}

.mobile-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .nav-container {
        max-width: none;
        margin: 0;
        padding: 0 0.75rem;
        justify-content: space-between;
        gap: 1rem;
        width: 100%;
    }

    .nav-brand {
        flex: 0 0 auto;
        margin-right: 0;
    }

    .nav-brand .brand-link {
        font-size: 1.1rem;
    }

    .mobile-toggle {
        display: flex;
        flex: 0 0 auto;
        padding: 0.6rem;
        border-radius: 0.6rem;
        min-width: 60px;
        min-height: 60px;
    }

    .mobile-toggle .hamburger-container {
        width: 26px;
        height: 18px;
    }

    .mobile-toggle .hamburger-line {
        height: 2px;
    }

    .mobile-toggle .menu-text {
        font-size: 0.7rem;
        letter-spacing: 0.3px;
    }

    .nav-menu {
        position: fixed;
        top: 70px;
        left: 0;
        width: 100%;
        height: calc(100vh - 70px);
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        flex-direction: column;
        align-items: stretch;
        gap: 0;
        padding: 2rem 1rem;
        transform: translateX(-100%);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1000;
        overflow-y: auto;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .nav-menu.active {
        transform: translateX(0);
    }

    .nav-links {
        flex-direction: column;
        align-items: stretch;
        gap: 0.75rem;
        width: 100%;
    }

    .nav-item {
        width: 100%;
        border-radius: 0.75rem;
        overflow: hidden;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }

    .nav-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        padding: 1.25rem 1.5rem;
        border-radius: 0;
        border-bottom: none;
        justify-content: space-between;
        font-weight: 600;
        color: #374151;
        position: relative;
        background: white;
    }

    .nav-link.active {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: #3b82f6;
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .nav-link:hover::before,
    .nav-link.active::before {
        transform: scaleY(1);
    }

    .nav-menu .dropdown-menu {
        position: static;
        box-shadow: none;
        border: none;
        border-radius: 0;
        background: #f1f5f9;
        margin: 0;
        opacity: 1;
        visibility: visible;
        transform: none;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-menu .dropdown.active .dropdown-menu {
        max-height: 300px;
    }

    .dropdown-item {
        padding: 1rem 2rem;
        color: #64748b;
        font-weight: 500;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: white;
        color: #3b82f6;
        padding-left: 2.5rem;
    }

    .nav-auth {
        width: 100%;
        flex-direction: column;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #e2e8f0;
    }

    .user-menu .dropdown-menu {
        position: static;
        margin: 0;
        background: #f8fafc;
    }

    .auth-buttons {
        width: 100%;
        flex-direction: column;
        gap: 1rem;
    }

    .btn {
        width: 100%;
        text-align: center;
        padding: 1rem 1.5rem;
        font-weight: 600;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

                .nav-menu .nav-icon {
                    width: 24px;
                    height: 24px;
                    flex-shrink: 0;
                }

                .nav-menu .dropdown-icon-item {
                    width: 18px;
                    height: 18px;
                    opacity: 0.8;
                }

                .nav-menu .dropdown-item:hover .dropdown-icon-item {
                    opacity: 1;
                    transform: scale(1.1);
                }
            }

            /* Touch Optimization */
            @media (max-width: 768px) {
                /* Increase touch targets for better mobile interaction */
                .nav-link {
                    min-height: 48px; /* Minimum touch target size */
                    padding: 1.25rem 1.5rem;
                    -webkit-tap-highlight-color: transparent;
                    touch-action: manipulation;
                }

                .dropdown-item {
                    min-height: 44px; /* Minimum touch target size */
                    padding: 0.875rem 1rem;
                    -webkit-tap-highlight-color: transparent;
                    touch-action: manipulation;
                }

                .mobile-toggle {
                    min-width: 48px;
                    min-height: 48px;
                    -webkit-tap-highlight-color: transparent;
                    touch-action: manipulation;
                }

                .btn {
                    min-height: 48px;
                    -webkit-tap-highlight-color: transparent;
                    touch-action: manipulation;
                }

                /* Improve scrolling on mobile */
                .mobile-overlay {
                    -webkit-overflow-scrolling: touch;
                    overscroll-behavior: contain;
                }

                .nav-menu {
                    -webkit-overflow-scrolling: touch;
                    overscroll-behavior: contain;
                }

                /* Add visual feedback for touch interactions */
                .nav-link:active {
                    transform: scale(0.98);
                    background: rgba(255, 255, 255, 0.3);
                }

                .dropdown-item:active {
                    transform: scale(0.98) translateX(8px);
                    background: rgba(255, 255, 255, 0.2);
                }

                .mobile-toggle:active {
                    transform: scale(0.95);
                }

                .btn:active {
                    transform: scale(0.98) translateY(-1px);
                }

                /* Prevent text selection on touch */
                .nav-link,
                .dropdown-item,
                .mobile-toggle,
                .btn {
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                }
            }
    }

    .btn-outline:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border: none;
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .mobile-toggle {
        display: flex;
    }

    /* Add subtle animations for menu items */
    .nav-menu.active .nav-item {
        animation: slideInUp 0.4s ease forwards;
    }

    .nav-menu.active .nav-item:nth-child(1) { animation-delay: 0.1s; }
    .nav-menu.active .nav-item:nth-child(2) { animation-delay: 0.15s; }
    .nav-menu.active .nav-item:nth-child(3) { animation-delay: 0.2s; }
    .nav-menu.active .nav-item:nth-child(4) { animation-delay: 0.25s; }
    .nav-menu.active .nav-item:nth-child(5) { animation-delay: 0.3s; }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 480px) {
    .nav-container {
        padding: 0 0.75rem;
    }

    .brand-text {
        font-size: 1.1rem;
    }

    .nav-menu {
        padding: 1.5rem 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Find all dropdown elements
    const dropdowns = document.querySelectorAll('.dropdown');
    const userMenus = document.querySelectorAll('.user-menu');
    const toggles = document.querySelectorAll('.dropdown-toggle');
    const menus = document.querySelectorAll('.dropdown-menu');
    
    // If no elements found, try alternative selectors
    if (dropdowns.length === 0) {
        const userMenuAlternative = document.querySelector('.user-menu');
        const dropdownToggleAlternative = document.querySelector('.user-toggle');
        const dropdownMenuAlternative = document.querySelector('.user-menu .dropdown-menu');
        
        // If we found the user menu elements, set up the click handler
        if (userMenuAlternative && dropdownToggleAlternative && dropdownMenuAlternative) {
            dropdownToggleAlternative.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isActive = userMenuAlternative.classList.contains('active');
                
                // Close all other dropdowns first
                document.querySelectorAll('.dropdown.active, .user-menu.active').forEach(dropdown => {
                    if (dropdown !== userMenuAlternative) {
                        dropdown.classList.remove('active');
                        const menu = dropdown.querySelector('.dropdown-menu');
                        if (menu) {
                            menu.style.maxHeight = '0';
                        }
                    }
                });
                
                // Toggle current dropdown
                if (isActive) {
                    userMenuAlternative.classList.remove('active');
                    dropdownMenuAlternative.style.maxHeight = '0';
                } else {
                    userMenuAlternative.classList.add('active');
                    dropdownMenuAlternative.style.maxHeight = dropdownMenuAlternative.scrollHeight + 'px';
                }
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!userMenuAlternative.contains(e.target)) {
                    userMenuAlternative.classList.remove('active');
                    dropdownMenuAlternative.style.maxHeight = '0';
                }
            });
        }
    }
    
    // Mobile menu toggle with enhanced animations
    const mobileToggle = document.querySelector('.mobile-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const mobileOverlay = document.querySelector('.mobile-overlay');
    const navItems = document.querySelectorAll('.nav-item');

    function toggleMobileMenu() {
        const isActive = mobileToggle.classList.contains('active');
        
        if (!isActive) {
            // Opening menu
            mobileToggle.classList.add('active');
            navMenu.classList.add('active');
            mobileOverlay.classList.add('active');
            
            // Animate menu items with stagger effect
            navItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    item.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 50 + 100);
            });
        } else {
            // Closing menu
            navItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(-10px)';
                }, index * 30);
            });
            
            setTimeout(() => {
                mobileToggle.classList.remove('active');
                navMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
                
                // Reset item styles
                navItems.forEach(item => {
                    item.style.opacity = '';
                    item.style.transform = '';
                    item.style.transition = '';
                });
            }, 200);
        }
        
        // Update aria-expanded
        const isExpanded = !isActive;
        mobileToggle.setAttribute('aria-expanded', isExpanded);
        
        // Prevent body scroll when menu is open
        document.body.style.overflow = isExpanded ? 'hidden' : '';
    }

    mobileToggle.addEventListener('click', toggleMobileMenu);
    mobileOverlay.addEventListener('click', toggleMobileMenu);

    // Enhanced dropdown functionality with smooth animations
    const allDropdowns = document.querySelectorAll('.dropdown');
    
    allDropdowns.forEach((dropdown, index) => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        if (!toggle || !menu) {
            return;
        }
        
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Close other dropdowns with animation
            allDropdowns.forEach(otherDropdown => {
                if (otherDropdown !== dropdown && otherDropdown.classList.contains('active')) {
                    const otherMenu = otherDropdown.querySelector('.dropdown-menu');
                    otherMenu.style.maxHeight = '0';
                    setTimeout(() => {
                        otherDropdown.classList.remove('active');
                        otherDropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
                    }, 200);
                }
            });
            
            // Toggle current dropdown with smooth animation
            const isActive = dropdown.classList.contains('active');
            
            if (!isActive) {
                dropdown.classList.add('active');
                toggle.setAttribute('aria-expanded', 'true');
                
                // Animate dropdown opening
                menu.style.display = 'block'; // Ensure menu is visible for measurement
                menu.style.maxHeight = 'none'; // Remove any max-height restriction first
                menu.style.overflow = 'visible'; // Allow content to be measured
                const scrollHeight = menu.scrollHeight;
                
                // Reset for animation
                menu.style.maxHeight = '0';
                menu.style.overflow = 'hidden';
                
                // Force reflow and then animate
                requestAnimationFrame(() => {
                    menu.style.maxHeight = scrollHeight + 'px';
                });
                
                // Add ripple effect to toggle button
                createRipple(toggle, e);
            } else {
                menu.style.maxHeight = '0';
                setTimeout(() => {
                    dropdown.classList.remove('active');
                    toggle.setAttribute('aria-expanded', 'false');
                }, 200);
            }
        });
    });

    // Ripple effect function for better touch feedback
    function createRipple(element, event) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
            z-index: 1;
        `;
        
        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    // Add ripple animation keyframes
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            dropdowns.forEach(dropdown => {
                if (dropdown.classList.contains('active')) {
                    const menu = dropdown.querySelector('.dropdown-menu');
                    menu.style.maxHeight = '0';
                    setTimeout(() => {
                        dropdown.classList.remove('active');
                        dropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
                    }, 200);
                }
            });
        }
    });

    // Enhanced nav link interactions
    const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            if (window.innerWidth <= 768) {
                setTimeout(() => {
                    toggleMobileMenu();
                }, 200);
            }
        });
        
        // Add hover effects for better feedback
        link.addEventListener('mouseenter', function() {
            if (window.innerWidth > 768) {
                this.style.transform = 'translateY(-2px)';
            }
        });
        
        link.addEventListener('mouseleave', function() {
            if (window.innerWidth > 768) {
                this.style.transform = '';
            }
        });
    });

    // Handle window resize with smooth transitions
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            if (window.innerWidth > 768) {
                // Reset mobile menu state on desktop
                mobileToggle.classList.remove('active');
                navMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
                mobileToggle.setAttribute('aria-expanded', 'false');
                
                // Reset nav items
                navItems.forEach(item => {
                    item.style.opacity = '';
                    item.style.transform = '';
                    item.style.transition = '';
                });
            }
        }, 100);
    });

    // Smooth scroll for anchor links with offset for fixed navbar
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - 80; // Account for navbar height
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add scroll-based navbar effects
    let lastScrollY = window.scrollY;
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        const currentScrollY = window.scrollY;
        
        if (currentScrollY > 100) {
            navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            navbar.style.boxShadow = '';
        }
        
        lastScrollY = currentScrollY;
    });
});
</script>