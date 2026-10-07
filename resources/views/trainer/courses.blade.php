@extends('trainer.layout')

@section('title', 'My Courses')

@section('css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    /* ── Page wrap ────────────────────────────────────────────── */
    .mc-wrap {
      padding: 28px;
    }

    .mc-page-title {
      font-size: 20px;
      font-weight: 700;
      color: #025628;
      margin-bottom: 6px;
    }

    .mc-page-sub {
      font-size: 13px;
      color: #aaa;
      margin-bottom: 24px;
    }

    /* ── Course card ──────────────────────────────────────────── */
    .mc-course-card {
      background: #fff;
      border: 2px solid #7fb092;
      border-radius: 12px;
      overflow: hidden;
      max-width: 340px;
      position: relative;
    }

    .mc-thumb {
      width: 100%;
      height: 180px;
      object-fit: cover;
      display: block;
    }

    .mc-thumb-fallback {
      width: 100%;
      height: 180px;
      background: #025628;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .mc-thumb-fallback i {
      font-size: 60px;
      color: rgba(255, 255, 255, 0.2);
    }

    .mc-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #025628;
      color: #fff;
      padding: 2px 10px;
      font-size: 11px;
      font-weight: 700;
      border-radius: 20px;
    }

    .mc-badge.inactive {
      background: #aaa;
    }

    .mc-card-body {
      padding: 20px;
      text-align: center;
    }

    .mc-card-title {
      font-size: 16px;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 14px;
    }

    .mc-card-meta {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 14px;
      text-align: left;
    }

    .mc-card-meta p {
      font-size: 13px;
      color: #555;
      display: flex;
      align-items: center;
      gap: 8px;
      margin: 0;
    }

    .mc-card-meta i {
      color: #025628;
      width: 14px;
      font-size: 13px;
    }

    .mc-trainer-row {
      font-size: 12px;
      font-weight: 600;
      color: #025628;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      margin-bottom: 14px;
    }

    .mc-progress-bg {
      background: #eee;
      height: 8px;
      border-radius: 10px;
      margin-bottom: 16px;
      overflow: hidden;
    }

    .mc-progress-fill {
      background: #025628;
      height: 100%;
    }

    .mc-btn-row {
      display: flex;
      gap: 8px;
    }

    .mc-btn {
      flex: 1;
      padding: 10px;
      border-radius: 5px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      border: none;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      transition: background 0.2s;
    }

    .mc-btn.primary {
      background: #025628;
      color: #fff;
    }

    .mc-btn.primary:hover {
      background: #013d1c;
      color: #fff;
    }

    /* ── MODALS ───────────────────────────────────────────────── */
    .mc-modal {
      display: none;
      position: fixed;
      z-index: 3000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
    }

    .mc-modal-content {
      background: #fff;
      margin: 4% auto;
      border-radius: 14px;
      width: 90%;
      max-width: 560px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      animation: mcModalIn 0.25s ease;
    }

    @keyframes mcModalIn {
      from {
        transform: translateY(-24px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .mc-modal-header {
      background: #fcfcfc;
      padding: 18px 24px;
      border-bottom: 1px solid #eee;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .mc-modal-header h3 {
      color: #025628;
      margin: 0;
      font-size: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .mc-close {
      font-size: 22px;
      color: #aaa;
      cursor: pointer;
      line-height: 1;
    }

    .mc-close:hover {
      color: #d9534f;
    }

    .mc-modal-body {
      padding: 24px;
      overflow-y: auto;
      flex: 1;
    }

    .mc-modal-footer {
      padding: 16px 24px;
      background: #fcfcfc;
      border-top: 1px solid #eee;
      display: flex;
      justify-content: flex-end;
    }

    .mc-btn-close {
      background: transparent;
      border: none;
      color: #777;
      font-weight: 600;
      cursor: pointer;
      font-size: 13px;
    }

    /* ── Course Details modal rows ────────────────────────────── */
    .mc-detail-row {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 12px 0;
      border-bottom: 1px solid #f0f4f0;
    }

    .mc-detail-row:last-child {
      border-bottom: none;
    }

    .mc-detail-icon {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      background: #e8f5e9;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .mc-detail-icon i {
      font-size: 14px;
      color: #025628;
    }

    .mc-detail-label {
      font-size: 11px;
      color: #aaa;
      margin-bottom: 2px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .mc-detail-value {
      font-size: 14px;
      color: #1a1a1a;
      font-weight: 500;
    }

    /* Empty state */
    .mc-empty {
      text-align: center;
      padding: 60px 24px;
      color: #aaa;
    }

    .mc-empty i {
      font-size: 48px;
      opacity: 0.3;
      display: block;
      margin-bottom: 14px;
      color: #025628;
    }

    .mc-empty p {
      font-size: 14px;
    }
  </style>
@endsection

@section('content')
  <div class="mc-wrap">

    <div class="mc-page-title">My Courses</div>
    <div class="mc-page-sub">Your assigned training course.</div>

    @if ($course)
      <div class="mc-course-card">

        <div class="mc-badge {{ $course->status === 'active' ? '' : 'inactive' }}">
          {{ ucfirst($course->status ?? 'Active') }}
        </div>

        @if ($course->thumbnail)
          <img src="{{ asset('storage/' . $course->thumbnail) }}"
            alt="{{ $course->title }}" class="mc-thumb">
        @else
          <div class="mc-thumb-fallback">
            <i class="fa fa-book"></i>
          </div>
        @endif

        <div class="mc-card-body">
          <div class="mc-card-title">{{ $course->title }}</div>

          <div class="mc-card-meta">
            <p><i class="fa fa-calendar-day"></i> Duration:
              {{ $course->duration ?? 'TBA' }}</p>
            <p><i class="fa fa-users"></i> Slots:
              {{ $totalStudents }}/{{ $course->slots ?? '—' }}</p>
            <p><i class="fa fa-clock"></i> Schedule:
              {{ $course->schedule ?? 'TBA' }}</p>
            <p><i class="fa fa-location-dot"></i>
              {{ Str::limit($course->location ?? 'TBA', 38) }}</p>
          </div>

          <div class="mc-trainer-row">
            <i class="fa fa-chalkboard-user"></i>
            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
          </div>

          <div class="mc-progress-bg">
            <div class="mc-progress-fill"
              style="width: {{ $course->progress ?? 0 }}%"></div>
          </div>

          <div class="mc-btn-row">
            <a href="{{ route('trainer.course.preview', $course->id) }}"
              class="mc-btn primary" style="text-decoration:none;">
              Course Details
            </a>
          </div>
        </div>
      </div>
    @else
      <div class="mc-empty">
        <i class="fa fa-book-open"></i>
        <p>No course assigned to you yet.<br>Please contact the administrator.</p>
      </div>
    @endif

  </div>

  {{-- ============================================================
      MODAL 1: Course Details (read-only)
      ============================================================ --}}
  <div id="courseDetailsModal" class="mc-modal">
    <div class="mc-modal-content">
      <div class="mc-modal-header">
        <h3><i class="fa fa-book-open"></i> Course Details</h3>
        <span class="mc-close" onclick="closeCourseDetails()">&times;</span>
      </div>
      <div class="mc-modal-body">
        <div class="mc-detail-row">
          <div class="mc-detail-icon"><i class="fa fa-bookmark"></i></div>
          <div>
            <div class="mc-detail-label">Course Title</div>
            <div class="mc-detail-value" id="cd-title"></div>
          </div>
        </div>
        <div class="mc-detail-row">
          <div class="mc-detail-icon"><i class="fa fa-align-left"></i></div>
          <div style="flex:1;">
            <div class="mc-detail-label">Description</div>
            <textarea id="cd-description-input" rows="3"
              placeholder="Write a short description trainees will see"
              style="width:100%;font-size:13px;color:#333;font-family:inherit;border:1px solid #ddd;border-radius:8px;padding:8px 10px;resize:vertical;margin-top:4px;"></textarea>
          </div>
        </div>
        <div class="mc-detail-row">
          <div class="mc-detail-icon"><i class="fa fa-tag"></i></div>
          <div>
            <div class="mc-detail-label">Sector</div>
            <div class="mc-detail-value" id="cd-sector"></div>
          </div>
        </div>
        <div class="mc-detail-row">
          <div class="mc-detail-icon"><i class="fa fa-calendar-day"></i></div>
          <div>
            <div class="mc-detail-label">Duration</div>
            <div class="mc-detail-value" id="cd-duration"></div>
          </div>
        </div>
        <div class="mc-detail-row">
          <div class="mc-detail-icon"><i class="fa fa-clock"></i></div>
          <div>
            <div class="mc-detail-label">Schedule</div>
            <div class="mc-detail-value" id="cd-schedule"></div>
          </div>
        </div>
        <div class="mc-detail-row">
          <div class="mc-detail-icon"><i class="fa fa-users"></i></div>
          <div>
            <div class="mc-detail-label">Slots</div>
            <div class="mc-detail-value" id="cd-slots"></div>
          </div>
        </div>
        <div class="mc-detail-row">
          <div class="mc-detail-icon"><i class="fa fa-location-dot"></i></div>
          <div>
            <div class="mc-detail-label">Location</div>
            <div class="mc-detail-value" id="cd-location"></div>
          </div>
        </div>
        <div class="mc-detail-row">
          <div class="mc-detail-icon"><i class="fa fa-circle-check"></i></div>
          <div>
            <div class="mc-detail-label">Status</div>
            <div class="mc-detail-value" id="cd-status"></div>
          </div>
        </div>
      </div>
      <div class="mc-modal-footer">
        <button class="mc-btn-close" onclick="closeCourseDetails()">Close</button>
        <button onclick="saveDescription()"
          style="background:#025628;color:#fff;border:none;border-radius:8px;padding:9px 18px;font-size:13px;font-weight:700;cursor:pointer;margin-left:8px;">
          Save
        </button>
      </div>
    </div>
  </div>

  {{-- ============================================================
      MODAL: Custom Alert Card (replaces native alert())
      ============================================================ --}}
  <div id="mcAlertModal" class="mc-modal">
    <div class="mc-modal-content" style="max-width:380px;">
      <div class="mc-modal-header">
        <h3><i class="fa fa-circle-info"></i> Notice</h3>
        <span class="mc-close" onclick="closeAlertModal()">&times;</span>
      </div>
      <div class="mc-modal-body" style="text-align:center; padding:24px;">
        <p id="mcAlertMessage" style="font-size:14px; color:#333; margin:0;">
        </p>
      </div>
      <div class="mc-modal-footer" style="justify-content:center;">
        <button onclick="closeAlertModal()"
          style="background:#025628;color:#fff;border:none;border-radius:8px;padding:9px 24px;font-size:13px;font-weight:700;cursor:pointer;">
          OK
        </button>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')
      .getAttribute('content');

    // ── COURSE DETAILS MODAL ───────────────────────────────────────────────────
    function openCourseDetails(id, title, description, duration, slots, schedule,
      location, sector, status) {
      document.getElementById('cd-title').textContent = title;
      document.getElementById('cd-description-input').value = description || '';
      document.getElementById('cd-sector').textContent = sector || '—';
      document.getElementById('cd-duration').textContent = duration || '—';
      document.getElementById('cd-schedule').textContent = schedule || '—';
      document.getElementById('cd-slots').textContent = slots || '—';
      document.getElementById('cd-location').textContent = location || '—';
      document.getElementById('cd-status').textContent = status || '—';
      document.getElementById('courseDetailsModal').style.display = 'block';

      window._currentDetailsCourseId = id;
    }

    function saveDescription() {
      const newDescription = document.getElementById('cd-description-input')
      .value;
      const courseId = window._currentDetailsCourseId;

      fetch(`/trainer/course/${courseId}/description`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            description: newDescription
          })
        })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            showAlert('Description updated!');
            closeCourseDetails();
          }
        })
        .catch(() => showAlert('Something went wrong. Please try again.'));
    }

    function closeCourseDetails() {
      document.getElementById('courseDetailsModal').style.display = 'none';
    }

    function showAlert(message) {
      document.getElementById('mcAlertMessage').textContent = message;
      document.getElementById('mcAlertModal').style.display = 'block';
    }

    function closeAlertModal() {
      document.getElementById('mcAlertModal').style.display = 'none';
    }

    // ── CLOSE ON OUTSIDE CLICK ─────────────────────────────────────────────────
    window.addEventListener('click', function(e) {
      if (e.target.id === 'courseDetailsModal') closeCourseDetails();
    });
  </script>
@endsection
