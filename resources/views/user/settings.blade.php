@extends('user.layouts.app')

@section('title')
Settings
@endsection

@section('description')
Customize your dashboard experience with theme and notification settings.
@endsection

@push('styles')
    <style>
        .settings-container {
            flex: 1;
            padding: var(--space-xl);
            background: var(--dark-bg);
            min-height: 100vh;
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
        }

        .page-subtitle {
            color: var(--gray-400);
            font-size: clamp(0.875rem, 3vw, 1rem);
        }

        .settings-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: var(--space-lg);
            box-shadow: var(--shadow-lg);
        }

        .settings-group {
            margin-bottom: var(--space-lg);
        }

        .group-title {
            font-weight: 600;
            color: var(--white);
            margin-bottom: var(--space-md);
            font-size: clamp(1rem, 3.5vw, 1.25rem);
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
            font-size: clamp(0.875rem, 2.5vw, 1rem);
        }

        .form-select,
        .form-checkbox {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--space-sm) var(--space-md);
            color: var(--white);
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            transition: all 0.3s ease;
        }

        .form-select:focus,
        .form-checkbox:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .save-button {
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

        .save-button:hover {
            background: var(--success);
            border-color: var(--success);
            color: var(--white);
            transform: scale(1.02);
        }

        .save-button .tooltip {
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

        .save-button:hover .tooltip {
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
            color: var(--gray-500);
        }

        body.light .settings-panel {
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .form-label {
            color: var(--gray-300);
        }

        body.light .form-select,
        body.light .form-checkbox {
            color: var(--gray-300);
        }

        body.light .save-button {
            color: var(--success);
        }

        body.light .save-button:hover {
            color: var(--white);
        }

        body.light .save-button .tooltip {
            background: var(--gray-50);
            color: var(--gray-300);
        }

        /* Accessibility */
        .form-select:focus,
        .form-checkbox:focus,
        .save-button:focus {
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

            .form-label {
                width: 100%;
                margin-bottom: var(--space-sm);
            }

            .form-select,
            .form-checkbox {
                width: 100%;
            }

            .save-button {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <section class="settings-container">
        <div class="content-header">
            <h2 class="page-title">Settings</h2>
            <p class="page-subtitle">Tweak your preferences for a personalized experience.</p>
        </div>

        <div class="settings-panel">
            <form method="POST" action="{{ route('user.settings.update') }}" role="form" aria-label="Update user settings">
                @csrf
                <div class="settings-group">
                    <div class="group-title">Appearance</div>
                    <div class="form-group">
                        <label for="theme" class="form-label">Theme</label>
                        <select id="theme" name="theme" class="form-select" aria-label="Select theme">
                            <option value="dark" {{ old('theme', auth()->user()->theme ?? 'dark') === 'dark' ? 'selected' : '' }}>Dark</option>
                            <option value="light" {{ old('theme', auth()->user()->theme ?? 'dark') === 'light' ? 'selected' : '' }}>Light</option>
                        </select>
                    </div>
                </div>
                <div class="settings-group">
                    <div class="group-title">Notifications</div>
                    <div class="form-group">
                        <label for="email-notifications" class="form-label">Email Notifications</label>
                        <input type="checkbox" id="email-notifications" name="email_notifications" class="form-checkbox" {{ old('email_notifications', auth()->user()->email_notifications ?? false) ? 'checked' : '' }} aria-label="Toggle email notifications">
                    </div>
                    <div class="form-group">
                        <label for="push-notifications" class="form-label">Push Notifications</label>
                        <input type="checkbox" id="push-notifications" name="push_notifications" class="form-checkbox" {{ old('push_notifications', auth()->user()->push_notifications ?? false) ? 'checked' : '' }} aria-label="Toggle push notifications">
                    </div>
                </div>
                <button type="submit" class="save-button" aria-label="Save settings">
                    <i class="bi bi-save"></i> Save Settings
                    <span class="tooltip">Save Changes</span>
                </button>
            </form>
        </div>
    </section>
@endsection
