<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page Title -->
    <title>@yield('title', 'Mr Solution Dashboard - Manage Your Tech Solutions | 2025')</title>
    <!-- Meta Tags -->
    <meta name="description" content="Manage your AI-powered tech solutions with Mr Solution's advanced dashboard. Real-time analytics, project tracking, and more.">
    <meta name="keywords" content="dashboard, AI analytics, project management, Mr Solution, tech solutions">
    <meta name="author" content="Mr Solution">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/mrsolution.jpeg') }}" type="image/x-icon">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts: Inter, Space Grotesk, JetBrains Mono -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Dashboard Styles -->
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endpush
</head>

<body class="dashboard-page">
    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Theme Toggle Tray -->
    <div class="theme-toggle-container" id="themeToggleContainer">
        <button class="theme-toggle-button" id="themeToggleButton" aria-label="Toggle theme">
            <svg class="theme-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="sun" d="M12 3V4M12 20V21M3 12H4M20 12H21M5.636 5.636L6.343 6.343M17.657 17.657L18.364 18.364M5.636 18.364L6.343 17.657M17.657 6.343L18.364 5.636M12 6C9.243 6 7 8.243 7 11C7 13.757 9.243 16 12 16C14.757 16 17 13.757 17 11C17 8.243 14.757 6 12 6Z" stroke="currentColor" stroke-width="2" />
                <path class="moon" d="M12 3C7.029 3 3 7.029 3 12C3 16.971 7.029 21 12 21C14.285 21 16.346 20.174 17.899 18.899C17.404 18.965 16.902 19 16.4 19C12.283 19 9 15.717 9 11.6C9 7.483 12.283 4.2 16.4 4.2C16.902 4.2 17.404 4.235 17.899 4.301C16.346 3.126 14.285 2.3 12 2.3V3Z" fill="currentColor" />
            </svg>
        </button>
        <div class="theme-tray" id="themeTray">
            <button class="theme-option" data-theme="light">Light</button>
            <button class="theme-option" data-theme="dark">Dark</button>
        </div>
    </div>

    <!-- Dashboard Layout -->
    <div class="dashboard-container">
        <!-- Mobile Header -->
        <div class="mobile-header d-lg-none" x-data="{ open: false }">
            <button class="hamburger-btn" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <div class="mobile-logo"><img src="{{ asset('images/mrsolution.jpeg') }}" alt="Mr Solution Logo"></div>
            <div class="mobile-user">
                <div class="dropdown">
                    <button
                        class="btn dropdown-toggle"
                        type="button"
                        id="mobileUserDropdown"
                        @click="open = !open"
                        :aria-expanded="open">
                        <i class="fas fa-user-circle"></i>
                    </button>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        x-show="open"
                        @click.outside="open = false"
                        :aria-labelledby="mobileUserDropdown">
                        <li>
                            <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Profile Edit Link for Breeze -->
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Logout Form -->
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Top Navigation Bar -->
        <div class="top-nav d-none d-lg-flex">
            <div class="top-nav-left">
                <button class="hamburger-btn d-lg-none" id="sidebarToggleTop"><i class="fas fa-bars"></i></button>
            </div>
            <div class="top-nav-center">
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Search">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="top-nav-right">
                <i class="fas fa-bell me-3"></i>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ Auth::user()->name }}</span><i class="fas fa-user-circle profile-icon"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-logo d-none d-lg-block">
                <img src="{{ asset('images/mrsolution.jpeg') }}" alt="Mr Solution Logo">
            </div>
            <span class="close-btn" id="close-btn">X</span>
            <h3>Mr Solution Tech</h3>
            <hr>
            <hr>
            <nav class="nav flex-column">
                <div class="sidebar-section">
                    <div class="sidebar-heading">DASHBOARD</div>
                    <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a class="nav-link" href="/updates"><i class="bi bi-bell-fill"></i> Updates</a>
                    <a class="nav-link" href="/apps"><i class="bi bi-google-play"></i> Free Apps</a>
                    <a class="nav-link" href="/contact"><i class="bi bi-headset"></i> Contact Us</a>
                    <a class="nav-link" href="/purchase"><i class="bi bi-shield-lock"></i> Purchase Key</a>
                    <a class="nav-link" href="/crypter"><i class="bi bi-code-slash"></i> Code Crypter</a>
                    <a class="nav-link" href="https://selar.co/showlove/mrsolution" target="_blank"><i class="bi bi-gift"></i> Donate Here</a>
                    <a class="nav-link" href="/auth" id="premium-link"><i class="bi bi-person-check-fill"></i> Premium Member</a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Content Area -->
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Live Chat Widget -->
    <div class="chat-widget" id="chatWidget">
        <button class="chat-button" id="chatButton" aria-label="Open live chat">💬</button>
        <div class="chat-box" id="chatBox" role="dialog" aria-labelledby="chatHeader" aria-hidden="true">
            <div class="chat-header">
                <h4 id="chatHeader">Live Support</h4>
                <button class="chat-close" id="chatClose" aria-label="Close chat">×</button>
            </div>
            <div class="chat-messages">
                <p>Welcome! How can we assist you today?</p>
            </div>
            <form id="chatForm" class="chat-form">
                <input type="text" id="chatInput" placeholder="Type your message..." required aria-label="Chat message">
                <button type="submit" class="btn-primary">Send</button>
            </form>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">↑</button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>

</html>