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

    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Add stack for custom styles -->
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

    <!-- Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>