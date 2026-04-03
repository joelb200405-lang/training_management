@extends('student.layout')

@section('title', $course->title)

@section('content')
<div class="container-fluid p-0">
    <div style="padding: 40px 50px;">

        {{-- SUCCESS / ERROR MESSAGES --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- BACK BUTTON --}}
        <a href="{{ route('homepage') }}" style="color:#025628; font-size:14px; text-decoration:none;">
            <i class="fa fa-arrow-left"></i> Back to Home
        </a>

        {{-- COURSE HEADER --}}
        <div style="margin-top: 24px; background:#025628; color:white; padding:40px; border-radius:12px;">
            <span style="background:#F7EE17; color:#025628; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:700;">
                {{ $course->sector }}
            </span>
            <h1 style="margin-top:16px; font-size:2rem; font-weight:700;">{{ $course->title }}</h1>
            <p style="margin-top:8px; opacity:0.85; font-size:15px;">{{ $course->description }}</p>

            <div style="display:flex; gap:30px; margin-top:20px; flex-wrap:wrap;">
                <span><i class="fa fa-clock"></i> {{ $course->duration }}</span>
                <span><i class="fa fa-calendar"></i> {{ $course->schedule }}</span>
                <span><i class="fa fa-location-dot"></i> {{ $course->location }}</span>
                <span><i class="fa fa-users"></i> {{ $course->slots }} slots available</span>
            </div>
        </div>

        {{-- COURSE DETAILS --}}
        <div style="display:grid; grid-template-columns: 2fr 1fr; gap:24px; margin-top:30px;">
            
            {{-- LEFT --}}
            <div>
                {{-- OBJECTIVES --}}
                <div style="background:white; border:1px solid #ddd; border-radius:12px; padding:28px; margin-bottom:20px;">
                    <h4 style="color:#025628; font-weight:700; margin-bottom:14px;">
                        <i class="fa fa-bullseye"></i> Course Objectives
                    </h4>
                    <p style="color:#555; line-height:1.8;">{{ $course->objectives }}</p>
                </div>

                {{-- SCHEDULE & LOCATION --}}
                <div style="background:white; border:1px solid #ddd; border-radius:12px; padding:28px;">
                    <h4 style="color:#025628; font-weight:700; margin-bottom:14px;">
                        <i class="fa fa-calendar-days"></i> Schedule & Location
                    </h4>
                    <div style="display:flex; flex-direction:column; gap:14px;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:40px; height:40px; background:#025628; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="fa fa-clock" style="color:white;"></i>
                            </div>
                            <div>
                                <p style="margin:0; font-size:12px; color:#888;">Schedule</p>
                                <p style="margin:0; font-weight:600; color:#333;">{{ $course->schedule }}</p>
                            </div>
                        </div>
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:40px; height:40px; background:#025628; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="fa fa-hourglass" style="color:white;"></i>
                            </div>
                            <div>
                                <p style="margin:0; font-size:12px; color:#888;">Duration</p>
                                <p style="margin:0; font-weight:600; color:#333;">{{ $course->duration }}</p>
                            </div>
                        </div>
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:40px; height:40px; background:#025628; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="fa fa-location-dot" style="color:white;"></i>
                            </div>
                            <div>
                                <p style="margin:0; font-size:12px; color:#888;">Training Location</p>
                                <p style="margin:0; font-weight:600; color:#333;">{{ $course->location }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT - ENROLL CARD --}}
            <div>
                <div style="background:white; border:1px solid #ddd; border-radius:12px; padding:28px; position:sticky; top:20px;">
                    <h4 style="color:#025628; font-weight:700; margin-bottom:6px;">Ready to Join?</h4>
                    <p style="color:#888; font-size:13px; margin-bottom:20px;">Enroll now and start your training journey!</p>

                    <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:20px;">
                        <div style="display:flex; justify-content:space-between; font-size:14px;">
                            <span style="color:#888;">Duration</span>
                            <span style="font-weight:600;">{{ $course->duration }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:14px;">
                            <span style="color:#888;">Slots Available</span>
                            <span style="font-weight:600; color:#025628;">{{ $course->slots }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:14px;">
                            <span style="color:#888;">Status</span>
                            <span style="font-weight:600; color:#025628;">{{ ucfirst($course->status) }}</span>
                        </div>
                    </div>

                    <hr>

                    @auth
                        {{-- Check if already enrolled --}}
                        @php
                            $enrolled = \App\Models\Enrollment_tbl::where('user_id', Auth::id())
                                        ->where('course_id', $course->id)
                                        ->first();
                        @endphp

                        @if($enrolled)
                            <div style="background:#e8f5e9; color:#025628; padding:12px; border-radius:8px; text-align:center; font-weight:600;">
                                <i class="fa fa-check-circle"></i> Already Enrolled!
                            </div>
                        @else
                            <form action="{{ route('course.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" style="width:100%; background:#025628; color:white; border:none; padding:14px; border-radius:8px; font-size:15px; font-weight:700; cursor:pointer;">
                                    <i class="fa fa-graduation-cap"></i> Enroll Now
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('Login') }}" style="display:block; width:100%; background:#025628; color:white; border:none; padding:14px; border-radius:8px; font-size:15px; font-weight:700; cursor:pointer; text-align:center; text-decoration:none;">
                            <i class="fa fa-lock"></i> Login to Enroll
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection