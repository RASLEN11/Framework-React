<link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
<footer class="modern-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <!-- Logo Section -->
            <div class="footer-brand">
                <img src="{{ asset('images/LogoCofat.png') }}" alt="COFAT Logo" class="footer-logo">
                <div class="footer-brand-text">
                    <span class="footer-brand-main">COFAT</span>
                    <span class="footer-brand-sub">KAIRIOUAN</span>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="footer-section">
                <h4 class="footer-section-title"><i class="fas fa-envelope-open-text"></i> Contact Us</h4>
                <ul class="footer-links">
                    <li>
                        <a href="mailto:contact@cofat.com.tn" class="footer-link">
                            <i class="fas fa-envelope"></i> contact@cofat.com.tn
                        </a>
                    </li>
                    <li>
                        <a href="tel:+21677412700" class="footer-link">
                            <i class="fas fa-phone-alt"></i> +216 77 412 700
                        </a>
                    </li>
                    <li class="footer-link">
                        <i class="fas fa-fax"></i> +216 77 412 701
                    </li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="footer-section">
                <h4 class="footer-section-title"><i class="fas fa-link"></i> Quick Links</h4>
                <ul class="footer-links">
                    <li>
                        <a href="{{ route('home') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> About
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('apply.index') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> Apply
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> Contact
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Stats') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> Statistics
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Social & Newsletter -->
            <div class="footer-section">
                <h4 class="footer-section-title"><i class="fas fa-share-alt"></i> Connect</h4>
                <div class="social-icons">
                    <a href="https://www.facebook.com/CofatGroupe/" class="social-icon" target="_blank" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/cofat-group/" class="social-icon" target="_blank" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com/cofatgroup/" class="social-icon" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/results?search_query=cofat+tunisie" class="social-icon" target="_blank" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
                
                <div class="company-info">
                    <p><i class="fas fa-map-marker-alt"></i> Industrial Zone, Kairouan, Tunisia</p>
                    <p><i class="fas fa-clock"></i> Mon-Fri: 8:00 AM - 5:00 PM</p>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="copyright">
                &copy; {{ now()->year }} <strong>COFAT KAIROUAN GROUP</strong>. All rights reserved.
            </p>
            <p class="developer-credit">
                Site developed by <strong><a href="https://www.instagram.com/raslen.11" target="_blank" rel="noopener noreferrer">RASLEN11</a></strong> – 
                <a href="mailto:rkalboussi15@gmail.com">rkalboussi15@gmail.com</a>
            </p>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate footer elements on scroll into view
    const animateOnScroll = () => {
        const footer = document.querySelector('.modern-footer');
        if (footer && !footer.classList.contains('animated')) {
            const rect = footer.getBoundingClientRect();
            if (rect.top <= window.innerHeight * 0.8) {
                footer.classList.add('animated');
            }
        }
    };

    // Initial check
    animateOnScroll();
    
    // Check on scroll
    window.addEventListener('scroll', animateOnScroll);
});
</script>