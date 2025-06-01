<div class="stat-card {{ $class }}">
    <div class="stat-header">
        <div class="stat-icon"><i class="bi {{ $icon }}"></i></div>
        <div class="stat-trend {{ $trend }}">
            <i class="bi bi-arrow-{{ $trend }}"></i> {{ $trend_value }}
        </div>
    </div>
    <div class="stat-value">{{ $value }}</div>
    <div class="stat-label">{{ $label }}</div>
</div>