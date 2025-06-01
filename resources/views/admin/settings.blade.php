@extends('admin.layouts.app')

@section('title', 'Personal Settings')

@section('description', 'Customize your personal preferences.')

@section('content')
<section class="content">
    <div class="content-header">
        <h1 class="page-title">Personal Settings</h1>
        <p class="page-subtitle">Adjust your account preferences.</p>
    </div>

    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Account Preferences</h3>
        </div>
        <form class="modal-form" method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            <div class="form-group">
                <label for="theme">Theme</label>
                <select id="theme" name="theme" class="form-input">
                    <option value="dark">Dark</option>
                    <option value="light">Light</option>
                </select>
            </div>
            <div class="form-group">
                <label for="notifications">Email Notifications</label>
                <select id="notifications" name="notifications" class="form-input">
                    <option value="1">Enabled</option>
                    <option value="0">Disabled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="language">Language</label>
                <select id="language" name="language" class="form-input">
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                </select>
            </div>
            <button type="submit" class="form-submit">Save Settings</button>
        </form>
    </div>
</section>
@endsection
