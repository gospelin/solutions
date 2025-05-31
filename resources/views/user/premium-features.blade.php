@extends('user.layouts.app')

@section('title', 'Premium Features')

@section('description', 'Unlock exclusive tools like packet sniffers and hacking OS with a premium subscription.')

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

    .cta-button {
        display: inline-block;
        background: var(--gradient-primary);
        color: var(--white);
        padding: var(--space-md) var(--space-xl);
        border-radius: var(--radius-lg);
        text-decoration: none;
        font-weight: 600;
        transition: transform 0.2s ease;
    }

    .cta-button:hover {
        transform: scale(1.05);
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

    @media (max-width: 768px) {
        .tool-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="content-header">
    <h2 class="page-title">Premium Features</h2>
    <p class="page-subtitle">Unlock elite tools for advanced hacking and sniffing. Upgrade now!</p>
</div>

<div class="tool-grid">
    <a href="#packet-sniffer" class="tool-card">
        <div class="tool-card-icon"><i class="bi bi-wifi"></i></div>
        <h4>Packet Sniffer</h4>
        <p>Capture and analyze network packets in real-time.</p>
        <p class="premium-lock">Premium Required</p>
    </a>
    <a href="#hacking-os" class="tool-card">
        <div class="tool-card-icon"><i class="bi bi-terminal"></i></div>
        <h4>Hacking OS</h4>
        <p>Run a dedicated OS for penetration testing.</p>
        <p class="premium-lock">Premium Required</p>
    </a>
    <a href="#sql-injector" class="tool-card">
        <div class="tool-card-icon"><i class="bi bi-database"></i></div>
        <h4>SQL Injector</h4>
        <p>Test database vulnerabilities with automated scripts.</p>
        <p class="premium-lock">Premium Required</p>
    </a>
    <a href="#ddos-tool" class="tool-card">
        <div class="tool-card-icon"><i class="bi bi-cloud-slash"></i></div>
        <h4>DDoS Simulator</h4>
        <p>Simulate distributed denial-of-service attacks.</p>
        <p class="premium-lock">Premium Required</p>
    </a>
</div>

<div style="text-align: center;">
    <a href="{{ route('subscription') }}" class="cta-button">Upgrade to Premium</a>
</div>
@endsection