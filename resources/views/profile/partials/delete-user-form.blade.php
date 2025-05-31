<form method="post" action="{{ route('profile.destroy') }}" class="form-container">
    @csrf
    @method('delete')

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

        .warning-text {
            font-family: var(--font-primary);
            font-size: clamp(0.875rem, 3vw, 1rem);
            color: var(--error);
            font-weight: 500;
            margin-bottom: var(--space-md);
        }

        .form-button {
            background: linear-gradient(135deg, var(--error) 0%, #b91c1c 100%);
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
            background: linear-gradient(135deg, #b91c1c 0%, var(--error) 100%);
        }

        .error-message {
            font-family: var(--font-primary);
            font-size: clamp(0.75rem, 2vw, 0.875rem);
            color: var(--error);
            margin-top: var(--space-xs);
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

        body.light .warning-text {
            color: #b91c1c;
        }
    </style>

    <div class="form-group">
        <p class="warning-text">{{ __('Are you sure you want to delete your account? This action cannot be undone.') }}</p>
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" name="password" type="password" class="form-input" autocomplete="current-password">
        @error('password')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="form-button">{{ __('Delete Account') }}</button>
    </div>
</form>