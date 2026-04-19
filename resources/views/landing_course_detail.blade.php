<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} – LEDIPO</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheet/landing_course_detail.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.php" class="logo-link">
            <img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
            <span>LEDIPO</span>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('index') }}#home">Home</a></li>
            <li><a href="{{ route('index') }}#about">About</a></li>
            <li><a href="{{ route('index') }}#courses" class="active">Courses</a></li>
            <li><a href="{{ route('index') }}#contact">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('Login') }}" class="btn-signin">Login</a>
            <a href="{{ route('SignupPage') }}" class="btn-signup">Sign Up</a>
        </div>
    </nav>

    <div class="course-detail-wrapper">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb">
            <a href="{{ route('index') }}#home">Home</a>
            <span>/</span>
            <a href="{{ route('index') }}#courses">Courses</a>
            <span>/</span>
            <span>{{ $course->title }}</span>
        </nav>

        {{-- Banner --}}
        <div class="course-banner">
            <span class="course-banner-sector">{{ $course->sector }}</span>
            <h1>{{ $course->title }}</h1>
            <p>{{ $course->description }}</p>

            <div class="course-banner-meta">
                <span><i class="fas fa-clock"></i> {{ $course->schedule }}</span>
                <span><i class="fas fa-calendar"></i> {{ $course->duration }}</span>
                <span><i class="fas fa-location-dot"></i> {{ $course->location }}</span>
                <span><i class="fas fa-users"></i> {{ $course->slots }} slots</span>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="course-detail-grid">

            {{-- Left Column --}}
            <div>
                <div class="detail-card">
                    <h4><i class="fas fa-bullseye"></i> Course Objectives</h4>
                    <p>{{ $course->objectives }}</p>
                </div>

                <div class="detail-card">
                    <h4><i class="fas fa-calendar-days"></i> Schedule & Location</h4>
                    <div class="schedule-list">
                        <div class="schedule-item">
                            <div class="schedule-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="schedule-info">
                                <p>Schedule</p>
                                <p>{{ $course->schedule }}</p>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-icon">
                                <i class="fas fa-hourglass"></i>
                            </div>
                            <div class="schedule-info">
                                <p>Duration</p>
                                <p>{{ $course->duration }}</p>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-icon">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div class="schedule-info">
                                <p>Location</p>
                                <p>{{ $course->location }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div>
                <div class="sidebar-card">
                    <h4>Ready to Join?</h4>
                    <p>Sign up now to enroll in this course for free!</p>

                    <div class="sidebar-meta">
                        <div class="sidebar-meta-row">
                            <span>Duration</span>
                            <span>{{ $course->duration }}</span>
                        </div>
                        <div class="sidebar-meta-row">
                            <span>Slots Available</span>
                            <span class="highlight">{{ $course->slots }}</span>
                        </div>
                        <div class="sidebar-meta-row">
                            <span>Fee</span>
                            <span class="highlight">FREE</span>
                        </div>
                    </div>

                    <hr class="sidebar-divider">

                    <a href="{{ route('SignupPage') }}" class="btn-enroll">
                        <i class="fas fa-user-plus"></i> Sign Up to Enroll
                    </a>
                    <a href="{{ route('Login') }}" class="btn-signin-outline">
                        Already have an account? Sign In
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>