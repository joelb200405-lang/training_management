@extends('trainer.layout')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylesheet/trainer.css') }}">
@endsection

@section('content')

    <h2 class="panel-title">Dashboard</h2>

    <section class="stats-grid">
        <div class="stat-card"><h3>67</h3><p>Total Trainees</p></div>
        <div class="stat-card"><h3>67</h3><p>Monthly Enrollment Trend</p></div>
        <div class="stat-card"><h3>97%</h3><p>Completion Rate</p></div>
        <div class="stat-card urgent"><h3>06</h3><p>Urgent Assessments</p></div>
    </section>

    <section class="charts-grid">
        <div class="chart-container">
            <h4>Trainees per Course</h4>
            <div style="height: 250px;">
                <canvas id="traineesBarChart"></canvas>
            </div>
        </div>
        <div class="chart-container">
            <h4>Completed vs Ongoing</h4>
            <div style="height: 250px;">
                <canvas id="statusPieChart"></canvas>
            </div>
        </div>
    </section>

    <section class="bottom-grid">
        <div class="table-container">
            <h4>Low-Performing Trainee Alerts (Bottom 5%)</h4>
            <table>
                <thead>
                    <tr>
                        <th>Trainee Name</th>
                        <th>Course</th>
                        <th>Avg. Score</th>
                        <th>Risk Level</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Nelmida, Rheyan</td><td>Computer Lit.</td><td>43%</td><td class="risk-high">High</td></tr>
                    <tr><td>Marcos, Bong</td><td>Nail Care</td><td>20%</td><td class="risk-high">High</td></tr>
                </tbody>
            </table>
        </div>
        <div class="deadlines-container">
            <h4 class="yellow-header">Upcoming Deadlines</h4>
            <ul>
                <li>Dress Making Final Project Submission</li>
                <li>Graduation Requirements Clearance</li>
            </ul>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/trainer.css') }}"></script>
@endsection