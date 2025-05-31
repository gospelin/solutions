<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr Solution User Dashboard - Premium Tech Solutions | 2025</title>
    <meta name="description" content="User-friendly dashboard for accessing free and premium tools: coding, hacking, sniffing, OS, bots, and more.">
    <meta name="keywords" content="user dashboard, hacking tools, sniffing tools, coding tools, bots, Mr Solution">
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
            font-size: clamp(14px, 4vw, 16px);
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

        .sidebar {
            width: clamp(180px, 20vw, 280px);
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

        .sidebar.active {
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
            width: clamp(32px, 10vw, 48px);
            height: clamp(32px, 10vw, 48px);
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1rem, 3vw, 1.5rem);
            font-weight: 700;
            color: var(--white);
        }

        .brand-text {
            color: var(--white);
        }

        .brand-text h1 {
            font-family: var(--font-display);
            font-size: clamp(1rem, 3vw, 1.5rem);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .brand-text p {
            font-size: clamp(0.625rem, 2vw, 0.875rem);
            color: var(--gray-400);
        }

        .nav-section {
            margin-bottom: var(--space-xl);
        }

        .nav-section-title {
            font-size: clamp(0.625rem, 2vw, 0.75rem);
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

        .nav-list li a,
        .nav-list li button {
            color: var(--gray-300);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: var(--space-md);
            padding: var(--space-md) var(--space-lg);
            border-radius: var(--radius-lg);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
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
            font-size: 0.625rem;
            font-weight: 600;
            padding: 0.125rem 0.375rem;
            border-radius: 10px;
            margin-left: auto;
        }

        .main-content {
            flex: 1;
            margin-left: clamp(180px, 20vw, 280px);
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
            flex-wrap: wrap;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: var(--space-lg);
            flex: 1;
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
            flex-wrap: wrap;
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
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
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
            font-size: clamp(1.5rem, 5vw, 2rem);
            font-weight: 700;
            margin-bottom: var(--space-sm);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            color: var(--gray-400);
            font-size: clamp(0.875rem, 3vw, 1rem);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(clamp(200px, 40vw, 280px), 1fr));
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

        .stat-icon {
            width: clamp(40px, 10vw, 60px);
            height: clamp(40px, 10vw, 60px);
            background: var(--glass-bg);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1rem, 3vw, 1.5rem);
            color: var(--primary);
        }

        .stat-value {
            font-size: clamp(1.5rem, 5vw, 2.5rem);
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
            grid-template-columns: repeat(auto-fit, minmax(clamp(250px, 45vw, 300px), 1fr));
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
            flex-wrap: wrap;
        }

        .chart-title {
            font-family: var(--font-display);
            font-size: clamp(1rem, 3vw, 1.25rem);
            font-weight: 600;
        }

        .chart-btn {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .chart-btn:hover {
            color: var(--primary-light);
        }

        .activity-feed {
            max-height: 300px;
            overflow-y: auto;
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
            width: clamp(30px, 8vw, 40px);
            height: clamp(30px, 8vw, 40px);
            background: var(--glass-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(0.875rem, 2vw, 1rem);
            color: var(--primary);
        }

        .activity-content h5 {
            font-size: clamp(0.75rem, 2vw, 0.875rem);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .activity-content p {
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            color: var(--gray-400);
        }

        .activity-time {
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            color: var(--gray-500);
            margin-left: auto;
        }

        .tool-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(clamp(150px, 30vw, 200px), 1fr));
            gap: var(--space-lg);
            margin-bottom: var(--space-2xl);
        }

        .tool-card {
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

        .tool-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .tool-card-icon {
            width: clamp(36px, 10vw, 48px);
            height: clamp(36px, 10vw, 48px);
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1rem, 3vw, 1.25rem);
            color: var(--white);
            margin: 0 auto var(--space-md);
        }

        .tool-card h4 {
            font-weight: 600;
            margin-bottom: var(--space-sm);
        }

        .tool-card p {
            font-size: clamp(0.75rem, 2vw, 0.875rem);
            color: var(--gray-400);
        }

        .premium-lock {
            color: var(--error);
            font-size: 0.75rem;
            margin-top: var(--space-sm);
        }

        .theme-toggle {
            position: fixed;
            top: var(--space-xl);
            right: var(--space-xl);
            z-index: 1001;
        }

        .theme-btn {
            width: clamp(40px, 10vw, 48px);
            height: clamp(40px, 10vw, 48px);
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
            width: clamp(48px, 12vw, 64px);
            height: clamp(48px, 12vw, 64px);
            background: var(--gradient-primary);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1.25rem, 4vw, 1.5rem);
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
            width: clamp(280px, 80vw, 360px);
            height: clamp(360px, 60vh, 480px);
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

        body.light .content {
            background: var(--dark-bg);
            color: var(--white);
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
        body.light .user-info {
            color: var(--gray-500);
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

            .tool-grid {
                grid-template-columns: 1fr;
            }

            .top-nav {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--space-md);
            }

            .nav-right {
                width: 100%;
                justify-content: flex-end;
            }
        }

        @media (max-width: 640px) {
            .sidebar {
                width: clamp(160px, 50vw, 240px);
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

            .nav-list li a,
            .nav-list li button {
                padding: var(--space-md) var(--space-lg);
            }

            .search-container {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: clamp(140px, 45vw, 200px);
            }

            .logo {
                width: clamp(28px, 8vw, 40px);
                height: clamp(28px, 8vw, 40px);
                font-size: clamp(0.875rem, 3vw, 1.25rem);
            }

            .brand-text h1 {
                font-size: clamp(0.875rem, 3vw, 1.25rem);
            }

            .brand-text p {
                font-size: clamp(0.5rem, 2vw, 0.75rem);
            }

            .nav-section-title {
                font-size: clamp(0.5rem, 2vw, 0.75rem);
                padding-left: var(--space-sm);
            }

            .nav-list li a,
            .nav-list li button {
                padding: var(--space-md) var(--space-md);
            }
        }

        @media (max-width: 360px) {
            .sidebar {
                width: clamp(120px, 40vw, 180px);
            }

            .logo {
                width: clamp(24px, 8vw, 32px);
                height: clamp(24px, 8vw, 32px);
                font-size: clamp(0.75rem, 3vw, 1rem);
            }

            .brand-text h1 {
                font-size: clamp(0.75rem, 2vw, 1rem);
            }

            .brand-text p {
                font-size: clamp(0.5rem, 2vw, 0.625rem);
            }

            .nav-section-title {
                font-size: clamp(0.5rem, 2vw, 0.75rem);
                padding-left: var(--space-sm);
            }

            .nav-section-title::before {
                width: 2px;
                height: 12px;
            }

            .nav-list li a,
            .nav-list li button {
                padding: var(--space-md) var(--space-sm);
            }

            .search-container {
                max-width: 100%;
            }

            .search-input {
                padding: var(--space-md) var(--space-lg) var(--space-md) 2rem;
            }
        }
    </style>
</head>

<body>
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
                <ul class="nav-list">
                    <li><a href="#home" class="active"><i class="bi bi-grid nav-icon"></i> Home</a></li>
                    <li><a href="#free-apps"><i class="bi bi-code-slash nav-icon"></i> Free Apps</a></li>
                    <li><a href="#premium-features"><i class="bi bi-lock nav-icon"></i> Premium Features <span class="nav-badge">Pro</span></a></li>
                    <li><a href="#community"><i class="bi bi-people nav-icon"></i> Community</a></li>
                    <li><a href="#support"><i class="bi bi-question-circle nav-icon"></i> Support <span class="nav-badge">New</span></a></li>
                </ul>
            </nav>
            <nav class="nav-section">
                <div class="nav-section-title">Account</div>
                <ul class="nav-list">
                    <li><a href="#profile"><i class="bi bi-person nav-icon"></i> Profile</a></li>
                    <li><a href="#settings"><i class="bi bi-gear nav-icon"></i> Settings</a></li>
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
                            <div class="user-avatar">U</div>
                            <div class="user-info">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p>Free Tier</p>
                            </div>
                            <i class="bi bi-chevron-down dropdown-icon"></i>
                        </div>
                        <div class="user-dropdown">
                            <a href="#profile" class="dropdown-item">
                                <i class="bi bi-person"></i> Profile
                            </a>
                            <a href="#settings" class="dropdown-item">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                            <a href="#subscription" class="dropdown-item">
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
                <div class="content-header">
                    <h2 class="page-title">Welcome to Your Hacking Hub</h2>
                    <p class="page-subtitle">Access free and premium tools to code, hack, sniff, and dominate.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-code-slash"></i></div>
                        </div>
                        <div class="stat-value">8</div>
                        <div class="stat-label">Tools Used</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-star"></i></div>
                        </div>
                        <div class="stat-value">5</div>
                        <div class="stat-label">Favorites</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-trophy"></i></div>
                        </div>
                        <div class="stat-value">12</div>
                        <div class="stat-label">Community Rank</div>
                    </div>
                </div>

                <div class="chart-section">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Tool Usage</h3>
                        </div>
                        <canvas id="toolUsageChart"></canvas>
                    </div>
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Recent Activity</h3>
                            <a href="#activity" class="chart-btn">View All</a>
                        </div>
                        <div class="activity-feed">
                            <div class="activity-item">
                                <div class="activity-icon"><i class="bi bi-code-slash"></i></div>
                                <div class="activity-content">
                                    <h5>Tool Launched</h5>
                                    <p>You ran the Packet Sniffer tool.</p>
                                </div>
                                <div class="activity-time">30m ago</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="bi bi-people"></i></div>
                                <div class="activity-content">
                                    <h5>Community Post</h5>
                                    <p>You posted in the Hacking Forum.</p>
                                </div>
                                <div class="activity-time">2h ago</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="bi bi-lock"></i></div>
                                <div class="activity-content">
                                    <h5>Premium Unlocked</h5>
                                    <p>You accessed the SQL Injector tool.</p>
                                </div>
                                <div class="activity-time">5h ago</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tool-grid">
                    <a href="#code-editor" class="tool-card">
                        <div class="tool-card-icon"><i class="bi bi-code-slash"></i></div>
                        <h4>Code Editor</h4>
                        <p>Launch a free coding IDE.</p>
                    </a>
                    <a href="#password-cracker" class="tool-card">
                        <div class="tool-card-icon"><i class="bi bi-shield-lock"></i></div>
                        <h4>Password Cracker</h4>
                        <p>Free tool to test passwords.</p>
                    </a>
                    <a href="#packet-sniffer" class="tool-card">
                        <div class="tool-card-icon"><i class="bi bi-wifi"></i></div>
                        <h4>Packet Sniffer</h4>
                        <p>Premium sniffing tool.</p>
                        <p class="premium-lock">Premium Required</p>
                    </a>
                    <a href="#bot-builder" class="tool-card">
                        <div class="tool-card-icon"><i class="bi bi-robot"></i></div>
                        <h4>Bot Builder</h4>
                        <p>Create custom bots.</p>
                    </a>
                    <a href="#hacking-os" class="tool-card">
                        <div class="tool-card-icon"><i class="bi bi-terminal"></i></div>
                        <h4>Hacking OS</h4>
                        <p>Premium OS environment.</p>
                        <p class="premium-lock">Premium Required</p>
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
                        response.textContent = 'Our team will help you unleash chaos soon!';
                        chatMessages.appendChild(response);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 1000);

                    chatInput.value = '';
                }
            });

            const toolUsageChart = new Chart(document.getElementById('toolUsageChart'), {
                type: 'bar',
                data: {
                    labels: ['Coding', 'Hacking', 'Sniffing', 'Bots', 'OS'],
                    datasets: [{
                        label: 'Usage Count',
                        data: [20, 15, 10, 8, 5],
                        backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#6366f1', '#0ea5e9'],
                        borderRadius: 8
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
                            }
                        },
                        x: {
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    }
                }
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>