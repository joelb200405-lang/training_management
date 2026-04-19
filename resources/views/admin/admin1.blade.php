<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - System Overview</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/admin-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

    <style>
        .assign-trainer-section {
            background: #f0faf3;
            border: 1px solid rgba(2, 86, 40, 0.15);
            border-radius: 10px;
            padding: 14px 16px;
            margin-top: 14px;
        }
        .assign-trainer-label {
            font-size: 12px;
            font-weight: 700;
            color: #025628;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .assign-trainer-row {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 10px;
        }
        .assign-trainer-row select {
            flex: 1;
            border: 1px solid rgba(0,0,0,0.12);
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 13px;
            font-family: inherit;
            outline: none;
            background: #fff;
        }
        .assign-trainer-row select:focus { border-color: #025628; }
        .btn-assign {
            background: #025628;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            white-space: nowrap;
        }
        .btn-assign:hover { background: #014d20; }
        .current-trainer-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 8px;
            padding: 10px 12px;
        }
        .trainer-avatar-sm {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #e8f5e9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: #025628;
            flex-shrink: 0;
        }
        .trainer-details { flex: 1; }
        .trainer-fullname { font-size: 13px; font-weight: 700; color: #1a1a1a; }
        .trainer-sub { font-size: 11px; color: #888; }
        .btn-remove-trainer {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 6px;
            background: #FCEBEB;
            color: #A32D2D;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-weight: 700;
            white-space: nowrap;
        }
        .no-trainer-box {
            font-size: 12px;
            color: #aaa;
            text-align: center;
            padding: 8px 0;
        }
    </style>
</head>

<body>

    {{-- ===== TOPBAR (katulad ng student layout) ===== --}}
    <nav class="topbar">
        <div class="topbar-left">
            <button class="hamburger" id="hamburger" aria-label="Toggle sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="{{ route('admin1') }}" class="topbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="topbar-logo">
                <span>LEDIPO</span>
            </a>
        </div>

        <div class="topbar-right">
            <button class="avatar-btn" id="avatarBtn" aria-label="Open profile menu">AD</button>

            <div class="dropdown" id="dropdown">
                <div class="dropdown-header">
                    <div class="dh-name">Administrator</div>
                    <div class="dh-role">Admin</div>
                </div>

                <div class="dd-divider"></div>

                <form action="{{ route('Logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dd-item dd-logout"
                        style="width:100%; border:none; background:none; text-align:left; cursor:pointer; padding: 10px 16px; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-right-from-bracket dd-icon"></i>
                        Log out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- ===== APP BODY ===== --}}
    <div class="app-body">

        <div class="sidebar-overlay" id="overlay"></div>

        {{-- ===== SIDEBAR (katulad ng student layout) ===== --}}
        <aside class="sidebar" id="sidebar">

            <div class="sidebar-section-label">Menu</div>

            <a href="#" class="nav-item active" id="nav-overview"
               onclick="showView('overview'); setActive(this); return false;">
                <i class="fa fa-gauge-high nav-icon"></i>
                <span>Overview</span>
            </a>

            <div class="sidebar-section-label">Manage</div>

            <a href="#" class="nav-item" id="nav-trainees"
               onclick="showView('all-trainees'); setActive(this); return false;">
                <i class="fa fa-user-graduate nav-icon"></i>
                <span>Trainees</span>
            </a>

            <a href="#" class="nav-item" id="nav-trainers"
               onclick="showView('all-trainers'); setActive(this); return false;">
                <i class="fa fa-chalkboard-user nav-icon"></i>
                <span>Trainers</span>
            </a>

            <a href="#" class="nav-item" id="nav-courses"
               onclick="showView('courses'); setActive(this); return false;">
                <i class="fa fa-book nav-icon"></i>
                <span>Courses</span>
            </a>

            <a href="#" class="nav-item" id="nav-facilities"
               onclick="showView('facilities'); setActive(this); return false;">
                <i class="fa fa-building nav-icon"></i>
                <span>Facilities</span>
            </a>

            <div class="sidebar-section-label">System</div>

            <a href="#" class="nav-item" id="nav-analytics"
               onclick="showView('analytics'); setActive(this); return false;">
                <i class="fa fa-chart-line nav-icon"></i>
                <span>Analytics</span>
            </a>

            <a href="#" class="nav-item" id="nav-settings"
               onclick="showView('settings'); setActive(this); return false;">
                <i class="fa fa-gear nav-icon"></i>
                <span>Settings </span>
            </a>



        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <main class="admin-main">
            <nav class="breadcrumb">
                <a href="#" onclick="showView('overview'); return false;">Home</a> /
                <span id="breadcrumb-current">System Overview</span>
            </nav>
            <h1 class="page-title" id="main-title">System Overview</h1>

            {{-- OVERVIEW --}}
            <div id="view-overview">
                <div class="charts-row">
                    <div class="card chart-card">
                        <h3>Trainees</h3>
                        <canvas id="traineeChart"></canvas>
                        <a href="#" class="view-more" onclick="showView('analytics'); setActive(document.getElementById('nav-analytics')); return false;">View more</a>
                    </div>
                    <div class="card chart-card">
                        <h3>Courses</h3>
                        <canvas id="courseChart"></canvas>
                        <a href="#" class="view-more" onclick="showView('analytics'); setActive(document.getElementById('nav-analytics')); return false;">View more</a>
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
                    <div style="text-align: center; margin-top: 15px;">
                        <button class="view-more-btn" id="viewMoreBtn" onclick="toggleUpdates()">
                            View More <i class="fa-solid fa-chevron-down"></i>
                        </button>
                    </div>

                                {{-- Calendar sa sidebar bottom --}}
            <div class="sidebar-calendar">
                <div id="calendar"></div>
            </div>
                </div>
            </div>

            {{-- ANALYTICS --}}
            <div id="view-analytics" style="display: none;">
                <div class="analytics-header-row">
                    <h3><i class="fa-solid fa-chart-line"></i> Detailed System Analytics</h3>
                    <button class="btn-cancel" onclick="showView('overview'); setActive(document.getElementById('nav-overview'));">Back to Overview</button>
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

            {{-- TRAINEE LIST --}}
            <div id="view-trainee-list" style="display: none;">
                <div class="card list-card">
                    <div class="card-header">
                        <h3>Trainee Directory</h3>
                    </div>
                    <div class="user-list-body" id="trainee-list-content">
                        <div class="user-item">
                            <i class="fa-solid fa-circle-user profile-icon"></i>
                            <div class="user-info">
                                <strong>MICHAELA BOCITA</strong><br>
                                <small>mmsbocita@gmail.com</small>
                            </div>
                            <button class="btn-view" onclick="openUserModal('MICHAELA BOCITA', 'mmsbocita@gmail.com', 'Trainee', 'Active')">View</button>
                        </div>
                    </div>
                    <div class="pagination-container">
                        <button class="page-btn"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="page-numbers"><button class="page-btn active">1</button></div>
                        <button class="page-btn"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            {{-- TRAINER LIST --}}
            <div id="view-trainer-list" style="display: none;">
                <div class="card list-card">
                    <div class="card-header">
                        <h3>Trainer Directory</h3>
                    </div>
                    <div class="user-list-body" id="trainer-list-content">
                        <div class="user-item">
                            <i class="fa-solid fa-user-tie profile-icon" style="color: #004d26;"></i>
                            <div class="user-info">
                                <strong>RUSSEL ROBERT</strong><br>
                                <small>russel.r@example.com</small>
                            </div>
                            <button class="btn-view" onclick="openUserModal('RUSSEL ROBERT', 'russel.r@example.com', 'Trainer', 'Active')">View</button>
                        </div>
                    </div>
                    <div style="text-align: center; margin-bottom: 20px;">
                        <button class="btn-save-main" onclick="openAddTrainerModal()" style="width: auto; padding: 10px 15px;">
                            <i class="fa-solid fa-plus"></i> Add New Trainer
                        </button>
                    </div>
                    <div class="pagination-container">
                        <button class="page-btn"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="page-numbers"><button class="page-btn active">1</button></div>
                        <button class="page-btn"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            {{-- FACILITIES --}}
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
                <div style="text-align: center; margin-top: 20px;">
                    <button class="btn-save-main" onclick="openAddFacilityModal()" style="width: auto; padding: 10px 15px;">
                        <i class="fa-solid fa-plus"></i> Add New Facility
                    </button>
                </div>
                <div class="pagination-container">
                    <button class="page-btn prev"><i class="fa-solid fa-chevron-left"></i></button>
                    <div class="page-numbers">
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                    </div>
                    <button class="page-btn next"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

            {{-- COURSES --}}
            <div id="view-courses" style="display: none;">
                <div class="courses-grid">
                    @forelse($courses as $course)
                        @php
                            $assignedTrainer = $course->trainer_id
                                ? $trainers->firstWhere('id', $course->trainer_id)
                                : null;
                            $trainerName = $assignedTrainer
                                ? $assignedTrainer->firstname . ' ' . $assignedTrainer->lastname
                                : '';
                        @endphp
                        <div class="card course-card">
                            <div class="course-badge {{ $course->status === 'active' ? 'active' : 'inactive' }}">
                                {{ ucfirst($course->status) }}
                            </div>
                            <i class="fa-solid fa-book course-main-icon"></i>
                            <h4>{{ $course->title }}</h4>
                            <p><i class="fa-solid fa-calendar-day"></i> Duration: {{ $course->duration }}</p>
                            <p><i class="fa-solid fa-users"></i> Slots: {{ $course->slots }}</p>
                            @if($assignedTrainer)
                                <p style="color:#025628; font-size:12px; font-weight:600;">
                                    <i class="fa-solid fa-chalkboard-user"></i> {{ $trainerName }}
                                </p>
                            @else
                                <p style="color:#aaa; font-size:12px;">
                                    <i class="fa-solid fa-chalkboard-user"></i> No trainer assigned
                                </p>
                            @endif
                            <div class="progress-container">
                                <div class="progress-bar" style="width: 0%;"></div>
                            </div>
                            <div style="display:flex; gap:8px; margin-top:8px;">
                                <button class="btn-all" style="flex:1" onclick="openCourseModal(
                                                            {{ $course->id }},
                                                            '{{ addslashes($course->title) }}',
                                                            '{{ addslashes($course->duration) }}',
                                                            {{ $course->slots }},
                                                            {{ $course->trainer_id ?? 'null' }},
                                                            '{{ addslashes($trainerName) }}'
                                                        )">Course Details</button>
                                <button class="btn-all" style="flex:1; background:#025628; color:#fff; border:none;"
                                    onclick="openContentModal({{ $course->id }}, '{{ addslashes($course->title) }}')">
                                    <i class="fa-solid fa-layer-group"></i> Modules
                                </button>
                            </div>
                          </div>{{-- end course-card --}}
                    @empty
                        <p style="color:#aaa; font-size:13px;">No courses found.</p>
                    @endforelse
                </div>
                <div style="text-align: center; margin-top: 20px;">
                    <button class="btn-save-main" onclick="openAddCourseModal()" style="width: auto; padding: 10px 15px;">
                        <i class="fa-solid fa-plus"></i> Add New Course
                    </button>
                </div>
