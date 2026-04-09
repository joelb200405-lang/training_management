@extends('trainer.layout')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylesheet/trainer.css') }}">
    <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">
@endsection

@section('content')

    <h2 class="panel-title">Dashboard</h2>

    <section class="stats-grid">
    <div class="stat-card"><h3>{{ $totalTrainees }}</h3><p>Total Trainees</p></div>
    <div class="stat-card"><h3>{{ $monthlyEnrollment }}</h3><p>Monthly Enrollment Trend</p></div>
    <div class="stat-card"><h3>{{ $completionRate }}</h3><p>Completion Rate</p></div>
    <div class="stat-card urgent"><h3>{{ $urgentAssessments }}</h3><p>Urgent Assessments</p></div>
    </section>

    <section class="charts-grid">
        <div class="chart-container">
            <h4>Trainees per Course</h4>
            <div class="chart-wrapper">
                <canvas id="traineesBarChart"></canvas>
            </div>
        </div>
        <div class="chart-container">
            <h4>Completed vs Ongoing</h4>
            <div class="chart-wrapper">
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
                    @forelse($lowPerforming as $enrollment)
                    <tr>
                        <td>{{ $enrollment->user->lastname }}, {{ $enrollment->user->firstname }}</td>
                        <td>{{ $enrollment->course->title }}</td>
                        <td>{{ $enrollment->progress }}%</td>
                        <td class="risk-high">High</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-table-msg">No low performing trainees!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
                <div class="deadlines-container">
                    <h4 class="yellow-header">Upcoming Deadlines</h4>
                    <ul>
                        @forelse($deadlines as $deadline)
                        <li>
                            <strong>{{ $deadline->title }}</strong><br>
                            <small class="deadline-date">
                                <i class="fas fa-calendar"></i> 
                                {{ $deadline->due_date->format('M d, Y') }}
                            </small>
                        </li>
                        @empty
                        <li class="empty-list-msg">No upcoming deadlines!</li>
                        @endforelse
                    </ul>
                </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/trainer.css') }}"></script>
@endsection