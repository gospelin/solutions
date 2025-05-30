@extends('user.layouts.dashboard-layout')

@section('content')
<div class="dashboard-content">
    <h1 class="dashboard-header">Profile Settings</h1>

    <div class="row">
        <!-- Update Profile Information -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">Update Profile Information</h2>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <!-- Update Password -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">Update Password</h2>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">Delete Account</h2>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection