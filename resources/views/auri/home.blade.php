@extends('layouts.auri')

@section('title', 'Auvri Plus - Authentic Ayurvedic Remedies')
@section('meta_description', 'From herbal powders to nourishing oils and capsules, our Ayurvedic remedies support balance, vitality, and daily well-being.')

@section('content')
    <!-- 1. Hero -->
    <section class="hero-section">
        <div class="hero-slider">
            <!-- Slide 1 -->
            <div class="hero-slide active"
                style="background-image: var(--hero-bg), url('{{ asset('auri-images/background-main.png') }}');">
                <div class="container hero-container">
                    <div class="hero-text-content">
                        <h1 class="hero-title">Nature's Wisdom for Modern Wellness</h1>
                        <p class="hero-subtitle">From herbal powders to nourishing oils and capsules, our Ayurvedic remedies
                            are
                            carefully prepared to support balance, vitality, and daily well-being.</p>
                        <div class="hero-btns-wrapper">
                            <a href="{{ route('herbal.products') }}" class="btn-hero-primary">Explore Collection</a>
                            <a href="https://wa.me/919818299669" class="btn-hero-outline" target="_blank">
                                <i class="fab fa-whatsapp"></i> Need Help
                            </a>
                        </div>
                    </div>
                    <div class="hero-media-content">
                        <div class="hero-video-wrapper">
                            <video autoplay muted loop playsinline webkit-playsinline class="hero-video">
                                <source src="{{ asset('auri-images/video/main.webm') }}" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="hero-slide" style="background-image: var(--hero-bg), url('{{ asset('images/hero_1.png') }}'); background-position: center center; background-size: cover; background-repeat: no-repeat; width: 100%; height: 100%;">
                <div class="container hero-container">
                    <div class="hero-text-content">
                        <h1 class="hero-title">Divine Essence of Navapashanam</h1>
                        <p class="hero-subtitle">Experience the sacred energy of the Navapashanam Shivalingam, a rare
                            alchemical marvel crafted for spiritual awakening, inner peace, and holistic healing.</p>
                        <div class="hero-btns-wrapper">
                            <a href="{{ route('navapashanam.products') }}" class="btn-hero-primary">Explore Collection</a>
                            <a href="https://wa.me/919818299669" class="btn-hero-outline" target="_blank">
                                <i class="fab fa-whatsapp"></i> Need Help
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- Slider Dots -->
        <div class="hero-dots">
            <span class="hero-dot active" data-index="0"></span>
            <span class="hero-dot" data-index="1"></span>
        </div>
    </section>

    <style>
        :root {
            --hero-bg: linear-gradient(rgba(0, 44, 0, 0.7), rgba(0, 44, 0, 0.7));
            --primary-green: #004200;
            --accent-gold: #d4af37;
            --white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        html, body {
            overflow-x: hidden !important;
            width: 100%;
            position: relative;
        }

        .hero-section {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 85vh;
            /* Reduced from 100vh */
            background: var(--primary-green);
            padding: 0 !important;
        }

        .hero-slider {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
            padding: 120px 0 40px;
            /* Reduced bottom padding from 80px */
            will-change: transform, opacity;
            backface-visibility: hidden;
        }

        .hero-slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 2;
        }

        .hero-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 3;
            width: 92%;
            max-width: 1300px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: clamp(2.4rem, 4.5vw, 4rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 28px;
            font-family: 'Playfair Display', serif;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.8s ease 0.2s;
        }

        .hero-slide.active .hero-title {
            transform: translateY(0);
            opacity: 1;
        }

        .hero-subtitle {
            font-size: clamp(0.95rem, 1.2vw, 1.15rem);
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            max-width: 500px;
            line-height: 1.6;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.8s ease 0.4s;
        }

        .hero-slide.active .hero-subtitle {
            transform: translateY(0);
            opacity: 1;
        }

        .hero-btns-wrapper {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.8s ease 0.6s;
        }

        .hero-slide.active .hero-btns-wrapper {
            transform: translateY(0);
            opacity: 1;
        }

        .btn-hero-primary {
            background: var(--primary-green);
            color: var(--white);
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-green);
            box-shadow: 0 10px 20px rgba(0, 66, 0, 0.3);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 66, 0, 0.4);
            background: #005a00;
            border-color: #005a00;
        }

        .btn-hero-outline {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: var(--white);
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .btn-hero-outline:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: var(--white);
            transform: translateY(-3px);
        }

        .hero-media-content {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: scale(0.95) translateX(20px);
            opacity: 0;
            transition: all 1s ease 0.3s;
        }

        .hero-slide.active .hero-media-content {
            transform: scale(1) translateX(0);
            opacity: 1;
        }

        .hero-video-wrapper,
        .hero-img-wrapper-premium {
            width: 100%;
            max-width: 550px;
            aspect-ratio: 4/3;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            animation: floatHero 6s ease-in-out infinite;
        }

        .hero-video,
        .hero-display-img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        /* Arrows Styling */
        .hero-arrows {
            position: absolute;
            bottom: 40px;
            right: 5%;
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .hero-arrow-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .hero-arrow-btn:hover {
            background: var(--accent-gold);
            color: #000;
            border-color: var(--accent-gold);
            transform: scale(1.1);
        }

        /* Dots Styling */
        .hero-dots {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .hero-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .hero-dot.active {
            background: var(--accent-gold);
            width: 30px;
            border-radius: 10px;
        }

        @keyframes floatHero {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @media (max-width: 991px) {
            .hero-section {
                height: 780px !important; /* Fixed height to prevent jumps */
                min-height: 780px !important;
                padding: 0 !important;
            }

            .hero-slide {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                display: none;
                opacity: 1;
                visibility: visible;
                padding: 120px 0 60px;
                height: 100% !important; /* Force same height as section */
            }

            .hero-slide.active {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 30px;
                padding-top: 20px;
            }

            .hero-text-content {
                order: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 0 10px;
            }

            .hero-title {
                font-size: 2.2rem;
                margin-bottom: 20px;
            }

            .hero-subtitle {
                font-size: 1rem;
                margin-bottom: 30px;
                margin-left: auto;
                margin-right: auto;
            }

            .hero-media-content {
                order: 2;
                transform: none !important;
                opacity: 1 !important;
                margin-top: 20px;
            }

            .hero-btns-wrapper {
                justify-content: center;
                gap: 10px;
            }

            .hero-arrows {
                bottom: 15px;
                right: 15px;
            }

            .hero-dots {
                bottom: 15px;
            }

            .hero-video-wrapper,
            .hero-img-wrapper-premium {
                max-width: 70%;
                aspect-ratio: 16/9;
            }

            .hero-video,
            .hero-display-img {
                height: 100% !important;
                width: 100% !important;
                object-fit: cover !important;
            }
        }

        /* Best Sellers Slider Fix */
        #bestsellers .product-grid {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            gap: 25px !important;
            padding: 20px 0 !important;
            justify-content: flex-start !important;
            align-items: stretch !important;
            scroll-behavior: smooth !important;
            -webkit-overflow-scrolling: touch !important;
            scrollbar-width: none !important;
        }

        #bestsellers .product-grid::-webkit-scrollbar {
            display: none !important;
        }

        #bestsellers .product-card {
            flex: 0 0 calc((100% - 50px) / 3) !important;
            width: calc((100% - 50px) / 3) !important;
            min-width: 300px !important;
            margin-bottom: 0 !important;
        }

        @media (max-width: 991px) {
            #bestsellers .product-card {
                flex: 0 0 calc((100% - 25px) / 2) !important;
                min-width: 250px !important;
            }
        }


    </style>


    <section class="ingredients-section shadow-text-sec" style="padding-top: 0;">
        <div class="container" style="position: relative;">
            <h2 class="sec-title-nature">Powered by Herbal Products</h2>

            <div class="category-wrapper" style="position: relative; padding: 0 70px; margin: 0 auto; max-width: 100%; overflow: hidden;">
                <button id="btn-herbal-prev" class="testi-nav testi-prev" onclick="scrollHerbal('prev')"
                    style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="ing-scroller" id="scroller-herbal" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @foreach($categories as $category)
                        @if($category->is_herbal)
                            <a href="{{ route('category.show', $category->slug) }}" class="ing-pill herbal-card" id="scroller-herbal-item"
                                style="text-decoration: none; color: inherit;">
                            @php
                                $img_path = $category->image;
                                if ($img_path && !str_starts_with($img_path, 'http') && !str_starts_with($img_path, '/')) {
                                    $img_path = asset($img_path);
                                }
                            @endphp
                            @if($img_path)
                                <img src="{{ $img_path }}" alt="{{ $category->name }}"
                                    onerror="this.src='https://via.placeholder.com/150?text={{ urlencode(substr($category->name, 0, 1)) }}'">
                            @else
                                <img src="https://via.placeholder.com/150?text={{ urlencode(substr($category->name, 0, 1)) }}"
                                    alt="{{ $category->name }}">
                            @endif
                            <div class="ing-txt"><strong>{{ $category->name }}</strong></div>
                            </a>
                        @endif
                    @endforeach
                </div>

                <button id="btn-herbal-next" class="testi-nav testi-next" onclick="scrollHerbal('next')"
                    style="position: absolute; right: 0px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <style>
                .sec-title-nature {
                    color: var(--primary);
                    text-align: center;
                    padding-top: 30px;
                    margin-bottom: 40px;
                    font-family: var(--font-heading);
                    font-size: 2.5rem;
                }

                .ing-scroller {
                    display: flex !important;
                    flex-wrap: nowrap !important;
                    overflow-x: auto !important;
                    gap: 25px !important;
                    padding: 40px 0 !important;
                    margin: 0 !important;
                    justify-content: flex-start !important;
                    align-items: stretch;
                    scroll-behavior: smooth;
                    -webkit-overflow-scrolling: touch;
                    scrollbar-width: none;
                }

                @media (min-width: 600px) {
                    .ing-scroller, .product-grid, .reviews-grid {
                        justify-content: flex-start !important;
                        overflow-x: auto !important;
                        scroll-snap-type: x mandatory !important;
                        padding-left: 0 !important;
                        padding-right: 0 !important;
                        scrollbar-width: none !important;
                        display: flex !important;
                        flex-wrap: nowrap !important;
                        gap: 25px !important; /* Standard gap for perfect 3-col math */
                    }
                    .ing-scroller::-webkit-scrollbar, .product-grid::-webkit-scrollbar, .reviews-grid::-webkit-scrollbar {
                        display: none !important;
                    }
                    .category-wrapper, .product-slider-wrapper, .testimonial-wrapper {
                        overflow: hidden !important;
                        padding: 0 70px !important;
                        max-width: 1200px !important;
                        margin: 0 auto !important;
                        position: relative !important;
                    }
                    .product-card, .ing-pill, .white-floating-card, .testimonial-card {
                        flex: 0 0 calc((100% - 50px) / 3) !important;
                        width: calc((100% - 50px) / 3) !important;
                        min-width: 0 !important;
                        scroll-snap-align: start !important;
                        margin: 0 !important; /* Ensure no extra deviation */
                    }
                }

                .ing-scroller::-webkit-scrollbar {
                    display: none !important;
                }

                .ing-pill {
                    background: #fff;
                    border: 1.5px solid #f0f0f0;
                    border-radius: 25px;
                    padding: 30px 20px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    gap: 15px;
                    transition: all 0.3s ease;
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
                }

                .ing-pill:hover {
                    border-color: var(--primary);
                    transform: translateY(-3px);
                    box-shadow: 0 12px 30px rgba(0, 66, 0, 0.1);
                }

                .ing-pill img {
                    width: 90px;
                    height: 90px;
                    border-radius: 50%;
                    object-fit: cover;
                    flex-shrink: 0;
                    background: #f9f9f9;
                }

                .ing-txt {
                    display: flex;
                    flex-direction: column;
                    line-height: 1.3;
                    text-align: center;
                }

                .ing-txt strong {
                    font-size: 1.1rem;
                    color: var(--primary);
                    white-space: normal;
                }

                .ing-txt span {
                    font-size: 0.8rem;
                    color: #888;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                @media (max-width: 599px) {
                    .sec-title-nature {
                        font-size: 1.8rem;
                        margin-bottom: 25px;
                    }

                    .ingredients-section .container {
                        padding: 0 10px !important;
                        max-width: 100% !important;
                    }

                    .category-wrapper {
                        padding: 0 0px !important;
                        margin: 0 !important;
                        width: 100% !important;
                        position: relative;
                    }

                    .category-wrapper .testi-nav {
                        width: 45px !important;
                        height: 45px !important;
                        position: absolute;
                        top: 50%;
                        transform: translateY(-50%);
                        z-index: 100 !important;
                        background: rgba(255, 255, 255, 0.9) !important; /* Premium translucent background */
                        color: #004200 !important;
                        border-radius: 50%;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                        display: flex !important;
                        align-items: center;
                        justify-content: center;
                        border: none !important;
                    }
                    .category-wrapper .testi-nav:hover {
                        background: rgba(255, 255, 255, 0.9) !important;
                        color: #004200 !important;
                    }

                    .category-wrapper .testi-nav:active {
                        background: #004200 !important;
                        color: #fff !important;
                        transform: translateY(-50%) scale(0.9) !important;
                    }
                    .category-wrapper .testi-prev {
                        left: 0 !important;
                    }

                    .category-wrapper .testi-next {
                        right: 0 !important;
                    }

                    .ing-scroller::-webkit-scrollbar {
                        display: none !important;
                    }

                    .ing-scroller {
                        display: flex !important;
                        flex-wrap: nowrap !important;
                        overflow-x: auto !important;
                        -ms-overflow-style: none !important;
                        scrollbar-width: none !important;
                        gap: 0 !important;
                        padding: 20px 0 !important; 
                        box-sizing: border-box !important;
                        justify-content: flex-start !important;
                        scroll-snap-type: x mandatory !important;
                        -webkit-overflow-scrolling: touch !important;
                        -webkit-transform: translate3d(0,0,0);
                        backface-visibility: hidden;
                    }

                    .ing-pill {
                        flex: 0 0 calc(100% - 20px) !important;
                        min-width: calc(100% - 20px) !important;
                        margin: 0 10px !important;
                        scroll-snap-align: center !important;
                        scroll-snap-stop: always !important;
                        border-radius: 20px !important;
                        border: 1.5px solid #f0f0f0 !important;
                        background: #fff !important;
                        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04) !important;
                        padding: 45px 25px !important;
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: center !important;
                        justify-content: center !important;
                        gap: 15px !important;
                        box-sizing: border-box !important;
                    }

                    .ing-txt {
                        flex: 1 !important;
                        display: flex !important;
                        align-items: center !important;
                    }

                    /* Tablet - 2 cards visible with desktop-like alignment */

                    .ing-pill img {
                        width: 110px !important;
                        height: 110px !important;
                    }

                    .ing-txt strong {
                        font-size: 1rem !important;
                        white-space: normal !important;
                        text-align: center !important;
                    }

                    .ing-txt span {
                        font-size: 0.7rem !important;
                        text-align: center !important;
                    }
                }

                .testi-nav {
                    display: flex !important;
                    width: 42px !important;
                    height: 42px !important;
                    background: rgba(255, 255, 255, 0.95) !important;
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
                    color: #004200 !important;
                    /* Ensure arrow is green */
                }

                .testi-prev {
                    left: 10px !important;
                }

                .testi-next {
                    right: 10px !important;
                }
                
            </style>
        </div>
    </section>

    <!-- 3. Ayurveda Approach -->
    <section class="education-section">
        <div class="container">
            <h2 style="color: var(--primary)">Our Approach</h2>
            <div class="edu-grid">
                <div class="edu-card">
                    <h3>Balance-focused</h3>
                    <p>Restoring the natural equilibrium of Vata, Pitta, and Kapha.</p>
                </div>
                <div class="edu-card">
                    <h3>Natural Ingredients</h3>
                    <p>100% plant-based formulations free from harsh chemicals.</p>
                </div>
                <div class="edu-card">
                    <h3>Consistent Routine</h3>
                    <p>Designed for daily use to build long-term immunity.</p>
                </div>
            </div>
            <div class="edu-action">
                <a href="{{ route('about') }}" class="learn-more">Learn more about our approach</a>
            </div>
        </div>
    </section>

    <!-- Powered by Navapashanam Section -->
    <section class="ingredients-section shadow-text-sec" style="background: #fdfdfd; padding-top: 0;">
        <div class="container" style="position: relative;">

            <h2 class="sec-title-nature">Powered by Navapashanam</h2>

            <div class="category-wrapper" style="position: relative; padding: 0 70px; margin: 0 auto; max-width: 100%; overflow: hidden;">
                <button id="btn-navapashanam-prev" class="testi-nav testi-prev" onclick="scrollNavapashanam('prev')"
                    style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="ing-scroller navapashanam-scroller" id="scroller-navapashanam" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @foreach($categories as $category)
                        @if($category->is_navapashanam)
                            <a href="{{ route('category.show', $category->slug) }}" class="ing-pill navapashanam-pill" id="scroller-navapashanam-item"
                                style="text-decoration: none; color: inherit;">
                            @php
                                $img_path = $category->image;
                                if ($img_path && !str_starts_with($img_path, 'http') && !str_starts_with($img_path, '/')) {
                                    $img_path = asset($img_path);
                                }
                            @endphp
                            @if($img_path)
                                <img src="{{ $img_path }}" alt="{{ $category->name }}"
                                    onerror="this.src='https://via.placeholder.com/150?text={{ urlencode(substr($category->name, 0, 1)) }}'">
                            @else
                                <img src="https://via.placeholder.com/150?text={{ urlencode(substr($category->name, 0, 1)) }}"
                                    alt="{{ $category->name }}">
                            @endif
                            <div class="ing-txt"><strong>{{ $category->name }}</strong></div>
                            </a>
                        @endif
                    @endforeach
                </div>

                <button id="btn-navapashanam-next" class="testi-nav testi-next" onclick="scrollNavapashanam('next')"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- 4. Best Sellers -->
    <section class="products-section" id="bestsellers">
        <div class="container">
            <div class="sec-head" style="justify-content: center;">
                <h2 style="color: var(--primary);">Best Selling Products</h2>
            </div>
            <div class="product-slider-wrapper" style="position: relative; padding: 0 50px;">
                <button id="btn-bestsellers-prev" class="testi-nav testi-prev shop-nav-prev" onclick="scrollBestsellers('prev')"
                    style="position: absolute; left: 0px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="product-grid" id="scroller-bestsellers" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @forelse($bestSellingProducts as $product)
                        <div class="product-card bestseller-card">
                            <a href="{{ route('product.show', $product->slug) }}" class="product-card-link"></a>
                            <div class="p-img-wrap">
                                @php
                                    $img_path = $product->primary_image;
                                    if ($img_path && !str_starts_with($img_path, 'http') && !str_starts_with($img_path, '/')) {
                                        $img_path = asset($img_path);
                                    }
                                @endphp
                                @if($img_path)
                                    <img src="{{ $img_path }}" alt="{{ $product->name }}"
                                        onerror="this.src='https://via.placeholder.com/300?text=Auvri+Product'">
                                @else
                                    <img src="https://via.placeholder.com/300?text={{ urlencode($product->name) }}"
                                        alt="{{ $product->name }}">
                                @endif
                            </div>
                            <div class="p-info">
                                <div class="p-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($product->rating ?? 5))★@else☆@endif
                                    @endfor
                                </div>
                                <h4 class="p-title">{{ $product->name }}</h4>
                                <div class="p-bot"
                                    style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                                    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                        <span class="p-price"
                                            style="font-weight: 800; color: #004200; font-size: 1.15rem;">₹{{ number_format($product->price) }}</span>
                                        @if($product->compare_price && $product->compare_price > 0)
                                            <span
                                                style="text-decoration: line-through; color: #999; font-size: 0.85rem; font-weight: 500;">₹{{ number_format($product->compare_price) }}</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="add-btn" title="Add to Cart"
                                            style="background: #e8f5e9; color: #004200; width: 35px; height: 35px; border-radius: 50%; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease;"><i
                                                class="fas fa-shopping-cart"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="text-align:center; color:#888; grid-column: 1/-1;">No products available yet.</p>
                    @endforelse
                </div>

                <button id="btn-bestsellers-next" class="testi-nav testi-next shop-nav-next" onclick="scrollBestsellers('next')"
                    style="position: absolute; right: 0px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- 5. Order Steps -->
    <section class="steps-section">
        <div class="container">
            <div class="steps-flow">
                <div class="step">
                    <div class="step-num">01</div>
                    <div class="step-content">
                        <h4>Choose Product</h4>
                    </div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-num">02</div>
                    <div class="step-content">
                        <h4>Easy Order</h4>
                        <span class="step-sub">Web / Phone / WhatsApp</span>
                    </div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-num">03</div>
                    <div class="step-content">
                        <h4>Quick Delivery</h4>
                        <span class="step-sub">3-5 Days</span>
                    </div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-num">04</div>
                    <div class="step-content">
                        <h4>Lifelong Support</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Testimonials -->
    <section class="reviews-section">
        <div class="container">
            <div class="sec-head">
                <h2>Trusted by Our Wellness Community</h2>
            </div>
            <div class="testimonial-wrapper" style="position: relative; padding: 0 50px;">
                <button id="btn-testimonials-prev" class="testi-nav testi-prev" onclick="scrollTestimonials('prev')"
                    style="position: absolute; left: 0px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.2rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="reviews-grid" id="scroller-testimonials">
                    @forelse($testimonials as $testimonial)
                        <div class="review-card white-floating-card testimonial-card">
                            <div class="reviewer-top">
                                <div class="r-initials"
                                    style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                    @if($testimonial->image)
                                        <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                                    @endif
                                </div>
                                <div class="r-details">
                                    <span class="r-name">{{ $testimonial->name }}</span>
                                    <span
                                        class="r-loc">{{ $testimonial->designation ?? $testimonial->location ?? 'Customer' }}</span>
                                </div>
                            </div>
                            <div class="stars" style="color: #d4af37; margin: 10px 0;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= ($testimonial->rating ?? 5))★@else☆@endif
                                @endfor
                            </div>
                            <p class="review-text" style="font-style: italic; color: #555;">"{{ $testimonial->content }}"</p>
                        </div>
                    @empty
                        <p style="text-align:center; color:#888; flex: 1;">No testimonials available yet.</p>
                    @endforelse
                </div>

                <button id="btn-testimonials-next" class="testi-nav testi-next" onclick="scrollTestimonials('next')"
                    style="position: absolute; right: 0px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.2rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>
    <style>
        .reviews-grid {
            display: flex !important;
            overflow-x: auto !important;
            gap: 30px !important;
            padding: 20px 0 40px !important;
            scroll-snap-type: x mandatory !important;
            -webkit-overflow-scrolling: touch !important;
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
            overflow-y: hidden !important;
            -webkit-transform: translate3d(0,0,0); /* Safari stability */
            backface-visibility: hidden;
        }

        .reviews-grid::-webkit-scrollbar {
            display: none !important;
        }

        .testi-nav:hover {
            background: #004200 !important;
            color: #fff !important;
            transform: translateY(-50%) scale(1.1) !important;
        }

        .testi-nav.btn-blur {
            opacity: 0.2 !important;
            pointer-events: none !important;
            filter: grayscale(1);
        }

        .white-floating-card {
            flex: 0 0 calc((100% - 60px) / 3) !important;
            width: calc((100% - 60px) / 3) !important;
            scroll-snap-align: start;
            min-width: 280px !important;
            box-sizing: border-box;
        }



        @media (max-width: 991px) {
            .secondary-btn-lx {
                padding: 10px 20px !important;
                font-size: 0.9rem !important;
            }

            .reviews-section .container {
                padding: 0 10px !important;
                max-width: 100% !important;
            }

            .white-floating-card {
                flex: 0 0 calc(100% - 20px) !important;
                min-width: calc(100% - 20px) !important;
                margin: 0 10px !important;
                scroll-snap-align: center !important;
                margin-bottom: 0px !important;
                border-radius: 20px !important;
                padding: 20px 20px !important;
                box-sizing: border-box !important;
                display: flex !important;
                flex-direction: column !important;
            }

            .review-card .review-text {
                flex: 1 !important;
            }



            .r-name {
                font-size: 1rem !important;
            }

            .r-loc {
                font-size: 0.8rem !important;
            }

            .review-text {
                font-size: 0.95rem !important;
            }

            .testimonial-wrapper {
                padding: 0 10px !important; 
                overflow: hidden !important;
            }

            .reviews-grid::-webkit-scrollbar {
                display: none !important;
            }

            .reviews-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                -ms-overflow-style: none !important;
                scrollbar-width: none !important;
                scroll-snap-type: x mandatory !important;
                gap: 0 !important;
                padding: 40px 0 !important;
                box-sizing: border-box !important;
                -webkit-overflow-scrolling: touch !important;
            }

            .testimonial-wrapper {
                padding: 0 10px !important; 
            }

            .testimonial-wrapper .testi-nav {
                display: flex !important;
                width: 40px !important;
                height: 40px !important;
                background: rgba(255, 255, 255, 0.9) !important;
                color: #004200 !important;
                z-index: 20 !important;
            }
            .testimonial-wrapper .testi-nav:hover {
                background: rgba(255, 255, 255, 0.9) !important;
                color: #004200 !important;
            }

            .testimonial-wrapper .testi-nav:active {
                background: #004200 !important;
                color: #fff !important;
                transform: translateY(-50%) scale(0.9) !important;
            }
            /* 
               TESTIMONIAL SPECIFIC BUTTON POSITIONS 
               Adjust these values to move the buttons independently
            */
            @media (min-width: 768px) {
                .category-wrapper, .testimonial-wrapper {
                    padding: 0 !important;
                    margin-left: 0 !important;
                }
                .ing-scroller, .product-grid, .reviews-grid {
                    justify-content: flex-start !important;
                    padding-left: 0 !important;
                }
                .testi-prev { left: 10px !important; }
                .testi-next { right: 10px !important; }
            }
            
            /* Best Selling Products - Dedicated Alignment */
            @media (min-width: 768px) {
                #bestsellers .product-slider-wrapper {
                    padding: 0 50px !important;
                }
                #bestsellers .shop-nav-prev {
                    left: 0 !important;
                }
                #bestsellers .shop-nav-next {
                    right: 0 !important;
                }
                #bestsellers .product-grid {
                    padding-left: 0 !important;
                    padding-right: 0 !important;
                    justify-content: flex-start !important;
                    width: 100% !important;
                    max-width: 100% !important;
                    overflow: hidden !important;
                }
            }


            /* Tablet - 2 cards visible with Navapashanam-like alignment */
            @media (min-width: 768px) and (max-width: 991px) {
                .product-card, .ing-pill, .white-floating-card {
                    flex: 0 0 calc((100% - 25px) / 2) !important;
                    width: calc((100% - 25px) / 2) !important;
                    min-width: 0 !important;
                }
                .p-img-wrap {
                    height: 300px !important;
                }
            }

            /* Small Phone Optimizations (320px - 450px) */
            @media (max-width: 450px) {

                .testimonial-wrapper,
                .category-wrapper {
                    padding: 0 10px;
                }

                .white-floating-card {
                    padding: 20px 15px;
                }

                .r-name {
                    font-size: 0.9rem;
                }

                .r-loc {
                    font-size: 0.75rem !important;
                }

                .review-text {
                    font-size: 0.85rem !important;
                }

                .ing-pill {
                    padding: 15px 15px !important;
                }

                .ing-txt strong {
                    font-size: 1rem !important;
                }

                .ing-txt span {
                    font-size: 0.65rem !important;
                }
                .hero-video-wrapper,
                .hero-img-wrapper-premium {
                    max-width: 100%;
                    aspect-ratio: 16/9;
                }
            }
            
            /* Small Mobiles (Up to 320px) */
            @media (max-width: 320px) {
                .testimonial-wrapper,
                .category-wrapper {
                    padding: 0 0px;
                }

                .white-floating-card {
                    padding: 15px 10px;
                }

                .r-name {
                    font-size: 0.8rem;
                }

                .r-text {
                    font-size: 0.7rem;
                }

                .hero-video-wrapper,
                .hero-img-wrapper-premium {
                    max-width: 100%;
                    aspect-ratio: 16/9;
                }
            }
            /* Tablet - 2 cards visible with Navapashanam-like alignment */
            @media (min-width: 700px) and (max-width: 991px) {
                .white-floating-card {
                    flex: 0 0 calc((100% - 25px) / 2) !important;
                    width: calc((100% - 25px) / 2) !important;
                    min-width: 0 !important;
                    scroll-snap-align: start !important;
                    margin: 0 !important;
                }
                .reviews-grid {
                    gap: 25px !important;
                    justify-content: flex-start !important;
                    padding: 40px 0 !important;
                }
            }
        }

        /* Best Selling Products & Steps - Responsive Architecture */
        @media (min-width: 992px) {
            #bestsellers .product-slider-wrapper {
                max-width: 1200px !important;
                margin: 0 auto !important;
                padding: 0 70px !important;
            }

            #bestsellers .product-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                gap: 25px !important;
                padding: 20px 0 !important;
                justify-content: flex-start !important;
                scroll-behavior: smooth;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }

            #bestsellers .product-grid::-webkit-scrollbar {
                display: none !important;
            }

            #bestsellers .product-card {
                scroll-snap-align: start;
                flex: 0 0 calc((100% - 50px) / 3) !important; /* Exactly 3 cards visible */
                width: calc((100% - 50px) / 3) !important;
                min-width: 0 !important;
                margin: 0 !important;
            }

            #bestsellers .shop-nav-prev,
            #bestsellers .shop-nav-next {
                display: flex !important;
                z-index: 25 !important; /* Ensure it's above cards */
            }

            #bestsellers .shop-nav-prev { left: 10px !important; }
            #bestsellers .shop-nav-next { right: 10px !important; }

            #bestsellers .sec-head {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 40px;
            }

            .steps-section {
                background: #e9f5e9;
                /* Light green from image 1 */
                padding: 45px 0;
                border-radius: 15px;
            }

            .steps-flow {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
            }

            .step {
                flex: 1;
                text-align: center;
            }

            .step-sub {
                display: block;
                font-size: 0.8rem;
                opacity: 0.8;
                margin-top: 5px;
            }

            .step-line {
                flex: 0.5;
                height: 1px;
                background: rgba(0, 66, 0, 0.1);
                display: block;
            }
        }

        /* Mobile & Tablet Overrides (Slider Mode) */
        @media (max-width: 991px) {
            #bestsellers .product-slider-wrapper {
                overflow: hidden !important;
            }

            #bestsellers .product-grid::-webkit-scrollbar {
                display: none !important;
            }

            #bestsellers .product-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                -ms-overflow-style: none !important;
                scrollbar-width: none !important;
                gap: 0 !important; /* Switched to margin-right for exact Herbal sync */
                padding: 10px 0px 20px !important; /* Removed side padding to rely on slide padding */
                box-sizing: border-box !important;
                scroll-snap-type: x mandatory !important;
                -webkit-overflow-scrolling: touch !important;
                scrollbar-width: none;
                -webkit-transform: translate3d(0,0,0);
                backface-visibility: hidden;
            }

            #bestsellers .container {
                padding: 0 10px !important;
                max-width: 100% !important;
            }

            #bestsellers .product-slider-wrapper {
                padding: 0 10px !important;
                margin: 0 !important;
                width: 100% !important;
            }

            #bestsellers .product-grid::-webkit-scrollbar {
                display: none;
            }

                #bestsellers .product-card {
                flex: 0 0 calc(100% - 20px) !important;
                min-width: calc(100% - 20px) !important;
                margin: 0 10px !important;
                scroll-snap-align: center !important;
                padding: 15px !important; /* Internal card padding */
                box-sizing: border-box !important;
                border: 1px solid #eeeeee !important; /* Subtle gray border */
                border-radius: 15px !important; /* Rounded corners for premium feel */
                background: #fff !important;
                display: flex !important;
                flex-direction: column !important;
            }

            #bestsellers .p-info {
                flex: 1 !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
            }

            /* Tablet (700px - 991px) - 2 cards visible */
            @media (min-width: 700px) and (max-width: 991px) {
                #bestsellers .product-card {
                    flex: 0 0 calc((100% - 25px) / 2) !important;
                    min-width: calc((100% - 25px) / 2) !important;
                    margin: 0 !important;
                    scroll-snap-align: start !important;
                }
                #bestsellers .product-grid {
                    gap: 25px !important;
                    justify-content: flex-start !important;
                }
            }

            #bestsellers .testi-nav {
                display: flex !important;
                width: 40px !important;
                height: 40px !important;
                background: #fff !important;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
                color: #004200 !important;
                z-index: 10 !important;
            }

            #bestsellers .testi-nav:hover {
                background: rgba(255, 255, 255, 0.9) !important;
                color: #004200 !important;
            }

            #bestsellers .testi-nav:active {
                background: #004200 !important;
                color: #fff !important;
                transform: translateY(-50%) scale(0.9) !important;
            }
            #bestsellers .testi-prev {
                left: 0 !important;
            }

            #bestsellers .testi-next {
                right: 0 !important;
            }

            #bestsellers .sec-head {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                gap: 10px !important;
                margin-bottom: 30px !important;
            }

            @media (min-width: 700px) and (max-width: 991px) {
                #bestsellers .sec-head {
                    flex-direction: column !important;
                    justify-content: center !important;
                    text-align: center !important;
                    align-items: center !important;
                    margin-bottom: 30px !important;
                }
                #bestsellers .container {
                    padding: 0 10px !important; /* Match Navapashanam container padding */
                }
            }

            .steps-section .steps-flow {
                display: flex !important;
                flex-direction: column !important;
                gap: 40px !important;
                align-items: flex-start !important;
                padding: 0 15px !important;
                position: relative !important;
            }

            /* Linked vertical line for mobile */
            .steps-section .steps-flow::before {
                content: '';
                position: absolute;
                left: 40px;
                /* Aligned with circle centers */
                top: 40px !important;
                bottom: 40px !important;
                width: 2px;
                background: var(--primary);
                opacity: 0.2;
                z-index: 0;
            }

            .step {
                display: flex !important;
                align-items: center !important; /* Centered vertically */
                gap: 20px !important;
                text-align: left !important;
                width: 100% !important;
                position: relative !important;
                z-index: 1 !important;
                margin-bottom: 35px !important;
            }

            .step-content {
                display: flex;
                flex-direction: column;
                gap: 2px; /* Tighter gap for better centering */
            }

            .step-num {
                width: 55px !important;
                height: 55px !important;
                min-width: 55px !important;
                font-size: 1.3rem !important;
                margin: 0 !important;
                background: var(--primary) !important;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                border-radius: 50%;
                border: 3px solid #fff; /* Added white border for premium look */
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }

            .step h4 {
                margin: 0 !important;
                font-size: 1.25rem !important;
                white-space: normal !important;
                line-height: 1.2;
                font-weight: 700;
                color: var(--primary);
            }

            .step-sub {
                white-space: normal !important;
                font-size: 0.95rem !important;
                display: block !important;
                color: #555;
                font-weight: 500;
            }

            .step-line {
                display: none !important;
            }

            /* Normal Mobiles (321px - 450px) */
            @media (max-width: 450px) {
                .steps-section .steps-flow::before {
                    left: 42px; /* (padding 15 + half of 54) */
                }

                .step h4 {
                    font-size: 1.25rem !important;
                }

                .step-sub {
                    font-size: 1rem !important;
                }

                .step-num {
                    width: 54px !important;
                    height: 54px !important;
                    min-width: 54px !important;
                    font-size: 1.3rem !important;
                }
            }

            /* Small Mobiles (Up to 320px) */
            @media (max-width: 320px) {
                .steps-section .steps-flow::before {
                    left: 39px; /* (padding 15 + half of 48) */
                }

                .step h4 {
                    font-size: 1.15rem !important;
                }

                .step-sub {
                    font-size: 0.9rem !important;
                }

                .step-num {
                    width: 48px !important;
                    height: 48px !important;
                    min-width: 48px !important;
                    font-size: 1.2rem !important;
                }
            }

            .step {
                gap: 12px !important;
            }
        }
    </style>
