<!-- Sidebar Toggle Button -->
<button class="sidebar-toggle d-none d-lg-flex" id="sidebarToggle">
    <i class="fa-solid fa-bars-staggered" id="sidebarToggleIcon"></i>
</button>
    
<!-- Mobile Sidebar Toggle Button -->
<button class="mobile-sidebar-toggle d-lg-none" id="mobileSidebarToggle">
    <i class="fa-solid fa-bars-staggered"></i>
</button>
<div class="sidebar">
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

    <div class="sidebar-content">
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" id="sidebarSearchBtn" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fas fa-search sidebar-icon"></i>
                    <span class="sidebar-text">Search</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt sidebar-icon"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('personnel.index') }}" 
                   class="sidebar-link {{ request()->routeIs('personnel.*') ? 'active' : '' }}">
                    <i class="fas fa-users sidebar-icon"></i>
                    <span class="sidebar-text">Personnel</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.applications.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt sidebar-icon"></i>
                    <span class="sidebar-text">Applications</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('contacts.index') }}" 
                   class="sidebar-link {{ request()->routeIs('contacts.*') ? 'active' : '' }}">
                    <i class="fas fa-address-book sidebar-icon"></i>
                    <span class="sidebar-text">Contacts</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.messages.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <i class="fas fa-comments sidebar-icon"></i>
                    <span class="sidebar-text">Messages</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('settings') }}" class="sidebar-link {{ request()->routeIs('settings*') ? 'active' : '' }}">
                    <i class="fas fa-cog sidebar-icon"></i>
                    <span class="sidebar-text">Settings</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('home') }}" 
                   class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home sidebar-icon"></i>
                    <span class="sidebar-text">Home</span>
                </a>
            </li>
            <li class="sidebar-item">
                <div class="user-dropdown-container">
                    <div class="d-flex align-items-center text-white text-decoration-none user-dropdown" 
                        id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-circle">
                            <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <small class="user-role">Web Designer</small>
                        </div>
                        <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>