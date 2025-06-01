@extends('admin.layouts.app')

@section('title', 'Admin Profile')

@section('description', 'Edit your admin profile information.')

@section('content')
<section class="content">
    <div class="content-header">
        <h1 class="page-title">Admin Profile</h1>
        <p class="page-subtitle">Update your personal information.</p>
    </div>

    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Profile Information</h3>
        </div>
        <form class="modal-form" method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ Auth::user()->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ Auth::user()->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Leave blank to keep current password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Confirm new password">
            </div>
            <button type="submit" class="form-submit">Update Profile</button>
        </form>
    </div>
</section>
@endsection