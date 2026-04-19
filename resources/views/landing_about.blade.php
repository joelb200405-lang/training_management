<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us – LEDIPO</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheet/landing_about.css') }}">
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
            <li><a href="{{ route('index') }}" class="active">About</a></li>
            <li><a href="{{ route('index') }}">Courses</a></li>
            <li><a href="{{ route('landing.contact') }}">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('Login') }}" class="btn-signin">Sign In</a>
            <a href="{{ route('SignupPage') }}" class="btn-signup">Sign Up</a>
        </div>
    </nav>

    <div class="about-wrapper">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb">
            <a href="{{ route('index') }}">Home</a>
            <span>/</span>
            <span>About</span>
        </nav>

        {{-- Our Story --}}
        <div class="about-story">
            <div>
                <h2>Our Story</h2>
                <p>
                    Our livelihood training platform was created by a group of passionate students who wanted to make a difference in our community. We recognized that many residents were unaware of the programs available to them or faced challenges in enrolling, so we designed a system that makes these opportunities more accessible. Through a public catalog of courses, streamlined online registration, secure access to modular learning materials, and digital certificates upon completion, we aim to empower individuals to learn new skills and improve their livelihood.
                </p>
                <p>
                    At the same time, the platform provides local government staff with centralized reporting tools to monitor enrollment, interest, and completion rates across barangays. This initiative reflects our commitment to using technology for community growth, ensuring that every resident has the chance to discover, enroll, and succeed in programs that can transform their future.
                </p>
            </div>

            <div>
                <img src="{{ asset('images/about.png') }}" alt="About Us">
            </div>
        </div>

        {{-- Stats --}}
        <div class="about-stats">

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3>{{ $totalStudents }}+</h3>
                <p>Students active on our site</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>{{ $totalCourses }}+</h3>
                <p>Courses available on our site</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3>{{ $totalTrainers }}+</h3>
                <p>Trainers active on our site</p>
            </div>

        </div>
    </div>

</body>
</html>