@extends('user.layouts.app')

@section('title', 'Profile Settings')

@section('description', 'Manage your profile information, update your password, or delete your account in your hacking hub.')

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

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(clamp(300px, 45vw, 400px), 1fr));
        gap: var(--space-lg);
        margin-bottom: var(--space-2xl);
    }

    .profile-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .card-title {
        font-family: var(--font-display);
        font-size: clamp(1.25rem, 4vw, 1.5rem);
        font-weight: 600;
        color: var(--white);
        margin-bottom: var(--space-md);
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

    body.light .profile-card {
        background: rgba(0, 0, 0, 0.02);
        border-color: rgba(0, 0, 0, 0.1);
    }

    body.light .card-title {
        color: var(--gray-900);
    }

    @media (max-width: 768px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="content">
    <div class="content-header">
        <h2 class="page-title">Profile Settings</h2>
        <p class="page-subtitle">Manage your profile, update your password, or delete your account.</p>
    </div>

    <div class="profile-grid">
        <!-- Update Profile Information -->
        <div class="profile-card">
            <h3 class="card-title">Update Profile Information</h3>
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="profile-card">
            <h3 class="card-title">Update Password</h3>
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete Account -->
        <div class="profile-card">
            <h3 class="card-title">Delete Account</h3>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection