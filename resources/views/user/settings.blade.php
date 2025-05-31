@extends('user.layouts.app')

@section('title')
Settings
@endsection

@section('description')
Customize your dashboard experience with theme and notification settings.
@endsection

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
        font-weight: bold;
        margin-bottom: var(--space-sm);
        background: var(--gradient-primary);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .page-subtitle {
        color: var(--gray-400);
        font-size: clamp(.875rem, 3vw, 1rem);
    }

    .settings-panel {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: var(--glass-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
    }

    .settings-group {
        margin-bottom: var(--space-lg);
    }

    .group-title {
        font-weight: 600;
        color: var(--white);
        margin-bottom: var(--space-md);
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        margin-bottom: var(--space-md);
    }

    .form-label {
        color: var(--gray-300);
        font-weight: 500;
        width: 150px;
    }

    .form-select,
    .form-checkbox {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-md);
        padding: var(--space-sm);
        color: var(--white);
    }

    .form-select:focus {
        outline: none;
        border-color: var(--primary);
    }

    .save-button {
        background: var(--gradient-primary);
        color: var(--white);
        padding: var(--space-md) var(--space-xl);
        border: none;
        border-radius: var(--radius-md);
        cursor: pointer;
        font-weight: bold;
    }

    .save-button:hover {
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

    @media only screen and (max-width: 768px) {
        .form-group {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-label {
            width: 100%;
        }

    }
</style>

<div class="content-header">
    <h2 class="page-title">Settings</h2>
    <p class="page-subtitle">Tweak your preferences for a personalized experience.</p>
</div>

<div class="settings-panel">
    <form method="POST" action="#update-settings">
        @csrf
        <div class="settings-group">
            <div class="group-title">Appearance</div>
            <div class="form-group">
                <label for="theme" class="form-label">Theme</label>
                <select id="theme" name="theme" class="form-select">
                    <option value="dark">Dark</option>
                    <option value="light">Light</option>
                </select>
            </div>
        </div>
        <div class="settings-group">
            <div class="group-title">Notifications</div>
            <div class="form-group">
                <label for="email-notifications" class="form-label">Email Notifications</label>
                <input type="checkbox" id="email-notifications" name="email_notifications" class="form-checkbox">
            </div>
            <div class="form-group">
                <label for="push-notifications" class="form-label">Push Notifications</label>
                <input type="checkbox" id="push-notifications" name="push_notifications" class="form-checkbox">
            </div>
        </div>
        <button type="submit" class="save-button">Save Settings</button>
    </form>
</div>
@endsection