@extends('student.layout')

@section('title','About Us')

@section('content')

<div style="padding: 40px 60px; min-height: 70vh;">

    {{-- BREADCRUMB --}}
    <nav style="font-size: 13px; color: #888; margin-bottom: 30px;">
        <a href="{{ route('homepage') }}" style="color: #025628; text-decoration: none;">Home</a>
        <span style="margin: 0 8px;">/</span>
        <span>About</span>
    </nav>

    {{-- OUR STORY --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; margin-bottom: 50px; background: white; border-radius: 12px; padding: 50px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">

        {{-- LEFT - TEXT --}}
        <div>
            <h2 style="font-size: 2.2rem; font-weight: 800; color: #025628; margin-bottom: 24px;">Our Story</h2>
            <p style="font-size: 14px; color: #555; line-height: 1.9; margin-bottom: 20px;">
                Our livelihood training platform was created by a group of passionate students who wanted to make a difference in our community. We recognized that many residents were unaware of the programs available to them or faced challenges in enrolling, so we designed a system that makes these opportunities more accessible. Through a public catalog of courses, streamlined online registration, secure access to modular learning materials, and digital certificates upon completion, we aim to empower individuals to learn new skills and improve their livelihood.
            </p>
            <p style="font-size: 14px; color: #555; line-height: 1.9;">
                At the same time, the platform provides local government staff with centralized reporting tools to monitor enrollment, interest, and completion rates across barangays. This initiative reflects our commitment to using technology for community growth, ensuring that every resident has the chance to discover, enroll, and succeed in programs that can transform their future.
            </p>
        </div>

        {{-- RIGHT - IMAGE --}}
        <div>
            <img src="{{ asset('images/about.png') }}" alt="About Us"
                style="width: 100%; height: 380px; object-fit: cover; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.12);">
        </div>
    </div>

    {{-- STATS --}}
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">

        <div style="background: white; border: 1px solid #eee; border-radius: 12px; padding: 40px; text-align: center; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
            <div style="width: 70px; height: 70px; background: rgba(2,86,40,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <i class="fas fa-user-graduate" style="font-size: 28px; color: #025628;"></i>
            </div>
            <h3 style="font-size: 2.5rem; font-weight: 800; color: #025628; margin-bottom: 8px;">{{ $totalStudents }}+</h3>
            <p style="font-size: 14px; color: #888;">Students active on our site</p>
        </div>

        <div style="background: white; border: 1px solid #eee; border-radius: 12px; padding: 40px; text-align: center; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
            <div style="width: 70px; height: 70px; background: rgba(2,86,40,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <i class="fas fa-book" style="font-size: 28px; color: #025628;"></i>
            </div>
            <h3 style="font-size: 2.5rem; font-weight: 800; color: #025628; margin-bottom: 8px;">{{ $totalCourses }}+</h3>
            <p style="font-size: 14px; color: #888;">Courses available on our site</p>
        </div>

        <div style="background: white; border: 1px solid #eee; border-radius: 12px; padding: 40px; text-align: center; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
            <div style="width: 70px; height: 70px; background: rgba(2,86,40,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <i class="fas fa-chalkboard-teacher" style="font-size: 28px; color: #025628;"></i>
            </div>
            <h3 style="font-size: 2.5rem; font-weight: 800; color: #025628; margin-bottom: 8px;">{{ $totalTrainers }}+</h3>
            <p style="font-size: 14px; color: #888;">Trainers active on our site</p>
        </div>

    </div>
</div>
@endsection