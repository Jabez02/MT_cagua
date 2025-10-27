<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <x-application-logo class="img-fluid" style="max-height: 36px;" />
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-2"></i>{{ __('Home') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ url('/services') }}">
                        <i class="bi bi-gear me-2"></i>{{ __('Services') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ url('/about') }}">
                        <i class="bi bi-info-circle me-2"></i>{{ __('About Us') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact-us') ? 'active' : '' }}" href="{{ url('/contact-us') }}">
                        <i class="bi bi-envelope me-2"></i>{{ __('Contact Us') }}
                    </a>
                </li>
            </ul>

            <!-- Settings Links -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Auth::user()->usertype == 'admin' ? request()->routeIs('admin.dashboard') ? 'active' : '' : request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ Auth::user()->usertype == 'admin' ? url('admin/dashboard') : url('dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i>{{ __('Dashboard') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ url('login') }}">
                            <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Login') }}
                        </a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ url('register') }}">
                                <i class="bi bi-person-plus me-2"></i>{{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
