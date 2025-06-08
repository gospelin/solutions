<div class="chart-card">
    <div class="chart-header">
        <h4 class="chart-title">{{ $title }}</h4>
        <div class="chart-actions">
            <button class="chart-btn active">Day</button>
            <button class="chart-btn">Week</button>
            <button class="chart-btn">Month</button>
        </div>
    </div>
    <canvas id="{{ $chart_id }}"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('{{ $chart_id }}').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: '{{ $title }}',
                        data: {!! json_encode($data) !!},
                        backgroundColor: 'rgba(99, 102, 241, 0.5)',
                        borderColor: '#6366f1',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 0.1)'
                            },
                        },
                        ticks: {
                            color: 'var(--gray-300)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'var(--gray-300)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
            });
        });
    </script>
</div>