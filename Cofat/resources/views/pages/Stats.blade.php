<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="COFAT Kairouan Dashboard - Automotive wiring systems production statistics">
    <title>COFAT Kairouan | Production Dashboard</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="{{ asset('images/cofat-logo-white.png') }}" as="image">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/stats.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/stats.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
</head>
<body class="stats-page">
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
                    <h1 class="display-4 fw-bold mb-4 animate-title">COFAT Kairouan Production Dashboard</h1>
                    <p class="lead mb-4 animate-subtitle">
                        Real-time statistics of our automotive wiring systems production
                    </p>
                </div>
            </div>
            <div class="hero-scroll-indicator">
                <i class="fas fa-chevron-down"></i>
            </div>
        </section>

        <!-- Production Stats Section -->
        <section class="py-5 stats-section">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Production Statistics</h2>
                    <p class="lead">Key metrics showing our manufacturing performance and output</p>
                </div>
                
                <div class="row g-4 stats-row">
                    <!-- Main Statistics -->
                    <div class="col-md-3 col-6 animate-card">
                        <div class="dashboard-card">
                            <i class="fas fa-car-battery stat-icon pulse"></i>
                            <h3>Wiring Harnesses</h3>
                            <p class="fs-3 fw-bold mb-0 text-primary counter" data-target="12500">0</p>
                            <small class="text-muted">produced this month</small>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-6 animate-card">
                        <div class="dashboard-card">
                            <i class="fas fa-microchip stat-icon pulse"></i>
                            <h3>ECU</h3>
                            <h3>Assemblies</h3>
                            <p class="fs-3 fw-bold mb-0 text-success counter" data-target="6250">0</p>
                            <small class="text-muted">electronic control units</small>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-6 animate-card">
                        <div class="dashboard-card">
                            <i class="fas fa-tachometer-alt stat-icon pulse"></i>
                            <h3>Instrument Panels</h3>
                            <p class="fs-3 fw-bold mb-0 text-info counter" data-target="8500">0</p>
                            <small class="text-muted">dashboard assemblies</small>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-6 animate-card">
                        <div class="dashboard-card">
                            <i class="fas fa-robot stat-icon pulse"></i>
                            <h3>Automated Tests</h3>
                            <p class="fs-3 fw-bold mb-0 text-warning counter" data-target="12500">0</p>
                            <small class="text-muted">quality checks passed</small>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 95%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quality Metrics Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Quality Metrics</h2>
                    <p class="lead">Our commitment to excellence in automotive wiring systems</p>
                </div>
                
                <div class="row g-4 stats-row">
                    <div class="col-md-4 animate-card">
                        <div class="dashboard-card">
                            <i class="fas fa-certificate stat-icon pulse"></i>
                            <h3>Quality Certifications</h3>
                            <p class="fs-3 fw-bold mb-0 text-primary counter" data-target="12">0</p>
                            <small class="text-muted">international standards</small>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 animate-card">
                        <div class="dashboard-card">
                            <i class="fas fa-check-circle stat-icon pulse"></i>
                            <h3>Defect Rate</h3>
                            <p class="fs-3 fw-bold mb-0 text-success counter" data-target="99.8">0</p>
                            <small class="text-muted">% defect-free products</small>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 99.8%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 animate-card">
                        <div class="dashboard-card">
                            <i class="fas fa-clock stat-icon pulse"></i>
                            <h3>On-Time Delivery</h3>
                            <p class="fs-3 fw-bold mb-0 text-info counter" data-target="98.5">0</p>
                            <small class="text-muted">% shipments on schedule</small>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 98.5%"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    
    <script>
        // Intersection Observer for animations
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
            
            // Stats cards animation
            const statCards = document.querySelectorAll('.animate-card');
            statCards.forEach((card, index) => {
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
            
            // Counter animation
            const counters = document.querySelectorAll('.counter');
            const speed = 200;
            
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;
                
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCounter, 1, counter, target, increment);
                } else {
                    counter.innerText = target;
                }
            });

            function updateCounter(counter, target, increment) {
                const count = +counter.innerText;
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCounter, 1, counter, target, increment);
                } else {
                    counter.innerText = target;
                }
            }
        });
    </script>
</body>
</html>