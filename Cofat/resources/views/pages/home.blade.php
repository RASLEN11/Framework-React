<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="COFAT Kairouan - Premier Tunisian manufacturer of automotive wiring harnesses and electrical systems for global vehicle manufacturers">
    <title>COFAT Kairouan | Home</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="{{ asset('images/cofat-logo-white.png') }}" as="image">
    <link rel="preload" href="{{ asset('images/hero-bg.jpg') }}" as="image">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/home.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.cofatkairouan.com">
</head>
<body class="home-page">
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
                    <div class="hero-logo-container animate-logo">
                        <img src="{{ asset('images/LogoCofat.png') }}" alt="COFAT Logo" class="hero-logo">
                    </div>
                    <h1 class="animate-title">Precision Automotive Wiring Solutions</h1>
                    <p class="lead mb-4 animate-subtitle">
                        Precision Automotive Wiring Solutions for Global Vehicle Manufacturers
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap animate-buttons">
                        <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="fa-solid fa-circle-info me-2"></i>About Us
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-action btn-lg px-4">
                            <i class="fas fa-handshake me-2"></i>Partner With Us
                        </a>
                    </div>
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
                                <i class="fas fa-globe"></i>
                            </div>
                            <h3 class="stat-number" data-count="25">0</h3>
                            <p class="stat-label">Countries Served</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-industry"></i>
                            </div>
                            <h3 class="stat-number" data-count="150">0</h3>
                            <p class="stat-label">Automotive Models</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <h3 class="stat-number" data-count="12">0</h3>
                            <p class="stat-label">Quality Certifications</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="stat-number" data-count="500">0</h3>
                            <p class="stat-label">Skilled Employees</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Features Section -->
        <section class="py-5 features-custom">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title text-dark">Our Capabilities</h2>
                    <p class="lead mb-5">Delivering cutting-edge automotive wiring solutions with precision engineering and advanced manufacturing</p>
                </div>
                <div class="row justify-content-center g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-car-battery" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Wiring Harness Manufacturing</h3>
                            <p class="mb-0">
                                Specialized in designing and producing custom wiring harnesses for passenger vehicles, commercial trucks, and specialty automotive applications with precision and reliability.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-microchip" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Electromechanical Assemblies</h3>
                            <p class="mb-0">
                                Advanced manufacturing of complex electromechanical components including junction boxes, fuse panels, and electronic control modules for modern vehicles.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-robot" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Automated Production</h3>
                            <p class="mb-0">
                                State-of-the-art automated production lines with robotic wire processing, automated testing equipment, and Industry 4.0 compliant manufacturing processes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="cta-section py-5 text-white text-center">
            <div class="cta-overlay"></div>
            <div class="container position-relative">
                <div class="cta-content">
                    <h2 class="mb-4">Driving Automotive Innovation</h2>
                    <p class="lead mb-4">
                        As a trusted Tier 1 supplier to global OEMs, we combine Tunisian engineering excellence with international quality standards to deliver superior wiring solutions.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('careers') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-briefcase me-2"></i>Engineering Careers
                        </a>
                        <a href="{{ route('locations') }}" class="btn btn-action btn-lg px-4">
                            <i class="fas fa-building me-2"></i>Our Facilities
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quality Certification Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-4">Certified Quality Excellence</h2>
                        <p class="lead">
                            COFAT Kairouan maintains rigorous quality certifications including:
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> IATF 16949:2016 Certified</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> ISO 9001:2015 Certified</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> ISO 14001 Environmental Management</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> VDA 6.3 Process Audits</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> ISO 45001 Occupational Health & Safety</li>
                        </ul>
                        <div class="cert-badges mt-4">
                            <img src="{{ asset('images/Home/iatf-cert.png') }}" alt="IATF Certification" class="img-fluid me-3" style="max-height: 80px;">
                            <img src="{{ asset('images/Home/iso-cert.png') }}" alt="ISO Certification" class="img-fluid" style="max-height: 80px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="certification-image">
                            <img src="{{ asset('images/Home/quality-certification.png') }}" alt="COFAT Kairouan Quality Certifications" class="img-fluid rounded shadow">
                            <div class="certification-overlay">
                                <i class="fas fa-award"></i>
                                <p>Quality Certified Since 2005</p>
                            </div>
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
            gsap.from('.animate-logo', {
                duration: 1,
                y: -50,
                opacity: 0,
                ease: 'power3.out'
            });
            
            gsap.from('.animate-title', {
                duration: 1,
                y: 30,
                opacity: 0,
                delay: 0.3,
                ease: 'power3.out'
            });
            
            gsap.from('.animate-subtitle', {
                duration: 1,
                y: 30,
                opacity: 0,
                delay: 0.6,
                ease: 'power3.out'
            });
            
            gsap.from('.animate-buttons', {
                duration: 1,
                y: 30,
                opacity: 0,
                delay: 0.9,
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