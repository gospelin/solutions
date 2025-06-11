<header class="top-nav">
    <div class="nav-left">
        <button class="menu-toggle" id="menuToggle">
            <i class="bi bi-list"></i>
        </button>
        <div class="search-container">
            <form action="{{ route('admin.tools.search') }}" method="GET">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="search" class="search-input" value="{{ $searchQuery ?? '' }}"
                    placeholder="Search Tools...">
                <button type="submit" style="display: none;">Search</button>
            </form>
        </div>
    </div>
    <div class="nav-right">
        <div class="nav-actions">
            <div class="notification-container">
                <button class="action-btn" id="notificationToggle" title="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge"
                        id="notificationCount">{{ \App\Models\Notification::where('user_id', Auth::id())->where('read', false)->count() }}</span>
                </button>
                <div class="notification-dropdown" id="notificationDropdown">
                    <div class="notification-header">
                        <h4>Notifications</h4>
                        <button id="markAllRead" class="chart-btn">Mark All as Read</button>
                    </div>
                    <div class="notification-list" id="notificationList">
                        @foreach (\App\Models\Notification::where('user_id', Auth::id())->where('read', false)->latest()->take(5)->get() as $notification)
                            <div class="notification-item" data-id="{{ $notification->id }}">
                                <div class="notification-icon"><i class="bi bi-bell"></i></div>
                                <div class="notification-content">
                                    <h5>{{ $notification->type }}</h5>
                                    <p>{{ $notification->message }}</p>
                                    <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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