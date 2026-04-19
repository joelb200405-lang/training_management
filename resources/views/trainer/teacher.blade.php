@extends('trainer.layout')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/trainer.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
 </header>

            <h2 class="panel-title">Dashboard</h2>
            
            <section class="stats-grid">
                <div class="stat-card"><h3>67</h3><p>Total Trainees</p></div>
                <div class="stat-card"><h3>67</h3><p>Monthly Enrollment</p></div>
                <div class="stat-card"><h3>97%</h3><p>Completion Rate</p></div>
                <div class="stat-card urgent"><h3>06</h3><p>Urgent Assessments</p></div>
            </section>

            <section class="charts-grid">
                <div class="chart-container">
                    <h4>Trainees per Course</h4>
                    <div class="chart-canvas-wrapper">
                        <canvas id="traineesBarChart"></canvas>
                    </div>
                </div>
                <div class="chart-container">
                    <h4>Completed vs Ongoing</h4>
                    <div class="chart-canvas-wrapper">
                        <canvas id="statusPieChart"></canvas>
                    </div>
                </div>
            </section>

            <section class="bottom-grid">
                <div class="table-container">
                    <h4>Low-Performing Trainee Alerts (Bottom 5%)</h4>
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>Trainee Name</th>
                                <th>Course</th>
                                <th>Avg. Score</th>
                                <th>Risk Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Nelmida, Rheyan</td><td>Computer Lit.</td><td>43%</td><td class="risk-badge high">High</td></tr>
                            <tr><td>Marcos, Bong</td><td>Nail Care</td><td>20%</td><td class="risk-badge high">High</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="deadlines-container">
                    <h4 class="yellow-header">Upcoming Deadlines</h4>
                    <ul class="deadline-list">
                        <li>Dress Making Final Project Submission</li>
                        <li>Graduation Requirements Clearance</li>
                    </ul>
                </div>
            </section>

@endsection

@section('scripts')
<script>
    /**
 * DCTC Trainer Dashboard Logic
 * Initializing Analytics Charts
 */
document.addEventListener('DOMContentLoaded', function() {
    const primaryGreen = '#004d26';
    const accentYellow = '#f8f16a';

    // Check if the canvas elements exist before trying to draw
    const barCtx = document.getElementById('traineesBarChart');
    const pieCtx = document.getElementById('statusPieChart');

    if (barCtx) {
        new Chart(barCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Dressmaking', 'Nail Care', 'Cookery', 'Welding', 'IT'],
                datasets: [{
                    label: 'No. of Trainees',
                    data: [45, 32, 25, 18, 40],
                    backgroundColor: primaryGreen,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    if (pieCtx) {
        new Chart(pieCtx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Completed', 'Ongoing'],
                datasets: [{
                    data: [65, 35],
                    backgroundColor: [primaryGreen, accentYellow],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 12 } } }
                }
            }
        });
    }
});
</script>
@endsection