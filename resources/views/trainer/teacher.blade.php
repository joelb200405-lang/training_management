@extends('trainer.layout')

@section('title', 'Dashboard')

@section('css')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
/* ── Dashboard page padding ───────────────────────────────── */
.db-wrap {
    padding: 28px 28px;
}

.db-page-title {
    font-size: 20px;
    font-weight: 700;
    color: #025628;
    margin-bottom: 6px;
}

.db-page-sub {
    font-size: 13px;
    color: #aaa;
    margin-bottom: 22px;
}

/* ── Stat cards ───────────────────────────────────────────── */
.db-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 22px;
}

.db-stat-card {
    background: #fff;
    border: 1px solid #e8ede9;
    border-radius: 12px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}

.db-stat-icon {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    background: #e8f5e9;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.db-stat-icon i {
    font-size: 18px;
    color: #025628;
}

.db-stat-label {
    font-size: 11px;
    color: #aaa;
    margin-bottom: 3px;
}

.db-stat-value {
    font-size: 26px;
    font-weight: 700;
    color: #025628;
    line-height: 1;
}

/* ── Bottom grid: course card + recent students ───────────── */
.db-bottom-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 16px;
}

.db-card {
    background: #fff;
    border: 1px solid #e8ede9;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}

.db-card-title {
    font-size: 14px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 14px;
}

/* ── Assigned course card ─────────────────────────────────── */
.db-course-thumb {
    height: 70px;
    background: #025628;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 12px;
}

.db-course-thumb i {
    font-size: 26px;
    color: rgba(255,255,255,0.2);
}

.db-course-sector {
    position: absolute;
    top: 8px;
    left: 10px;
    background: #F7EE17;
    color: #013d1c;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 9px;
    border-radius: 20px;
}

.db-course-name {
    font-size: 14px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 10px;
}

.db-course-meta {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-bottom: 14px;
}

.db-course-meta-item {
    font-size: 12px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 7px;
}

.db-course-meta-item i {
    color: #025628;
    width: 12px;
    font-size: 11px;
}

.db-progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: #aaa;
    margin-bottom: 5px;
}

.db-progress-bg {
    height: 5px;
    background: #e8f5e9;
    border-radius: 3px;
    overflow: hidden;
}

.db-progress-fill {
    height: 100%;
    background: #025628;
    border-radius: 3px;
}

/* ── Recent students table ────────────────────────────────── */
.db-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.db-table th {
    background: #f5f5f3;
    padding: 9px 14px;
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #e8ede9;
}

.db-table td {
    padding: 10px 14px;
    border-bottom: 1px solid #f0f4f0;
    color: #1a1a1a;
    vertical-align: middle;
}

.db-table tr:last-child td { border-bottom: none; }
.db-table tbody tr:hover   { background: #fafcfa; }

.db-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #e8f5e9;
    color: #025628;
    font-size: 10px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.db-name-cell {
    display: flex;
    align-items: center;
    gap: 8px;
}

.db-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
}

