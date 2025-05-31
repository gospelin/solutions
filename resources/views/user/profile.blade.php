@extends('user.layouts.app')

@section('title', 'Profile')

@section('description', 'Manage your profile information and view your hacking stats.')

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
        margin-bottom: .5rem;
        background: var(--gradient-primary);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .page-subtitle {
        color: var(--gray-400);
        font-size: clamp(.875rem, 3vw, 1rem);
    }

    .profile-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        margin-bottom: var(--space-2xl);
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: var(--space-lg);
        margin-bottom: var(--space-lg);
    }

    .profile-avatar {
        width: clamp(80px, 15vw, 120px);
        height: clamp(80px, 15vw, 120px);
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(1.5rem, 4vw, 2rem);
        font-weight: 700;
        color: var(--white);
    }

    .profile-info h3 {
        font-weight: clamp(.6rem, 2vw, 1rem);
        color: var(--white);
        margin-bottom: var(--space-sm);
    }

    .profile-info p {
        font-size: clamp(.75rem, 2vw, .875rem);
        color: var(--gray-400);
    }

    .profile-form {
        display: grid;
        gap: var(--space-md);
    }

    .form-group {
        margin-bottom: var(--space-md);
    }

    .form-label {
        color: var(--gray-300);
        font-weight: 500;
        margin-bottom: var(--space-sm);
    }

    .form-input {
        width: 100%;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-md);
        padding: var(--space-md);
        color: var(--white);
    }

    .form-input:focus {
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

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    }
</style>

<div class="content-header">
    <h2 class="page-title">Your Profile</h2>
    <p class="page-subtitle">Update your details and check your hacking stats.</p>
</div>

<div class="profile-card">
    <div class="profile-header">
        <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div class="profile-info">
            <h3>{{ auth()->user()->name }}</h3>
            <p>{{ auth()->user()->email }}</p>
            <p>Member since {{ auth()->user()->created_at->format('F Y') }}</p>
        </div>
    </div>
    <div class="profile-form">
        <form method="POST" action="#update-profile">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="form-input" value="{{ auth()->user()->name }}" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="form-input" value="{{ auth()->user()->email }}" required>
            </div>
            <button type="submit" class="save-button">Save Changes</button>
        </form>
    </div>

</div>
@endsection