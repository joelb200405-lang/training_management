<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - System Overview</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheet/certificates.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

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
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }

        .modal-content {
            background: white;
            padding: 20px;
            width: 300px;
            margin: 15% auto;
            text-align: center;
            border-radius: 10px;
        }

        .modal-actions-centered button {
            margin: 10px;
            padding: 8px 15px;
        }
    </style>
</head>

<body>

    {{-- ===== TOPBAR ===== --}}
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
                    <a href="#" class="dd-item dd-logout" onclick="event.preventDefault(); openLogoutModal();">
                    <i class="fa fa-right-from-bracket dd-icon"></i>
                    Log out
                </a>
                <form id="logout-form" action="{{ route('Logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div id="logoutModal" class="modal" style="display:none;">
        <div class="modal-content">
            <p>Are you sure you want to log out?</p>
            <div class="modal-actions-centered">
                <button onclick="confirmLogout()" class="btn-modal-yes">Yes</button>
                <button onclick="closeLogoutModal()" class="btn-modal-no">Cancel</button>
            </div>
        </div>
    </div>

    {{-- ===== APP BODY ===== --}}
    <div class="app-body">

        <div class="sidebar-overlay" id="overlay"></div>

        {{-- ===== SIDEBAR ===== --}}
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

            <a href="#" class="nav-item" id="nav-registrations"
            onclick="showView('registrations'); setActive(this); return false;">
                <i class="fa fa-clipboard-list nav-icon"></i>
                <span>Registrations</span>
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

            <a href="#" class="nav-item" id="nav-announcements"
            onclick="showView('announcements'); setActive(this); return false;">
                <i class="fa fa-bell nav-icon"></i>
                <span>Announcements</span>
            </a>

            <a href="#" class="nav-item" id="nav-analytics"
               onclick="showView('analytics'); setActive(this); return false;">
                <i class="fa fa-chart-line nav-icon"></i>
                <span>Reports</span>
            </a>

            <a href="#" class="nav-item" id="nav-settings"
               onclick="showView('settings'); setActive(this); return false;">
                <i class="fa fa-gear nav-icon"></i>
                <span>Settings </span>
            </a>

            <a href="#" class="nav-item" id="nav-certificate"
               onclick="showView('certificate'); setActive(this); return false;">
                <i class="fa fa-award nav-icon"></i>
                <span>Certificate</span>
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
                        @forelse($trainees as $trainee)
                            <div class="user-item">
                                <i class="fa-solid fa-circle-user profile-icon"></i>
                                <div class="user-info">
                                    <strong>{{ strtoupper($trainee->firstname . ' ' . $trainee->lastname) }}</strong><br>
                                    <small>{{ $trainee->email }}</small>
                                </div>
                                <button class="btn-view" onclick="openUserModal(
                                    '{{ addslashes($trainee->firstname . ' ' . $trainee->lastname) }}',
                                    '{{ addslashes($trainee->email) }}',
                                    'student',
                                    'Active'
                                )">View</button>
                            </div>
                        @empty
                            <div style="text-align:center; color:#aaa; padding:20px; font-size:13px;">
                                <i class="fa-solid fa-users-slash"></i> Walang trainees pa.
                            </div>
                        @endforelse
                    </div>
                    <div class="pagination-container">
                        @if($trainees->onFirstPage())
                            <button class="page-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                        @else
                            <a href="{{ $trainees->previousPageUrl() }}" class="page-btn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        @endif

                        <div class="page-numbers">
                            @for($i = 1; $i <= $trainees->lastPage(); $i++)
                                @if($i == $trainees->currentPage())
                                    <button class="page-btn active">{{ $i }}</button>
                                @else
                                    <a href="{{ $trainees->url($i) }}" class="page-btn">{{ $i }}</a>
                                @endif
                            @endfor
                        </div>

                        @if($trainees->hasMorePages())
                            <a href="{{ $trainees->nextPageUrl() }}" class="page-btn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        @else
                            <button class="page-btn" disabled><i class="fa-solid fa-chevron-right"></i></button>
                        @endif
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
                        @forelse($trainersList as $trainer)
                            <div class="user-item">
                                <i class="fa-solid fa-user-tie profile-icon" style="color: #004d26;"></i>
                                <div class="user-info">
                                    <strong>{{ strtoupper($trainer->firstname . ' ' . $trainer->lastname) }}</strong><br>
                                    <small>{{ $trainer->email }}</small>
                                </div>
                                <button class="btn-view" onclick="openUserModal(
                                    '{{ addslashes($trainer->firstname . ' ' . $trainer->lastname) }}',
                                    '{{ addslashes($trainer->email) }}',
                                    'trainer',
                                    'Active'
                                )">View</button>
                            </div>
                        @empty
                            <div style="text-align:center; color:#aaa; padding:20px; font-size:13px;">
                                <i class="fa-solid fa-user-slash"></i> Walang trainers pa.
                            </div>
                        @endforelse
                    </div>
                    <div style="text-align: center; margin-bottom: 20px;">
                        <button class="btn-save-main" onclick="openAddTrainerModal()" style="width: auto; padding: 10px 15px;">
                            <i class="fa-solid fa-plus"></i> Add New Trainer
                        </button>
                    </div>
                    <div class="pagination-container">
                        @if($trainersList->onFirstPage())
                            <button class="page-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                        @else
                            <a href="{{ $trainersList->previousPageUrl() }}" class="page-btn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        @endif

                        <div class="page-numbers">
                            @for($i = 1; $i <= $trainersList->lastPage(); $i++)
                                @if($i == $trainersList->currentPage())
                                    <button class="page-btn active">{{ $i }}</button>
                                @else
                                    <a href="{{ $trainersList->url($i) }}" class="page-btn">{{ $i }}</a>
                                @endif
                            @endfor
                        </div>

                        @if($trainersList->hasMorePages())
                            <a href="{{ $trainersList->nextPageUrl() }}" class="page-btn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        @else
                            <button class="page-btn" disabled><i class="fa-solid fa-chevron-right"></i></button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- REGISTRATIONS --}}
            <div id="view-registrations" style="display: none;">
                <div class="card list-card">
                <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
                    <h3>Submitted Registrations</h3>
                    <a href="{{ route('admin.registrations.export') }}" class="btn-save-main" style="width:auto; padding:8px 16px; text-decoration:none;">
                        <i class="fa-solid fa-file-excel"></i> Export to Excel
                    </a>
                </div>
                    <div class="user-list-body" id="registrations-list-content">
                        @forelse($registrations as $reg)
                            <div class="user-item">
                                <i class="fa-solid fa-id-card profile-icon"></i>
                                <div class="user-info">
                                    <strong>{{ $reg->last_name }}, {{ $reg->first_name }} {{ $reg->middle_name }}</strong><br>
                                    <small>
                                        ULI: {{ $reg->uli_number ?? '—' }} &nbsp;·&nbsp;
                                        Course: {{ $reg->course_name }} &nbsp;·&nbsp;
                                        {{ $reg->created_at->format('M j, Y g:i A') }}
                                    </small>
                                </div>
                                <a href="{{ route('admin.registrations.show', $reg->id) }}"
                                target="_blank" class="btn-view">View</a>
                            </div>
                        @empty
                            <div style="text-align:center; color:#aaa; padding:20px; font-size:13px;">
                                <i class="fa-solid fa-clipboard-list"></i> Walang registrations pa.
                            </div>
                        @endforelse
                    </div>
                    <div class="pagination-container">
                        @if($registrations->onFirstPage())
                            <button class="page-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                        @else
                            <a href="{{ $registrations->previousPageUrl() }}" class="page-btn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        @endif
                        <div class="page-numbers">
                            @for($i = 1; $i <= $registrations->lastPage(); $i++)
                                @if($i == $registrations->currentPage())
                                    <button class="page-btn active">{{ $i }}</button>
                                @else
                                    <a href="{{ $registrations->url($i) }}" class="page-btn">{{ $i }}</a>
                                @endif
                            @endfor
                        </div>
                        @if($registrations->hasMorePages())
                            <a href="{{ $registrations->nextPageUrl() }}" class="page-btn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        @else
                            <button class="page-btn" disabled><i class="fa-solid fa-chevron-right"></i></button>
                        @endif
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
                          </div>
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
                    @if($courses->onFirstPage())
                        <button class="page-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    @else
                        <a href="{{ $courses->previousPageUrl() }}&view=courses" 
                           onclick="setActive(document.getElementById('nav-courses'))"
                           class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

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

                    @if($courses->hasMorePages())
                        <a href="{{ $courses->nextPageUrl() }}&view=courses"
                        onclick="setActive(document.getElementById('nav-courses'))"
                        class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <button class="page-btn" disabled><i class="fa-solid fa-chevron-right"></i></button>
                    @endif  
                </div>
            </div>

            {{-- ANNOUNCEMENTS --}}
            <div id="view-announcements" style="display: none;">
                <div class="section-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <span style="font-size:15px; font-weight:600; color:#025628;">All Announcements</span>
                    <button class="btn-save-main" onclick="openAnnouncementModal()" style="width:auto; padding:8px 16px;">
                        <i class="fa-solid fa-plus"></i> Add Announcement
                    </button>
                </div>

                <div class="card list-card">
                    @forelse($announcements as $ann)
                        @php
                            $badgeColor = match($ann->type) {
                                'urgent'   => '#A32D2D',
                                'notice'   => '#854F0B',
                                default    => '#025628',
                            };
                            $bgColor = match($ann->type) {
                                'urgent'   => '#FCEBEB',
                                'notice'   => '#FFF8E1',
                                default    => '#E8F5E9',
                            };
                        @endphp
                        <div class="user-item">
                            <div style="width:36px; height:36px; border-radius:50%; background:{{ $bgColor }};
                                        display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <i class="fa-solid fa-bell" style="color:{{ $badgeColor }}; font-size:14px;"></i>
                            </div>
                            <div class="user-info" style="flex:1;">
                                <strong>{{ $ann->title }}</strong>
                                <span style="margin-left:8px; padding:2px 8px; border-radius:20px; font-size:10px; font-weight:700;
                                            background:{{ $bgColor }}; color:{{ $badgeColor }};">
                                    {{ ucfirst($ann->type) }}
                                </span><br>
                                <small style="color:#888;">{{ $ann->message }}</small><br>
                                <small style="color:#bbb;">{{ $ann->created_at->diffForHumans() }} · 
                                    {{ $ann->is_active ? '✅ Active' : '⏸ Inactive' }}
                                </small>
                            </div>
                            <div style="display:flex; gap:6px;">
                                <button class="btn-view" onclick="editAnnouncement({{ $ann->id }}, '{{ addslashes($ann->title) }}', '{{ addslashes($ann->message) }}', '{{ $ann->type }}')">
                                    Edit
                                </button>
                                <button onclick="toggleAnn({{ $ann->id }}, this)"
                                    style="padding:5px 12px; border-radius:4px; font-size:12px; font-weight:700; cursor:pointer; border:none;
                                        background:{{ $ann->is_active ? '#FFF8E1' : '#E8F5E9' }};
                                        color:{{ $ann->is_active ? '#854F0B' : '#025628' }};">
                                    {{ $ann->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                <button onclick="deleteAnn({{ $ann->id }})"
                                    style="padding:5px 12px; border-radius:4px; font-size:12px; font-weight:700; cursor:pointer; border:none;
                                        background:#FCEBEB; color:#A32D2D;">
                                    Delete
                                </button>
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center; color:#aaa; padding:30px; font-size:13px;">
                            <i class="fa-solid fa-bell-slash"></i> Walang announcements pa.
                        </div>
                    @endforelse
                </div>

                <div class="pagination-container">
                    @if($announcements->onFirstPage())
                        <button class="page-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    @else
                        <a href="{{ $announcements->previousPageUrl() }}&view=announcements" class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif
                    <div class="page-numbers">
                        @for($i = 1; $i <= $announcements->lastPage(); $i++)
                            @if($i == $announcements->currentPage())
                                <button class="page-btn active">{{ $i }}</button>
                            @else
                                <a href="{{ $announcements->url($i) }}&view=announcements" class="page-btn">{{ $i }}</a>
                            @endif
                        @endfor
                    </div>
                    @if($announcements->hasMorePages())
                        <a href="{{ $announcements->nextPageUrl() }}&view=announcements" class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
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

            {{-- CERTIFICATE --}}
            <div id="view-certificate" style="display: none;">

                <section class="stats-grid">
                    <div class="stat-card"><h3>67</h3><p>Certificates Issued</p></div>
                    <div class="stat-card"><h3>07</h3><p>Pending Claim</p></div>
                    <div class="stat-card"><h3>67</h3><p>Monthly Graduates</p></div>
                    <div class="stat-card urgent"><h3>67</h3><p>Archive Size</p></div>
                </section>

                <div class="filter-controls">
                    <div class="dropdown-group">
                        <select class="filter-dropdown">
                            <option>Filter by: Course</option>
                        </select>
                        <select class="filter-dropdown">
                            <option>Filter by: Month</option>
                        </select>
                        <select class="filter-dropdown">
                            <option>Filter by: Status</option>
                        </select>
                    </div>
                    <div class="selection-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" id="toggleMultiple"> <span>Select Multiple</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" id="selectAll"> <span>Select All</span>
                        </label>
                    </div>
                </div>

                <div class="table-outline">
                    <table class="trainee-data-table" id="certTable">
                        <thead>
                            <tr>
                                <th class="select-col hidden"><i class="fas fa-check-square"></i></th>
                                <th>Fullname</th>
                                <th>Course</th>
                                <th>Date Issued</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="select-col hidden"><input type="checkbox" class="row-checkbox"></td>
                                <td>Nelmida, Rheyan</td>
                                <td>Dressmaking</td>
                                <td>April 3, 2026</td>
                                <td>Claimed</td>
                                <td class="action-icons">
                                    <i class="fas fa-eye view-icon" onclick="openCertModal('Nelmida, Rheyan', 'Dressmaking', 'D-LED-TES-2026-081')"></i>
                                    <i class="fas fa-edit edit-icon"></i>
                                    <i class="fas fa-trash-alt delete-icon" onclick="deleteCert(this)"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="action-footer">
                    <button class="text-btn-add" onclick="openAddModal()">
                        <i class="fas fa-plus-square"></i> Issue New Certificate
                    </button>
                    <button class="pill-btn-export">Export Certificate</button>
                </div>
            </div>
        </main>
    </div>

    <div id="certificateModal" class="modal-overlay">
        <div class="modal-box-fixed">
            <div class="modal-split">
                <div class="split-left-preview">
                    <h3 class="modal-section-header">Certificate Preview</h3>
                    <div class="ui-cert-frame" id="printableCert">
                        <div class="ui-cert-inner">
                            <div class="cert-logos-header">
                                <img src="/images/logo.png" alt="Logo" class="cert-logo-img">
                                <img src="/images/tesda.png" alt="TESDA" class="cert-logo-img">
                                <img src="/images/logo_ledipo.png" alt="LEDIPO" class="cert-logo-img">
                            </div>
                            <p class="cert-authority-text">
                                TECHNICAL EDUCATION AND SKILLS DEVELOPMENT AUTHORITY<br>
                                CITY GOVERNMENT OF DASMARIÑAS - LEDIPO
                            </p>
                            <h1 class="cert-title-primary">CERTIFICATE OF COMPLETION</h1>
                            <p class="cert-certify-line">THIS CERTIFIES THAT</p>
                            <h2 id="vName" class="cert-recipient-name">Nelmida, Rheyan</h2>
                            <p class="cert-training-msg">HAS SUCCESSFULLY COMPLETED THE TRAINING IN</p>
                            <h3 id="vCourse" class="cert-course-name">DRESSMAKING</h3>
                            <div class="cert-signatures">
                                <div class="sig-item">
                                    <p class="sig-name">HON. JENNIFER A. BARZAGA</p>
                                    <p class="sig-rank">City Mayor</p>
                                </div>
                                <div class="sig-item">
                                    <p class="sig-name">MR. CARLOS H. LEGASPI</p>
                                    <p class="sig-rank">LEDIPO Head</p>
                                </div>
                            </div>
                            <div class="cert-serial-footer">
                                <span id="vID">CERT. NO.: D-LED-TES-2026-081</span>
                                <span>TRAINING ID: NCIIDRM-26-032</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="split-right-info">
                    <h2 class="modal-title">Certificate Details</h2>
                    <div class="info-block">
                        <span class="info-label">Trainee Performance</span>
                        <p class="info-value grade-success">94% - Passed</p>
                    </div>
                    <div class="info-block">
                        <span class="info-label">Official Signatories</span>
                        <ul class="sig-list">
                            <li><i class="fas fa-check-circle"></i> Hon. Jennifer Austria-Barzaga</li>
                            <li><i class="fas fa-check-circle"></i> Mr. Carlos H. Legaspi</li>
                        </ul>
                    </div>
                    <div class="modal-actions-container">
                        <button class="modal-action-btn btn-pdf" onclick="handleDownload('printableCert')">Download PDF</button>
                        <button class="modal-action-btn btn-print" onclick="handlePrint()">Re-Print</button>
                        <button class="modal-action-btn" onclick="closeCertModal()">Close View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addTraineeModal" class="modal-overlay">
        <div class="modal-box-fixed">
            <div class="modal-split">
                <div class="split-right-info border-right">
                    <h2 class="modal-title">Issue New Certificate</h2>
                    <form id="issueForm">
                        <div class="ui-form-group">
                            <label>1. Trainee Selection</label>
                            <select class="ui-select" id="traineeSelect" onchange="updateLivePreview()">
                                <option value="" disabled selected>Search Trainee...</option>
                                <option data-course="Dressmaking">Nelmida, Rheyan (94%)</option>
                                <option data-course="Nail Care">Bong, Marcos (88%)</option>
                            </select>
                        </div>
                        <div class="ui-form-group">
                            <label>2. Record Details</label>
                            <input type="text" id="certIDInput" class="ui-select" placeholder="Control Number" oninput="updateLivePreview()">
                            <input type="date" class="ui-select" value="2026-03-31">
                        </div>
                        <div class="ui-form-group">
                            <label>3. Document Options</label>
                            <select class="ui-select">
                                <option>Certificate of Completion</option>
                            </select>
                            <textarea class="ui-select resizable-none" placeholder="Remarks"></textarea>
                        </div>
                    </form>
                </div>
                <div class="split-left-preview bg-white">
                    <h3 class="modal-section-header">Live Preview</h3>
                    <div class="ui-cert-frame scale-down" id="livePreviewCert">
                        <div class="ui-cert-inner">
                            <div class="cert-logos-header">
                                <img src="/images/logo.png" alt="Logo" class="cert-logo-img">
                                <img src="/images/tesda.png" alt="TESDA" class="cert-logo-img">
                                <img src="/images/logo_ledipo.png" alt="LEDIPO" class="cert-logo-img">
                            </div>
                            <p class="cert-authority-text">
                                TECHNICAL EDUCATION AND SKILLS DEVELOPMENT AUTHORITY<br>
                                CITY GOVERNMENT OF DASMARIÑAS - LEDIPO
                            </p>
                            <h1 class="cert-title-primary" style="font-size: 18px;">CERTIFICATE OF COMPLETION</h1>
                            <p class="cert-certify-line">THIS CERTIFIES THAT</p>
                            <h2 id="pName" class="cert-recipient-name" style="font-size: 24px;">[NAME]</h2>
                            <p class="cert-training-msg">HAS SUCCESSFULLY COMPLETED THE TRAINING IN</p>
                            <h3 id="pCourse" class="cert-course-name" style="font-size: 16px;">[COURSE]</h3>
                            <div class="cert-signatures">
                                <div class="sig-item" style="width: 120px;">
                                    <p class="sig-name" style="font-size: 8px;">HON. JENNIFER A. BARZAGA</p>
                                </div>
                                <div class="sig-item" style="width: 120px;">
                                    <p class="sig-name" style="font-size: 8px;">MR. CARLOS H. LEGASPI</p>
                                </div>
                            </div>
                            <div class="cert-serial-footer">
                                <span id="pID" style="font-size: 7px;">CERT. NO.: [ID]</span>
                                <span style="font-size: 7px;">TRAINING ID: NCIIDRM-26-032</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-actions-container margin-top-20">
                        <button class="modal-action-btn btn-print full-width" onclick="alert('Saving...')">Save & Issue</button>
                        <button class="modal-action-btn btn-pdf full-width" onclick="handleDownload('livePreviewCert')">Download PDF</button>
                        <button class="modal-action-btn full-width" onclick="closeAddModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <p>Are you sure you want to log out?</p>
            <div class="modal-actions-centered">
                <a href="login.php" class="btn-modal-yes">Yes</a>
                <button type="button" class="btn-modal-cancel" onclick="hideLogoutModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script src="js/logout.js"></script>
    <script>
        function openAddModal() { document.getElementById('addTraineeModal').style.display = 'flex'; }
        function closeAddModal() { document.getElementById('addTraineeModal').style.display = 'none'; }
        
        function openCertModal(n, c, i) {
            document.getElementById('vName').innerText = n;
            document.getElementById('vCourse').innerText = c.toUpperCase();
            document.getElementById('vID').innerText = "CERT. NO.: " + i;
            document.getElementById('certificateModal').style.display = 'flex';
        }
        
        function closeCertModal() { document.getElementById('certificateModal').style.display = 'none'; }
        
        function updateLivePreview() {
            const s = document.getElementById('traineeSelect');
            const idInput = document.getElementById('certIDInput').value;
            if(s.selectedIndex > 0) {
                const n = s.value.split(' (')[0];
                const c = s.options[s.selectedIndex].getAttribute('data-course');
                document.getElementById('pName').innerText = n.toUpperCase();
                document.getElementById('pCourse').innerText = c.toUpperCase();
            }
            document.getElementById('pID').innerText = "CERT. NO.: " + (idInput || "[ID]");
        }

        async function handleDownload(elementId) {
            const { jsPDF } = window.jspdf;
            const element = document.getElementById(elementId);
            
            // Capture the certificate as a canvas
            const canvas = await html2canvas(element, { scale: 2 });
            const imgData = canvas.toDataURL('image/png');
            
            // Create PDF (Landscape)
            const pdf = new jsPDF('l', 'mm', 'a4');
            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save("Certificate.pdf");
        }

        function handlePrint() { 
            window.print(); 
        }

        window.onclick = function(e) { 
            if (e.target.classList.contains('modal-overlay')) { 
                e.target.style.display = 'none'; 
            } 
        };

        async function handleDownload(id) {
        const { jsPDF } = window.jspdf;
        const element = document.getElementById(id);
        
        // Add these options to fix the "not working on other laptops" issue
        const canvas = await html2canvas(element, { 
            scale: 2,
            useCORS: true,      // Essential for network access
            allowTaint: false,  // Prevents security errors
            logging: true       // Helps you see errors in the F12 console
        });
        
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('l', 'mm', 'a4');
        const width = pdf.internal.pageSize.getWidth();
        const height = (canvas.height * width) / canvas.width;
        
        pdf.addImage(imgData, 'PNG', 0, 0, width, height);
        pdf.save('Certificate.pdf');
        }
    </script>
            </div>

        </main>
    </div>{{-- end .app-body --}}


    {{-- ============================================================ --}}
    {{-- MODALS                                                        --}}
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
                            @foreach($allCourses as $course)
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
                            @foreach($allCourses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
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

    {{-- ANNOUNCEMENT MODAL --}}
    <div id="announcementModal" class="modal">
        <div class="modal-content card">
            <div class="modal-header">
                <h3 id="annModalTitle"><i class="fa-solid fa-bell"></i> Add Announcement</h3>
                <span class="close-modal" onclick="closeAnnouncementModal()">&times;</span>
            </div>
            <form id="announcementForm" class="modal-body">
                <input type="hidden" id="annId">
                <div class="input-field">
                    <label>Title</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-heading"></i>
                        <input type="text" id="annTitle" placeholder="Announcement title" required>
                    </div>
                </div>
                <div class="input-field">
                    <label>Message</label>
                    <textarea id="annMessage" placeholder="Announcement message..."
                        style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; resize:vertical; min-height:80px;" required></textarea>
                </div>
                <div class="input-field">
                    <label>Type</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-tag"></i>
                        <select id="annType" class="modal-input-select">
                            <option value="reminder">Reminder</option>
                            <option value="notice">Notice</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div></div>
                    <div class="action-buttons">
                        <button type="button" class="btn-cancel" onclick="closeAnnouncementModal()">Cancel</button>
                        <button type="submit" class="btn-save-main">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- COURSE CONTENT MODAL (Modules & Quizzes) --}}
    <div id="contentModal" class="modal">
        <div class="modal-content card" style="max-width:680px; width:95%;">
            <div class="modal-header">
                <h3><i class="fa-solid fa-layer-group"></i> Manage: <span id="contentModalCourseTitle"></span></h3>
                <span class="close-modal" onclick="closeContentModal()">&times;</span>
            </div>

            <div class="modal-body" style="padding-bottom:0;">
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

                <div id="content-tab-modules">
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

                    <div id="moduleListContainer" style="display:flex; flex-direction:column; gap:8px; max-height:320px; overflow-y:auto;">
                        <div style="text-align:center; color:#bbb; font-size:13px; padding:20px 0;" id="modulesEmptyState">
                            <i class="fa-solid fa-inbox"></i> Walang modules pa.
                        </div>
                    </div>
                </div>

                <div id="content-tab-quizzes" style="display:none;">
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

                    <div id="quizListContainer" style="display:flex; flex-direction:column; gap:8px; max-height:280px; overflow-y:auto;">
                        <div style="text-align:center; color:#bbb; font-size:13px; padding:20px 0;" id="quizzesEmptyState">
                            <i class="fa-solid fa-inbox"></i> Walang quizzes pa.
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer" style="margin-top:16px;">
                <div class="action-buttons">
                    <button class="btn-cancel" onclick="closeContentModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- SCRIPTS                                                       --}}
    {{-- ============================================================ --}}
    <script>
        // ── GLOBALS ────────────────────────────────────────────────────────────────
        // FIX: urlParams declared at the very top so all scripts below can use it
        const urlParams  = new URLSearchParams(window.location.search);
        const csrfToken  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let traineeHistoryInstance = null;
        let courseHistoryInstance  = null;
        let currentCourseId        = null;

        // ── TOPBAR ─────────────────────────────────────────────────────────────────
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

        // ── SIDEBAR ACTIVE ─────────────────────────────────────────────────────────
        function setActive(el) {
            document.querySelectorAll('.sidebar .nav-item').forEach(i => i.classList.remove('active'));
            el.classList.add('active');
        }

        // ── CHARTS ─────────────────────────────────────────────────────────────────
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

        // ── PAGE LOAD ──────────────────────────────────────────────────────────────
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

        // ── URL PARAM AUTO-VIEW ────────────────────────────────────────────────────
        // FIX: All URL param checks are here (outside DOMContentLoaded), AFTER urlParams is declared
        if (urlParams.get('view') === 'courses' || urlParams.get('page')) {
            showView('courses');
            setActive(document.getElementById('nav-courses'));
        }
        if (urlParams.get('trainee_page')) {
            showView('all-trainees');
            setActive(document.getElementById('nav-trainees'));
        }
        if (urlParams.get('trainer_page')) {
            showView('all-trainers');
            setActive(document.getElementById('nav-trainers'));
        }
        // FIX: announcement_page check moved here from inside DOMContentLoaded
        if (urlParams.get('view') === 'announcements' || urlParams.get('announcement_page')) {
            showView('announcements');
            setActive(document.getElementById('nav-announcements'));
        }

        // ── VIEW MANAGEMENT ────────────────────────────────────────────────────────
        function showView(viewName) {
            const allViews = [
                'view-overview','view-trainee-list','view-trainer-list',
                'view-facilities','view-courses','view-settings','view-analytics',
                'view-announcements','view-certificate','view-registrations'
            ];
            allViews.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });

            const title      = document.getElementById('main-title');
            const breadcrumb = document.getElementById('breadcrumb-current');

            const map = {
                overview:        ['view-overview',      'System Overview',    'System Overview'],
                analytics:       ['view-analytics',     'Detailed Analytics', `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Analytics`],
                'all-trainees':  ['view-trainee-list',  'Trainee Management', `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Trainees`],
                'all-trainers':  ['view-trainer-list',  'Trainer Management', `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Trainers`],
                facilities:      ['view-facilities',    'Facilities',         `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Facilities`],
                courses:         ['view-courses',       'Available Courses',  `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Courses`],
                settings:        ['view-settings',      'System Settings',    `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Settings`],
                announcements:   ['view-announcements', 'Announcements',      `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Announcements`],
                certificate:     ['view-certificate', 'Certificates', `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Certificates`],
                registrations:   ['view-registrations', 'Registrations', `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Registrations`],
            };

            const entry = map[viewName] || map['overview'];
            const el = document.getElementById(entry[0]);
            if (el) el.style.display = 'block';
            title.innerText    = entry[1];
            breadcrumb.innerHTML = entry[2];

            if (viewName === 'analytics') setTimeout(initHistoryChart, 100);

            if (window.innerWidth <= 768) {
                sidebar.classList.remove('sidebar-open');
                overlay.classList.remove('show');
            }
        }

        // ── UTILITIES ──────────────────────────────────────────────────────────────
        function toggleUpdates() {
            const extra = document.getElementById("extra-updates");
            const btn   = document.getElementById("viewMoreBtn");
            if (extra.style.display === "none") {
                extra.style.display = "block";
                btn.innerHTML = `View Less <i class="fa-solid fa-chevron-up"></i>`;
            } else {
                extra.style.display = "none";
                btn.innerHTML = `View More <i class="fa-solid fa-chevron-down"></i>`;
            }
        }

        // ── LOGOUT ─────────────────────────────────────────────────────────────────
        function openLogoutModal()  { document.getElementById('logoutModal').style.display = 'block'; }
        function closeLogoutModal() { document.getElementById('logoutModal').style.display = 'none'; }
        function confirmLogout()    { document.getElementById('logout-form').submit(); }

        // ── COURSE MODAL ───────────────────────────────────────────────────────────
        function openCourseModal(id, name, duration, slots, trainerId, trainerName) {
            currentCourseId = id;
            document.getElementById('courseModal').style.display = 'block';
            document.querySelector('#courseModal h3').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Manage Course';
            document.querySelector('#courseModal .btn-delete-text').style.display = 'inline-block';
            document.getElementById('editCourseId').value   = id;
            document.getElementById('editCourseName').value = name;
            document.getElementById('editDuration').value   = duration;
            document.getElementById('editSlots').value      = slots;
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
            document.getElementById('trainerInitials').textContent  = initials;
            document.getElementById('trainerFullName').textContent  = name;
            document.getElementById('currentTrainerBox').style.display = 'flex';
            document.getElementById('noTrainerBox').style.display   = 'none';
        }

        function showNoTrainer() {
            document.getElementById('currentTrainerBox').style.display = 'none';
            document.getElementById('noTrainerBox').style.display      = 'block';
        }

        function assignTrainer() {
            const trainerId   = document.getElementById('trainerDropdown').value;
            const trainerName = document.getElementById('trainerDropdown').selectedOptions[0].text;
            if (!trainerId)      { alert('Please select a trainer first.'); return; }
            if (!currentCourseId){ alert('Please save the course first before assigning a trainer.'); return; }
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

        // ── OTHER MODALS ───────────────────────────────────────────────────────────
        function openUserModal(name, email, role, status) {
            document.getElementById('userModal').style.display   = 'block';
            document.getElementById('editUserName').value        = name;
            document.getElementById('editUserEmail').value       = email;
            document.getElementById('editUserRole').value        = role;
            document.getElementById('editUserStatus').value      = status;
        }
        function closeUserModal() { document.getElementById('userModal').style.display = 'none'; }

        function openFacilityModal(name, address, capacity, course) {
            document.getElementById('facilityModal').style.display = 'block';
            document.querySelector('#facilityModal h3').innerHTML   = '<i class="fa-solid fa-building-circle-gear"></i> Manage Facility';
            document.querySelector('#facilityModal .btn-delete-text').style.display = 'inline-block';
            document.getElementById('editFacName').value    = name;
            document.getElementById('editFacAddress').value = address;
            document.getElementById('editFacCap').value     = capacity;
        }
        function openAddFacilityModal() {
            document.getElementById('facilityModal').style.display = 'block';
            document.querySelector('#facilityModal h3').innerHTML   = '<i class="fa-solid fa-building-circle-plus"></i> Add New Facility';
            document.getElementById('facilityForm').reset();
            document.querySelector('#facilityModal .btn-delete-text').style.display = 'none';
        }
        function closeFacilityModal() { document.getElementById('facilityModal').style.display = 'none'; }

        function openAddTrainerModal()  { document.getElementById('addTrainerModal').style.display = 'block'; }
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
                closeAnnouncementModal();
            }
        };

        document.getElementById('addTrainerForm').onsubmit = function(e) {
            e.preventDefault();
            const name     = document.getElementById('newTrainerName').value.trim().split(' ');
            const email    = document.getElementById('newTrainerEmail').value.trim();
            const password = document.getElementById('newTrainerPass').value.trim();

            if (!name.length || !email || !password) {
                alert('Punan ang lahat ng fields.'); return;
            }

            const courseId = document.getElementById('newTrainerCourse').value;

            fetch('/admin/trainer/store', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({
                    firstname: name[0],
                    lastname:  name.slice(1).join(' ') || '-',
                    email,
                    password,
                    course_id: courseId || null,
                })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    alert('Trainer account created successfully!');
                    closeAddTrainerModal();
                    location.reload();
                } else {
                    alert(data.message || 'May error. Subukan ulit.');
                }
            })
            .catch(() => alert('May error. Subukan ulit.'));
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

        // ── ANNOUNCEMENTS ──────────────────────────────────────────────────────────
        function openAnnouncementModal() {
            document.getElementById('annId').value      = '';
            document.getElementById('annTitle').value   = '';
            document.getElementById('annMessage').value = '';
            document.getElementById('annType').value    = 'reminder';
            document.getElementById('annModalTitle').innerHTML = '<i class="fa-solid fa-bell"></i> Add Announcement';
            document.getElementById('announcementModal').style.display = 'block';
        }

        function editAnnouncement(id, title, message, type) {
            document.getElementById('annId').value      = id;
            document.getElementById('annTitle').value   = title;
            document.getElementById('annMessage').value = message;
            document.getElementById('annType').value    = type;
            document.getElementById('annModalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Announcement';
            document.getElementById('announcementModal').style.display = 'block';
        }

        function closeAnnouncementModal() {
            document.getElementById('announcementModal').style.display = 'none';
        }

        document.getElementById('announcementForm').onsubmit = function(e) {
            e.preventDefault();
            const id      = document.getElementById('annId').value;
            const title   = document.getElementById('annTitle').value.trim();
            const message = document.getElementById('annMessage').value.trim();
            const type    = document.getElementById('annType').value;

            const isEdit = id !== '';
            const url    = isEdit ? `/admin/announcement/${id}` : '/admin/announcement';
            const method = isEdit ? 'PUT' : 'POST';

            fetch(url, {
                method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ title, message, type })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    closeAnnouncementModal();
                    // FIX: redirect with view=announcements so the page auto-shows the announcements tab
                    window.location.href = window.location.pathname + '?view=announcements';
                } else {
                    alert('May error: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(err => {
                console.error(err);
                alert('May error sa pag-save. Tingnan ang console.');
            });
        };

        function toggleAnn(id, btn) {
            fetch(`/admin/announcement/${id}/toggle`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            })
            .then(r => r.json())
            .then(data => { if (data.success) location.reload(); })
            .catch(() => alert('May error. Subukan ulit.'));
        }

        function deleteAnn(id) {
            if (!confirm('I-delete ang announcement na ito?')) return;
            fetch(`/admin/announcement/${id}`, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            })
            .then(r => r.json())
            .then(data => { if (data.success) location.reload(); })
            .catch(() => alert('May error. Subukan ulit.'));
        }

        // ── COURSE CONTENT (Modules & Quizzes) ────────────────────────────────────
        let _contentCourseId = null;
        let _contentModules  = [];
        let _contentQuizzes  = [];

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
                <div style="display:flex; flex-direction:column; gap:0; background:#fff;
                            border:1px solid #eee; border-radius:10px; overflow:hidden;">
                    <div style="display:flex; align-items:center; gap:10px; padding:10px 14px;">
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
                        <button onclick="toggleQuizQuestions(${q.id}, this)"
                            style="font-size:11px; padding:4px 10px; border-radius:6px;
                                background:#e8f5e9; color:#025628; border:none; cursor:pointer;
                                font-family:inherit; font-weight:700; white-space:nowrap;">
                            <i class="fa-solid fa-list"></i> Questions
                        </button>
                        <button onclick="deleteQuiz(${q.id})"
                            style="font-size:11px; padding:4px 10px; border-radius:6px;
                                background:#FCEBEB; color:#A32D2D; border:none; cursor:pointer;
                                font-family:inherit; font-weight:700; white-space:nowrap;">
                            <i class="fa-solid fa-trash"></i> Remove
                        </button>
                    </div>
                    <div id="quiz-questions-${q.id}" style="display:none; border-top:1px solid #eee; padding:12px 14px; background:#fafafa;">
                        <div id="qlist-${q.id}" style="display:flex; flex-direction:column; gap:6px; margin-bottom:10px;"></div>
                        <div style="background:#fff; border:1px solid #eee; border-radius:8px; padding:12px;">
                            <div style="font-size:12px; font-weight:700; color:#025628; margin-bottom:8px; text-transform:uppercase;">
                                <i class="fa-solid fa-plus"></i> Add Question
                            </div>
                            <textarea id="qtext-${q.id}" placeholder="Question text..." rows="2"
                                style="width:100%; border:1px solid #ddd; border-radius:8px; padding:8px; font-size:13px; font-family:inherit; margin-bottom:8px; resize:vertical;"></textarea>
                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:6px; margin-bottom:8px;">
                                <input type="text" id="qa-${q.id}" placeholder="A. Choice A"
                                    style="border:1px solid #ddd; border-radius:8px; padding:7px 10px; font-size:13px; font-family:inherit;">
                                <input type="text" id="qb-${q.id}" placeholder="B. Choice B"
                                    style="border:1px solid #ddd; border-radius:8px; padding:7px 10px; font-size:13px; font-family:inherit;">
                                <input type="text" id="qc-${q.id}" placeholder="C. Choice C"
                                    style="border:1px solid #ddd; border-radius:8px; padding:7px 10px; font-size:13px; font-family:inherit;">
                                <input type="text" id="qd-${q.id}" placeholder="D. Choice D"
                                    style="border:1px solid #ddd; border-radius:8px; padding:7px 10px; font-size:13px; font-family:inherit;">
                            </div>
                            <div style="display:flex; gap:8px; align-items:center;">
                                <label style="font-size:12px; color:#666;">Correct answer:</label>
                                <select id="qans-${q.id}"
                                    style="border:1px solid #ddd; border-radius:8px; padding:6px 10px; font-size:13px; font-family:inherit; background:#fff;">
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                                <button onclick="addQuestion(${q.id})"
                                    style="background:#025628; color:#fff; border:none; border-radius:8px; padding:7px 16px;
                                        font-size:12px; font-weight:700; cursor:pointer; font-family:inherit; margin-left:auto;">
                                    <i class="fa-solid fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        }

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

        function populateQuizModuleDropdown() {
            const sel = document.getElementById('newQuizModule');
            sel.innerHTML = '<option value="">— Link to module (optional) —</option>';
            _contentModules.forEach(m => {
                const opt       = document.createElement('option');
                opt.value       = m.id;
                opt.textContent = m.title;
                sel.appendChild(opt);
            });
        }

        function escHtml(str) {
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(str || ''));
            return div.innerHTML;
        }

        function toggleQuizQuestions(quizId, btn) {
            const panel  = document.getElementById(`quiz-questions-${quizId}`);
            const isOpen = panel.style.display !== 'none';
            panel.style.display = isOpen ? 'none' : 'block';
            if (!isOpen) loadQuizQuestions(quizId);
        }

        function loadQuizQuestions(quizId) {
            fetch(`/admin/quiz/${quizId}/questions`, {
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => renderQuizQuestions(quizId, data.questions || []))
            .catch(() => alert('Hindi ma-load ang questions.'));
        }

        function renderQuizQuestions(quizId, questions) {
            const container = document.getElementById(`qlist-${quizId}`);
            if (!questions.length) {
                container.innerHTML = '<div style="font-size:12px; color:#aaa; text-align:center; padding:8px;">Walang questions pa.</div>';
                return;
            }
            container.innerHTML = questions.map((q, i) => `
                <div style="display:flex; align-items:flex-start; gap:8px; background:#fff;
                            border:1px solid #eee; border-radius:8px; padding:8px 12px;">
                    <div style="width:22px; height:22px; border-radius:50%; background:#e8f5e9;
                                display:flex; align-items:center; justify-content:center;
                                font-size:11px; font-weight:700; color:#025628; flex-shrink:0; margin-top:1px;">
                        ${i+1}
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="font-size:13px; font-weight:600; color:#1a1a1a; margin-bottom:4px;">${escHtml(q.question)}</div>
                        <div style="font-size:11px; color:#555; display:grid; grid-template-columns:1fr 1fr; gap:2px;">
                            <span ${q.correct_answer==='a' ? 'style="color:#025628; font-weight:700;"' : ''}>A. ${escHtml(q.choice_a)}</span>
                            <span ${q.correct_answer==='b' ? 'style="color:#025628; font-weight:700;"' : ''}>B. ${escHtml(q.choice_b)}</span>
                            <span ${q.correct_answer==='c' ? 'style="color:#025628; font-weight:700;"' : ''}>C. ${escHtml(q.choice_c)}</span>
                            <span ${q.correct_answer==='d' ? 'style="color:#025628; font-weight:700;"' : ''}>D. ${escHtml(q.choice_d)}</span>
                        </div>
                    </div>
                    <button onclick="deleteQuestion(${q.id}, ${quizId})"
                        style="font-size:11px; padding:3px 8px; border-radius:6px; background:#FCEBEB;
                            color:#A32D2D; border:none; cursor:pointer; font-family:inherit; font-weight:700; flex-shrink:0;">
                        ✕
                    </button>
                </div>
            `).join('');
        }

        function addQuestion(quizId) {
            const question = document.getElementById(`qtext-${quizId}`).value.trim();
            const a        = document.getElementById(`qa-${quizId}`).value.trim();
            const b        = document.getElementById(`qb-${quizId}`).value.trim();
            const c        = document.getElementById(`qc-${quizId}`).value.trim();
            const d        = document.getElementById(`qd-${quizId}`).value.trim();
            const ans      = document.getElementById(`qans-${quizId}`).value;

            if (!question || !a || !b || !c || !d) {
                alert('Punan ang lahat ng fields.'); return;
            }

            fetch('/admin/quiz-question', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ quiz_id: quizId, question, choice_a: a, choice_b: b, choice_c: c, choice_d: d, correct_answer: ans })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`qtext-${quizId}`).value = '';
                    document.getElementById(`qa-${quizId}`).value    = '';
                    document.getElementById(`qb-${quizId}`).value    = '';
                    document.getElementById(`qc-${quizId}`).value    = '';
                    document.getElementById(`qd-${quizId}`).value    = '';
                    loadQuizQuestions(quizId);
                }
            })
            .catch(() => alert('May error. Subukan ulit.'));
        }

        function deleteQuestion(id, quizId) {
            if (!confirm('I-remove ang question na ito?')) return;
            fetch(`/admin/quiz-question/${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ _method: 'DELETE' })
            })
            .then(r => r.json())
            .then(data => { if (data.success) loadQuizQuestions(quizId); })
            .catch(() => alert('May error. Subukan ulit.'));
        }

        // ── CERTIFICATE ────────────────────────────────────────────────────────────
        function toggleSelectCol() {
            const show = document.getElementById('toggleMultiple').checked;
            document.querySelectorAll('.cert-select-col').forEach(el => {
                el.style.display = show ? '' : 'none';
            });
            if (!show) document.getElementById('selectAll').checked = false;
        }

        function toggleSelectAll(cb) {
            document.querySelectorAll('.row-checkbox').forEach(c => c.checked = cb.checked);
        }

        function deleteCertRow(btn) {
            if (!confirm('I-delete ang certificate na ito?')) return;
            btn.closest('tr').remove();
        }

        function openCertViewModal(name, course, certNo) {
            document.getElementById('certViewName').textContent   = name;
            document.getElementById('certViewCourse').textContent = course.toUpperCase();
            document.getElementById('certViewNo').textContent     = 'CERT. NO.: ' + certNo;
            document.getElementById('certViewModal').style.display = 'flex';
        }
        function closeCertViewModal() {
            document.getElementById('certViewModal').style.display = 'none';
        }

        function openIssueCertModal() {
            document.getElementById('issueCertModal').style.display = 'flex';
            updateCertPreview();
        }
        function closeIssueCertModal() {
            document.getElementById('issueCertModal').style.display = 'none';
        }

        function updateCertPreview() {
            const sel    = document.getElementById('issueTraineeSelect');
            const nameEl = document.getElementById('previewName');
            const crsEl  = document.getElementById('previewCourse');
            if (!sel || !nameEl) return;
            const rawName = sel.value ? sel.value.split(' (')[0] : '[NAME]';
            const course  = sel.value && sel.selectedIndex > 0
                ? sel.options[sel.selectedIndex].getAttribute('data-course') || '[COURSE]'
                : '[COURSE]';
            nameEl.textContent = rawName.toUpperCase();
            crsEl.textContent  = course.toUpperCase();
        }

        // ── CERTIFICATE PDF GENERATION ─────────────────────────────────────────────

        function generateCertPDF({ name, course, controlNumber, dateLabel, docType, remarks }) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });
            const W = 297, H = 210;

            // White background
            doc.setFillColor(255, 255, 255);
            doc.rect(0, 0, W, H, 'F');

            // Outer border (dark green)
            doc.setDrawColor(2, 86, 40);
            doc.setLineWidth(4);
            doc.rect(8, 8, W - 16, H - 16);

            // Inner border (gold)
            doc.setDrawColor(180, 150, 50);
            doc.setLineWidth(1);
            doc.rect(12, 12, W - 24, H - 24);

            // Header — TESDA line
            doc.setFont('helvetica', 'normal');
            doc.setFontSize(8);
            doc.setTextColor(100, 100, 100);
            doc.text('TECHNICAL EDUCATION AND SKILLS DEVELOPMENT AUTHORITY', W / 2, 36, { align: 'center' });

            // Header — LEDIPO line
            doc.setFontSize(9);
            doc.setTextColor(60, 60, 60);
            doc.text('CITY GOVERNMENT OF DASMARIÑAS – LEDIPO', W / 2, 43, { align: 'center' });

            // Gold divider
            doc.setDrawColor(180, 150, 50);
            doc.setLineWidth(0.8);
            doc.line(55, 47, W - 55, 47);

            // Certificate type title
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(22);
            doc.setTextColor(2, 86, 40);
            doc.text(docType.toUpperCase(), W / 2, 63, { align: 'center' });

            // "This certifies that"
            doc.setFont('helvetica', 'italic');
            doc.setFontSize(10);
            doc.setTextColor(90, 90, 90);
            doc.text('This is to certify that', W / 2, 75, { align: 'center' });

            // Trainee name
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(26);
            doc.setTextColor(15, 15, 15);
            doc.text(name.toUpperCase(), W / 2, 91, { align: 'center' });

            // Name underline
            const nameW = doc.getTextWidth(name.toUpperCase());
            doc.setDrawColor(2, 86, 40);
            doc.setLineWidth(0.5);
            doc.line(W / 2 - nameW / 2, 94, W / 2 + nameW / 2, 94);

            // "has successfully completed"
            doc.setFont('helvetica', 'normal');
            doc.setFontSize(10);
            doc.setTextColor(80, 80, 80);
            doc.text('has successfully completed the training in', W / 2, 105, { align: 'center' });

            // Course name
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(15);
            doc.setTextColor(2, 86, 40);
            doc.text(course.toUpperCase(), W / 2, 117, { align: 'center' });

            // Date
            doc.setFont('helvetica', 'normal');
            doc.setFontSize(9);
            doc.setTextColor(90, 90, 90);
            doc.text(`held on ${dateLabel}`, W / 2, 126, { align: 'center' });

            // Remarks (if any)
            if (remarks && remarks.trim()) {
                doc.setFontSize(9);
                doc.setTextColor(110, 110, 110);
                doc.text(`Remarks: ${remarks}`, W / 2, 134, { align: 'center' });
            }

            // Control number (bottom right)
            if (controlNumber && controlNumber.trim()) {
                doc.setFontSize(8);
                doc.setTextColor(160, 160, 160);
                doc.text(`Control No.: ${controlNumber}`, W - 18, H - 15, { align: 'right' });
            }

            // Signature lines
            const sig1X = 80, sig2X = W - 80, sigY = H - 38;
            doc.setDrawColor(50, 50, 50);
            doc.setLineWidth(0.5);
            doc.line(sig1X - 35, sigY, sig1X + 35, sigY);
            doc.line(sig2X - 35, sigY, sig2X + 35, sigY);

            doc.setFont('helvetica', 'bold');
            doc.setFontSize(9);
            doc.setTextColor(20, 20, 20);
            doc.text('HON. JENNIFER A. BARZAGA', sig1X, sigY + 6, { align: 'center' });
            doc.text('MR. CARLOS H. LEGASPI', sig2X, sigY + 6, { align: 'center' });

            doc.setFont('helvetica', 'normal');
            doc.setFontSize(8);
            doc.setTextColor(100, 100, 100);
            doc.text('City Mayor', sig1X, sigY + 11, { align: 'center' });
            doc.text('LEDIPO Head', sig2X, sigY + 11, { align: 'center' });

            return doc;
        }

        function saveAndIssueCert() {
            const sel        = document.getElementById('issueTraineeSelect');
            const controlNum = document.getElementById('issueControlNum').value.trim();
            const dateInput  = document.getElementById('issueDate').value;
            const docType    = document.getElementById('issueDocType').value;
            const remarks    = document.getElementById('issueRemarks').value.trim();

            if (!sel.value) {
                alert('Pumili muna ng trainee.');
                return;
            }

            const name   = sel.value.split(' (')[0];
            const course = sel.options[sel.selectedIndex].getAttribute('data-course') || '';

            const dateLabel = dateInput
                ? new Date(dateInput + 'T12:00:00').toLocaleDateString('en-PH', { year: 'numeric', month: 'long', day: 'numeric' })
                : new Date().toLocaleDateString('en-PH', { year: 'numeric', month: 'long', day: 'numeric' });

            const doc      = generateCertPDF({ name, course, controlNumber: controlNum, dateLabel, docType, remarks });
            const safeName = name.replace(/[^a-zA-Z0-9]/g, '_');
            doc.save(`LEDIPO_Certificate_${safeName}.pdf`);

            addCertTableRow(name, course, dateLabel, controlNum);
            closeIssueCertModal();
            alert('Certificate issued and downloaded successfully!');
        }

        function downloadExistingCert() {
            // Reads from the View Certificate modal
            const name   = document.getElementById('certViewName').textContent;
            const course = document.getElementById('certViewCourse').textContent;
            const certNo = document.getElementById('certViewNo').textContent.replace('CERT. NO.: ', '');

            const dateLabel = new Date().toLocaleDateString('en-PH', { year: 'numeric', month: 'long', day: 'numeric' });

            const doc = generateCertPDF({
                name,
                course,
                controlNumber: certNo,
                dateLabel,
                docType: 'Certificate of Completion',
                remarks: ''
            });

            const safeName = name.replace(/[^a-zA-Z0-9]/g, '_');
            doc.save(`LEDIPO_Certificate_${safeName}.pdf`);
        }

        function addCertTableRow(name, course, dateLabel, controlNum) {
            const tbody = document.getElementById('certTableBody');
            if (!tbody) return;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="cert-select-col" style="display:none;"><input type="checkbox" class="row-checkbox"></td>
                <td>${name}</td>
                <td>${course}</td>
                <td>${dateLabel}</td>
                <td><span class="cert-badge claimed">Claimed</span></td>
                <td class="cert-action-icons">
                    <i class="fa fa-eye" onclick="openCertViewModal('${name}','${course}','${controlNum || 'N/A'}')" title="View"></i>
                    <i class="fa fa-trash-alt" onclick="deleteCertRow(this)" title="Delete"></i>
                </td>
            `;
            tbody.insertBefore(tr, tbody.firstChild);
        }

    </script>

        {{-- CERT VIEW MODAL --}}
<div id="certViewModal" class="cert-modal-overlay" onclick="if(event.target===this)closeCertViewModal()">
    <div class="cert-modal-box">
        <div class="cert-modal-split">
            <div class="cert-modal-left">
                <h3 class="cert-modal-section-title">Certificate Preview</h3>
                <div class="cert-frame-preview">
                    <div class="cert-inner">
                        <p class="cert-authority">TECHNICAL EDUCATION AND SKILLS DEVELOPMENT AUTHORITY<br>CITY GOVERNMENT OF DASMARIÑAS – LEDIPO</p>
                        <h2 class="cert-title">CERTIFICATE OF COMPLETION</h2>
                        <p class="cert-certify">THIS CERTIFIES THAT</p>
                        <h3 id="certViewName" class="cert-recipient">Nelmida, Rheyan</h3>
                        <p class="cert-msg">HAS SUCCESSFULLY COMPLETED THE TRAINING IN</p>
                        <h4 id="certViewCourse" class="cert-course">DRESSMAKING</h4>
                        <div class="cert-sigs">
                            <div><p class="sig-name">HON. JENNIFER A. BARZAGA</p><p class="sig-role">City Mayor</p></div>
                            <div><p class="sig-name">MR. CARLOS H. LEGASPI</p><p class="sig-role">LEDIPO Head</p></div>
                        </div>
                        <div class="cert-footer-no">
                            <span id="certViewNo">CERT. NO.: D-LED-TES-2026-081</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cert-modal-right">
                <h2 class="cert-modal-title">Certificate Details</h2>
                <div class="cert-info-block">
                    <span class="cert-info-label">Trainee Performance</span>
                    <p class="cert-info-value" style="color:#025628; font-weight:700;">94% – Passed</p>
                </div>
                <div class="cert-info-block">
                    <span class="cert-info-label">Official Signatories</span>
                    <ul class="cert-sig-list">
                        <li><i class="fa fa-check-circle"></i> Hon. Jennifer Austria-Barzaga</li>
                        <li><i class="fa fa-check-circle"></i> Mr. Carlos H. Legaspi</li>
                    </ul>
                </div>
                <div class="cert-modal-actions">
                    <button class="cert-modal-btn btn-pdf" onclick="downloadExistingCert()">Download PDF</button>
                    <button class="cert-modal-btn btn-print" onclick="window.print()">Re-Print</button>
                    <button class="cert-modal-btn" onclick="closeCertViewModal()">Close View</button>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- ISSUE CERT MODAL --}}
    <div id="issueCertModal" class="cert-modal-overlay" onclick="if(event.target===this)closeIssueCertModal()">
        <div class="cert-modal-box">
            <div class="cert-modal-split">
                <div class="cert-modal-right" style="border-right:1px solid #eee;">
                    <h2 class="cert-modal-title">Issue New Certificate</h2>
                    <div class="cert-form-group">
                        <label>1. Trainee Selection</label>
                        <select class="cert-form-select" id="issueTraineeSelect" onchange="updateCertPreview()">
                            <option value="" disabled selected>Select Trainee...</option>
                            <option data-course="Dressmaking">Nelmida, Rheyan (94%)</option>
                            <option data-course="Nail Care">Bong, Marcos (88%)</option>
                        </select>
                    </div>
                    <div class="cert-form-group">
                        <label>2. Record Details</label>
                        <input type="text" class="cert-form-select" placeholder="Control Number">
                        <input type="date" class="cert-form-select" style="margin-top:8px;" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="cert-form-group">
                        <label>3. Document Options</label>
                        <select class="cert-form-select">
                            <option>Certificate of Completion</option>
                        </select>
                        <textarea class="cert-form-select" style="margin-top:8px; resize:none; height:70px;" placeholder="Remarks"></textarea>
                    </div>
                    <div class="cert-modal-actions" style="margin-top:16px;">
                        <button class="cert-modal-btn btn-print" onclick="saveAndIssueCert()">Save & Issue</button>
                        <button class="cert-modal-btn" onclick="closeIssueCertModal()">Cancel</button>
                    </div>
                </div>
                <div class="cert-modal-left" style="background:#fff;">
                    <h3 class="cert-modal-section-title">Live Preview</h3>
                    <div class="cert-frame-preview scale-down">
                        <div class="cert-inner">
                            <p class="cert-authority" style="font-size:7px;">CITY GOVERNMENT OF DASMARIÑAS – LEDIPO</p>
                            <h2 class="cert-title" style="font-size:13px;">CERTIFICATE OF COMPLETION</h2>
                            <h3 id="previewName" class="cert-recipient" style="font-size:14px;">[NAME]</h3>
                            <p class="cert-msg" style="font-size:8px;">HAS SUCCESSFULLY COMPLETED THE TRAINING IN</p>
                            <h4 id="previewCourse" class="cert-course" style="font-size:11px;">[COURSE]</h4>
                            <div class="cert-sigs" style="margin-top:16px;">
                                <div><p class="sig-name" style="font-size:8px;">J.A. BARZAGA</p></div>
                                <div><p class="sig-name" style="font-size:8px;">C.H. LEGASPI</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>