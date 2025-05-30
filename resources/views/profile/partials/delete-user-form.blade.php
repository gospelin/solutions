<form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
    @csrf
    @method('delete')

    <div>
        <p class="text-danger">{{ __('Are you sure you want to delete your account? This action cannot be undone.') }}</p>
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" name="password" type="password" class="form-control" autocomplete="current-password">
        @error('password')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex align-items-center gap-4">
        <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
    </div>
</form>