<div class="pagination-container">
    {{-- Previous --}}
    @if($courses->onFirstPage())
        <button class="page-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
    @else
        <a href="{{ $courses->previousPageUrl() }}&view=courses" 
           onclick="setActive(document.getElementById('nav-courses'))"
           class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
    @endif

    {{-- Page numbers --}}
    <div class="page-numbers">
        @for($i = 1; $i <= $courses->lastPage(); $i++)
            @if($i == $courses->currentPage())
                <button class="page-btn active">{{ $i }}</button>
            @else
                <a href="{{ $courses->url($i) }}&view=courses"
                   onclick="setActive(document.getElementById('nav-courses'))"
                   class="page-btn">{{ $i }}</a>
            @endif
        @endfor
    </div>

    {{-- Next --}}
    @if($courses->hasMorePages())
        <a href="{{ $courses->nextPageUrl() }}&view=courses"
           onclick="setActive(document.getElementById('nav-courses'))"
           class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
    @else
        <button class="page-btn" disabled><i class="fa-solid fa-chevron-right"></i></button>
    @endif
</div>
            </div>

            {{-- SETTINGS --}}
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
                        <button class="btn-all" style="width: auto; padding: 10px 20px;">Backup Now</button>
                    </div>
                </div>
            </div>

        </main>
    </div>{{-- end .app-body --}}


    {{-- ============================================================ --}}
    {{-- MODALS (unchanged)                                           --}}
    {{-- ============================================================ --}}

    {{-- COURSE MODAL --}}
    <div id="courseModal" class="modal">
        <div class="modal-content card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-pen-to-square"></i> Manage Course</h3>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <form id="courseForm" class="modal-body">
                @csrf
                <input type="hidden" id="editCourseId">
                <div class="input-field">
                    <label>Course Name</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-bookmark"></i>
                        <input type="text" id="editCourseName">
                    </div>
                </div>
                <div class="modal-row">
                    <div class="input-field">
                        <label>Duration</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-calendar-day"></i>
                            <input type="text" id="editDuration">
                        </div>
                    </div>
                    <div class="input-field">
                        <label>Slots</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-user-graduate"></i>
                            <input type="number" id="editSlots">
                        </div>
                    </div>
                </div>
                <div class="assign-trainer-section">
                    <div class="assign-trainer-label">
                        <i class="fa-solid fa-chalkboard-user"></i> Assign Trainer
                    </div>
                    <div class="assign-trainer-row">
                        <select id="trainerDropdown">
                            <option value="">— Select a trainer —</option>
                            @foreach($trainers as $trainer)
                                <option value="{{ $trainer->id }}">
                                    {{ $trainer->firstname }} {{ $trainer->lastname }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn-assign" onclick="assignTrainer()">
                            <i class="fa-solid fa-check"></i> Assign
                        </button>
                    </div>
                    <div id="currentTrainerBox" style="display:none;" class="current-trainer-box">
                        <div class="trainer-avatar-sm" id="trainerInitials">JD</div>
                        <div class="trainer-details">
                            <div class="trainer-fullname" id="trainerFullName"></div>
                            <div class="trainer-sub">Currently assigned trainer</div>
                        </div>
                        <button type="button" class="btn-remove-trainer" onclick="removeTrainer()">
                            <i class="fa-solid fa-xmark"></i> Remove
                        </button>
                    </div>
                    <div id="noTrainerBox" class="no-trainer-box">
                        <i class="fa-solid fa-circle-info"></i> No trainer assigned yet.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-delete-text" onclick="confirmDelete()" style="display:none;">
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

    {{-- ADD TRAINER MODAL --}}
    <div id="addTrainerModal" class="modal">
        <div class="modal-content card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-user-plus"></i> Register New Trainer</h3>
                <span class="close-modal" onclick="closeAddTrainerModal()">&times;</span>
            </div>
            <form id="addTrainerForm" class="modal-body">
                <div class="input-field">
                    <label>Full Name</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="newTrainerName" placeholder="e.g. Juan Dela Cruz" required>
                    </div>
                </div>
                <div class="input-field">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" id="newTrainerEmail" placeholder="trainer@example.com" required>
                    </div>
                </div>
                <div class="modal-row">
                    <div class="input-field">
                        <label>Temporary Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-key"></i>
                            <input type="text" id="newTrainerPass" placeholder="e.g. Welcome2026">
                        </div>
                    </div>
                    <div class="input-field">
                        <label>Assigned Course</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-book-open"></i>
                            <select id="newTrainerCourse" class="modal-input-select">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeAddTrainerModal()">Cancel</button>
                    <button type="submit" class="btn-save-main">Create Account</button>
                </div>
            </form>
        </div>
    </div>

    {{-- USER MODAL --}}
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
                                <option value="student">Trainee</option>
                                <option value="trainer">Trainer</option>
                                <option value="admin">Admin</option>
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

    {{-- FACILITY MODAL --}}
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
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                                <option value="">No Active Training</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-delete-text" onclick="deleteFacility()">
                        <i class="fa-solid fa-house-lock"></i> Close Facility
                    </button>
                    <div class="action-buttons">
                        <button type="submit" class="btn-save-main">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        let traineeHistoryInstance = null;
        let courseHistoryInstance = null;
        let currentCourseId = null;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ===== TOPBAR: hamburger + avatar dropdown =====
        const hamburger = document.getElementById('hamburger');
        const sidebar   = document.getElementById('sidebar');
        const overlay   = document.getElementById('overlay');
        const avatarBtn = document.getElementById('avatarBtn');
        const dropdown  = document.getElementById('dropdown');

        hamburger.addEventListener('click', function () {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('show');
        });

        avatarBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.topbar-right')) {
                dropdown.classList.remove('open');
            }
        });

        // ===== SIDEBAR active state =====
        function setActive(el) {
            document.querySelectorAll('.sidebar .nav-item').forEach(i => i.classList.remove('active'));
            el.classList.add('active');
        }

        // ===== Charts =====
        function initHistoryChart() {
            const traineeCanvas = document.getElementById('traineeHistoryChart');
            if (traineeCanvas) {
                traineeCanvas.style.height = '500px';
                const traineeCtx = traineeCanvas.getContext('2d');
                if (traineeHistoryInstance) traineeHistoryInstance.destroy();
                traineeHistoryInstance = new Chart(traineeCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                        datasets: [{ label: 'Trainees', data: [150,170,160,190,220,210,250,280,310,340,390,420], backgroundColor: '#7fb092', borderRadius: 5 }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: true, position: 'top' } }, scales: { y: { beginAtZero: true } } }
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
                        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                        datasets: [{ label: 'Courses', data: [5,6,8,8,10,12,12,15,15,18,20,22], borderColor: '#004d26', backgroundColor: 'rgba(0,77,38,0.1)', fill: true, tension: 0.4 }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
                });
            }
        }

        // ===== Page Load =====
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    fixedWeekCount: true,
                    headerToolbar: { left: 'prev', center: 'title', right: 'next' },
                    eventColor: '#004d26',
                    height: 280,
                    aspectRatio: 1.0,
                    contentHeight: 'auto',
                    handleWindowResize: true
                });
                calendar.render();
            }

            // Auto-show courses view if paginating
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('view') === 'courses' || urlParams.get('page')) {
                    showView('courses');
                    setActive(document.getElementById('nav-courses'));
                }

            const ctxBar = document.getElementById('traineeChart')?.getContext('2d');
            if (ctxBar) {
                new Chart(ctxBar, {
                    type: 'bar',
                    data: { labels: ['Sept','Oct','Nov','Dec'], datasets: [{ data: [40,65,80,95], backgroundColor: '#004d26', borderRadius: 4, barPercentage: 0.6 }] },
                    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, display: false }, x: { grid: { display: false } } } }
                });
            }

            const ctxLine = document.getElementById('courseChart')?.getContext('2d');
            if (ctxLine) {
                new Chart(ctxLine, {
                    type: 'line',
                    data: {
                        labels: ['Sept','Oct','Nov','Dec'],
                        datasets: [
                            { label: 'Carpentry', data: [30,58,98,65], borderColor: '#c19a6b', tension: 0.3 },
                            { label: 'Dressmaking', data: [45,68,40,82], borderColor: '#6b9e7c', tension: 0.3 },
                            { label: 'Candle Making', data: [25,62,25,18], borderColor: '#f4d03f', tension: 0.3 }
                        ]
                    },
                    options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { grid: { color: '#f0f0f0' } } } }
                });
            }
        });

        // ===== View Management =====
        function showView(viewName) {
            const allViews = [
                'view-overview','view-trainee-list','view-trainer-list',
                'view-facilities','view-courses','view-settings','view-analytics'
            ];
            allViews.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });

            const title      = document.getElementById('main-title');
            const breadcrumb = document.getElementById('breadcrumb-current');

            const map = {
                overview:       ['view-overview',      'System Overview',       'System Overview'],
                analytics:      ['view-analytics',     'Detailed Analytics',    `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Analytics`],
                'all-trainees': ['view-trainee-list',  'Trainee Management',    `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Trainees`],
                'all-trainers': ['view-trainer-list',  'Trainer Management',    `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Trainers`],
                facilities:     ['view-facilities',    'Facilities',            `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Facilities`],
                courses:        ['view-courses',       'Available Courses',     `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Courses`],
                settings:       ['view-settings',      'System Settings',       `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Settings`],
            };

            const entry = map[viewName] || map['overview'];
            const el = document.getElementById(entry[0]);
            if (el) el.style.display = 'block';
            title.innerText = entry[1];
            breadcrumb.innerHTML = entry[2];

            if (viewName === 'analytics') setTimeout(initHistoryChart, 100);

            // Close sidebar on mobile after nav
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('sidebar-open');
                overlay.classList.remove('show');
            }
        }

        // ===== Utilities =====
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

        // ===== Course Modal =====
        function openCourseModal(id, name, duration, slots, trainerId, trainerName) {
            currentCourseId = id;
            document.getElementById('courseModal').style.display = 'block';
            document.querySelector('#courseModal h3').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Manage Course';
            document.querySelector('#courseModal .btn-delete-text').style.display = 'inline-block';
            document.getElementById('editCourseId').value = id;
            document.getElementById('editCourseName').value = name;
            document.getElementById('editDuration').value = duration;
            document.getElementById('editSlots').value = slots;
            document.getElementById('trainerDropdown').value = trainerId || '';
            trainerId && trainerName ? showCurrentTrainer(trainerName) : showNoTrainer();
        }

        function openAddCourseModal() {
            currentCourseId = null;
            document.getElementById('courseModal').style.display = 'block';
            document.querySelector('#courseModal h3').innerHTML = '<i class="fa-solid fa-folder-plus"></i> Create New Course';
            document.getElementById('courseForm').reset();
            document.querySelector('#courseModal .btn-delete-text').style.display = 'none';
            showNoTrainer();
        }

        function closeModal() {
            document.getElementById('courseModal').style.display = 'none';
            currentCourseId = null;
        }

        function showCurrentTrainer(name) {
            const initials = name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
            document.getElementById('trainerInitials').textContent = initials;
            document.getElementById('trainerFullName').textContent = name;
            document.getElementById('currentTrainerBox').style.display = 'flex';
            document.getElementById('noTrainerBox').style.display = 'none';
        }

        function showNoTrainer() {
            document.getElementById('currentTrainerBox').style.display = 'none';
            document.getElementById('noTrainerBox').style.display = 'block';
        }

        function assignTrainer() {
            const trainerId = document.getElementById('trainerDropdown').value;
            const trainerName = document.getElementById('trainerDropdown').selectedOptions[0].text;
            if (!trainerId) { alert('Please select a trainer first.'); return; }
            if (!currentCourseId) { alert('Please save the course first before assigning a trainer.'); return; }
            fetch(`/admin/course/${currentCourseId}/assign-trainer`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ trainer_id: trainerId }),
            })
            .then(res => res.json())
            .then(data => { if (data.success) { showCurrentTrainer(trainerName); alert('Trainer assigned successfully!'); } })
            .catch(() => alert('Something went wrong. Please try again.'));
        }

        function removeTrainer() {
            if (!currentCourseId) return;
            if (!confirm('Remove the assigned trainer from this course?')) return;
            fetch(`/admin/course/${currentCourseId}/remove-trainer`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { showNoTrainer(); document.getElementById('trainerDropdown').value = ''; alert('Trainer removed successfully!'); }
            })
            .catch(() => alert('Something went wrong. Please try again.'));
        }

        // ===== Other Modals =====
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
            document.querySelector('#facilityModal h3').innerHTML = '<i class="fa-solid fa-building-circle-gear"></i> Manage Facility';
            document.querySelector('#facilityModal .btn-delete-text').style.display = 'inline-block';
            document.getElementById('editFacName').value = name;
            document.getElementById('editFacAddress').value = address;
            document.getElementById('editFacCap').value = capacity;
        }
        function openAddFacilityModal() {
            document.getElementById('facilityModal').style.display = 'block';
            document.querySelector('#facilityModal h3').innerHTML = '<i class="fa-solid fa-building-circle-plus"></i> Add New Facility';
            document.getElementById('facilityForm').reset();
            document.querySelector('#facilityModal .btn-delete-text').style.display = 'none';
        }
        function closeFacilityModal() { document.getElementById('facilityModal').style.display = 'none'; }

        function openAddTrainerModal() { document.getElementById('addTrainerModal').style.display = 'block'; }
        function closeAddTrainerModal() {
            document.getElementById('addTrainerModal').style.display = 'none';
            document.getElementById('addTrainerForm').reset();
        }

        window.onclick = function (event) {
            if (event.target.classList.contains('modal')) {
                closeModal();
                closeUserModal();
                closeFacilityModal();
                closeAddTrainerModal();
            }
        };

        document.getElementById('addTrainerForm').onsubmit = function(e) {
            e.preventDefault();
            alert('Trainer Added Successfully!');
            closeAddTrainerModal();
        };

        document.getElementById('courseForm').onsubmit = function(e) {
            e.preventDefault();
            alert('Course Changes Saved!');
            closeModal();
        };

        document.getElementById('facilityForm').onsubmit = function(e) {
            e.preventDefault();
            alert('Facility Details Updated!');
            closeFacilityModal();
        };
    </script>

    {{-- ============================================================ --}}
{{-- COURSE CONTENT MODAL (Modules & Quizzes)                    --}}
{{-- I-PASTE ITO BAGO ANG </body> TAG SA Admin1.blade.php        --}}
{{-- ============================================================ --}}

