<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEDIPO Trainer Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('stylesheet/reports.css') }}">
</head>
<body>

    <div class="top-strip">
        <div class="language-selector">
            English <i class="fas fa-chevron-down"></i>
        </div>
    </div>

    <div class="container">
        
        <nav class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="logo">
                <p class="sidebar-title">Dasmariñas City Training Center</p>
            </div>
            <ul>
                <li><a href="teacher"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="courses"><i class="fas fa-book"></i> Courses</a></li>
                <li><a href="learner"><i class="fas fa-users"></i> Trainees</a></li>
                <li><a href="assessment"><i class="fas fa-clipboard-check"></i> Assessment</a></li>
                <li><a href="certificates"><i class="fas fa-certificate"></i> Certificates</a></li>
                <li class="reports"><a href=" "><i class="fas fa-chart-line"></i> Reports</a></li>
                <li><a href="settings"><i class="fas fa-gear"></i> Settings</a></li>
            </ul>
        </nav>

        <main class="main-content">
            
            <header class="main-header">
                <div class="search-box">
                    <input type="text" placeholder="What are you looking for?">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                
                <div class="icon-buttons">
                    <div class="icon-item"><i class="fas fa-bell"></i></div>
                    <div class="icon-item logout"><i class="fas fa-right-from-bracket"></i></div>
                </div>
            </header>

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="reports.js"></script>

</body>
</html>