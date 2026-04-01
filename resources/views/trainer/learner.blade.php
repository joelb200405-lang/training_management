<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEDIPO Trainer Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/learner.css">
    
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
                <li><a href="teacher"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="courses"><i class="fas fa-book"></i> Courses</a></li>
                <li class="learner"><a href=" "><i class="fas fa-users"></i> Trainees</a></li>
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

            <h2 class="panel-title">Trainees</h2>

            <section class="stats-grid">
                <div class="stat-card"><h3>67</h3><p>Total Registered</p></div>
                <div class="stat-card"><h3>67</h3><p>Currently Enrolled</p></div>
                <div class="stat-card"><h3>67</h3><p>Certified Graduates</p></div>
                <div class="stat-card urgent"><h3>07</h3><p>Urgent Assessments</p></div>
            </section>

            <div class="filter-row">
                <div class="filter-btn">Filter by: Course <i class="fas fa-caret-down"></i></div>
                <div class="filter-btn">Filter by: Barangay <i class="fas fa-caret-down"></i></div>
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
                <button class="add-trainee-text" onclick="openAddModal()">
                    <i class="fas fa-plus-square"></i> Add New Trainee
                </button>
                <button class="export-pill-btn">Export to Excel</button>
            </div>
        </main>
    </div>

    <div id="addTraineeModal" class="modal-overlay">
        <div class="modal-box profile-modal">
            <div class="modal-body">
                <h2 class="modal-title">Add New Trainee</h2>
                <form id="addTraineeForm" action="process_trainee.php" method="POST">
                    <div class="info-content">
                        <h3 class="section-header">Basic Information</h3>
                        <input type="text" name="fullname" placeholder="Full Name (Last, First)" class="form-input" required>
                        <input type="text" name="address" placeholder="Barangay / Address" class="form-input" required>
                        
                        <div style="display: flex; gap: 10px; justify-content: center;">
                            <input type="number" name="age" placeholder="Age" class="form-input" style="width: 80px;" required>
                            <select name="gender" class="form-input" style="width: 120px;" required>
                                <option value="" disabled selected>Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="info-content">
                        <h3 class="section-header">Course Enrollment</h3>
                        <select name="course" class="form-input" required>
                            <option value="" disabled selected>Select Course</option>
                            <option value="Nail Care">Nail Care</option>
                            <option value="Candle Making">Candle Making</option>
                            <option value="Computer Literacy">Computer Literacy</option>
                        </select>
                    </div>

                    <div class="modal-footer-centered">
                        <button type="submit" class="export-pill-btn">Save Trainee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="profileModal" class="modal-overlay">
        <div class="modal-box profile-modal">
            <div class="modal-body">
                <h2 class="modal-title">Trainee Profile</h2>

                <div class="profile-photo-circle">
                    <i class="fas fa-user"></i>
                </div>

                <div class="profile-header-info">
                    <h2 class="trainee-full-name">Bong, Marcos</h2>
                    <p class="trainee-id-tag">ID: 2023-2-0018</p>
                </div>

                <hr class="modal-divider">

                <div class="info-content">
                    <h3 class="section-header">Personal Info</h3>
                    <p><strong>Address:</strong> Salitran II, Dasmariñas, Cavite</p>
                    <p><strong>Age:</strong> 24 | <strong>Gender:</strong> Male</p>
                    <p><strong>Course:</strong> Nail Care</p>
                </div>

                <div class="info-content">
                    <h3 class="section-header">Documents</h3>
                    <div class="doc-item done">
                        <i class="fas fa-check-circle"></i> 2x2 Picture
                    </div>
                    <div class="doc-item missing">
                        <i class="fas fa-times-circle"></i> Valid ID (Missing)
                    </div>
                </div>

                <div class="modal-footer-centered">
                    <button class="export-pill-btn" onclick="closeProfile()">Close Profile</button>
                </div>
            </div>
        </div>
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

    <script>
        // Modal Control Functions
        function openAddModal() {
            document.getElementById("addTraineeModal").style.display = "flex";
        }

        function closeAddModal() {
            document.getElementById("addTraineeModal").style.display = "none";
        }

        function openProfile() {
            document.getElementById("profileModal").style.display = "flex";
        }

        function closeProfile() {
            document.getElementById("profileModal").style.display = "none";
        }

        // Global window click to close modals
        window.onclick = function(event) {
            const addModal = document.getElementById("addTraineeModal");
            const profModal = document.getElementById("profileModal");
            
            if (event.target == addModal) { addModal.style.display = "none"; }
            if (event.target == profModal) { profModal.style.display = "none"; }
        }
    </script>

</body>
</html>