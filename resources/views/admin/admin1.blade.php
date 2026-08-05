<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Dashboard - System Overview</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('stylesheet/admin-dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheet/certificates.css') }}">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Scripts -->
  <script
    src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
  </script>

  <style>
    /* ========================================================== */
    /* GENERAL & COMPONENT STYLES                                 */
    /* ========================================================== */
    .input-wrapper.input-with-suffix {
      display: flex;
      align-items: center;
    }

    .input-wrapper.input-with-suffix input {
      flex: 1;
      border: none;
      outline: none;
      background: transparent;
    }

    .input-suffix {
      padding-right: 10px;
      font-size: 0.85rem;
      color: #6c757d;
      font-weight: 500;
      user-select: none;
    }

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
      border: 1px solid rgba(0, 0, 0, 0.12);
      border-radius: 8px;
      padding: 8px 12px;
      font-size: 13px;
      font-family: inherit;
      outline: none;
      background: #fff;
    }

    .assign-trainer-row select:focus {
      border-color: #025628;
    }

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

    .btn-assign:hover {
      background: #014d20;
    }

    .current-trainer-box {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #fff;
      border: 1px solid rgba(0, 0, 0, 0.08);
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

    .trainer-details {
      flex: 1;
    }

    .trainer-fullname {
      font-size: 13px;
      font-weight: 700;
      color: #1a1a1a;
    }

    .trainer-sub {
      font-size: 11px;
      color: #888;
    }

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
      background: rgba(0, 0, 0, 0.5);
    }

    #courseModal .modal-content {
      max-height: 90vh !important;
      margin: 3vh auto !important;
      display: flex !important;
      flex-direction: column !important;
      overflow: hidden !important;
      max-width: 540px !important;
      width: 95% !important;
    }

    #courseModal #courseForm {
      overflow-y: auto !important;
      max-height: calc(90vh - 120px);
      padding-right: 6px;
    }

    .modal-actions-centered button {
      margin: 10px;
      padding: 8px 15px;
    }

    /* Inactive Status Badge (Red Styling) */
    .course-badge.inactive {
      background-color: #FCEBEB;
      color: #A32D2D;
      border: 1px solid rgba(163, 45, 45, 0.2);
    }

    /* Active Status Badge (Green Styling) */
    .course-badge.active {
      background-color: #e8f5e9;
      color: #025628;
      border: 1px solid rgba(2, 86, 40, 0.2);
    }

    /* ========================================================== */
    /* ANNOUNCEMENT MODAL STYLES                                  */
    /* ========================================================== */
    /* Modal Container & Content Card */
    #announcementModal .modal-content.card {
      max-width: 520px !important;
      width: 95% !important;
      text-align: left !important;
    }

    #announcementModal .modal-body {
      display: flex !important;
      flex-direction: column !important;
      gap: 16px !important;
      padding: 20px !important;
      text-align: left !important;
    }

    /* Form Structure & Labels */
    #announcementModal .form-group {
      display: flex !important;
      flex-direction: column !important;
      align-items: stretch !important;
      width: 100% !important;
      box-sizing: border-box !important;
    }

    #announcementModal .label-row {
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      margin-bottom: 6px !important;
      width: 100% !important;
    }

    #announcementModal .label-row label,
    #announcementModal .form-group label {
      font-size: 13px !important;
      font-weight: 600 !important;
      color: #333 !important;
      margin: 0 !important;
      text-align: left !important;
    }

    #announcementModal .required {
      color: #a32d2d !important;
    }

    #announcementModal .char-counter {
      font-size: 11px !important;
      color: #888 !important;
    }

    /* Input Wrappers & Icon Alignment */
    #announcementModal .input-container {
      position: relative !important;
      display: flex !important;
      align-items: center !important;
      width: 100% !important;
      box-sizing: border-box !important;
    }

    #announcementModal .input-icon {
      position: absolute !important;
      left: 12px !important;
      color: #888 !important;
      font-size: 14px !important;
      pointer-events: none !important;
      z-index: 2 !important;
    }

    /* Text Inputs & Select Dropdowns */
    #announcementModal .input-container input[type="text"],
    #announcementModal .input-container select {
      width: 100% !important;
      height: 42px !important;
      padding: 0 12px 0 36px !important;
      border: 1px solid #ccc !important;
      border-radius: 6px !important;
      font-size: 14px !important;
      color: #333 !important;
      background-color: #fff !important;
      box-sizing: border-box !important;
      outline: none !important;
    }

    /* Textarea Layout */
    #announcementModal .textarea-container {
      align-items: flex-start !important;
    }

    #announcementModal .textarea-icon {
      top: 12px !important;
    }

    #announcementModal .textarea-container textarea {
      width: 100% !important;
      min-height: 95px !important;
      padding: 10px 12px 10px 36px !important;
      border: 1px solid #ccc !important;
      border-radius: 6px !important;
      font-size: 14px !important;
      font-family: inherit !important;
      color: #333 !important;
      background-color: #fff !important;
      box-sizing: border-box !important;
      resize: vertical !important;
      outline: none !important;
    }

    /* Focus States */
    #announcementModal .input-container input:focus,
    #announcementModal .input-container select:focus,
    #announcementModal .input-container textarea:focus,
    #announcementModal .datetime-input:focus {
      border-color: #025628 !important;
      box-shadow: 0 0 0 2px rgba(2, 86, 40, 0.1) !important;
    }

    /* Datetime Local Inputs & Container */
    #announcementModal .datetime-container {
      position: relative !important;
      width: 100% !important;
    }

    #announcementModal .datetime-input {
      width: 100% !important;
      height: 42px !important;
      padding: 8px 12px !important;
      border: 1px solid #ccc !important;
      border-radius: 6px !important;
      font-size: 13px !important;
      font-family: inherit !important;
      color: #333 !important;
      background-color: #fff !important;
      box-sizing: border-box !important;
      outline: none !important;
      cursor: pointer !important;
    }

    /* WebKit Native Calendar Indicator Icon */
    #announcementModal input[type="datetime-local"]::-webkit-calendar-picker-indicator {
      cursor: pointer !important;
      opacity: 0.6;
      filter: invert(0.3);
    }

    #announcementModal input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
      opacity: 1;
    }

    /* Form Row Grid & Checkbox Card */
    #announcementModal .form-row {
      display: flex !important;
      gap: 16px !important;
      align-items: flex-end !important;
      width: 100% !important;
    }

    #announcementModal .flex-1 {
      flex: 1 !important;
    }

    #announcementModal .status-group {
      width: auto !important;
    }

    #announcementModal .checkbox-card {
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      height: 42px !important;
      padding: 0 14px !important;
      border: 1px solid #ccc !important;
      border-radius: 6px !important;
      background: #fdfdfd !important;
      cursor: pointer !important;
      box-sizing: border-box !important;
    }

    #announcementModal .checkbox-card input[type="checkbox"] {
      accent-color: #025628 !important;
      width: 16px !important;
      height: 16px !important;
      cursor: pointer !important;
    }

    #announcementModal .checkbox-text {
      font-size: 13px !important;
      color: #333 !important;
      font-weight: 500 !important;
      user-select: none !important;
    }

    /* Modal Footer */
    #announcementModal .modal-footer {
      display: flex !important;
      justify-content: flex-end !important;
      gap: 10px !important;
      margin-top: 8px !important;
      padding-top: 14px !important;
      border-top: 1px solid #eee !important;
    }
  </style>
</head>

