@extends('user.layouts.app')

@section('title', 'User Dashboard')

@section('description', 'Access your hacking hub with free and premium tools.')

@section('content')
    <style>
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .activity-icon {
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

        .activity-content h5 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .activity-content p {
            font-size: 12px;
            color: #9ca3af;
        }

        .activity-time {
            font-size: 12px;
            color: #6b7280;
            margin-left: auto;
        }
    </style>

    <div class="content-header">
        <h2 class="page-title">Welcome to Your Hacking Hub</h2>
        <p class="page-subtitle">Access free and premium tools to code, hack, and dominate.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon"><i class="bi bi-code-slash"></i></div>
            </div>
            <div class="stat-value" id="toolsUsed">{{ $stats['toolsUsed'] }}</div>
            <div class="stat-label">Tools Available</div>
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
            <div class="activity-feed" id="activityFeed">
                @foreach ($activities as $activity)
                    <div class="activity-item">
                        <div class="activity-icon"><i class="bi {{ $activity['icon'] }}"></i></div>
                        <div class="activity-content">
                            <h5>{{ $activity['title'] }}</h5>
                            <p>{{ $activity['description'] }}</p>
                        </div>
                        <div class="activity-time">{{ $activity['time'] }}</div>
                    </div>
                @endforeach
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

    @push('scripts')
        <script>
            window.toolUsageChart = new Chart(document.getElementById('toolUsageChart'), {
                type: 'bar',
                data: {
                    labels: ['Coding', 'Hacking', 'Sniffing', 'Bots', 'OS'],
                    datasets: [{
                        label: 'Tool Count',
                        data: [{{ $stats['toolsUsed'] * 0.4 }}, {{ $stats['toolsUsed'] * 0.3 }}, {{ $stats['toolsUsed'] * 0.2 }}, {{ $stats['toolsUsed'] * 0.1 }}, {{ $stats['toolsUsed'] * 0.05 }}],
                        backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#6366f1', '#0ea5e9'],
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { color: 'rgba(255, 255, 255, 0.7)' } },
                        x: { ticks: { color: 'rgba(255, 255, 255, 0.7)' } }
                    }
                }
            });
        </script>
    @endpush
@endsection
