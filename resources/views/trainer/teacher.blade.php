<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEDIPO Trainer Dashboard</title> 
       
    <link rel="stylesheet" href="stylesheet/trainer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <img src="images/logo.png" alt="logo">
                <p class="sidebar-title">Dasmariñas City Training Center</p>
            </div>
            <ul>
                <li class="teacher"><a href=" "><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="courses"><i class="fas fa-book"></i> Courses</a></li>
                <li><a href="learner"><i class="fas fa-users"></i> Trainees</a></li>
                <li><a href="assessment"><i class="fas fa-clipboard-check"></i> Assessment</a></li>
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
        </main>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-col">
                <h3>Support</h3>
                <p>Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                <p><a href="mailto:Regals@gmail.com">Regals@gmail.com</a></p>
                <p>+88015-88888-9999</p>
            </div>

            <div class="footer-col">
                <h3>Account</h3>
                <ul>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Login / Register</a></li>
                    <li><a href="#">Likes</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Quick Link</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms Of Use</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; Copyright Rimel 2022. All right reserved</p>
        </div>
    </footer>
    
    <script src="trainer.js"></script>

</body>
</html>