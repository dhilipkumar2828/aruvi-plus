<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aurvi Plus | Auvri Plus')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vite Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/premium_products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/process.css') }}">
    <link rel="stylesheet" href="{{ asset('css/benefits.css') }}">
    <link rel="stylesheet" href="{{ asset('css/why-choose.css') }}">
    @yield('styles')
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Toastr Custom Styles */
        #toast-container>.toast {
            opacity: 1 !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2) !important;
            border-radius: 12px !important;
            border: none !important;
            padding: 18px 18px 18px 50px !important;
            background-image: none !important;
            font-family: 'Poppins', sans-serif !important;
            font-weight: 500 !important;
            font-size: 14px !important;
        }

        #toast-container>.toast-success {
            background: linear-gradient(135deg, #FF9100 0%, #F44336 50%, #D81B60 100%) !important;
        }

        #toast-container>.toast-error {
            background: linear-gradient(135deg, #FF5252 0%, #D32F2F 100%) !important;
        }

        #toast-container>.toast-info {
            background: linear-gradient(135deg, #FF9100 0%, #F44336 50%, #D81B60 100%) !important;
        }

        #toast-container>.toast-warning {
            background: linear-gradient(135deg, #FFC107 0%, #FFA000 100%) !important;
        }

        #toast-container>.toast i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px !important;
            background: #fff;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        #toast-container>.toast-success i {
            color: #F44336;
        }

        #toast-container>.toast-error i {
            color: #D32F2F;
        }

        #toast-container>.toast-info i {
            color: #F44336;
        }

        #toast-container>.toast-warning i {
            color: #FFA000;
        }

        .toast-progress {
            background-color: rgba(255, 255, 255, 0.4) !important;
            height: 3px !important;
            opacity: 1 !important;
        }

        .toast-close-button {
            top: -2px !important;
            right: 0px !important;
            font-size: 20px !important;
            font-weight: 300 !important;
            opacity: 0.8 !important;
        }

        .toast-close-button:hover {
            opacity: 1 !important;
        }
    </style>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('auri-images/logo.png') }}">
</head>

