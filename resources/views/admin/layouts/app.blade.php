<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Mr Solution Admin Dashboard')</title>
    <meta name="description" content="@yield('description', 'Admin dashboard for managing users, tools, and system settings with AI-powered insights.')">
    <meta name="keywords" content="admin dashboard, AI analytics, user management, tool moderation, Mr Solution">
    <meta name="author" content="Mr Solution">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- ... other meta tags ... -->
    <meta name="auth-id" content="{{ Auth::id() }}">

    
    <!-- Vite Assets -->
    @vite(['resources/css/admin.css', 'resources/js/bootstrap.js', 'resources/js/admin.js', 'resources/js/realtime.js'])
    @stack('styles')

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mrsolution.com.ng/admin/dashboard">
    <meta property="og:image" content="{{ asset('images/mrsolution.jpeg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@mrsolution">
    <meta name="twitter:title" content="Mr Solution - Revolutionary Tech Solutions">
    <meta name="twitter:description" content="Leading-edge technology solutions powered by AI and innovation.">
    <meta name="twitter:image" content="{{ asset('images/mrsolution.jpeg') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/mrsolution.jpeg') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/mrsolution.jpeg') }}" type="image/x-icon">

<style>
    .notification-container {
        position: relative;
    }

    .notification-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        width: 300px;
        background: var(--bg-color);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
    }

    .notification-dropdown.active {
        display: block;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid var(--border-color);
    }

    .notification-header h4 {
        margin: 0;
        font-size: 16px;
    }

    .notification-list {
        padding: 10px;
    }

    .notification-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid var(--border-color);
    }

    .notification-icon {
        margin-right: 10px;
        font-size: 20px;
    }

    .notification-content {
        flex: 1;
    }

    .notification-content h5 {
        margin: 0;
        font-size: 14px;
    }

    .notification-content p {
        margin: 5px 0 0;
        font-size: 12px;
        color: var(--text-muted);
    }

    .notification-time {
        font-size: 12px;
        color: var(--text-muted);
    }
</style>

</head>

<body>
    <div class="loading-screen" id="loadingScreen">
        <div class="loading-spinner"></div>
    </div>

    <div class="dashboard-container">
        <div class="overlay" id="overlay"></div>
        @include('admin.partials.sidebar')
        <main class="main-content">
            @include('admin.partials.top-nav')
            @yield('content')
        </main>
        <div class="theme-toggle">
            <button class="theme-btn" id="themeToggle" title="Toggle Theme">
                <i class="bi bi-moon-stars"></i>
            </button>
        </div>
    </div>
</body>

</html>