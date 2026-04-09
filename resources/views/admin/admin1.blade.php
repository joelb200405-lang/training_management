<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - System Overview</title>
    <link rel="stylesheet" href="stylesheet/admin-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">
</head>

<body>

    <header class="top-nav">
        <div class="logo-section">
            <a href="index.php" class="logo-link">
                <img src="images/logo.png" alt="Logo" class="logo">
            </a>
        </div>

        <div class="header-right">
            <div class="user-welcome" onclick="toggleDropdown(event)">
                Welcome, <strong>Admin!</strong>
                <i class="fa-solid fa-chevron-down"></i>

                <div id="logout-dropdown" class="dropdown-content">
                    <form action="{{ route('Logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fa-solid fa-right-from-bracket"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main class="dashboard-container">
        <nav class="breadcrumb">
            <a href="#" onclick="location.reload()">Home</a> /
            <span id="breadcrumb-current">System Overview</span>
        </nav>
        <h1 class="page-title" id="main-title">System Overview</h1>

        <div class="dashboard-grid">
            <div class="main-stats">

                <div id="view-overview">
                    <div class="charts-row">
                        <div class="card chart-card">
                            <h3>Trainees</h3>
                            <canvas id="traineeChart"></canvas>
                            <a href="#" class="view-more" onclick="showView('analytics')">View more</a>
                        </div>
                        <div class="card chart-card">
                            <h3>Courses</h3>
                            <canvas id="courseChart"></canvas>
                            <a href="#" class="view-more" onclick="showView('analytics')">View more</a>
                        </div>
                    </div>

                    <div class="card updates-card">
                        <h3><i class="fa-solid fa-bell"></i> Updates</h3>
                        <ul class="update-list" id="updateList">
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <div>
                                    <strong>Change of Training Location</strong><br>
                                    <small>Zone 4, San Placido Campos Avenue, Dasmariñas, Cavite</small>
                                </div>
                            </li>

                            <div id="extra-updates" style="display: none;">
                                <li>
                                    <i class="fa-solid fa-calendar-check"></i>
                                    <div>
                                        <strong>New Schedule: Carpentry</strong><br>
                                        <small>Starts Monday, 8:00 AM - 12:00 PM</small>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <div>
                                        <strong>Holiday Notice</strong><br>
                                        <small>Office closed on April 9 (Araw ng Kagitingan)</small>
                                    </div>
                                </li>
                            </div>
                        </ul>

                        <div class="updates-footer">
                            <button class="view-more-btn" id="viewMoreBtn" onclick="toggleUpdates()">
                                View More <i class="fa-solid fa-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="view-analytics" style="display: none;">
                    <div class="analytics-header-row">
                        <h3><i class="fa-solid fa-chart-line"></i> Detailed System Analytics</h3>
                        <button class="btn-cancel" onclick="showView('overview')">Back to Overview</button>
                    </div>

                    <div class="analytics-grid">
                        <div class="card chart-card-full">
                            <div class="card-header">
                                <h4><i class="fa-solid fa-user-graduate"></i> Trainee Enrollment (Monthly Volume)</h4>
                            </div>
                            <div class="full-chart-container">
                                <canvas id="traineeHistoryChart"></canvas>
                            </div>
                        </div>

                        <div class="card chart-card-full">
                            <div class="card-header">
                                <h4><i class="fa-solid fa-book"></i> Course Growth (Yearly Trend)</h4>
                            </div>
                            <div class="full-chart-container">
                                <canvas id="courseHistoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="view-users" style="display: none;">
                    <div class="card list-card">
                        <div class="card-header">
                            <h3>Trainees</h3>
                        </div>
                        <div class="user-item">
                            <i class="fa-solid fa-circle-user profile-icon"></i>
                            <div class="user-info">
                                <strong>MICHAELA BOCITA</strong><br>
                                <small>mmsbocita@gmail.com</small>
                            </div>
                        </div>
                        <button class="btn-all" onclick="showView('all-trainees')">View All Trainees</button>
                    </div>

                    <div class="card list-card">
                        <h3>Trainers</h3>
                        <button class="btn-all" onclick="showView('all-trainers')">View All Trainers</button>
                    </div>
                </div>

                <div id="view-all-list" style="display: none;">
                    <div class="card list-card">
                        <div class="card-header">
                            <h3 id="all-list-title">List</h3>
                        </div>

                        <div class="user-list-body">
                            <div class="user-item">
                                <i class="fa-solid fa-circle-user profile-icon"></i>
                                <div class="user-info">
                                    <strong>MICHAELA BOCITA</strong><br>
                                    <small>mmsbocita@gmail.com</small>
                                </div>
                                <button class="btn-view" onclick="openUserModal('MICHAELA BOCITA', 'mmsbocita@gmail.com', 'Trainee', 'Active')">
                                    View
                                </button>
                            </div>
                        </div>

                        <div class="pagination-container">
                            <button class="page-btn prev" onclick="movePage(-1)">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>

                            <div class="page-numbers">
                                <button class="page-btn active" onclick="changePage(1)">1</button>
                                <button class="page-btn" onclick="changePage(2)">2</button>
                                <button class="page-btn" onclick="changePage(3)">3</button>
                            </div>

                            <button class="page-btn next" onclick="movePage(1)">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>

                            <a href="#" onclick="showView('users')" class="back-link">Back to Users</a>
                        </div>
                    </div>
                </div>

                <div id="view-facilities" style="display: none;">
                    <div class="facility-grid">
                        <div class="card facility-card">
                            <div class="facility-header">
                                <i class="fa-solid fa-building-circle-check"></i>
                                <div>
                                    <strong>Brgy. Burol Main Barangay Hall</strong><br>
                                    <small>Zone 4, Dasmariñas, Cavite</small>
                                </div>
                            </div>
                            <div class="facility-body">
                                <p><i class="fa-solid fa-users"></i> Capacity: 25/30</p>
                                <p><i class="fa-solid fa-book-open"></i> Current: Dressmaking</p>
                            </div>
                            <button class="btn-all" onclick="openFacilityModal('Brgy. Burol Main Barangay Hall', 'Zone 4, Dasmariñas, Cavite', 30, 'Dressmaking')">
                                Manage Facility
                            </button>
                        </div>

                        <div class="card facility-card">
                            <div class="facility-header">
                                <i class="fa-solid fa-building-columns"></i>
                                <div>
                                    <strong>LEDIPO Main</strong><br>
                                    <small>City Hall Compound</small>
                                </div>
                            </div>
                            <div class="facility-body">
                                <p><i class="fa-solid fa-users"></i> Capacity: 10/20</p>
                                <p><i class="fa-solid fa-book-open"></i> Current: Carpentry</p>
                            </div>
                            <button class="btn-all" onclick="openFacilityModal('LEDIPO Main', 'City Hall Compound', 20, 'Carpentry')">
                                Manage Facility
                            </button>
                        </div>
                    </div>
                    <div class="pagination-container">
                        <button class="page-btn prev" onclick="movePage(-1)"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="page-numbers">
                            <button class="page-btn active" onclick="changePage(1)">1</button>
                            <button class="page-btn" onclick="changePage(2)">2</button>
                            <button class="page-btn" onclick="changePage(3)">3</button>
                        </div>
                        <button class="page-btn next" onclick="movePage(1)"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>

                <div id="view-courses" style="display: none;">
                    <div class="courses-grid">
                        <div class="card course-card">
                            <div class="course-badge active">Active</div>
                            <i class="fa-solid fa-hammer course-main-icon"></i>
                            <h4>Carpentry & Woodworks</h4>
                            <p><i class="fa-solid fa-calendar-day"></i> Duration: 3 Months</p>
                            <p><i class="fa-solid fa-user-graduate"></i> Enrolled: 18 Students</p>
                            <div class="progress-container">
                                <div class="progress-bar" style="width: 75%;"></div>
                            </div>
                            <button class="btn-all" onclick="openCourseModal('Carpentry & Woodworks', '3 Months', 18, 75)">Course Details</button>
                        </div>

                        <div class="card course-card">
                            <div class="course-badge active">Active</div>
                            <i class="fa-solid fa-scissors course-main-icon"></i>
                            <h4>Dressmaking & Tailoring</h4>
                            <p><i class="fa-solid fa-calendar-day"></i> Duration: 4 Months</p>
                            <p><i class="fa-solid fa-user-graduate"></i> Enrolled: 22 Students</p>
                            <div class="progress-container">
                                <div class="progress-bar" style="width: 40%;"></div>
                            </div>
                            <button class="btn-all" onclick="openCourseModal('Dressmaking & Tailoring', '4 Months', 22, 40)">Course Details</button>
                        </div>
                    </div>
                    <div class="pagination-container">
                        <button class="page-btn prev" onclick="movePage(-1)"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="page-numbers">
                            <button class="page-btn active" onclick="changePage(1)">1</button>
                            <button class="page-btn" onclick="changePage(2)">2</button>
                            <button class="page-btn" onclick="changePage(3)">3</button>
                        </div>
                        <button class="page-btn next" onclick="movePage(1)"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>

                <div id="view-settings" style="display: none;">
                    <div class="card settings-card">
                        <h3>General Settings</h3>
                        <div class="settings-row">
                            <div class="settings-info">
                                <strong>Admin Email</strong>
                                <p>The primary email for system recovery and alerts.</p>
                            </div>
                            <input type="email" value="ledipoadmin@gmail.com" class="settings-input">
                        </div>
                        <hr class="settings-divider">
                        <h3>Security</h3>
                        <div class="settings-row">
                            <div class="settings-info">
                                <strong>Password</strong>
                                <p>Last changed: 2 months ago.</p>
                            </div>
                            <button class="btn-view">Update Password</button>
                        </div>
                        <div class="settings-row">
                            <div class="settings-info">
                                <strong>Database Backup</strong>
                                <p>Download a copy of all trainees, trainers, and courses.</p>
                            </div>
                            <button class="btn-all btn-backup">Backup Now</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="sidebar-stats">
                <div class="shortcut-grid">
                    <div class="card icon-card" id="btn-users" onclick="showView('users')">
                        <div id="icon-content">
                            <i class="fa-solid fa-users"></i>
                            <p>Users</p>
                        </div>
                    </div>
                    <div class="card icon-card" onclick="showView('facilities')">
                        <i class="fa-solid fa-building"></i>
                        <p>Facilities</p>
                    </div>
                    <div class="card icon-card" onclick="showView('courses')">
                        <i class="fa-solid fa-book"></i>
                        <p>Courses</p>
                    </div>
                    <div class="card icon-card" id="btn-settings" onclick="showView('settings')">
                        <i class="fa-solid fa-gear"></i>
                        <p>Settings</p>
                    </div>
                </div>
                <div class="card calendar-card">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Support</h4>
                <p>Barangay Burol Main, Dasmariñas, Cavite</p>
                <p>Email: admin@example.com</p>
            </div>
            <div class="footer-section">
                <h4>Account</h4>
                <ul>
                    <li>My Account</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li>Privacy Policy</li>
                    <li>Terms of Use</li>
                </ul>
            </div>
        </div>
        <p class="copyright">© Copyright 2026. All rights reserved.</p>
    </footer>

    <div id="courseModal" class="modal">
        <div class="modal-content card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-pen-to-square"></i> Manage Course</h3>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <form id="courseForm" class="modal-body">
                <div class="input-field">
                    <label>Course Name</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-bookmark"></i>
                        <input type="text" id="editCourseName" value="Carpentry & Woodworks">
                    </div>
                </div>
                <div class="modal-row">
                    <div class="input-field">
                        <label>Duration</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-calendar-day"></i>
                            <input type="text" id="editDuration" value="3 Months">
                        </div>
                    </div>
                    <div class="input-field">
                        <label>Enrolled Students</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-user-graduate"></i>
                            <input type="number" id="editEnrolled" value="18">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-delete-text" onclick="confirmDelete()">
                        <i class="fa-solid fa-trash"></i> Delete Course
                    </button>
                    <div class="action-buttons">
                        <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn-save-main">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="userModal" class="modal">
        <div class="modal-content card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-user-gear"></i> Manage User Profile</h3>
                <span class="close-modal" onclick="closeUserModal()">&times;</span>
            </div>
            <form id="userForm" class="modal-body">
                <div class="input-field">
                    <label>Full Name</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-signature"></i>
                        <input type="text" id="editUserName" placeholder="Full Name">
                    </div>
                </div>
                <div class="input-field">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" id="editUserEmail" readonly class="readonly-input">
                    </div>
                </div>
                <div class="modal-row">
                    <div class="input-field">
                        <label>Account Role</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-user-tag"></i>
                            <select id="editUserRole" class="modal-input-select">
                                <option value="Trainee">Trainee</option>
                                <option value="Trainer">Trainer</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-field">
                        <label>Status</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-circle-check"></i>
                            <select id="editUserStatus" class="modal-input-select">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-delete-text" onclick="deleteUser()">
                        <i class="fa-solid fa-user-slash"></i> Remove User
                    </button>
                    <div class="action-buttons">
                        <button type="button" class="btn-cancel" onclick="closeUserModal()">Cancel</button>
                        <button type="submit" class="btn-save-main">Update User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="facilityModal" class="modal">
        <div class="modal-content card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-building-circle-gear"></i> Manage Facility</h3>
                <span class="close-modal" onclick="closeFacilityModal()">&times;</span>
            </div>
            <form id="facilityForm" class="modal-body">
                <div class="input-field">
                    <label>Facility / Center Name</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-hotel"></i>
                        <input type="text" id="editFacName" placeholder="e.g. Brgy. Burol Main Hall">
                    </div>
                </div>
                <div class="input-field">
                    <label>Full Address</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" id="editFacAddress" placeholder="Zone 4, Dasmariñas, Cavite">
                    </div>
                </div>
                <div class="modal-row">
                    <div class="input-field">
                        <label>Max Capacity</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-users"></i>
                            <input type="number" id="editFacCap" placeholder="30">
                        </div>
                    </div>
                    <div class="input-field">
                        <label>Assigned Course</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-book-open-reader"></i>
                            <select id="editFacCourse" class="modal-input-select">
                                <option value="Dressmaking">Dressmaking</option>
                                <option value="Carpentry">Carpentry</option>
                                <option value="Candle Making">Candle Making</option>
                                <option value="None">No Active Training</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-delete-text" onclick="deleteFacility()">
                        <i class="fa-solid fa-house-lock"></i> Close Facility
                    </button>
                    <div class="action-buttons">
                        <button type="button" class="btn-cancel" onclick="closeFacilityModal()">Cancel</button>
                        <button type="submit" class="btn-save-main">Save Updates</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let traineeHistoryInstance = null;
        let courseHistoryInstance = null;

        // --- 1. Analytics Chart Initialization ---
        function initHistoryChart() {
            const traineeCanvas = document.getElementById('traineeHistoryChart');
            if (traineeCanvas) {
                traineeCanvas.style.height = '500px';
                const traineeCtx = traineeCanvas.getContext('2d');
                if (traineeHistoryInstance) traineeHistoryInstance.destroy();

                traineeHistoryInstance = new Chart(traineeCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Trainees',
                            data: [150, 170, 160, 190, 220, 210, 250, 280, 310, 340, 390, 420],
                            backgroundColor: '#7fb092',
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        resizeDelay: 0,
                        layout: { padding: { top: 10, bottom: 0, left: 10, right: 10 } },
                        plugins: {
                            legend: { display: true, position: 'top', labels: { font: { size: 14 } } }
                        },
                        scales: {
                            y: { beginAtZero: true, ticks: { font: { size: 12 } }, afterFit: (axis) => { axis.width = 50 } },
                            x: { ticks: { font: { size: 12 } } }
                        }
                    }
                });
            }

            const courseCanvas = document.getElementById('courseHistoryChart');
            if (courseCanvas) {
                courseCanvas.style.height = '500px';
                const courseCtx = courseCanvas.getContext('2d');
                if (courseHistoryInstance) courseHistoryInstance.destroy();

                courseHistoryInstance = new Chart(courseCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Courses',
                            data: [5, 6, 8, 8, 10, 12, 12, 15, 15, 18, 20, 22],
                            borderColor: '#004d26',
                            backgroundColor: 'rgba(0, 77, 38, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        resizeDelay: 0,
                        layout: { padding: { top: 10, bottom: 0, left: 10, right: 10 } },
                        plugins: {
                            legend: { display: true, position: 'top', labels: { font: { size: 14 } } }
                        },
                        scales: {
                            y: { beginAtZero: true, ticks: { font: { size: 12 } }, afterFit: (axis) => { axis.width = 50 } },
                            x: { ticks: { font: { size: 12 } } }
                        }
                    }
                });
            }
        }

        // --- 2. Initial Page Load (Calendar & Overview Charts) ---
        document.addEventListener('DOMContentLoaded', function () {
            // Calendar
            var calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    fixedWeekCount: false,
                    headerToolbar: { left: 'prev', center: 'title', right: 'next' },
                    eventColor: '#004d26',
                    height: 'auto',
                });
                calendar.render();
            }

            // Overview Trainee Bar
            const ctxBar = document.getElementById('traineeChart')?.getContext('2d');
            if (ctxBar) {
                new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: ['Sept', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            data: [40, 65, 80, 95],
                            backgroundColor: '#004d26',
                            borderRadius: 4,
                            barPercentage: 0.6
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, grid: { display: false }, ticks: { display: false } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            // Overview Course Line
            const ctxLine = document.getElementById('courseChart')?.getContext('2d');
            if (ctxLine) {
                new Chart(ctxLine, {
                    type: 'line',
                    data: {
                        labels: ['Sept', 'Oct', 'Nov', 'Dec'],
                        datasets: [
                            { label: 'Carpentry', data: [30, 58, 98, 65], borderColor: '#c19a6b', tension: 0.3 },
                            { label: 'Dressmaking', data: [45, 68, 40, 82], borderColor: '#6b9e7c', tension: 0.3 },
                            { label: 'Candle Making', data: [25, 62, 25, 18], borderColor: '#f4d03f', tension: 0.3 }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, font: { size: 10 } } } },
                        scales: { y: { grid: { color: '#f0f0f0' } }, x: { grid: { display: false } } }
                    }
                });
            }
        });

        // --- 3. View Management ---
        function showView(viewName) {
            const views = {
                overview: document.getElementById('view-overview'),
                users: document.getElementById('view-users'),
                allList: document.getElementById('view-all-list'),
                facilities: document.getElementById('view-facilities'),
                courses: document.getElementById('view-courses'),
                settings: document.getElementById('view-settings'),
                analytics: document.getElementById('view-analytics')
            };

            const title = document.getElementById('main-title');
            const breadcrumb = document.getElementById('breadcrumb-current');
            const userBtnContent = document.getElementById('icon-content');
            const btnUsers = document.getElementById('btn-users');

            Object.values(views).forEach(v => { if (v) v.style.display = 'none'; });

            if (viewName === 'analytics') {
                views.analytics.style.display = 'block';
                setTimeout(initHistoryChart, 100);
                title.innerText = 'Detailed Analytics';
                breadcrumb.innerHTML = `<a href="#" onclick="showView('overview')">System Overview</a> / Analytics`;
            } else if (viewName === 'users') {
                views.users.style.display = 'block';
                title.innerText = 'Users';
                breadcrumb.innerHTML = `<a href="#" onclick="showView('overview')">System Overview</a> / Users`;
            } else if (viewName === 'facilities') {
                views.facilities.style.display = 'block';
                title.innerText = 'Facilities';
                breadcrumb.innerHTML = `<a href="#" onclick="showView('overview')">System Overview</a> / Facilities`;
            } else if (viewName === 'courses') {
                views.courses.style.display = 'block';
                title.innerText = 'Available Courses';
                breadcrumb.innerHTML = `<a href="#" onclick="showView('overview')">System Overview</a> / Courses`;
            } else if (viewName === 'settings') {
                views.settings.style.display = 'block';
                title.innerText = 'System Settings';
                breadcrumb.innerHTML = `<a href="#" onclick="showView('overview')">System Overview</a> / Settings`;
            } else if (viewName === 'all-trainees' || viewName === 'all-trainers') {
                const pageLabel = viewName === 'all-trainees' ? 'Trainees' : 'Trainers';
                views.allList.style.display = 'block';
                title.innerText = pageLabel;
                breadcrumb.innerHTML = `<a href="#" onclick="showView('overview')">System Overview</a> / <a href="#" onclick="showView('users')">Users</a> / ${pageLabel}`;
            } else {
                views.overview.style.display = 'block';
                title.innerText = 'System Overview';
                breadcrumb.innerHTML = `System Overview`;
            }

            // Toggle Sidebar Shortcut behavior
            if (viewName === 'overview') {
                userBtnContent.innerHTML = `<i class="fa-solid fa-users"></i><p>Users</p>`;
                btnUsers.setAttribute('onclick', "showView('users')");
            } else {
                userBtnContent.innerHTML = `<i class="fa-solid fa-gauge-high"></i><p>System Overview</p>`;
                btnUsers.setAttribute('onclick', "showView('overview')");
            }
        }

        // --- 4. Dropdown & Updates ---
        function toggleDropdown(event) {
            event.stopPropagation();
            document.getElementById("logout-dropdown").classList.toggle("show");
        }

        function toggleUpdates() {
            const extra = document.getElementById("extra-updates");
            const btn = document.getElementById("viewMoreBtn");
            if (extra.style.display === "none") {
                extra.style.display = "block";
                btn.innerHTML = `View Less <i class="fa-solid fa-chevron-up"></i>`;
            } else {
                extra.style.display = "none";
                btn.innerHTML = `View More <i class="fa-solid fa-chevron-down"></i>`;
            }
        }

        // --- 5. Pagination Logic ---
        function changePage(pageNum) {
            const allPageBtns = document.querySelectorAll('.page-numbers .page-btn');
            allPageBtns.forEach(btn => {
                btn.classList.remove('active');
                if (parseInt(btn.innerText) === pageNum) btn.classList.add('active');
            });

            const listBody = document.querySelector('.user-list-body');
            listBody.style.opacity = '0.3';
            
            setTimeout(() => {
                listBody.style.opacity = '1';
                // Simulation of data change
                if(pageNum === 2) {
                    listBody.innerHTML = `<div class="user-item"><i class="fa-solid fa-circle-user profile-icon"></i><div class="user-info"><strong>CARL JUSTINE</strong><br><small>carl@example.com</small></div><button class="btn-view" onclick="openUserModal('CARL JUSTINE', 'carl@example.com', 'Trainee', 'Active')">View</button></div>`;
                } else if (pageNum === 1) {
                    listBody.innerHTML = `<div class="user-item"><i class="fa-solid fa-circle-user profile-icon"></i><div class="user-info"><strong>MICHAELA BOCITA</strong><br><small>mmsbocita@gmail.com</small></div><button class="btn-view" onclick="openUserModal('MICHAELA BOCITA', 'mmsbocita@gmail.com', 'Trainee', 'Active')">View</button></div>`;
                }
            }, 250);
        }

        function movePage(step) {
            const activeBtn = document.querySelector('.page-numbers .page-btn.active');
            if (!activeBtn) return;
            let currentPage = parseInt(activeBtn.innerText);
            let newPage = currentPage + step;
            if (newPage >= 1 && newPage <= 3) changePage(newPage);
        }

        // --- 6. Modal Handlers ---
        function openCourseModal(name, duration, enrolled) {
            document.getElementById('courseModal').style.display = 'block';
            document.getElementById('editCourseName').value = name;
            document.getElementById('editDuration').value = duration;
            document.getElementById('editEnrolled').value = enrolled;
        }

        function closeModal() { document.getElementById('courseModal').style.display = 'none'; }

        function openUserModal(name, email, role, status) {
            document.getElementById('userModal').style.display = 'block';
            document.getElementById('editUserName').value = name;
            document.getElementById('editUserEmail').value = email;
            document.getElementById('editUserRole').value = role;
            document.getElementById('editUserStatus').value = status;
        }

        function closeUserModal() { document.getElementById('userModal').style.display = 'none'; }

        function openFacilityModal(name, address, capacity, course) {
            document.getElementById('facilityModal').style.display = 'block';
            document.getElementById('editFacName').value = name;
            document.getElementById('editFacAddress').value = address;
            document.getElementById('editFacCap').value = capacity;
            document.getElementById('editFacCourse').value = course;
        }

        function closeFacilityModal() { document.getElementById('facilityModal').style.display = 'none'; }

        // --- 7. Global Click Handler ---
        window.onclick = function (event) {
            if (!event.target.closest('.user-welcome')) {
                document.getElementById("logout-dropdown").classList.remove("show");
            }
            if (event.target.classList.contains('modal')) {
                closeModal();
                closeUserModal();
                closeFacilityModal();
            }
        }
    </script>
</body>

</html>