<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses – LEDIPO</title>
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
            <span>Courses</span>
        </nav>

      
        <div style="margin-bottom: 40px;">
            <h2 style="font-size: 2rem; font-weight: 800; color: #025628; margin-bottom: 10px;">Available Courses</h2>
            <p style="font-size: 14px; color: #888;">Browse our free government-accredited livelihood training programs.</p>
        </div>

        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
            @forelse($courses as $course)
            <div style="background: white; border: 1px solid #eee; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.06); transition: transform 0.2s;"
                onmouseover="this.style.transform='translateY(-4px)'"
                onmouseout="this.style.transform='translateY(0)'">

                
                <div style="height: 160px; background: #025628; display: flex; align-items: center; justify-content: center; position: relative;">
                    <i class="fas fa-book" style="font-size: 60px; color: rgba(255,255,255,0.3);"></i>
                    <span style="position: absolute; top: 14px; left: 14px; background: #F7EE17; color: #025628; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px;">
                        {{ $course->sector }}
                    </span>
                </div>

               
                <div style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 700; color: #025628; margin-bottom: 12px;">{{ $course->title }}</h4>
                    <p style="font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 16px;">{{ Str::limit($course->description, 100) }}</p>

                    <div style="display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px;">
                        <p style="font-size: 12px; color: #555; display: flex; align-items: center; gap: 8px; margin: 0;">
                            <i class="fas fa-clock" style="color: #025628; width: 14px;"></i> {{ $course->schedule }}
                        </p>
                        <p style="font-size: 12px; color: #555; display: flex; align-items: center; gap: 8px; margin: 0;">
                            <i class="fas fa-calendar" style="color: #025628; width: 14px;"></i> {{ $course->duration }}
                        </p>
                        <p style="font-size: 12px; color: #555; display: flex; align-items: center; gap: 8px; margin: 0;">
                            <i class="fas fa-location-dot" style="color: #025628; width: 14px;"></i> {{ Str::limit($course->location, 35) }}
                        </p>
                        <p style="font-size: 12px; color: #555; display: flex; align-items: center; gap: 8px; margin: 0;">
                            <i class="fas fa-users" style="color: #025628; width: 14px;"></i> {{ $course->slots }} slots available
                        </p>
                    </div>

                    <a href="{{ route('landing.course.detail', $course->id) }}"
                        style="display: block; text-align: center; background: #025628; color: white; padding: 12px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background 0.3s;"
                        onmouseover="this.style.background='#013d1c'"
                        onmouseout="this.style.background='#025628'">
                        View Course
                    </a>
                </div>
            </div>
            @empty
                <p style="color: #888;">No courses available at the moment.</p>
            @endforelse
        </div>
    </div>

</body>
</html>