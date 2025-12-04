<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Join COFAT Kairouan - Premier Tunisian manufacturer of automotive wiring harnesses and electrical systems">
    <title>Careers at COFAT Kairouan - Automotive Wiring Systems Specialist</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="{{ asset('images/cofat-logo-white.png') }}" as="image">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/careers.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/home.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.cofatkairouan.com/careers">
</head>
<body>
    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>
    
    <!-- Header -->
    @include('components.header')
    
    <!-- Main Content -->
    <main id="main-content">
        <!-- Hero Section -->
        <section class="hero text-white py-5">
            <div class="hero-background"></div>
            <div class="container text-center position-relative">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold mb-3 animate-title">Join Our Engineering Team</h1>
                    <p class="lead mb-4 animate-subtitle">
                        Be part of Tunisia's premier automotive wiring systems manufacturer and work with global vehicle brands
                    </p>
                </div>
            </div>
            <div class="hero-scroll-indicator">
                <i class="fas fa-chevron-down"></i>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-5 stats-section">
            <div class="container">
                <div class="row g-4 text-center">
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3 class="stat-number" data-count="85">0</h3>
                            <p class="stat-label">Engineering Staff</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <h3 class="stat-number" data-count="12">0</h3>
                            <p class="stat-label">R&D Projects</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <h3 class="stat-number" data-count="5">0</h3>
                            <p class="stat-label">Training Programs</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="stat-number" data-count="500">0</h3>
                            <p class="stat-label">Team Members</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Open Positions Section -->
        <section class="py-5 features-custom" id="open-positions">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title text-dark">Open Positions</h2>
                    <p class="lead mb-5">Join our team of automotive electrical systems specialists and grow your career</p>
                </div>
                <div class="row justify-content-center g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-car-battery" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Electrical Design Engineer</h3>
                            <p class="mb-3">Design and develop automotive wiring systems for global vehicle manufacturers.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-microchip" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Quality Assurance Specialist</h3>
                            <p class="mb-3">Ensure our wiring systems meet international automotive quality standards.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-robot" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Automation Technician</h3>
                            <p class="mb-3">Maintain and optimize our automated wiring harness production lines.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title">Why Join COFAT Kairouan?</h2>
                    <p class="lead mb-5">We invest in our team's growth and provide a rewarding work environment</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h3 class="h5">Professional Development</h3>
                            <p>Continuous training programs and opportunities for technical certification in automotive electrical systems.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <h3 class="h5">Comprehensive Benefits</h3>
                            <p>Competitive salary, health insurance, and performance bonuses in a stable work environment.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-globe-europe"></i>
                            </div>
                            <h3 class="h5">Global Exposure</h3>
                            <p>Work with international automotive brands and contribute to cutting-edge vehicle technologies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section py-5 text-white text-center">
            <div class="cta-overlay"></div>
            <div class="container position-relative">
                <div class="cta-content">
                    <h2 class="mb-4">Ready to Power the Future of Automotive?</h2>
                    <p class="lead mb-4">
                        Submit your application or contact our HR department to learn more about career opportunities at COFAT Kairouan.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-envelope me-2"></i>Contact HR
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Application Process Section -->
        <section class="py-5">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title">Our Hiring Process</h2>
                    <p class="lead mb-5">Transparent and efficient recruitment for the best talent</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="process-step">
                            <div class="step-number">1</div>
                            <h4>Application</h4>
                            <p>Submit your CV and cover letter through our portal</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="process-step">
                            <div class="step-number">2</div>
                            <h4>Technical Review</h4>
                            <p>Our engineering team evaluates your qualifications</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="process-step">
                            <div class="step-number">3</div>
                            <h4>Interviews</h4>
                            <p>Meet with HR and technical managers</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="process-step">
                            <div class="step-number">4</div>
                            <h4>Offer</h4>
                            <p>Successful candidates receive a competitive offer</p>
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
    
    <script>
        // Intersection Observer for animations
        document.addEventListener('DOMContentLoaded', function() {
            // Hero animations
            gsap.from('.animate-title', {
                duration: 1,
                y: -50,
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
            
            gsap.from('.animate-buttons', {
                duration: 1,
                y: 30,
                opacity: 0,
                delay: 0.6,
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
            
            // Feature card animations
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach((card, index) => {
                gsap.from(card, {
                    scrollTrigger: {
                        trigger: card,
                        start: "top 80%",
                        toggleActions: "play none none none"
                    },
                    duration: 0.8,
                    y: 50,
                    opacity: 0,
                    delay: index * 0.1,
                    ease: 'back.out(1)'
                });
            });
            
            // Stats counter animation
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(number => {
                const target = parseInt(number.getAttribute('data-count'));
                const duration = 2000;
                const start = 0;
                const increment = target / (duration / 16);
                
                let current = start;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        clearInterval(timer);
                        current = target;
                    }
                    number.textContent = Math.floor(current);
                }, 16);
            });
        });
    </script>
</body>
</html>