@extends('trainer.layout')

@section('title', 'Trainees')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylesheet/learner.css') }}">
    <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">
@endsection

@section('content')
    <h2 class="panel-title">Trainees</h2>

    <section class="stats-grid">
    <div class="stat-card"><h3>{{ $totalRegistered }}</h3><p>Total Registered</p></div>
    <div class="stat-card"><h3>{{ $currentlyEnrolled }}</h3><p>Currently Enrolled</p></div>
    <div class="stat-card"><h3>{{ $graduates }}</h3><p>Certified Graduates</p></div>
    <div class="stat-card urgent"><h3>{{ $urgentAssessments }}</h3><p>Urgent Assessments</p></div>
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
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Course</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
            <tr>
                <td>{{ str_pad($enrollment->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td class="name">{{ $enrollment->user->lastname }}, {{ $enrollment->user->firstname }}</td>
                <td class="course">{{ $enrollment->course->title }}</td>
                <td>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: {{ $enrollment->progress }}%;"></div>
                    </div>
                    <small class="progress-text">{{ $enrollment->progress }}%</small>
                </td>
                <td class="{{ $enrollment->status === 'active' ? 'status-active' : 'status-wait' }}">
                    {{ ucfirst($enrollment->status) }}
                </td>
                <td class="action-icons">
                    <i class="fas fa-eye view" onclick="openProfile()"></i>
                    <i class="fas fa-edit edit"></i>
                    <i class="fas fa-trash-alt delete"></i>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-table-msg">No students enrolled yet.</td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>

    <div class="bottom-controls">
        <button class="add-trainee-text" onclick="openAddModal()">
            <i class="fas fa-plus-square"></i> Add New Trainee
        </button>
        <button class="export-pill-btn">Export to Excel</button>
    </div>

    {{-- Modals --}}
    <div id="addTraineeModal" class="modal-overlay">
        <div class="modal-box profile-modal">
            <div class="modal-body">
                <h2 class="modal-title">Add New Trainee</h2>
                <form id="addTraineeForm">
                    @csrf
                    <div class="info-content">
                        <h3 class="section-header">Basic Information</h3>
                        <input type="text" name="fullname" placeholder="Full Name (Last, First)" class="form-input" required>
                        <input type="text" name="address" placeholder="Barangay / Address" class="form-input" required>
                        <div class="form-row-group">
                            <input type="number" name="age" placeholder="Age" class="form-input" required>
                            <select name="gender" class="form-input" required>
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
                    <div class="doc-item done"><i class="fas fa-check-circle"></i> 2x2 Picture</div>
                    <div class="doc-item missing"><i class="fas fa-times-circle"></i> Valid ID (Missing)</div>
                </div>
                <div class="modal-footer-centered">
                    <button class="export-pill-btn" onclick="closeProfile()">Close Profile</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openAddModal() { document.getElementById("addTraineeModal").style.display = "flex"; }
        function closeAddModal() { document.getElementById("addTraineeModal").style.display = "none"; }
        function openProfile() { document.getElementById("profileModal").style.display = "flex"; }
        function closeProfile() { document.getElementById("profileModal").style.display = "none"; }
        window.onclick = function(event) {
            const addModal = document.getElementById("addTraineeModal");
            const profModal = document.getElementById("profileModal");
            if (event.target == addModal) addModal.style.display = "none";
            if (event.target == profModal) profModal.style.display = "none";
        }
    </script>
@endsection