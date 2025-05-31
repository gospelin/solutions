<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr Solution Dashboard - Premium Tech Solutions | 2025</title>
    <meta name="description" content="Experience the world's most advanced dashboard for AI-powered tech solutions. Real-time analytics, seamless project management, and premium user experience.">
    <meta name="keywords" content="premium dashboard, AI analytics, tech solutions, Mr Solution, modern interface">
    <meta name="author" content="Mr Solution">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Chart.js for Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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
            font-size: 16px;
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

        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--dark-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: opacity 0.5s ease, visibility 0.5s ease;
            visibility: visible;
            opacity: 1;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 3px solid var(--glass-border);
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            background: var(--dark-bg);
        }

        .sidebar {
            width: 280px;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--glass-border);
            padding: var(--space-xl);
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

        .sidebar.visible {
            transform: translateX(0);
        }


        .sidebar-header {
            display: flex;
            align-items: center;
            gap: var(--space-md);
            margin-bottom: var(--space-2xl);
            padding-bottom: var(--space-lg);
            border-bottom: 1px solid var(--glass-border);
        }

        .logo {
            width: 48px;
            height: 48px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--white);
        }

        .logo img {
            max-width: 100%;
            border-radius: var(--radius-lg);
        }

        .brand-text {
            color: var(--white);
        }

        .brand-text h1 {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .brand-text p {
            font-size: 0.875rem;
            color: var(--gray-400);
        }

        .nav-section {
            margin-bottom: var(--space-xl);
        }

        .nav-section-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: var(--space-md);
            padding-left: var(--space-md);
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

        .nav-list li {
            margin: 0;
        }

        .nav-list li:last-child {
            margin-bottom: 0;
        }

        .nav-list li a {
            color: var(--gray-300);
            text-decoration: none;
            font-weight: 500;
            display: block;
            padding: var(--space-md) var(--space-lg);
            border-radius: var(--radius-lg);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-list li a:hover {
            background: var(--glass-bg);
            color: var(--white);
            transform: translateX(4px);
        }

        .nav-list li a.active {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: var(--shadow-lg);
        }

        .nav-list li a.active::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-lg);
        }

        .nav-list li a .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-list li a .nav-badge {
            background: var(--accent);
            color: var(--white);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.125rem 0.5rem;
            border-radius: 12px;
            margin-left: auto;
        }

        .nav-list li a.premium-link {
            background: var(--gradient-accent) !important;
            color: var(--white) !important;
            position: relative;
            overflow: hidden;
        }

        .nav-list li a.premium-link::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: var(--space-md);
        }

        .nav-menu .nav-item {
            position: relative;
        }

        .nav-menu .nav-item:last-child {
            margin-bottom: 0;
        }

        .nav-menu .nav-item a {
            display: flex;
            align-items: center;
            gap: var(--space-md);
            padding: var(--space-md) var(--space-lg);
            border-radius: var(--radius-lg);
            color: var(--gray-300);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-menu .nav-item a:hover {
            color: var(--white);
            background: var(--glass-bg);
            transform: translateX(4px);
        }

        .nav-menu .nav-item a.active {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: var(--shadow-lg);
        }

        .nav-menu .nav-item a.active::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-lg);
        }

        .nav-menu .nav-item a .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-menu .nav-item a .nav-badge {
            background: var(--accent);
            color: var(--white);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.125rem 0.5rem;
            border-radius: 12px;
            margin-left: auto;
        }

        .nav-menu .nav-item a.premium-link {
            background: var(--gradient-accent) !important;
            color: var(--white) !important;
            position: relative;
            overflow: hidden;
        }

        .nav-menu .nav-item a.premium-link::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 2s infinite;
        }

        .nav-menu .nav-item a.premium-link:hover {
            background: var(--gradient-accent);
            color: var(--white);
        }

        .nav-menu .nav-item a.premium-link:hover::before {
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .nav-menu .nav-item a.premium-link.active {
            background: var(--gradient-accent);
            color: var(--white);
            box-shadow: var(--shadow-lg);
        }

        .nav-menu .nav-item a.premium-link.active::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-lg);
        }

        .nav-menu .nav-item a.premium-link .nav-icon {
            color: var(--white);
        }

        .nav-menu .nav-item a.premium-link .nav-badge {
            background: var(--white);
            color: var(--dark-bg);
        }

        .nav-menu .nav-item a.premium-link .nav-badge:hover {
            background: var(--primary);
            color: var(--white);
        }

        .nav-item {
            margin-bottom: var(--space-xs);
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: var(--space-md);
            padding: var(--space-md) var(--space-lg);
            border-radius: var(--radius-lg);
            color: var(--gray-300);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            color: var(--white);
            background: var(--glass-bg);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: var(--shadow-lg);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-lg);
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-badge {
            background: var(--accent);
            color: var(--white);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.125rem 0.5rem;
            border-radius: 12px;
            margin-left: auto;
        }

        .premium-link {
            background: var(--gradient-accent) !important;
            color: var(--white) !important;
            position: relative;
            overflow: hidden;
        }

        .premium-link::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-nav {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: var(--space-lg) var(--space-xl);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: var(--space-lg);
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.25rem;
            cursor: pointer;
            padding: var(--space-sm);
            border-radius: var(--radius-md);
            transition: background 0.2s ease;
        }

        .menu-toggle:hover {
            background: var(--glass-bg);
        }

        .search-container {
            position: relative;
            max-width: 400px;
            width: 100%;
        }

        .search-input {
            width: 100%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-md) var(--space-xl) var(--space-md) 3rem;
            color: var(--white);
            font-size: 0.875rem;
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
            left: var(--space-md);
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: var(--space-lg);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: var(--space-md);
        }

        .action-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--gray-300);
            font-size: 1.25rem;
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
            font-size: 0.625rem;
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
            gap: var(--space-md);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-sm) var(--space-md);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-trigger:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .user-info h4 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.125rem;
        }

        .user-info p {
            font-size: 0.75rem;
            color: var(--gray-400);
        }

        .dropdown-icon {
            color: var(--gray-400);
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
            padding: var(--space-md);
            min-width: 200px;
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
            gap: var(--space-md);
            padding: var(--space-md);
            border-radius: var(--radius-md);
            color: var(--gray-300);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: var(--space-xs);
        }

        .dropdown-item:hover {
            background: var(--glass-bg);
            color: var(--white);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--glass-border);
            margin: var(--space-md) 0;
        }

        .content {
            flex: 1;
            padding: var(--space-xl);
            background: var(--dark-bg);
        }

        .content-header {
            margin-bottom: var(--space-2xl);
        }

        .page-title {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: var(--space-sm);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            color: var(--gray-400);
            font-size: 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-xl);
            margin-bottom: var(--space-2xl);
        }

        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-xl);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-2xl);
            border-color: var(--primary);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .stat-card.secondary::before {
            background: var(--gradient-secondary);
        }

        .stat-card.accent::before {
            background: var(--gradient-accent);
        }

        .stat-card.success::before {
            background: var(--gradient-success);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-lg);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: var(--glass-bg);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: var(--space-xs);
            font-size: 0.875rem;
            font-weight: 600;
        }

        .stat-trend.up {
            color: var(--success);
        }

        .stat-trend.down {
            color: var(--error);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: var(--space-sm);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: var(--gray-400);
            font-weight: 500;
        }

        .chart-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: var(--space-xl);
            margin-bottom: var(--space-2xl);
        }

        .chart-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-xl);
            position: relative;
            overflow: hidden;
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-xl);
        }

        .chart-title {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 600;
        }

        .chart-actions {
            display: flex;
            gap: var(--space-sm);
        }

        .chart-btn {
            background: none;
            border: 1px solid var(--glass-border);
            border-radius: var(--radiusArizona);
            padding: var(--space-sm) var(--space-md);
            color: var(--gray-400);
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .chart-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: var(--space-md);
            padding: var(--space-md) 0;
            border-bottom: 1px solid var(--glass-border);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: var(--glass-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--primary);
        }

        .activity-content h5 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .activity-content p {
            font-size: 0.75rem;
            color: var(--gray-400);
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--gray-500);
            margin-left: auto;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-lg);
            margin-bottom: var(--space-2xl);
        }

        .action-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: var(--space-lg);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: inherit;
        }

        .action-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
            color: inherit;
        }

        .action-card-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--white);
            margin: 0 auto var(--space-md);
        }

        .action-card h4 {
            font-weight: 600;
            margin-bottom: var(--space-sm);
        }

        .action-card p {
            font-size: 0.875rem;
            color: var(--gray-400);
        }

        .theme-toggle {
            position: fixed;
            top: var(--space-xl);
            right: var(--space-xl);
            z-index: 1001;
        }

        .theme-btn {
            width: 48px;
            height: 48px;
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
            bottom: var(--space-xl);
            right: var(--space-xl);
            z-index: 1001;
        }

        .chat-button {
            width: 64px;
            height: 64px;
            background: var(--gradient-primary);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
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
            bottom: 80px;
            right: 0;
            width: 360px;
            height: 480px;
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
            padding: var(--space-lg);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-header h4 {
            font-family: var(--font-display);
            font-weight: 600;
        }

        .chat-close {
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.25rem;
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
            padding: var(--space-lg);
            overflow-y: auto;
        }

        .message {
            margin-bottom: var(--space-md);
            padding: var(--space-sm) var(--space-md);
            border-radius: var(--radius-md);
            background: var(--glass-bg);
            color: var(--white);
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
            padding: var(--space-lg);
            border-top: 1px solid var(--glass-border);
        }

        .chat-input {
            width: 100%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: var(--space-md);
            color: var(--white);
            font-family: var(--font-primary);
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

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--dark-surface);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-xl);
            max-width: 500px;
            width: 90%;
            position: relative;
            box-shadow: var(--shadow-2xl);
        }

        .modal-close {
            position: absolute;
            top: var(--space-md);
            right: var(--space-md);
            background: none;
            border: none;
            color: var(--gray-400);
            font-size: 1.25rem;
            cursor: pointer;
        }

        .modal-close:hover {
            color: var(--white);
        }

        .modal-title {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: var(--space-lg);
        }

        .modal-form {
            display: flex;
            flex-direction: column;
            gap: var(--space-md);
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-300);
            margin-bottom: var(--space-xs);
        }

        .form-input {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--space-md);
            color: var(--white);
            font-family: var(--font-primary);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-submit {
            background: var(--gradient-primary);
            border: none;
            border-radius: var(--radius-md);
            padding: var(--space-md);
            color: var(--white);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-submit:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
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

        body.light .nav-link {
            color: var(--gray-500);
        }

        body.light .nav-link.active {
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

        body.light .content {
            background: var(--dark-bg);
            color: var(--white);
        }

        body.light .content-header {
            margin-bottom: var(--space-2xl);
        }

        body.light .page-title {
            background: none;
            -webkit-text-fill-color: var(--primary);
        }

        body.light .page-subtitle {
            color: var(--gray-500);
        }

        body.light .stats-grid {
            background: var(--dark-bg);
        }

        body.light .stat-card {
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .stat-card:hover {
            border-color: var(--primary);
        }

        body.light .stat-value {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        body.light .stat-label {
            color: var(--gray-500);
        }

        body.light .user-info h4,
        body.light .user-info p {
            color: var(--gray-500);
        }

        body.light .page-title {
            background: none;
            -webkit-text-fill-color: var(--primary);
        }

        body.light .page-subtitle {
            color: var(--gray-400);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
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
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .chart-section {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .sidebar {
                width: 240px;
            }

            .sidebar-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .logo {
                margin-bottom: var(--space-md);
            }

            .nav-section-title {
                padding-left: 0;
            }

            .nav-link {
                padding: var(--space-md) var(--space-lg);
            }

            .search-container {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 200px;
            }

            .sidebar-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .logo {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }

            .brand-text h1 {
                font-size: 1.25rem;
            }

            .brand-text p {
                font-size: 0.75rem;
            }

            .nav-link {
                padding: var(--space-md) var(--space-md);
            }
        }

        @media (max-width: 360px) {
            .sidebar {
                width: 180px;
            }

            .logo {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }

            .brand-text h1 {
                font-size: 1rem;
            }

            .brand-text p {
                font-size: 0.625rem;
            }

            .nav-link {
                padding: var(--space-md) var(--space-sm);
            }
        }
    </style>
</head>

<body>
    <div class="loading-screen" id="loadingScreen">
        <div class="loading-spinner"></div>
    </div>

    <div class="dashboard-container">
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
                <div class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="bi bi-grid nav-icon"></i> Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-bar-chart nav-icon"></i> Analytics
                        <span class="nav-badge">New</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-kanban nav-icon"></i> Projects
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link premium-link">
                        <i class="bi bi-gem nav-icon"></i> Premium Features
                    </a>
                </div>
            </nav>
            <nav class="nav-section">
                <div class="nav-section-title">Settings</div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-gear nav-icon"></i> Settings
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

        <main class="main-content">
            <header class="top-nav">
                <div class="nav-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="search-container">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search projects, analytics, or users...">
                    </div>
                </div>
                <div class="nav-right">
                    <div class="nav-actions">
                        <button class="action-btn" title="Notifications">
                            <i class="bi bi-bell"></i>
                            <span class="badge">3</span>
                        </button>
                        <button class="action-btn" title="Messages">
                            <i class="bi bi-chat-dots"></i>
                            <span class="badge">5</span>
                        </button>
                    </div>
                    <div class="user-menu" id="userMenu">
                        <div class="user-trigger">
                            <div class="user-avatar">AD</div>
                            <div class="user-info">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p>{{ Auth::user()->role }}</p>
                            </div>
                            <i class="bi bi-chevron-down dropdown-icon"></i>
                        </div>
                        <div class="user-dropdown">
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-person"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item">
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

            <section class="content">
                <div class="content-header">
                    <h1 class="page-title">Dashboard</h1>
                    <p class="page-subtitle">Welcome back, {{ Auth::user()->name }}! Here's your AI-powered tech solutions overview.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-people"></i></div>
                            <div class="stat-trend up">
                                <i class="bi bi-arrow-up"></i> +12.5%
                            </div>
                        </div>
                        <div class="stat-value">1,245</div>
                        <div class="stat-label">Active Users</div>
                    </div>
                    <div class="stat-card secondary">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-bar-chart"></i></div>
                            <div class="stat-trend down">
                                <i class="bi bi-arrow-down"></i> -3.2%
                            </div>
                        </div>
                        <div class="stat-value">$45,320</div>
                        <div class="stat-label">Revenue</div>
                    </div>
                    <div class="stat-card accent">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-kanban"></i></div>
                            <div class="stat-trend up">
                                <i class="bi bi-arrow-up"></i> +8.7%
                            </div>
                        </div>
                        <div class="stat-value">342</div>
                        <div class="stat-label">Active Projects</div>
                    </div>
                    <div class="stat-card success">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
                            <div class="stat-trend up">
                                <i class="bi bi-arrow-up"></i> +15.9%
                            </div>
                        </div>
                        <div class="stat-value">89%</div>
                        <div class="stat-label">Completion Rate</div>
                    </div>
                </div>

                <div class="chart-section">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Revenue Overview</h3>
                            <div class="chart-actions">
                                <button class="chart-btn active">Weekly</button>
                                <button class="chart-btn">Monthly</button>
                                <button class="chart-btn">Yearly</button>
                            </div>
                        </div>
                        <canvas id="revenueChart"></canvas>
                    </div>
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Activity Feed</h3>
                            <a href="#" class="chart-btn">View All</a>
                        </div>
                        <div class="activity-feed">
                            <div class="activity-item">
                                <div class="activity-icon"><i class="bi bi-person-plus"></i></div>
                                <div class="activity-content">
                                    <h5>New User Registered</h5>
                                    <p>Jane Smith joined the platform.</p>
                                </div>
                                <div class="activity-time">2h ago</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="bi bi-kanban"></i></div>
                                <div class="activity-content">
                                    <h5>Project Completed</h5>
                                    <p>AI Analytics v2.0 finished.</p>
                                </div>
                                <div class="activity-time">4h ago</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="bi bi-bell"></i></div>
                                <div class="activity-content">
                                    <h5>System Alert</h5>
                                    <p>Server maintenance scheduled.</p>
                                </div>
                                <div class="activity-time">6h ago</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="quick-actions">
                    <a href="#" class="action-card" id="newProjectCard">
                        <div class="action-card-icon"><i class="bi bi-plus-circle"></i></div>
                        <h4>New Project</h4>
                        <p>Start a new AI-powered project.</p>
                    </a>
                    <a href="#" class="action-card">
                        <div class="action-card-icon"><i class="bi bi-bar-chart"></i></div>
                        <h4>View Analytics</h4>
                        <p>Dive into real-time data insights.</p>
                    </a>
                    <a href="#" class="action-card">
                        <div class="action-card-icon"><i class="bi bi-chat-dots"></i></div>
                        <h4>Contact Support</h4>
                        <p>Get help from our premium team.</p>
                    </a>
                </div>
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
                    <h4>AI Assistant</h4>
                    <button class="chat-close" id="chatClose">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <div class="message">Hello! How can I assist you today?</div>
                </div>
                <div class="chat-input-container">
                    <input type="text" class="chat-input" id="chatInput" placeholder="Type your message...">
                </div>
            </div>
        </div>

        <div class="modal" id="newProjectModal">
            <div class="modal-content">
                <button class="modal-close" id="modalClose"><i class="bi bi-x"></i></button>
                <h3 class="modal-title">Create New Project</h3>
                <form class="modal-form" id="newProjectForm">
                    <div class="form-group">
                        <label for="projectName">Project Name</label>
                        <input type="text" id="projectName" class="form-input" placeholder="Enter project name" required>
                    </div>
                    <div class="form-group">
                        <label for="projectDescription">Description</label>
                        <textarea id="projectDescription" class="form-input" placeholder="Describe your project" rows="4"></textarea>
                    </div>
                    <button type="submit" class="form-submit">Create Project</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loadingScreen = document.getElementById('loadingScreen');
            const hideLoadingScreen = () => {
                loadingScreen.style.opacity = '0';
                loadingScreen.style.visibility = 'hidden';
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500);
            };

            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                setTimeout(hideLoadingScreen, 100);
            } else {
                window.addEventListener('load', hideLoadingScreen);
            }

            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });

            const userMenu = document.getElementById('userMenu');
            userMenu.addEventListener('click', () => {
                userMenu.classList.toggle('active');
            });

            const themeToggle = document.getElementById('themeToggle');
            themeToggle.addEventListener('click', () => {
                document.body.classList.toggle('light');
                themeToggle.innerHTML = document.body.classList.contains('light') ?
                    '<i class="bi bi-sun"></i>' :
                    '<i class="bi bi-moon-stars"></i>';
            });

            const chatToggle = document.getElementById('chatToggle');
            const chatBox = document.getElementById('chatBox');
            const chatClose = document.getElementById('chatClose');
            const chatInput = document.getElementById('chatInput');
            const chatMessages = document.getElementById('chatMessages');

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
                        response.textContent = 'Got your message! Our support team ';
                        chatMessages.appendChild(response);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 1000);

                    chatInput.value = '';
                }
            });

            const newProjectModal = document.getElementById('newProjectModal');
            const modalClose = document.getElementById('modalClose');
            const newProjectForm = document.getElementById('newProjectForm');
            const newProjectCard = document.getElementById('newProjectCard');

            newProjectCard.addEventListener('click', (e) => {
                e.preventDefault();
                newProjectModal.classList.add('active');
            });

            modalClose.addEventListener('click', () => {
                newProjectModal.classList.remove('active');
            });

            newProjectForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const projectName = document.getElementById('projectName').value;
                const projectDescription = document.getElementById('projectDescription').value;
                console.log(`New Project: ${projectName} - ${projectDescription}`);
                newProjectModal.classList.remove('active');
                newProjectForm.reset();
            });

            const revenueChart = new Chart(document.getElementById('revenueChart'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Revenue',
                        data: [12000, 19000, 15000, 22000, 18000, 25000],
                        borderColor: 'rgb(99, 102, 241)',
                        backgroundColor: 'rgba(99, 102, 241, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            const chartButtons = document.querySelectorAll('.chart-btn');
            chartButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    chartButtons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const period = btn.textContent.toLowerCase();
                    let newData;
                    if (period === 'weekly') {
                        newData = [12000, 19000, 15000, 22000, 18000, 25000];
                    } else if (period === 'monthly') {
                        newData = [50000, 65000, 45000, 70000, 60000, 80000];
                    } else {
                        newData = [200000, 250000, 180000, 300000, 220000, 350000];
                    }
                    revenueChart.data.datasets[0].data = newData;
                    revenueChart.update();
                });
            });
        });
    </script>
</body>

</html>