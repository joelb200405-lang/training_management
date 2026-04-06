<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasmariñas Livelihood Training</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/landingpage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="proconnect" href="https://fonts.googleapis.com">
    <link rel="proconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body>

    <nav class="navbar">
        <div class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>LEDIPO</span>
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="{{ route('landing.about') }}">About</a></li>
            <li><a href="{{ route('landing.courses') }}">Courses</a></li>
            <li><a href="{{ route('landing.contact') }}">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('Login') }}" class="btn-signin">Sign In</a>
            <a href="{{ route('SignupPage') }}" class="btn-signup">Sign Up</a>
        </div>
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-badge">
            <i class="fas fa-award"></i>
            Dasmariñas City Livelihood Program
        </div>
        <h1>Start Your <span>Training</span> Journey</h1>
        <p>Access free government-accredited livelihood training programs. Build your skills, grow your income, and transform your future with Dasmariñas City.</p>
        <div class="hero-actions">
            <a href="{{ route('SignupPage') }}" class="btn-primary">
                Get Started <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('Login') }}" class="btn-secondary">
                Sign In
            </a>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <span class="stat-num">6+</span>
                <span class="stat-label">Courses</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-num">100+</span>
                <span class="stat-label">Students</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-num">Free</span>
                <span class="stat-label">Registration</span>
            </div>
        </div>
    </div>
</section>

</body>
</html>