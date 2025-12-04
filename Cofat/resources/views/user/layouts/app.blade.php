<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COFAT')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ========== GLOBAL STYLES ========== */
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --transition-time: 0.3s;
            --navbar-height: 60px;
            --sidebar-bg: #212529;
            --sidebar-active-bg: #343a40;
            --sidebar-hover-bg: rgba(255, 255, 255, 0.1);
            --sidebar-text-color: #e9ecef;
            --sidebar-icon-color:rgb(255, 255, 255);
            --logout-color: #ff6b6b;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            padding-top: var(--navbar-height);
            transition: margin-left var(--transition-time);
            overflow-x: hidden;
        }
        
        .main-content {
            transition: margin-left var(--transition-time);
            padding: 20px;
            margin-left: var(--sidebar-width);
            min-height: calc(100vh - var(--navbar-height));
        }
        
        /* ========== SIDEBAR STYLES ========== */
        .sidebar {
            width: var(--sidebar-width);
            height: calc(100vh - var(--navbar-height));
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            background: linear-gradient(135deg, #212529 0%, #343a40 100%);
            color: var(--sidebar-text-color);
            transition: all var(--transition-time);
            overflow-x: hidden;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
        }
        
        /* Sidebar Content */
        .sidebar-content {
            padding: 20px 0;
            flex-grow: 1;
        }
        
        .sidebar-footer {
            padding: 15px 0;
            border-top: 2px solid rgba(255, 255, 255, 0.15);
            margin-top: auto;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 0 0 0 8px;
        }
        
        /* Navigation Links */
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-item {
            position: relative;
            margin-bottom: 2px;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--sidebar-text-color);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .sidebar-link:hover {
            background-color: var(--sidebar-hover-bg);
            color: white;
        }
        
        .sidebar-link.active {
            background-color: var(--sidebar-active-bg);
            border-left-color: white;
            font-weight: 600;
        }
        
        /* Logout Button */
        .logout-link {
            color: var(--logout-color) !important;
            border: 1px solid var(--logout-color);
            border-radius: 5px;
            margin: 5px 10px;
            padding: 10px 15px !important;
            background-color: rgba(255, 107, 107, 0.1) !important;
            transition: all 0.3s ease;
        }
        
        .logout-link:hover {
            background-color: rgba(255, 107, 107, 0.2) !important;
            transform: translateY(-1px);
        }
        
        .logout-link .sidebar-icon {
            color: inherit !important;
        }
        
        /* Icons and Text */
        .sidebar-icon {
            width: 24px;
            text-align: center;
            margin-right: 15px;
            font-size: 1.1rem;
            color: var(--sidebar-icon-color);
            transition: all var(--transition-time);
        }
        
        .sidebar-text {
            transition: opacity var(--transition-time);
            white-space: nowrap;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        /* ========== SIDEBAR TOGGLE BUTTON ========== */
        .sidebar-toggle {
            position: fixed;
            left: calc(var(--sidebar-width) - 18px); /* Center on the edge */
            top: calc(var(--navbar-height) + 20px);
            z-index: 1100;
            background-color: white;
            border: none;
            color: #212529;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-time);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transform: translateX(0);
        }
        
        .sidebar-toggle:hover {
            background-color: #f8f9fa;
            transform: scale(1.1) translateX(0);
        }
        
        body.sidebar-collapsed .sidebar-toggle {
            left: calc(var(--sidebar-collapsed-width) - 18px);
        }
        
        /* Collapsed State */
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }
        
        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        body.sidebar-collapsed .sidebar-text,
        body.sidebar-collapsed .sidebar-tooltip {
            opacity: 0;
            width: 0;
            display: none;
        }
        
        body.sidebar-collapsed .sidebar-link {
            justify-content: center;
            padding: 12px 5px;
        }
        
        body.sidebar-collapsed .sidebar-icon {
            margin-right: 0;
            font-size: 1.3rem;
        }
        
        /* Tooltips */
        .sidebar-tooltip {
            position: absolute;
            left: calc(var(--sidebar-collapsed-width) + 10px);
            background-color: var(--sidebar-active-bg);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s;
            z-index: 1200;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        
        body.sidebar-collapsed .sidebar-item:hover .sidebar-tooltip {
            opacity: 1;
        }
        
        /* ========== LOADING SPINNER ========== */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        
        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .loading-spinner {
            width: 70px;
            height: 70px;
            position: relative;
        }
        
        .loading-spinner:before,
        .loading-spinner:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 5px solid transparent;
            border-top-color:rgb(0, 0, 0);
            animation: spin 1s linear infinite;
        }
        
        .loading-spinner:after {
            border-top-color:rgb(0, 0, 0);
            animation: spin 1.5s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* ========== MOBILE RESPONSIVENESS ========== */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1050;
            }
            
            body.sidebar-mobile-show .sidebar {
                transform: translateX(0);
            }
            
            .sidebar-toggle {
                display: none !important;
            }
            
            .main-content {
                margin-left: 0 !important;
            }
            
            .mobile-sidebar-toggle {
                display: flex !important;
                position: fixed;
                left: 15px;
                top: calc(var(--navbar-height) + 15px);
                z-index: 1100;
                background-color: var(--sidebar-active-bg);
                border: none;
                color: white;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }
        }
    </style>
</head>
<body>
    @include('user.layouts.navigation')
    
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle d-none d-lg-flex" id="sidebarToggle">
        <i class="fas fa-chevron-left" id="sidebarToggleIcon"></i>
    </button>
    
    @include('user.layouts.sidebar')
    
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Loading Spinner -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarToggleIcon = document.getElementById('sidebarToggleIcon');
            const body = document.body;
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                body.classList.toggle('sidebar-collapsed');
                
                // Change icon based on state
                if (body.classList.contains('sidebar-collapsed')) {
                    sidebarToggleIcon.classList.replace('fa-chevron-left', 'fa-chevron-right');
                } else {
                    sidebarToggleIcon.classList.replace('fa-chevron-right', 'fa-chevron-left');
                }
                
                // Save state in localStorage
                localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed'));
            });
            
            // Check saved state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                body.classList.add('sidebar-collapsed');
                sidebarToggleIcon.classList.replace('fa-chevron-left', 'fa-chevron-right');
            }
            
            // Mobile sidebar toggle
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            if (mobileSidebarToggle) {
                mobileSidebarToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    body.classList.toggle('sidebar-mobile-show');
                });
            }
            
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
            
            // Loading spinner functionality
            // Show spinner when links are clicked
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (link && !link.href.includes('#') && link.href !== 'javascript:void(0)') {
                    loadingOverlay.classList.add('active');
                }
            });
            
            // Show spinner on form submissions
            document.addEventListener('submit', function(e) {
                if (e.target.tagName === 'FORM') {
                    loadingOverlay.classList.add('active');
                }
            });
            
            // Hide spinner when page is loaded
            window.addEventListener('load', function() {
                loadingOverlay.classList.remove('active');
            });
            
            // Also hide spinner when AJAX requests complete (if you're using AJAX)
            document.addEventListener('ajaxComplete', function() {
                loadingOverlay.classList.remove('active');
            });
            
            // Fallback in case loading gets stuck
            setTimeout(function() {
                loadingOverlay.classList.remove('active');
            }, 10000); // 10 second timeout as fallback
        });
    </script>
    
    @yield('scripts')
</body>
</html>