@extends('admin.layouts.app')

@section('title', 'System Settings')

@section('description', 'Configure platform settings and system preferences.')

@section('content')
<section class="content">
    <div class="content-header">
        <h1 class="page-title">System Settings</h1>
        <p class="page-subtitle">Manage platform-wide configurations.</p>
    </div>

    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Platform Configuration</h3>
        </div>
        <form class="modal-form" method="POST" action="{{ route('admin.system-settings') }}">
            @csrf
            <div class="form-group">
                <label for="maintenance_mode">Maintenance Mode</label>
                <select id="maintenance_mode" name="maintenance_mode" class="form-input">
                    <option value="0">Disabled</option>
                    <option value="1">Enabled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="api_key">API Key</label>
                <input type="text" id="api_key" name="api_key" class="form-input" placeholder="Enter API key">
            </div>
            <div class="form-group">
                <label for="max_users">Max Users</label>
                <input type="number" id="max_users" name="max_users" class="form-input" placeholder="Maximum allowed users">
            </div>
            <button type="submit" class="form-submit">Save Settings</button>
        </form>
    </div>
</section>
@endsection