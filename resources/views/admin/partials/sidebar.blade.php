<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">M</div>
        <div class="brand-text">
            <h1>Mr Solution</h1>
            <p>Admin Control</p>
        </div>
    </div>
    <nav class="nav-section">
        <div class="nav-section-title">Admin</div>
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid nav-icon"></i> Dashboard
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.user-management') }}" class="nav-link {{ request()->routeIs('admin.user-management') ? 'active' : '' }}">
                <i class="bi bi-people nav-icon"></i> User Management
                <span class="nav-badge">New</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.tool-moderation') }}" class="nav-link {{ request()->routeIs('admin.tool-moderation') ? 'active' : '' }}">
                <i class="bi bi-tools nav-icon"></i> Tool Moderation
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.reports') }}" class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                <i class="bi bi-bar-chart nav-icon"></i> Reports
            </a>
        </div>
    </nav>
    <nav class="nav-section">
        <div class="nav-section-title">Settings</div>
        <div class="nav-item">
            <a href="{{ route('admin.system-settings') }}" class="nav-link {{ request()->routeIs('admin.system-settings') ? 'active' : '' }}">
                <i class="bi bi-gear nav-icon"></i> System Settings
            </a>
        </div>
        <div class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link">
                    <i class="bi bi-box-arrow-right nav-icon"></i> Logout
                </button>
            </form>
        </div>
    </nav>
</aside>