<div id="contentModal" class="modal">
    <div class="modal-content card" style="max-width:680px; width:95%;">
        <div class="modal-header">
            <h3><i class="fa-solid fa-layer-group"></i> Manage: <span id="contentModalCourseTitle"></span></h3>
            <span class="close-modal" onclick="closeContentModal()">&times;</span>
        </div>

        <div class="modal-body" style="padding-bottom:0;">
            {{-- Tabs --}}
            <div style="display:flex; gap:0; border-bottom:2px solid #e5e5e5; margin-bottom:16px;">
                <button id="tab-btn-modules" onclick="switchContentTab('modules')"
                    style="flex:1; padding:10px; border:none; background:none; font-weight:700; font-size:13px;
                           border-bottom:2px solid #025628; margin-bottom:-2px; color:#025628; cursor:pointer;">
                    <i class="fa-solid fa-cubes"></i> Modules
                </button>
                <button id="tab-btn-quizzes" onclick="switchContentTab('quizzes')"
                    style="flex:1; padding:10px; border:none; background:none; font-weight:600; font-size:13px;
                           color:#aaa; cursor:pointer;">
                    <i class="fa-solid fa-clipboard-question"></i> Quizzes
                </button>
            </div>

            {{-- MODULES TAB --}}
            <div id="content-tab-modules">
                {{-- Add Module Form --}}
                    <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:14px;">
                        <div style="display:flex; gap:8px;">
                            <input type="text" id="newModuleTitle" placeholder="Module title"
                                style="flex:1; border:1px solid #ddd; border-radius:8px; padding:8px 12px; font-size:13px; font-family:inherit;">
                            <input type="text" id="newModuleDesc" placeholder="Description (optional)"
                                style="flex:2; border:1px solid #ddd; border-radius:8px; padding:8px 12px; font-size:13px; font-family:inherit;">
                        </div>
                        <div style="display:flex; gap:8px; align-items:center;">
                            <label style="font-size:12px; color:#666; white-space:nowrap;">📎 PDF File:</label>
                            <input type="file" id="newModuleFile" accept=".pdf,.doc,.docx"
                                style="flex:1; border:1px solid #ddd; border-radius:8px; padding:6px 12px; font-size:13px; font-family:inherit; background:#fff;">
                            <button onclick="addModule()"
                                style="background:#025628; color:#fff; border:none; border-radius:8px; padding:9px 16px;
                                    font-size:13px; font-weight:700; cursor:pointer; white-space:nowrap; font-family:inherit;">
                                <i class="fa-solid fa-plus"></i> Add
                            </button>
                        </div>
                    </div>

                {{-- Module List --}}
                <div id="moduleListContainer" style="display:flex; flex-direction:column; gap:8px; max-height:320px; overflow-y:auto;">
                    <div style="text-align:center; color:#bbb; font-size:13px; padding:20px 0;" id="modulesEmptyState">
                        <i class="fa-solid fa-inbox"></i> Walang modules pa.
                    </div>
                </div>
            </div>

            {{-- QUIZZES TAB --}}
            <div id="content-tab-quizzes" style="display:none;">
                {{-- Add Quiz Form --}}
                <div style="background:#f9f9f9; border:1px solid #eee; border-radius:10px; padding:14px; margin-bottom:14px;">
                    <div style="font-size:12px; font-weight:700; color:#025628; margin-bottom:10px; text-transform:uppercase; letter-spacing:.04em;">
                        <i class="fa-solid fa-plus-circle"></i> New Quiz
                    </div>
                    <div style="display:flex; gap:8px; flex-wrap:wrap;">
                        <input type="text" id="newQuizTitle" placeholder="Quiz title"
                            style="flex:2; min-width:140px; border:1px solid #ddd; border-radius:8px; padding:8px 12px; font-size:13px; font-family:inherit;">
                        <select id="newQuizModule"
                            style="flex:1.5; min-width:130px; border:1px solid #ddd; border-radius:8px; padding:8px 12px; font-size:13px; font-family:inherit; background:#fff;">
                            <option value="">— Link to module (optional) —</option>
                        </select>
                    </div>
                    <div style="display:flex; gap:8px; margin-top:8px; flex-wrap:wrap; align-items:center;">
                        <div style="flex:1; min-width:100px;">
                            <label style="font-size:11px; color:#888; display:block; margin-bottom:2px;">Passing score (%)</label>
                            <input type="number" id="newQuizPass" value="75" min="1" max="100"
                                style="width:100%; border:1px solid #ddd; border-radius:8px; padding:8px 10px; font-size:13px; font-family:inherit;">
                        </div>
                        <div style="flex:1; min-width:100px;">
                            <label style="font-size:11px; color:#888; display:block; margin-bottom:2px;">Time limit (mins)</label>
                            <input type="number" id="newQuizTime" value="30" min="1"
                                style="width:100%; border:1px solid #ddd; border-radius:8px; padding:8px 10px; font-size:13px; font-family:inherit;">
                        </div>
                        <button onclick="addQuiz()"
                            style="background:#025628; color:#fff; border:none; border-radius:8px; padding:9px 20px;
                                   font-size:13px; font-weight:700; cursor:pointer; font-family:inherit; margin-top:14px;">
                            <i class="fa-solid fa-plus"></i> Add Quiz
                        </button>
                    </div>
                </div>

                {{-- Quiz List --}}
                <div id="quizListContainer" style="display:flex; flex-direction:column; gap:8px; max-height:280px; overflow-y:auto;">
                    <div style="text-align:center; color:#bbb; font-size:13px; padding:20px 0;" id="quizzesEmptyState">
                        <i class="fa-solid fa-inbox"></i> Walang quizzes pa.
                    </div>
                </div>
            </div>

        </div>{{-- end modal-body --}}
        <div class="modal-footer" style="margin-top:16px;">
            <div class="action-buttons">
                <button class="btn-cancel" onclick="closeContentModal()">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