@endsection
@section('extra_js')
    <script>
        function scrollHerbal(dir) {
            const scroller = document.getElementById('scroller-herbal');
            if (!scroller) return;
            const items = scroller.querySelectorAll('.ing-pill');
            if (items.length < 2) return;
            const step = items[1].getBoundingClientRect().left - items[0].getBoundingClientRect().left;
            if (dir === 'next') scroller.scrollBy({ left: step, behavior: 'smooth' });
            else scroller.scrollBy({ left: -step, behavior: 'smooth' });
            setTimeout(() => updateButtonVisibility('scroller-herbal', 'btn-herbal-prev', 'btn-herbal-next'), 300);
        }

        function scrollNavapashanam(dir) {
            const scroller = document.getElementById('scroller-navapashanam');
            if (!scroller) return;
            const items = scroller.querySelectorAll('.navapashanam-pill');
            if (items.length < 2) return;
            const step = items[1].getBoundingClientRect().left - items[0].getBoundingClientRect().left;
            if (dir === 'next') scroller.scrollBy({ left: step, behavior: 'smooth' });
            else scroller.scrollBy({ left: -step, behavior: 'smooth' });
            setTimeout(() => updateButtonVisibility('scroller-navapashanam', 'btn-navapashanam-prev', 'btn-navapashanam-next'), 300);
        }

        function scrollBestsellers(dir) {
            const scroller = document.getElementById('scroller-bestsellers');
            if (!scroller) return;
            const items = scroller.querySelectorAll('.product-card');
            if (items.length < 2) return;
            const step = items[1].getBoundingClientRect().left - items[0].getBoundingClientRect().left;
            if (dir === 'next') scroller.scrollBy({ left: step, behavior: 'smooth' });
            else scroller.scrollBy({ left: -step, behavior: 'smooth' });
            setTimeout(() => updateButtonVisibility('scroller-bestsellers', 'btn-bestsellers-prev', 'btn-bestsellers-next'), 300);
        }

        function scrollTestimonials(dir) {
            const scroller = document.getElementById('scroller-testimonials');
            if (!scroller) return;
            const items = scroller.querySelectorAll('.testimonial-card');
            if (items.length < 2) return;
            const step = items[1].getBoundingClientRect().left - items[0].getBoundingClientRect().left;
            if (dir === 'next') scroller.scrollBy({ left: step, behavior: 'smooth' });
            else scroller.scrollBy({ left: -step, behavior: 'smooth' });
            setTimeout(() => updateButtonVisibility('scroller-testimonials', 'btn-testimonials-prev', 'btn-testimonials-next'), 300);
        }
        function updateButtonVisibility(scrollerId, prevBtnId, nextBtnId) {
            const scroller = document.getElementById(scrollerId);
            const prevBtn = document.getElementById(prevBtnId);
            const nextBtn = document.getElementById(nextBtnId);
            
            if (!scroller || !prevBtn || !nextBtn) return;

            const scrollLeft = scroller.scrollLeft;
            const scrollWidth = scroller.scrollWidth;
            const clientWidth = scroller.clientWidth;

            // Blur left button if at the start
            if (scrollLeft <= 5) {
                prevBtn.classList.add('btn-blur');
            } else {
                prevBtn.classList.remove('btn-blur');
            }

            // Blur right button if at the end (using Math.ceil for subpixel robustness)
            if (Math.ceil(scrollLeft + clientWidth) >= scrollWidth - 2) {
                nextBtn.classList.add('btn-blur');
            } else {
                nextBtn.classList.remove('btn-blur');
            }
        }

        // Initialize and listen for scroll events
        document.addEventListener('DOMContentLoaded', function() {
            const sections = [
                { id: 'scroller-herbal', prev: 'btn-herbal-prev', next: 'btn-herbal-next' },
                { id: 'scroller-navapashanam', prev: 'btn-navapashanam-prev', next: 'btn-navapashanam-next' },
                { id: 'scroller-bestsellers', prev: 'btn-bestsellers-prev', next: 'btn-bestsellers-next' },
                { id: 'scroller-testimonials', prev: 'btn-testimonials-prev', next: 'btn-testimonials-next' }
            ];

            sections.forEach(sec => {
                const scroller = document.getElementById(sec.id);
                if (scroller) {
                    scroller.addEventListener('scroll', () => {
                        updateButtonVisibility(sec.id, sec.prev, sec.next);
                    });
                    // Initial check
                    updateButtonVisibility(sec.id, sec.prev, sec.next);
                }
            });

            window.addEventListener('resize', () => {
                sections.forEach(sec => updateButtonVisibility(sec.id, sec.prev, sec.next));
            });
        });
    </script>
@endsection