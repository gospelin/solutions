<form method="post" action="{{ route('profile.update') }}" class="form-container">
    @csrf
    @method('patch')

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

    <!-- Name -->
    <div class="form-group">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="form-group">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="button-group">
        <button type="submit" class="form-button">{{ __('Save') }}</button>
        @if (session('status') === 'profile-updated')
        <p class="success-message">{{ __('Saved.') }}</p>
        @endif
    </div>
</form>