// ── STATE ──────────────────────────────────────────────────────────────────
let _contentCourseId  = null;
let _contentModules   = [];
let _contentQuizzes   = [];

// ── OPEN / CLOSE ───────────────────────────────────────────────────────────
function openContentModal(courseId, courseTitle) {
    _contentCourseId = courseId;
    document.getElementById('contentModalCourseTitle').textContent = courseTitle;
    document.getElementById('contentModal').style.display = 'block';
    switchContentTab('modules');
    fetchCourseContent(courseId);
}

function closeContentModal() {
    document.getElementById('contentModal').style.display = 'none';
    _contentCourseId = null;
    _contentModules  = [];
    _contentQuizzes  = [];
}

// ── TABS ───────────────────────────────────────────────────────────────────
function switchContentTab(tab) {
    const isMod = tab === 'modules';
    document.getElementById('content-tab-modules').style.display = isMod ? 'block' : 'none';
    document.getElementById('content-tab-quizzes').style.display = isMod ? 'none'  : 'block';

    const styleActive   = 'border-bottom:2px solid #025628; margin-bottom:-2px; color:#025628;';
    const styleInactive = 'border-bottom:none; color:#aaa;';
    document.getElementById('tab-btn-modules').style.cssText += isMod ? styleActive : styleInactive;
    document.getElementById('tab-btn-quizzes').style.cssText += isMod ? styleInactive : styleActive;

    if (tab === 'quizzes') populateQuizModuleDropdown();
}

