@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('description', 'Manage users, tools, and transactions with real-time analytics.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">Admin Dashboard</h1>
            <p class="page-subtitle">Welcome, {{ Auth::user()->name }}! Manage your platform with real-time data.</p>
        </div>

        <div class="stats-grid">
            @include('admin.partials.stats-card', [
                'icon' => 'bi-people',
                'value' => number_format($totalUsers),
                'label' => 'Total Users',
                'trend' => $totalUsers > 0 ? 'up' : 'neutral',
                'trend_value' => '+0%',
                'class' => ''
            ])
            @include('admin.partials.stats-card', [
                'icon' => 'bi-tools',
                'value' => number_format($activeTools),
                'label' => 'Active Tools',
                'trend' => 'neutral',
                'trend_value' => '0%',
                'class' => 'secondary'
            ])
            @include('admin.partials.stats-card', [
                'icon' => 'bi-currency-dollar',
                'value' => '$' . number_format($totalRevenue, 2),
                'label' => 'Revenue',
                'trend' => $totalRevenue > 0 ? 'up' : 'neutral',
                'trend_value' => '+0%',
                'class' => 'accent'
            ])
            @include('admin.partials.stats-card', [
                'icon' => 'bi-envelope',
                'value' => number_format($contactCount),
                'label' => 'Contact Submissions',
                'trend' => $contactCount > 0 ? 'up' : 'neutral',
                'trend_value' => '+0%',
                'class' => 'success'
            ])
        </div>

        <div class="chart-section">
            @include('admin.partials.chart-card', [
                'title' => 'User Growth',
                'chart_id' => 'userGrowthChart',
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                'data' => \App\Models\User::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('month')
                    ->pluck('count')
                    ->toArray()
            ])
            @include('admin.partials.activity-feed', [
                'activities' => $recentActivities
            ])
        </div>

        <div class="quick-actions">
            <a href="{{ route('admin.user-management') }}" class="action-card">
                <span class="action-card-icon"><i class="bi bi-people"></i></span>
                <h4>Manage Users</h4>
                <p>Ban, edit, or assign roles.</p>
            </a>
            <a href="{{ route('admin.tools.create') }}" class="action-card">
                <span class="action-card-icon"><i class="bi bi-plus-circle"></i></span>
                <h4>Add Tool</h4>
                <p>Create new marketplace tools.</p>
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="action-card">
                <span class="action-card-icon"><i class="bi bi-receipt"></i></span>
                <h4>View Transactions</h4>
                <p>Monitor payment logs.</p>
            </a>
            <a href="{{ route('admin.system-settings') }}" class="action-card">
                <span class="action-card-icon"><i class="bi bi-gear"></i></span>
                <h4>System Settings</h4>
                <p>Configure platform settings.</p>
            </a>
        </div>
    </section>
@endsection
