@extends('admin.layouts.app')

@section('title', 'Personal Settings')

@section('description', 'Customize your personal preferences.')

@push('styles')
    <style>
        .settings-container {
            padding: var(--space-lg);
            background: var(--dark-bg);
            min-height: 100vh;
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .content-header {
            margin-bottom: var(--space-xl);
        }

        .page-title {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 5vw, 2rem);
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-subtitle {
            color: var(--gray-400);
            font-size: clamp(0.875rem, 3vw, 1rem);
        }

        .chart-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-lg);
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(20px);
        }

        .chart-header {
            margin-bottom: var(--space-md);
        }

        .chart-title {
            font-family: var(--font-display);
            font-size: clamp(1.25rem, 4vw, 1.5rem);
            color: var(--white);
            font-weight: 600;
        }

        .modal-form {
            display: flex;
            flex-direction: column;
            gap: var(--space-md);
        }

        .form-group {
            display: flex;
            align-items: center;
            gap: var(--space-md);
        }

        .form-group label {
            color: var(--gray-300);
            font-weight: 500;
            width: 150px;
            font-size: clamp(0.875rem, 2.5vw, 1rem);
        }

        .form-input {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--space-sm) var(--space-md);
            color: var(--white);
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            width: 100%;
            max-width: 300px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .form-submit {
            position: relative;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--space-md) var(--space-xl);
            color: var(--success);
            font-weight: 600;
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            display: inline-flex;
            align-items: center;
            gap: var(--space-xs);
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-submit:hover {
            background: var(--success);
            border-color: var(--success);
            color: var(--white);
            transform: scale(1.02);
        }

        .form-submit .tooltip {
            position: absolute;
            top: -2.5rem;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark-bg);
            color: var(--white);
            padding: var(--space-xs) var(--space-sm);
            border-radius: var(--radius-sm);
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 20;
        }

        .form-submit:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }

        /* Light Theme */
        body.light .settings-container {
            background: var(--gray-50);
        }

        body.light .page-title {
            background: none;
            -webkit-text-fill-color: var(--primary);
        }

        body.light .page-subtitle {
            color: var(--gray-400);
        }

        body.light .chart-card {
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .form-group label {
            color: var(--gray-300);
        }

        body.light .form-input {
            color: var(--gray-300);
        }

        body.light .form-submit {
            color: var(--success);
        }

        body.light .form-submit:hover {
            color: var(--white);
        }

        body.light .form-submit .tooltip {
            background: var(--gray-50);
            color: var(--gray-300);
        }

        /* Accessibility */
        .form-input:focus,
        .form-submit:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .settings-container {
                padding: var(--space-md);
            }

            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-group label {
                width: 100%;
                margin-bottom: var(--space-sm);
            }

            .form-input {
                max-width: 100%;
            }

            .form-submit {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <section class="settings-container">
        <div class="content-header">
            <h1 class="page-title">Personal Settings</h1>
            <p class="page-subtitle">Adjust your account preferences.</p>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Account Preferences</h3>
            </div>
            <form class="modal-form" method="POST" action="{{ route('admin.admin-settings.update') }}" role="form"
                aria-label="Update admin settings">
                @csrf
                <div class="form-group">
                    <label for="theme" class="form-label">Theme</label>
                    <select id="theme" name="theme" class="form-input" aria-label="Select theme">
                        <option value="dark" {{ old('theme', auth()->user()->theme ?? 'dark') === 'dark' ? 'selected' : '' }}>
                            Dark</option>
                        <option value="light" {{ old('theme', auth()->user()->theme ?? 'dark') === 'light' ? 'selected' : '' }}>Light</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notifications" class="form-label">Email Notifications</label>
                    <select id="notifications" name="notifications" class="form-input"
                        aria-label="Select email notifications">
                        <option value="1" {{ old('notifications', auth()->user()->notifications ?? 1) == 1 ? 'selected' : '' }}>Enabled</option>
                        <option value="0" {{ old('notifications', auth()->user()->notifications ?? 1) == 0 ? 'selected' : '' }}>Disabled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="language" class="form-label">Language</label>
                    <select id="language" name="language" class="form-input" aria-label="Select language">
                        <option value="en" {{ old('language', auth()->user()->language ?? 'en') === 'en' ? 'selected' : '' }}>
                            English</option>
                        <option value="es" {{ old('language', auth()->user()->language ?? 'en') === 'es' ? 'selected' : '' }}>
                            Spanish</option>
                    </select>
                </div>
                <button type="submit" class="form-submit" aria-label="Save settings">
                    <i class="bi bi-save"></i> Save Settings
                    <span class="tooltip">Save Changes</span>
                </button>
            </form>
        </div>
    </section>
@endsection

