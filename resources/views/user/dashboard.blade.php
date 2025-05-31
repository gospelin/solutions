@extends('user.layouts.app')

@section('title', 'User Dashboard')

@section('description', 'Access your hacking hub with free and premium tools for coding, hacking, sniffing, OS, and bots.')

@section('content')
<style>
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
    }
</style>

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
@endsection

@section('scripts')
<script>
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
</script>
@endsection
