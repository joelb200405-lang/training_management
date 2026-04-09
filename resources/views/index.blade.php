<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasmariñas Livelihood Training</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheet/landing_about.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheet/landing_course.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <div class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>LEDIPO</span>
        </div>
        <ul class="nav-links">
            <li><a href="#home" class="nav-link active">Home</a></li>
            <li><a href="#about" class="nav-link">About</a></li>
            <li><a href="#courses" class="nav-link">Courses</a></li>
            <li><a href="#contact" class="nav-link">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('Login') }}" class="btn-signin">Sign In</a>
            <a href="{{ route('SignupPage') }}" class="btn-signup">Sign Up</a>
        </div>
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- HOME SECTION -->
    <section id="home" class="hero">
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

    <!-- ABOUT SECTION -->
    <section id="about" class="about-section">
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
                <p>Students active on our site</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <p>Courses available on our site</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <p>Trainers active on our site</p>
            </div>
        </div>
    </section>

    <!-- COURSES SECTION -->
    <section id="courses" class="courses-section">
        <div class="courses-wrapper">
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
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="contact-section">
        <div class="contact-wrapper">
            
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="contact-grid">
                {{-- Contact Info --}}
                <div class="contact-info">

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4>Call To Us</h4>
                            <p>We are available 24/7, 7 days a week.</p>
                            <p class="contact-detail">Phone: +88015-88888-9999</p>
                        </div>
                    </div>

                    <hr>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4>Write To Us</h4>
                            <p>Fill out our form and we will contact you within 24 hours.</p>
                            <p class="contact-detail">Emails: Regals@gmail.com</p>
                            <p class="contact-detail">Emails: support@ledipo.gov.ph</p>
                        </div>
                    </div>

                    <hr>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-location-dot"></i>
                        </div>
                        <div>
                            <h4>Visit Us</h4>
                            <p>Come visit us at our office.</p>
                            <p class="contact-detail">Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                        </div>
                    </div>

                </div>

                {{-- Contact Form --}}
                <div class="contact-form-wrapper">
                    <form action="{{ route('landing.contact.send') }}" method="POST" class="contact-form">
                        @csrf

                        <div class="form-row">
                            <input type="text" name="name" placeholder="Your Name *" required>
                            <input type="email" name="email" placeholder="Your Email *" required>
                            <input type="text" name="phone" placeholder="Your Phone">
                        </div>

                        <div class="form-group">
                            <textarea name="message" placeholder="Your Message" required></textarea>
                        </div>

                        <div class="form-submit">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Smooth scroll for navigation links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Only handle internal links (starting with #)
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetSection = document.getElementById(targetId);
                    
                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        // Update active class
                        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                    }
                }
            });
        });

        // Update active nav link on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Hamburger menu toggle
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.querySelector('.nav-links');
        
        if (hamburger) {
            hamburger.addEventListener('click', function() {
                navLinks.classList.toggle('active');
            });
        }
    </script>
</body>
</html>