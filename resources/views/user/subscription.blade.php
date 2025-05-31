@extends('user.layouts.app')

@section('title', 'Subscription')

@section('description', 'Choose a premium plan to unlock exclusive hacking tools.')

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

    .plan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(clamp(200px, 40vw, 280px), 1fr));
        gap: var(--space-lg);
        margin-bottom: var(--space-2xl);
    }

    .plan-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .plan-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .plan-title {
        font-weight: 600;
        color: var(--white);
        margin-bottom: var(--space-sm);
    }

    .plan-price {
        font-size: clamp(1.5rem, 5vw, 2rem);
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: var(--space-md);
    }

    .plan-features {
        list-style: none;
        padding: 0;
        color: var(--gray-300);
        margin-bottom: var(--space-md);
    }

    .plan-features li {
        margin-bottom: var(--space-sm);
    }

    .plan-button {
        background: var(--gradient-primary);
        color: var(--white);
        padding: var(--space-md) var(--space-xl);
        border: none;
        border-radius: var(--radius-md);
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
    }

    .plan-button:hover {
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
        .plan-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="content-header">
    <h2 class="page-title">Subscription Plans</h2>
    <p class="page-subtitle">Upgrade to access premium tools and dominate the hacking world.</p>
</div>

<div class="plan-grid">
    <div class="plan-card">
        <div class="plan-title">Free Tier</div>
        <div class="plan-price">$0/month</div>
        <ul class="plan-features">
            <li>Access to free tools</li>
            <li>Community forum access</li>
            <li>Basic support</li>
        </ul>
        <a href="#" class="plan-button" disabled>Current Plan</a>
    </div>
    <div class="plan-card">
        <div class="plan-title">Pro Tier</div>
        <div class="plan-price">$19.99/month</div>
        <ul class="plan-features">
            <li>All free tools</li>
            <li>Premium tools (Sniffer, OS, etc.)</li>
            <li>Priority support</li>
            <li>Exclusive community channels</li>
        </ul>
        <a href="#upgrade" class="plan-button">Upgrade Now</a>
    </div>
</div>
@endsection