<body>

  <!-- ========================================================== -->
  <!-- TOPBAR                                                     -->
  <!-- ========================================================== -->
  <nav class="topbar">
    <div class="topbar-left">
      <button class="hamburger" id="hamburger" aria-label="Toggle sidebar">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a href="{{ route('admin1') }}" class="topbar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="logo"
          class="topbar-logo">
        <span>LEDIPO</span>
      </a>
    </div>

    <div class="topbar-right">
      <button class="avatar-btn" id="avatarBtn"
        aria-label="Open profile menu">AD</button>

      <div class="dropdown" id="dropdown">
        <div class="dropdown-header">
          <div class="dh-name">Administrator</div>
          <div class="dh-role">Admin</div>
        </div>

        <div class="dd-divider"></div>
        <a href="#" class="dd-item dd-logout"
          onclick="event.preventDefault(); openLogoutModal();">
          <i class="fa fa-right-from-bracket dd-icon"></i>
          Log out
        </a>
        <form id="logout-form" action="{{ route('Logout') }}" method="POST"
          style="display:none;">
          @csrf
        </form>
      </div>
    </div>
  </nav>

  <!-- Logout Confirmation Modal -->
  <div id="logoutModal" class="modal" style="display:none;">
    <div class="modal-content">
      <p>Are you sure you want to log out?</p>
      <div class="modal-actions-centered">
        <button onclick="confirmLogout()" class="btn-modal-yes">Yes</button>
        <button onclick="closeLogoutModal()"
          class="btn-modal-no">Cancel</button>
      </div>
    </div>
  </div>

  <!-- ========================================================== -->
  <!-- APP BODY & SIDEBAR                                         -->
  <!-- ========================================================== -->
  <div class="app-body">
    <div class="sidebar-overlay" id="overlay"></div>

    <aside class="sidebar" id="sidebar">
      <div class="sidebar-section-label">Menu</div>

      <a href="?view=overview" class="nav-item active" id="nav-overview"
        onclick="showView('overview'); setActive(this); return false;">
        <i class="fa fa-gauge-high nav-icon"></i>
        <span>Overview</span>
      </a>

      <div class="sidebar-section-label">Manage</div>

      <a href="?view=all-trainees" class="nav-item" id="nav-trainees"
        onclick="showView('all-trainees'); setActive(this); return false;">
        <i class="fa fa-user-graduate nav-icon"></i>
        <span>Trainees</span>
      </a>

      <a href="?view=all-trainers" class="nav-item" id="nav-trainers"
        onclick="showView('all-trainers'); setActive(this); return false;">
        <i class="fa fa-chalkboard-user nav-icon"></i>
        <span>Trainers</span>
      </a>

      <a href="?view=registrations" class="nav-item" id="nav-registrations"
        onclick="showView('registrations'); setActive(this); return false;">
        <i class="fa fa-clipboard-list nav-icon"></i>
        <span>Registrations</span>
      </a>

      <a href="?view=courses" class="nav-item" id="nav-courses"
        onclick="showView('courses'); setActive(this); return false;">
        <i class="fa fa-book nav-icon"></i>
        <span>Courses</span>
      </a>

      <a href="?view=facilities" class="nav-item" id="nav-facilities"
        onclick="showView('facilities'); setActive(this); return false;">
        <i class="fa fa-building nav-icon"></i>
        <span>Facilities</span>
      </a>

      <div class="sidebar-section-label">System</div>

      <a href="?view=announcements" class="nav-item" id="nav-announcements"
        onclick="showView('announcements'); setActive(this); return false;">
        <i class="fa fa-bell nav-icon"></i>
        <span>Announcements</span>
      </a>

      <a href="?view=analytics" class="nav-item" id="nav-analytics"
        onclick="showView('analytics'); setActive(this); return false;">
        <i class="fa fa-chart-line nav-icon"></i>
        <span>Reports</span>
      </a>

      <a href="?view=settings" class="nav-item" id="nav-settings"
        onclick="showView('settings'); setActive(this); return false;">
        <i class="fa fa-gear nav-icon"></i>
        <span>Settings</span>
      </a>

      <a href="?view=certificate" class="nav-item" id="nav-certificate"
        onclick="showView('certificate'); setActive(this); return false;">
        <i class="fa fa-award nav-icon"></i>
        <span>Certificate</span>
      </a>
    </aside>

    <!-- ========================================================== -->
    <!-- MAIN CONTENT AREA                                          -->
    <!-- ========================================================== -->
    <main class="admin-main">
      <nav class="breadcrumb">
        <a href="#"
          onclick="showView('overview'); return false;">Home</a> /
        <span id="breadcrumb-current">System Overview</span>
      </nav>
      <h1 class="page-title" id="main-title">System Overview</h1>

      <!-- 1. OVERVIEW VIEW -->
      <div id="view-overview">
        <div class="charts-row">
          <div class="card chart-card">
            <h3>Trainees</h3>
            <canvas id="traineeChart"></canvas>
            <a href="#" class="view-more"
              onclick="showView('analytics'); setActive(document.getElementById('nav-analytics')); return false;">View
              more</a>
          </div>
          <div class="card chart-card">
            <h3>Courses</h3>
            <canvas id="courseChart"></canvas>
            <a href="#" class="view-more"
              onclick="showView('analytics'); setActive(document.getElementById('nav-analytics')); return false;">View
              more</a>
          </div>
        </div>

        <div class="card updates-card">
          <h3><i class="fa-solid fa-bell"></i> Updates</h3>

          <!-- Primary 3 Announcements -->
          <ul class="update-list" id="updateList"
            style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
            @forelse($announcements->take(3) as $ann)
              @php
                $icon = match ($ann->type) {
                    'urgent' => 'fa-circle-exclamation',
                    'notice' => 'fa-bullhorn',
                    default => 'fa-bell',
                };
                $badgeColor = match ($ann->type) {
                    'urgent' => '#A32D2D',
                    'notice' => '#854F0B',
                    default => '#025628',
                };
                $bgColor = match ($ann->type) {
                    'urgent' => '#FCEBEB',
                    'notice' => '#FFF8E1',
                    default => '#E8F5E9',
                };
              @endphp
              <li
                style="display: flex; align-items: flex-start; gap: 12px; padding: 10px 12px; background: #fff; border: 1px solid #f0f0f0; border-radius: 8px;">
                <div
                  style="width: 32px; height: 32px; border-radius: 50%; background: {{ $bgColor }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                  <i class="fa-solid {{ $icon }}"
                    style="color: {{ $badgeColor }}; font-size: 13px;"></i>
                </div>

                <div style="flex: 1; min-width: 0;">
                  <strong
                    style="font-size: 13px; color: #1a1a1a; display: block; margin-bottom: 2px;">{{ $ann->title }}</strong>
                  <small
                    style="color: #666; font-size: 12px; display: block; line-height: 1.4; margin-bottom: 4px;">{{ $ann->message }}</small>

                  <!-- Fixed static date rendering -->
                  <small
                    style="color: #aaa; font-size: 10px; display: inline-flex; align-items: center; gap: 4px;">
                    <i class="fa-regular fa-clock"
                      style="font-size: 9px;"></i>
                    {{ $ann->created_at->format('M j, Y h:i A') }}
                  </small>
                </div>
              </li>
            @empty
              <li
                style="text-align: center; color: #aaa; padding: 20px 0; font-size: 13px;">
                <i class="fa-solid fa-bell-slash"
                  style="font-size: 20px; display: block; margin-bottom: 6px; color: #ccc;"></i>
                No recent updates or announcements.
              </li>
            @endforelse
          </ul>

          <!-- Collapsible Extra Announcements (Items past index 3) -->
          @if ($announcements->count() > 3)
            <div id="extra-updates" style="display: none; margin-top: 12px;">
              <ul
                style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                @foreach ($announcements->slice(3) as $ann)
                  @php
                    $icon = match ($ann->type) {
                        'urgent' => 'fa-circle-exclamation',
                        'notice' => 'fa-bullhorn',
                        default => 'fa-bell',
                    };
                    $badgeColor = match ($ann->type) {
                        'urgent' => '#A32D2D',
                        'notice' => '#854F0B',
                        default => '#025628',
                    };
                    $bgColor = match ($ann->type) {
                        'urgent' => '#FCEBEB',
                        'notice' => '#FFF8E1',
                        default => '#E8F5E9',
                    };
                  @endphp
                  <li
                    style="display: flex; align-items: flex-start; gap: 12px; padding: 10px 12px; background: #fff; border: 1px solid #f0f0f0; border-radius: 8px;">
                    <div
                      style="width: 32px; height: 32px; border-radius: 50%; background: {{ $bgColor }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                      <i class="fa-solid {{ $icon }}"
                        style="color: {{ $badgeColor }}; font-size: 13px;"></i>
                    </div>

                    <div style="flex: 1; min-width: 0;">
                      <strong
                        style="font-size: 13px; color: #1a1a1a; display: block; margin-bottom: 2px;">{{ $ann->title }}</strong>
                      <small
                        style="color: #666; font-size: 12px; display: block; line-height: 1.4; margin-bottom: 4px;">{{ $ann->message }}</small>
                      <small
                        style="color: #aaa; font-size: 10px;">{{ $ann->created_at->diffForHumans() }}</small>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>

            <div style="text-align: center; margin-top: 15px;">
              <button class="view-more-btn" id="viewMoreBtn"
                onclick="toggleUpdates()">
                View More <i class="fa-solid fa-chevron-down"></i>
              </button>
            </div>
          @endif

          <div class="sidebar-calendar" style="margin-top: 20px;">
            <div id="calendar"></div>
          </div>
        </div>
      </div>

      <!-- 2. ANALYTICS VIEW -->
      <div id="view-analytics" style="display: none;">
        <div class="analytics-header-row">
          <h3><i class="fa-solid fa-chart-line"></i> Detailed System Analytics
          </h3>
          <button class="btn-cancel"
            onclick="showView('overview'); setActive(document.getElementById('nav-overview'));">Back
            to Overview</button>
        </div>
        <div class="analytics-grid">
          <div class="card chart-card-full">
            <div class="card-header">
              <h4><i class="fa-solid fa-user-graduate"></i> Trainee Enrollment
                (Monthly Volume)</h4>
            </div>
            <div class="full-chart-container">
              <canvas id="traineeHistoryChart"></canvas>
            </div>
          </div>
          <div class="card chart-card-full">
            <div class="card-header">
              <h4><i class="fa-solid fa-book"></i> Course Growth (Yearly Trend)
              </h4>
            </div>
            <div class="full-chart-container">
              <canvas id="courseHistoryChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. TRAINEE MANAGEMENT VIEW -->
      <div id="view-trainee-list" style="display: none;">
        <!-- View A: Course Cards Grid -->
        <div id="course-cards-main-view">
          <div
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3
              style="margin: 0; font-size: 16px; color: #025628; font-weight: 700;">
              Courses & Enrolled Trainees</h3>
          </div>

          <div
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 16px;">
            @forelse($courses as $course)
              @php
                $enrolledTrainees = Illuminate\Support\Facades\DB::table(
                    'enrollment_tbls',
                )
                    ->join(
                        'user_tbls',
                        'user_tbls.id',
                        '=',
                        'enrollment_tbls.user_id',
                    )
                    ->where('enrollment_tbls.course_id', $course->id)
                    ->select(
                        'enrollment_tbls.*',
                        'user_tbls.firstname',
                        'user_tbls.lastname',
                        'user_tbls.email',
                    )
                    ->get();

                $enrolledCount = $enrolledTrainees->count();
                $remainingSlots = max(0, $course->slots - $enrolledCount);
              @endphp
              <div class="card"
                style="background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); display: flex; flex-direction: column; gap: 12px;">
                <div
                  style="display: flex; justify-content: space-between; align-items: flex-start;">
                  <div>
                    <h4
                      style="margin: 0 0 4px 0; color: #025628; font-size: 15px; font-weight: 700;">
                      <i class="fa-solid fa-book"
                        style="margin-right: 6px;"></i>
                      {{ $course->title }}
                    </h4>
                    <p
                      style="margin: 4px 0; font-size: 13px; color: #4b5563; display: flex; align-items: center; gap: 6px;">
                      <i class="fa-solid fa-calendar-day"
                        style="color: #025628;"></i>
                      <span><strong>Duration:</strong> {{ $course->duration }}
                        {{ \Illuminate\Support\Str::plural('Day', $course->duration) }}</span>
                    </p>
                  </div>
                  <span
                    style="font-size: 11px; background: #e8f5e9; color: #025628; padding: 4px 10px; border-radius: 20px; font-weight: 700; white-space: nowrap;">
                    {{ $enrolledCount }} / {{ $course->slots }} Enrolled
                  </span>
                </div>

                <hr
                  style="border: none; border-top: 1px solid #f0f0f0; margin: 4px 0;">

                <button class="btn-all"
                  onclick="openFullCourseRoster('{{ addslashes($course->title) }}', {{ $enrolledTrainees->toJson() }})">
                  <i class="fa-solid fa-users"></i> View Trainees
                </button>
              </div>
            @empty
              <div
                style="grid-column: 1 / -1; text-align: center; color: #aaa; padding: 30px; font-size: 13px;">
                No courses found.
              </div>
            @endforelse
          </div>
        </div>

        <!-- View B: Full Page Roster View -->
        <div id="full-course-roster-view"
          style="display: none; background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 12px; padding: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
          <div
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px;">
            <div>
              <button onclick="backToCourseCards()"
                style="background: #f0f0f0; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 700; color: #444; margin-bottom: 8px;">
                <i class="fa-solid fa-arrow-left"></i> Back to Courses
              </button>
              <h3 id="rosterCourseTitle"
                style="margin: 0; font-size: 18px; color: #025628; font-weight: 700;">
                Course Roster</h3>
            </div>
            <span id="rosterCountBadge"
              style="font-size: 12px; background: #e8f5e9; color: #025628; padding: 6px 14px; border-radius: 20px; font-weight: 700;">
              0 Enrolled
            </span>
          </div>

          <div id="fullRosterContainer"
            style="display: flex; flex-direction: column; gap: 8px; max-height: 500px; overflow-y: auto;">
            <!-- Populated via JavaScript -->
          </div>
        </div>
      </div>

      <!-- 4. TRAINER LIST VIEW -->
      <div id="view-trainer-list" style="display: none;">
        <div
          style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 14px;">
          <button class="btn-save-main" onclick="openAddTrainerModal()"
            style="width: auto; padding: 8px 16px; font-size: 12px; display: flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-user-plus"></i> Add Trainer
          </button>
        </div>

        <div class="card list-card">
          <div class="card-header">
            <h3
              style="margin: 0; font-size: 15px; font-weight: 700; color: #025628;">
              <i class="fa-solid fa-chalkboard-user"
                style="margin-right: 6px;"></i> Trainer Directory
            </h3>
          </div>

          <div class="user-list-body" id="trainer-list-content">
            @forelse($trainersList as $trainer)
              @php
                $assignedCourse = isset($courses)
                    ? $courses->firstWhere('trainer_id', $trainer->id)
                    : null;
                $courseTitle = $assignedCourse
                    ? $assignedCourse->title
                    : 'No course assigned';
              @endphp
              <div class="user-item">
                <div
                  style="display: flex; align-items: center; gap: 12px; flex: 1;">
                  <div
                    style="width: 36px; height: 36px; border-radius: 50%; background: #e8f5e9; display: flex; align-items: center; justify-content: center; color: #025628; flex-shrink: 0;">
                    <i class="fa-solid fa-user-tie"
                      style="font-size: 14px;"></i>
                  </div>
                  <div class="user-info" style="min-width: 0;">
                    <strong
                      style="font-size: 13px; color: #1a1a1a; display: block;">{{ strtoupper($trainer->firstname . ' ' . $trainer->lastname) }}</strong>
                    <small
                      style="color: #666; font-size: 12px;">{{ $trainer->email }}</small>
                  </div>
                </div>

                <button class="btn-view"
                  onclick="openUserModal(
                                    '{{ addslashes($trainer->firstname . ' ' . $trainer->lastname) }}',
                                    '{{ addslashes($trainer->email) }}',
                                    'trainer',
                                    'Active',
                                    '{{ addslashes($courseTitle) }}'
                                )">View
                  Profile</button>
              </div>
            @empty
              <div
                style="text-align: center; color: #aaa; padding: 30px; font-size: 13px;">
                <i class="fa-solid fa-user-slash"
                  style="font-size: 24px; display: block; margin-bottom: 8px; color: #ccc;"></i>
                No trainers registered yet.
              </div>
            @endforelse
          </div>
        </div>
      </div>

      <!-- 5. REGISTRATIONS VIEW -->
      <div id="view-registrations" style="display: none;">
        <div class="card list-card">
          <div class="card-header"
            style="display:flex; justify-content:space-between; align-items:center;">
            <h3>Submitted Registrations</h3>
            <a href="{{ route('admin.registrations.export') }}"
              class="btn-save-main"
              style="width:auto; padding:8px 16px; text-decoration:none;">
              <i class="fa-solid fa-file-excel"></i> Export to Excel
            </a>
          </div>
          <div class="user-list-body" id="registrations-list-content">
            @forelse($registrations as $reg)
              <div class="user-item">
                <i class="fa-solid fa-id-card profile-icon"></i>
                <div class="user-info">
                  <strong>{{ $reg->last_name }}, {{ $reg->first_name }}
                    {{ $reg->middle_name }}</strong><br>
                  <small>
                    ULI: {{ $reg->uli_number ?? '—' }} &nbsp;·&nbsp;
                    Course: {{ $reg->course_name }} &nbsp;·&nbsp;
                    {{ $reg->created_at->format('M j, Y g:i A') }}
                  </small>
                </div>
                <a href="{{ route('admin.registrations.show', $reg->id) }}"
                  target="_blank" class="btn-view">View</a>
                <a href="{{ route('admin.registrations.pdf', $reg->id) }}"
                  class="btn-view">
                  <i class="fa-solid fa-file-pdf"></i> PDF
                </a>
              </div>
            @empty
              <div
                style="text-align:center; color:#aaa; padding:20px; font-size:13px;">
                <i class="fa-solid fa-clipboard-list"></i> No registrations
                found.
              </div>
            @endforelse
          </div>
          <div class="pagination-container">
            @if ($registrations->onFirstPage())
              <button class="page-btn" disabled><i
                  class="fa-solid fa-chevron-left"></i></button>
            @else
              <a href="{{ $registrations->previousPageUrl() }}"
                class="page-btn">
                <i class="fa-solid fa-chevron-left"></i>
              </a>
            @endif
            <div class="page-numbers">
              @for ($i = 1; $i <= $registrations->lastPage(); $i++)
                @if ($i == $registrations->currentPage())
                  <button class="page-btn active">{{ $i }}</button>
                @else
                  <a href="{{ $registrations->url($i) }}"
                    class="page-btn">{{ $i }}</a>
                @endif
              @endfor
            </div>
            @if ($registrations->hasMorePages())
              <a href="{{ $registrations->nextPageUrl() }}" class="page-btn">
                <i class="fa-solid fa-chevron-right"></i>
              </a>
            @else
              <button class="page-btn" disabled><i
                  class="fa-solid fa-chevron-right"></i></button>
            @endif
          </div>
        </div>
      </div>

      <!-- 6. FACILITIES VIEW -->
      <div id="view-facilities" style="display: none;">

        <!-- Top Control Bar (Search & Action Button) -->
        <div
          style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 20px; gap: 12px; flex-wrap: wrap;">
          <div class="input-wrapper"
            style="width: 320px; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 6px 12px; display: flex; align-items: center;">
            <i class="fa-solid fa-magnifying-glass"
              style="color: #888; margin-right: 8px;"></i>
            <input type="text" id="searchFacilityInput"
              placeholder="Search facility name or location..."
              onkeyup="filterFacilities()"
              style="border: none; outline: none; width: 100%; font-size: 13px;">
          </div>

          <button class="btn-save-main" onclick="openAddFacilityModal()"
            style="width: auto; padding: 9px 18px; font-size: 13px; white-space: nowrap;">
            <i class="fa-solid fa-plus"></i> Add New Facility
          </button>
        </div>

        <!-- Facility Grid -->
        <div class="facility-grid" id="facilityGrid"
          style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 16px;">

          @forelse ($facilities as $facility)
            <div class="card facility-card"
              data-name="{{ strtolower($facility->name) }}"
              data-location="{{ strtolower($facility->address) }}"
              style="display: flex; flex-direction: column; justify-content: space-between; border: 1px solid rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; background: #fff;">
              <div>
                <!-- Header & Status Badge -->
                <div
                  style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                  <div style="display: flex; gap: 12px; align-items: center;">
                    <div
                      style="width: 42px; height: 42px; border-radius: 10px; background: #e8f5e9; display: flex; align-items: center; justify-content: center; color: #025628; font-size: 18px; flex-shrink: 0;">
                      <i class="fa-solid fa-building-circle-check"></i>
                    </div>
                    <div>
                      <strong
                        style="font-size: 15px; color: #1a1a1a; display: block;">{{ $facility->name }}</strong>
                      <small style="color: #666; font-size: 12px;">
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $facility->address }}
                      </small>
                    </div>
                  </div>
                  <span class="course-badge active"
                    style="font-size: 10px; padding: 2px 8px; border-radius: 12px;">Active</span>
                </div>

                <hr
                  style="border: none; border-top: 1px solid #f0f0f0; margin: 12px 0;">

                <!-- Dynamic Multi-Course Badges -->
                <div style="margin-bottom: 16px;">
                  <div
                    style="font-size: 12px; color: #555; margin-bottom: 6px;">
                    <i class="fa-solid fa-book-open"
                      style="color: #854F0B;"></i>
                    <strong>Assigned Courses
                      ({{ $facility->courses->count() }})
                      :</strong>
                  </div>

                  @if ($facility->courses->isNotEmpty())
                    <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                      @foreach ($facility->courses as $course)
                        <span
                          style="font-size: 11px; font-weight: 600; background: #e8f5e9; color: #025628; padding: 3px 10px; border-radius: 12px; border: 1px solid #c8e6c9;">
                          {{ $course->title }}
                        </span>
                      @endforeach
                    </div>
                  @else
                    <span
                      style="font-size: 11px; color: #9ca3af; font-style: italic;">No
                      courses assigned</span>
                  @endif
                </div>
              </div>

              <!-- Button with proper parameter alignment -->
              <button class="btn-all"
                onclick="openFacilityModal(
          {{ $facility->id }}, 
          '{{ addslashes($facility->name) }}', 
          '{{ addslashes($facility->address) }}', 
          {{ json_encode($facility->courses->pluck('id')) }}
        )"
                style="width: 100%;">
                <i class="fa-solid fa-pen-to-square"></i> Manage Facility
              </button>
            </div>
          @empty
            <div
              style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888;">
              <i class="fa-solid fa-building-circle-xmark"
                style="font-size: 32px; margin-bottom: 10px; display: block;"></i>
              No facilities found. Click "Add New Facility" to create one.
            </div>
          @endforelse

        </div>

        <!-- Pagination -->
        <div class="pagination-container" style="margin-top: 20px;">
          <button class="page-btn prev" disabled><i
              class="fa-solid fa-chevron-left"></i></button>
          <div class="page-numbers">
            <button class="page-btn active">1</button>
          </div>
          <button class="page-btn next" disabled><i
              class="fa-solid fa-chevron-right"></i></button>
        </div>

      </div>

      <!-- 7. COURSES VIEW -->
      <div id="view-courses" style="display: none;">
        <!-- Top Control Bar (Search Bar & Add Button Aligned Right) -->
        <div
          style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 20px; gap: 12px; flex-wrap: wrap;">
          <div class="input-wrapper"
            style="width: 320px; background: #fff; border: 1px solid #d1d5db; border-radius: 8px; padding: 7px 12px; display: flex; align-items: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <i class="fa-solid fa-magnifying-glass"
              style="color: #9ca3af; margin-right: 8px; font-size: 13px;"></i>
            <input type="text" id="searchCourseInput"
              placeholder="Search course title or code..."
              onkeyup="filterCourses()"
              style="border: none; outline: none; width: 100%; font-size: 13px; color: #1f2937;">
          </div>

          <button class="btn-save-main" onclick="openAddCourseModal()"
            style="width: auto; padding: 9px 18px; font-size: 13px; white-space: nowrap; border-radius: 8px; cursor: pointer; font-weight: 600;">
            <i class="fa-solid fa-plus"></i> Add New Course
          </button>
        </div>

        <!-- Courses Grid -->
        <div class="courses-grid" id="coursesGrid">
          <!-- Live Search No Results Message -->
          <div id="noFilterResults"
            style="grid-column: 1 / -1; text-align: center; color: #9ca3af; padding: 50px 0; font-size: 13px; display: none;">
            <i class="fa-solid fa-magnifying-glass"
              style="font-size: 32px; display: block; margin-bottom: 10px; color: #d1d5db;"></i>
            No courses found.
          </div>

          @forelse($courses as $course)
            @php
              // 1. Trainer Information
              $trainerName = $course->trainer
                  ? trim(
                      $course->trainer->firstname .
                          ' ' .
                          $course->trainer->lastname,
                  )
                  : null;

              // 2. Facility Information
              $facilityName = $course->facility
                  ? $course->facility->name
                  : null;

              // 3. Enrollment Count & Calculations
              $enrolledCount =
                  $course->enrolled_count ?? ($course->enrollments_count ?? 0);
              $remainingSlots = max(0, $course->slots - $enrolledCount);

              // 4. Module & Quiz Counts
              $moduleCount =
                  $course->modules_count ??
                  Illuminate\Support\Facades\DB::table('modules')
                      ->where('course_id', $course->id)
                      ->count();
              $quizCount =
                  $course->quizzes_count ??
                  Illuminate\Support\Facades\DB::table('quizzes')
                      ->where('course_id', $course->id)
                      ->count();

              // 5. Dynamic Progress Bar Percentage & Color
              $percent =
                  $course->slots > 0
                      ? min(100, round(($enrolledCount / $course->slots) * 100))
                      : 0;
              $barColor =
                  $percent >= 100
                      ? '#dc2626'
                      : ($percent >= 80
                          ? '#d97706'
                          : '#025628');
            @endphp

            <div class="card course-card"
              style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px; padding: 18px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 2px 8px rgba(0,0,0,0.03); text-align: left;"
              data-title="{{ strtolower($course->title) }}"
              data-code="{{ strtolower($course->course_code) }}">

              <div>
                <!-- Top Bar: Course Code & Status Badge -->
                <div
                  style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                  <span
                    style="font-size: 11px; font-weight: 700; color: #4b5563; background: #f3f4f6; padding: 4px 9px; border-radius: 6px;">
                    <i class="fa-solid fa-barcode"
                      style="color: #6b7280; margin-right: 4px;"></i>
                    {{ $course->course_code ?? 'CRS-000' }}
                  </span>
                  <div
                    class="course-badge {{ strtolower($course->status) === 'active' ? 'active' : 'inactive' }}"
                    style="font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 12px;">
                    {{ ucfirst($course->status) }}
                  </div>
                </div>

                <!-- Title & Icon Side-by-Side Header -->
                <div
                  style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; text-align: left;">
                  <div
                    style="background: #e8f5e9; color: #025628; border-radius: 10px; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa-solid fa-book" style="font-size: 18px;"></i>
                  </div>
                  <div style="flex-grow: 1; text-align: left;">
                    <h4
                      style="margin: 0 0 4px 0; font-size: 15px; font-weight: 700; color: #111827; line-height: 1.35; text-align: left;">
                      {{ $course->title }}
                    </h4>
                    <span
                      style="font-size: 12px; color: #6b7280; font-weight: 500; display: inline-flex; align-items: center; gap: 5px; text-align: left;">
                      <i class="fa-regular fa-clock"
                        style="color: #9ca3af;"></i>
                      {{ $course->duration }}
                      Days Duration
                    </span>
                  </div>
                </div>

                <!-- Grouped Metadata Card (Trainer & Facility) -->
                <div
                  style="background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 10px; padding: 10px 12px; margin-bottom: 12px; display: flex; flex-direction: column; gap: 6px; font-size: 12px; text-align: left;">
                  <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-chalkboard-user"
                      style="color: #025628; width: 14px; text-align: center;"></i>
                    <span
                      style="color: #6b7280; font-weight: 500;">Trainer:</span>
                    <strong
                      style="color: {{ $trainerName ? '#111827' : '#9ca3af' }}; font-weight: 600;">
                      {{ $trainerName ?? 'No trainer assigned' }}
                    </strong>
                  </div>

                  <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-building"
                      style="color: #025628; width: 14px; text-align: center;"></i>
                    <span
                      style="color: #6b7280; font-weight: 500;">Facility:</span>
                    <strong
                      style="color: {{ $facilityName ? '#111827' : '#9ca3af' }}; font-weight: 600;">
                      {{ $facilityName ?? 'No facility assigned' }}
                    </strong>
                  </div>
                </div>

                <!-- Modules & Quizzes Counter Badges -->
                <div
                  style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                  <span
                    style="background: #f3f4f6; color: #374151; font-size: 11px; font-weight: 600; padding: 4px 9px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-cubes" style="color: #025628;"></i>
                    <span
                      id="course-module-count-{{ $course->id }}">{{ $moduleCount }}</span>
                    <span
                      id="course-module-label-{{ $course->id }}">{{ Illuminate\Support\Str::plural('Module', $moduleCount) }}</span>
                  </span>

                  <span
                    style="background: #fef3c7; color: #92400e; font-size: 11px; font-weight: 600; padding: 4px 9px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-clipboard-question"
                      style="color: #b45309;"></i>
                    <span
                      id="course-quiz-count-{{ $course->id }}">{{ $quizCount }}</span>
                    <span
                      id="course-quiz-label-{{ $course->id }}">{{ Illuminate\Support\Str::plural('Quiz', $quizCount) }}</span>
                  </span>
                </div>
              </div>

              <div>
                <!-- Capacity Progress Bar -->
                <div style="margin-bottom: 14px; text-align: left;">
                  <div
                    style="display: flex; justify-content: space-between; align-items: center; font-size: 11px; font-weight: 600; color: #4b5563; margin-bottom: 6px;">
                    <span>Enrolled Capacity</span>
                    <span
                      style="color: {{ $barColor }}; font-weight: 700;">{{ $enrolledCount }}
                      / {{ $course->slots }} Enrolled</span>
                  </div>
                  <div class="progress-container"
                    style="background: #e5e7eb; height: 6px; border-radius: 10px; overflow: hidden;">
                    <div class="progress-bar"
                      style="width: {{ $percent }}%; background: {{ $barColor }}; height: 100%; border-radius: 10px; transition: width 0.3s ease;">
                    </div>
                  </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 8px;">
                  <button class="btn-all"
                    style="flex: 1; border: 1px solid #d1d5db; background: #ffffff; color: #374151; font-weight: 600; padding: 8px; border-radius: 8px; font-size: 12px; cursor: pointer;"
                    onclick="openCourseModal(
                {{ $course->id }},
                '{{ addslashes($course->course_code) }}',
                '{{ addslashes($course->title) }}',
                '{{ addslashes($course->duration) }}',
                {{ $course->slots }},
                {{ $course->trainer_id ?? 'null' }},
                '{{ addslashes($trainerName ?? '') }}',
                '{{ $course->status }}'
              )">
                    Course Details
                  </button>

                  <button class="btn-all"
                    style="flex: 1; border: none; background: #025628; color: #ffffff; font-weight: 600; padding: 8px; border-radius: 8px; font-size: 12px; cursor: pointer;"
                    onclick="openContentModal({{ $course->id }}, '{{ addslashes($course->title) }}')">
                    <i class="fa-solid fa-layer-group"></i> Modules
                  </button>
                </div>
              </div>

            </div>
          @empty
            <div
              style="grid-column: 1 / -1; text-align: center; color: #9ca3af; padding: 50px 0; font-size: 13px;">
              <i class="fa-solid fa-book-open"
                style="font-size: 32px; display: block; margin-bottom: 10px; color: #d1d5db;"></i>
              No courses found.
            </div>
          @endforelse
        </div>

        <!-- Pagination -->
        @if (
            $courses instanceof \Illuminate\Pagination\LengthAwarePaginator &&
                $courses->hasPages())
          <div class="pagination-container"
            style="margin-top: 24px; display: flex; justify-content: center; align-items: center; gap: 6px;">
            @if ($courses->onFirstPage())
              <button class="page-btn" disabled
                style="opacity: 0.5; cursor: not-allowed;"><i
                  class="fa-solid fa-chevron-left"></i></button>
            @else
              <a href="{{ $courses->previousPageUrl() }}&view=courses"
                onclick="setActive(document.getElementById('nav-courses'))"
                class="page-btn">
                <i class="fa-solid fa-chevron-left"></i>
              </a>
            @endif

            <div class="page-numbers" style="display: flex; gap: 4px;">
              @for ($i = 1; $i <= $courses->lastPage(); $i++)
                @if ($i == $courses->currentPage())
                  <button class="page-btn active">{{ $i }}</button>
                @else
                  <a href="{{ $courses->url($i) }}&view=courses"
                    onclick="setActive(document.getElementById('nav-courses'))"
                    class="page-btn">{{ $i }}</a>
                @endif
              @endfor
            </div>

            @if ($courses->hasMorePages())
              <a href="{{ $courses->nextPageUrl() }}&view=courses"
                onclick="setActive(document.getElementById('nav-courses'))"
                class="page-btn">
                <i class="fa-solid fa-chevron-right"></i>
              </a>
            @else
              <button class="page-btn" disabled
                style="opacity: 0.5; cursor: not-allowed;"><i
                  class="fa-solid fa-chevron-right"></i></button>
            @endif
          </div>
        @endif
      </div>

      <!-- 8. ANNOUNCEMENTS VIEW -->
      <div id="view-announcements" style="display: none;">
        <!-- Header Bar -->
        <div class="view-header"
          style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
          <div>
            <span style="font-size: 13px; color: #666;">Manage system updates,
              reminders, and public notices.</span>
          </div>

          <button class="btn-save-main" onclick="openAnnouncementModal()"
            style="width: auto; padding: 8px 16px; font-weight: 600;">
            <i class="fa-solid fa-plus"></i> Add Announcement
          </button>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="filter-toolbar"
          style="display: flex; align-items: center; justify-content: space-between; gap: 12px; background: #fff; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 16px;">
          <!-- Search Input -->
          <div style="position: relative; flex: 1; max-width: 320px;">
            <i class="fa-solid fa-magnifying-glass"
              style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px;"></i>
            <input type="text" id="annSearchInput"
              placeholder="Search announcements..."
              onkeyup="filterAnnouncements()"
              style="width: 100%; padding: 8px 12px 8px 36px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; color: #1e293b; outline: none; background: #f8fafc;">
          </div>

          <!-- Dropdown Filters -->
          <div style="display: flex; align-items: center; gap: 12px;">
            <div style="display: flex; align-items: center; gap: 6px;">
              <label for="annTypeFilter"
                style="font-size: 12px; font-weight: 600; color: #64748b;">Type:</label>
              <select id="annTypeFilter" onchange="filterAnnouncements()"
                style="padding: 7px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 12px; color: #1e293b; background: #fff; cursor: pointer; outline: none;">
                <option value="">All Types</option>
                <option value="urgent">Urgent</option>
                <option value="notice">Notice</option>
                <option value="reminder">Reminder</option>
              </select>
            </div>

            <div style="display: flex; align-items: center; gap: 6px;">
              <label for="annStatusFilter"
                style="font-size: 12px; font-weight: 600; color: #64748b;">Status:</label>
              <select id="annStatusFilter" onchange="filterAnnouncements()"
                style="padding: 7px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 12px; color: #1e293b; background: #fff; cursor: pointer; outline: none;">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="draft">Draft</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Announcement List Card -->
        <div class="card list-card"
          style="display: flex; flex-direction: column; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
          @forelse($announcements as $ann)
            @php
              $typeConfig = match ($ann->type) {
                  'urgent' => [
                      'badge' => '#A32D2D',
                      'bg' => '#FCEBEB',
                      'icon' => 'fa-triangle-exclamation',
                  ],
                  'notice' => [
                      'badge' => '#854F0B',
                      'bg' => '#FFF8E1',
                      'icon' => 'fa-circle-info',
                  ],
                  default => [
                      'badge' => '#025628',
                      'bg' => '#E8F5E9',
                      'icon' => 'fa-bell',
                  ],
              };
            @endphp

            <div class="user-item" data-type="{{ strtolower($ann->type) }}"
              data-status="{{ $ann->is_active ? 'active' : 'draft' }}"
              style="display: flex; align-items: flex-start; gap: 14px; padding: 16px; border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;">

              <!-- Icon -->
              <div
                style="width: 38px; height: 38px; border-radius: 50%; background: {{ $typeConfig['bg'] }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-solid {{ $typeConfig['icon'] }}"
                  style="color: {{ $typeConfig['badge'] }}; font-size: 14px;"></i>
              </div>

              <!-- Content Body -->
              <div class="user-info" style="flex: 1; min-width: 0;">
                <div
                  style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 4px;">
                  <strong class="ann-title-text"
                    style="font-size: 14px; font-weight: 600; color: #0f172a;">{{ $ann->title }}</strong>

                  <span
                    style="padding: 2px 8px; border-radius: 12px; font-size: 10px; font-weight: 700; background: {{ $typeConfig['bg'] }}; color: {{ $typeConfig['badge'] }};">
                    {{ ucfirst($ann->type) }}
                  </span>

                  @if ($ann->is_active)
                    <span
                      style="font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 12px; background: #e6f4ea; color: #137333;">
                      Active
                    </span>
                  @else
                    <span
                      style="font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 12px; background: #f1f3f4; color: #5f6368;">
                      Draft
                    </span>
                  @endif
                </div>

                <p class="ann-msg-text"
                  style="margin: 0 0 10px 0; font-size: 13px; color: #475569; line-height: 1.5;">
                  {{ $ann->message }}
                </p>

                <!-- Timestamps Metadata Tags -->
                <div
                  style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; font-size: 11px; color: #64748b;">
                  <span title="Created At">
                    <i class="fa-regular fa-clock"
                      style="color: #94a3b8;"></i>
                    <strong>Created:</strong>
                    {{ $ann->created_at->format('M j, Y h:i A') }}
                  </span>

                  <span title="Publish Date">
                    <i class="fa-solid fa-calendar-check"
                      style="color: {{ $ann->publish_at ? '#025628' : '#94a3b8' }};"></i>
                    <strong>Publishes:</strong>
                    {{ $ann->publish_at ? $ann->publish_at->format('M j, Y h:i A') : 'Immediately' }}
                  </span>

                  <span title="Expiration Date">
                    <i class="fa-solid fa-calendar-xmark"
                      style="color: {{ $ann->expires_at ? '#A32D2D' : '#94a3b8' }};"></i>
                    <strong>Expires:</strong>
                    {{ $ann->expires_at ? $ann->expires_at->format('M j, Y h:i A') : 'Never' }}
                  </span>
                </div>
              </div>

              <!-- Action Buttons -->
              <div
                style="display: flex; gap: 8px; flex-shrink: 0; align-self: center;">
                <button class="btn-view" data-id="{{ $ann->id }}"
                  data-title="{{ $ann->title }}"
                  data-message="{{ $ann->message }}"
                  data-type="{{ $ann->type }}"
                  data-active="{{ $ann->is_active ? '1' : '0' }}"
                  data-publish-at="{{ $ann->publish_at ? $ann->publish_at->format('Y-m-d H:i:s') : '' }}"
                  data-expires-at="{{ $ann->expires_at ? $ann->expires_at->format('Y-m-d H:i:s') : '' }}"
                  onclick="handleEditAnnouncement(this)"
                  style="padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; border: 1px solid #025628; background: #025628; color: #fff;">
                  Edit
                </button>

                <button
                  onclick="deleteAnnouncement({{ $ann->id }}, this)"
                  style="padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; border: 1px solid #fecdd3; background: #fff1f2; color: #9f1239;">
                  Delete
                </button>
              </div>
            </div>
          @empty
            <div
              style="text-align: center; color: #64748b; padding: 48px 20px; font-size: 13px;">
              <i class="fa-solid fa-bell-slash"
                style="font-size: 28px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
              <strong>No announcements found.</strong>
              <p style="margin: 4px 0 0 0; color: #94a3b8; font-size: 12px;">
                Try adjusting your filters or click "+ Add Announcement" to
                create one.</p>
            </div>
          @endforelse
        </div>

        @if ($announcements->total() > 0)
          <div class="pagination-container"
            style="margin-top: 20px; display: flex; justify-content: center; gap: 4px;">
            @if ($announcements->onFirstPage())
              <button class="page-btn" disabled><i
                  class="fa-solid fa-chevron-left"></i></button>
            @else
              <a href="{{ $announcements->previousPageUrl() }}&view=announcements"
                class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
            @endif

            <div class="page-numbers" style="display: flex; gap: 4px;">
              @for ($i = 1; $i <= $announcements->lastPage(); $i++)
                @if ($i == $announcements->currentPage())
                  <button
                    class="page-btn active">{{ $i }}</button>
                @else
                  <a href="{{ $announcements->url($i) }}&view=announcements"
                    class="page-btn">{{ $i }}</a>
                @endif
              @endfor
            </div>

            @if ($announcements->hasMorePages())
              <a href="{{ $announcements->nextPageUrl() }}&view=announcements"
                class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
            @else
              <button class="page-btn" disabled><i
                  class="fa-solid fa-chevron-right"></i></button>
            @endif
          </div>
        @endif
      </div>

      <!-- 9. SETTINGS VIEW -->
      <div id="view-settings" style="display: none;">
        <div class="card settings-card">
          <h3>General Settings</h3>
          <div class="settings-row">
            <div class="settings-info">
              <strong>Admin Email</strong>
              <p>The primary email for system recovery and alerts.</p>
            </div>
            <input type="email" value="ledipoadmin@gmail.com"
              class="settings-input">
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
            <button class="btn-all"
              style="width: auto; padding: 10px 20px;">Backup Now</button>
          </div>
        </div>
      </div>

      <!-- 10. CERTIFICATE VIEW -->
      <div id="view-certificate" style="display: none;">
        <section class="stats-grid">
          <div class="stat-card">
            <h3>67</h3>
            <p>Certificates Issued</p>
          </div>
          <div class="stat-card">
            <h3>07</h3>
            <p>Pending Claim</p>
          </div>
          <div class="stat-card">
            <h3>67</h3>
            <p>Monthly Graduates</p>
          </div>
          <div class="stat-card urgent">
            <h3>67</h3>
            <p>Archive Size</p>
          </div>
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
              <input type="checkbox" id="toggleMultiple"> <span>Select
                Multiple</span>
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
                <th class="select-col hidden"><i
                    class="fas fa-check-square"></i>
                </th>
                <th>Fullname</th>
                <th>Course</th>
                <th>Date Issued</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="select-col hidden"><input type="checkbox"
                    class="row-checkbox"></td>
                <td>Nelmida, Rheyan</td>
                <td>Dressmaking</td>
                <td>April 3, 2026</td>
                <td>Claimed</td>
                <td class="action-icons">
                  <i class="fas fa-eye view-icon"
                    onclick="openCertModal('Nelmida, Rheyan', 'Dressmaking', 'D-LED-TES-2026-081')"></i>
                  <i class="fas fa-edit edit-icon"></i>
                  <i class="fas fa-trash-alt delete-icon"
                    onclick="deleteCert(this)"></i>
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

  <!-- ========================================================== -->
  <!-- MODALS SECTION                                             -->
  <!-- ========================================================== -->

  <!-- Certificate View Modal -->
  <div id="certificateModal" class="modal-overlay">
    <div class="modal-box-fixed">
      <div class="modal-split">
        <div class="split-left-preview">
          <h3 class="modal-section-header">Certificate Preview</h3>
          <div class="ui-cert-frame" id="printableCert">
            <div class="ui-cert-inner">
              <div class="cert-logos-header">
                <img src="/images/logo.png" alt="Logo"
                  class="cert-logo-img">
                <img src="/images/tesda.png" alt="TESDA"
                  class="cert-logo-img">
                <img src="/images/logo_ledipo.png" alt="LEDIPO"
                  class="cert-logo-img">
              </div>
              <p class="cert-authority-text">
                TECHNICAL EDUCATION AND SKILLS DEVELOPMENT AUTHORITY<br>
                CITY GOVERNMENT OF DASMARIÑAS - LEDIPO
              </p>
              <h1 class="cert-title-primary">CERTIFICATE OF COMPLETION</h1>
              <p class="cert-certify-line">THIS CERTIFIES THAT</p>
              <h2 id="vName" class="cert-recipient-name">Nelmida, Rheyan
              </h2>
              <p class="cert-training-msg">HAS SUCCESSFULLY COMPLETED THE
                TRAINING IN</p>
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
              <li><i class="fas fa-check-circle"></i> Hon. Jennifer
                Austria-Barzaga</li>
              <li><i class="fas fa-check-circle"></i> Mr. Carlos H. Legaspi
              </li>
            </ul>
          </div>
          <div class="modal-actions-container">
            <button class="modal-action-btn btn-pdf"
              onclick="handleDownload('printableCert')">Download PDF</button>
            <button class="modal-action-btn btn-print"
              onclick="handlePrint()">Re-Print</button>
            <button class="modal-action-btn" onclick="closeCertModal()">Close
              View</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Trainee / Issue Certificate Modal -->
  <div id="addTraineeModal" class="modal-overlay">
    <div class="modal-box-fixed">
      <div class="modal-split">
        <div class="split-right-info border-right">
          <h2 class="modal-title">Issue New Certificate</h2>
          <form id="issueForm">
            <div class="ui-form-group">
              <label>1. Trainee Selection</label>
              <select class="ui-select" id="traineeSelect"
                onchange="updateLivePreview()">
                <option value="" disabled selected>Search Trainee...
                </option>
                <option data-course="Dressmaking">Nelmida, Rheyan (94%)
                </option>
                <option data-course="Nail Care">Bong, Marcos (88%)</option>
              </select>
            </div>
            <div class="ui-form-group">
              <label>2. Record Details</label>
              <input type="text" id="certIDInput" class="ui-select"
                placeholder="Control Number" oninput="updateLivePreview()">
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
                <img src="/images/logo.png" alt="Logo"
                  class="cert-logo-img">
                <img src="/images/tesda.png" alt="TESDA"
                  class="cert-logo-img">
                <img src="/images/logo_ledipo.png" alt="LEDIPO"
                  class="cert-logo-img">
              </div>
              <p class="cert-authority-text">
                TECHNICAL EDUCATION AND SKILLS DEVELOPMENT AUTHORITY<br>
                CITY GOVERNMENT OF DASMARIÑAS - LEDIPO
              </p>
              <h1 class="cert-title-primary" style="font-size: 18px;">
                CERTIFICATE OF COMPLETION</h1>
              <p class="cert-certify-line">THIS CERTIFIES THAT</p>
              <h2 id="pName" class="cert-recipient-name"
                style="font-size: 24px;">[NAME]</h2>
              <p class="cert-training-msg">HAS SUCCESSFULLY COMPLETED THE
                TRAINING IN</p>
              <h3 id="pCourse" class="cert-course-name"
                style="font-size: 16px;">[COURSE]</h3>
              <div class="cert-signatures">
                <div class="sig-item" style="width: 120px;">
                  <p class="sig-name" style="font-size: 8px;">HON. JENNIFER A.
                    BARZAGA</p>
                </div>
                <div class="sig-item" style="width: 120px;">
                  <p class="sig-name" style="font-size: 8px;">MR. CARLOS H.
                    LEGASPI</p>
                </div>
              </div>
              <div class="cert-serial-footer">
                <span id="pID" style="font-size: 7px;">CERT. NO.:
                  [ID]</span>
                <span style="font-size: 7px;">TRAINING ID:
                  NCIIDRM-26-032</span>
              </div>
            </div>
          </div>
          <div class="modal-actions-container margin-top-20">
            <button class="modal-action-btn btn-print full-width"
              onclick="alert('Saving...')">Save & Issue</button>
            <button class="modal-action-btn btn-pdf full-width"
              onclick="handleDownload('livePreviewCert')">Download PDF</button>
            <button class="modal-action-btn full-width"
              onclick="closeAddModal()">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Logout Modal Alternative Overlay -->
  <div id="logoutModalOverlay" class="modal-overlay" style="display:none;">
    <div class="modal-box">
      <p>Are you sure you want to log out?</p>
      <div class="modal-actions-centered">
        <a href="login.php" class="btn-modal-yes">Yes</a>
        <button type="button" class="btn-modal-cancel"
          onclick="hideLogoutModal()">Cancel</button>
      </div>
    </div>
  </div>

  <!-- Course Modal -->
  <div id="courseModal" class="modal">
    <div class="modal-content card">
      <div class="modal-header">
        <h3><i class="fa-solid fa-pen-to-square"></i> Manage Course</h3>
        <span class="close-modal" onclick="closeModal()">&times;</span>
      </div>

      <form id="courseForm" class="modal-body" method="POST"
        action="">
        @csrf
        <input type="hidden" id="editCourseId" name="id">
        <input type="hidden" id="editTrainerId" name="trainer_id">

        <!-- Row 1: Course Code & Course Status -->
        <div class="modal-row">
          <div class="input-field">
            <label for="editCourseCode">Course Code</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-barcode"></i>
              <input type="text" id="editCourseCode" name="course_code"
                placeholder="e.g. CRS-001" required>
            </div>
          </div>

          <div class="input-field">
            <label for="editStatus">Course Status</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-circle-check"></i>
              <select id="editStatus" name="status"
                class="modal-input-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Row 2: Course Name -->
        <div class="input-field">
          <label for="editCourseName">Course Name</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-bookmark"></i>
            <input type="text" id="editCourseName" name="course_name"
              placeholder="e.g. Computer Literacy" required>
          </div>
        </div>

        <!-- Row 3: Duration & Slots -->
        <div class="modal-row">
          <div class="input-field">
            <label for="editDuration">Duration</label>
            <div class="input-wrapper input-with-suffix">
              <i class="fa-solid fa-calendar-day"></i>
              <input type="number" id="editDuration" name="duration"
                min="1" max="365" placeholder="e.g. 5" required>
              <span class="input-suffix">Days</span>
            </div>
          </div>
          <div class="input-field">
            <label for="editSlots">Slots</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-user-graduate"></i>
              <input type="number" id="editSlots" name="slots"
                placeholder="e.g. 30" required>
            </div>
          </div>
        </div>

        <!-- Row 4: Assign Trainer Section -->
        <div class="assign-trainer-section">
          <div class="assign-trainer-label">
            <i class="fa-solid fa-chalkboard-user"></i> Assign Trainer
          </div>
          <div class="assign-trainer-row">
            <select id="trainerDropdown">
              <option value="">— Select a trainer —</option>
              @foreach ($trainers as $trainer)
                <option value="{{ $trainer->id }}">
                  {{ $trainer->firstname }} {{ $trainer->lastname }}
                </option>
              @endforeach
            </select>
            <button type="button" class="btn-assign"
              onclick="assignTrainer()">
              <i class="fa-solid fa-check"></i> Assign
            </button>
          </div>

          <div id="currentTrainerBox" style="display:none;"
            class="current-trainer-box">
            <div class="trainer-avatar-sm" id="trainerInitials">JD</div>
            <div class="trainer-details">
              <div class="trainer-fullname" id="trainerFullName"></div>
              <div class="trainer-sub">Currently assigned trainer</div>
            </div>
            <button type="button" class="btn-remove-trainer"
              onclick="removeTrainer()">
              <i class="fa-solid fa-xmark"></i> Remove
            </button>
          </div>

          <div id="noTrainerBox" class="no-trainer-box">
            <i class="fa-solid fa-circle-info"></i> No trainer assigned yet.
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-delete-text"
            onclick="confirmDelete()">
            <i class="fa-solid fa-trash"></i> Delete Course
          </button>
          <div class="action-buttons">
            <button type="button" class="btn-cancel"
              onclick="closeModal()">Cancel</button>
            <button type="submit" class="btn-save-main">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Announcement Modal -->
  <div id="announcementModal" class="modal" style="display: none;">
    <div class="modal-content card">
      <div class="modal-header">
        <h3 id="annModalTitle"><i class="fa-solid fa-bell"></i> Add
          Announcement</h3>
        <span class="close-modal"
          onclick="closeAnnouncementModal()">&times;</span>
      </div>

      <form id="announcementForm" class="modal-body">
        <input type="hidden" id="annId">

        <!-- Title Field -->
        <div class="form-group">
          <div class="label-row">
            <label for="annTitle">Title <span
                class="required">*</span></label>
            <span class="char-counter" id="titleCounter">0/100</span>
          </div>
          <div class="input-container">
            <i class="fa-solid fa-pen input-icon"></i>
            <input type="text" id="annTitle" maxlength="100"
              placeholder="e.g., System Maintenance Schedule" required>
          </div>
        </div>

        <!-- Message Field -->
        <div class="form-group">
          <div class="label-row">
            <label for="annMessage">Message <span
                class="required">*</span></label>
            <span class="char-counter" id="messageCounter">0/500</span>
          </div>
          <div class="input-container textarea-container">
            <i class="fa-solid fa-align-left input-icon textarea-icon"></i>
            <textarea id="annMessage" maxlength="500"
              placeholder="Enter detailed announcement message..." required></textarea>
          </div>
        </div>

        <!-- Row 1: Type & Status (Kill Switch) -->
        <div class="form-row">
          <div class="form-group flex-1">
            <label for="annType">Type <span class="required">*</span></label>
            <div class="input-container">
              <i class="fa-solid fa-tag input-icon"></i>
              <select id="annType" class="modal-input-select">
                <option value="reminder">Reminder</option>
                <option value="notice">Notice</option>
                <option value="urgent">Urgent</option>
              </select>
            </div>
          </div>

          <div class="form-group status-group">
            <label>Status Switch</label>
            <label class="checkbox-card">
              <input type="checkbox" id="annIsActive" checked>
              <span class="checkbox-text" id="statusLabel">Active</span>
            </label>
          </div>
        </div>

        <!-- Row 2: Schedule & Expiration Timestamps -->
        <div class="form-row">
          <div class="form-group flex-1">
            <div class="label-row">
              <label for="annPublishAt">Publish At <small
                  style="color:#888;">(Optional)</small></label>
            </div>
            <div class="input-container datetime-container">
              <input type="datetime-local" id="annPublishAt"
                class="datetime-input">
            </div>
          </div>

          <div class="form-group flex-1">
            <div class="label-row">
              <label for="annExpiresAt">Expires At <small
                  style="color:#888;">(Optional)</small></label>
            </div>
            <div class="input-container datetime-container">
              <input type="datetime-local" id="annExpiresAt"
                class="datetime-input">
            </div>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn-cancel"
            onclick="closeAnnouncementModal()">Cancel</button>
          <button type="submit" id="btnSubmitAnn"
            class="btn-save-main">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Add Trainer Modal -->
  <div id="addTrainerModal" class="modal">
    <style>
      #addTrainerModal .modal-content.card {
        max-height: 90vh !important;
        display: flex !important;
        flex-direction: column !important;
        margin: 3vh auto !important;
        overflow: hidden !important;
        max-width: 600px !important;
        width: 95% !important;
      }

      #addTrainerModal .modal-body {
        overflow-y: auto !important;
        max-height: calc(90vh - 120px);
        padding-right: 4px;
      }

      #addTrainerModal .input-wrapper input,
      #addTrainerModal .input-wrapper select,
      #addTrainerModal textarea {
        border: 1px solid #d1d5db !important;
        border-radius: 8px !important;
        background-color: #ffffff !important;
      }

      #addTrainerModal .input-field {
        margin-bottom: 12px !important;
      }
    </style>

    <div class="modal-content card">
      <div class="modal-header">
        <h3><i class="fa-solid fa-user-plus" style="margin-right: 6px;"></i>
          Register New Trainer</h3>
        <span class="close-modal"
          onclick="closeAddTrainerModal()">&times;</span>
      </div>
      <form id="addTrainerForm" class="modal-body">
        <div class="input-field">
          <label>Full Name</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-signature"></i>
            <input type="text" id="newTrainerName"
              placeholder="e.g. Juan Dela Cruz" required>
          </div>
        </div>

        <div class="modal-row">
          <div class="input-field">
            <label>Email Address</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-envelope"></i>
              <input type="email" id="newTrainerEmail"
                placeholder="trainer@example.com" required>
            </div>
          </div>
          <div class="input-field">
            <label>Contact Number (Optional)</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-phone"></i>
              <input type="text" id="newTrainerContact"
                placeholder="0912 345 6789">
            </div>
          </div>
        </div>

        <div class="modal-row">
          <div class="input-field">
            <label>Temporary Password</label>
            <div style="position: relative; width: 100%;">
              <i class="fa-solid fa-key"
                style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #6b7280; z-index: 3; pointer-events: none;"></i>
              <input type="password" id="newTrainerPass"
                placeholder="e.g. Welcome2026"
                style="width: 100%; height: 42px; padding-left: 38px; padding-right: 42px; border: 1px solid #d1d5db !important; border-radius: 8px !important; background-color: #ffffff !important; box-sizing: border-box; font-family: inherit; font-size: 13px;"
                required>
              <i class="fa-solid fa-eye" id="togglePasswordIcon"
                onclick="togglePassword()"
                style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #6b7280; z-index: 3;"></i>
            </div>
          </div>
          <div class="input-field">
            <label>Reference / ID Number</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-id-card"></i>
              <input type="text" id="newTrainerIdNum"
                placeholder="e.g. TR-2026-001">
            </div>
          </div>
        </div>

        <div class="input-field">
          <label>Assigned Course</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-book-open"></i>
            <select id="newTrainerCourse" class="modal-input-select">
              <option value="">— Select a course —</option>
              @foreach ($allCourses as $course)
                <option value="{{ $course->id }}">{{ $course->title }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="input-field" style="margin-top: 4px;">
          <label>Admin Remarks / Internal Notes</label>
          <textarea id="newTrainerRemarks"
            placeholder="Add confidential notes or operational remarks regarding this profile..."
            rows="2"
            style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:13px; font-family:inherit; resize:vertical;"></textarea>
        </div>

        <div class="modal-footer"
          style="margin-top: 16px; padding-bottom: 5px;">
          <button type="button" class="btn-cancel"
            onclick="closeAddTrainerModal(); return false;">Cancel</button>
          <button type="submit" class="btn-save-main">Create Account</button>
        </div>
      </form>
    </div>
  </div>

  <!-- User Profile Modal -->
  <div id="userModal" class="modal">
    <style>
      #userModal .modal-content.card {
        max-height: 90vh !important;
        display: flex !important;
        flex-direction: column !important;
        margin: 3vh auto !important;
        overflow: hidden !important;
      }

      #userModal .modal-body {
        overflow-y: auto !important;
        max-height: calc(90vh - 120px);
        padding-right: 4px;
      }

      #userModal .input-wrapper input,
      #userModal .input-wrapper select,
      #userModal textarea {
        border: 1px solid #d1d5db !important;
        border-radius: 8px !important;
        background-color: #ffffff !important;
      }

      #userModal .input-wrapper input[readonly] {
        background-color: #f9fafb !important;
        color: #4b5563;
      }

      #userModal .input-field {
        margin-bottom: 10px !important;
      }
    </style>

    <div class="modal-content card" style="max-width: 600px; width: 95%;">
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

        <div class="modal-row">
          <div class="input-field">
            <label>Email Address</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-envelope"></i>
              <input type="email" id="editUserEmail" readonly
                class="readonly-input">
            </div>
          </div>
          <div class="input-field">
            <label>Member Since</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-calendar-days"></i>
              <input type="text" id="editUserCreated" readonly
                class="readonly-input" style="background: #f9f9f9;">
            </div>
          </div>
        </div>

        <div id="trainerFieldsContainer" style="display: none;">
          <div class="modal-row">
            <div class="input-field">
              <label>Contact Number</label>
              <div class="input-wrapper">
                <i class="fa-solid fa-phone"></i>
                <input type="text" id="editUserContact"
                  placeholder="Not provided">
              </div>
            </div>
            <div class="input-field">
              <label>Reference / ID Number</label>
              <div class="input-wrapper">
                <i class="fa-solid fa-id-card"></i>
                <input type="text" id="editUserIdNum"
                  placeholder="N/A">
              </div>
            </div>
          </div>
        </div>

        <div class="input-field" id="trainerCourseField"
          style="display: none;">
          <label>Assigned Course (Teaching)</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-book-open"></i>
            <input type="text" id="editTrainerCourse" readonly
              class="readonly-input" style="background: #f9f9f9;">
          </div>
        </div>

        <div class="modal-row">
          <div class="input-field">
            <label>Account Role</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-user-tag"></i>
              <select id="editUserRole" class="modal-input-select" disabled
                style="background: #f5f5f5; cursor: not-allowed;">
                <option value="student">Trainee</option>
                <option value="trainer">Trainer</option>
                <option value="admin">Admin</option>
              </select>
              <input type="hidden" name="role" id="hiddenUserRole"
                value="">
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

        <div class="input-field" style="margin-top: 4px;">
          <label>Admin Remarks / Internal Notes</label>
          <textarea id="editUserRemarks"
            placeholder="Add confidential notes or operational remarks regarding this profile..."
            rows="2"
            style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px; font-size:13px; font-family:inherit; resize:vertical;"></textarea>
        </div>

        <div class="modal-footer"
          style="margin-top: 12px; padding-bottom: 5px;">
          <button type="button" class="btn-delete-text"
            onclick="deleteUser()">
            <i class="fa-solid fa-user-slash"></i> Remove User
          </button>
          <div class="action-buttons">
            <button type="button" class="btn-cancel"
              onclick="closeUserModal(); event.stopPropagation(); return false;">Cancel</button>
            <button type="submit" class="btn-save-main">Update
              User</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Facility Modal -->
  <div id="facilityModal" class="modal"
    style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 16px;">

    <div class="modal-content card"
      style="background: #ffffff; width: 100%; max-width: 460px; max-height: 88vh; border-radius: 16px; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">

      <!-- Header -->
      <div class="modal-header"
        style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f0f0f0; padding: 14px 20px; background: #fff; flex-shrink: 0;">
        <h3 id="facilityModalTitle"
          style="margin: 0; font-size: 17px; color: #025628; font-weight: 700; display: flex; align-items: center; gap: 8px;">
          <i class="fa-solid fa-building-circle-gear"></i> Manage Facility
        </h3>
        <span class="close-modal" onclick="closeFacilityModal()"
          style="font-size: 20px; cursor: pointer; color: #888; line-height: 1;">&times;</span>
      </div>

      <!-- Body Form -->
      <form id="facilityForm" class="modal-body"
        style="overflow-y: auto; padding: 16px 20px; display: flex; flex-direction: column; gap: 12px; flex-grow: 1;">

        <input type="hidden" id="editFacId" name="id"
          value="">

        <div class="input-field" style="margin: 0;">
          <label
            style="display: block; font-size: 11px; font-weight: 600; color: #4b5563; text-align: left; margin-bottom: 4px;">
            Facility / Center Name
          </label>
          <div class="input-wrapper"
            style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 8px; padding: 6px 10px; background: #fff;">
            <i class="fa-solid fa-hotel"
              style="color: #6b9e7c; margin-right: 8px; font-size: 13px;"></i>
            <input type="text" id="editFacName" required
              placeholder="e.g. LEDIPO Main"
              style="border: none; outline: none; width: 100%; font-size: 13px; background: transparent;">
          </div>
        </div>

        <div class="input-field" style="margin: 0;">
          <label
            style="display: block; font-size: 11px; font-weight: 600; color: #4b5563; text-align: left; margin-bottom: 4px;">
            Full Address
          </label>
          <div class="input-wrapper"
            style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 8px; padding: 6px 10px; background: #fff;">
            <i class="fa-solid fa-location-dot"
              style="color: #6b9e7c; margin-right: 8px; font-size: 13px;"></i>
            <input type="text" id="editFacAddress" required
              placeholder="Zone 4, Dasmariñas, Cavite"
              style="border: none; outline: none; width: 100%; font-size: 13px; background: transparent;">
          </div>
        </div>

        <div class="input-field" style="margin: 0;">
          <div
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
            <label
              style="font-size: 11px; font-weight: 600; color: #1f2937; display: flex; align-items: center; gap: 6px; margin: 0;">
              <i class="fa-solid fa-book-open-reader"
                style="color: #025628;"></i> Assigned Courses
              <span id="selectedCourseBadge"
                style="background: #e8f5e9; color: #025628; font-size: 10px; padding: 2px 6px; border-radius: 10px; font-weight: 700;">
                0 Selected
              </span>
            </label>
            <button type="button" onclick="toggleSelectAllCourses()"
              style="background: none; border: none; color: #025628; font-size: 11px; font-weight: 600; cursor: pointer; text-decoration: underline; padding: 0;">
              Select All
            </button>
          </div>

          <div id="facilityCoursesContainer"
            style="max-height: 120px; overflow-y: auto; border: 1px solid #d1d5db; border-radius: 8px; padding: 8px 10px; background: #ffffff; display: flex; flex-direction: column; gap: 6px;">
            @foreach ($allCourses as $course)
              <label
                style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #1f2937; cursor: pointer; user-select: none;">
                <input type="checkbox" name="courses[]"
                  value="{{ $course->id }}" class="facility-course-cb"
                  onchange="updateCourseBadgeCount()"
                  style="width: 15px; height: 15px; accent-color: #025628; cursor: pointer;">
                <span>{{ $course->title }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="modal-footer"
          style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f0f0f0; padding-top: 12px; margin-top: 4px; flex-shrink: 0;">
          <button type="button" class="btn-delete-text"
            onclick="deleteFacility()"
            style="background: none; border: none; color: #dc2626; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; padding: 0;">
            <i class="fa-solid fa-trash-can"></i> Delete Facility
          </button>
          <div class="action-buttons" style="display: flex; gap: 8px;">
            <button type="button" onclick="closeFacilityModal()"
              style="background: #f3f4f6; color: #4b5563; border: 1px solid #d1d5db; padding: 7px 14px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer;">
              Cancel
            </button>
            <button type="submit" class="btn-save-main"
              style="background: #025628; color: #fff; border: none; padding: 7px 16px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer;">
              Save Changes
            </button>
          </div>
        </div>

      </form>
    </div>
  </div>

  <!-- Course Content Modal (Modules & Quizzes) -->
  <div id="contentModal" class="modal">
    <div class="modal-content card" style="max-width:680px; width:95%;">
      <div class="modal-header">
        <h3><i class="fa-solid fa-layer-group"></i> Manage: <span
            id="contentModalCourseTitle"></span></h3>
        <span class="close-modal"
          onclick="closeContentModal()">&times;</span>
      </div>

      <div class="modal-body" style="padding-bottom:0;">
        <!-- Tab Navigation -->
        <div
          style="display:flex; gap:0; border-bottom:2px solid #e5e5e5; margin-bottom:16px;">
          <button id="tab-btn-modules" onclick="switchContentTab('modules')"
            style="flex:1; padding:10px; border:none; background:none; font-weight:700; font-size:13px; border-bottom:2px solid #025628; margin-bottom:-2px; color:#025628; cursor:pointer;">
            <i class="fa-solid fa-cubes"></i> Modules
          </button>
          <button id="tab-btn-quizzes" onclick="switchContentTab('quizzes')"
            style="flex:1; padding:10px; border:none; background:none; font-weight:600; font-size:13px; color:#aaa; cursor:pointer;">
            <i class="fa-solid fa-clipboard-question"></i> Quizzes
          </button>
        </div>

        <!-- MODULES TAB -->
        <div id="content-tab-modules">
          <div id="moduleAlert"
            style="display:none; padding:8px 12px; border-radius:6px; font-size:12px; margin-bottom:10px; font-weight:600;">
          </div>

          <div
            style="display:flex; flex-direction:column; gap:8px; margin-bottom:14px;">
            <div style="display:flex; gap:8px;">
              <input type="text" id="newModuleTitle"
                placeholder="Module title" required
                style="flex:1; border:1px solid #ddd; border-radius:8px; padding:8px 12px; font-size:13px; font-family:inherit;">
              <input type="text" id="newModuleDesc"
                placeholder="Description (optional)"
                style="flex:2; border:1px solid #ddd; border-radius:8px; padding:8px 12px; font-size:13px; font-family:inherit;">
            </div>
            <div style="display:flex; gap:8px; align-items:center;">
              <label
                style="font-size:12px; color:#666; white-space:nowrap;">📎
                PDF File:</label>
              <input type="file" id="newModuleFile"
                accept=".pdf,.doc,.docx"
                style="flex:1; border:1px solid #ddd; border-radius:8px; padding:6px 12px; font-size:13px; font-family:inherit; background:#fff;">
              <button type="button" onclick="addModule()"
                style="background:#025628; color:#fff; border:none; border-radius:8px; padding:9px 16px; font-size:13px; font-weight:700; cursor:pointer; white-space:nowrap; font-family:inherit;">
                <i class="fa-solid fa-plus"></i> Add
              </button>
            </div>
          </div>

          <div id="moduleListContainer"
            style="display:flex; flex-direction:column; gap:8px; max-height:320px; overflow-y:auto;">
            <div
              style="text-align:center; color:#bbb; font-size:13px; padding:20px 0;"
              id="modulesEmptyState">
              <i class="fa-solid fa-inbox"
                style="font-size:24px; display:block; margin-bottom:6px; color:#ccc;"></i>
              No modules created yet.
            </div>
          </div>
        </div>

        <!-- QUIZZES TAB -->
        <div id="content-tab-quizzes" style="display:none;">
          <div id="quizAlert"
            style="display:none; padding:8px 12px; border-radius:6px; font-size:12px; margin-bottom:10px; font-weight:600;">
          </div>

          <div
            style="background:#f9f9f9; border:1px solid #eee; border-radius:10px; padding:14px; margin-bottom:14px;">
            <div
              style="font-size:12px; font-weight:700; color:#025628; margin-bottom:10px; text-transform:uppercase; letter-spacing:.04em;">
              <i class="fa-solid fa-plus-circle"></i> New Quiz
            </div>
            <div style="display:flex; gap:8px; flex-wrap:wrap;">
              <input type="text" id="newQuizTitle"
                placeholder="Quiz title" required
                style="flex:2; min-width:140px; border:1px solid #ddd; border-radius:8px; padding:8px 12px; font-size:13px; font-family:inherit;">
              <select id="newQuizModule"
                style="flex:1.5; min-width:130px; border:1px solid #ddd; border-radius:8px; padding:8px 12px; font-size:13px; font-family:inherit; background:#fff;">
                <option value="">— Link to module (optional) —</option>
              </select>
            </div>
            <div
              style="display:flex; gap:8px; margin-top:8px; flex-wrap:wrap; align-items:center;">
              <div style="flex:1; min-width:100px;">
                <label
                  style="font-size:11px; color:#888; display:block; margin-bottom:2px;">Passing
                  score (%)</label>
                <input type="number" id="newQuizPass" value="75"
                  min="1" max="100"
                  style="width:100%; border:1px solid #ddd; border-radius:8px; padding:8px 10px; font-size:13px; font-family:inherit;">
              </div>
              <div style="flex:1; min-width:100px;">
                <label
                  style="font-size:11px; color:#888; display:block; margin-bottom:2px;">Time
                  limit (mins)</label>
                <input type="number" id="newQuizTime" value="30"
                  min="1"
                  style="width:100%; border:1px solid #ddd; border-radius:8px; padding:8px 10px; font-size:13px; font-family:inherit;">
              </div>
              <button type="button" onclick="addQuiz()"
                style="background:#025628; color:#fff; border:none; border-radius:8px; padding:9px 20px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit; margin-top:14px;">
                <i class="fa-solid fa-plus"></i> Add Quiz
              </button>
            </div>
          </div>

          <div id="quizListContainer"
            style="display:flex; flex-direction:column; gap:8px; max-height:280px; overflow-y:auto;">
            <div
              style="text-align:center; color:#bbb; font-size:13px; padding:20px 0;"
              id="quizzesEmptyState">
              <i class="fa-solid fa-inbox"
                style="font-size:24px; display:block; margin-bottom:6px; color:#ccc;"></i>
              No quizzes created yet.
            </div>
          </div>
        </div>

      </div>

      <div class="modal-footer"
        style="margin-top:20px; padding-top:12px; border-top:1px solid #eee; display:flex; justify-content:flex-end;">
        <button class="btn-cancel" onclick="closeContentModal()"
          style="padding:8px 20px; font-size:13px;">
          Close
        </button>
      </div>
    </div>
  </div>

  <!-- ========================================================== -->
  <!-- JAVASCRIPT SCRIPTS & HANDLERS                              -->
  <!-- ========================================================== -->
  <script src="js/logout.js"></script>
  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')
      .getAttribute('content');

    let traineeHistoryInstance = null;
    let courseHistoryInstance = null;
    let currentCourseId = null;

    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const avatarBtn = document.getElementById('avatarBtn');
    const dropdown = document.getElementById('dropdown');

    hamburger.addEventListener('click', function() {
      sidebar.classList.toggle('sidebar-open');
      overlay.classList.toggle('show');
    });

    overlay.addEventListener('click', function() {
      sidebar.classList.remove('sidebar-open');
      overlay.classList.remove('show');
    });

    avatarBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      dropdown.classList.toggle('open');
    });

    document.addEventListener('click', function(e) {
      if (!e.target.closest('.topbar-right')) {
        dropdown.classList.remove('open');
      }
    });

    function setActive(el) {
      document.querySelectorAll('.sidebar .nav-item').forEach(i => i.classList
        .remove('active'));
      el.classList.add('active');
    }

    function initHistoryChart() {
      const traineeCanvas = document.getElementById('traineeHistoryChart');
      if (traineeCanvas) {
        traineeCanvas.style.height = '500px';
        const traineeCtx = traineeCanvas.getContext('2d');
        if (traineeHistoryInstance) traineeHistoryInstance.destroy();
        traineeHistoryInstance = new Chart(traineeCtx, {
          type: 'bar',
          data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
              'Sep', 'Oct', 'Nov', 'Dec'
            ],
            datasets: [{
              label: 'Trainees',
              data: [150, 170, 160, 190, 220, 210, 250, 280, 310, 340,
                390, 420
              ],
              backgroundColor: '#7fb092',
              borderRadius: 5
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: true,
                position: 'top'
              }
            },
            scales: {
              y: {
                beginAtZero: true
              }
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
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
              'Sep', 'Oct', 'Nov', 'Dec'
            ],
            datasets: [{
              label: 'Courses',
              data: [5, 6, 8, 8, 10, 12, 12, 15, 15, 18, 20, 22],
              borderColor: '#004d26',
              backgroundColor: 'rgba(0,77,38,0.1)',
              fill: true,
              tension: 0.4
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      // Form Listeners for Announcement Modal counters & label sync
      const titleInput = document.getElementById('annTitle');
      const messageInput = document.getElementById('annMessage');
      const titleCounter = document.getElementById('titleCounter');
      const messageCounter = document.getElementById('messageCounter');
      const isActiveCb = document.getElementById('annIsActive');
      const statusLabel = document.getElementById('statusLabel');

      if (titleInput && titleCounter) {
        titleInput.addEventListener('input', () => {
          titleCounter.textContent = `${titleInput.value.length}/100`;
        });
      }

      if (messageInput && messageCounter) {
        messageInput.addEventListener('input', () => {
          messageCounter.textContent = `${messageInput.value.length}/500`;
        });
      }

      if (isActiveCb && statusLabel) {
        isActiveCb.addEventListener('change', (e) => {
          statusLabel.textContent = e.target.checked ? 'Publish Now' :
            'Save as Draft';
        });
      }

      var calendarEl = document.getElementById('calendar');
      if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          fixedWeekCount: true,
          headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
          },
          eventColor: '#004d26',
          height: 280,
          aspectRatio: 1.0,
          contentHeight: 'auto',
          handleWindowResize: true
        });
        calendar.render();
      }

      const ctxBar = document.getElementById('traineeChart')?.getContext(
        '2d');
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
            plugins: {
              legend: {
                display: false
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                display: false
              },
              x: {
                grid: {
                  display: false
                }
              }
            }
          }
        });
      }

      const ctxLine = document.getElementById('courseChart')?.getContext(
        '2d');
      if (ctxLine) {
        new Chart(ctxLine, {
          type: 'line',
          data: {
            labels: ['Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Carpentry',
                data: [30, 58, 98, 65],
                borderColor: '#c19a6b',
                tension: 0.3
              },
              {
                label: 'Dressmaking',
                data: [45, 68, 40, 82],
                borderColor: '#6b9e7c',
                tension: 0.3
              },
              {
                label: 'Candle Making',
                data: [25, 62, 25, 18],
                borderColor: '#f4d03f',
                tension: 0.3
              }
            ]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'bottom'
              }
            },
            scales: {
              y: {
                grid: {
                  color: '#f0f0f0'
                }
              }
            }
          }
        });
      }

      // --- URL PARAMETER & LOCALSTORAGE VIEW RESTORATION ---
      const urlParams = new URLSearchParams(window.location.search);
      const savedTab = localStorage.getItem('activeAdminTab');

      if (urlParams.get('view') === 'facilities' || savedTab ===
        'view-facilities') {
        showView('facilities');
        setActive(document.getElementById('nav-facilities'));
        localStorage.removeItem('activeAdminTab');
      } else if (urlParams.get('view') === 'courses' || urlParams.get(
          'page')) {
        showView('courses');
        setActive(document.getElementById('nav-courses'));
      } else if (urlParams.get('trainee_page') || window.location.pathname
        .includes('trainees')) {
        showView('all-trainees');
        setActive(document.getElementById('nav-trainees'));
      } else if (urlParams.get('trainer_page') || urlParams.get('trainer') ||
        urlParams.has('trainer_page')) {
        showView('all-trainers');
        setActive(document.getElementById('nav-trainers'));
      } else if (urlParams.get('view') === 'announcements' || urlParams.get(
          'announcement_page')) {
        showView('announcements');
        setActive(document.getElementById('nav-announcements'));
      } else if (urlParams.get('view') === 'registrations' || urlParams.get(
          'registration_page')) {
        showView('registrations');
        setActive(document.getElementById('nav-registrations'));
      } else if (savedTab && savedTab !== 'view-overview') {
        showView(savedTab.replace('view-', ''));
        localStorage.removeItem('activeAdminTab');
      } else {
        showView('overview');
        setActive(document.getElementById('nav-overview'));
      }
    });

    function showView(viewName) {
      const allViews = [
        'view-overview', 'view-trainee-list', 'view-trainer-list',
        'view-facilities', 'view-courses', 'view-settings', 'view-analytics',
        'view-announcements', 'view-certificate', 'view-registrations'
      ];

      allViews.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
      });

      const title = document.getElementById('main-title');
      const breadcrumb = document.getElementById('breadcrumb-current');

      const map = {
        overview: ['view-overview', 'System Overview', 'System Overview'],
        analytics: ['view-analytics', 'Detailed Analytics',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Analytics`
        ],
        'all-trainees': ['view-trainee-list', 'Trainee Management',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Trainees`
        ],
        'all-trainers': ['view-trainer-list', 'Trainer Management',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Trainers`
        ],
        facilities: ['view-facilities', 'Facilities',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Facilities`
        ],
        courses: ['view-courses', 'Available Courses',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Courses`
        ],
        settings: ['view-settings', 'System Settings',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Settings`
        ],
        announcements: ['view-announcements', 'Announcements',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Announcements`
        ],
        certificate: ['view-certificate', 'Certificates',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Certificates`
        ],
        registrations: ['view-registrations', 'Registrations',
          `<a href="#" onclick="showView('overview');return false;">System Overview</a> / Registrations`
        ],
      };

      const entry = map[viewName] || map['overview'];
      const el = document.getElementById(entry[0]);
      if (el) el.style.display = 'block';
      if (title) title.innerText = entry[1];
      if (breadcrumb) breadcrumb.innerHTML = entry[2];

      const currentParams = new URLSearchParams(window.location.search);
      if (currentParams.get('view') !== viewName) {
        const newUrl = window.location.pathname + '?view=' + viewName;
        window.history.pushState({
          view: viewName
        }, '', newUrl);
      }

      document.querySelectorAll('.sidebar li').forEach(li => li.classList.remove(
        'active'));
      const activeNav = document.getElementById(`nav-${viewName}`);
      if (activeNav) {
        activeNav.classList.add('active');
      }

      if (viewName === 'all-trainees' && typeof backToCourseCards ===
        'function') {
        backToCourseCards();
      }

      if (viewName === 'analytics' && typeof initHistoryChart === 'function') {
        setTimeout(initHistoryChart, 100);
      }

      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebar-overlay');
      if (window.innerWidth <= 768 && sidebar && overlay) {
        sidebar.classList.remove('sidebar-open');
        overlay.classList.remove('show');
      }
    }

    window.addEventListener('popstate', function() {
      const params = new URLSearchParams(window.location.search);
      const view = params.get('view') || 'overview';
      showView(view);
    });

    function toggleUpdates() {
      const extra = document.getElementById("extra-updates");
      const btn = document.getElementById("viewMoreBtn");
      if (extra && btn) {
        if (extra.style.display === "none" || extra.style.display === "") {
          extra.style.display = "flex";
          btn.innerHTML = `View Less <i class="fa-solid fa-chevron-up"></i>`;
        } else {
          extra.style.display = "none";
          btn.innerHTML = `View More <i class="fa-solid fa-chevron-down"></i>`;
        }
      }
    }

    function openLogoutModal() {
      document.getElementById('logoutModal').style.display = 'block';
    }

    function closeLogoutModal() {
      document.getElementById('logoutModal').style.display = 'none';
    }

    function confirmLogout() {
      document.getElementById('logout-form').submit();
    }

    function openCourseModal(id, code, name, duration, slots, trainerId,
      trainerName, status = 'active') {
      currentCourseId = id;
      document.getElementById('courseModal').style.display = 'block';
      document.querySelector('#courseModal h3').innerHTML =
        '<i class="fa-solid fa-pen-to-square"></i> Manage Course';
      document.querySelector('#courseModal .btn-delete-text').style.display =
        'inline-block';
      document.querySelector('.assign-trainer-section').style.display = 'block';

      document.getElementById('editCourseId').value = id;
      document.getElementById('editCourseCode').value = code || '';
      document.getElementById('editCourseName').value = name;
      document.getElementById('editDuration').value = duration;
      document.getElementById('editSlots').value = slots;

      const statusSelect = document.getElementById('editStatus');
      if (statusSelect) {
        statusSelect.value = (status || 'active').toLowerCase();
      }

      document.getElementById('trainerDropdown').value = trainerId || '';
      trainerId && trainerName ? showCurrentTrainer(trainerName) :
        showNoTrainer();
    }

    function openAddCourseModal() {
      currentCourseId = null;
      document.getElementById('courseModal').style.display = 'block';
      document.querySelector('#courseModal h3').innerHTML =
        '<i class="fa-solid fa-folder-plus"></i> Create New Course';
      document.getElementById('courseForm').reset();
      document.querySelector('#courseModal .btn-delete-text').style.display =
        'none';

      document.querySelector('.assign-trainer-section').style.display = 'none';

      showNoTrainer();
    }

    function closeModal() {
      document.getElementById('courseModal').style.display = 'none';
      currentCourseId = null;
      document.querySelector('.assign-trainer-section').style.display = 'block';
    }

    function showCurrentTrainer(name) {
      const initials = name.split(' ').map(n => n[0]).join('').substring(0, 2)
        .toUpperCase();
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
      const dropdown = document.getElementById('trainerDropdown');
      const trainerId = dropdown.value;
      const trainerName = dropdown.selectedOptions[0].text;

      if (!trainerId) {
        alert('Please select a trainer first.');
        return;
      }
      if (!currentCourseId) {
        alert('Please save the course first before assigning a trainer.');
        return;
      }

      fetch(`/admin/course/${currentCourseId}/assign-trainer`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            trainer_id: trainerId
          }),
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            showCurrentTrainer(trainerName);
            alert('Trainer assigned successfully!');
          }
        })
        .catch(() => alert('Something went wrong. Please try again.'));
    }

    function removeTrainer() {
      if (!currentCourseId) return;
      if (!confirm('Remove the assigned trainer from this course?')) return;

      fetch(`/admin/course/${currentCourseId}/remove-trainer`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            showNoTrainer();
            document.getElementById('trainerDropdown').value = '';
            alert('Trainer removed successfully!');
          }
        })
        .catch(() => alert('Something went wrong. Please try again.'));
    }

    function confirmDelete() {
      const courseId = document.getElementById('editCourseId').value;

      if (!courseId) {
        alert('No course selected to delete.');
        return;
      }

      if (!confirm(
          'Are you sure you want to delete this course? This action cannot be undone.'
        )) {
        return;
      }

      fetch(`/admin/course/${courseId}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          }
        })
        .then(async res => {
          const data = await res.json();
          if (data.success) {
            alert('Course deleted successfully!');
            closeModal();
            window.location.href = window.location.pathname + '?view=courses';
          } else {
            alert(data.message ||
              'Could not delete course. Make sure to unassign any active trainers or enrolled trainees first.'
            );
          }
        })
        .catch(err => {
          console.error(err);
          alert('An error occurred while attempting to delete the course.');
        });
    }

    function openUserModal(name, email, role, status, courseTitle = '', contact =
      '', idNum = '', created = '', remarks = '') {
      const modal = document.getElementById('userModal');
      if (modal) {
        modal.style.display = 'block';
        modal.style.setProperty('display', 'block', 'important');
      }

      const nameInput = document.getElementById('editUserName');
      if (nameInput) nameInput.value = name || '';

      const emailInput = document.getElementById('editUserEmail');
      if (emailInput) emailInput.value = email || '';

      const contactInput = document.getElementById('editUserContact');
      if (contactInput) contactInput.value = contact || '';

      const idNumInput = document.getElementById('editUserIdNum');
      if (idNumInput) idNumInput.value = idNum || '';

      const createdInput = document.getElementById('editUserCreated');
      if (createdInput) createdInput.value = created || 'April 2026';

      const remarksInput = document.getElementById('editUserRemarks');
      if (remarksInput) remarksInput.value = remarks || '';

      const cleanRole = (role || 'student').toLowerCase();

      const userRoleEl = document.getElementById('editUserRole');
      if (userRoleEl) userRoleEl.value = cleanRole;

      const hiddenRoleEl = document.getElementById('hiddenUserRole');
      if (hiddenRoleEl) hiddenRoleEl.value = cleanRole;

      const statusSelect = document.getElementById('editUserStatus');
      if (statusSelect) {
        let rawStatus = status;

        if (!rawStatus && email) {
          const badge = document.querySelector(
            `.roster-status-badge[data-email="${email}"]`);
          if (badge) {
            rawStatus = badge.textContent.trim();
          }
        }

        let cleanStatus = 'Active';
        if (rawStatus) {
          const lowerStatus = String(rawStatus).trim().toLowerCase();
          if (lowerStatus === 'inactive' || lowerStatus.includes('inactive')) {
            cleanStatus = 'Inactive';
          } else if (lowerStatus === 'pending' || lowerStatus.includes(
              'pending')) {
            cleanStatus = 'Pending';
          } else {
            cleanStatus = 'Active';
          }
        }
        statusSelect.value = cleanStatus;
      }

      const courseFieldContainer = document.getElementById('trainerCourseField');
      const courseInput = document.getElementById('editTrainerCourse');
      const trainerFieldsContainer = document.getElementById(
        'trainerFieldsContainer');

      if (cleanRole === 'trainer') {
        if (courseFieldContainer) courseFieldContainer.style.display = 'block';
        if (courseInput) courseInput.value = courseTitle || 'No course assigned';
        if (trainerFieldsContainer) trainerFieldsContainer.style.display =
          'block';
      } else {
        if (courseFieldContainer) courseFieldContainer.style.display = 'none';
        if (courseInput) courseInput.value = '';
        if (trainerFieldsContainer) trainerFieldsContainer.style.display = 'none';
      }
    }

    function openFacilityModal(id, name, address, courseIds = []) {
      const modal = document.getElementById('facilityModal');
      const title = document.getElementById('facilityModalTitle') || document
        .querySelector('#facilityModal h3');
      const deleteBtn = document.querySelector('#facilityModal .btn-delete-text');

      if (modal) modal.style.display = 'flex';

      if (title) {
        title.innerHTML =
          '<i class="fa-solid fa-building-circle-gear"></i> Manage Facility';
      }
      if (deleteBtn) {
        deleteBtn.style.display = 'flex';
      }

      const idInput = document.getElementById('editFacId');
      if (idInput) idInput.value = id || '';

      const nameInput = document.getElementById('editFacName');
      const addrInput = document.getElementById('editFacAddress');
      if (nameInput) nameInput.value = name || '';
      if (addrInput) addrInput.value = address || '';

      const targetIds = Array.isArray(courseIds) ?
        courseIds.map(String) :
        (courseIds ? [String(courseIds)] : []);

      document.querySelectorAll('.facility-course-cb').forEach(cb => {
        cb.checked = targetIds.includes(String(cb.value));
      });

      if (typeof updateCourseBadgeCount === 'function') {
        updateCourseBadgeCount();
      }
    }

    function openAddFacilityModal() {
      const modal = document.getElementById('facilityModal');
      const title = document.getElementById('facilityModalTitle') || document
        .querySelector('#facilityModal h3');
      const form = document.getElementById('facilityForm');
      const deleteBtn = document.querySelector('#facilityModal .btn-delete-text');

      if (modal) modal.style.display = 'flex';

      if (title) {
        title.innerHTML =
          '<i class="fa-solid fa-building-circle-plus"></i> Add New Facility';
      }

      if (form) form.reset();

      const idInput = document.getElementById('editFacId');
      if (idInput) idInput.value = '';

      document.querySelectorAll('.facility-course-cb').forEach(cb => {
        cb.checked = false;
      });

      if (deleteBtn) {
        deleteBtn.style.display = 'none';
      }

      if (typeof updateCourseBadgeCount === 'function') {
        updateCourseBadgeCount();
      }
    }

    function deleteFacility() {
      const id = document.getElementById('editFacId')?.value?.trim();

      if (!id) {
        alert('Cannot delete: Invalid or missing Facility ID.');
        return;
      }

      if (!confirm(
          'Are you sure you want to delete this facility? Any assigned courses will be unlinked.'
        )) {
        return;
      }

      const csrfToken = typeof getCsrfToken === 'function' ?
        getCsrfToken() :
        document.querySelector('meta[name="csrf-token"]')?.getAttribute(
          'content');

      fetch('/admin/facility/delete', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            id: id
          })
        })
        .then(async response => {
          const data = await response.json().catch(() => null);

          if (response.ok && data && data.success) {
            alert(data.message || 'Facility deleted successfully!');
            closeFacilityModal();

            localStorage.setItem('activeAdminTab', 'view-facilities');
            location.reload();
          } else {
            alert((data && data.message) ? data.message :
              'Failed to delete facility.');
          }
        })
        .catch(error => {
          console.error('Delete facility error:', error);
          alert('An error occurred while deleting the facility.');
        });
    }

    function closeFacilityModal() {
      const modal = document.getElementById('facilityModal');
      const form = document.getElementById('facilityForm');

      if (modal) {
        modal.style.display = 'none';
      }

      if (form) form.reset();
    }

    function openAddTrainerModal() {
      const modal = document.getElementById('addTrainerModal');
      if (modal) {
        modal.style.display = 'block';
      }
    }

    function closeAddTrainerModal() {
      const modal = document.getElementById('addTrainerModal');
      if (modal) {
        modal.style.display = 'none';
        modal.style.setProperty('display', 'none', 'important');
      }
      const form = document.getElementById('addTrainerForm');
      if (form) {
        form.reset();
      }
    }

    window.onclick = function(event) {
      if (event.target && event.target.classList.contains('modal')) {
        if (typeof closeModal === 'function') closeModal();
        if (typeof closeUserModal === 'function') closeUserModal();
        if (typeof closeFacilityModal === 'function') closeFacilityModal();
        if (typeof closeAddTrainerModal === 'function') closeAddTrainerModal();
        if (typeof closeAnnouncementModal === 'function')
          closeAnnouncementModal();
      }
    };

    document.getElementById('addTrainerForm').onsubmit = function(e) {
      e.preventDefault();
      const name = document.getElementById('newTrainerName').value.trim().split(
        ' ');
      const email = document.getElementById('newTrainerEmail').value.trim();
      const password = document.getElementById('newTrainerPass').value.trim();

      if (!name.length || !email || !password) {
        alert('Please fill in all required fields.');
        return;
      }

      const courseId = document.getElementById('newTrainerCourse').value;

      fetch('/admin/trainer/store', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            firstname: name[0],
            lastname: name.slice(1).join(' ') || '-',
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
            alert(data.message || 'An error occurred. Please try again.');
          }
        })
        .catch(() => alert('An error occurred. Please try again.'));
    };

    document.getElementById('courseForm').onsubmit = function(e) {
      e.preventDefault();

      const courseId = document.getElementById('editCourseId').value;
      const courseCode = document.getElementById('editCourseCode').value.trim();
      const title = document.getElementById('editCourseName').value.trim();
      const duration = document.getElementById('editDuration').value.trim();
      const slots = document.getElementById('editSlots').value;
      const status = document.getElementById('editStatus').value;

      const isEdit = courseId !== '' && courseId !== null && courseId !==
        undefined;
      const url = isEdit ? `/admin/course/${courseId}` : '/admin/course/store';
      const method = isEdit ? 'PUT' : 'POST';

      fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            course_code: courseCode,
            title: title,
            duration: duration,
            slots: slots,
            status: status
          })
        })
        .then(async r => {
          const text = await r.text();
          try {
            return JSON.parse(text);
          } catch (err) {
            console.error("Server response was not JSON:", text);
            throw new Error("Server returned an invalid response.");
          }
        })
        .then(data => {
          if (data.success) {
            alert(isEdit ? 'Course updated successfully!' :
              'Course created successfully!');
            closeModal();
            window.location.href = window.location.pathname + '?view=courses';
          } else {
            alert(data.message || 'An error occurred while updating.');
          }
        })
        .catch(err => {
          console.error(err);
          alert('An error occurred. Please try again.');
        });
    };

    document.getElementById('facilityForm').onsubmit = function(e) {
      e.preventDefault();

      const idVal = document.getElementById('editFacId')?.value?.trim();
      const id = idVal ? idVal : null;

      const name = document.getElementById('editFacName').value.trim();
      const address = document.getElementById('editFacAddress').value.trim();

      const selectedCourseIds = Array.from(
        document.querySelectorAll('.facility-course-cb:checked')
      ).map(cb => cb.value);

      if (!name || !address) {
        alert('Please enter a facility name and address.');
        return;
      }

      const csrfToken = typeof getCsrfToken === 'function' ?
        getCsrfToken() :
        document.querySelector('meta[name="csrf-token"]')?.getAttribute(
          'content');

      fetch('/admin/facility/save', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            id: id,
            name: name,
            address: address,
            course_ids: selectedCourseIds
          })
        })
        .then(async response => {
          const data = await response.json().catch(() => null);

          if (response.ok && data && data.success) {
            alert(data.message || 'Facility details saved successfully!');
            closeFacilityModal();

            localStorage.setItem('activeAdminTab', 'view-facilities');
            location.reload();
          } else {
            let errorMsg = 'Failed to save facility details.';
            if (data && data.errors) {
              errorMsg = Object.values(data.errors).flat().join('\n');
            } else if (data && data.message) {
              errorMsg = data.message;
            }
            alert(errorMsg);
          }
        })
        .catch(error => {
          console.error('Facility save error:', error);
          alert('An error occurred while saving the facility.');
        });
    };

    /* ========================================================== */
    /* ANNOUNCEMENT MODAL & ACTIONS HANDLERS                      */
    /* ========================================================== */
    // Utility helper to format database ISO/SQL timestamps for datetime-local inputs (YYYY-MM-DDTHH:mm)
    function formatForDateTimeInput(dateStr) {
      if (!dateStr) return '';
      const date = new Date(dateStr);
      if (isNaN(date.getTime())) return '';

      const pad = (num) => String(num).padStart(2, '0');

      const year = date.getFullYear();
      const month = pad(date.getMonth() + 1);
      const day = pad(date.getDate());
      const hours = pad(date.getHours());
      const minutes = pad(date.getMinutes());

      return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    // Open Modal (New Announcement)
    function openAnnouncementModal() {
      document.getElementById('annId').value = '';
      document.getElementById('annTitle').value = '';
      document.getElementById('annMessage').value = '';
      document.getElementById('annType').value = 'reminder';

      const isActiveCb = document.getElementById('annIsActive');
      if (isActiveCb) isActiveCb.checked = true;

      document.getElementById('annPublishAt').value = '';
      document.getElementById('annExpiresAt').value = '';

      document.getElementById('titleCounter').textContent = '0/100';
      document.getElementById('messageCounter').textContent = '0/500';

      const statusLabel = document.getElementById('statusLabel');
      if (statusLabel) statusLabel.textContent = 'Active';

      document.getElementById('annModalTitle').innerHTML =
        '<i class="fa-solid fa-bell"></i> Add Announcement';
      document.getElementById('announcementModal').style.display = 'flex';
    }

    // Open Modal (Edit Announcement)
    function handleEditAnnouncement(button) {
      const id = button.getAttribute('data-id');
      const title = button.getAttribute('data-title') || '';
      const message = button.getAttribute('data-message') || '';
      const type = button.getAttribute('data-type') || 'reminder';
      const active = button.getAttribute('data-active') === '1';
      const publishAt = button.getAttribute('data-publish-at') || '';
      const expiresAt = button.getAttribute('data-expires-at') || '';

      document.getElementById('annId').value = id;
      document.getElementById('annTitle').value = title;
      document.getElementById('annMessage').value = message;
      document.getElementById('annType').value = type;

      const isActiveCb = document.getElementById('annIsActive');
      if (isActiveCb) isActiveCb.checked = active;

      document.getElementById('annPublishAt').value = formatForDateTimeInput(
        publishAt);
      document.getElementById('annExpiresAt').value = formatForDateTimeInput(
        expiresAt);

      document.getElementById('titleCounter').textContent = `${title.length}/100`;
      document.getElementById('messageCounter').textContent =
        `${message.length}/500`;

      const statusLabel = document.getElementById('statusLabel');
      if (statusLabel) statusLabel.textContent = active ? 'Active' : 'Inactive';

      document.getElementById('annModalTitle').innerHTML =
        '<i class="fa-solid fa-pen-to-square"></i> Edit Announcement';
      document.getElementById('announcementModal').style.display = 'flex';
    }

    // Close Modal
    function closeAnnouncementModal() {
      const modal = document.getElementById('announcementModal');
      const form = document.getElementById('announcementForm');
      const btnSubmit = document.getElementById('btnSubmitAnn');

      if (modal) modal.style.display = 'none';
      if (form) form.reset();

      const titleCounter = document.getElementById('titleCounter');
      const messageCounter = document.getElementById('messageCounter');
      if (titleCounter) titleCounter.textContent = '0/100';
      if (messageCounter) messageCounter.textContent = '0/500';

      if (btnSubmit) {
        btnSubmit.disabled = false;
        btnSubmit.innerHTML = 'Save';
      }
    }

    // Submit Form Handler (Save/Update with Success & Error Feedback)
    document.getElementById('announcementForm').onsubmit = function(e) {
      e.preventDefault();

      const id = document.getElementById('annId')?.value || '';
      const title = document.getElementById('annTitle')?.value.trim() || '';
      const message = document.getElementById('annMessage')?.value.trim() || '';
      const type = document.getElementById('annType')?.value || 'reminder';
      const isActive = document.getElementById('annIsActive')?.checked ? 1 : 0;

      // Read SQL formatted datetime directly from input elements
      const publishAt = document.getElementById('annPublishAt')?.value || null;
      const expiresAt = document.getElementById('annExpiresAt')?.value || null;

      const btnSubmit = document.getElementById('btnSubmitAnn');
      const originalBtnText = btnSubmit ? btnSubmit.innerHTML : 'Save';

      if (btnSubmit) {
        btnSubmit.disabled = true;
        btnSubmit.innerHTML =
          '<i class="fa-solid fa-spinner fa-spin"></i> Saving...';
      }

      const isEdit = id !== '' && id !== null;
      const url = isEdit ? `/admin/announcement/${id}` : '/admin/announcement';

      const token = typeof csrfToken !== 'undefined' ?
        csrfToken :
        document.querySelector('meta[name="csrf-token"]')?.getAttribute(
          'content') || '';

      const payload = {
        title: title,
        message: message,
        type: type,
        is_active: isActive,
        publish_at: publishAt ? publishAt : null,
        expires_at: expiresAt ? expiresAt : null
      };

      if (isEdit) {
        payload._method = 'PUT';
      }

      fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        })
        .then(async response => {
          const data = await response.json().catch(() => null);

          if (response.ok && data && data.success) {
            // Visual button feedback on success
            if (btnSubmit) {
              btnSubmit.style.backgroundColor = '#025628';
              btnSubmit.innerHTML = isEdit ?
                '<i class="fa-solid fa-check"></i> Updated Successfully!' :
                '<i class="fa-solid fa-check"></i> Created Successfully!';
            }

            setTimeout(() => {
              alert(data.message || (isEdit ?
                'Announcement updated successfully!' :
                'Announcement created successfully!'));
              closeAnnouncementModal();
              window.location.href = window.location.pathname +
                '?view=announcements';
            }, 200);

          } else {
            let errorMsg = 'Validation error. Check your inputs.';
            if (data && data.errors) {
              errorMsg = Object.values(data.errors).flat().join('\n');
            } else if (data && data.message) {
              errorMsg = data.message;
            }

            alert('Error saving announcement:\n' + errorMsg);

            if (btnSubmit) {
              btnSubmit.disabled = false;
              btnSubmit.style.backgroundColor = '';
              btnSubmit.innerHTML = originalBtnText;
            }
          }
        })
        .catch(err => {
          console.error('Save announcement error details:', err);
          alert(
            'An error occurred while saving. Check F12 Console for exact details.'
          );

          if (btnSubmit) {
            btnSubmit.disabled = false;
            btnSubmit.style.backgroundColor = '';
            btnSubmit.innerHTML = originalBtnText;
          }
        });
    };

    // Delete Announcement Handler
    function deleteAnnouncement(id, btn = null) {
      if (!confirm(
          'Are you sure you want to delete this announcement? This action cannot be undone.'
        )) {
        return;
      }

      if (btn) btn.disabled = true;

      const token = typeof csrfToken !== 'undefined' ?
        csrfToken :
        document.querySelector('meta[name="csrf-token"]')?.getAttribute(
          'content') || '';

      fetch(`/admin/announcement/${id}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
          }
        })
        .then(async response => {
          const data = await response.json().catch(() => null);

          if (response.ok && data && data.success) {
            alert(data.message || 'Announcement deleted successfully!');
            window.location.href = window.location.pathname +
              '?view=announcements';
          } else {
            alert('Failed to delete announcement: ' + ((data && data
              .message) ? data.message : 'Server error'));
            if (btn) btn.disabled = false;
          }
        })
        .catch(err => {
          console.error('Delete announcement error:', err);
          alert('An error occurred while deleting the announcement.');
          if (btn) btn.disabled = false;
        });
    }

    // DOM Event Listeners Initialization
    document.addEventListener('DOMContentLoaded', function() {
      const isActiveCb = document.getElementById('annIsActive');
      const statusLabel = document.getElementById('statusLabel');
      const titleInput = document.getElementById('annTitle');
      const messageInput = document.getElementById('annMessage');
      const modal = document.getElementById('announcementModal');

      // Live Status Label Sync
      if (isActiveCb && statusLabel) {
        isActiveCb.addEventListener('change', function() {
          statusLabel.textContent = this.checked ? 'Active' : 'Inactive';
        });
      }

      // Live Character Counters
      if (titleInput) {
        titleInput.addEventListener('input', function() {
          document.getElementById('titleCounter').textContent =
            `${this.value.length}/100`;
        });
      }

      if (messageInput) {
        messageInput.addEventListener('input', function() {
          document.getElementById('messageCounter').textContent =
            `${this.value.length}/500`;
        });
      }

      // Close modal when clicking on dark backdrop
      window.addEventListener('click', function(e) {
        if (e.target === modal) {
          closeAnnouncementModal();
        }
      });
    });

    // Helper: Format raw database ISO string to "YYYY-MM-DDTHH:mm" for input[type="datetime-local"]
    function formatForDateTimeInput(dateStr) {
      if (!dateStr) return '';
      const formatted = dateStr.trim().replace(' ', 'T');
      if (formatted.length >= 16) {
        return formatted.substring(0, 16);
      }
      const date = new Date(dateStr);
      if (isNaN(date.getTime())) return '';
      const pad = (num) => String(num).padStart(2, '0');
      return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T${pad(date.getHours())}:${pad(date.getMinutes())}`;
    }

    // Helper: Convert "YYYY-MM-DDTHH:mm" datetime-local value to SQL format "YYYY-MM-DD HH:mm:00" or null
    function cleanDateTimeInput(val) {
      if (!val || typeof val !== 'string' || val.trim() === '') return null;
      let formatted = val.trim().replace('T', ' ');
      if (formatted.length === 16) {
        formatted += ':00';
      }
      return formatted;
    }

    // Submit Form Handler
    document.addEventListener('DOMContentLoaded', function() {
      const annForm = document.getElementById('announcementForm');

      if (annForm) {
        // Clear any existing inline submit handlers to avoid duplicate triggers
        annForm.onsubmit = null;

        annForm.addEventListener('submit', function(e) {
          e.preventDefault();
          e
            .stopImmediatePropagation(); // Block duplicate event listeners from executing

          const btnSubmit = document.getElementById('btnSubmitAnn');

          // Double-submit protection: ignore if a request is already in progress
          if (btnSubmit && btnSubmit.disabled) {
            return;
          }

          const id = document.getElementById('annId')?.value || '';
          const title = document.getElementById('annTitle')?.value
            .trim() || '';
          const message = document.getElementById('annMessage')?.value
            .trim() || '';
          const type = document.getElementById('annType')?.value ||
            'reminder';
          const isActive = document.getElementById('annIsActive')
            ?.checked ? 1 : 0;

          const rawPublish = document.getElementById('annPublishAt')
            ?.value || '';
          const rawExpires = document.getElementById('annExpiresAt')
            ?.value || '';

          const originalBtnText = btnSubmit ? btnSubmit.innerHTML :
            'Save';

          // Immediately disable button to prevent double-click submissions
          if (btnSubmit) {
            btnSubmit.disabled = true;
            btnSubmit.innerHTML =
              '<i class="fa-solid fa-spinner fa-spin"></i> Saving...';
          }

          const isEdit = id !== '' && id !== null;
          const url = isEdit ? `/admin/announcement/${id}` :
            '/admin/announcement';

          const token = typeof csrfToken !== 'undefined' ?
            csrfToken :
            document.querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content') || '';

          const payload = {
            title: title,
            message: message,
            type: type,
            is_active: isActive,
            publish_at: typeof cleanDateTimeInput === 'function' ?
              cleanDateTimeInput(rawPublish) : (rawPublish || null),
            expires_at: typeof cleanDateTimeInput === 'function' ?
              cleanDateTimeInput(rawExpires) : (rawExpires || null)
          };

          if (isEdit) {
            payload._method = 'PUT';
          }

          fetch(url, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
              },
              body: JSON.stringify(payload)
            })
            .then(async response => {
              const data = await response.json().catch(() => null);

              if (response.ok && data && data.success) {
                // Immediate visual button feedback
                if (btnSubmit) {
                  btnSubmit.style.backgroundColor = '#025628';
                  btnSubmit.innerHTML = isEdit ?
                    '<i class="fa-solid fa-check"></i> Updated Successfully!' :
                    '<i class="fa-solid fa-check"></i> Created Successfully!';
                }

                setTimeout(() => {
                  alert(data.message || (isEdit ?
                    'Announcement updated successfully!' :
                    'Announcement created successfully!'));
                  closeAnnouncementModal();
                  window.location.href = window.location
                    .pathname + '?view=announcements';
                }, 200);

              } else {
                let errorMsg =
                  'Validation error. Please check your form fields.';
                if (data && data.errors) {
                  errorMsg = Object.values(data.errors).flat().join(
                    '\n');
                } else if (data && data.message) {
                  errorMsg = data.message;
                }

                alert('Error saving announcement:\n' + errorMsg);

                if (btnSubmit) {
                  btnSubmit.disabled = false;
                  btnSubmit.style.backgroundColor = '';
                  btnSubmit.innerHTML = originalBtnText;
                }
              }
            })
            .catch(err => {
              console.error('Save announcement error details:', err);
              alert(
                'An error occurred while saving. Check Console (F12) for details.'
              );

              if (btnSubmit) {
                btnSubmit.disabled = false;
                btnSubmit.style.backgroundColor = '';
                btnSubmit.innerHTML = originalBtnText;
              }
            });
        });
      }
    });

    function deleteAnn(id) {
      if (!confirm('Are you sure you want to delete this announcement?')) return;
      fetch(`/admin/announcement/${id}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          }
        })
        .then(r => r.json())
        .then(data => {
          if (data.success) location.reload();
        })
        .catch(() => alert('An error occurred. Please try again.'));
    }

    let _contentCourseId = null;
    let _contentModules = [];
    let _contentQuizzes = [];

    function openContentModal(courseId, courseTitle) {
      _contentCourseId = courseId;
      document.getElementById('contentModalCourseTitle').textContent =
        courseTitle;
      document.getElementById('contentModal').style.display = 'block';
      switchContentTab('modules');
      fetchCourseContent(courseId);
    }

    function closeContentModal() {
      document.getElementById('contentModal').style.display = 'none';
      _contentCourseId = null;
      _contentModules = [];
      _contentQuizzes = [];
    }

    function switchContentTab(tab) {
      const isMod = tab === 'modules';
      document.getElementById('content-tab-modules').style.display = isMod ?
        'block' : 'none';
      document.getElementById('content-tab-quizzes').style.display = isMod ?
        'none' : 'block';

      const styleActive =
        'border-bottom:2px solid #025628; margin-bottom:-2px; color:#025628;';
      const styleInactive = 'border-bottom:none; color:#aaa;';
      document.getElementById('tab-btn-modules').style.cssText += isMod ?
        styleActive : styleInactive;
      document.getElementById('tab-btn-quizzes').style.cssText += isMod ?
        styleInactive : styleActive;

      if (tab === 'quizzes') populateQuizModuleDropdown();
    }

    function fetchCourseContent(courseId) {
      fetch(`/admin/course/${courseId}/content`, {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          }
        })
        .then(r => r.json())
        .then(data => {
          _contentModules = data.modules || [];
          _contentQuizzes = data.quizzes || [];
          renderModules();
          renderQuizzes();
          updateCourseCardCounts();
        })
        .catch(() => alert('Failed to load course content.'));
    }

    function renderModules() {
      const container = document.getElementById('moduleListContainer');
      if (!container) return;

      if (!_contentModules || !_contentModules.length) {
        container.innerHTML = `
      <div style="text-align:center; color:#bbb; font-size:13px; padding:20px 0;" id="modulesEmptyState">
        <i class="fa-solid fa-inbox" style="font-size:24px; display:block; margin-bottom:6px; color:#ccc;"></i>
        No modules created yet.
      </div>
    `;
        return;
      }

      container.innerHTML = _contentModules.map((m, i) => `
    <div id="module-card-${m.id}" style="display:flex; align-items:center; justify-content:space-between; gap:12px; background:#fff; border:1px solid #e5e7eb; border-radius:10px; padding:12px 16px; margin-bottom:8px; box-shadow:0 1px 2px rgba(0,0,0,0.03);">
      
      <div style="display:flex; align-items:center; gap:12px; flex:1; min-width:0;">
        <div style="width:30px; height:30px; border-radius:50%; background:#e8f5e9; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; color:#025628; flex-shrink:0;">
          ${i + 1}
        </div>

        <div style="flex:1; min-width:0;">
          <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
            <strong style="font-size:14px; color:#1f2937;">${escHtml(m.title)}</strong>
            
            <span style="font-size:10px; font-weight:700; padding:2px 8px; border-radius:12px; background:${(m.is_active !== false && m.is_published !== false) ? '#e8f5e9' : '#fff8e1'}; color:${(m.is_active !== false && m.is_published !== false) ? '#025628' : '#854F0B'};">
              ${(m.is_active !== false && m.is_published !== false) ? 'Published' : 'Draft'}
            </span>
          </div>
          
          <div style="font-size:12px; color:#6b7280; margin-top:2px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
            ${m.description ? escHtml(m.description) : '<span style="color:#b0b0b0; font-style:italic;">No description</span>'}
          </div>
        </div>
      </div>

      <div style="display:flex; align-items:center; gap:8px; flex-shrink:0;">
        ${m.file_path ? `
                                                                            <a href="/admin/module/file/${m.id}/${encodeURIComponent(m.title)}.pdf" target="_blank" 
                                                                               style="font-size:11px; padding:6px 12px; border-radius:6px; background:#e8f5e9; color:#025628; text-decoration:none; font-weight:700; display:inline-flex; align-items:center; gap:5px; white-space:nowrap; transition: background 0.2s;">
                                                                              <i class="fa-solid fa-file-pdf"></i> View File
                                                                            </a>
                                                                          ` : `
                                                                            <span style="font-size:11px; color:#9ca3af; padding:4px 8px; font-style:italic;">No PDF</span>
                                                                          `}

        <button type="button" onclick="deleteModule(${m.id})"
          style="font-size:11px; padding:6px 12px; border-radius:6px; background:#FCEBEB; color:#A32D2D; border:none; cursor:pointer; font-family:inherit; font-weight:700; white-space:nowrap; display:inline-flex; align-items:center; gap:4px;">
          <i class="fa-solid fa-trash"></i> Remove
        </button>
      </div>
    </div>
  `).join('');
    }

    function renderQuizzes() {
      const container = document.getElementById('quizListContainer');
      const empty = document.getElementById('quizzesEmptyState');

      const validQuizzes = (_contentQuizzes || []).filter(q => q && typeof q ===
        'object');

      if (!validQuizzes.length) {
        if (empty) empty.style.display = 'block';
        if (container) {
          container.innerHTML = '';
          if (empty) container.appendChild(empty);
        }
        return;
      }
      if (empty) empty.style.display = 'none';

      if (container) {
        container.innerHTML = validQuizzes.map(q => `
      <div style="display:flex; flex-direction:column; gap:0; background:#fff; border:1px solid #eee; border-radius:10px; overflow:hidden;">
        <div style="display:flex; align-items:center; gap:10px; padding:10px 14px;">
          <div style="width:32px; height:32px; border-radius:8px; background:#fff8e1; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0;">
            📝
          </div>
          <div style="flex:1; min-width:0;">
            <div style="font-size:13px; font-weight:700; color:#1a1a1a;">${escHtml(q.title)}</div>
            <div style="font-size:11px; color:#888;">
              ${q.module ? `<i class="fa-solid fa-cube"></i> ${escHtml(q.module.title)} &nbsp;·&nbsp;` : ''}
              <i class="fa-solid fa-clock"></i> ${q.time_limit || 30}m &nbsp;·&nbsp;
              <i class="fa-solid fa-star"></i> ${q.passing_score || 75}% passing
            </div>
          </div>
          <button onclick="toggleQuizQuestions(${q.id}, this)"
            style="font-size:11px; padding:4px 10px; border-radius:6px; background:#e8f5e9; color:#025628; border:none; cursor:pointer; font-family:inherit; font-weight:700; white-space:nowrap;">
            <i class="fa-solid fa-list"></i> Questions
          </button>
          <button onclick="deleteQuiz(${q.id})"
            style="font-size:11px; padding:4px 10px; border-radius:6px; background:#FCEBEB; color:#A32D2D; border:none; cursor:pointer; font-family:inherit; font-weight:700; white-space:nowrap;">
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
              <input type="text" id="qa-${q.id}" placeholder="A. Choice A" style="border:1px solid #ddd; border-radius:8px; padding:7px 10px; font-size:13px; font-family:inherit;">
              <input type="text" id="qb-${q.id}" placeholder="B. Choice B" style="border:1px solid #ddd; border-radius:8px; padding:7px 10px; font-size:13px; font-family:inherit;">
              <input type="text" id="qc-${q.id}" placeholder="C. Choice C" style="border:1px solid #ddd; border-radius:8px; padding:7px 10px; font-size:13px; font-family:inherit;">
              <input type="text" id="qd-${q.id}" placeholder="D. Choice D" style="border:1px solid #ddd; border-radius:8px; padding:7px 10px; font-size:13px; font-family:inherit;">
            </div>
            <div style="display:flex; gap:8px; align-items:center;">
              <label style="font-size:12px; color:#666;">Correct answer:</label>
              <select id="qans-${q.id}" style="border:1px solid #ddd; border-radius:8px; padding:6px 10px; font-size:13px; font-family:inherit; background:#fff;">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
              </select>
              <button onclick="addQuestion(${q.id})"
                style="background:#025628; color:#fff; border:none; border-radius:8px; padding:7px 16px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit; margin-left:auto;">
                <i class="fa-solid fa-plus"></i> Add
              </button>
            </div>
          </div>
        </div>
      </div>
    `).join('');
      }
    }

    function getCsrfToken() {
      return document.querySelector('meta[name="csrf-token"]')?.content ||
        (typeof csrfToken !== 'undefined' ? csrfToken : '');
    }

    function addModule(event) {
      if (event && typeof event.preventDefault === 'function') {
        event.preventDefault();
      }

      const titleInput = document.getElementById('newModuleTitle');
      const descInput = document.getElementById('newModuleDesc');
      const fileInput = document.getElementById('newModuleFile');

      const title = titleInput?.value.trim() || '';
      const desc = descInput?.value.trim() || '';
      const file = fileInput?.files[0];

      if (!title) {
        alert('Please enter a module title.');
        titleInput?.focus();
        return;
      }

      if (typeof _contentCourseId === 'undefined' || !_contentCourseId) {
        alert('No active course selected.');
        return;
      }

      const formData = new FormData();
      formData.append('course_id', _contentCourseId);
      formData.append('title', title);
      formData.append('description', desc);
      if (file) {
        formData.append('file', file);
      }

      fetch('/admin/module', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': getCsrfToken(),
            'Accept': 'application/json'
          },
          body: formData
        })
        .then(async response => {
          const data = await response.json().catch(() => null);

          if (response.ok && data && data.success) {
            if (!Array.isArray(_contentModules)) {
              _contentModules = [];
            }

            const rawModule = data.module || data.data || data;

            const newModule = {
              id: rawModule.id || Date.now(),
              title: rawModule.title || title,
              description: rawModule.description || desc,
              file_path: rawModule.file_path || null,
              is_active: rawModule.is_active ?? true
            };

            _contentModules.push(newModule);

            if (titleInput) titleInput.value = '';
            if (descInput) descInput.value = '';
            if (fileInput) fileInput.value = '';

            renderModules();
            updateCourseCardCounts();
            if (typeof populateQuizModuleDropdown === 'function') {
              populateQuizModuleDropdown();
            }
          } else {
            let errorMsg = 'Failed to create module.';
            if (data && data.errors) {
              errorMsg = Object.values(data.errors).flat().join('\n');
            } else if (data && data.message) {
              errorMsg = data.message;
            }
            alert(errorMsg);
          }
        })
        .catch(error => {
          console.error('Add module request error:', error);
          alert(
            'An error occurred while uploading the module. Please try again.');
        });
    }

    function deleteModule(id) {
      if (!confirm('Are you sure you want to remove this module?')) return;

      fetch(`/admin/module/${id}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'Accept': 'application/json'
          }
        })
        .then(async response => {
          const data = await response.json().catch(() => null);

          if (response.ok || response.status === 404) {
            if (Array.isArray(_contentModules)) {
              _contentModules = _contentModules.filter(m => m && String(m
                .id) !== String(id));
            }

            try {
              renderModules();
            } catch (e) {
              console.error('Render modules error:', e);
            }
            try {
              updateCourseCardCounts();
            } catch (e) {
              console.error('Update counts error:', e);
            }
            try {
              if (typeof populateQuizModuleDropdown === 'function') {
                populateQuizModuleDropdown();
              }
            } catch (e) {
              console.error('Update dropdown error:', e);
            }
          } else {
            const errorMsg = (data && data.message) ? data.message :
              `Server error (${response.status})`;
            alert(errorMsg);
          }
        })
        .catch(error => {
          console.error('Delete module fetch request failed:', error);
          if (Array.isArray(_contentModules)) {
            _contentModules = _contentModules.filter(m => m && String(m.id) !==
              String(id));
            try {
              renderModules();
            } catch (e) {}
            try {
              updateCourseCardCounts();
            } catch (e) {}
          }
          alert('Network error while attempting to delete the module.');
        });
    }

    function addQuiz(event) {
      if (event && typeof event.preventDefault === 'function') {
        event.preventDefault();
      }

      const titleInput = document.getElementById('newQuizTitle');
      const title = titleInput?.value.trim() || '';
      const moduleId = document.getElementById('newQuizModule')?.value || null;
      const passing = parseInt(document.getElementById('newQuizPass')?.value) ||
        75;
      const time = parseInt(document.getElementById('newQuizTime')?.value) || 30;

      if (!title) {
        alert('Please enter a quiz title.');
        titleInput?.focus();
        return;
      }

      fetch('/admin/quiz', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            course_id: _contentCourseId,
            module_id: moduleId,
            title: title,
            passing_score: passing,
            time_limit: time
          })
        })
        .then(async response => {
          const data = await response.json().catch(() => null);

          if (response.ok && data && data.success) {
            if (!Array.isArray(_contentQuizzes)) _contentQuizzes = [];
            const newQuiz = data.quiz || data.data || {
              id: Date.now(),
              title: title,
              time_limit: time,
              passing_score: passing
            };
            _contentQuizzes.push(newQuiz);

            if (titleInput) titleInput.value = '';

            renderQuizzes();
            updateCourseCardCounts();
          } else {
            alert((data && data.message) ? data.message :
              'Failed to create quiz.');
          }
        })
        .catch(error => {
          console.error('Add quiz request error:', error);
          alert('An error occurred while creating the quiz.');
        });
    }

    function deleteQuiz(id) {
      if (!confirm('Are you sure you want to remove this quiz?')) return;

      fetch(`/admin/quiz/${id}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            _method: 'DELETE'
          })
        })
        .then(async response => {
          const data = await response.json().catch(() => null);

          if (response.ok || response.status === 404) {
            if (Array.isArray(_contentQuizzes)) {
              _contentQuizzes = _contentQuizzes.filter(q => q && String(q
                .id) !== String(id));
            }

            renderQuizzes();
            updateCourseCardCounts();
          } else {
            alert((data && data.message) ? data.message :
              `Server error (${response.status})`);
          }
        })
        .catch(error => {
          console.error('Delete quiz error:', error);
          if (Array.isArray(_contentQuizzes)) {
            _contentQuizzes = _contentQuizzes.filter(q => q && String(q.id) !==
              String(id));
            renderQuizzes();
            updateCourseCardCounts();
          }
        });
    }

    function populateQuizModuleDropdown() {
      const sel = document.getElementById('newQuizModule');
      if (!sel) return;
      sel.innerHTML = '<option value="">— Link to module (optional) —</option>';

      if (Array.isArray(_contentModules)) {
        _contentModules.forEach(m => {
          const opt = document.createElement('option');
          opt.value = m.id;
          opt.textContent = m.title;
          sel.appendChild(opt);
        });
      }
    }

    function escHtml(str) {
      const div = document.createElement('div');
      div.appendChild(document.createTextNode(str || ''));
      return div.innerHTML;
    }

    function toggleQuizQuestions(quizId, btn) {
      const panel = document.getElementById(`quiz-questions-${quizId}`);
      const isOpen = panel.style.display !== 'none';
      panel.style.display = isOpen ? 'none' : 'block';
      if (!isOpen) loadQuizQuestions(quizId);
    }

    function loadQuizQuestions(quizId) {
      fetch(`/admin/quiz/${quizId}/questions`, {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          }
        })
        .then(r => r.json())
        .then(data => renderQuizQuestions(quizId, data.questions || []))
        .catch(() => alert('Failed to load questions.'));
    }

    function renderQuizQuestions(quizId, questions) {
      const container = document.getElementById(`qlist-${quizId}`);
      if (!questions.length) {
        container.innerHTML =
          '<div style="font-size:12px; color:#aaa; text-align:center; padding:8px;">No questions created yet.</div>';
        return;
      }
      container.innerHTML = questions.map((q, i) => `
        <div style="display:flex; align-items:flex-start; gap:8px; background:#fff; border:1px solid #eee; border-radius:8px; padding:8px 12px;">
            <div style="width:22px; height:22px; border-radius:50%; background:#e8f5e9; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#025628; flex-shrink:0; margin-top:1px;">
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
                style="font-size:11px; padding:3px 8px; border-radius:6px; background:#FCEBEB; color:#A32D2D; border:none; cursor:pointer; font-family:inherit; font-weight:700; flex-shrink:0;">
                ✕
            </button>
        </div>
      `).join('');
    }

    function addQuestion(quizId) {
      const question = document.getElementById(`qtext-${quizId}`).value.trim();
      const a = document.getElementById(`qa-${quizId}`).value.trim();
      const b = document.getElementById(`qb-${quizId}`).value.trim();
      const c = document.getElementById(`qc-${quizId}`).value.trim();
      const d = document.getElementById(`qd-${quizId}`).value.trim();
      const ans = document.getElementById(`qans-${quizId}`).value;

      if (!question || !a || !b || !c || !d) {
        alert('Please fill in all question fields.');
        return;
      }

      fetch('/admin/quiz-question', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            quiz_id: quizId,
            question,
            choice_a: a,
            choice_b: b,
            choice_c: c,
            choice_d: d,
            correct_answer: ans
          })
        })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            document.getElementById(`qtext-${quizId}`).value = '';
            document.getElementById(`qa-${quizId}`).value = '';
            document.getElementById(`qb-${quizId}`).value = '';
            document.getElementById(`qc-${quizId}`).value = '';
            document.getElementById(`qd-${quizId}`).value = '';
            loadQuizQuestions(quizId);
          }
        })
        .catch(() => alert('An error occurred. Please try again.'));
    }

    function deleteQuestion(id, quizId) {
      if (!confirm('Remove this question?')) return;
      fetch(`/admin/quiz-question/${id}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            _method: 'DELETE'
          })
        })
        .then(r => r.json())
        .then(data => {
          if (data.success) loadQuizQuestions(quizId);
        })
        .catch(() => alert('An error occurred. Please try again.'));
    }

    function toggleSelectCol() {
      const show = document.getElementById('toggleMultiple').checked;
      document.querySelectorAll('.cert-select-col').forEach(el => {
        el.style.display = show ? '' : 'none';
      });
      if (!show) document.getElementById('selectAll').checked = false;
    }

    function toggleSelectAll(cb) {
      document.querySelectorAll('.row-checkbox').forEach(c => c.checked = cb
        .checked);
    }

    function deleteCertRow(btn) {
      if (!confirm('Delete this certificate record?')) return;
      btn.closest('tr').remove();
    }

    function openCertViewModal(name, course, certNo) {
      document.getElementById('certViewName').textContent = name;
      document.getElementById('certViewCourse').textContent = course
        .toUpperCase();
      document.getElementById('certViewNo').textContent = 'CERT. NO.: ' + certNo;
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
      const sel = document.getElementById('issueTraineeSelect');
      const nameEl = document.getElementById('previewName');
      const crsEl = document.getElementById('previewCourse');
      if (!sel || !nameEl) return;
      const rawName = sel.value ? sel.value.split(' (')[0] : '[NAME]';
      const course = sel.value && sel.selectedIndex > 0 ?
        sel.options[sel.selectedIndex].getAttribute('data-course') || '[COURSE]' :
        '[COURSE]';
      nameEl.textContent = rawName.toUpperCase();
      crsEl.textContent = course.toUpperCase();
    }

    function generateCertPDF({
      name,
      course,
      controlNumber,
      dateLabel,
      docType,
      remarks
    }) {
      const {
        jsPDF
      } = window.jspdf;
      const doc = new jsPDF({
        orientation: 'landscape',
        unit: 'mm',
        format: 'a4'
      });
      const W = 297,
        H = 210;

      doc.setFillColor(255, 255, 255);
      doc.rect(0, 0, W, H, 'F');

      doc.setDrawColor(2, 86, 40);
      doc.setLineWidth(4);
      doc.rect(8, 8, W - 16, H - 16);

      doc.setDrawColor(180, 150, 50);
      doc.setLineWidth(1);
      doc.rect(12, 12, W - 24, H - 24);

      doc.setFont('helvetica', 'normal');
      doc.setFontSize(8);
      doc.setTextColor(100, 100, 100);
      doc.text('TECHNICAL EDUCATION AND SKILLS DEVELOPMENT AUTHORITY', W / 2,
        36, {
          align: 'center'
        });

      doc.setFontSize(9);
      doc.setTextColor(60, 60, 60);
      doc.text('CITY GOVERNMENT OF DASMARIÑAS – LEDIPO', W / 2, 43, {
        align: 'center'
      });

      doc.setDrawColor(180, 150, 50);
      doc.setLineWidth(0.8);
      doc.line(55, 47, W - 55, 47);

      doc.setFont('helvetica', 'bold');
      doc.setFontSize(22);
      doc.setTextColor(2, 86, 40);
      doc.text(docType.toUpperCase(), W / 2, 63, {
        align: 'center'
      });

      doc.setFont('helvetica', 'italic');
      doc.setFontSize(10);
      doc.setTextColor(90, 90, 90);
      doc.text('This is to certify that', W / 2, 75, {
        align: 'center'
      });

      doc.setFont('helvetica', 'bold');
      doc.setFontSize(26);
      doc.setTextColor(15, 15, 15);
      doc.text(name.toUpperCase(), W / 2, 91, {
        align: 'center'
      });

      const nameW = doc.getTextWidth(name.toUpperCase());
      doc.setDrawColor(2, 86, 40);
      doc.setLineWidth(0.5);
      doc.line(W / 2 - nameW / 2, 94, W / 2 + nameW / 2, 94);

      doc.setFont('helvetica', 'normal');
      doc.setFontSize(10);
      doc.setTextColor(80, 80, 80);
      doc.text('has successfully completed the training in', W / 2, 105, {
        align: 'center'
      });

      doc.setFont('helvetica', 'bold');
      doc.setFontSize(15);
      doc.setTextColor(2, 86, 40);
      doc.text(course.toUpperCase(), W / 2, 117, {
        align: 'center'
      });

      doc.setFont('helvetica', 'normal');
      doc.setFontSize(9);
      doc.setTextColor(90, 90, 90);
      doc.text(`held on ${dateLabel}`, W / 2, 126, {
        align: 'center'
      });

      if (remarks && remarks.trim()) {
        doc.setFontSize(9);
        doc.setTextColor(110, 110, 110);
        doc.text(`Remarks: ${remarks}`, W / 2, 134, {
          align: 'center'
        });
      }

      if (controlNumber && controlNumber.trim()) {
        doc.setFontSize(8);
        doc.setTextColor(160, 160, 160);
        doc.text(`Control No.: ${controlNumber}`, W - 18, H - 15, {
          align: 'right'
        });
      }

      const sig1X = 80,
        sig2X = W - 80,
        sigY = H - 38;
      doc.setDrawColor(50, 50, 50);
      doc.setLineWidth(0.5);
      doc.line(sig1X - 35, sigY, sig1X + 35, sigY);
      doc.line(sig2X - 35, sigY, sig2X + 35, sigY);

      doc.setFont('helvetica', 'bold');
      doc.setFontSize(9);
      doc.setTextColor(20, 20, 20);
      doc.text('HON. JENNIFER A. BARZAGA', sig1X, sigY + 6, {
        align: 'center'
      });
      doc.text('MR. CARLOS H. LEGASPI', sig2X, sigY + 6, {
        align: 'center'
      });

      doc.setFont('helvetica', 'normal');
      doc.setFontSize(8);
      doc.setTextColor(100, 100, 100);
      doc.text('City Mayor', sig1X, sigY + 11, {
        align: 'center'
      });
      doc.text('LEDIPO Head', sig2X, sigY + 11, {
        align: 'center'
      });

      return doc;
    }

    function saveAndIssueCert() {
      const sel = document.getElementById('issueTraineeSelect');
      const controlNum = document.getElementById('issueControlNum').value.trim();
      const dateInput = document.getElementById('issueDate').value;
      const docType = document.getElementById('issueDocType').value;
      const remarks = document.getElementById('issueRemarks').value.trim();

      if (!sel.value) {
        alert('Please select a trainee first.');
        return;
      }

      const name = sel.value.split(' (')[0];
      const course = sel.options[sel.selectedIndex].getAttribute('data-course') ||
        '';

      const dateLabel = dateInput ?
        new Date(dateInput + 'T12:00:00').toLocaleDateString('en-PH', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        }) :
        new Date().toLocaleDateString('en-PH', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });

      const doc = generateCertPDF({
        name,
        course,
        controlNumber: controlNum,
        dateLabel,
        docType,
        remarks
      });
      const safeName = name.replace(/[^a-zA-Z0-9]/g, '_');
      doc.save(`LEDIPO_Certificate_${safeName}.pdf`);

      addCertTableRow(name, course, dateLabel, controlNum);
      closeIssueCertModal();
      alert('Certificate issued and downloaded successfully!');
    }

    function downloadExistingCert() {
      const name = document.getElementById('certViewName').textContent;
      const course = document.getElementById('certViewCourse').textContent;
      const certNo = document.getElementById('certViewNo').textContent.replace(
        'CERT. NO.: ', '');

      const dateLabel = new Date().toLocaleDateString('en-PH', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });

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

    function toggleCourseAccordion(courseId) {
      const body = document.getElementById(`accordion-body-${courseId}`);
      const chevron = document.getElementById(`chevron-${courseId}`);

      if (body.style.display === 'none' || body.style.display === '') {
        body.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
      } else {
        body.style.display = 'none';
        chevron.style.transform = 'rotate(0deg)';
      }
    }

    function toggleCourseTrainees(courseId) {
      const listEl = document.getElementById('trainee-list-' + courseId);
      if (listEl) {
        if (listEl.style.display === 'none' || listEl.style.display === '') {
          listEl.style.display = 'flex';
        } else {
          listEl.style.display = 'none';
        }
      }
    }

    function openFullCourseRoster(courseTitle, trainees) {
      document.getElementById('course-cards-main-view').style.display = 'none';
      document.getElementById('full-course-roster-view').style.display = 'block';

      document.getElementById('rosterCourseTitle').textContent = courseTitle +
        " - Enrolled Trainees";
      document.getElementById('rosterCountBadge').textContent = trainees.length +
        " Enrolled";

      const container = document.getElementById('fullRosterContainer');

      if (!trainees || trainees.length === 0) {
        container.innerHTML = `
            <div style="text-align: center; color: #aaa; padding: 40px 0; font-size: 13px; font-style: italic;">
                <i class="fa-solid fa-users-slash" style="font-size: 28px; display: block; margin-bottom: 8px; color: #ccc;"></i>
                No trainees enrolled in this course yet.
            </div>`;
      } else {
        let html = `
            <div style="display: flex; align-items: center; justify-content: space-between; background: #e8f5e9; padding: 10px 16px; border-radius: 8px; font-size: 12px; font-weight: 700; color: #025628; margin-bottom: 4px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" id="selectAllTrainees" onclick="toggleSelectAllTrainees(this)" style="width: 16px; height: 16px; accent-color: #025628; cursor: pointer;">
                    Select All Trainees
                </label>
                <span id="selectedCountLabel">0 selected</span>
            </div>
        `;

        html += trainees.map(t => {
          const firstName = t.firstname || '';
          const lastName = t.lastname || '';
          const fullName = (firstName + ' ' + lastName).trim()
            .toUpperCase() || 'UNKNOWN TRAINEE';
          const initials = ((firstName[0] || '') + (lastName[0] || ''))
            .toUpperCase() || 'TR';
          const email = t.email || 'No email provided';

          const status = t.status || 'Active';
          const statusBg = status.toLowerCase() === 'active' ? '#e8f5e9' :
            '#fff8e1';
          const statusColor = status.toLowerCase() === 'active' ? '#025628' :
            '#854F0B';
          const safeEmailId = email.replace(/[^a-zA-Z0-9]/g, '_');

          return `
            <div id="roster-row-${safeEmailId}" style="display: flex; justify-content: space-between; align-items: center; background: #f9f9f9; padding: 12px 16px; border-radius: 8px; border: 1px solid #eee;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <input type="checkbox" class="roster-checkbox" onclick="updateSelectedCount()" style="width: 16px; height: 16px; accent-color: #025628; cursor: pointer;">
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: #e8f5e9; display: flex; align-items: center; justify-content: center; color: #025628; font-weight: 700; font-size: 12px; flex-shrink: 0;">
                        ${initials}
                    </div>
                    <div>
                        <strong style="color: #1a1a1a; display: block; font-size: 13px;">${fullName}</strong>
                        <small style="color: #888; font-size: 12px;">${email}</small>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span class="roster-status-badge" data-email="${email}" style="font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px; background: ${statusBg}; color: ${statusColor};">
                        ${status}
                    </span>
                    <button class="btn-view" onclick="openUserModal(
                    '${addslashes(fullName)}',
                    '${addslashes(email)}',
                    'student',
                    '${addslashes(status)}'
                )">View Profile</button>
                </div>
            </div>
          `;
        }).join('');

        container.innerHTML = html;
      }
    }

    function toggleSelectAllTrainees(masterCheckbox) {
      const checkboxes = document.querySelectorAll('.roster-checkbox');
      checkboxes.forEach(cb => cb.checked = masterCheckbox.checked);
      updateSelectedCount();
    }

    function updateSelectedCount() {
      const checkboxes = document.querySelectorAll('.roster-checkbox');
      const checkedCount = document.querySelectorAll('.roster-checkbox:checked')
        .length;
      const label = document.getElementById('selectedCountLabel');
      if (label) {
        label.textContent = checkedCount + " selected";
      }
      const master = document.getElementById('selectAllTrainees');
      if (master) {
        master.checked = checkboxes.length > 0 && checkedCount === checkboxes
          .length;
        master.indeterminate = checkedCount > 0 && checkedCount < checkboxes
          .length;
      }
    }

    function backToCourseCards() {
      document.getElementById('full-course-roster-view').style.display = 'none';
      document.getElementById('course-cards-main-view').style.display = 'block';
    }

    function addslashes(str) {
      return String(str).replace(/['"]/g, '\\$&');
    }

    document.getElementById('userForm').onsubmit = function(e) {
      e.preventDefault();

      const name = document.getElementById('editUserName').value.trim();
      const email = document.getElementById('editUserEmail').value.trim();
      const status = document.getElementById('editUserStatus').value;
      const remarks = document.getElementById('editUserRemarks').value.trim();
      const role = document.getElementById('hiddenUserRole').value || document
        .getElementById('editUserRole').value;

      fetch(`/admin/user/update`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            name,
            email,
            status,
            remarks,
            role
          })
        })
        .then(async r => {
          const text = await r.text();
          try {
            return JSON.parse(text);
          } catch (err) {
            console.error("Server response was not JSON:", text);
            throw new Error("Server returned an invalid response.");
          }
        })
        .then(data => {
          if (data.success) {
            const statusBadge = document.querySelector(
              `.roster-status-badge[data-email="${email}"]`);

            if (statusBadge) {
              statusBadge.textContent = status;

              if (status.toLowerCase() === 'active') {
                statusBadge.style.background = '#e8f5e9';
                statusBadge.style.color = '#025628';
              } else if (status.toLowerCase() === 'inactive') {
                statusBadge.style.background = '#FCEBEB';
                statusBadge.style.color = '#A32D2D';
              } else {
                statusBadge.style.background = '#fff8e1';
                statusBadge.style.color = '#854F0B';
              }
            }

            alert('User profile updated successfully!');
            closeUserModal();
          } else {
            alert(data.message || 'An error occurred while updating.');
          }
        })
        .catch(err => {
          console.error(err);
          alert('An error occurred while updating. Please try again.');
        });
    };

    function togglePassword() {
      const passwordInput = document.getElementById('newTrainerPass');
      const icon = document.getElementById('togglePasswordIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    function closeUserModal() {
      const modal = document.getElementById('userModal');
      if (modal) {
        modal.style.display = 'none';
        modal.style.setProperty('display', 'none', 'important');
      }
    }

    function filterCourses() {
      const searchVal = document.getElementById('searchCourseInput').value
        .toLowerCase().trim();
      const cards = document.querySelectorAll('#coursesGrid .course-card');
      let visibleCount = 0;

      cards.forEach(card => {
        const title = card.getAttribute('data-title') || '';
        const code = card.getAttribute('data-code') || '';

        const matchesSearch = title.includes(searchVal) || code.includes(
          searchVal);

        if (matchesSearch) {
          card.style.display = '';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      const noResults = document.getElementById('noFilterResults');
      if (noResults) {
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
      }
    }

    function showModuleAlert(message, isError = false) {
      const alertEl = document.getElementById('moduleAlert');
      if (!alertEl) return;
      alertEl.style.display = 'block';
      alertEl.style.background = isError ? '#FCEBEB' : '#E8F5E9';
      alertEl.style.color = isError ? '#A32D2D' : '#025628';
      alertEl.style.border = isError ? '1px solid #F7C6C6' : '1px solid #C8E6C9';
      alertEl.textContent = message;
      setTimeout(() => {
        alertEl.style.display = 'none';
      }, 4000);
    }

    function updateCourseCardCounts() {
      if (typeof _contentCourseId === 'undefined' || !_contentCourseId) return;

      const validModules = Array.isArray(_contentModules) ? _contentModules
        .filter(Boolean) : [];
      const validQuizzes = Array.isArray(_contentQuizzes) ? _contentQuizzes
        .filter(Boolean) : [];

      const modCountEl = document.getElementById(
        `course-module-count-${_contentCourseId}`);
      const modLabelEl = document.getElementById(
        `course-module-label-${_contentCourseId}`);
      if (modCountEl) {
        modCountEl.textContent = validModules.length;
        if (modLabelEl) {
          modLabelEl.textContent = validModules.length === 1 ? 'Module' :
            'Modules';
        }
      }

      const quizCountEl = document.getElementById(
        `course-quiz-count-${_contentCourseId}`);
      const quizLabelEl = document.getElementById(
        `course-quiz-label-${_contentCourseId}`);
      if (quizCountEl) {
        quizCountEl.textContent = validQuizzes.length;
        if (quizLabelEl) {
          quizLabelEl.textContent = validQuizzes.length === 1 ? 'Quiz' :
            'Quizzes';
        }
      }
    }

    function filterFacilities() {
      const query = document.getElementById('searchFacilityInput').value
        .toLowerCase().trim();
      const cards = document.querySelectorAll('#facilityGrid .facility-card');

      cards.forEach(card => {
        const name = card.getAttribute('data-name') || '';
        const location = card.getAttribute('data-location') || '';
        const match = name.includes(query) || location.includes(query);
        card.style.display = match ? 'flex' : 'none';
      });
    }

    function updateCourseBadgeCount() {
      const selectedCount = document.querySelectorAll(
        '.facility-course-cb:checked').length;
      const badge = document.getElementById('selectedCourseBadge');
      if (badge) {
        badge.innerText = `${selectedCount} Selected`;
      }
    }

    function toggleSelectAllCourses() {
      const checkboxes = document.querySelectorAll('.facility-course-cb');
      const allChecked = Array.from(checkboxes).every(cb => cb.checked);

      checkboxes.forEach(cb => {
        cb.checked = !allChecked;
      });

      updateCourseBadgeCount();
    }

    function filterAnnouncements() {
      const searchVal = document.getElementById('annSearchInput')?.value
        .toLowerCase().trim() || '';
      const typeVal = document.getElementById('annTypeFilter')?.value
      .toLowerCase() || '';
      const statusVal = document.getElementById('annStatusFilter')?.value
        .toLowerCase() || '';

      const items = document.querySelectorAll('#view-announcements .user-item');

      items.forEach(item => {
        const titleText = item.querySelector('.ann-title-text')?.textContent
          .toLowerCase() || '';
        const msgText = item.querySelector('.ann-msg-text')?.textContent
          .toLowerCase() || '';

        const itemType = item.getAttribute('data-type') || '';
        const itemStatus = item.getAttribute('data-status') || '';

        const matchesSearch = searchVal === '' || titleText.includes(
          searchVal) || msgText.includes(searchVal);
        const matchesType = typeVal === '' || itemType === typeVal;
        const matchesStatus = statusVal === '' || itemStatus === statusVal;

        if (matchesSearch && matchesType && matchesStatus) {
          item.style.setProperty('display', 'flex', 'important');
        } else {
          item.style.setProperty('display', 'none', 'important');
        }
      });
    }
  </script>
</body>

</html>

