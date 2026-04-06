<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} – LEDIPO</title>
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
            <li><a href="{{ route('landing.about') }}">About</a></li>
            <li><a href="{{ route('landing.courses') }}" class="active">Courses</a></li>
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
            <a href="{{ route('landing.courses') }}" style="color: #025628; text-decoration: none;">Courses</a>
            <span style="margin: 0 8px;">/</span>
            <span>{{ $course->title }}</span>
        </nav>

       
        <div style="background: #025628; border-radius: 12px; padding: 40px; margin-bottom: 30px; color: white;">
            <span style="background: #F7EE17; color: #025628; font-size: 12px; font-weight: 700; padding: 4px 14px; border-radius: 20px;">
                {{ $course->sector }}
            </span>
            <h1 style="font-size: 2rem; font-weight: 800; margin-top: 16px; margin-bottom: 12px;">{{ $course->title }}</h1>
            <p style="font-size: 15px; opacity: 0.85; line-height: 1.7;">{{ $course->description }}</p>

            <div style="display: flex; gap: 30px; margin-top: 20px; flex-wrap: wrap;">
                <span style="font-size: 14px;"><i class="fas fa-clock"></i> {{ $course->schedule }}</span>
                <span style="font-size: 14px;"><i class="fas fa-calendar"></i> {{ $course->duration }}</span>
                <span style="font-size: 14px;"><i class="fas fa-location-dot"></i> {{ $course->location }}</span>
                <span style="font-size: 14px;"><i class="fas fa-users"></i> {{ $course->slots }} slots</span>
            </div>
        </div>

       
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">

          
            <div>
                <div style="background: white; border: 1px solid #eee; border-radius: 12px; padding: 28px; margin-bottom: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                    <h4 style="color: #025628; font-weight: 700; margin-bottom: 14px;"><i class="fas fa-bullseye"></i> Course Objectives</h4>
                    <p style="color: #555; line-height: 1.8; font-size: 14px;">{{ $course->objectives }}</p>
                </div>

                <div style="background: white; border: 1px solid #eee; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                    <h4 style="color: #025628; font-weight: 700; margin-bottom: 14px;"><i class="fas fa-calendar-days"></i> Schedule & Location</h4>
                    <div style="display: flex; flex-direction: column; gap: 14px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; background: #025628; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock" style="color: white;"></i>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #888;">Schedule</p>
                                <p style="margin: 0; font-weight: 600; color: #333; font-size: 14px;">{{ $course->schedule }}</p>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; background: #025628; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-hourglass" style="color: white;"></i>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #888;">Duration</p>
                                <p style="margin: 0; font-weight: 600; color: #333; font-size: 14px;">{{ $course->duration }}</p>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; background: #025628; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-location-dot" style="color: white;"></i>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #888;">Location</p>
                                <p style="margin: 0; font-weight: 600; color: #333; font-size: 14px;">{{ $course->location }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div>
                <div style="background: white; border: 1px solid #eee; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); position: sticky; top: 100px;">
                    <h4 style="color: #025628; font-weight: 700; margin-bottom: 6px;">Ready to Join?</h4>
                    <p style="color: #888; font-size: 13px; margin-bottom: 20px;">Sign up now to enroll in this course for free!</p>

                    <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; font-size: 14px;">
                            <span style="color: #888;">Duration</span>
                            <span style="font-weight: 600;">{{ $course->duration }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 14px;">
                            <span style="color: #888;">Slots Available</span>
                            <span style="font-weight: 600; color: #025628;">{{ $course->slots }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 14px;">
                            <span style="color: #888;">Fee</span>
                            <span style="font-weight: 600; color: #025628;">FREE</span>
                        </div>
                    </div>

                    <hr style="border: none; border-top: 1px solid #eee; margin-bottom: 20px;">

                    <a href="{{ route('SignupPage') }}"
                        style="display: block; text-align: center; background: #025628; color: white; padding: 14px; border-radius: 8px; font-size: 15px; font-weight: 700; text-decoration: none; margin-bottom: 10px;">
                        <i class="fas fa-user-plus"></i> Sign Up to Enroll
                    </a>
                    <a href="{{ route('Login') }}"
                        style="display: block; text-align: center; background: transparent; color: #025628; padding: 14px; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; border: 2px solid #025628;">
                        Already have an account? Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>