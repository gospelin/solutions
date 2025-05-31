@extends('user.layouts.app')

@section('title', 'Free Apps')

@section('description', 'Explore free tools for coding, password cracking, and bot building in your hacking hub.')

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
    <h2 class="page-title">Free Apps</h2>
    <p class="page-subtitle">Access powerful free tools to kickstart your hacking journey.</p>
</div>

<div class="tool-grid">
    <a href="#code-editor" class="tool-card">
        <div class="tool-card-icon"><i class="bi bi-code-slash"></i></div>
        <h4>Code Editor</h4>
        <p>Launch a free coding IDE with syntax highlighting.</p>
    </a>
    <a href="#password-cracker" class="tool-card">
        <div class="tool-card-icon"><i class="bi bi-shield-lock"></i></div>
        <h4>Password Cracker</h4>
        <p>Test password strength with brute-force simulations.</p>
    </a>
    <a href="#bot-builder" class="tool-card">
        <div class="tool-card-icon"><i class="bi bi-robot"></i></div>
        <h4>Bot Builder</h4>
        <p>Create custom bots for automation tasks.</p>
    </a>
    <a href="#network-scanner" class="tool-card">
        <div class="tool-card-icon"><i class="bi bi-wifi"></i></div>
        <h4>Network Scanner</h4>
        <p>Scan local networks for devices and vulnerabilities.</p>
    </a>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any JavaScript functionality if needed
    });
</script>
@endsection
