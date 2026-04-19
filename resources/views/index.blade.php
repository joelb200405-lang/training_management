<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasmariñas Livelihood Training</title>

     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('stylesheet/landingpage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <!-- bootstrap link -->
    <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">
</head>
    
</head>
<body>

    <nav class="main-nav">
        <div class="nav-logo">
             <a href="index.php" class="logo-link">
                    <img src="images/logo.png" alt="Logo" class="logo">
             </a> <span>LEDIPO</span>
        </div>

        <ul class="nav-links m-0 p-0">
            <li><a href="#home" class="nav-link active">Home</a></li>
            <li><a href="#about" class="nav-link">About</a></li>
            <li><a href="#courses" class="nav-link">Courses</a></li>
            <li><a href="#contact" class="nav-link">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('Login') }}" class="btn-signin">Login</a>
            <a href="{{ route('SignupPage') }}" class="btn-signup">Sign Up</a>
        </div>
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

 <!-- HERO -->
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
                Login
            </a>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <h3 class="stat-num">{{ $totalStudents }}+</h3>
                <span class="stat-label">Courses</span>
            </div>
            <div class="stat-divid  er"></div>
            <div class="stat">
                <h3 class="stat-num">{{ $totalCourses }}+</h3>   
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
                <img src="{{ asset('images/ledipostory.png') }}" alt="About Us">
            </div>
        </div>

                    {{-- CAROUSEL --}}
            <div id="communityCarousel" class="carousel slide" data-bs-ride="carousel" style="padding: 0 50px;">
                
                {{-- INDICATORS --}}
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="4"></button>
                </div>

                {{-- SLIDES --}}
                <div class="carousel-inner" style="border-radius: 12px; overflow: hidden;">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/1.jpg') }}" class="d-block w-100" alt="Community Photo 1" style="height: 450px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                            <h5>Community Event 1</h5>
                            <p>Dasmariñas City Training Center</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="Community Photo 2" style="height: 450px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                            <h5>Community Event 2</h5>
                            <p>Dasmariñas City Training Center</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/3.jpg') }}" class="d-block w-100" alt="Community Photo 3" style="height: 450px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                            <h5>Community Event 3</h5>
                            <p>Dasmariñas City Training Center</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/4.jpg') }}" class="d-block w-100" alt="Community Photo 4" style="height: 450px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                            <h5>Community Event 4</h5>
                            <p>Dasmariñas City Training Center</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/5.jpg') }}" class="d-block w-100" alt="Community Photo 5" style="height: 450px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                            <h5>Community Event 5</h5>
                            <p>Dasmariñas City Training Center</p>
                        </div>
                    </div>
                </div>

                {{-- CONTROLS --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#communityCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#communityCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>
    </div>

        <!-- ABOUT SECTION -->
    <section id="about" class="about-section">
        {{-- Our Story --}}
        <div class="about-story">
            <div>
                <h2>CONGRATULATIONS</h2>
                <p>
                 to all our Dasmariñas City Training Center - Main Trainers for legitimately passing the Trainers Methodology 1 (TM1) Assessment! The City Government of Dasmariñas through the LEDIPO / Livelihood & Microenterprise Development Office is truly blessed to have competent, committed and hardworking trainers such as yourselves. Through all the struggles, hardships and ridicule from those who tried to put you down, you can finally say "We did it!" We would like to thank the Provincial Technical Education & Skills Development Center Taytay, Rizal for warmly accomodating our DCTC - Main Trainers, their Center Administrator Ms. Catherine Joy Custodio and Admin Support Staff Ms. Sophia Cheryl Moldon thank you very much. To their assessors Ms. Daisy Barilea, Mr. Raymond Catahimican and Mr. Kriz Bernardino, thank you for imparting your knowledge and sound advice. We are very proud of all of you!</p>
            </div>

            <div>
                <img src="{{ asset('images/8.jpg') }}" alt="About Us">
            </div>
        </div>

                {{-- CONTROLS --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#communityCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#communityCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>
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
<section id="contact" class="contact-section">
    <div class="contact-page-wrapper">

        <!-- {{-- BREADCRUMB --}}
        <nav class="breadcrumb">
            <a href="{{ route('index') }}">Home</a>
            <span class="separator">/</span>
            <span>Contact</span>
        </nav> -->

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alertSuccess">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- CONTACT SECTION --}}
        <div class="contact-container">

            {{-- LEFT - CONTACT INFO --}}
            <div class="contact-info-list">

                {{-- Call Us --}}
                <div class="contact-info-item">
                    <div class="contact-icon-wrapper">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h4 class="contact-info-title">Call To Us</h4>
                        <p class="contact-info-subtitle">We are available 24/7, 7 days a week.</p>
                        <p class="contact-info-detail">Phone: +88015-88888-9999</p>
                    </div>
                </div>

                <hr class="contact-divider">

                {{-- Write To Us --}}
                <div class="contact-info-item">
                    <div class="contact-icon-wrapper">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="contact-info-title">Write To Us</h4>
                        <p class="contact-info-subtitle">Fill out our form and we will contact you within 24 hours.</p>
                        <p class="contact-info-detail">Emails: Regals@gmail.com</p>
                        <p class="contact-info-detail">Emails: support@ledipo.gov.ph</p>
                    </div>
                </div>

                <hr class="contact-divider">

                {{-- Address --}}
                <div class="contact-info-item">
                    <div class="contact-icon-wrapper">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 class="contact-info-title">Visit Us</h4>
                        <p class="contact-info-subtitle">Come visit us at our office.</p>
                        <p class="contact-info-detail">Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                    </div>
                </div>

            </div>

            {{-- RIGHT - CONTACT FORM --}}
            <div>
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf

                    <div class="contact-form-grid">
                        <div>
                            <input type="text" name="name" placeholder="Your Name *" class="contact-form-input" required>
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Your Email *" class="contact-form-input" required>
                        </div>
                        <div>
                            <input type="tel" name="phone" placeholder="Your Phone *" class="contact-form-input" maxlength="11" pattern="[0-9{11}" title="please enter an 11-digit phone number starting with 09"  required>
                        </div>
                    </div>

                    <div class="contact-form-textarea-wrapper">
                        <textarea name="message" placeholder="Your Message" class="contact-form-textarea" required></textarea>
                    </div>
                    <div class="contact-form-submit-wrapper">
                        <button type="submit" class="btn-submit-contact">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
 <!-- footer -->
   <footer class="footer">
        <div class="footer-content">
            <div class="footer-col">
                <h3>Support</h3>
                <p>Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                <p><a href="mailto:Regals@gmail.com">Regals@gmail.com</a></p>
                <p>+88015-88888-9999</p>
            </div>
            <div class="footer-col">
                <h3>Account</h3>
                <ul>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Login / Register</a></li>
                    <li><a href="#">Likes</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Quick Link</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms Of Use</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Copyright Rimel 2022. All right reserved</p>
        </div>
    </footer>

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

            window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            });

        
    </script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

            
</body>
</html>