<body>

    <!-- Header -->
    <header>
        <div class="floating-nav">
            <!-- Inner Content Card -->
            <div class="nav-card-content">
                <!-- Left: Logo & Search -->
                <div class="nav-left">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('auri-images/logo.png') }}" alt="Auvri Plus">
                    </a>
                </div>

                <!-- Center: Navigation Links (Desktop) -->
                <div class="nav-center">
                    <ul class="nav-links">
                        <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                        <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}">About
                                us</a></li>
                        <li class="{{ request()->is('shop') ? 'active' : '' }}"><a href="{{ url('/shop') }}">Shop
                                Collections</a></li>
                        <li class="{{ request()->is('blogs*') ? 'active' : '' }}"><a
                                href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li class="{{ request()->is('contact') ? 'active' : '' }}"><a
                                href="{{ route('contact') }}">Contact us</a></li>
                    </ul>
                </div>

                <!-- Right: Actions -->
                <div class="nav-right">
                    @php
                        $cartCount = collect(session('cart', []))->sum('quantity');
                    @endphp
                    @if (Auth::check() && Auth::user()->role !== 'admin')
                        @php
                            $wishlistCount = \App\Models\Wishlist::where('user_id', Auth::id())->count();
                        @endphp
                        <a href="{{ route('wishlist.index') }}" class="nav-icon-link wishlist-link">
                            <i class="fas fa-heart"></i>
                            @if ($wishlistCount > 0)
                                <span class="wishlist-count" id="wishlist-count-badge">{{ $wishlistCount }}</span>
                            @endif
                        </a>
                    @endif
                    <a href="{{ route('cart.index') }}" class="nav-icon-link cart-link">
                        <i class="fas fa-shopping-cart"></i>
                        @if ($cartCount > 0)
                            <span class="cart-count">{{ $cartCount }}</span>
                        @endif
                    </a>

                    @php
                        $isCustomer = Auth::check() && Auth::user()->role !== 'admin';
                    @endphp

                    @if ($isCustomer)
                        <a href="{{ route('customer.dashboard') }}" class="profile-toggle" title="My Account">
                            @if (Auth::user()->profile_image)
                                <img src="{{ asset(Auth::user()->profile_image) }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 20px;"></i>
                            @endif
                        </a>
                    @else
                        <div class="auth-buttons-desktop">
                            <a href="{{ route('login') }}" class="nav-btn btn-login" style="text-decoration: none;">Log
                                In</a>
                            <a href="{{ route('register') }}" class="nav-btn btn-signup"
                                style="text-decoration: none;">Sign Up</a>
                        </div>
                    @endif

                    <!-- Mobile Menu Toggle -->
                    <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Overlay -->
        <div class="mobile-nav-overlay" id="mobileNav">
            <div class="mobile-nav-content">
                <div class="mobile-nav-header">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('auri-images/logo.png') }}"
                            alt="Auvri Plus">
                    </a>
                    <button class="close-menu" id="closeMenu">&times;</button>
                </div>
                <ul class="mobile-links">
                    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                    <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}">About
                            us</a></li>
                    <li class="{{ request()->is('shop') ? 'active' : '' }}"><a href="{{ url('/shop') }}">Shop
                            Collections</a></li>
                    <li class="{{ request()->is('blogs*') ? 'active' : '' }}"><a
                            href="{{ route('blogs.index') }}">Blogs</a></li>
                    <li class="{{ request()->is('contact') ? 'active' : '' }}"><a
                            href="{{ route('contact') }}">Contact us</a></li>
                </ul>
                <div class="mobile-auth">
                    @if (Auth::check())
                        <a href="{{ route('customer.dashboard') }}" class="btn btn-premium w-full mb-3">My Account</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-premium-outline w-full">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-premium w-full mb-3">Log In</a>
                        <a href="{{ route('register') }}" class="btn btn-premium-outline w-full">Sign Up</a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-columns">
                <div class="footer-col footer-info">
                    <img src="{{ asset('auri-images/logo.png') }}"
                        alt="Auvri Plus Logo" class="footer-logo">
                    <p>Auvri Plus is dedicated to guiding individuals toward prosperity
                        and triumph by harnessing ancient wisdom and spiritual enlightenment.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <div class="quick-links-split-wrapper">
                        <div class="ql-section">
                            <h4>Quick Links</h4>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/about') }}">About Us</a></li>
                                <li><a href="{{ url('/shop') }}">Shop Collections</a></li>
                                <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                            </ul>
                        </div>
                        <div class="ql-section policies-section">
                            <h4 class="policies-heading">Policies</h4>
                            <ul>
                                <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                                <li><a href="{{ route('refund') }}">Return & Refund Policy</a></li>
                                <li><a href="{{ route('shipping') }}">Shipping Policy</a></li>
                                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Recent Articles</h4>
                    @php
                        $recentBlogs = \App\Models\Blog::where('is_published', true)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();
                    @endphp
                    <div class="footer-recent-grid">
                        @foreach ($recentBlogs as $blog)
                            <div class="footer-recent-post">
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="footer-post-img-link">
                                    <div class="footer-post-img-wrapper">
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                            class="footer-post-img">
                                    </div>
                                </a>
                                <div class="footer-post-info">
                                    <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                    <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <div class="footer-contact-wrapper">
                        @php
                            // Fetch the first registered admin (Main Store Owner)
                            $admin = \App\Models\User::where('role', 'admin')->orderBy('id', 'asc')->first();

                            // Default Static Data
                            $contactAddress = 'Palani, Tamil Nadu, India - 624601';
                            $contactEmail = 'contact@Auvri Plus.com';
                            $contactPhone = '+91 98765 43210';

                            if ($admin) {
                                // Address Construction
                                $hasAddress = $admin->address_line1 || $admin->city || $admin->state || $admin->country;
                                if ($hasAddress) {
                                    $addr = '';
                                    if ($admin->address_line1) {
                                        $addr .= $admin->address_line1 . ', ';
                                    }
                                    if ($admin->address_line2) {
                                        $addr .= $admin->address_line2 . ', ';
                                    }
                                    if ($admin->city) {
                                        $addr .= $admin->city;
                                    }
                                    if ($admin->city && $admin->state) {
                                        $addr .= ', ';
                                    }
                                    if ($admin->state) {
                                        $addr .= $admin->state;
                                    }
                                    if ($admin->city || $admin->state) {
                                        $addr .= ', ';
                                    }
                                    if ($admin->country) {
                                        $addr .= $admin->country;
                                    }
                                    if ($admin->postal_code) {
                                        $addr .= ' - ' . $admin->postal_code;
                                    }

                                    $contactAddress = $addr;
                                }

                                if ($admin->email) {
                                    $contactEmail = $admin->email;
                                }
                                if ($admin->phone) {
                                    $contactPhone = $admin->phone;
                                }
                            }

                            $cleanPhone = preg_replace('/[^0-9]/', '', $contactPhone);
                        @endphp

                        <div class="footer-contact-item">
                            <span class="footer-icon-circle"><i class="fas fa-map-marker-alt"></i></span>
                            <span>{!! $contactAddress !!}</span>
                        </div>
                        <div class="footer-contact-item">
                            <span class="footer-icon-circle"><i class="fas fa-envelope"></i></span>
                            <span><a href="mailto:{{ $contactEmail }}"
                                    style="color: inherit; text-decoration: none;">care@Auvri Plusalchemist.com</a></span>
                        </div>
                        <div class="footer-contact-item">
                            <span class="footer-icon-circle"><i class="fab fa-whatsapp"></i></span>
                            <span><a href="https://wa.me/{{ $cleanPhone }}" target="_blank"
                                    style="color: inherit; text-decoration: none;">0794851800,<br
                                        class="mobile-br"> 044 4011 6036</a></span>
                        </div>
                        <div class="footer-contact-item">
                            <span class="footer-icon-circle"><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>33ABFFB7925B1ZT</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-bar">
                <div class="footer-bottom-links">
                    <a href="{{ route('shipping') }}">Shipping</a>
                    <a href="{{ route('terms') }}">Terms of Service</a>
                    <a href="{{ route('privacy') }}">Privacy</a>
                </div>
                <p class="footer-copy">&copy; {{ date('Y') }} Auvri Plus. All
                    Rights Reserved.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery (Required for Toastr and other scripts) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };

        @if (Session::has('success'))
            toastr.success("<i class='fas fa-check'></i> {{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("<i class='fas fa-times'></i> {{ Session::get('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("<i class='fas fa-info'></i> {{ Session::get('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("<i class='fas fa-exclamation'></i> {{ Session::get('warning') }}");
        @endif

        @if ($errors->any())
            toastr.error("<i class='fas fa-exclamation-triangle'></i> {{ $errors->first() }}");
        @endif

        $(document).ready(function() {
            // Global Confirmation Popup
            $(document).on('click', '.delete-confirm', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let message = $(this).data('message') || 'Are you sure you want to remove this?';

                Swal.fire({
                    title: 'Confirmation',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#C2185B',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Remove',
                    cancelButtonText: 'Cancel',
                    borderRadius: '12px',
                    background: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
