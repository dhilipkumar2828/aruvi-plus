<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auvri Plus - Authentic Ayurvedic Remedies')</title>
    <meta name="description" content="@yield('meta_description', 'Authentic Ayurvedic remedies crafted for your modern lifestyle. Pure, potent, and proven.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Script Font -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- Auri Styles -->
    <link rel="stylesheet" href="{{ asset('auri-style.css') }}">
    @yield('extra_css')
</head>
<body>
    <!-- Header -->
    <header id="main-header">
        <div class="container header-wrapper">
            <div class="logo">
                <a href="{{ route('home') }}"><img src="{{ asset('auri-images/logo.png') }}" alt="Auvri Plus" style="height: 50px;"></a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                    <li><a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Products</a></li>
                    <li><a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
            </nav>
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" id="mobileMenuToggle" onclick="document.querySelector('.nav-links').classList.toggle('mobile-open')">
                <i class="fas fa-bars"></i>
            </button>
            <div class="header-icons">
                @auth
                    <a href="{{ route('customer.dashboard') }}"><i class="far fa-user"></i></a>
                @else
                    <a href="{{ route('login') }}"><i class="far fa-user"></i></a>
                @endauth
                <a href="{{ route('cart.index') }}" class="cart-widget">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">{{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="site-alert site-alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="site-alert site-alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="main-footer">
        <div class="container footer-grid">
            <!-- Col 0: Logo -->
            <div class="f-col footer-brand">
                <img src="{{ asset('auri-images/logo.png') }}" alt="Auvri Plus" style="height: 60px; margin-bottom: 20px;">
                <p style="color: #ccc; font-size: 0.9rem; line-height: 1.6;">Authentic Ayurvedic remedies crafted for your modern lifestyle. Pure, potent, and proven.</p>
            </div>
            <!-- Col 1: Help -->
            <div class="f-col">
                <h4>HELP</h4>
                <div class="f-line"></div>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('shop') }}">Shop Now</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <!-- Col 2: Policy -->
            <div class="f-col">
                <h4>POLICY</h4>
                <div class="f-line"></div>
                <ul>
                    <li><a href="{{ route('terms') }}">Terms &amp; Conditions</a></li>
                    <li><a href="{{ route('faq') }}">FAQ's</a></li>
                    <li><a href="{{ route('shipping') }}">Shipping Policy</a></li>
                    <li><a href="{{ route('refund') }}">Refund &amp; Returns Policy</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>
            <!-- Col 3: Reach Us -->
            <div class="f-col">
                <h4>REACH US</h4>
                <div class="f-line"></div>
                <ul class="contact-list">
                    <li><i class="fas fa-map-marker-alt"></i> Chennai, Tamil Nadu, India</li>
                    <li><i class="fas fa-phone-alt"></i> +91 9818299669</li>
                    <li><i class="fas fa-envelope"></i> click2mk@gmail.com</li>
                </ul>
                <div class="social-icons">
                    <a href="https://www.facebook.com/auvriplus/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            &copy; {{ date('Y') }} Auvri Plus. All rights reserved.
        </div>
    </footer>

    <!-- Premium Scroll Button -->
    <div id="premiumScrollWrapper" class="premium-scroll-wrapper">
        <div id="premiumScrollBtn" class="premium-scroll-btn" onclick="scrollToTop()">
            <div class="progress-ring-circle">
                <svg class="progress-ring" width="60" height="60">
                    <circle class="progress-ring__circle" stroke="#2e7d32" stroke-width="4" fill="transparent" r="26" cx="30" cy="30" />
                </svg>
            </div>
            <div class="btn-content">
                <div class="leaf-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.2 17.6C21.7 13.6 20.8 9 17.8 6C14.8 3 10.2 2.1 6.2 3.6C6.2 3.6 15 12 17.6 20.2ZM6.2 3.6C3.9 9.3 4.5 15.9 8.5 20.9C9.2 21.8 10.5 21.9 11.4 21.2C11.9 20.8 14.2 18.8 14.2 18.8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Auri Scripts -->
    <script src="{{ asset('auri-script.js') }}"></script>
    <script>
        // Scroll button
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        window.addEventListener('scroll', function() {
            const btn = document.getElementById('premiumScrollBtn');
            const circle = document.querySelector('.progress-ring__circle');
            const scrollTop = window.scrollY;
            const docHeight = document.body.offsetHeight - window.innerHeight;
            const scrollPercent = Math.min((scrollTop / docHeight) * 100, 100);
            if (circle) {
                const radius = circle.r.baseVal.value;
                const circumference = 2 * Math.PI * radius;
                const offset = circumference - (scrollPercent / 100) * circumference;
                circle.style.strokeDashoffset = offset;
                circle.style.strokeDasharray = circumference;
            }
            if (btn) {
                btn.classList.toggle('visible', scrollTop > 100);
            }
        });

        // Alert auto-dismiss
        setTimeout(() => {
            document.querySelectorAll('.site-alert').forEach(el => el.style.opacity = '0');
        }, 4000);

        // Intersection Observer for reveal animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) entry.target.classList.add('revealed');
            });
        }, { threshold: 0.15 });
        document.querySelectorAll('section, .sense-card, .radial-container, .dosha-strip, .about-split').forEach(el => {
            el.classList.add('reveal-on-scroll');
            observer.observe(el);
        });
    </script>
    @yield('extra_js')
</body>
</html>
