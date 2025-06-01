<div class="chart-card">
    <div class="chart-header">
        <h3 class="chart-title">{{ $title }}</h3>
        <div class="chart-actions">
            <button class="chart-btn active" data-period="weekly">Weekly</button>
            <button class="chart-btn" data-period="monthly">Monthly</button>
            <button class="chart-btn" data-period="yearly">Yearly</button>
        </div>
    </div>
    <canvas id="{{ $chart_id }}"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chart = new Chart(document.getElementById('{{ $chart_id }}'), {
                type: 'line',
                data: {
                    labels: JSON.parse('{!! json_encode($labels) !!}'),
                    datasets: [{
                        label: '{{ $title }}',
                        data: JSON.parse('{!! json_encode($data) !!}'),
                        borderColor: 'rgb(99, 102, 241)',
                        backgroundColor: 'rgba(99, 102, 241, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            document.querySelectorAll('.chart-btn[data-period]').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.chart-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const period = btn.dataset.period;
                    let newData;
                    if (period === 'weekly') {
                        newData = JSON.parse('{!! json_encode($data) !!}');
                    } else if (period === 'monthly') {
                        newData = JSON.parse('{!! json_encode(array_map(function($x) { return $x * 4; }, $data)) !!}');
                    } else {
                        newData = JSON.parse('{!! json_encode(array_map(function($x) { return $x * 12; }, $data)) !!}');
                    }
                    chart.data.datasets[0].data = newData;
                    chart.update();
                });
            });
        });
    </script>
</div>