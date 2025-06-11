<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin Dashboard</title>
    <meta name="description" content="Manage users, tools, and transactions with real-time analytics.">
    <meta name="keywords" content="admin dashboard, AI analytics, user management, tool moderation, Mr Solution">
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

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- Pusher and Laravel Echo -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/admin.css', 'resources/js/bootstrap.js', 'resources/js/admin.js', 'resources/js/realtime.js'])

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

    <meta name="auth-id" content="{{ Auth::id() }}">

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
            <section class="content">
                <div class="content-header">
                    <h1 class="page-title">Admin Dashboard</h1>
                    <p class="page-subtitle">Welcome, {{ Auth::user()->name }}! Manage your platform with real-time
                        data.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card" id="totalUsers">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-people"></i></div>
                            <div class="stat-trend {{ $userTrendStatus }}">
                                <i
                                    class="bi bi-arrow-circle-{{ $userTrendStatus === 'up' ? 'up-right' : ($userTrendStatus === 'down' ? 'down-right' : 'right-circle') }}"></i>
                                <span>{{ $userTrendValue }}</span>
                            </div>
                        </div>
                        <h3 class="stat-value">{{ number_format($totalUsers) }}</h3>
                        <p class="label stat-label">Total Users</p>
                    </div>
                    <div class="stat-card secondary" id="totalTools">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-tools"></i></div>
                            <div class="stat-trend {{ $toolTrendStatus }}">
                                <i
                                    class="bi bi-arrow-circle-{{ $toolTrendStatus === 'up' ? 'up-right' : ($toolTrendStatus === 'down' ? 'down-right' : 'right-circle') }}"></i>
                                <span>{{ $toolTrendValue }}</span>
                            </div>
                        </div>
                        <h3 class="stat-value">{{ number_format($totalTools) }}</h3>
                        <p class="label stat-label">Active Tools</p>
                    </div>
                    <div class="stat-card accent" id="totalRevenue">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
                            <div class="stat-trend {{ $revenueTrendStatus }}">
                                <i
                                    class="bi bi-arrow-circle-{{ $revenueTrendStatus === 'up' ? 'up-right' : ($revenueTrendStatus === 'down' ? 'down-right' : 'right-circle') }}"></i>
                                <span>{{ $revenueTrendValue }}</span>
                            </div>
                        </div>
                        <h3 class="stat-value">${{ number_format($totalRevenue, 2) }}</h3>
                        <p class="label stat-label">Revenue</p>
                    </div>
                    <div class="stat-card success" id="contactCount">
                        <div class="stat-header">
                            <div class="stat-icon"><i class="bi bi-envelope"></i></div>
                            <div class="stat-trend {{ $contactTrendStatus }}">
                                <i
                                    class="bi bi-arrow-circle-{{ $contactTrendStatus === 'up' ? 'up-right' : ($contactTrendStatus === 'down' ? 'down-right' : 'right-circle') }}"></i>
                                <span>{{ $contactTrendValue }}</span>
                            </div>
                        </div>
                        <h3 class="stat-value">{{ number_format($contactCount) }}</h3>
                        <p class="label stat-label">Contact Submissions</p>
                    </div>
                </div>

                <div class="chart-section">
                    <div class="chart-card" data-user-growth="{{ json_encode($userGrowthData ?? [0, 0, 0, 0, 0, 0]) }}"
                        data-labels="{{ json_encode($labels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) }}">
                        <div class="chart-header">
                            <h4 class="chart-title">User Growth</h4>
                            <div class="chart-actions">
                                <button class="chart-btn active">Day</button>
                                <button class="chart-btn">Week</button>
                                <button class="chart-btn">Month</button>
                            </div>
                        </div>
                        <canvas id="userGrowthChart"></canvas>
                    </div>
                    <div class="chart-card">
                        <div class="chart-header">
                            <h4 class="chart-title">Recent Activity</h4>
                        </div>
                        @foreach ($recentActivities as $activity)
                            <div class="activity-item">
                                <div class="activity-icon"><i class="bi {{ $activity['icon'] }}"></i></div>
                                <div class="activity-content">
                                    <h5>{{ $activity['title'] }}</h5>
                                    <p>{{ $activity['description'] }}</p>
                                </div>
                                <span class="activity-time">{{ $activity['time'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                @include('admin.partials.quick-action')
            </section>
        </main>
        <div class="theme-toggle">
            <button class="theme-btn" id="themeToggle" title="Toggle Theme">
                <i class="bi bi-moon-stars"></i>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chartCard = document.querySelector('.chart-card[data-user-growth]');
            const userGrowthData = chartCard ? JSON.parse(chartCard.dataset.userGrowth) : [0, 0, 0, 0, 0, 0];
            const labels = chartCard ? JSON.parse(chartCard.dataset.labels) : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];

            // Validate data to ensure it's an array of numbers
            const validatedData = Array.isArray(userGrowthData)
                ? userGrowthData.map(val => isFinite(val) ? Number(val) : 0)
                : [0, 0, 0, 0, 0, 0];

            const ctx = document.getElementById('userGrowthChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'User Growth',
                        data: validatedData,
                        backgroundColor: 'rgba(99, 102, 241, 0.5)',
                        borderColor: '#6366f1',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'var(--gray-300)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: 'var(--gray-300)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>