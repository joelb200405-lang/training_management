@extends('trainer.layout')

@section('title', 'Trainees')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylesheet/learner.css') }}">
@endsection

@section('content')
    <h2 class="panel-title">Assessment</h2>

  <section class="stats-grid">
                <div class="stat-card"><h3>07</h3><p>Pending Grading</p></div>
                <div class="stat-card"><h3>92%</h3><p>Average Class Score</p></div>
                <div class="stat-card"><h3>97%</h3><p>Passing Rate</p></div>
                <div class="stat-card urgent"><h3>96%</h3><p>Top Performers</p></div>
            </section>


                <div class="filter-row">
                    <div class="filter-btn">Filter by: Course <i class="fas fa-caret-down"></i></div>
                    <div class="filter-btn">Filter by: Assessment <i class="fas fa-caret-down"></i></div>
                    <div class="filter-btn">Filter by: Status <i class="fas fa-caret-down"></i></div>
                </div>

                <div class="table-outline">
                    <table class="trainee-data-table">
                        <thead>
                            <tr>
                                <th>Trainee ID</th>
                                <th>Fullname</th>
                                <th>Course</th>
                                <th>Barangay</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                      <tbody>
                            <tr>
                                <td>2023-2-0018</td>
                                <td class="name">Bong, Marcos</td>
                                <td class="course">Nail Care</td>
                                <td>Salitran II</td>
                                <td class="status-active">Active</td>
                                <td class="action-icons">
                                    <i class="fas fa-eye view" onclick="openProfile()"></i>
                                    <i class="fas fa-edit edit"></i>
                                    <i class="fas fa-trash-alt delete"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-2-0019</td>
                                <td class="name">Ramos, Roshian</td>
                                <td class="course">Candle Making</td>
                                <td>Sabang</td>
                                <td class="status-wait">Waitlisted</td>
                                <td class="action-icons">
                                    <i class="fas fa-eye view" onclick="openProfile()"></i>
                                    <i class="fas fa-edit edit"></i>
                                    <i class="fas fa-trash-alt delete"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

<div class="bottom-controls">
    <button class="add-grade-text" data-bs-toggle="modal" data-bs-target="#recordGradeModal">
        <i class="fas fa-plus-square"></i> Add New Grade
    </button>
    <button class="export-pill-btn">Export to Excel</button>
</div>
@endsection