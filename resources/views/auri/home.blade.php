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
                            <video autoplay muted loop playsinline class="hero-video">
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

        .hero-section {
            position: relative;
            overflow: hidden;
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
                height: 100svh !important;
                min-height: 100svh !important;
                max-height: 100svh !important;
                padding: 0 !important;
                overflow: hidden !important;
            }

            .hero-slider {
                height: 100% !important;
                width: 100% !important;
            }

            .hero-slide {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                opacity: 0;
                visibility: hidden;
                padding: 100px 0 80px !important;
            }

            .hero-slide.active {
                opacity: 1 !important;
                visibility: visible !important;
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
                max-width: 100%;
                aspect-ratio: 16/9;
            }

            .hero-video,
            .hero-display-img {
                height: auto;
            }
        }

        /* Best Sellers Slider Fix */
        #bestsellers .product-grid {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            gap: 25px !important;
            padding: 20px 15px !important;
            justify-content: flex-start !important;
            align-items: stretch !important;
            scroll-behavior: smooth !important;
            -webkit-overflow-scrolling: touch !important;
            scroll-snap-type: x mandatory !important;
            scrollbar-width: none !important;
        }

        #bestsellers .product-grid::-webkit-scrollbar {
            display: none !important;
        }

        #bestsellers .product-card {
            flex: 0 0 calc((100% - 50px) / 3) !important;
            min-width: 300px !important;
            scroll-snap-align: center !important;
            margin-bottom: 0 !important;
        }

        @media (max-width: 991px) {
            #bestsellers .product-card {
                flex: 0 0 calc((100% - 25px) / 2) !important;
                min-width: 250px !important;
            }
        }

        @media (max-width: 768px) {
            #bestsellers .product-card {
                flex: 0 0 100% !important;
                min-width: 100% !important;
            }
            #bestsellers .product-slider-wrapper {
                padding: 0 10px;
            }
            #bestsellers .shop-nav-prev {
                left: 0 !important;
            }
            #bestsellers .shop-nav-next {
                right: 0 !important;
            }
        }
    </style>


    <section class="ingredients-section shadow-text-sec" style="padding-top: 0;">
        <div class="container" style="position: relative;">
            <h2 class="sec-title-nature">Powered by Herbal Products</h2>

            <div class="category-wrapper" style="position: relative; padding: 0 60px; margin: 0 auto; max-width: 100%;">
                <button class="testi-nav testi-prev"
                    onclick="const g=this.parentElement.querySelector('.ing-scroller'); const c=g.querySelector('.ing-pill'); if(c) g.scrollBy({left: -(c.offsetWidth + 15), behavior: 'smooth'})"
                    style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="ing-scroller" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @php
                        $allowedHerbalKeywords = ['kamaayush', 'hair oil', 'detox'];
                        $excludedKeywords = ['pack of 2'];
                        $filteredHerbalProducts = $bestSellingProducts->where('is_herbal', true)
                            ->filter(function ($product) use ($allowedHerbalKeywords, $excludedKeywords) {
                                $name = strtolower($product->name);
                                foreach ($excludedKeywords as $excluded) {
                                    if (strpos($name, $excluded) !== false) {
                                        return false;
                                    }
                                }
                                foreach ($allowedHerbalKeywords as $keyword) {
                                    if (strpos($name, $keyword) !== false) {
                                        return true;
                                    }
                                }
                                return false;
                            })
                            ->unique('name');
                    @endphp
                    @forelse($filteredHerbalProducts as $product)
                        <a href="{{ route('product.show', $product->slug) }}" class="ing-pill"
                            style="text-decoration: none; color: inherit;">
                            @php
                                $img_path = $product->primary_image;
                                if ($img_path && !str_starts_with($img_path, 'http') && !str_starts_with($img_path, '/')) {
                                    $img_path = asset($img_path);
                                }
                            @endphp
                            @if($img_path)
                                <img src="{{ $img_path }}" alt="{{ $product->name }}"
                                    onerror="this.src='https://via.placeholder.com/100?text={{ urlencode(substr($product->name, 0, 1)) }}'">
                            @else
                                <img src="https://via.placeholder.com/100?text={{ urlencode(substr($product->name, 0, 1)) }}"
                                    alt="{{ $product->name }}">
                            @endif
                            <div class="ing-txt"><strong>{{ $product->name }}</strong></div>
                        </a>
                    @empty
                        <p style="text-align:center; color:#888;">No Herbal products available yet.</p>
                    @endforelse
                </div>

                <button class="testi-nav testi-next"
                    onclick="const g=this.parentElement.querySelector('.ing-scroller'); const c=g.querySelector('.ing-pill'); if(c) g.scrollBy({left: (c.offsetWidth + 15), behavior: 'smooth'})"
                    style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <style>
                .sec-title-nature {
                    color: var(--primary);
                    text-align: center;
                    margin-top: 60px;
                    margin-bottom: 40px;
                    font-family: var(--font-heading);
                    font-size: 2.5rem;
                }

                .ing-scroller {
                    display: flex !important;
                    flex-wrap: nowrap !important;
                    overflow-x: auto !important;
                    gap: 15px !important;
                    padding: 20px 15px !important;
                    justify-content: flex-start;
                    align-items: stretch;
                    scroll-behavior: smooth;
                    -webkit-overflow-scrolling: touch;
                    scroll-snap-type: x mandatory;
                    scrollbar-width: none;
                }

                .ing-scroller::-webkit-scrollbar {
                    display: none !important;
                }

                .ing-pill {
                    flex: 0 0 calc((100% - 30px) / 3) !important;
                    min-width: 200px !important;
                    max-width: calc((100% - 30px) / 3) !important;
                    scroll-snap-align: center;
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

                @media (max-width: 768px) {
                    .sec-title-nature {
                        font-size: 1.8rem;
                        margin-bottom: 25px;
                    }

                    .ingredients-section {
                        overflow: hidden !important;
                    }

                    .category-wrapper {
                        padding: 0 !important;
                        margin: 0 !important;
                        overflow: hidden !important;
                        position: relative !important;
                    }

                    /* Arrows overlay ON TOP of scroller */
                    .category-wrapper .testi-nav {
                        width: 36px !important;
                        height: 36px !important;
                        position: absolute !important;
                        top: 50% !important;
                        transform: translateY(-50%) !important;
                        z-index: 20 !important;
                        background: rgba(255,255,255,0.85) !important;
                        box-shadow: 0 4px 12px rgba(0,0,0,0.12) !important;
                        font-size: 0.85rem !important;
                    }

                    .category-wrapper .testi-prev {
                        left: 8px !important;
                    }

                    .category-wrapper .testi-next {
                        right: 8px !important;
                    }

                    .ing-scroller {
                        gap: 15px !important; /* Consistent gap for medium cards */
                        padding: 15px 10px !important;
                        justify-content: flex-start !important;
                        overflow-x: auto !important;
                        scroll-snap-type: x mandatory !important;
                        width: 100% !important;
                    }

                    .ing-pill {
                        flex: 0 0 75% !important; /* "Medium" size to show next card peek */
                        min-width: 250px !important;
                        max-width: 75% !important;
                        border-radius: 20px !important;
                        border: 1px solid #f0f0f0 !important;
                        background: #fff !important;
                        box-shadow: 0 8px 20px rgba(0,0,0,0.03) !important;
                        padding: 25px 20px !important; /* Increased horizontal padding */
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: center !important;
                        justify-content: center !important;
                        scroll-snap-align: center !important;
                        gap: 15px !important;
                        min-height: 280px !important; /* Uniform card height */
                        box-sizing: border-box !important;
                        overflow: hidden !important;
                    }

                    .ing-pill img {
                        width: 120px !important; /* Standardized medium image size */
                        height: 120px !important;
                        border-radius: 50% !important;
                        object-fit: cover !important;
                        background: #f9f9f9 !important;
                        padding: 5px !important;
                        border: 1px solid #eee !important;
                    }

                    .ing-txt strong {
                        font-size: 1.1rem !important;
                        text-align: center !important;
                        display: block !important;
                        line-height: 1.3 !important;
                        white-space: normal !important; /* Force wrapping */
                        word-wrap: break-word !important;
                        overflow-wrap: break-word !important;
                        width: 100% !important;
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

            <div class="category-wrapper" style="position: relative; padding: 0 60px; margin: 0 auto; max-width: 100%;">
                <button class="testi-nav testi-prev"
                    onclick="const g=this.parentElement.querySelector('.ing-scroller'); const c=g.querySelector('.ing-pill'); if(c) g.scrollBy({left: -(c.offsetWidth + 15), behavior: 'smooth'})"
                    style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="ing-scroller" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @forelse($bestSellingProducts->where('is_navapashanam', true) as $product)
                        <a href="{{ route('product.show', $product->slug) }}" class="ing-pill"
                            style="text-decoration: none; color: inherit;">
                            @php
                                $img_path = $product->primary_image;
                                if ($img_path && !str_starts_with($img_path, 'http') && !str_starts_with($img_path, '/')) {
                                    $img_path = asset($img_path);
                                }
                            @endphp
                            @if($img_path)
                                <img src="{{ $img_path }}" alt="{{ $product->name }}"
                                    onerror="this.src='https://via.placeholder.com/100?text={{ urlencode(substr($product->name, 0, 1)) }}'">
                            @else
                                <img src="https://via.placeholder.com/100?text={{ urlencode(substr($product->name, 0, 1)) }}"
                                    alt="{{ $product->name }}">
                            @endif
                            <div class="ing-txt"><strong>{{ $product->name }}</strong></div>
                        </a>
                    @empty
                        <p style="text-align:center; color:#888;">No Navapashanam products available yet.</p>
                    @endforelse
                </div>

                <button class="testi-nav testi-next"
                    onclick="const g=this.parentElement.querySelector('.ing-scroller'); const c=g.querySelector('.ing-pill'); if(c) g.scrollBy({left: (c.offsetWidth + 15), behavior: 'smooth'})"
                    style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
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
            <div class="product-slider-wrapper" style="position: relative;">
                <button class="testi-nav testi-prev shop-nav-prev"
                    onclick="const g=this.parentElement.querySelector('.product-grid'); const c=g.querySelector('.product-card'); g.scrollBy({left: -(c.offsetWidth + 25), behavior: 'smooth'})"
                    style="position: absolute; left: -25px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="product-grid" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @forelse($bestSellingProducts as $product)
                        <div class="product-card" onclick="window.location.href='{{ route('product.show', $product->slug) }}'" style="cursor: pointer;">
                            <div class="p-img-wrap">
                                <a href="{{ route('product.show', $product->slug) }}" onclick="event.stopPropagation();">
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
                                </a>
                                <a href="{{ route('product.show', $product->slug) }}" class="quick-view-btn" onclick="event.stopPropagation();">Quick View</a>
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
                                    <form action="{{ route('cart.add') }}" method="POST" style="display:inline;" onclick="event.stopPropagation();">
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

                <button class="testi-nav testi-next shop-nav-next"
                    onclick="const g=this.parentElement.querySelector('.product-grid'); const c=g.querySelector('.product-card'); g.scrollBy({left: (c.offsetWidth + 25), behavior: 'smooth'})"
                    style="position: absolute; right: -25px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
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
                    <h4>Choose Product</h4>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-num">02</div>
                    <h4>Easy Order</h4>
                    <span class="step-sub">Web / Phone / WhatsApp</span>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-num">03</div>
                    <h4>Quick Delivery</h4>
                    <span class="step-sub">3-5 Days</span>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-num">04</div>
                    <h4>Lifelong Support</h4>
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
            <div class="testimonial-wrapper" style="position: relative; padding: 0 40px;">
                <button class="testi-nav testi-prev"
                    onclick="this.parentElement.querySelector('.reviews-grid').scrollBy({left: -400, behavior: 'smooth'})"
                    style="position: absolute; left: -20px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; border-radius: 50%; background: #fff; border: 1px solid #eee; box-shadow: none; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.2rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="reviews-grid">
                    @forelse($testimonials as $testimonial)
                        <div class="review-card white-floating-card">
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

                <button class="testi-nav testi-next"
                    onclick="this.parentElement.querySelector('.reviews-grid').scrollBy({left: 400, behavior: 'smooth'})"
                    style="position: absolute; right: -20px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; border-radius: 50%; background: #fff; border: 1px solid #eee; box-shadow: none; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.2rem; transition: all 0.3s ease;">
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
        }

        .reviews-grid::-webkit-scrollbar {
            display: none !important;
        }

        @media (hover: hover) {
            .testi-nav:hover {
                background: #004200 !important;
                color: #fff !important;
                transform: translateY(-50%) scale(1.1) !important;
            }
        }

        .testi-nav:active {
            background: #004200 !important;
            color: #fff !important;
            transform: translateY(-50%) scale(0.95) !important;
        }

        .white-floating-card {
            flex: 0 0 calc((100% - 60px) / 3) !important;
            scroll-snap-align: start !important;
            min-width: 280px !important;
            box-sizing: border-box !important;
            box-shadow: none !important;
            border: 1px solid #e0e0e0 !important;
            border-top: none !important;
            transform: none !important;
            background: #fff !important;
        }

        .white-floating-card:hover {
            transform: none !important;
            box-shadow: none !important;
            background: #fff !important;
        }

        .white-floating-card::before,
        .white-floating-card::after {
            display: none !important;
        }

        .quote-watermark {
            display: none !important;
        }

        @media (max-width: 1100px) {
            .white-floating-card {
                flex: 0 0 calc((100% - 30px) / 2) !important;
                min-width: 250px !important;
            }
        }

        @media (max-width: 768px) {
            .p-info {
                text-align: center !important;
                padding: 10px !important; /* Reduced from 15px */
            }

            .p-rating {
                justify-content: center !important;
                display: flex !important;
                margin-bottom: 5px !important; /* Reduced from 10px */
            }

            .p-title {
                text-align: center !important;
                margin-bottom: 10px !important; /* Reduced from 15px */
                font-size: 0.95rem !important;
                height: 2.8em !important;
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow: hidden !important;
                display: -webkit-box !important;
                -webkit-line-clamp: 2 !important;
                -webkit-box-orient: vertical !important;
            }

            .p-bot {
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 8px !important; /* Reduced from 12px */
                padding-top: 10px !important; /* Reduced from 15px */
                margin-top: 5px !important;
            }

            .p-img-wrap img {
                height: 180px !important; /* Fixed height for consistency */
                width: 100% !important;
                object-fit: contain !important;
            }

            .add-btn {
                width: 38px !important;
                height: 38px !important;
                margin: 0 auto !important;
            }
            .secondary-btn-lx {
                padding: 10px 20px !important;
                font-size: 0.9rem !important;
            }

            .white-floating-card {
                flex: 0 0 100% !important;
                min-width: 100% !important;
                scroll-snap-align: center;
                margin-bottom: 0px !important;
                border-radius: 20px !important;
                padding: 20px 20px !important;
                border: 1px solid #eee !important;
                box-shadow: none !important;
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

            .reviews-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                scroll-snap-type: x mandatory !important;
                gap: 0 !important;
                padding: 40px 0 !important;
            }

            .testimonial-wrapper {
                padding: 0 50px !important;
            }

            .testimonial-wrapper .testi-nav {
                display: flex !important;
                width: 40px !important;
                height: 40px !important;
                background: rgba(255, 255, 255, 0.9) !important;
                color: #004200 !important;
                z-index: 20 !important;
            }

            .testimonial-wrapper .testi-prev {
                left: 10px !important;
            }

            .testimonial-wrapper .testi-next {
                right: 10px !important;
            }



            /* Small Phone Optimizations (320px - 450px) */
            @media (max-width: 450px) {

                .testimonial-wrapper,
                .category-wrapper {
                    padding: 0 10px !important;
                }

                .white-floating-card {
                    padding: 20px 15px !important;
                }

                .r-name {
                    font-size: 0.9rem !important;
                }

                .r-loc {
                    font-size: 0.75rem !important;
                }

                .review-text {
                    font-size: 0.85rem !important;
                }

                .ing-pill {
                    padding: 8px 15px !important;
                }

                .ing-txt strong {
                    font-size: 1rem !important;
                }

                .ing-txt span {
                    font-size: 0.65rem !important;
                }
            }
        }

        /* Best Selling Products & Steps - Responsive Architecture */
        @media (min-width: 992px) {
            #bestsellers .product-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                gap: 25px !important;
                padding: 20px 0 !important;
                scroll-behavior: smooth;
                scrollbar-width: none;
                -ms-overflow-style: none;
                scroll-snap-type: x mandatory;
            }

            #bestsellers .product-grid::-webkit-scrollbar {
                display: none;
            }

            #bestsellers .product-card {
                flex: 0 0 calc((100% - 50px) / 3) !important;
                min-width: calc((100% - 50px) / 3) !important;
                scroll-snap-align: start;
            }

            #bestsellers .shop-nav-prev,
            #bestsellers .shop-nav-next {
                display: flex !important;
                /* Show arrows on desktop slider */
            }

            #bestsellers .sec-head {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                margin-bottom: 40px !important;
            }

            .steps-section {
                background: #e9f5e9;
                /* Light green from image 1 */
                padding: 45px 0 !important;
                margin: 40px 0 !important;
                border-radius: 15px;
            }

            .steps-flow {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                gap: 20px !important;
            }

            .step {
                flex: 1 !important;
                text-align: center !important;
            }

            .step-sub {
                display: block !important;
                font-size: 0.8rem !important;
                opacity: 0.8;
                margin-top: 5px;
            }

            .step-line {
                flex: 0.5 !important;
                height: 1px !important;
                background: rgba(0, 66, 0, 0.1) !important;
                display: block !important;
            }
        }

        /* Mobile & Tablet Overrides (Slider Mode) */
        @media (max-width: 991px) {
            #bestsellers .product-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                gap: 0 !important;
                padding: 10px 0 20px !important;
                scroll-snap-type: x mandatory !important;
                scrollbar-width: none;
            }

            #bestsellers .product-grid::-webkit-scrollbar {
                display: none;
            }

            #bestsellers .product-card {
                flex: 0 0 100% !important;
                min-width: 100% !important;
                scroll-snap-align: center;
                padding: 10px !important; /* Reduced from 15px */
            }

            /* Show 2 cards on larger tablets */
            @media (min-width: 700px) {
                #bestsellers .product-card {
                    flex: 0 0 50% !important;
                    min-width: 50% !important;
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

            #bestsellers .testi-prev {
                left: 5px !important;
            }

            #bestsellers .testi-next {
                right: 5px !important;
            }

            #bestsellers .sec-head {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                gap: 10px !important;
                margin-bottom: 30px !important;
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
                top: 25px;
                bottom: 25px;
                width: 2px;
                background: var(--primary);
                opacity: 0.2;
                z-index: 0;
            }

            .step {
                display: flex !important;
                align-items: center !important;
                gap: 20px !important;
                text-align: left !important;
                width: 100% !important;
                position: relative !important;
                z-index: 1 !important;
            }

            .step-num {
                width: 50px !important;
                height: 50px !important;
                min-width: 50px !important;
                font-size: 1.1rem !important;
                margin: 0 !important;
                background: var(--primary) !important;
            }

            .step h4 {
                margin: 0 !important;
                font-size: 1.2rem !important;
                white-space: normal !important;
            }

            .step-sub {
                white-space: normal !important;
                font-size: 0.9rem !important;
                display: inline-block !important;
                margin-left: 0px;
            }

            .step-line {
                display: none !important;
            }

            /* Tiny Screen Adjustments (320px - 450px) */
            @media (max-width: 450px) {
                .step h4 {
                    font-size: 1rem !important;
                }

                .step-sub {
                    font-size: 0.75rem !important;
                    margin-left: 5px;
                }

                .step-num {
                    width: 40px !important;
                    height: 40px !important;
                    min-width: 40px !important;
                    font-size: 0.95rem !important;
                }

                .steps-section .steps-flow::before {
                    left: 35px !important;
                }

                .step {
                    gap: 12px !important;
                }
            }
        }
    </style>
