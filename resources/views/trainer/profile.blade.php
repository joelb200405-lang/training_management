@extends('trainer.layout')

@section('title', 'My Profile')

@section('css')
<style>
.pf-wrap { padding: 28px; max-width: 700px; }
.pf-page-title { font-size: 20px; font-weight: 700; color: #025628; margin-bottom: 22px; }
.pf-alert { padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
.pf-alert.success { background: #e8f5e9; color: #025628; border: 1px solid #a5d6a7; }
.pf-alert.error   { background: #FCEBEB; color: #791F1F; border: 1px solid #f5c1c1; }
.pf-card { background: #fff; border: 1px solid #e8ede9; border-radius: 12px; padding: 20px 22px; margin-bottom: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.05); }
.pf-card-title { font-size: 14px; font-weight: 700; color: #1a1a1a; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 1px solid #f0f4f0; }
.pf-header { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; }
.pf-avatar { width: 64px; height: 64px; border-radius: 50%; background: #025628; color: #F7EE17; font-size: 22px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.pf-name { font-size: 18px; font-weight: 700; color: #1a1a1a; }
.pf-email { font-size: 13px; color: #aaa; margin-top: 2px; }
.pf-role-badge { display: inline-block; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; background: #e8f5e9; color: #025628; margin-top: 4px; }
.pf-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
.pf-stat { background: #f5f5f3; border-radius: 10px; padding: 12px; text-align: center; }
.pf-stat-val { font-size: 20px; font-weight: 700; color: #025628; line-height: 1; }
.pf-stat-lbl { font-size: 11px; color: #aaa; margin-top: 4px; }
.pf-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
.pf-field { display: flex; flex-direction: column; gap: 5px; }
.pf-field.full { grid-column: 1 / -1; }
.pf-label { font-size: 11px; font-weight: 600; color: #aaa; text-transform: uppercase; letter-spacing: 0.05em; }
.pf-input { padding: 9px 12px; border: 1px solid #e8ede9; border-radius: 8px; font-size: 13px; font-family: "Open Sans", sans-serif; color: #1a1a1a; background: #fff; outline: none; transition: border-color 0.18s; }
.pf-input:focus { border-color: #025628; }
.pf-input:disabled { background: #f5f5f3; color: #aaa; cursor: not-allowed; }
.pf-btn-row { display: flex; justify-content: flex-end; }
.pf-btn { padding: 9px 22px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; font-family: "Open Sans", sans-serif; border: none; background: #025628; color: #fff; transition: background 0.2s; }
.pf-btn:hover { background: #013d1c; }
.pf-course-card { background: #f5f5f3; border-radius: 10px; padding: 14px; }
.pf-course-name { font-size: 14px; font-weight: 700; color: #025628; margin-bottom: 8px; }
.pf-course-meta { display: flex; flex-direction: column; gap: 5px; }
.pf-course-meta-item { font-size: 12px; color: #555; display: flex; align-items: center; gap: 7px; }
.pf-course-meta-item i { color: #025628; width: 13px; }
@media (max-width: 600px) { .pf-wrap { padding: 18px 16px; } .pf-form-grid { grid-template-columns: 1fr; } .pf-stats { grid-template-columns: 1fr 1fr; } }
</style>
@endsection

@section('content')
<div class="pf-wrap">

    <div class="pf-page-title">My Profile</div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="pf-alert success"><i class="fa fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="pf-alert error"><i class="fa fa-circle-exclamation"></i> {{ session('error') }}</div>
    @endif

    {{-- ── PROFILE HEADER ────────────────────────────────────── --}}
    <div class="pf-card">
        <div class="pf-header">
            <div class="pf-avatar">
                {{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}
            </div>
            <div>
                <div class="pf-name">{{ $user->firstname }} {{ $user->lastname }}</div>
                <div class="pf-email">{{ $user->email }}</div>
                <span class="pf-role-badge">Trainer</span>
            </div>
        </div>

        <div class="pf-stats">
            <div class="pf-stat">
                <div class="pf-stat-val">{{ $course ? 1 : 0 }}</div>
                <div class="pf-stat-lbl">Assigned course</div>
            </div>
            <div class="pf-stat">
                <div class="pf-stat-val">{{ $totalStudents }}</div>
                <div class="pf-stat-lbl">Total students</div>
            </div>
        </div>
    </div>

    {{-- ── PERSONAL INFO ──────────────────────────────────────── --}}
    <div class="pf-card">
        <div class="pf-card-title">Personal information</div>
        <form action="{{ route('trainer.profile.update') }}" method="POST">
            @csrf
            <div class="pf-form-grid">
                <div class="pf-field">
                    <label class="pf-label">First name</label>
                    <input type="text" name="firstname" class="pf-input"
                           value="{{ old('firstname', $user->firstname) }}" required>
                </div>
                <div class="pf-field">
                    <label class="pf-label">Last name</label>
                    <input type="text" name="lastname" class="pf-input"
                           value="{{ old('lastname', $user->lastname) }}" required>
                </div>
                <div class="pf-field">
                    <label class="pf-label">Email</label>
                    <input type="email" name="email" class="pf-input"
                           value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="pf-field">
                    <label class="pf-label">Username</label>
                    <input type="text" name="username" class="pf-input"
                           value="{{ old('username', $user->username) }}" required>
                </div>
            </div>
            <div class="pf-btn-row">
                <button type="submit" class="pf-btn">Save changes</button>
            </div>
        </form>
    </div>

    {{-- ── ASSIGNED COURSE ────────────────────────────────────── --}}
    <div class="pf-card">
        <div class="pf-card-title">Assigned course</div>
        @if($course)
        <div class="pf-course-card">
            <div class="pf-course-name">{{ $course->title }}</div>
            <div class="pf-course-meta">
                <div class="pf-course-meta-item">
                    <i class="fa fa-tag"></i> {{ $course->sector ?? 'General' }}
                </div>
                <div class="pf-course-meta-item">
                    <i class="fa fa-calendar-day"></i> Duration: {{ $course->duration ?? 'TBA' }}
                </div>
                <div class="pf-course-meta-item">
                    <i class="fa fa-clock"></i> {{ $course->schedule ?? 'TBA' }}
                </div>
                <div class="pf-course-meta-item">
                    <i class="fa fa-users"></i> {{ $totalStudents }} / {{ $course->slots }} students
                </div>
                <div class="pf-course-meta-item">
                    <i class="fa fa-location-dot"></i> {{ $course->location ?? 'TBA' }}
                </div>
            </div>
        </div>
        @else
        <div style="text-align:center;padding:24px;color:#aaa;font-size:13px;">
            <i class="fa fa-book-open" style="font-size:28px;opacity:0.3;display:block;margin-bottom:8px;"></i>
            No course assigned yet.
        </div>
        @endif
    </div>

    {{-- ── CHANGE PASSWORD ────────────────────────────────────── --}}
    <div class="pf-card">
        <div class="pf-card-title">Change password</div>
        <form action="{{ route('trainer.profile.password') }}" method="POST">
            @csrf
            <div class="pf-form-grid">
                <div class="pf-field full">
                    <label class="pf-label">Current password</label>
                    <input type="password" name="current_password" class="pf-input" required>
                </div>
                <div class="pf-field">
                    <label class="pf-label">New password</label>
                    <input type="password" name="password" class="pf-input" required>
                </div>
                <div class="pf-field">
                    <label class="pf-label">Confirm new password</label>
                    <input type="password" name="password_confirmation" class="pf-input" required>
                </div>
            </div>
            <div class="pf-btn-row">
                <button type="submit" class="pf-btn">Update password</button>
            </div>
        </form>
    </div>

</div>
@endsection