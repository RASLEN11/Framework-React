<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="COFAT Kairouan Global Locations - Automotive wiring systems manufacturing facilities worldwide">
    <title>Our Locations - COFAT Kairouan</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" as="style">
    <link rel="preload" href="{{ asset('images/cofat-logo-white.png') }}" as="image">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/pages/locations.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/location.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
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
            <div class="container text-center position-relative">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold mb-4 animate-title">Our Global Presence</h1>
                    <p class="lead mb-4 animate-subtitle">
                        Manufacturing excellence across continents for global automotive partners
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
                            <h3 class="stat-number" data-count="6">0</h3>
                            <p class="stat-label">Manufacturing Sites</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-industry"></i>
                            </div>
                            <h3 class="stat-number" data-count="3">0</h3>
                            <p class="stat-label">Continents</p>
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
        
        <!-- Map Section -->
        <section class="section-container">
            <div class="container">
                <h2 class="section-title">COFAT Global Facilities</h2>
                <p class="lead text-center mb-5">Strategic locations serving automotive manufacturers worldwide</p>
                <div class="map-container" id="map"></div>
            </div>
        </section>

        <!-- Locations Grid -->
        <section class="section-container">
            <div class="container">
                <h2 class="section-title">Our Manufacturing Sites</h2>
                <p class="lead text-center mb-5">State-of-the-art facilities producing automotive wiring systems</p>
                
                <div class="row justify-content-center g-4">
                    <!-- Tunisia - Kairouan -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-industry" aria-hidden="true"></i>
                            </div>
                            <h3>Tunisia 🇹🇳 - Kairouan</h3>
                            <p class="mb-0">
                                Headquarters & Main Production Facility with full-scale wiring harness manufacturing capabilities.
                            </p>
                        </div>
                    </div>

                    <!-- Tunisia - Mateur -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-robot" aria-hidden="true"></i>
                            </div>
                            <h3>Tunisia 🇹🇳 - Mateur</h3>
                            <p class="mb-0">
                                Automated Wiring Harness Production facility with robotic assembly lines.
                            </p>
                        </div>
                    </div>

                    <!-- Tunisia - El Fahs -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-car-battery" aria-hidden="true"></i>
                            </div>
                            <h3>Tunisia 🇹🇳 - El Fahs</h3>
                            <p class="mb-0">
                                Specialized in electromechanical assemblies and complex component integration.
                            </p>
                        </div>
                    </div>

                    <!-- Tunisia - Sousse -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-microchip" aria-hidden="true"></i>
                            </div>
                            <h3>Tunisia 🇹🇳 - Sousse</h3>
                            <p class="mb-0">
                                Engineering & R&D Center driving innovation in automotive electrical systems.
                            </p>
                        </div>
                    </div>

                    <!-- Morocco -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-truck" aria-hidden="true"></i>
                            </div>
                            <h3>Morocco 🇲🇦 - Tangier</h3>
                            <p class="mb-0">
                                North Africa Distribution Hub serving regional automotive manufacturers.
                            </p>
                        </div>
                    </div>

                    <!-- Romania -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-car" aria-hidden="true"></i>
                            </div>
                            <h3>Romania 🇷🇴 - Arad</h3>
                            <p class="mb-0">
                                European Production Facility with just-in-time delivery to EU automakers.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="cta-section">
            <div class="container text-center">
                <h2 class="mb-4">Global Network of Excellence</h2>
                <p class="lead mb-4">
                    With facilities across 3 continents, we deliver precision wiring solutions to OEMs worldwide with consistent quality standards.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('careers') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-briefcase me-2"></i>Join Our Team
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-action btn-lg px-4">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    
    <script>
        // Initialize map
        const map = L.map('map').setView([34.0, 9.0], 3); // Center on North Africa/Europe
        
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://carto.com/">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        // Custom icon
        const cofatIcon = L.icon({
            iconUrl: '{{ asset("images/map-marker.png") }}',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        // Locations data
        const locations = [
            { 
                name: "COFAT Kairouan (HQ)", 
                coords: [35.6781, 10.1000], 
                description: "Headquarters & Main Production Facility",
                icon: "<i class='fas fa-industry me-2'></i>"
            },
            { 
                name: "COFAT Mateur", 
                coords: [37.0403, 9.6658], 
                description: "Automated Wiring Harness Production",
                icon: "<i class='fas fa-robot me-2'></i>"
            },
            { 
                name: "COFAT El Fahs", 
                coords: [36.0250, 9.6333], 
                description: "Electromechanical Assemblies",
                icon: "<i class='fas fa-car-battery me-2'></i>"
            },
            { 
                name: "COFAT Sousse", 
                coords: [35.8256, 10.6084], 
                description: "Engineering & R&D Center",
                icon: "<i class='fas fa-microchip me-2'></i>"
            },
            { 
                name: "COFAT Morocco", 
                coords: [35.7673, -5.7998], 
                description: "North Africa Distribution Hub",
                icon: "<i class='fas fa-truck me-2'></i>"
            },
            { 
                name: "COFAT Romania", 
                coords: [46.1833, 21.3167], 
                description: "European Production Facility",
                icon: "<i class='fas fa-car me-2'></i>"
            }
        ];

        // Add markers to map
        locations.forEach(loc => {
            L.marker(loc.coords, {icon: cofatIcon}).addTo(map)
                .bindPopup(`
                    <div class="map-popup">
                        <h5>${loc.icon} ${loc.name}</h5>
                        <p>${loc.description}</p>
                        <small><i class="fas fa-map-marker-alt me-1"></i> ${loc.coords[0].toFixed(4)}°N, ${loc.coords[1].toFixed(4)}°E</small>
                    </div>
                `);
        });

        // Animations
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
            
            // Feature cards animation
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
        });
    </script>
</body>
</html>