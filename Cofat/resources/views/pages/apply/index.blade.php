<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apply to join COFAT Kairouan - Premier Tunisian manufacturer of automotive wiring harnesses">
    <title>COFAT Kairouan | Application</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="{{ asset('images/cofat-logo-white.png') }}" as="image">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/apply/index.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/apply.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
</head>
<body class="apply-page">
    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>
    
    <!-- Header -->
    @include('components.header')
    
    <!-- Main Content -->
    <main id="main-content">
        <!-- Hero Section -->
        <section class="hero text-white text-center py-5">
            <div class="hero-background"></div>
            <div class="container position-relative">
                <div class="hero-content animate-content">
                    <h1 class="display-4 fw-bold mb-4 animate-title">Join Our Team</h1>
                    <p class="lead mb-4 animate-subtitle">
                        Build your career with Tunisia's leading automotive wiring systems manufacturer
                    </p>
                </div>
            </div>
            <div class="hero-scroll-indicator">
                <i class="fas fa-chevron-down"></i>
            </div>
        </section>

        <!-- Application Section -->
        <section class="py-5 application-section">
            <div class="container">
                <div class="card application-card animate-card">
                    <div class="text-center mb-4">
                        <h2 class="section-title">Application Process</h2>
                        <p class="lead">Start your journey with COFAT Kairouan</p>
                    </div>
                    
                    <div class="terms-container">
                        <h4 class="text-center mb-3">Terms and Conditions</h4>
                        
                        <div class="terms-content">
                            <h5>1. Application Process</h5>
                            <p>By submitting an application, you agree to provide accurate and complete information about your qualifications, experience, and personal details.</p>
                            
                            <h5>2. Data Collection</h5>
                            <p>We collect personal data including your name, contact information, education history, and work experience for evaluating your application.</p>
                            
                            <h5>3. Data Usage</h5>
                            <p>Your data will be used solely for recruitment purposes and kept confidential in accordance with our privacy policy and data protection laws.</p>
                            
                            <h5>4. Equal Opportunity</h5>
                            <p>COFAT Kairouan is an equal opportunity employer. We don't discriminate based on race, religion, gender, age, or any protected characteristic.</p>
                        </div>
                        
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="accept-terms" required>
                            <label class="form-check-label" for="accept-terms">
                                I have read and agree to the terms and conditions above
                            </label>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <h4 class="mb-4">Select Application Type</h4>
                        <div class="d-flex justify-content-center gap-4 flex-wrap">
                            <a id="job-btn" href="{{ route('apply.job') }}" class="btn btn-application disabled">
                                <i class="fas fa-briefcase me-2"></i>Job
                            </a>
                            <a id="internship-btn" href="{{ route('apply.internship') }}" class="btn btn-application disabled">
                                <i class="fas fa-user-graduate me-2"></i>Internship
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);

            // Hero animations
            gsap.from('.animate-title', {
                duration: 1,
                y: 30,
                opacity: 0,
                ease: 'power3.out'
            });
            
            gsap.from('.animate-subtitle', {
                duration: 1,
                y: 30,
                opacity: 0,
                delay: 0.3,
                ease: 'power3.out'
            });
            
            // Scroll indicator animation
            gsap.to('.hero-scroll-indicator', {
                y: 10,
                repeat: -1,
                yoyo: true,
                duration: 1.5,
                ease: 'sine.inOut'
            });
            
            // Application card animation
            gsap.from('.animate-card', {
                scrollTrigger: {
                    trigger: '.animate-card',
                    start: "top 80%",
                    toggleActions: "play none none none"
                },
                duration: 0.8,
                y: 50,
                opacity: 0,
                ease: 'back.out(1)'
            });

            // Terms acceptance logic
            const acceptTerms = document.getElementById('accept-terms');
            const jobBtn = document.getElementById('job-btn');
            const internshipBtn = document.getElementById('internship-btn');
            
            acceptTerms.addEventListener('change', function() {
                if (this.checked) {
                    jobBtn.classList.remove('disabled');
                    internshipBtn.classList.remove('disabled');
                } else {
                    jobBtn.classList.add('disabled');
                    internshipBtn.classList.add('disabled');
                }
            });

            // Prevent clicking disabled buttons
            [jobBtn, internshipBtn].forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (this.classList.contains('disabled')) {
                        e.preventDefault();
                        alert('Please accept the terms and conditions first');
                    }
                });
            });
        });
    </script>
</body>
</html>