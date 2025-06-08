<div class="stat-card {{ $class }}">
    <div class="stat-header">
        <div class="stat-icon"><i class="bi bi-{{ $icon }}"></i>
        </div>
        <div class="stat-trend {{ $trend }}">
            <i class="bi bi-arrow-circle-{{ $trend === 'up' ? 'up-right' : ($trend === 'down' ? 'down-right' : 'right-circle') }}"></i>
            <span>{{ $trend_value }}</span>
        </div>
    </div>
    <h3 class="stat-value">{{ $value }}</h3>
    <p class="label stat-label">{{ $label }}</p>
</div>
