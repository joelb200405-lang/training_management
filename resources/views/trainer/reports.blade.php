@extends('trainer.layout')

@section('title', 'Reports')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylesheet/reports.css') }}">
@endsection

@section('content')

            <div class="panel-padding">
                <h2 class="panel-title">Reports</h2>

                <section class="stats-grid">
                    <div class="stat-card"><h3>67</h3><p>Graduation Rate</p></div>
                    <div class="stat-card"><h3>67</h3><p>Employment Ready</p></div>
                    <div class="stat-card"><h3>Sabang</h3><p>Top Barangay Reach</p></div>
                    <div class="stat-card urgent"><h3>60/70</h3><p>Gender Split (F/M)</p></div>
                </section>

                <div class="reports-main-layout">
                    
                    <div class="reports-left">
                        <div class="report-filter-card">
                            <h3 class="section-header-mini">Report Generator</h3>
                            <div class="filter-grid">
                                <select class="report-select" id="reportType">
                                    <option>Enrollment Summary</option>
                                    <option>Assessment Results</option>
                                    <option>Certificate Registry</option>
                                </select>
                                <select class="report-select" id="courseSelect">
                                    <option>All Courses</option>
                                    <option>Dressmaking</option>
                                    <option>Nail Care</option>
                                </select>
                                <input type="month" class="report-select" id="dateFilter" value="2026-03">
                                <button class="btn-generate" onclick="updatePreview()">Generate Preview</button>
                            </div>
                        </div>

                        <div class="preview-container">
                            <div class="preview-header">
                                <span id="recordStatus">Showing <strong>45 records</strong> for March 2026</span>
                            </div>
                            <table class="preview-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Date</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody id="previewBody">
                                    <tr>
                                        <td>Nelmida, Rheyan</td>
                                        <td>Dressmaking</td>
                                        <td>04/01/2026</td>
                                        <td><span class="res-pass">Passed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="reports-right">
                        <div class="charts-main-container">
                            <div class="charts-top-row">
                                <div class="chart-card">
                                    <h3 class="section-header-mini">Course Distribution</h3>
                                    <div class="chart-container">
                                        <canvas id="coursePieChart"></canvas>
                                    </div>
                                </div>

                                <div class="chart-card">
                                    <h3 class="section-header-mini">Monthly Graduates</h3>
                                    <div class="chart-container">
                                        <canvas id="gradBarChart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="charts-bottom-row">
                                <div class="chart-card wide-card">
                                    <h3 class="section-header-mini">Enrollment Growth Trends</h3>
                                    <div class="chart-container-tall">
                                        <canvas id="enrollLineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="signature-section">
                    <div class="sig-box">PREPARED BY:<br><br>Ma. Michaela S. Bocita</div>
                    <div class="sig-box">NOTED BY:<br><br>Center Head / City Official</div>
                </div>

                <div class="export-footer">
                    <button class="btn-export excel" onclick="exportData('Excel')">
                        <i class="fas fa-file-excel"></i> Export to Excel
                    </button>
                    <button class="btn-export pdf" onclick="exportData('PDF')">
                        <i class="fas fa-file-pdf"></i> Generate PDF Report
                    </button>
                    <button class="btn-export print" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Summary
                    </button>
                </div>
            </div>
        </main>
    </div>

    @endsection

@section('scripts')
    <script src="{{ asset('js/reports.js') }}"></script>
@endsection