// ── FETCH ──────────────────────────────────────────────────────────────────
function fetchCourseContent(courseId) {
    fetch(`/admin/course/${courseId}/content`, {
        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        _contentModules = data.modules || [];
        _contentQuizzes = data.quizzes || [];
        renderModules();
        renderQuizzes();
    })
    .catch(() => alert('Hindi ma-load ang content. Subukan ulit.'));
}

// ── RENDER MODULES ─────────────────────────────────────────────────────────
function renderModules() {
    const container = document.getElementById('moduleListContainer');
    const empty     = document.getElementById('modulesEmptyState');

    if (!_contentModules.length) {
        empty.style.display = 'block';
        container.innerHTML = '';
        container.appendChild(empty);
        return;
    }
    empty.style.display = 'none';

    container.innerHTML = _contentModules.map((m, i) => `
        <div style="display:flex; align-items:center; gap:10px; background:#fff;
                    border:1px solid #eee; border-radius:10px; padding:10px 14px;">
            <div style="width:28px; height:28px; border-radius:50%; background:#e8f5e9;
                        display:flex; align-items:center; justify-content:center;
                        font-size:12px; font-weight:700; color:#025628; flex-shrink:0;">
                ${i + 1}
            </div>
            <div style="flex:1; min-width:0;">
                <div style="font-size:13px; font-weight:700; color:#1a1a1a;">${escHtml(m.title)}</div>
                ${m.description ? `<div style="font-size:11px; color:#888; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${escHtml(m.description)}</div>` : ''}
            </div>
            <button onclick="deleteModule(${m.id})"
                style="font-size:11px; padding:4px 10px; border-radius:6px;
                       background:#FCEBEB; color:#A32D2D; border:none; cursor:pointer;
                       font-family:inherit; font-weight:700; white-space:nowrap;">
                <i class="fa-solid fa-trash"></i> Remove
            </button>
        </div>
    `).join('');
}

// ── RENDER QUIZZES ─────────────────────────────────────────────────────────
function renderQuizzes() {
    const container = document.getElementById('quizListContainer');
    const empty     = document.getElementById('quizzesEmptyState');

    if (!_contentQuizzes.length) {
        empty.style.display = 'block';
        container.innerHTML = '';
        container.appendChild(empty);
        return;
    }
    empty.style.display = 'none';

    container.innerHTML = _contentQuizzes.map(q => `
        <div style="display:flex; align-items:center; gap:10px; background:#fff;
                    border:1px solid #eee; border-radius:10px; padding:10px 14px;">
            <div style="width:32px; height:32px; border-radius:8px; background:#fff8e1;
                        display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0;">
                📝
            </div>
            <div style="flex:1; min-width:0;">
                <div style="font-size:13px; font-weight:700; color:#1a1a1a;">${escHtml(q.title)}</div>
                <div style="font-size:11px; color:#888;">
                    ${q.module ? `<i class="fa-solid fa-cube"></i> ${escHtml(q.module.title)} &nbsp;·&nbsp;` : ''}
                    <i class="fa-solid fa-clock"></i> ${q.time_limit}m &nbsp;·&nbsp;
                    <i class="fa-solid fa-star"></i> ${q.passing_score}% passing
                </div>
            </div>
            <button onclick="deleteQuiz(${q.id})"
                style="font-size:11px; padding:4px 10px; border-radius:6px;
                       background:#FCEBEB; color:#A32D2D; border:none; cursor:pointer;
                       font-family:inherit; font-weight:700; white-space:nowrap;">
                <i class="fa-solid fa-trash"></i> Remove
            </button>
        </div>
    `).join('');
}

// ── ADD MODULE ─────────────────────────────────────────────────────────────
function addModule() {
    const title = document.getElementById('newModuleTitle').value.trim();
    const desc  = document.getElementById('newModuleDesc').value.trim();
    const file  = document.getElementById('newModuleFile').files[0];
    if (!title) { alert('Lagyan ng title ang module.'); return; }

    const formData = new FormData();
    formData.append('course_id', _contentCourseId);
    formData.append('title', title);
    formData.append('description', desc);
    if (file) formData.append('file', file);

    fetch('/admin/module', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            _contentModules.push(data.module);
            document.getElementById('newModuleTitle').value = '';
            document.getElementById('newModuleDesc').value  = '';
            document.getElementById('newModuleFile').value  = '';
            renderModules();
            populateQuizModuleDropdown();
        }
    })
    .catch(() => alert('May error. Subukan ulit.'));
}

// ── DELETE MODULE ──────────────────────────────────────────────────────────
function deleteModule(id) {
    if (!confirm('I-remove ang module na ito?')) return;
    fetch(`/admin/module/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ _method: 'DELETE' })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            _contentModules = _contentModules.filter(m => m.id !== id);
            renderModules();
            populateQuizModuleDropdown();
        }
    })
    .catch(() => alert('May error. Subukan ulit.'));
}

