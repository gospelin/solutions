@extends('user.layouts.app')

@section('title', 'Community')

@section('description', 'Join the hacking community, share exploits, and discuss tools.')

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

    .post-form {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        margin-bottom: var(--space-2xl);
    }

    .post-input {
        width: 100%;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-md);
        padding: var(--space-md);
        color: var(--white);
        margin-bottom: var(--space-md);
    }

    .post-input:focus {
        outline: none;
        border-color: var(--primary);
    }

    .post-button {
        background: var(--gradient-primary);
        color: var(--white);
        padding: var(--space-md) var(--space-xl);
        border: none;
        border-radius: var(--radius-md);
        cursor: pointer;
        font-weight: 600;
    }

    .post-button:hover {
        transform: scale(1.05);
    }

    .post-list {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
    }

    .post-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
    }

    .post-header {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        margin-bottom: var(--space-md);
    }

    .post-avatar {
        width: 40px;
        height: 40px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .post-author {
        font-weight: 600;
        color: var(--white);
    }

    .post-time {
        color: var(--gray-400);
        font-size: 0.875rem;
    }

    .post-content {
        color: var(--gray-300);
        margin-bottom: var(--space-md);
    }

    .post-actions {
        display: flex;
        gap: var(--space-md);
    }

    .action-link {
        color: var(--primary);
        text-decoration: none;
        font-size: 0.875rem;
    }

    .action-link:hover {
        color: var(--primary-light);
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
        .post-form {
            padding: var(--space-md);
        }
    }
</style>

<div class="content-header">
    <h2 class="page-title">Community Forum</h2>
    <p class="page-subtitle">Share exploits, discuss tools, and connect with hackers.</p>
</div>

<div class="post-form">
    <form method="POST" action="#post">
        @csrf
        <textarea class="post-input" placeholder="Share your latest hack or ask a question..." rows="4"></textarea>
        <button type="submit" class="post-button">Post</button>
    </form>
</div>

<div class="post-list">
    <div class="post-card">
        <div class="post-header">
            <div class="post-avatar">H</div>
            <div>
                <div class="post-author">HackerX</div>
                <div class="post-time">2h ago</div>
            </div>
        </div>
        <div class="post-content">Just cracked a Wi-Fi network with the new sniffer tool. Anyone got tips for stealth mode?</div>
        <div class="post-actions">
            <a href="#comment" class="action-link">Comment (3)</a>
            <a href="#like" class="action-link">Like (12)</a>
        </div>
    </div>
    <div class="post-card">
        <div class="post-header">
            <div class="post-avatar">C</div>
            <div>
                <div class="post-author">CodeNinja</div>
                <div class="post-time">5h ago</div>
            </div>
        </div>
        <div class="post-content">Built a bot with the free builder. It’s scraping data like a beast! Need help with proxies.</div>
        <div class="post-actions">
            <a href="#comment" class="action-link">Comment (7)</a>
            <a href="#like" class="action-link">Like (25)</a>
        </div>
    </div>
</div>
@endsection