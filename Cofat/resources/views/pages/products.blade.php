<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="COFAT Kairouan - Premium automotive wiring solutions including harnesses, connectors, and electrical systems for global vehicle manufacturers">
    <title>Our Products - COFAT Kairouan | Automotive Wiring Solutions</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="{{ asset('images/cofat-logo-white.png') }}" as="image">
    <link rel="preload" href="{{ asset('images/products-hero.jpg') }}" as="image">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/products.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/products.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.cofatkairouan.com/products">
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
                    <h1 class="display-4 fw-bold mb-3 animate-title">Our Automotive Wiring Solutions</h1>
                    <p class="lead mb-4 animate-subtitle">
                        Precision-engineered wiring systems for all vehicle applications
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap animate-buttons">
                        <a href="#product-categories" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-list me-2"></i>View Categories
                        </a>
                        <a href="#custom-solutions" class="btn btn-action btn-lg px-4">
                            <i class="fas fa-cogs me-2"></i>Custom Solutions
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
                                <i class="fas fa-car"></i>
                            </div>
                            <h3 class="stat-number" data-count="150">0</h3>
                            <p class="stat-label">Vehicle Models</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <h3 class="stat-number" data-count="25">0</h3>
                            <p class="stat-label">Product Lines</p>
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
                                <i class="fas fa-globe"></i>
                            </div>
                            <h3 class="stat-number" data-count="30">0</h3>
                            <p class="stat-label">Countries Served</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Product Categories -->
        <section id="product-categories" class="py-5 features-custom">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title text-dark">Product Categories</h2>
                    <p class="lead mb-5">Comprehensive wiring solutions for all automotive applications</p>
                </div>
                <div class="row justify-content-center g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-bolt" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Wiring Harnesses</h3>
                            <p class="mb-0">
                                Complete vehicle wiring systems with custom configurations for passenger cars, commercial vehicles, and specialty applications.
                            </p>
                            <a href="#wiring-harnesses" class="btn btn-action mt-3">View Products</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-plug" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Electrical Connectors</h3>
                            <p class="mb-0">
                                High-performance connectors and terminals designed for reliability in harsh automotive environments.
                            </p>
                            <a href="#connectors" class="btn btn-action mt-3">View Products</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card bg-white h-100">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-project-diagram" aria-hidden="true"></i>
                            </div>
                            <h3 class="h5">Power Distribution</h3>
                            <p class="mb-0">
                                Junction boxes, fuse panels, and power distribution units for modern vehicle electrical architectures.
                            </p>
                            <a href="#power-distribution" class="btn btn-action mt-3">View Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Wiring Harnesses Section -->
        <section id="wiring-harnesses" class="py-5 bg-light">
            <div class="container">
                <h2 class="section-title mb-5">Wiring Harness Systems</h2>
                <div class="row g-4">
                    <!-- Product 1 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/harness-1.jpg') }}" alt="Engine Compartment Harness" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Engine Compartment Harness</h3>
                                <p class="product-description">
                                    High-temperature resistant wiring system for engine bay applications
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Temperature rating: -40°C to 150°C</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Oil & chemical resistant</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Custom lengths available</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 2 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/harness-2.jpg') }}" alt="Chassis Harness" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Chassis Harness</h3>
                                <p class="product-description">
                                    Robust wiring system for vehicle chassis and underbody applications
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Abrasion resistant conduit</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Waterproof connectors</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Vibration tested</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/harness-3.jpg') }}" alt="Interior Harness" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Interior Harness</h3>
                                <p class="product-description">
                                    Complete wiring system for vehicle interior and dashboard
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Low-emission materials</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Modular design</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Quick-connect terminals</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 4 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/harness-4.jpg') }}" alt="HV Harness" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">High Voltage Harness</h3>
                                <p class="product-description">
                                    Specialized wiring for hybrid and electric vehicles
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> 600V+ rated</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Orange safety sheathing</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> EMI shielded</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Connectors Section -->
        <section id="connectors" class="py-5">
            <div class="container">
                <h2 class="section-title mb-5">Electrical Connectors</h2>
                <div class="row g-4">
                    <!-- Product 1 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/connector-1.jpg') }}" alt="Weatherproof Connector" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Weatherproof Connectors</h3>
                                <p class="product-description">
                                    Sealed connectors for exterior vehicle applications
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> IP67 rated</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> 2-24 circuits</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Color-coded options</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 2 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/connector-2.jpg') }}" alt="PCB Connector" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">PCB Connectors</h3>
                                <p class="product-description">
                                    Board-to-wire connectors for electronic control units
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> SMT and thru-hole</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Locking mechanisms</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> High-density options</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/connector-3.jpg') }}" alt="Terminal Blocks" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Terminal Blocks</h3>
                                <p class="product-description">
                                    Modular connection systems for power distribution
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> 5A-100A ratings</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Tool-less installation</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> DIN rail mountable</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 4 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/connector-4.jpg') }}" alt="High Current Connector" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">High Current Connectors</h3>
                                <p class="product-description">
                                    Heavy-duty connectors for battery and charging systems
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> 50A-300A capacity</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Quick-disconnect</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Arc-resistant</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Power Distribution Section -->
        <section id="power-distribution" class="py-5 bg-light">
            <div class="container">
                <h2 class="section-title mb-5">Power Distribution Systems</h2>
                <div class="row g-4">
                    <!-- Product 1 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/pdu-1.jpg') }}" alt="Central Junction Box" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Central Junction Box</h3>
                                <p class="product-description">
                                    Main power distribution unit for vehicle electrical systems
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Integrated fuses/relays</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> CAN bus compatible</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Custom circuit configurations</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 2 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/pdu-2.jpg') }}" alt="Battery Distribution Unit" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Battery Distribution Unit</h3>
                                <p class="product-description">
                                    High-current distribution for battery systems
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Current sensing</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Pre-charge circuits</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Thermal management</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/pdu-3.jpg') }}" alt="Fuse Panel" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Modular Fuse Panel</h3>
                                <p class="product-description">
                                    Compact fuse and relay center for vehicle applications
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Blade/MINI/MAXI fuses</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> LED status indicators</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> IP65 enclosure</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 4 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/pdu-4.jpg') }}" alt="Smart PDU" class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3 class="h5">Smart Power Distribution</h3>
                                <p class="product-description">
                                    Intelligent power management with diagnostics
                                </p>
                                <ul class="product-specs">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Current monitoring</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Programmable logic</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> OTA update capable</li>
                                </ul>
                                <a href="#" class="btn btn-action w-100 mt-3">Request Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Custom Solutions -->
        <section id="custom-solutions" class="cta-section py-5 text-white text-center">
            <div class="cta-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0 text-lg-start">
                        <h2 class="mb-4">Custom Wiring Solutions</h2>
                        <p class="lead">
                            Need something tailored to your specific requirements?
                        </p>
                        <p>Our engineering team can develop custom wiring solutions for:</p>
                        <ul class="list-unstyled text-start">
                            <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Special vehicle applications</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Prototype and low-volume production</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Unique environmental requirements</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Integration with existing systems</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4 bg-white rounded text-dark">
                            <h3 class="h4 mb-4">Request a Custom Solution</h3>
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Address" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Company Name">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="3" placeholder="Describe your requirements"></textarea>
                                </div>
                                <button type="submit" class="btn btn-action w-100">Submit Request</button>
                            </form>
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
            
            // Product card animations
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach((card, index) => {
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