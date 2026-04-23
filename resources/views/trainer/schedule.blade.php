{{-- resources/views/trainer/schedule.blade.php --}}

@extends('trainer.layout')

@section('title', 'Schedule')

@section('css')
<style>
/* ── Schedule page ───────────────────────────────────────── */
.sc-wrap {
    padding: 28px;
}

.sc-page-title {
    font-size: 20px;
    font-weight: 700;
    color: #025628;
    margin-bottom: 6px;
}

.sc-page-sub {
    font-size: 13px;
    color: #aaa;
    margin-bottom: 24px;
}

/* ── Course schedule card ─────────────────────────────────── */
.sc-card {
    background: #fff;
    border: 1px solid #e8ede9;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    max-width: 640px;
}

.sc-card-header {
    background: #025628;
    padding: 18px 22px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.sc-card-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: rgba(255,255,255,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.sc-card-icon i {
    font-size: 18px;
    color: #F7EE17;
}

.sc-card-course {
    font-size: 15px;
    font-weight: 700;
    color: #fff;
}

.sc-card-sector {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    background: #F7EE17;
    color: #013d1c;
    padding: 2px 9px;
    border-radius: 20px;
    margin-top: 4px;
}

/* ── Info rows ────────────────────────────────────────────── */
.sc-info-list {
    padding: 6px 0;
}

.sc-info-row {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 22px;
    border-bottom: 1px solid #f0f4f0;
}

.sc-info-row:last-child {
    border-bottom: none;
}

.sc-info-icon {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: #e8f5e9;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
}

.sc-info-icon i {
    font-size: 14px;
    color: #025628;
}

.sc-info-label {
    font-size: 11px;
    color: #aaa;
    margin-bottom: 3px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.sc-info-value {
    font-size: 14px;
    font-weight: 600;
    color: #1a1a1a;
}

/* ── Empty state ──────────────────────────────────────────── */
.sc-empty {
    text-align: center;
    padding: 60px 24px;
    color: #aaa;
}

.sc-empty i {
    font-size: 40px;
    opacity: 0.3;
    display: block;
    margin-bottom: 12px;
}

.sc-empty p {
    font-size: 13px;
}
</style>
@endsection

@section('content')
<div class="sc-wrap">

    <div class="sc-page-title">Schedule</div>
    <div class="sc-page-sub">Your assigned course schedule and session details.</div>

    @if($course)
    <div class="sc-card">

        {{-- Header --}}
        <div class="sc-card-header">
            <div class="sc-card-icon">
                <i class="fa fa-book"></i>
            </div>
            <div>
                <div class="sc-card-course">{{ $course->title }}</div>
                <span class="sc-card-sector">{{ $course->sector ?? 'General' }}</span>
            </div>
        </div>

        {{-- Info rows --}}
        <div class="sc-info-list">

            <div class="sc-info-row">
                <div class="sc-info-icon"><i class="fa fa-calendar-alt"></i></div>
                <div>
                    <div class="sc-info-label">Schedule</div>
                    <div class="sc-info-value">{{ $course->schedule ?? 'Not set' }}</div>
                </div>
            </div>

            <div class="sc-info-row">
                <div class="sc-info-icon"><i class="fa fa-clock"></i></div>
                <div>
                    <div class="sc-info-label">Duration</div>
                    <div class="sc-info-value">{{ $course->duration ?? 'Not set' }}</div>
                </div>
            </div>

            <div class="sc-info-row">
                <div class="sc-info-icon"><i class="fa fa-location-dot"></i></div>
                <div>
                    <div class="sc-info-label">Location / Venue</div>
                    <div class="sc-info-value">{{ $course->location ?? 'Not set' }}</div>
                </div>
            </div>

            <div class="sc-info-row">
                <div class="sc-info-icon"><i class="fa fa-users"></i></div>
                <div>
                    <div class="sc-info-label">Total Students Enrolled</div>
                    <div class="sc-info-value">{{ $totalStudents }} / {{ $course->slots ?? '—' }} slots</div>
                </div>
            </div>

            <div class="sc-info-row">
                <div class="sc-info-icon"><i class="fa fa-circle-info"></i></div>
                <div>
                    <div class="sc-info-label">Status</div>
                    <div class="sc-info-value">
                        <span style="display:inline-block;font-size:12px;font-weight:600;padding:3px 12px;border-radius:20px;
                            background:{{ $course->status === 'active' ? '#e8f5e9' : '#FAEEDA' }};
                            color:{{ $course->status === 'active' ? '#025628' : '#633806' }};">
                            {{ ucfirst($course->status ?? 'N/A') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @else
    <div class="sc-empty">
        <i class="fa fa-calendar-xmark"></i>
        <p>No course assigned to you yet.<br>Please contact the administrator.</p>
    </div>
    @endif

</div>
@endsection