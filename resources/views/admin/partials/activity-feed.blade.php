<div class="chart-card">
    <div class="chart-header">
        <h4 class="chart-title">Recent Activity</h4>
    </div>
    @foreach ($activities as $activity)
        <div class="activity-item">
            <div class="activity-icon"><i class="bi {{ $activity['icon'] }}"></i></div>
            <div class="activity-content">
                <h5>{{ $activity['title'] }}</h5>
                <p>{{ $activity['description'] }}</p>
            </div>
            <span class="activity-time">{{ $activity['time'] }}</span>
        </div>
    @endforeach
</div>