.db-badge.enrolled  { background: #e8f5e9; color: #025628; }
.db-badge.pending   { background: #FAEEDA; color: #633806; }
.db-badge.completed { background: #EAF3DE; color: #27500A; }
.db-badge.dropped   { background: #FCEBEB; color: #791F1F; }

/* ── Responsive ───────────────────────────────────────────── */
@media (max-width: 900px) {
    .db-stats-grid  { grid-template-columns: 1fr 1fr; }
    .db-bottom-grid { grid-template-columns: 1fr; }
}

@media (max-width: 540px) {
    .db-stats-grid { grid-template-columns: 1fr; }
    .db-wrap       { padding: 18px 16px; }
}
</style>
@endsection

@section('content')
<div class="db-wrap">

    <div class="db-page-title">Dashboard</div>
    <div class="db-page-sub">Welcome back, {{ Auth::user()->firstname }}! Here's your overview.</div>

    {{-- ── STAT CARDS ─────────────────────────────────────────── --}}
    <div class="db-stats-grid">

        <div class="db-stat-card">
            <div class="db-stat-icon"><i class="fa fa-users"></i></div>
            <div>
                <div class="db-stat-label">Total Students</div>
                <div class="db-stat-value">{{ $totalStudents ?? 0 }}</div>
            </div>
        </div>

        <div class="db-stat-card">
            <div class="db-stat-icon"><i class="fa fa-book-open"></i></div>
            <div>
                <div class="db-stat-label">Active Courses</div>
                <div class="db-stat-value">{{ $totalCourses ?? 0 }}</div>
            </div>
        </div>

        <div class="db-stat-card">
            <div class="db-stat-icon"><i class="fa fa-chart-line"></i></div>
            <div>
                <div class="db-stat-label">Completion Rate</div>
                <div class="db-stat-value">{{ $completionRate ?? 0 }}%</div>
            </div>
        </div>

    </div>

    {{-- ── BOTTOM: MY COURSE + RECENT STUDENTS ────────────────── --}}
    <div class="db-bottom-grid">

        {{-- Assigned Course --}}
        <div class="db-card">
            <div class="db-card-title">My Course</div>

            @if($course ?? null)
            <div class="db-course-thumb">
                <i class="fa fa-book"></i>
                <span class="db-course-sector">{{ $course->sector ?? 'General' }}</span>
            </div>

            <div class="db-course-name">{{ $course->title }}</div>

            <div class="db-course-meta">
                <div class="db-course-meta-item">
                    <i class="fa fa-users"></i>
                    {{ $totalStudents ?? 0 }} students enrolled
                </div>
                <div class="db-course-meta-item">
                    <i class="fa fa-calendar-alt"></i>
                    {{ $course->schedule ?? 'TBA' }}
                </div>
                <div class="db-course-meta-item">
                    <i class="fa fa-clock"></i>
                    {{ $course->duration ?? 'TBA' }}
                </div>
                <div class="db-course-meta-item">
                    <i class="fa fa-location-dot"></i>
                    {{ Str::limit($course->location ?? 'TBA', 35) }}
                </div>
            </div>

            @php $progress = $course->progress ?? 0; @endphp
            <div class="db-progress-label">
                <span>Progress</span>
                <span>{{ $progress }}%</span>
            </div>
            <div class="db-progress-bg">
                <div class="db-progress-fill" style="width: {{ $progress }}%"></div>
            </div>

            @else
            <div style="text-align:center;padding:32px 0;color:#aaa;">
                <i class="fa fa-book-open" style="font-size:28px;opacity:0.3;display:block;margin-bottom:8px;"></i>
                <p style="font-size:13px;">No course assigned yet.</p>
            </div>
            @endif
        </div>

        {{-- Recent Students --}}
        <div class="db-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                <div class="db-card-title" style="margin-bottom:0;">Recent Students</div>
                <a href="{{ route('trainer.students') }}"
                   style="font-size:12px;color:#025628;font-weight:600;text-decoration:none;">
                    See all →
                </a>
            </div>

            <table class="db-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Barangay</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentStudents ?? [] as $student)
                    @php
                        $status = strtolower($student->pivot->status ?? 'pending');
                        $cls    = in_array($status, ['enrolled','pending','completed','dropped']) ? $status : 'pending';
                        $initials = strtoupper(substr($student->firstname ?? '', 0, 1))
                                  . strtoupper(substr($student->lastname  ?? '', 0, 1));
                    @endphp
                    <tr>
                        <td>
                            <div class="db-name-cell">
                                <div class="db-avatar">{{ $initials }}</div>
                                <div>
                                    <div style="font-weight:600;">{{ $student->firstname }} {{ $student->lastname }}</div>
                                    <div style="font-size:11px;color:#aaa;">{{ $student->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $student->barangay ?? '—' }}</td>
                        <td><span class="db-badge {{ $cls }}">{{ ucfirst($cls) }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center;padding:32px;color:#aaa;">
                            <i class="fa fa-users" style="font-size:24px;opacity:0.3;display:block;margin-bottom:8px;"></i>
                            No students yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection