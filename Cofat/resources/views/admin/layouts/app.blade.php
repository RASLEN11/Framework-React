<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COFAT Personnel Management')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
    :root {
        --sidebar-width: 250px;
        --sidebar-collapsed-width: 70px;
        --transition-time: 0.3s;
        --sidebar-bg: linear-gradient(135deg, #212529 0%, #343a40 100%);
        --sidebar-active-bg: rgba(255, 255, 255, 0.15);
        --sidebar-hover-bg: rgba(255, 255, 255, 0.1);
        --sidebar-text-color: #ecf0f1;
        --sidebar-icon-color: #ffffff;
        --logout-color: #e74c3c;
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --content-bg: #f8f9fa;
    }
    
    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--content-bg);
        min-height: 100vh;
        margin: 0;
        padding: 0;
        transition: margin-left var(--transition-time);
    }
    
    .main-content {
        transition: margin-left var(--transition-time);
        padding: 20px;
        margin-left: var(--sidebar-width);
        min-height: 100vh;
        background-color: var(--content-bg);
    }
    
    /* Loading Spinner */
    .loading-spinner {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
    
    .loading-spinner.active {
        display: block;
    }
    
    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        border-top-color: #000;
        animation: spin 1s ease-in-out infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* ========== SIDEBAR STYLES ========== */
    .sidebar {
        width: var(--sidebar-width);
        height: 99vh;
        position: fixed;
        top: 50%;
        left: 3px;
        transform: translateY(-50%);
        background: var(--sidebar-bg);
        color: var(--sidebar-text-color);
        transition: all var(--transition-time);
        overflow-x: hidden;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        border-radius: 10px;
    }
    
    .sidebar::before {
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
    
    /* Brand Logo Styles */
    .brand-logo-container {
        padding: 20px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .brand-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: var(--sidebar-text-color);
        transition: transform 0.3s ease;
    }
    
    .brand-logo:hover {
        transform: translateX(5px);
    }
    
    .logo-img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
        object-fit: contain;
        filter: brightness(0) invert(1);
        transition: transform 0.3s ease;
    }
    
    .brand-logo:hover .logo-img {
        transform: rotate(5deg);
    }
    
    .brand-text {
        display: flex;
        flex-direction: column;
        transition: opacity var(--transition-time);
        line-height: 1.1;
    }
    
    .brand-main {
        font-weight: 700;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .brand-sub {
        font-size: 0.7rem;
        font-weight: 500;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    
    /* Sidebar Content */
    .sidebar-content {
        padding: 20px 0;
        flex-grow: 1;
    }
    
    .sidebar-footer {
        padding: 10px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: auto;
    }
    
    .sidebar-footer .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-item {
        position: relative;
        margin-bottom: 5px;
    }
    
    .sidebar-footer .sidebar-item {
        margin-bottom: 0;
    }
    
    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: var(--sidebar-text-color);
        text-decoration: none;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin: 0 15px;
        border-radius: 10px;
    }
    
    .sidebar-footer .sidebar-link {
        margin: 0 10px;
        padding: 10px 15px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
    }
    
    .sidebar-link:hover {
        background: var(--sidebar-hover-bg);
        color: var(--sidebar-text-color);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-link.active {
        background: white;
        color: #000000;
        font-weight: 600;
        box-shadow: 0 5px 20px rgba(255, 255, 255, 0.2);
    }
    
    .sidebar-icon {
        width: 24px;
        text-align: center;
        margin-right: 15px;
        font-size: 1.1rem;
        color: var(--sidebar-icon-color);
        transition: all var(--transition-time);
    }
    
    .sidebar-link.active .sidebar-icon,
    .sidebar-link:hover .sidebar-icon {
        color: inherit;
    }
    
    .sidebar-text {
        transition: opacity var(--transition-time);
        font-weight: 500;
        white-space: nowrap;
        font-size: 0.9rem;
    }
    
    /* User Dropdown Styles */
    .user-dropdown-container {
        padding: 10px;
    }
    
    .user-dropdown {
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin: 0;
        position: relative;
    }
    
    .user-dropdown:hover {
        background: rgba(255, 255, 255, 0.15);
    }
    
    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000000;
        font-weight: bold;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .user-info {
        display: flex;
        flex-direction: column;
        margin-left: 10px;
        overflow: hidden;
        transition: all var(--transition-time);
    }
    
    .user-name {
        font-size: 0.85rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .user-role {
        font-size: 0.7rem;
        color: #adb5bd;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .logout-btn {
        margin-left: auto;
        background: rgba(231, 76, 60, 0.2);
        border: none;
        color: var(--logout-color);
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }
    
    .logout-btn:hover {
        background: rgba(231, 76, 60, 0.3);
    }
    
    .logout-btn i {
        margin-right: 5px;
    }
    
    /* Updated Notification Styles */
.notification-container {
    position: fixed;
    top: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    background: linear-gradient(135deg, #212529 0%, #343a40 100%);
    padding: 12px 20px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    z-index: 1050;
    border: 1px solid rgba(255, 255, 255, 0.1);
    width: 90%;
    max-width: 800px;
    color: #ecf0f1;
    backdrop-filter: blur(5px);
}

.notification-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('{{ asset("images/wire-pattern.png") }}') center/cover;
    opacity: 0.05;
    z-index: -1;
    border-radius: inherit;
}

.notification-icons {
    display: flex;
    gap: 20px;
    align-items: center;
}

.notification-icon {
    position: relative;
    transition: all 0.3s ease;
}

.notification-icon a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: rgb(255, 255, 255);
    border-radius: 8px;
    color: #ffffff;
    transition: all 0.3s ease;
}

.notification-icon a:hover {
    background: rgb(255, 255, 255);
    transform: translateY(-2px);
}

.notification-icon i {
    font-size: 1rem;
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    font-size: 0.6rem;
    padding: 3px 6px;
    border-radius: 50%;
    background-color: rgb(81, 220, 53);
    color: white;
    min-width: 18px;
    text-align: center;
    font-weight: bold;
}

.notification-badge.empty {
    background-color: #dc3545;
}

.notification-title {
    flex-grow: 1;
    text-align: center;
}

.notification-title .brand-main {
    font-weight: 700;
    font-size: 1.2rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #ffffff;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

.time-display {
    font-size: 0.875rem;
    font-weight: 500;
    color:rgb(255, 255, 255);
    padding-left: 15px;
    white-space: nowrap;
}

/* Mobile Styles */
@media (max-width: 992px) {
    .notification-container {
        top: 10px;
        left: 10px;
        right: 10px;
        transform: none;
        width: auto;
        padding: 10px 15px;
    }
    
    .notification-icons {
        gap: 15px;
    }
    
    .notification-icon a {
        width: 32px;
        height: 32px;
    }
    
    .time-display {
        display: none;
    }
}
    
    .time-display {
        font-size: 0.875rem;
        font-weight: 500;
        color:rgb(255, 255, 255);
        margin-left: auto;
        padding-left: 15px;
    }
    
    /* Collapsed State */
    body.sidebar-collapsed .sidebar {
        width: var(--sidebar-collapsed-width);
    }
    
    body.sidebar-collapsed .main-content {
        margin-left: var(--sidebar-collapsed-width);
    }
    
    body.sidebar-collapsed .sidebar-text,
    body.sidebar-collapsed .sidebar-tooltip,
    body.sidebar-collapsed .search-text,
    body.sidebar-collapsed .brand-text,
    body.sidebar-collapsed .user-info,
    body.sidebar-collapsed .logout-btn {
        opacity: 0;
        width: 0;
        display: none;
    }
    
    body.sidebar-collapsed .sidebar-link {
        justify-content: center;
        padding: 12px 5px;
        margin: 0 10px;
    }
    
    body.sidebar-collapsed .sidebar-icon {
        margin-right: 0;
        font-size: 1.3rem;
    }
    
    body.sidebar-collapsed .sidebar-item:hover .sidebar-tooltip {
        opacity: 1;
    }
    
    body.sidebar-collapsed .user-dropdown {
        justify-content: center;
        padding: 10px;
    }
    
    body.sidebar-collapsed .avatar-circle {
        margin: 0;
        width: 30px;
        height: 30px;
        font-size: 0.9rem;
    }
    
    /* Toggle Button */
    .sidebar-toggle {
        position: fixed;
        left: calc(var(--sidebar-width) - 220px);
        top: 65px;
        z-index: 1100;
        background-color: white;
        border: none;
        color: var(--secondary-color);
        width: 36px;
        height: 36px;
        border-radius: 20%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--transition-time);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    body.sidebar-collapsed .sidebar-toggle {
        left: calc(var(--sidebar-collapsed-width) - 50px);
    }
    
    /* Mobile Styles */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
            border-radius: 0;
            height: 100vh;
            top: 0;
            left: 0;
        }
        
        .sidebar-mobile-show .sidebar {
            transform: translateX(0);
        }
        
        .main-content {
            margin-left: 0 !important;
        }
        
        .sidebar-toggle {
            display: none;
        }
        
        .mobile-sidebar-toggle {
            display: flex !important;
            position: fixed;
            left: 15px;
            top: 15px;
            z-index: 1100;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .notification-container {
            top: 15px;
            right: 15px;
            padding: 8px 12px;
            gap: 10px;
        }
        
        .time-display {
            display: none;
        }
    }
    
    @media (min-width: 1200px) {
        .notification-container {
            right: 30px;
        }
    }
    </style>
</head>
<body>
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>
   

    
    <!-- Updated Notification Container -->
    <div class="notification-container">
        <!-- Left-aligned notification icons -->
        <div class="notification-icons">
            <div class="notification-icon">
                <a href="{{ route('admin.applications.index') }}" class="text-dark" title="Pending Job Applications">
                    <i class="fas fa-briefcase"></i>
                    @php $pendingJobs = App\Models\JobApplication::where('status', 'pending')->count(); @endphp
                    <span class="notification-badge {{ $pendingJobs === 0 ? 'empty' : '' }}">{{ $pendingJobs }}</span>
                </a>
            </div>
            
            <div class="notification-icon">
                <a href="{{ route('admin.applications.index') }}" class="text-dark" title="Pending Internship Applications">
                    <i class="fas fa-user-graduate"></i>
                    @php $pendingInternships = App\Models\InternshipApplication::where('status', 'pending')->count(); @endphp
                    <span class="notification-badge {{ $pendingInternships === 0 ? 'empty' : '' }}">{{ $pendingInternships }}</span>
                </a>
            </div>
            
            <div class="notification-icon">
                <a href="{{ route('admin.messages.index') }}" class="text-dark" title="Unreplied Messages">
                    <i class="fas fa-envelope"></i>
                    @php $unrepliedCount = App\Models\Message::where('is_replied', false)->count(); @endphp
                    <span class="notification-badge {{ $unrepliedCount === 0 ? 'empty' : '' }}">{{ $unrepliedCount }}</span>
                </a>
            </div>
        </div>

        <!-- Centered title -->
        <div class="notification-title">
            <span class="brand-main">COFAT KAIROUAN</span>
        </div>

        <!-- Right-aligned time display -->
        <div class="time-display" id="currentTime">
            {{ now()->format('d M Y, H:i:s') }}
        </div>
    </div>
    
    @include('admin.layouts.sidebar')
    @include('admin.layouts.search')
    
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarToggleIcon = document.getElementById('sidebarToggleIcon');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const body = document.body;
            const currentTimeElement = document.getElementById('currentTime');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            // Show loading spinner
            function showLoading() {
                loadingSpinner.classList.add('active');
            }
            
            // Hide loading spinner
            function hideLoading() {
                loadingSpinner.classList.remove('active');
            }
            
            // Update time every second
            function updateTime() {
                const now = new Date();
                const options = { 
                    day: '2-digit', 
                    month: 'short', 
                    year: 'numeric',
                    hour: '2-digit', 
                    minute: '2-digit', 
                    second: '2-digit',
                    hour12: false
                };
                currentTimeElement.textContent = now.toLocaleDateString('en-US', options);
            }
            
            // Initial time update
            updateTime();
            
            // Update time every second
            setInterval(updateTime, 1000);
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                body.classList.toggle('sidebar-collapsed');
                
                if (body.classList.contains('sidebar-collapsed')) {
                    sidebarToggleIcon.classList.replace('fa-bars-staggered', 'fa-chevron-right');
                } else {
                    sidebarToggleIcon.classList.replace('fa-chevron-right', 'fa-bars-staggered');
                }
                
                localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed'));
            });
            
            // Mobile sidebar toggle
            mobileSidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                body.classList.toggle('sidebar-mobile-show');
            });
            
            // Close sidebar when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.sidebar') && 
                    !event.target.closest('#sidebarToggle') && 
                    !event.target.closest('#mobileSidebarToggle')) {
                    
                    if (window.innerWidth <= 992 && body.classList.contains('sidebar-mobile-show')) {
                        body.classList.remove('sidebar-mobile-show');
                    }
                }
            });
            
            // Check saved state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                body.classList.add('sidebar-collapsed');
                sidebarToggleIcon.classList.replace('fa-bars-staggered', 'fa-chevron-right');
            }
            
            // Show loading spinner on page transitions
            document.querySelectorAll('a').forEach(link => {
                if (link.href && !link.href.startsWith('javascript:') && !link.href.startsWith('#')) {
                    link.addEventListener('click', showLoading);
                }
            });
            
            // Hide loading when page is fully loaded
            window.addEventListener('load', hideLoading);
        });
    </script>
    
    @yield('scripts')
</body>
</html>