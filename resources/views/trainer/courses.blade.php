@extends('trainer.layout')

@section('title', 'Courses')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylesheet/courses.css') }}">
@endsection

@section('content')
            <div class="courses-panel">
                <h2 class="panel-title">Courses</h2>
                
                <div class="courses-grid">
                    <div class="course-card">
                        <div class="card-img">
                            <img src="{{ asset('images/1.jpg') }}" alt="Computer Literacy">
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
                            <img src="{{ asset('images/2.jpg') }}" alt="Fashion Bayong">
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
                            <img src="{{ asset('images/3.jpg') }}" alt="Candle Making">
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
                            <img src="{{ asset('images/4.jpg') }}" alt="Hilot Wellness">
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
                            <img src="{{ asset('images/5.jpg') }}" alt="Basic Sewing">
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
    @endsection
    
   @section('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const viewModal = document.getElementById("viewCourseModal");
        const editBtn = document.getElementById("masterEditBtn");
        const backBtn = document.getElementById("finalBackBtn");
        const addModal = document.getElementById("courseModal");
        const openAddBtn = document.getElementById("openModal");
        const closeAddX = document.getElementById("closeX");
        const cancelAddBtn = document.getElementById("cancelBtn");

        document.querySelectorAll(".view-btn").forEach(btn => {
            btn.onclick = (e) => {
                e.preventDefault();
                viewModal.style.display = "flex";
            };
        });

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

        const closeViewAll = () => {
            viewModal.style.display = "none";
            document.querySelectorAll(".edit-group").forEach(g => g.classList.add("hidden"));
            if(editBtn) editBtn.innerHTML = '<i class="fas fa-pen-to-square"></i> Edit Course';
        };
        if(backBtn) backBtn.onclick = closeViewAll;

        if (openAddBtn) openAddBtn.onclick = () => addModal.style.setProperty('display', 'flex', 'important');
        if (closeAddX) closeAddX.onclick = () => addModal.style.display = "none";
        if (cancelAddBtn) cancelAddBtn.onclick = () => addModal.style.display = "none";

        window.onclick = function(event) {
            if (event.target == viewModal) closeViewAll();
            if (event.target == addModal) addModal.style.display = "none";
        };
    });
    </script>
@endsection