// ── ADD QUIZ ───────────────────────────────────────────────────────────────
function addQuiz() {
    const title    = document.getElementById('newQuizTitle').value.trim();
    const moduleId = document.getElementById('newQuizModule').value || null;
    const passing  = parseInt(document.getElementById('newQuizPass').value);
    const time     = parseInt(document.getElementById('newQuizTime').value);
    if (!title) { alert('Lagyan ng title ang quiz.'); return; }

    fetch('/admin/quiz', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({
            course_id: _contentCourseId,
            module_id: moduleId,
            title,
            passing_score: passing,
            time_limit: time
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            _contentQuizzes.push(data.quiz);
            document.getElementById('newQuizTitle').value = '';
            renderQuizzes();
        }
    })
    .catch(() => alert('May error. Subukan ulit.'));
}

// ── DELETE QUIZ ────────────────────────────────────────────────────────────
function deleteQuiz(id) {
    if (!confirm('I-remove ang quiz na ito?')) return;
    fetch(`/admin/quiz/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ _method: 'DELETE' })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            _contentQuizzes = _contentQuizzes.filter(q => q.id !== id);
            renderQuizzes();
        }
    })
    .catch(() => alert('May error. Subukan ulit.'));
}

// ── HELPER: populate quiz module dropdown ──────────────────────────────────
function populateQuizModuleDropdown() {
    const sel = document.getElementById('newQuizModule');
    sel.innerHTML = '<option value="">— Link to module (optional) —</option>';
    _contentModules.forEach(m => {
        const opt = document.createElement('option');
        opt.value       = m.id;
        opt.textContent = m.title;
        sel.appendChild(opt);
    });
}

// ── HELPER: escape HTML ────────────────────────────────────────────────────
function escHtml(str) {
    const div = document.createElement('div');
    div.appendChild(document.createTextNode(str || ''));
    return div.innerHTML;
}
</script>
</body>
</html>