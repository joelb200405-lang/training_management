<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses – LEDIPO</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheet/landing_course.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <div class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>LEDIPO</span>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('landing.about') }}">About</a></li>
            <li><a href="{{ route('landing.courses') }}" class="active">Courses</a></li>
            <li><a href="{{ route('landing.contact') }}">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('Login') }}" class="btn-signin">Sign In</a>
            <a href="{{ route('SignupPage') }}" class="btn-signup">Sign Up</a>
        </div>
    </nav>

    <div class="courses-wrapper">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb">
            <a href="{{ route('index') }}">Home</a>
            <span>/</span>
            <span>Courses</span>
        </nav>

        {{-- Header --}}
        <div class="courses-header">
            <h2>Available Courses</h2>
            <p>Browse our free government-accredited livelihood training programs.</p>
        </div>

        {{-- Courses Grid --}}
        <div class="courses-grid">
            @forelse($courses as $course)
            <div class="course-card">

                <div class="course-thumbnail">
                    <i class="fas fa-book"></i>
                    <span class="course-sector-badge">{{ $course->sector }}</span>
                </div>

                <div class="course-body">
                    <h4>{{ $course->title }}</h4>
                    <p>{{ Str::limit($course->description, 100) }}</p>

                    <div class="course-meta">
                        <p><i class="fas fa-clock"></i> {{ $course->schedule }}</p>
                        <p><i class="fas fa-calendar"></i> {{ $course->duration }}</p>
                        <p><i class="fas fa-location-dot"></i> {{ Str::limit($course->location, 35) }}</p>
                        <p><i class="fas fa-users"></i> {{ $course->slots }} slots available</p>
                    </div>

                    <a href="{{ route('landing.course.detail', $course->id) }}" class="btn-view-course">
                        View Course
                    </a>
                </div>
            </div>
            @empty
                <p class="courses-empty">No courses available at the moment.</p>
            @endforelse
        </div>
    </div>

</body>
</html>