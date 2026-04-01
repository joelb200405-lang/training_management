<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEDIPO Trainer Dashboard</title>
    
    <link rel="stylesheet" href="stylesheet/courses.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                <li class="courses"><a href=" "><i class="fas fa-book"></i> Courses</a></li>
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

            <div class="courses-panel">
                <h2 class="panel-title">Courses</h2>
                
                <div class="courses-grid">
                    <div class="course-card">
                        <div class="card-img">
                            <img src="1.jpg" alt="Computer Literacy">
                        </div>
                        <div class="card-body">
                            <h3>Computer Literacy</h3>
                            <p>Instructor: Iya Hufancia</p>
                            <p>Enrollment Status: 18/ 20</p>
                            <a href="#" class="view-btn">View Course</a>
                        </div>
                    </div>

                    <div class="course-card">
                        <div class="card-img">
                            <img src="2.jpg" alt="Fashion Bayong">
                        </div>
                        <div class="card-body">
                            <h3>Fashion Bayong</h3>
                            <p>Instructor: Joel Bermudez</p>
                            <p>Enrollment Status: 14/ 15</p>
                            <a href="#" class="view-btn">View Course</a>
                        </div>
                    </div>

                    <div class="course-card">
                        <div class="card-img">
                            <img src="3.jpg" alt="Candle Making">
                        </div>
                        <div class="card-body">
                            <h3>Candle Making</h3>
                            <p>Instructor: Cesar Galingana</p>
                            <p>Enrollment Status: 20/ 20</p>
                            <a href="#" class="view-btn">View Course</a>
                        </div>
                    </div>

                    <div class="course-card">
                        <div class="card-img">
                            <img src="4.jpg" alt="Hilot Wellness">
                        </div>
                        <div class="card-body">
                            <h3>Hilot Wellness</h3>
                            <p>Instructor: Myrna Lana</p>
                            <p>Enrollment Status: 15/ 15</p>
                            <a href="#" class="view-btn">View Course</a>
                        </div>
                    </div>

                    <div class="course-card">
                        <div class="card-img">
                            <img src="5.jpg" alt="Basic Sewing">
                        </div>
                        <div class="card-body">
                            <h3>Basic Sewing</h3>
                            <p>Instructor: Rogelio Amoyan</p>
                            <p>Enrollment Status: 19/ 20</p>
                            <a href="#" class="view-btn">View Course</a>
                        </div>
                    </div>

                    <div class="create-card" id="openModal" style="cursor: pointer;">
                        <div class="create-inner">
                            <i class="fas fa-plus"></i>
                            <p>Create New Course</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="viewCourseModal" class="modal-overlay">
        <div class="modal-box details-modal">
            <div class="details-header">
                <h2 id="modalCourseTitle">Computer Literacy</h2>
            </div>

            <div class="details-grid">
                <div class="details-col">
                    <div class="info-box">
                        <h4 class="section-tag">Schedule</h4>
                        <div class="content-list">
                            <p>Tuesday 1:00 PM – 4:00 PM</p>
                            <p>Friday 8:00 PM – 11:00 PM</p>
                        </div>
                        <div class="box-actions">
                            <div class="edit-group hidden">
                                <button class="action-btn delete-text"><i class="fas fa-trash"></i> Delete</button>
                                <button class="action-btn edit-text"><i class="fas fa-edit"></i> Edit</button>
                            </div>
                            <button class="action-btn add-text"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="info-box">
                        <h4 class="section-tag">Training Venue</h4>
                        <div class="content-list">
                            <p>Laboratory 2 Room 301</p>
                        </div>
                        <div class="box-actions">
                            <div class="edit-group hidden">
                                <button class="action-btn delete-text"><i class="fas fa-trash"></i> Delete</button>
                                <button class="action-btn edit-text"><i class="fas fa-edit"></i> Edit</button>
                            </div>
                            <button class="action-btn add-text"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>

                <div class="details-col">
                    <div class="info-box">
                        <h4 class="section-tag">Syllabus</h4>
                        <div class="content-list">
                            <p>Lesson 1</p>
                            <p>Lesson 2</p>
                        </div>
                        <div class="box-actions">
                            <div class="edit-group hidden">
                                <button class="action-btn delete-text"><i class="fas fa-trash"></i> Delete</button>
                                <button class="action-btn edit-text"><i class="fas fa-edit"></i> Edit</button>
                            </div>
                            <button class="action-btn add-text"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="info-box">
                        <h4 class="section-tag">Recently Enrolled</h4>
                        <div class="content-list">
                            <p>Nelmida, Rheyan</p>
                            <p>Fampulme, Justine</p>
                            <p>Ramos, Roshian</p>
                        </div>
                        <button class="view-all-pill">View all</button>
                    </div>
                </div>

                <div class="details-col">
                    <div class="info-box">
                        <h4 class="section-tag">Assessment</h4>
                        <div class="content-list">
                            <p>Quiz 1</p>
                            <p>Quiz 2</p>
                        </div>
                        <div class="box-actions">
                            <div class="edit-group hidden">
                                <button class="action-btn delete-text"><i class="fas fa-trash"></i> Delete</button>
                                <button class="action-btn edit-text"><i class="fas fa-edit"></i> Edit</button>
                            </div>
                            <button class="action-btn add-text"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="details-footer">
                <div class="footer-left">
                    <button class="main-edit-btn" id="masterEditBtn">
                        <i class="fas fa-pen-to-square"></i> Edit Course
                    </button>
                </div>
                <button class="back-pill-btn" id="finalBackBtn">Back</button>
            </div>
        </div>
    </div>

    <div id="courseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h2 style="color: #004d26; margin: 0;">Add New Course</h2>
                <span class="close-x" id="closeX" style="cursor:pointer; font-size:28px;">&times;</span>
            </div>
            
            <form action="save_course.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body" style="padding: 20px 0; max-height: 400px; overflow-y: auto;">
                    
                    <div style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        <h4 style="color: #666; margin-bottom: 10px;">Core Course Details</h4>
                        <input type="text" name="course_name" placeholder="Course Name" required 
                               style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        
                        <select name="category" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                            <option value="">Select Category</option>
                            <option>Livelihood</option>
                            <option>ICT</option>
                            <option>Tech-Voc</option>
                            <option>Health & Wellness</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        <h4 style="color: #666; margin-bottom: 10px;">Instructor</h4>
                        <input type="text" name="instructor" placeholder="Assigned Instructor" 
                               style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <input type="number" name="capacity" placeholder="Max Capacity" 
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <h4 style="color: #666; margin-bottom: 10px;">Schedule</h4>
                        <label style="font-size: 12px; color: #888;">Start Date</label>
                        <input type="date" name="start_date" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <label style="font-size: 12px; color: #888;">End Date</label>
                        <input type="date" name="end_date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                </div>

                <div class="modal-footer" style="display: flex; justify-content: flex-end; gap: 10px; padding-top: 15px; border-top: 1px solid #eee;">
                    <button type="button" id="cancelBtn" style="padding: 10px 20px; border: none; background: #eee; border-radius: 5px; cursor: pointer;">Cancel</button>
                    <button type="submit" style="padding: 10px 20px; border: none; background: #004d26; color: white; border-radius: 5px; cursor: pointer;">Publish</button>
                </div>
            </form>
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
    document.addEventListener("DOMContentLoaded", function() {
        // VIEW MODAL ELEMENTS
        const viewModal = document.getElementById("viewCourseModal");
        const editBtn = document.getElementById("masterEditBtn");
        const backBtn = document.getElementById("finalBackBtn");

        // ADD MODAL ELEMENTS
        const addModal = document.getElementById("courseModal");
        const openAddBtn = document.getElementById("openModal");
        const closeAddX = document.getElementById("closeX");
        const cancelAddBtn = document.getElementById("cancelBtn");

        // 1. Open View Modal
        document.querySelectorAll(".view-btn").forEach(btn => {
            btn.onclick = (e) => {
                e.preventDefault();
                viewModal.style.display = "flex";
            };
        });

        // 2. View Modal Edit Toggle
        if (editBtn) {
            editBtn.onclick = function() {
                const groups = document.querySelectorAll(".edit-group");
                groups.forEach(g => g.classList.toggle("hidden"));

                if (this.innerHTML.includes("Edit Course")) {
                    this.innerHTML = '<i class="fas fa-check"></i> Finish Editing';
                } else {
                    this.innerHTML = '<i class="fas fa-pen-to-square"></i> Edit Course';
                }
            };
        }

        // 3. View Modal Close
        const closeViewAll = () => {
            viewModal.style.display = "none";
            document.querySelectorAll(".edit-group").forEach(g => g.classList.add("hidden"));
            if(editBtn) editBtn.innerHTML = '<i class="fas fa-pen-to-square"></i> Edit Course';
        };
        if(backBtn) backBtn.onclick = closeViewAll;

        // 4. Add Modal Logic
        if (openAddBtn) {
            openAddBtn.onclick = () => addModal.style.setProperty('display', 'flex', 'important');
        }
        if (closeAddX) closeAddX.onclick = () => addModal.style.display = "none";
        if (cancelAddBtn) cancelAddBtn.onclick = () => addModal.style.display = "none";

        // Global Close on Background Click
        window.onclick = function(event) {
            if (event.target == viewModal) closeViewAll();
            if (event.target == addModal) addModal.style.display = "none";
        };
    });
    </script>

</body>
</html>