<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us – LEDIPO</title>
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
            <li><a href="{{ route('landing.about') }}" class="">About</a></li>
            <li><a href="{{ route('landing.courses') }}" class="">Courses</a></li>
            <li><a href="{{ route('landing.contact') }}" class="active">Contact</a></li>
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
            <span>Contact</span>
        </nav>

        
        @if(session('success'))
            <div style="background: #e8f5e9; color: #025628; padding: 14px 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #025628;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 40px; background: white; border: 1px solid #eee; border-radius: 12px; padding: 40px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">

            <div style="display: flex; flex-direction: column; gap: 30px;">

                
                <div style="display: flex; gap: 16px; align-items: flex-start;">
                    <div style="width: 50px; height: 50px; background: #025628; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-phone" style="color: white; font-size: 18px;"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Call To Us</h4>
                        <p style="font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 6px;">We are available 24/7, 7 days a week.</p>
                        <p style="font-size: 13px; color: #444;">Phone: +88015-88888-9999</p>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid #eee;">

                
                <div style="display: flex; gap: 16px; align-items: flex-start;">
                    <div style="width: 50px; height: 50px; background: #025628; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-envelope" style="color: white; font-size: 18px;"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Write To Us</h4>
                        <p style="font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 6px;">Fill out our form and we will contact you within 24 hours.</p>
                        <p style="font-size: 13px; color: #444;">Emails: Regals@gmail.com</p>
                        <p style="font-size: 13px; color: #444;">Emails: support@ledipo.gov.ph</p>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid #eee;">

                
                <div style="display: flex; gap: 16px; align-items: flex-start;">
                    <div style="width: 50px; height: 50px; background: #025628; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-location-dot" style="color: white; font-size: 18px;"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Visit Us</h4>
                        <p style="font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 6px;">Come visit us at our office.</p>
                        <p style="font-size: 13px; color: #444;">Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                    </div>
                </div>

            </div>

            
            <div>
                <form action="{{ route('landing.contact.send') }}" method="POST">
                    @csrf

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <input type="text" name="name" placeholder="Your Name *"
                            style="width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit;"
                            required>
                        <input type="email" name="email" placeholder="Your Email *"
                            style="width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit;"
                            required>
                        <input type="text" name="phone" placeholder="Your Phone"
                            style="width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <textarea name="message" placeholder="Your Message"
                            style="width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit; height: 180px; resize: vertical;"
                            required></textarea>
                    </div>

                    <div style="text-align: right;">
                        <button type="submit"
                            style="background: #025628; color: white; border: none; padding: 14px 36px; border-radius: 6px; font-size: 15px; font-weight: 600; cursor: pointer; font-family: inherit;">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>