<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEDIPO Trainer Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('stylesheet/assessment.css') }}">
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
                <li class="assessment"><a href=" "><i class="fas fa-clipboard-check"></i> Assessment</a></li>
                <li><a href="certificates"><i class="fas fa-certificate"></i> Certificates</a></li>
                <li><a href="reports"><i class="fas fa-chart-line"></i> Reports</a></li>
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

</body>
</html>