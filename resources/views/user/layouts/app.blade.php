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

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Chart.js for Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #8b5cf6;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --dark-bg: #0a0a0f;
            --dark-surface: #1a1a2e;
            --dark-card: #16213e;
            --dark-border: #0f3460;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-accent: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --font-primary: "Inter", system-ui, -apple-system, sans-serif;
            --font-display: "Space Grotesk", sans-serif;
            --font-mono: "JetBrains Mono", monospace;
            --space-xs: 0.25rem;
            --space-sm: 0.5rem;
            --space-md: 1rem;
            --space-lg: 1.5rem;
            --space-xl: 2rem;
            --space-2xl: 3rem;
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            font-size: clamp(14px, 3.5vw, 16px);
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: var(--font-primary);
            background: var(--dark-bg);
            color: var(--white);
            line-height: 1.6;
            overflow-x: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-surface);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            background: var(--dark-bg);
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .sidebar {
            width: clamp(200px, 70vw, 280px);
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--glass-border);
            padding: var(--space-lg);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: var(--space-md);
            margin-bottom: var(--space-xl);
            padding-bottom: var(--space-md);
            border-bottom: 1px solid var(--glass-border);
        }

        .logo {
            width: clamp(36px, 10vw, 48px);
            height: clamp(36px, 10vw, 48px);
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1rem, 4vw, 1.5rem);
            font-weight: 700;
            color: var(--white);
        }

        .brand-text {
            color: var(--white);
        }

        .brand-text h1 {
            font-family: var(--font-display);
            font-size: clamp(1rem, 4vw, 1.5rem);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .brand-text p {
            font-size: clamp(0.625rem, 2.5vw, 0.875rem);
            color: var(--gray-400);
        }

        .nav-section {
            margin-bottom: var(--space-xl);
        }

        .nav-section-title {
            font-size: clamp(0.625rem, 2.5vw, 0.75rem);
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: var(--space-md);
            padding-left: var(--space-sm);
        }

        .nav-section-title::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 16px;
            background: var(--primary);
            border-radius: var(--radius-sm);
            margin-right: var(--space-xs);
        }

        .nav-section-title::after {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background: var(--glass-border);
            margin-top: var(--space-xs);
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-list li a,
        .nav-list li button {
            color: var(--gray-300);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            padding: var(--space-sm) var(--space-md);
            border-radius: var(--radius-lg);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: clamp(0.875rem, 3vw, 1rem);
        }

        .nav-list li a:hover,
        .nav-list li button:hover {
            background: var(--glass-bg);
            color: var(--white);
            transform: translateX(4px);
        }

        .nav-list li a.active,
        .nav-list li button.active {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: var(--shadow-lg);
        }

        .nav-list li a .nav-icon,
        .nav-list li button .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-badge {
            background: var(--error);
            color: var(--white);
            font-size: clamp(0.5rem, 2vw, 0.625rem);
            font-weight: 600;
            padding: 0.125rem 0.375rem;
            border-radius: 10px;
            margin-left: auto;
        }

        .main-content {
            flex: 1;
            margin-left: clamp(200px, 70vw, 280px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-nav {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: var(--space-md) var(--space-lg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            flex-wrap: wrap;
            gap: var(--space-sm);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            flex: 1;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: clamp(1.25rem, 4vw, 1.5rem);
            cursor: pointer;
            padding: var(--space-sm);
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            position: relative;
            z-index: 1001;
        }

        .menu-toggle:hover {
            background: var(--glass-bg);
        }

        .menu-toggle.active i::before {
            content: '\F2EA';
            /* Bootstrap Icons 'x' */
        }

        .search-container {
            position: relative;
            max-width: clamp(200px, 50vw, 400px);
            width: 100%;
        }

        .search-input {
            width: 100%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-sm) var(--space-md) var(--space-sm) 2.5rem;
            color: var(--white);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            transition: all 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .search-icon {
            position: absolute;
            left: var(--space-sm);
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            flex-wrap: wrap;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
        }

        .action-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--gray-300);
            font-size: clamp(1rem, 3vw, 1.25rem);
            cursor: pointer;
            padding: var(--space-sm);
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            color: var(--white);
            background: var(--glass-bg);
        }

        .action-btn .badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: var(--error);
            color: var(--white);
            font-size: clamp(0.5rem, 2vw, 0.625rem);
            font-weight: 600;
            padding: 0.125rem 0.375rem;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
        }

        .user-menu {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-sm);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-trigger:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
        }

        .user-avatar {
            width: clamp(28px, 8vw, 32px);
            height: clamp(28px, 8vw, 32px);
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
        }

        .user-info h4 {
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            font-weight: 600;
            margin-bottom: 0.125rem;
        }

        .user-info p {
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            color: var(--gray-400);
        }

        .dropdown-icon {
            color: var(--gray-400);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            transition: transform 0.2s ease;
        }

        .user-menu.active .dropdown-icon {
            transform: rotate(180deg);
        }

        .user-dropdown {
            position: absolute;
            top: calc(100% + var(--space-sm));
            right: 0;
            background: var(--dark-surface);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: var(--space-sm);
            min-width: clamp(160px, 50vw, 200px);
            box-shadow: var(--shadow-2xl);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        .user-menu.active .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            padding: var(--space-sm);
            border-radius: var(--radius-md);
            color: var(--gray-300);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: var(--space-xs);
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
        }

        .dropdown-item:hover {
            background: var(--glass-bg);
            color: var(--white);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--glass-border);
            margin: var(--space-sm) 0;
        }

        .theme-toggle {
            position: fixed;
            top: var(--space-lg);
            right: var(--space-lg);
            z-index: 1001;
        }

        .theme-btn {
            width: clamp(36px, 10vw, 48px);
            height: clamp(36px, 10vw, 48px);
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: var(--gray-400);
        }

        .theme-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            transform: rotate(20deg) scale(1.05);
        }

        .chat-widget {
            position: fixed;
            bottom: var(--space-lg);
            right: var(--space-lg);
            z-index: 1001;
        }

        .chat-button {
            width: clamp(48px, 12vw, 56px);
            height: clamp(48px, 12vw, 56px);
            background: var(--gradient-primary);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1rem, 3vw, 1.25rem);
            color: var(--white);
            cursor: pointer;
            box-shadow: var(--shadow-xl);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .chat-button:hover {
            transform: scale(1.1);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4);
        }

        .chat-box {
            position: absolute;
            bottom: calc(100% + var(--space-sm));
            right: 0;
            width: clamp(240px, 90vw, 320px);
            height: clamp(320px, 50vh, 400px);
            background: var(--dark-surface);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-2xl);
            display: none;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-box.active {
            display: flex;
        }

        .chat-header {
            background: var(--gradient-primary);
            padding: var(--space-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-header h4 {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: clamp(0.875rem, 2.5vw, 1rem);
        }

        .chat-close {
            background: none;
            border: none;
            color: var(--white);
            font-size: clamp(1rem, 3vw, 1.25rem);
            cursor: pointer;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s ease;
        }

        .chat-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .chat-messages {
            flex: 1;
            padding: var(--space-md);
            overflow-y: auto;
        }

        .message {
            margin-bottom: var(--space-sm);
            padding: var(--space-sm) var(--space-md);
            border-radius: var(--radius-md);
            background: var(--glass-bg);
            color: var(--white);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
        }

        .message.user {
            background: var(--primary);
            margin-left: 20%;
            text-align: right;
        }

        .message.ai {
            background: var(--dark-card);
            margin-right: 20%;
        }

        .chat-input-container {
            padding: var(--space-md);
            border-top: 1px solid var(--glass-border);
        }

        .chat-input {
            width: 100%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: var(--space-sm);
            color: var(--white);
            font-family: var(--font-primary);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
        }

        .chat-input::placeholder {
            color: var(--gray-400);
        }

        .chat-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        body.light {
            --dark-bg: #ffffff;
            --dark-surface: #f8fafc;
            --dark-card: #ffffff;
            --dark-border: #e2e8f0;
            --white: #0f172a;
            --gray-300: #64748b;
            --gray-400: #475569;
            --gray-500: #334155;
            --glass-bg: rgba(0, 0, 0, 0.02);
            --glass-border: rgba(0, 0, 0, 0.1);
        }

        body.light .sidebar {
            background: var(--dark-surface);
        }

        body.light .nav-list li a,
        body.light .nav-list li button {
            color: var(--gray-500);
        }

        body.light .nav-list li a.active,
        body.light .nav-list li button.active {
            color: var(--white);
        }

        body.light .top-nav {
            background: var(--dark-surface);
        }

        body.light .search-input {
            color: var(--gray-500);
        }

        body.light .action-btn {
            color: var(--gray-500);
        }

        body.light .action-btn:hover {
            color: var(--white);
            background: var(--glass-bg);
        }

        body.light .user-trigger {
            background: var(--glass-bg);
            color: var(--gray-500);
        }

        body.light .user-trigger:hover {
            background: rgba(0, 0, 0, 0.05);
            border-color: var(--primary);
            color: var(--white);
        }

        body.light .user-avatar {
            background: var(--gradient-primary);
            color: var(--white);
        }

        body.light .user-dropdown {
            background: var(--dark-card);
            border-color: var(--dark-border);
        }

        body.light .user-dropdown .dropdown-item {
            color: var(--gray-500);
        }

        body.light .user-dropdown .dropdown-item:hover {
            background: rgba(0, 0, 0, 0.05);
            color: var(--white);
        }

        body.light .user-info h4,
        body.light .user-info {
            color: var(--gray-500);
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                width: clamp(200px, 70vw, 280px);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .top-nav {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--space-md);
                padding: var(--space-md);
            }

            .nav-left {
                width: 100%;
                justify-content: space-between;
            }

            .nav-right {
                width: 100%;
                justify-content: space-between;
            }

            .search-container {
                max-width: 100%;
            }

            .user-trigger {
                padding: var(--space-xs) var(--space-sm);
            }

            .user-info p {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .sidebar {
                width: clamp(180px, 60vw, 240px);
                padding: var(--space-md);
            }

            .sidebar-header {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--space-sm);
            }

            .logo {
                margin-bottom: var(--space-sm);
            }

            .nav-section-title {
                padding-left: 0;
                font-size: clamp(0.625rem, 2.5vw, 0.75rem);
            }

            .nav-list li a,
            .nav-list li button {
                padding: var(--space-sm) var(--space-md);
                font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            }

            .search-input {
                padding: var(--space-sm) var(--space-md) var(--space-sm) 2rem;
            }

            .theme-toggle {
                top: var(--space-md);
                right: var(--space-md);
            }

            .chat-widget {
                bottom: var(--space-md);
                right: var(--space-md);
            }

            .chat-box {
                width: clamp(200px, 85vw, 280px);
                height: clamp(280px, 45vh, 360px);
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: clamp(160px, 55vw, 220px);
            }

            .logo {
                width: clamp(32px, 8vw, 40px);
                height: clamp(32px, 8vw, 40px);
                font-size: clamp(0.875rem, 3vw, 1.25rem);
            }

            .brand-text h1 {
                font-size: clamp(0.875rem, 3vw, 1.25rem);
            }

            .brand-text p {
                font-size: clamp(0.5rem, 2vw, 0.75rem);
            }

            .nav-section-title {
                font-size: clamp(0.5rem, 2vw, 0.625rem);
            }

            .nav-list li a,
            .nav-list li button {
                padding: var(--space-sm);
                font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            }

            .user-dropdown {
                min-width: clamp(140px, 45vw, 180px);
            }
        }

        @media (max-width: 360px) {
            .sidebar {
                width: clamp(140px, 50vw, 200px);
            }

            .logo {
                width: clamp(28px, 8vw, 36px);
                height: clamp(28px, 8vw, 36px);
                font-size: clamp(0.75rem, 3vw, 1rem);
            }

            .brand-text h1 {
                font-size: clamp(0.75rem, 2.5vw, 1rem);
            }

            .brand-text p {
                font-size: clamp(0.5rem, 2vw, 0.625rem);
            }

            .nav-section-title {
                font-size: clamp(0.5rem, 2vw, 0.625rem);
            }

            .nav-list li a,
            .nav-list li button {
                padding: var(--space-xs) var(--space-sm);
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }

            .search-input {
                padding: var(--space-xs) var(--space-sm) var(--space-xs) 2rem;
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }

            .search-icon {
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }

            .chat-box {
                width: clamp(180px, 80vw, 260px);
                height: clamp(260px, 40vh, 320px);
            }
        }
    </style>
    
     <!-- Add stack for custom styles -->
    @stack('styles')
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
                    <li><a href="{{ route('free-apps') }}"
                            class="{{ request()->routeIs('free-apps') ? 'active' : '' }}"><i
                                class="bi bi-code-slash nav-icon"></i> Free Apps</a></li>
                    <li><a href="{{ route('premium-features') }}"
                            class="{{ request()->routeIs('premium-features') ? 'active' : '' }}"><i
                                class="bi bi-lock nav-icon"></i> Premium Features <span class="nav-badge">Pro</span></a>
                    </li>
                    <li><a href="{{ route('community') }}"
                            class="{{ request()->routeIs('community') ? 'active' : '' }}"><i
                                class="bi bi-people nav-icon"></i> Community</a></li>
                    <li><a href="{{ route('support') }}" class="{{ request()->routeIs('support') ? 'active' : '' }}"><i class="bi bi-question-circle nav-icon"></i> Support</a></li>
                    <li>
                        <a href="{{ route('market') }}" class="{{ request()->routeIs('market') ? 'active' : '' }}">
                            <i class="bi bi-cart nav-icon"></i> Marketplace <span class="nav-badge">New</span>
                        </a>
                    </li>
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
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search tools, tutorials, or community...">
                    </div>
                </div>
                <div class="nav-right">
                    <div class="nav-actions">
                        <button class="action-btn" title="Notifications">
                            <i class="bi bi-bell"></i>
                            <span class="badge">3</span>
                        </button>
                        <button class="action-btn" title="Favorites">
                            <i class="bi bi-star"></i>
                        </button>
                    </div>
                    <div class="user-menu" id="userMenu">
                        <div class="user-trigger">
                            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <div class="user-info">
                                <h4>{{ auth()->user()->name }}</h4>
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
                    <h4>Support Chat</h4>
                    <button class="chat-close" id="chatClose">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <div class="message">Need help with a tool? Ask away!</div>
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

            // Toggle Sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                menuToggle.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            menuToggle.addEventListener('click', toggleSidebar);

            // Close Sidebar on Overlay Click
            overlay.addEventListener('click', () => {
                if (sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });

            // Close Sidebar on Menu Item Click
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

            // Close User Menu on Outside Click
            document.addEventListener('click', (e) => {
                if (!userMenu.contains(e.target) && userMenu.classList.contains('active')) {
                    userMenu.classList.remove('active');
                }
            });

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

            // Chat Input Handling
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
                        response.textContent = 'Our team will help you unleash chaos soon!';
                        chatMessages.appendChild(response);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 1000);

                    chatInput.value = '';
                }
            });

            // Prevent Sidebar from Closing on Internal Clicks
            sidebar.addEventListener('click', (e) => {
                e.stopPropagation();
            });

            // Close Sidebar on Resize if Open
            window.addEventListener('resize', () => {
                if (window.innerWidth > 1024 && sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });
        });
    </script>

    @yield('scripts')
</body>

</html>