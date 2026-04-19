@extends('student.layout')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/homepage.css') }}">
@endsection

@section('content')
<div class="Homepage_wrap">


    <div class="Top_row">

        <div class="Welcome_card">
            <h2>Hello, {{ Auth::user()->firstname }}! 👋</h2>
            <div class="welcome-date">{{ now()->format('l, F d, Y') }} · LEDIPO</div>
            <div class="welcome-stats">
                <div class="wstat">
                    <div class="wstat-num">{{ $enrollment ? ucfirst($enrollment->status) : 'None' }}</div>
                    <div class="wstat-lbl">Status</div>
                </div>
                <div class="wstat">
                    <div class="wstat-num">{{ $enrollment ? ($enrollment->progress ?? 0) . '%' : '0%' }}</div>
                    <div class="wstat-lbl">Progress</div>
                </div>
                <div class="wstat">
                    <div class="wstat-num">{{ $upcomingDeadlines }}</div>
                    <div class="wstat-lbl">Deadlines</div>
                </div>
            </div>
        </div>

        <div class="schedule-card">
            <div class="scard-title">📅 Today's Schedule</div>
            @if($enrollment && $enrollment->course)
                <div class="sched-row">
                    <div class="sched-time">{{ $enrollment->course->schedule }}</div>
                    <div class="sched-info">
                        <div class="sched-name">{{ $enrollment->course->title }}</div>
                        <div class="sched-loc">📍 {{ $enrollment->course->location }}</div>
                    </div>
                </div>
            @else
                <div class="no-sched">No active course today.</div>
            @endif
        </div>

    </div>

    <div class="sec">
        <div class="sec-title">📢 Announcements</div>
        <div class="announce-list">
            @forelse($announcements as $announcement)
                @php
                    $type = $announcement->type ?? 'reminder';
                    if ($type === 'urgent') {
                        $dotColor  = '#A32D2D';
                        $badgeClass = 'b-red';
                        $badgeLabel = 'Urgent';
                    } elseif ($type === 'notice') {
                        $dotColor  = '#854F0B';
                        $badgeClass = 'b-yellow';
                        $badgeLabel = 'Notice';
                    } else {
                        $dotColor  = '#3B6D11';
                        $badgeClass = 'b-green';
                        $badgeLabel = 'Reminder';
                    }
                @endphp
                <div class="an-item">
                    <div class="an-dot" style="background: {{ $dotColor }}"></div>
                    <div class="an-info">
                        <div class="an-title">{{ $announcement->title }}</div>
                        <div class="an-desc">{{ $announcement->message }}</div>
                    </div>
                    <span class="an-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                </div>
            @empty
                <div class="empty-state">
                    <p>No announcements at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>

    
    <div class="sec">
        <div class="sec-title">📖 My Current Course</div>
        @if($enrollment && $enrollment->course)
            <div class="course-card">
                <div class="course-top">
                    <div class="course-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div>
                        <div class="course-name">{{ $enrollment->course->title }}</div>
                        <span class="course-badge">{{ $enrollment->course->sector }}</span>
                    </div>
                </div>
                <div class="course-meta-row">
                    <div class="cmeta">
                        <div class="cmeta-label">Duration</div>
                        <div class="cmeta-val">{{ $enrollment->course->duration }}</div>
                    </div>
                    <div class="cmeta">
                        <div class="cmeta-label">Schedule</div>
                        <div class="cmeta-val">{{ $enrollment->course->schedule }}</div>
                    </div>
                    <div class="cmeta">
                        <div class="cmeta-label">Slots left</div>
                        <div class="cmeta-val">{{ $enrollment->course->slots }}</div>
                    </div>
                </div>
                <div class="progress-label">
                    <span>Overall Progress</span>
                    <span>{{ $enrollment->progress ?? 0 }}%</span>
                </div>
                <div class="pbar">
                    <div class="pfill" style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                </div>
                @if(isset($enrollment->course->trainer))
                    <div class="course-instructor">
                        👤 Trainer: <strong>{{ $enrollment->course->trainer->firstname }} {{ $enrollment->course->trainer->lastname }}</strong>
                    </div>
                @endif
                <a href="{{ route('course.detail', $enrollment->course->id) }}" class="course-view-btn">
                    View Course Details
                </a>
            </div>
        @else
            <div class="no-course">
                <p>You are not enrolled in any course yet.</p>
                <a href="{{ route('all.courses') }}" class="enroll-btn">Browse Courses</a>
            </div>
        @endif
    </div>

    {{-- MODULE MATERIALS --}}
    <div class="sec" id="modules">
        <div class="sec-title">📦 Module Materials</div>
        @if($enrollment && isset($modules) && $modules->count() > 0)
            <div class="mod-list">
                @foreach($modules as $module)
                    @php
                        $ext = strtolower(pathinfo($module->file_path, PATHINFO_EXTENSION));
                        if ($ext === 'pdf') {
                            $iconClass = 'mod-pdf';
                            $icon = '📄';
                        } elseif (in_array($ext, ['doc', 'docx'])) {
                            $iconClass = 'mod-doc';
                            $icon = '📝';
                        } else {
                            $iconClass = 'mod-vid';
                            $icon = '🎬';
                        }
                    @endphp
                    <div class="mod-item">
                        <div class="mod-icon {{ $iconClass }}">{{ $icon }}</div>
                        <div class="mod-info">
                            <div class="mod-title">{{ $module->title }}</div>
                            <div class="mod-sub">{{ strtoupper($ext) }} · {{ $enrollment->course->title }}</div>
                        </div>
                        <a href="{{ asset('storage/' . $module->file_path) }}" download class="mod-btn">
                            ⬇ Download
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>No modules available yet.</p>
            </div>
        @endif
    </div>

    {{-- TRAINING LOCATION --}}
    <div class="sec" id="location">
        <div class="sec-title">📍 Training Location</div>
        @if($enrollment && $enrollment->course)
            <div class="loc-card">
                <div class="loc-map">
                    🗺️ {{ $enrollment->course->location }}
                </div>
                <div class="loc-body">
                    <div class="loc-name">{{ $enrollment->course->title }}</div>
                    <div class="loc-addr">📍 {{ $enrollment->course->location }}</div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <p>No location available. Enroll in a course first.</p>
            </div>
        @endif
    </div>

</div>
@endsection