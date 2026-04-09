<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainees</title>
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
            <img src="images/logo.png" alt="Logo" class="logo">
        </div>
        <div class="user-welcome">
            Welcome, <strong>Admin!</strong>
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
                        <a href="#" class="view-more">View more</a>
                    </div>
                    <div class="card chart-card">
                        <h3>Courses</h3>
                        <canvas id="courseChart"></canvas>
                        <a href="#" class="view-more">View more</a>
                    </div>
                </div>

                <div class="card updates-card">
                    <h3><i class="fa-solid fa-bell"></i> Updates</h3>
                    <ul class="update-list">
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <div>
                                <strong>Change of Training Location</strong><br>
                                <small>Zone 4, San Placido Campos Avenue, Dasmariñas, Cavite</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> <div id="view-users" style="display: none;">
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
                    <button class="btn-all">View All Trainees</button>
                </div>

                <div class="card list-card">
                    <h3>Trainers</h3>
                    <button class="btn-all">View All Trainers</button>
                </div>
            </div> </div> <div class="sidebar-stats">
            <div class="shortcut-grid">
                <div class="card icon-card" id="btn-users" onclick="showView('users')">
                    <div id="icon-content">
                        <i class="fa-solid fa-users"></i>
                        <p>Users</p>
                    </div>
                </div>
                <div class="card icon-card"><i class="fa-solid fa-building"></i><p>Facilities</p></div>
                <div class="card icon-card"><i class="fa-solid fa-book"></i><p>Courses</p></div>
                <div class="card icon-card"><i class="fa-solid fa-gear"></i><p>Settings</p></div>
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
                    <li>Login / Register</li>
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

    <script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      fixedWeekCount: false,
      headerToolbar: {
        left: 'prev',
        center: 'title',
        right: 'next'
      },
      // This matches the green theme from your image
      eventColor: '#004d26', 
      height: 'auto',
    });
    calendar.render();
  });

  const ctxBar = document.getElementById('traineeChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: ['Sept', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            data: [40, 65, 80, 95], // Matches the rising bars in your image
            backgroundColor: '#004d26', // Your Capstone's signature green
            borderRadius: 4,
            barPercentage: 0.6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false } // Hides the "Dataset 1" label
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { display: false },
                ticks: { display: false } // Keeps it clean like your design
            },
            x: {
                grid: { display: false }
            }
        }
    }
});

// --- Courses Line Chart ---
// Assuming you have <canvas id="courseChart"></canvas> in your other card
const ctxLine = document.getElementById('courseChart')?.getContext('2d');
if (ctxLine) {
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Carpentry',
                    data: [30, 58, 98, 65],
                    borderColor: '#c19a6b', // Gold/Tan
                    backgroundColor: '#c19a6b',
                    tension: 0.3,
                    pointStyle: 'rectRot'
                },
                {
                    label: 'Dressmaking',
                    data: [45, 68, 40, 82],
                    borderColor: '#6b9e7c', // Muted Green
                    backgroundColor: '#6b9e7c',
                    tension: 0.3,
                    pointStyle: 'circle'
                },
                {
                    label: 'Candle Making',
                    data: [25, 62, 25, 18],
                    borderColor: '#f4d03f', // Yellow
                    backgroundColor: '#f4d03f',
                    tension: 0.3,
                    pointStyle: 'triangle'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, boxWidth: 8, font: { size: 10 } }
                }
            },
            scales: {
                y: { grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });
}


function showView(viewName) {
    const overview = document.getElementById('view-overview');
    const users = document.getElementById('view-users');
    const allList = document.getElementById('view-all-list');
    const title = document.getElementById('main-title');
    const breadcrumb = document.getElementById('breadcrumb-current');
    const userBtnContent = document.getElementById('icon-content');

    // 1. Hide all views by default
    overview.style.display = 'none';
    users.style.display = 'none';
    if(allList) allList.style.display = 'none';

    // 2. Logic for each view
    if (viewName === 'users') {
        users.style.display = 'block';
        title.innerText = 'Users';
        
        // Update Breadcrumb: Home / Dashboard / Users
        breadcrumb.innerHTML = `<a href="#" onclick="showView('overview')">System Overview</a> / Users`;
        
        // Change Sidebar Button to "System Overview"
        userBtnContent.innerHTML = `
            <i class="fa-solid fa-gauge-high"></i>
            <p>System Overview</p>
        `;
        document.getElementById('btn-users').setAttribute('onclick', "showView('overview')");
    } 
    else if (viewName === 'all-trainees' || viewName === 'all-trainers') {
        const isTrainee = viewName === 'all-trainees';
        const pageLabel = isTrainee ? 'Trainees' : 'Trainers';
        
        if(allList) allList.style.display = 'block';
        title.innerText = pageLabel;
        
        // Update Breadcrumb: Home / Dashboard / Users / Trainees
        breadcrumb.innerHTML = `
            <a href="#" onclick="showView('overview')">System Overview</a> / 
            <a href="#" onclick="showView('users')">Users</a> / 
            ${pageLabel}
        `;
        
        // Keep Sidebar showing "System Overview" while inside sub-user pages
        userBtnContent.innerHTML = `
            <i class="fa-solid fa-gauge-high"></i>
            <p>System Overview</p>
        `;
        document.getElementById('btn-users').setAttribute('onclick', "showView('overview')");
    } 
    else {
        // Default to Overview
        overview.style.display = 'block';
        title.innerText = 'System Overview';
        
        // Update Breadcrumb: Home / Dashboard / Overview
        breadcrumb.innerHTML = ` System Overview`;
        
        // Reset Sidebar Button to "Users"
        userBtnContent.innerHTML = `
            <i class="fa-solid fa-users"></i>
            <p>Users</p>
        `;
        document.getElementById('btn-users').setAttribute('onclick', "showView('users')");
    }
}
</script>



    

    

</body>
</html>