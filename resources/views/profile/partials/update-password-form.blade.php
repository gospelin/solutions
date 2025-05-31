<form method="post" action="{{ route('password.update') }}" class="form-container">
    @csrf
    @method('put')

    <style>
        .form-container {
            display: flex;
            flex-direction: column;
            gap: var(--space-md);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: var(--space-sm);
        }

        .form-label {
            font-family: var(--font-primary);
            font-size: clamp(0.875rem, 3vw, 1rem);
            font-weight: 500;
            color: var(--gray-300);
        }

        .form-input {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--space-md);
            color: var(--white);
            font-family: var(--font-primary);
            font-size: clamp(0.875rem, 3vw, 1rem);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-button {
            background: var(--gradient-primary);
            border: none;
            border-radius: var(--radius-md);
            padding: var(--space-md) var(--space-lg);
            color: var(--white);
            font-family: var(--font-primary);
            font-size: clamp(0.875rem, 3vw, 1rem);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .error-message {
            font-family: var(--font-primary);
            font-size: clamp(0.75rem, 2vw, 0.875rem);
            color: var(--error);
            margin-top: var(--space-xs);
        }

        .success-message {
            font-family: var(--font-primary);
            font-size: clamp(0.875rem, 3vw, 1rem);
            color: var(--success);
            margin: 0;
        }

        .button-group {
            display: flex;
            align-items: center;
            gap: var(--space-md);
        }

        body.light .form-label {
            color: var(--gray-500);
        }

        body.light .form-input {
            background: rgba(0, 0, 0, 0.02);
            border-color: rgba(0, 0, 0, 0.1);
            color: var(--gray-900);
        }

        body.light .form-input:focus {
            background: rgba(255, 255, 255, 0.05);
        }

        body.light .success-message {
            color: #047857;
        }
    </style>

    <!-- Current Password -->
    <div class="form-group">
        <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
        <input id="current_password" name="current_password" type="password" class="form-input" autocomplete="current-password">
        @error('current_password')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <!-- New Password -->
    <div class="form-group">
        <label for="password" class="form-label">{{ __('New Password') }}</label>
        <input id="password" name="password" type="password" class="form-input" autocomplete="new-password">
        @error('password')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password">
    </div>

    <div class="button-group">
        <button type="submit" class="form-button">{{ __('Save') }}</button>
        @if (session('status') === 'password-updated')
        <p class="success-message">{{ __('Saved.') }}</p>
        @endif
    </div>
</form>