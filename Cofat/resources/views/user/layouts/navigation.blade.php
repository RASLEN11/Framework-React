<nav class="monochrome-navbar navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <div class="brand-logo-container">
            <a class="navbar-brand brand-logo" href="{{ route('user.dashboard') }}">
                <img src="{{ asset('images/LogoCofat.png') }}" alt="COFAT Logo" class="logo-img">
                <div class="brand-text">
                    <span class="brand-main">COFAT</span>
                    <span class="brand-sub">USER</span>
                </div>
            </a>
        </div>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="me-auto"></div>
            
            <!-- User Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none user-dropdown" 
                   id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-circle me-2">
                        <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <span class="fw-medium d-none d-lg-inline">Bonjour, {{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navbar Styles */
    .monochrome-navbar {
        background: linear-gradient(135deg, #212529 0%, #343a40 100%);
        padding: 0 2rem;
        height: var(--navbar-height);
        min-height: var(--navbar-height);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        z-index: 1030;
    }

    .monochrome-navbar::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset("images/wire-pattern.png") }}') center/cover;
        opacity: 0.05;
        z-index: -1;
    }

    /* Brand Logo Container */
    .brand-logo-container {
        position: fixed;
        left: 2rem;
        top: 0;
        height: var(--navbar-height);
        display: flex;
        align-items: center;
        z-index: 1031;
    }

    /* Brand Logo */
    .navbar-brand.brand-logo {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0;
        margin: 0;
    }

    .logo-img {
        width: 32px;
        height: 32px;
        filter: brightness(0) invert(1);
        transition: transform 0.3s ease;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
    }

    .brand-main {
        font-size: 1.2rem;
        font-weight: 700;
        color: white;
        text-transform: uppercase;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.5px;
    }

    .brand-sub {
        font-size: 0.65rem;
        font-weight: 500;
        color: #adb5bd;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* User Dropdown */
    .user-dropdown {
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .user-dropdown:hover {
        opacity: 0.8;
    }

    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1rem;
    }

    /* Mobile Menu */
    .mobile-menu-toggle {
        border: none;
        padding: 0.5rem;
        background: transparent;
        margin-left: auto;
    }

    .hamburger {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        width: 24px;
    }

    .hamburger span {
        display: block;
        width: 100%;
        height: 2px;
        background: white;
        transition: all 0.3s ease;
        transform-origin: center;
    }

    .navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    .navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(2) {
        opacity: 0;
    }

    .navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .monochrome-navbar {
            padding: 0 1.5rem;
        }
        
        .brand-logo-container {
            left: 1.5rem;
        }
        
        .navbar-collapse {
            position: absolute;
            top: var(--navbar-height);
            right: 1rem;
            width: 280px;
            background: linear-gradient(135deg, #343a40 0%, #212529 100%);
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 1020;
        }
    }

    @media (max-width: 576px) {
        .monochrome-navbar {
            padding: 0 1rem;
        }
        
        .brand-logo-container {
            left: 1rem;
        }
        
        .brand-main {
            font-size: 1.1rem;
        }
        
        .brand-sub {
            font-size: 0.6rem;
        }
    }
</style>