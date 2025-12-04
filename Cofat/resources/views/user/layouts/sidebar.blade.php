<div class="sidebar">
    <div class="sidebar-content">
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('user.dashboard') }}" class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt sidebar-icon"></i>
                    <span class="sidebar-text">Dashboard</span>
                    <span class="sidebar-tooltip">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('user.messages') }}" class="sidebar-link {{ request()->routeIs('user.messages*') ? 'active' : '' }}">
                    <i class="fas fa-envelope sidebar-icon"></i> <!-- Changed icon to match messages -->
                    <span class="sidebar-text">Messages</span>
                    <span class="sidebar-tooltip">User Messages</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('settings') }}" class="sidebar-link">
                    <i class="fas fa-cog sidebar-icon"></i>
                    <span class="sidebar-text">Settings</span>
                    <span class="sidebar-tooltip">Settings</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/" class="sidebar-link">
                    <i class="fas fa-home sidebar-icon"></i>
                    <span class="sidebar-text">Home</span>
                    <span class="sidebar-tooltip">Home</span>
                </a>
            </li>
            <li class="sidebar-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="sidebar-link logout-link">
                        <i class="fas fa-sign-out-alt sidebar-icon"></i>
                        <span class="sidebar-text">Logout</span>
                        <span class="sidebar-tooltip">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>