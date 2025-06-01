@extends('admin.layouts.app')

@section('title', 'Reports')

@section('description', 'Analyze platform performance with detailed reports.')

@section('content')
<section class="content">
    <div class="content-header">
        <h1 class="page-title">Reports</h1>
        <p class="page-subtitle">Dive into platform analytics and insights.</p>
    </div>

    <div class="stats-grid">
        @include('admin.partials.stats-card', [
        'icon' => 'bi-person-plus',
        'value' => '534',
        'label' => 'New Users',
        'trend' => 'up',
        'trend_value' => '+18.2%',
        'class' => ''
        ])
        @include('admin.partials.stats-card', [
        'icon' => 'bi-tools',
        'value' => '12',
        'label' => 'New Tools',
        'trend' => 'down',
        'trend_value' => '-5.3%',
        'class' => 'secondary'
        ])
        @include('admin.partials.stats-card', [
        'icon' => 'bi-currency-dollar',
        'value' => '$12,340',
        'label' => 'Monthly Revenue',
        'trend' => 'up',
        'trend_value' => '+22.1%',
        'class' => 'accent'
        ])
        @include('admin.partials.stats-card', [
        'icon' => 'bi-activity',
        'value' => '1,245',
        'label' => 'Active Sessions',
        'trend' => 'up',
        'trend_value' => '+10.5%',
        'class' => 'success'
        ])
    </div>

    <div class="chart-section">
        @include('admin.partials.chart-card', [
        'title' => 'User Activity',
        'chart_id' => 'userActivityChart',
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        'data' => [1000, 1200, 1100, 1300, 1400, 1245]
        ])
        @include('admin.partials.chart-card', [
        'title' => 'Revenue Trend',
        'chart_id' => 'revenueTrendChart',
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        'data' => [5000, 6000, 5500, 7000, 8000, 12340]
        ])
    </div>
</section>
@endsection
