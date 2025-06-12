
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Mr Solution - @yield('title', 'User Dashboard') - Premium Tech Solutions | 2025</title>
    <meta name="description"
        content="@yield('description', 'User-friendly dashboard for accessing free and premium tools: coding, hacking, sniffing, OS, bots, and more.')">
    <meta name="keywords" content="user dashboard, hacking tools, sniffing tools, coding tools, bots, Mr Solution">
    <meta name="author" content="Mr Solution">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth-id" content="{{ auth()->id() ?? '' }}">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    @vite(['resources/css/dashboard.css', 'resources/js/user-realtime.js'])

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mrsolution.com.ng/dashboard">
    <meta property="og:image" content="{{ asset('images/mrsolution.jpeg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@mrsolution">
    <meta name="twitter:title" content="Mr Solution - Revolutionary Tech Solutions">
    <meta name="twitter:description" content="Leading-edge technology solutions powered by AI and innovation.">
    <meta name="twitter:image" content="{{ asset('images/mrsolution.jpeg') }}">
    <link rel="shortcut icon" href="{{ asset('images/mrsolution.jpeg') }}" type="image/x-icon">

    @stack('styles')
    <style>
        .notification-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #1a1a1a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 8px;
            min-width: 300px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 9999;
        }

        .notification-toggle.active+.notification-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .notification-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 14px;
            color: #d1d5db;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #10b981;
        }

        .notification-content h5 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .notification-content p {
            font-size: 12px;
            color: #9ca3af;
        }

        .notification-time {
            font-size: 12px;
            color: #6b7280;
            margin-left: auto;
        }

        .badge {
            background: #ef4444;
            color: white;
            border-radius: 9999px;
            padding: 2px 8px;
            font-size: 12px;
            position: absolute;
            top: -8px;
            right: -8px;
        }

        .action-btn {
            position: relative;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="overlay" id="overlay"></div>
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">M</div>
                <div class="brand-text">
                    <h1>Mr Solution</h1>
                    <p>Premium Tech Solutions</p>
                </div>
            </div>
            <nav class="nav-section">
                <div class="nav-section-title">Main</div>
                <ul class="nav-list">
                    <li><a href="{{ route('user.dashboard') }}"
                            class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}"><i
                                class="bi bi-grid nav-icon"></i> Home</a></li>
    
                    <li><a href="{{ route('free-apps') }}" class="{{ request()->routeIs('free-apps') ? 'active' : '' }}"><i
                                class="bi bi-code-slash nav-icon"></i> Free Apps</a></li>
                    <li><a href="{{ route('premium-features') }}"
                            class="{{ request()->routeIs('premium-features') ? 'active' : '' }}"><i
                                class="bi bi-lock nav-icon"></i> Premium Features <span class="nav-badge">Pro</span></a>
                    </li>
                    <li><a href="{{ route('community') }}" class="{{ request()->routeIs('community') ? 'active' : '' }}"><i
                                class="bi bi-people nav-icon"></i> Community</a></li>
                    <li><a href="{{ route('support') }}" class="{{ request()->routeIs('support') ? 'active' : '' }}"><i
                                class="bi bi-question-circle nav-icon"></i> Support</a></li>
                    <li><a href="{{ route('market') }}" class="{{ request()->routeIs('market') ? 'active' : '' }}">
                            <i class="bi bi-cart nav-icon"></i> Marketplace <span class="nav-badge">New</span>
                        </a>
                    </li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}"><i
                                class="bi bi-envelope nav-icon"></i> Contact</a></li>
                </ul>
            </nav>
            <nav class="nav-section">
                <div class="nav-section-title">Account</div>
                <ul class="nav-list">
                    <li><a href="{{ route('profile.edit') }}"
                            class="{{ request()->routeIs('user.profile.edit') ? 'active' : '' }}"><i
                                class="bi bi-person nav-icon"></i> Profile</a></li>
                    <li><a href="{{ route('user.settings') }}"
                            class="{{ request()->routeIs('user.settings') ? 'active' : '' }}"><i
                                class="bi bi-gear nav-icon"></i> Settings</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"><i class="bi bi-box-arrow-right nav-icon"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-nav">
                <div class="nav-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="search-container">
                        <form action="{{ route('search') }}" method="GET">
                            <i class="bi bi-search search-icon"></i>
                            <input type="text" name="query" class="search-input" placeholder="Search tools..."
                                value="{{ request('query') }}">
                            <button type="submit" style="display: none;">Search</button>
                        </form>
                    </div>
                </div>
                <div class="nav-right">
                    <div class="nav-actions">
                        @if (auth()->check())
                            <button class="action-btn notification-toggle" id="notificationToggle" title="Notifications">
                                <i class="bi bi-bell"></i>
                                <span class="badge" id="notificationCount">{{ $unreadNotificationsCount ?? 0 }}</span>
                            </button>
                            <div class="notification-dropdown" id="notificationDropdown">
                                <div id="notificationList">
                                    @foreach ($unreadNotifications ?? [] as $notification)
                                        <div class="notification-item" data-id="{{ $notification->id }}">
                                            <div class="notification-icon"><i class="bi bi-bell"></i></div>
                                            <div class="notification-content">
                                                <h5>{{ $notification->type }}</h5>
                                                <p>{{ $notification->message }}</p>
                                            </div>
                                            <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                    @endforeach
                                    @if (empty($unreadNotifications) || $unreadNotifications->isEmpty())
                                        <div class="notification-item text-center p-4">
                                            <p class="text-gray-400">No new notifications</p>
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('notifications') }}"
                                    class="block text-center p-2 bg-gray-800 text-gray-300 hover:bg-gray-700 rounded">
                                    View All Notifications
                                </a>
                            </div>
                        @endif
                        <button class="action-btn" title="Favorites">
                            <i class="bi bi-star"></i>
                        </button>
                    </div>
                    <div class="user-menu" id="userMenu">
                        <div class="user-trigger">
                            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}</div>
                            <div class="user-info">
                                <h4>{{ auth()->user()->name ?? 'Guest' }}</h4>
                                <p>Free Tier</p>
                            </div>
                            <i class="bi bi-chevron-down dropdown-icon"></i>
                        </div>
                        <div class="user-dropdown">
                            <a href="{{ route('profile.edit') }}"
                                class="dropdown-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                <i class="bi bi-person"></i> Profile
                            </a>
                            <a href="{{ route('user.settings') }}"
                                class="dropdown-item {{ request()->routeIs('user.settings') ? 'active' : '' }}">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                            <a href="{{ route('subscription') }}"
                                class="dropdown-item {{ request()->routeIs('subscription') ? 'active' : '' }}">
                                <i class="bi bi-lock"></i> Subscription
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

            <section class="content">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            @if (session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                @yield('content')
            </section>
        </main>

        <div class="theme-toggle">
            <button class="theme-btn" id="themeToggle" title="Toggle Theme">
                <i class="bi bi-moon-stars"></i>
            </button>
        </div>

        <div class="chat-widget">
            <button class="chat-button" id="chatToggle">
                <i class="bi bi-chat-dots"></i>
            </button>
            <div class="chat-box" id="chatBox">
                <div class="chat-header">
                    <h4>Live Support</h4>
                    <button class="chat-close" id="chatClose">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <div class="message">How can we help you</div>
                </div>
                <div class="chat-input-container">
                    <input type="text" class="chat-input" id="chatInput" placeholder="Type your message...">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const userMenu = document.getElementById('userMenu');
            const themeToggle = document.getElementById('themeToggle');
            const chatToggle = document.getElementById('chatToggle');
            const chatBox = document.getElementById('chatBox');
            const chatClose = document.getElementById('chatClose');
            const chatInput = document.getElementById('chatInput');
            const chatMessages = document.getElementById('chatMessages');
            const notificationToggle = document.getElementById('notificationToggle');
            const notificationDropdown = document.getElementById('notificationDropdown');

            // Toggle Sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                menuToggle.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            menuToggle.addEventListener('click', toggleSidebar);

            overlay.addEventListener('click', () => {
                if (sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });

            document.querySelectorAll('.nav-list li a, .nav-list li button').forEach(item => {
                item.addEventListener('click', () => {
                    if (window.innerWidth <= 1024 && sidebar.classList.contains('active')) {
                        toggleSidebar();
                    }
                });
            });

            // Toggle User Menu
            userMenu.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenu.classList.toggle('active');
            });

            document.addEventListener('click', (e) => {
                if (!userMenu.contains(e.target) && userMenu.classList.contains('active')) {
                    userMenu.classList.remove('active');
                }
            });

            // Toggle Notification Dropdown
            if (notificationToggle && notificationDropdown) {
                notificationToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    notificationToggle.classList.toggle('active');
                });

                document.addEventListener('click', (e) => {
                    if (!notificationToggle.contains(e.target) && !notificationDropdown.contains(e.target)) {
                        notificationToggle.classList.remove('active');
                    }
                });
            }

            // Toggle Theme
            themeToggle.addEventListener('click', () => {
                document.body.classList.toggle('light');
                themeToggle.innerHTML = document.body.classList.contains('light')
                    ? '<i class="bi bi-sun"></i>'
                    : '<i class="bi bi-moon-stars"></i>';
            });

            // Toggle Chat
            chatToggle.addEventListener('click', () => {
                chatBox.classList.toggle('active');
            });

            chatClose.addEventListener('click', () => {
                chatBox.classList.remove('active');
            });

            chatInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && chatInput.value.trim()) {
                    const message = document.createElement('div');
                    message.className = 'message user';
                    message.textContent = chatInput.value;
                    chatMessages.appendChild(message);
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                    setTimeout(() => {
                        const response = document.createElement('div');
                        response.className = 'message ai';
                        response.textContent = 'Your message has been received, our team will respond as soon as possible!';
                        chatMessages.appendChild(response);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 1000);

                    chatInput.value = '';
                }
            });

            sidebar.addEventListener('click', (e) => {
                e.stopPropagation();
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 1024 && sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
