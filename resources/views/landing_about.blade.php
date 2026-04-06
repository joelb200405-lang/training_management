<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us – LEDIPO</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/landingpage.css') }}">
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
            <li><a href="{{ route('landingpage') }}">Home</a></li>
            <li><a href="{{ route('landing.about') }}" class="active">About</a></li>
            <li><a href="{{ route('landing.courses') }}" class="">Courses</a></li>
            <li><a href="{{ route('landing.contact') }}">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('Login') }}" class="btn-signin">Sign In</a>
            <a href="{{ route('SignupPage') }}" class="btn-signup">Sign Up</a>
        </div>
    </nav>

    
    <div style="padding: 120px 60px 60px; min-height: 100vh; background: #f9f9f9;">

       
        <nav style="font-size: 13px; color: #888; margin-bottom: 30px;">
            <a href="{{ route('landingpage') }}" style="color: #025628; text-decoration: none;">Home</a>
            <span style="margin: 0 8px;">/</span>
            <span>About</span>
        </nav>

        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; margin-bottom: 80px; background: white; border-radius: 12px; padding: 50px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
            
            
            <div>
                <h2 style="font-size: 2.2rem; font-weight: 800; color: #025628; margin-bottom: 24px;">Our Story</h2>
                <p style="font-size: 14px; color: #555; line-height: 1.9; margin-bottom: 20px;">
                    Our livelihood training platform was created by a group of passionate students who wanted to make a difference in our community. We recognized that many residents were unaware of the programs available to them or faced challenges in enrolling, so we designed a system that makes these opportunities more accessible. Through a public catalog of courses, streamlined online registration, secure access to modular learning materials, and digital certificates upon completion, we aim to empower individuals to learn new skills and improve their livelihood.
                </p>
                <p style="font-size: 14px; color: #555; line-height: 1.9;">
                    At the same time, the platform provides local government staff with centralized reporting tools to monitor enrollment, interest, and completion rates across barangays. This initiative reflects our commitment to using technology for community growth, ensuring that every resident has the chance to discover, enroll, and succeed in programs that can transform their future.
                </p>
            </div>

           
            <div>
                <img src="{{ asset('images/about.png') }}" alt="About Us"
                    style="width: 100%; height: 380px; object-fit: cover; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.12);">
            </div>
        </div>

       
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

</body>
</html>