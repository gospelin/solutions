@extends('user.layouts.app')

@section('title', 'Support')

@section('description', 'Get help with tools, report issues, or contact our support team.')

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

    .ticket-form {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        margin-bottom: var(--space-2xl);
    }

    .form-group {
        margin-bottom: var(--space-md);
    }

    .form-label {
        color: var(--gray-300);
        font-weight: 500;
        margin-bottom: var(--space-sm);
    }

    .form-input,
    .form-textarea {
        width: 100%;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-md);
        padding: var(--space-md);
        color: var(--white);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
    }

    .submit-button {
        background: var(--gradient-primary);
        color: var(--white);
        padding: var(--space-md) var(--space-xl);
        border: none;
        border-radius: var(--radius-md);
        cursor: pointer;
        font-weight: 600;
    }

    .submit-button:hover {
        transform: scale(1.05);
    }

    .ticket-list {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
    }

    .ticket-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
    }

    .ticket-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: var(--space-md);
    }

    .ticket-title {
        font-weight: 600;
        color: var(--white);
    }

    .ticket-status {
        color: var(--success);
        font-size: 0.875rem;
    }

    .ticket-status.closed {
        color: var(--error);
    }

    .ticket-content {
        color: var(--gray-300);
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
        .ticket-form {
            padding: var(--space-md);
        }
    }
</style>

<div class="content-header">
    <h2 class="page-title">Support Center</h2>
    <p class="page-subtitle">Submit a ticket or view your existing issues.</p>
</div>

<div class="ticket-form">
    <form method="POST" action="#submit-ticket">
        @csrf
        <div class="form-group">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" id="subject" class="form-input" placeholder="Enter ticket subject" required>
        </div>
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-textarea" placeholder="Describe your issue..." required></textarea>
        </div>
        <button type="submit" class="submit-button">Submit Ticket</button>
    </form>
</div>

<div class="ticket-list">
    <div class="ticket-card">
        <div class="ticket-header">
            <div class="ticket-title">Packet Sniffer Not Working</div>
            <div class="ticket-status">Open</div>
        </div>
        <div class="ticket-content">The sniffer tool crashes when analyzing large packets. Need help ASAP.</div>
    </div>
    <div class="ticket-card">
        <div class="ticket-header">
            <div class="ticket-title">Bot Builder Error</div>
            <div class="ticket-status closed">Closed</div>
        </div>
        <div class="ticket-content">Fixed the proxy issue with the bot builder. Thanks for the support!</div>
    </div>
</div>
@endsection