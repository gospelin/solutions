<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <!-- Current Password -->
    <div>
        <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
        <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
        @error('current_password')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- New Password -->
    <div>
        <label for="password" class="form-label">{{ __('New Password') }}</label>
        <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
        @error('password')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
    </div>

    <div class="d-flex align-items-center gap-4">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        @if (session('status') === 'password-updated')
        <p class="text-success">{{ __('Saved.') }}</p>
        @endif
    </div>
</form>