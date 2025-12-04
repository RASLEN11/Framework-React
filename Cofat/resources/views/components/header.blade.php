<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COFAT Kairouan</title>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <header class="site-header">
        <div class="header-container">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="brand-logo">
                <img src="{{ asset('images/LogoCofat.png') }}" alt="COFAT Logo" class="logo-img">
                <div class="brand-text">
                    <span class="brand-main">COFAT</span>
                    <span class="brand-sub">KAIRIOUAN</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="main-nav">
                <ul class="nav-list">
                    @foreach([
                        ['route' => 'home', 'icon' => 'fa-home', 'text' => 'Home'],
                        ['route' => 'about', 'icon' => 'fa-info-circle', 'text' => 'About Us'],
                        ['route' => 'apply.index', 'icon' => 'fa-clipboard-list', 'text' => 'Job Apply'],
                        ['route' => 'contact', 'icon' => 'fa-envelope', 'text' => 'Contact Us'],
                        ['route' => 'Stats', 'icon' => 'fa-solid fa-gauge', 'text' => 'Stats']
                    ] as $link)
                        <li class="nav-item">
                            <a href="{{ route($link['route']) }}"
                               class="nav-link {{ request()->routeIs($link['route']) ? 'active' : '' }}">
                                <i class="fas {{ $link['icon'] }} nav-icon"></i>
                                <span class="nav-text">{{ $link['text'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <!-- Auth Buttons and Search -->
            <div class="auth-section">
                <!-- Search Button -->
                <button class="auth-btn search-btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fas fa-search me-2"></i>
                    <span>Search</span>
                </button>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="auth-btn dashboard-btn">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            <span>Admin Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="auth-btn dashboard-btn">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            <span>My Dashboard</span>
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="auth-btn logout-btn">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="#" class="auth-btn register-btn" data-bs-toggle="modal" data-bs-target="#registerModal">
                        <i class="fas fa-user-plus me-2"></i>
                        <span>Register</span>
                    </a>
                    <a href="#" class="auth-btn login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <span>Login</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-nav">
            <ul class="mobile-nav-list">
                @foreach([
                    ['route' => 'home', 'icon' => 'fa-home', 'text' => 'Home'],
                    ['route' => 'about', 'icon' => 'fa-info-circle', 'text' => 'About Us'],
                    ['route' => 'apply.index', 'icon' => 'fa-clipboard-list', 'text' => 'Job Apply'],
                    ['route' => 'contact', 'icon' => 'fa-envelope', 'text' => 'Contact Us'],
                    ['route' => 'Stats', 'icon' => 'fa-tachometer-alt', 'text' => 'Stats']
                ] as $link)
                    <li class="mobile-nav-item">
                        <a href="{{ route($link['route']) }}" class="mobile-nav-link">
                            <i class="fas {{ $link['icon'] }}"></i>
                            <span>{{ $link['text'] }}</span>
                        </a>
                    </li>
                @endforeach
                
                <!-- Mobile Search -->
                <li class="mobile-nav-item">
                    <a href="#" class="mobile-nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </a>
                </li>
                
                @auth
                    <li class="mobile-nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="mobile-logout-form">
                            @csrf
                            <button type="submit" class="mobile-nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                @else
                    <li class="mobile-nav-item">
                        <a href="#" class="mobile-nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login</span>
                        </a>
                    </li>
                    <li class="mobile-nav-item">
                        <a href="#" class="mobile-nav-link" data-bs-toggle="modal" data-bs-target="#registerModal">
                            <i class="fas fa-user-plus"></i>
                            <span>Register</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </header>

    <!-- Include all modals -->
    @include('auth.login') <!-- Login Modal -->
    @include('auth.register') <!-- Register Modal -->
    @include('components.search') <!-- Search Modal -->

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileToggle = document.querySelector('.mobile-menu-toggle');
            const mobileNav = document.querySelector('.mobile-nav');
            
            if (mobileToggle && mobileNav) {
                mobileToggle.addEventListener('click', function() {
                    this.classList.toggle('active');
                    mobileNav.classList.toggle('active');
                });
            }
            
            // Close mobile menu when clicking on a link
            const mobileLinks = document.querySelectorAll('.mobile-nav-link');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (mobileToggle) mobileToggle.classList.remove('active');
                    if (mobileNav) mobileNav.classList.remove('active');
                });
            });

            // Header scroll effect
            const header = document.querySelector('.site-header');
            if (header) {
                let lastScroll = 0;
                window.addEventListener('scroll', function() {
                    const currentScroll = window.pageYOffset;
                    if (currentScroll <= 0) {
                        header.style.transform = 'translateY(0)';
                        return;
                    }
                    
                    if (currentScroll > lastScroll && currentScroll > 100) {
                        // Scrolling down
                        header.style.transform = 'translateY(-100%)';
                    } else {
                        // Scrolling up
                        header.style.transform = 'translateY(0)';
                    }
                    lastScroll = currentScroll;
                });
            }
        });
    </script>
</body>
</html>