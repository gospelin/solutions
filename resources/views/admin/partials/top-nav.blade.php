<header class="top-nav">
    <div class="nav-left">
        <button class="menu-toggle" id="menuToggle">
            <i class="bi bi-list"></i>
        </button>
        <div class="search-container">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search users, tools, or reports...">
        </div>
    </div>
    <div class="nav-right">
        <div class="nav-actions">
            <button class="action-btn" title="Notifications">
                <i class="bi bi-bell"></i>
                <span class="badge">4</span>
            </button>
            <button class="action-btn" title="Messages">
                <i class="bi bi-chat-dots"></i>
                <span class="badge">2</span>
            </button>
        </div>
        <div class="user-menu" id="userMenu">
            <div class="user-trigger">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                <div class="user-info">
                    <h4>{{ Auth::user()->name }}</h4>
                    <p>Admin</p>
                </div>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>
            <div class="user-dropdown">
                <a href="{{ route('admin.profile') }}" class="dropdown-item">
                    <i class="bi bi-person"></i> Profile
                </a>
                <a href="{{ route('admin.settings') }}" class="dropdown-item">
                    <i class="bi bi-gear"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>