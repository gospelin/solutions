<div class="chart-card">
    <div class="chart-header">
        <h3 class="chart-title">Admin Activity</h3>
        <a href="#" class="chart-btn">View All</a>
    </div>
    <div class="activity-feed">
        @foreach ($activities as $activity)
        <div class="activity-item">
            <div class="activity-icon"><i class="bi {{ $activity['icon'] }}"></i></div>
            <div class="activity-content">
                <h5>{{ $activity['title'] }}</h5>
                <p>{{ $activity['description'] }}</p>
            </div>
            <div class="activity-time">{{ $activity['time'] }}</div>
        </div>
        @endforeach
    </div>
</div>