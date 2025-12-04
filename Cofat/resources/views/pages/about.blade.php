<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="COFAT Kairouan - A premier Tunisian manufacturer of automotive wiring systems with 25+ years of expertise, supplying global OEMs with high-quality wiring harnesses and electrical components">
    <title>COFAT Kairouan | About Us</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="{{ asset('images/cofat-logo-white.png') }}" as="image">
    <link rel="preload" href="{{ asset('images/About/cofat-building.jpg') }}" as="image">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/about.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/about.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.cofatkairouan.com/about">
</head>
<body class="about-page">
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
                    <h1 class="display-4 fw-bold mb-4 animate-title">About COFAT Kairouan</h1>
                    <p class="lead mb-4 animate-subtitle">
                        Pioneering Automotive Wiring Solutions Since 1995
                    </p>
                </div>
            </div>
            <div class="hero-scroll-indicator">
                <i class="fas fa-chevron-down"></i>
            </div>
        </section>

        <!-- Company Overview -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h2 class="section-title mb-4">Our Story</h2>
                        <p class="lead">Established in Kairouan, Tunisia, COFAT has evolved from a modest local enterprise to a globally recognized Tier 1 supplier of automotive wiring systems.</p>
                        <p>With our state-of-the-art 15,000 m² manufacturing facility, we deliver precision-engineered wiring harnesses and electrical distribution systems to leading automotive brands across Europe, Africa, and the Middle East. Our commitment to innovation and quality has positioned us as a trusted partner in the industry's transition to electric and autonomous vehicles.</p>
                        <div class="d-flex align-items-center mt-4 stats-container">
                            <div class="pe-4 border-end stat-item">
                                <h3 class="display-5 fw-bold mb-0 counter" data-target="25">0</h3>
                                <p class="mb-0 text-muted">Years of Excellence</p>
                            </div>
                            <div class="px-4 border-end stat-item">
                                <h3 class="display-5 fw-bold mb-0 counter" data-target="500">0</h3>
                                <p class="mb-0 text-muted">Dedicated Professionals</p>
                            </div>
                            <div class="ps-4 stat-item">
                                <h3 class="display-5 fw-bold mb-0 counter" data-target="12">0</h3>
                                <p class="mb-0 text-muted">Million Units Annual Capacity</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-image-container rounded-4 overflow-hidden shadow-lg">
                            <img src="{{ asset('images/About/cofat-building.png') }}" alt="COFAT Kairouan headquarters and manufacturing facility" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values Section -->
        <section class="py-5 features-custom">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title text-dark">Our Core Values</h2>
                    <p class="lead mb-5">The foundation of our corporate identity and operational philosophy</p>
                </div>
                <div class="row justify-content-center g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-award" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Quality Excellence</h3>
                            <p class="mb-0">
                                Certified to IATF 16949:2016 standards, we implement a zero-defect policy with automated optical inspection and 100% electrical testing.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-lightbulb" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Technical Innovation</h3>
                            <p class="mb-0">
                                Our 30-engineer R&D center develops next-gen solutions for high-voltage systems, advanced driver assistance, and smart wiring architectures.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-leaf" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Sustainable Operations</h3>
                            <p class="mb-0">
                                ISO 14001 certified with solar-powered facilities, 92% waste recycling rate, and lead-free manufacturing processes.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-handshake" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Customer Partnership</h3>
                            <p class="mb-0">
                                Co-development programs with OEMs, just-in-time delivery to 15 countries, and 24/7 technical support.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Manufacturing Excellence -->
        <section class="py-5 bg-dark text-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                        <h2 class="section-title text-white mb-4">Manufacturing Excellence</h2>
                        <p class="lead">Our Kairouan Industrial Park facility integrates German engineering with Tunisian craftsmanship to deliver world-class automotive components.</p>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> 18 fully automated Komax cutting/stripping lines</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> 12 robotic crimping stations with vision systems</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Climate-controlled ESD-protected assembly areas</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> In-house UL-approved testing laboratory</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Industry 4.0 data integration for real-time monitoring</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="manufacturing-image rounded-4 overflow-hidden shadow">
                            <img src="{{ asset('images/About/cofat-factory-floor.png') }}" alt="COFAT's advanced manufacturing facility with automated production lines" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Image Gallery Section -->
        <section class="py-5">
            <div class="container">
                <h2 class="section-title text-center mb-5">Our Facilities</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="gallery-item rounded-4 overflow-hidden shadow">
                            <img src="{{ asset('images/About/cofat-production-line.png') }}" alt="COFAT's fully automated wiring harness production line" class="img-fluid">
                            <div class="gallery-caption">Automated Production</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="gallery-item rounded-4 overflow-hidden shadow">
                            <img src="{{ asset('images/About/cofat-quality-control.png') }}" alt="COFAT technician performing final quality inspection" class="img-fluid">
                            <div class="gallery-caption">Quality Assurance</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="gallery-item rounded-4 overflow-hidden shadow">
                            <img src="{{ asset('images/About/cofat-rd-lab.png') }}" alt="COFAT engineers developing next-generation wiring systems" class="img-fluid">
                            <div class="gallery-caption">R&D Innovation</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Client Logos Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="section-title text-center mb-5">Our Trusted Partners</h2>
                <div class="row justify-content-center align-items-center g-4">
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="client-logo-container">
                            <img src="{{ asset('images/About/clients/volkswagen.png') }}" alt="Volkswagen Group" class="img-fluid client-logo" loading="lazy">
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="client-logo-container">
                            <img src="{{ asset('images/About/clients/renault.svg') }}" alt="Renault-Nissan-Mitsubishi Alliance" class="img-fluid client-logo" loading="lazy">
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="client-logo-container">
                            <img src="{{ asset('images/About/clients/peugeot.svg') }}" alt="Stellantis Group" class="img-fluid client-logo" loading="lazy">
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="client-logo-container">
                            <img src="{{ asset('images/About/clients/stellantis.png') }}" alt="Stellantis" class="img-fluid client-logo" loading="lazy">
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="client-logo-container">
                            <img src="{{ asset('images/About/clients/bosch.png') }}" alt="Bosch Automotive" class="img-fluid client-logo" loading="lazy">
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="client-logo-container">
                            <img src="{{ asset('images/About/clients/valeo.png') }}" alt="Valeo Group" class="img-fluid client-logo" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-5 cta-section">
            <div class="container position-relative">
                <h2 class="text-center text-white mb-5">Trusted By Industry Leaders</h2>
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Testimonial 1 -->
                        <div class="carousel-item active">
                            <div class="testimonial-card bg-white rounded-4 p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-4 mb-md-0">
                                        <img src="{{ asset('images/testimonials/client1.jpg') }}" class="testimonial-img rounded-circle shadow" alt="Volkswagen Executive">
                                        <div class="client-logo mt-3">
                                            <img src="{{ asset('images/About/clients/volkswagen.png') }}" alt="Volkswagen Logo" style="height: 40px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <i class="fas fa-quote-left quote-icon text-dark"></i>
                                        <blockquote class="mb-4 text-dark">
                                            "COFAT has been our strategic wiring harness supplier since 2015. Their technical expertise in high-voltage systems and consistent quality have been crucial for our electric vehicle programs across Europe and North Africa."
                                        </blockquote>
                                        <div class="client-info">
                                            <h4 class="h6 mb-1 text-dark">Pierre Lefèvre</h4>
                                            <p class="text-muted small mb-0">Senior Procurement Director, Volkswagen Group</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Testimonial 2 -->
                        <div class="carousel-item">
                            <div class="testimonial-card bg-white rounded-4 p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-4 mb-md-0">
                                        <img src="{{ asset('images/testimonials/client2.jpg') }}" class="testimonial-img rounded-circle shadow" alt="Renault Executive">
                                        <div class="client-logo mt-3">
                                            <img src="{{ asset('images/About/clients/renault.svg') }}" alt="Renault Logo" style="height: 40px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <i class="fas fa-quote-left quote-icon text-dark"></i>
                                        <blockquote class="mb-4 text-dark">
                                            "COFAT's Tunisian operation delivers German-level quality at competitive costs. Their just-in-time delivery to our Tangier plant has never missed a deadline, even during peak production periods."
                                        </blockquote>
                                        <div class="client-info">
                                            <h4 class="h6 mb-1 text-dark">Amina Ben Salah</h4>
                                            <p class="text-muted small mb-0">Supply Chain Manager, Renault-Nissan-Mitsubishi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="carousel-item">
                            <div class="testimonial-card bg-white rounded-4 p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-4 mb-md-0">
                                        <img src="{{ asset('images/testimonials/client3.jpg') }}" class="testimonial-img rounded-circle shadow" alt="Stellantis Executive">
                                        <div class="client-logo mt-3">
                                            <img src="{{ asset('images/About/clients/peugeot.svg') }}" alt="Peugeot Logo" style="height: 40px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <i class="fas fa-quote-left quote-icon text-dark"></i>
                                        <blockquote class="mb-4 text-dark">
                                            "The engineering collaboration with COFAT on our new EV platform reduced wiring weight by 18% while improving reliability. Their Tunisian-German technical team brings exceptional value."
                                        </blockquote>
                                        <div class="client-info">
                                            <h4 class="h6 mb-1 text-dark">Thomas Müller</h4>
                                            <p class="text-muted small mb-0">Chief Engineer, Stellantis Electric Vehicles</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-5 text-center">
            <div class="container">
                <h2 class="mb-3">Ready to Partner With COFAT?</h2>
                <p class="lead mb-4 mx-auto" style="max-width: 700px;">
                    Whether you need standard wiring solutions or custom-developed systems for your next vehicle platform, our engineering team is ready to collaborate.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('contact') }}" class="btn btn-action btn-lg px-4">
                        <i class="fas fa-envelope me-2"></i> Contact Our Team
                    </a>
                    <a href="{{ route('products') }}" class="btn btn-outline-dark btn-lg px-4">
                        <i class="fas fa-box-open me-2"></i> Explore Our Solutions
                    </a>
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
        // Counter Animation Function
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200;
            
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;
                
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(animateCounters, 1);
                } else {
                    counter.innerText = target + (counter.getAttribute('data-target') === '12' ? 'M+' : '+');
                }
            });
        }

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
            
            // Scroll indicator animation
            gsap.to('.hero-scroll-indicator', {
                y: 10,
                repeat: -1,
                yoyo: true,
                duration: 1.5,
                ease: 'sine.inOut'
            });
            
            // Stats counter animation
            gsap.to('.stats-container', {
                scrollTrigger: {
                    trigger: '.stats-container',
                    start: "top 75%",
                    onEnter: animateCounters,
                    once: true
                }
            });
            
            // Stat item animations
            const statItems = document.querySelectorAll('.stat-item');
            statItems.forEach((item, index) => {
                gsap.from(item, {
                    scrollTrigger: {
                        trigger: item,
                        start: "top 80%",
                        toggleActions: "play none none none"
                    },
                    duration: 0.8,
                    y: 30,
                    opacity: 0,
                    delay: index * 0.2,
                    ease: 'back.out(1)'
                });
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
            
            // Gallery item animations
            const galleryItems = document.querySelectorAll('.gallery-item');
            galleryItems.forEach((item, index) => {
                gsap.from(item, {
                    scrollTrigger: {
                        trigger: item,
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

            // Client logo animations
            const clientLogos = document.querySelectorAll('.client-logo-container');
            clientLogos.forEach((logo, index) => {
                gsap.from(logo, {
                    scrollTrigger: {
                        trigger: logo,
                        start: "top 85%",
                        toggleActions: "play none none none"
                    },
                    duration: 0.6,
                    scale: 0.8,
                    opacity: 0,
                    delay: index * 0.05,
                    ease: 'power2.out'
                });

                // Hover effect
                logo.addEventListener('mouseenter', () => {
                    gsap.to(logo, {
                        duration: 0.3,
                        scale: 1.05,
                        ease: 'power2.out'
                    });
                });
                logo.addEventListener('mouseleave', () => {
                    gsap.to(logo, {
                        duration: 0.3,
                        scale: 1,
                        ease: 'power2.out'
                    });
                });
            });

            // Testimonial animations
            const testimonials = document.querySelectorAll('.testimonial-card');
            testimonials.forEach((testimonial) => {
                gsap.from(testimonial, {
                    scrollTrigger: {
                        trigger: testimonial,
                        start: "top 75%",
                        toggleActions: "play none none none"
                    },
                    duration: 0.8,
                    y: 50,
                    opacity: 0,
                    ease: 'back.out(1)'
                });
            });
        });
    </script>
</body>
</html>