<form method="post" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('patch')

    <!-- Name -->
    <div>
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex align-items-center gap-4">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        @if (session('status') === 'profile-updated')
        <p class="text-success">{{ __('Saved.') }}</p>
        @endif
    </div>
</form>