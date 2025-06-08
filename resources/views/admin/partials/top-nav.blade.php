<header class="top-nav">
    <div class="nav-left">
        <button class="menu-toggle" id="menuToggle">
            <i class="bi bi-list"></i>
        </button>
        <div class="search-container">
            <!--<h1 class="page-title">
                {{ isset($searchQuery) && $searchQuery ? 'Search Results for "' . e($searchQuery) . '"' : 'Market Items' }}
            </h1>-->
            <form action="{{ route('admin.search') }}" method="GET">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="query" class="search-input" placeholder="Search tools..."
                    value="{{ request('query') }}">
                <button type="submit" style="display: none;">Search</button>
            </form>
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
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                <div class="user-info">
                    <h4>{{ auth()->user()->name }}</h4>
                    <p>Admin</p>
                </div>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>
            <div class="user-dropdown">
                <a href="{{ route('admin.admin-profile') }}" class="dropdown-item">
                    <i class="bi bi-person"></i> Profile
                </a>
                <a href="{{ route('admin.system-settings') }}" class="dropdown-item">
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