@endsection
@section('extra_js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const scrollerConfigs = [
                { selector: '.ing-scroller', step: 300, interval: 3500 },
                { selector: '.product-grid', step: 350, interval: 4500 },
                { selector: '.reviews-grid', step: 400, interval: 5500 }
            ];

            scrollerConfigs.forEach(config => {
                const el = document.querySelector(config.selector);
                if (!el) return;

                let autoScrollTimer;
                let isPaused = false;

                const startAutoScroll = () => {
                    autoScrollTimer = setInterval(() => {
                        if (isPaused) return;

                        const maxScroll = el.scrollWidth - el.clientWidth;
                        if (el.scrollLeft >= maxScroll - 20) {
                            el.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            el.scrollBy({ left: config.step, behavior: 'smooth' });
                        }
                    }, config.interval);
                };

                const stopAutoScroll = () => {
                    clearInterval(autoScrollTimer);
                };

                // Pause on interaction
                el.addEventListener('mouseenter', () => isPaused = true);
                el.addEventListener('mouseleave', () => isPaused = false);
                el.addEventListener('touchstart', () => isPaused = true, { passive: true });
                el.addEventListener('touchend', () => {
                    setTimeout(() => isPaused = false, 2000);
                }, { passive: true });

                startAutoScroll();

                // Re-start timer on manual scroll/button click to prevent immediate auto-scroll after manual action
                el.addEventListener('scroll', () => {
                    stopAutoScroll();
                    startAutoScroll();
                }, { passive: true });
            });
        });
    </script>
@endsection