<nav class="monochrome-navbar navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <div class="brand-logo-container">
            <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/LogoCofat.png') }}" alt="COFAT Logo" class="logo-img">
                <div class="brand-text">
                    <span class="brand-main">COFAT</span>
                    <span class="brand-sub">ADMIN</span>
                </div>
            </a>
        </div>

        <button class="navbar-toggler mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="me-auto"></div>
            
            <!-- Search Zone -->
            <div class="d-flex align-items-center me-3 search-zone">
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control search-input" 
                               placeholder="Search..." required>
                    </div>
                </form>
            </div>
            
            <!-- Applications Notifications -->
            <div class="d-flex align-items-center">
                <!-- Job Applications Notification -->
                <div class="notification-icon me-3 position-relative">
                    <a href="{{ route('admin.applications.index') }}" class="text-white" title="Pending Job Applications">
                        <i class="fas fa-briefcase fa-lg"></i>
                        @php $pendingJobs = App\Models\JobApplication::where('status', 'pending')->count(); @endphp
                        @if($pendingJobs > 0)
                            <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                {{ $pendingJobs }}
                            </span>
                        @else
                            <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $pendingJobs }}
                            </span>
                        @endif
                    </a>
                </div>
                
                <!-- Internship Applications Notification -->
                <div class="notification-icon me-3 position-relative">
                    <a href="{{ route('admin.applications.index') }}" class="text-white" title="Pending Internship Applications">
                        <i class="fas fa-user-graduate fa-lg"></i>
                        @php $pendingInternships = App\Models\InternshipApplication::where('status', 'pending')->count(); @endphp
                        @if($pendingInternships > 0)
                            <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                                {{ $pendingInternships }}
                            </span>
                        @else
                            <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $pendingInternships }}
                            </span>
                        @endif
                    </a>
                </div>
                
                @php
                    use App\Models\Message;
                    $unrepliedCount = Message::where('is_replied', false)->count();
                @endphp

                <!-- Message Notification -->
                <div class="notification-icon me-3 position-relative">
                    <a href="{{ route('admin.messages') }}" class="text-white">
                        <i class="fas fa-envelope fa-lg"></i>
                        @if($unrepliedCount > 0)
                            <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                {{ $unrepliedCount }}
                            </span>
                        @else
                            <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $unrepliedCount }}
                            </span>
                        @endif
                    </a>
                </div>

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
    </div>
</nav>

<style>
    /* Navbar Styles */
    :root {
        --navbar-height: 60px;
    }
    
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

    /* Notification Styles */
    .notification-icon {
        padding: 0.5rem;
        position: relative;
        display: flex;
        align-items: center;
    }

    .notification-icon a {
        display: flex;
        align-items: center;
        position: relative;
    }

    .notification-badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.4rem;
        min-width: 18px;
    }

    /* Search Zone Styles */
    .search-zone {
        width: 300px;
        margin-right: 1rem;
    }

    .search-form {
        width: 100%;
    }

    .search-input {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 20px 0 0 20px !important;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-input:focus {
        background-color: rgba(255, 255, 255, 0.15);
        color: white;
        box-shadow: none;
        border-color: rgba(255, 255, 255, 0.3);
    }

    .search-submit {
        border-radius: 0 20px 20px 0 !important;
        border-left: none;
    }

    /* Dropdown Menu Styles */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        border-radius: 8px;
        padding: 0.5rem 0;
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
    }
    
    .dropdown-item {
        padding: 0.5rem 1.5rem;
        transition: all 0.2s ease;
        color: white;
    }
    
    .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .dropdown-divider {
        border-color: rgba(255, 255, 255, 0.1);
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .monochrome-navbar {
            padding: 0 1.5rem;
        }
        
        .brand-logo-container {
            left: 1.5rem;
        }
        
        .search-zone {
            width: 100%;
            margin: 1rem 0;
            order: -1;
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
        
        .notification-icon {
            margin-right: 1rem;
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Notification update function
    function updateNotificationCount() {
        fetch('{{ route("admin.messages.unreplied") }}')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const badge = document.querySelector('.message-notification .notification-badge');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = 'block';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching notification count:', error);
            });
    }
    
    // Update notifications periodically (optional)
    setInterval(updateNotificationCount, 60000); // Update every minute
});
</script>