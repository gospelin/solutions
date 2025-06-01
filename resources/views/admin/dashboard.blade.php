@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('description', 'Manage users, tools, and system settings with real-time analytics.')

@section('content')
<section class="content">
    <div class="content-header">
        <h1 class="page-title">Admin Dashboard</h1>
        <p class="page-subtitle">Welcome, {{ Auth::user()->name }}! Control your platform with AI-powered insights.</p>
    </div>

    <div class="stats-grid">
        @include('admin.partials.stats-card', [
        'icon' => 'bi-people',
        'value' => '2,134',
        'label' => 'Total Users',
        'trend' => 'up',
        'trend_value' => '+10.3%',
        'class' => ''
        ])
        @include('admin.partials.stats-card', [
        'icon' => 'bi-tools',
        'value' => '56',
        'label' => 'Active Tools',
        'trend' => 'down',
        'trend_value' => '-2.1%',
        'class' => 'secondary'
        ])
        @include('admin.partials.stats-card', [
        'icon' => 'bi-currency-dollar',
        'value' => '$78,450',
        'label' => 'Revenue',
        'trend' => 'up',
        'trend_value' => '+15.7%',
        'class' => 'accent'
        ])
        @include('admin.partials.stats-card', [
        'icon' => 'bi-server',
        'value' => '99.9%',
        'label' => 'System Uptime',
        'trend' => 'up',
        'trend_value' => '+0.2%',
        'class' => 'success'
        ])
    </div>

    <div class="chart-section">
        @include('admin.partials.chart-card', [
        'title' => 'User Growth',
        'chart_id' => 'userGrowthChart',
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        'data' => [500, 800, 1200, 1500, 1800, 2134]
        ])
        @include('admin.partials.activity-feed', [
        'activities' => [
        ['icon' => 'bi-person-x', 'title' => 'User Banned', 'description' => 'John Doe was banned for policy violation.', 'time' => '1h ago'],
        ['icon' => 'bi-tools', 'title' => 'Tool Approved', 'description' => 'New hacking tool approved.', 'time' => '3h ago'],
        ['icon' => 'bi-server', 'title' => 'System Update', 'description' => 'Server patch applied.', 'time' => '5h ago']
        ]
        ])
    </div>

    <div class="quick-actions">
        @include('admin.partials.quick-action', [
        'icon' => 'bi-people',
        'title' => 'Manage Users',
        'description' => 'Ban, edit, or assign roles.',
        'href' => '#'
        ])
        @include('admin.partials.quick-action', [
        'icon' => 'bi-plus-circle',
        'title' => 'Add Tool',
        'description' => 'Approve or reject new tools.',
        'href' => '#'
        ])
        @include('admin.partials.quick-action', [
        'icon' => 'bi-bar-chart',
        'title' => 'View Reports',
        'description' => 'Analyze platform performance.',
        'href' => '#'
        ])
        @include('admin.partials.quick-action', [
        'icon' => 'bi-gear',
        'title' => 'System Settings',
        'description' => 'Configure platform settings.',
        'href' => '#'
        ])
    </div>
</section>
@endsection