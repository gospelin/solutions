@extends('admin.layouts.app')

@section('title', 'Admin Profile')
@section('description', 'Manage your admin profile settings.')

@section('content')
<section class="content">
    <div class="content-header">
        <h1 class="page-title">Admin Profile</h1>
        <p class="page-subtitle">Update your profile information.</p>
    </div>
    <form action="{{ route('admin.profile.update') }}" method="POST" class="modal-form">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-input" value="{{ auth()->user()->name }}" required>
            @error('name') <span class="color: var(--error);">{{ $message }}</span> @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-input" value="{{ auth()->user()->email }}" required>
            @error('email') <span class="color: var(--error);">{{ $message }}</span> @endif
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-input">
            @error('password') <span class="color: var(--error);">{{ $message }}</span> @endif
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input">
        </div>
        <button type="submit" class="form-submit">Update Profile</button>
    </form>
</section>
@endsection