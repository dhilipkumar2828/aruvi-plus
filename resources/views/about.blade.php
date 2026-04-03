@extends('layouts.auri')

@section('title', 'About Us | Auvri Plus')

@section('content')
    <!-- Page Title / Hero -->
    <section class="hero-small"
        style="background-image: url('{{ asset('images/sage_bg_full.jpg') }}'); background-size: cover; background-position: center; height: 350px; display: flex; align-items: center; justify-content: center; position: relative;">
        <!-- Overlay -->
        <div
            style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(180deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);">
        </div>

        <div class="container" style="position: relative; z-index: 2; text-align: center;">
            <h1 style="color: #fff; font-size: 48px; font-weight: 700; text-shadow: 0 4px 10px rgba(0,0,0,0.3);">About
                Us</h1>
            <p class="responsive-slogan" style="color: #eee; font-size: 18px; margin-top: 10px;">Illuminating Paths to Spiritual Triumph</p>
        </div>
    </section>

    <!-- Main About Content -->
    <section style="padding: 80px 0;">
        <div class="container">
            <div class="row" style="display: flex; gap: 50px; flex-wrap: wrap; align-items: center;">
                <!-- Image Side -->
                <div style="flex: 1; min-width: 300px;">
                    <img src="{{ asset('images/sage_Auvri Plus.jpg') }}" alt="Auvri Plus"
                        style="width: 100%; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                </div>
                <!-- Text Side -->
                <div style="flex: 1; min-width: 300px;">
                    <div class="premium-header-wrapper" style="margin-bottom: 20px; justify-content: flex-start;">
                        <h2 class="section-title responsive-title" style="margin: 0; text-align: left;">Auvri Plus</h2>
                    </div>
                    <p style="margin-bottom: 20px; line-height: 1.8; color: #555;">
                        Auvri Plus is dedicated to guiding individuals toward prosperity and triumph by
                        harnessing ancient wisdom and spiritual enlightenment. Grounded in the teachings of the great
                        Auvri Plus, we serve as a bridge between the ancient alchemical secrets and modern spiritual
                        seekers.
                    </p>
                    <p style="margin-bottom: 20px; line-height: 1.8; color: #555;">
                        Our core offering, <strong>Navapashanam</strong> (sanskrit: Navapaṣāṇam), is a secret
                        alchemical
                        preparation created by Auvri Plus. Keep in mind that "Pashanam" translates to poison. However,
                        in the hands of a master alchemist like Auvri Plus, these nine poisonous substances are purified,
                        processed, and combined to become a life-saving panacea.
                    </p>
                    <p style="line-height: 1.8; color: #555;">
                        Our mission is to empower lives with harmonious principles, creating a transformative journey to
                        success. We illuminate the path with positivity, fostering a fulfilling life for all who seek
                        our guidance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: What are Navapashanam Beads? -->
    <section class="bg-theme-light" style="padding: 80px 0; overflow: hidden;">
        <div class="container">
            <div class="section-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title">What are Navapashanam Beads?</h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p class="section-subtitle">Divine Essence of Navapashanam Beads</p>
            </div>

            <div class="row" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-top: 40px;">
                
                <!-- Text Content (Left) -->
                <div style="flex: 0 0 50%; max-width: 50%; padding-right: 25px; box-sizing: border-box; text-align: center;">
                    <p style="margin-bottom: 25px; line-height: 1.8; color: #555; font-size: 16px;">
                        Navapashanam Beads are not merely jewelry; they are vessels of potent cosmic energy.
                        "Navapashanam" is derived from two words: <strong>'Nava'</strong> meaning nine, and
                        <strong>'Pashanam'</strong> meaning poison. This refers to the nine unique alchemical poisons
                        that, when purified and combined by the great Auvri Plus, transform into a supreme life-giving
                        elixir.
                    </p>
                    <p style="margin-bottom: 35px; line-height: 1.8; color: #555; font-size: 16px;">
                        The beads act as a catalyst, absorbing and transmitting divine energy from the cosmos and the
                        sacred ThalaVriksham. When worn or placed in your sacred space, these beads create a protective
                        aura, harmonizing your personal energy field and warding off negative influences.
                    </p>
                    
                    <div style="background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: left; display: inline-block; width: 100%; border-left: 5px solid var(--primary-color);">
                        <h4 style="color: #333; margin-bottom: 20px; font-weight: 600; text-align: center;">Key Benefits</h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                            <li style="color: #666; display: flex; align-items: center;"><i class="fas fa-check-circle"
                                    style="color: var(--primary-color); margin-right: 10px; font-size: 18px;"></i> Radiates positive vibrations</li>
                            <li style="color: #666; display: flex; align-items: center;"><i class="fas fa-check-circle"
                                    style="color: var(--primary-color); margin-right: 10px; font-size: 18px;"></i> Enhances spiritual focus</li>
                            <li style="color: #666; display: flex; align-items: center;"><i class="fas fa-check-circle"
                                    style="color: var(--primary-color); margin-right: 10px; font-size: 18px;"></i> Balances energy (Chakras)</li>
                            <li style="color: #666; display: flex; align-items: center;"><i class="fas fa-check-circle"
                                    style="color: var(--primary-color); margin-right: 10px; font-size: 18px;"></i> Shield against evil eye</li>
                        </ul>
                    </div>
                </div>

                <!-- Visual Content (Right & Centered) -->
                <div style="flex: 0 0 50%; max-width: 50%; padding-left: 25px; box-sizing: border-box; display: flex; justify-content: center;position: relative;left: 90px;">
                    <div style="position: relative; max-width: 450px; width: 100%;">
                        <!-- Chakra Aura Background -->
                        <div class="chakra-ring chakra-ring-1"></div>
                        <div class="chakra-ring chakra-ring-2"></div>
                        
                        <img src="{{ asset('images/navapashanam_bead_v2.png') }}" alt="Divine Navapashanam Beads"
                            style="position: relative; z-index: 2; width: 100%; filter: drop-shadow(0 15px 30px rgba(0,0,0,0.2)); transition: transform 0.3s ease;">
                    </div>
                </div>
            </div>

            <style>
                @media (max-width: 991px) {
                    /* Mobile Layout Adjustments */
                    section {
                        padding: 40px 0 !important;
                    }

                    .row > div {
                        flex: 0 0 100% !important;
                        max-width: 100% !important;
                        padding: 0 15px !important;
                        margin-bottom: 40px !important; /* Reduced from 70px */
                        /* Reset positioning for all column divs to ensure centering */
                        left: 0 !important;
                        text-align: center !important;
                    }
                    
                    /* Adjust Chakra Rings and Image Container on Mobile */
                    div[style*="position: relative; max-width: 450px"] {
                        max-width: 220px !important; /* Much smaller container for mobile */
                        margin: 40px auto 0 !important; /* Move down and center */
                        padding-top: 0 !important; /* Ensure no padding breaks alignment */
                    }

                    /* Center 'How to Use' Headings and Content */
                    .usage-split-section .section-title, 
                    .usage-split-section h3, 
                    .usage-split-section p {
                        text-align: center !important;
                    }
                    .usage-split-section button {
                        display: block;
                        margin: 0 auto 15px auto !important;
                    }

                    /* 2-Column Grid for Usage Steps */
                    .usage-steps-list {
                        display: grid !important;
                        grid-template-columns: 1fr 1fr !important;
                        gap: 30px 15px !important;
                        margin-top: 30px;
                    }

                    .usage-step-item {
                        flex-direction: column !important;
                        text-align: center !important;
                        gap: 15px !important;
                        margin-bottom: 0 !important;
                    }

                    .usage-step-item > div:first-child {
                        margin: 0 auto;
                    }

                    /* 2-Column Grid for How it Works */
                    .how-it-works-grid {
                        grid-template-columns: 1fr 1fr !important;
                        gap: 20px 15px !important;
                    }

                    .premium-quality-card {
                        padding: 25px 15px !important;
                    }

                    .premium-quality-card .quality-icon {
                        width: 60px !important;
                        height: 60px !important;
                        font-size: 24px !important;
                        margin-bottom: 15px !important;
                    }

                    .premium-quality-card .quality-title {
                        font-size: 16px !important;
                    }

                    .premium-quality-card .quality-desc {
                        font-size: 13px !important;
                        line-height: 1.4 !important;
                    }

                    .chakra-ring-1 {
                        width: 100% !important;
                        height: 100% !important;
                        /* Brighter colors for mobile visibility */
                        background: conic-gradient(from 0deg,
                            rgba(194, 24, 91, 0.6),
                            rgba(212, 175, 55, 0.6),
                            rgba(194, 24, 91, 0.6)) !important;
                        mask: radial-gradient(circle, transparent 60%, #000 62%) !important;
                        -webkit-mask: radial-gradient(circle, transparent 60%, #000 62%) !important;
                    }
                    
                    .chakra-ring-2 {
                        width: 130% !important;
                        height: 130% !important;
                        /* Brighter colors for mobile visibility */
                        background: conic-gradient(from 90deg,
                            rgba(212, 175, 55, 0.5),
                            rgba(194, 24, 91, 0.5),
                            rgba(212, 175, 55, 0.5)) !important;
                        mask: radial-gradient(circle, transparent 64%, #000 66%) !important;
                        -webkit-mask: radial-gradient(circle, transparent 64%, #000 66%) !important;
                    }
                }
                
                .chakra-ring {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    border-radius: 50%;
                    /* Increased base opacity for brightness */
                    opacity: 0.9;
                    z-index: 1;
                    /* Simpler animation for better performance */
                    animation: chakra-spin 20s linear infinite;
                    pointer-events: none; /* Prevent interference with clicks */
                }

                .chakra-ring-1 {
                    width: 120%;
                    height: 120%;
                    background: conic-gradient(from 0deg,
                            rgba(194, 24, 91, 0.15),
                            rgba(212, 175, 55, 0.15),
                            rgba(194, 24, 91, 0.15));
                    mask: radial-gradient(circle, transparent 60%, #000 62%);
                    -webkit-mask: radial-gradient(circle, transparent 60%, #000 62%);
                }

                .chakra-ring-2 {
                    width: 150%;
                    height: 150%;
                    background: conic-gradient(from 90deg,
                            rgba(212, 175, 55, 0.1),
                            rgba(194, 24, 91, 0.1),
                            rgba(212, 175, 55, 0.1));
                    mask: radial-gradient(circle, transparent 64%, #000 66%);
                    -webkit-mask: radial-gradient(circle, transparent 64%, #000 66%);
                    animation-duration: 30s;
                    animation-direction: reverse;
                }

                @keyframes chakra-spin {
                    from {
                        transform: translate(-50%, -50%) rotate(0deg);
                    }

                    to {
                        transform: translate(-50%, -50%) rotate(360deg);
                    }
                }
            </style>
        </div>
    </section>


    <!-- Section: How to Use it? (Split Layout) -->
    <section class="usage-split-section" style="padding: 100px 0; background: #fff;">
        <div class="container">
            <div class="row" style="display: flex; gap: 60px; flex-wrap: wrap; align-items: center;">
                <!-- Left: Visual -->
                <div style="flex: 1; min-width: 350px;">
                    <div style="position: relative;">
                        <!-- Decorative background blob -->
                        <div
                            style="position: absolute; top: -30px; left: -30px; width: 100%; height: 100%; background: #fffaf5; border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; z-index: 1;">
                        </div>
                        <img src="{{ asset('images/about-theme.png') }}" alt="Navapashanam Beads Ritual"
                            style="position: relative; z-index: 2; width: 100%; max-width: 500px; display: block; margin: 0 auto; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.1));">
                    </div>
                </div>

                <!-- Right: Content -->
                <div style="flex: 1; min-width: 350px;">
                    <button
                        style="border: none; background: var(--theme-pink-light); color: var(--primary-color); padding: 5px 15px; border-radius: 20px; font-weight: 600; font-size: 14px; margin-bottom: 15px;">THEME</button>
                    <h2 class="section-title" style="text-align: left; margin-bottom: 15px;">How to Use it?</h2>
                    <h3 style="font-size: 24px; color: #333; margin-bottom: 20px; font-weight: 600;">Navapashanam Beads
                        for Inner Awakening</h3>
                    <p style="color: #666; line-height: 1.8; margin-bottom: 40px;">
                        Navapashanam beads offer spiritual enlightenment and prosperity and infuse your life with divine
                        energy and harmony.
                        Incorporating them into your daily life is simple and profound.
                    </p>

                    <!-- Steps List -->
                    <div class="usage-steps-list">
                        <!-- Step 1 -->
                        <div class="usage-step-item"
                            style="display: flex; gap: 20px; margin-bottom: 30px; align-items: center;">
                            <div
                                style="flex-shrink: 0; width: 60px; height: 60px; background: var(--icon-gradient); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 10px 20px rgba(194, 24, 91, 0.2);">
                                <i class="fas fa-gem"></i>
                            </div>
                            <div>
                                <h4 style="font-size: 18px; color: #333; margin-bottom: 5px;">Purify the Body</h4>
                                <p style="font-size: 15px; color: #666; margin: 0;">Drink water stored with beads to
                                    detoxify internally.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="usage-step-item"
                            style="display: flex; gap: 20px; margin-bottom: 30px; align-items: center;">
                            <div
                                style="flex-shrink: 0; width: 60px; height: 60px; background: var(--icon-gradient); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 10px 20px rgba(194, 24, 91, 0.2);">
                                <i class="fas fa-prescription-bottle-alt"></i>
                            </div>
                            <div>
                                <h4 style="font-size: 18px; color: #333; margin-bottom: 5px;">Daily Bathing</h4>
                                <p style="font-size: 15px; color: #666; margin: 0;">Use bead-infused water for a refreshing
                                    and symbolic spiritual cleansing.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="usage-step-item"
                            style="display: flex; gap: 20px; margin-bottom: 30px; align-items: center;">
                            <div
                                style="flex-shrink: 0; width: 60px; height: 60px; background: var(--icon-gradient); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 10px 20px rgba(194, 24, 91, 0.2);">
                                <i class="fas fa-piggy-bank"></i>
                            </div>
                            <div>
                                <h4 style="font-size: 18px; color: #333; margin-bottom: 5px;">Attract Prosperity</h4>
                                <p style="font-size: 15px; color: #666; margin: 0;">Keep beads in your safe or wealth corner
                                    to invite abundance.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="usage-step-item" style="display: flex; gap: 20px; align-items: center;">
                            <div
                                style="flex-shrink: 0; width: 60px; height: 60px; background: var(--icon-gradient); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 10px 20px rgba(194, 24, 91, 0.2);">
                                <i class="fas fa-place-of-worship"></i>
                            </div>
                            <div>
                                <h4 style="font-size: 18px; color: #333; margin-bottom: 5px;">Spiritual Connection</h4>
                                <p style="font-size: 15px; color: #666; margin: 0;">Place on your altar to elevate
                                    meditation and prayers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: How it Works? (Premium Redesign) -->
    <section
        style="position: relative; padding: 100px 0; background-image: url('{{ asset('images/meditation_bg.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <!-- Dark Overlay -->
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); z-index: 1;">
        </div>

        <div class="container" style="position: relative; z-index: 2;">
            <div class="section-header">
                <!-- Premium White Header -->
                <h2 class="section-title"
                    style="color: #fff !important; font-size: 42px; margin-bottom: 15px; text-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                    How it Works?</h2>
                <p class="section-subtitle"
                    style="color: #ddd !important; font-size: 18px; max-width: 700px; margin: 0 auto;">
                    Transformative Qualities of Navapashanam Beads<br>
                    <span style="font-size: 14px; opacity: 0.8; font-weight: 400; display: block; margin-top: 10px;">
                        Each item carries celestial energy, fostering prosperity, well-being, and spiritual equilibrium.
                    </span>
                </p>
            </div>

            <div class="row how-it-works-grid"
                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 30px; margin-top: 60px;">

                <!-- Quality 1 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-bolt"></i></div>
                    <h4 class="quality-title">Energy Essence</h4>
                    <p class="quality-desc">Infuses vitality for a renewed boost</p>
                </div>

                <!-- Quality 2 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-sun"></i></div>
                    <h4 class="quality-title">Radiant Aura</h4>
                    <p class="quality-desc">Envelops with a tapestry of positivity</p>
                </div>

                <!-- Quality 3 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-heartbeat"></i></div>
                    <h4 class="quality-title">Wholeness Blend</h4>
                    <p class="quality-desc">Elevates holistic health and wellness</p>
                </div>

                <!-- Quality 4 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-chart-line"></i></div>
                    <h4 class="quality-title">Prosperity Beacon</h4>
                    <p class="quality-desc">Draws in success and financial abundance</p>
                </div>

                <!-- Quality 5 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-child"></i></div>
                    <h4 class="quality-title">Guardian Angel</h4>
                    <p class="quality-desc">Nurtures holistic growth in children</p>
                </div>

                <!-- Quality 6 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-om"></i></div>
                    <h4 class="quality-title">Soul Alchemy</h4>
                    <p class="quality-desc">Transforms spiritually with divine infusion</p>
                </div>

                <!-- Quality 7 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-running"></i></div>
                    <h4 class="quality-title">Vibrant Vitality</h4>
                    <p class="quality-desc">Radiates robust health and vitality</p>
                </div>

                <!-- Quality 8 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-shield-alt"></i></div>
                    <h4 class="quality-title">Warding Charm</h4>
                    <p class="quality-desc">Shields against negative energies</p>
                </div>

                <!-- Quality 9 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-star"></i></div>
                    <h4 class="quality-title">Celestial Alignment</h4>
                    <p class="quality-desc">Harmonizes with cosmic forces</p>
                </div>

                <!-- Quality 10 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-home"></i></div>
                    <h4 class="quality-title">Sacred Homestead</h4>
                    <p class="quality-desc">Enriches homes with blessings and harmony</p>
                </div>

                <!-- Quality 11 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-briefcase"></i></div>
                    <h4 class="quality-title">Business Enrichment</h4>
                    <p class="quality-desc">Ignites focus and prosperity in enterprises</p>
                </div>

                <!-- Quality 12 -->
                <div class="premium-quality-card">
                    <div class="quality-icon"><i class="fas fa-balance-scale"></i></div>
                    <h4 class="quality-title">Astral Equilibrium</h4>
                    <p class="quality-desc">Restores balance for spiritual serenity</p>
                </div>

            </div>

            <style>
                .premium-quality-card {
                    background: #ffffff;
                    padding: 40px 30px;
                    border-radius: 20px;
                    /* Highly rounded corners like reference */
                    text-align: center;
                    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
                    /* Deep shadow for float effect */
                    transition: all 0.4s ease;
                    position: relative;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100%;
                    border: 1px solid transparent;
                    /* Prepare for border transition */
                }

                .premium-quality-card:hover {
                    transform: translateY(-10px);
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
                    background: rgba(255, 255, 255, 0.1);
                    /* Glassy Transparent */
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                }

                /* Change text colors on hover for readability against dark bg */
                .premium-quality-card:hover .quality-title {
                    color: #fff;
                }

                .premium-quality-card:hover .quality-desc {
                    color: #eee;
                }

                /* Adjust Icon on hover */
                .premium-quality-card:hover .quality-icon {
                    background: rgba(255, 255, 255, 0.2);
                    color: #fff;
                    box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
                }

                .premium-quality-card .quality-icon {
                    width: 70px;
                    height: 70px;
                    background: var(--icon-gradient);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 25px;
                    font-size: 28px;
                    color: #fff;
                    box-shadow: 0 10px 20px rgba(194, 24, 91, 0.3);
                    transition: all 0.4s ease;
                }

                .premium-quality-card .quality-title {
                    margin-bottom: 12px;
                    font-size: 20px;
                    font-weight: 700;
                    color: #222;
                    font-family: 'Poppins', sans-serif;
                    transition: color 0.4s ease;
                }

                .premium-quality-card .quality-desc {
                    color: #666;
                    font-size: 15px;
                    line-height: 1.6;
                    transition: color 0.4s ease;
                }

                /* Vision & Mission Card Styles */
                .vision-mission-card {
                    flex: 1;
                    min-width: 300px;
                    background: #fff;
                    padding: 40px;
                    border-radius: 20px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                    text-align: center;
                    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                    position: relative;
                    overflow: hidden;
                    border: 1px solid rgba(212, 175, 55, 0.1);
                }

                .vision-mission-card:hover {
                    transform: translateY(-15px);
                    box-shadow: 0 25px 50px rgba(194, 24, 91, 0.15);
                    border-color: var(--primary-color);
                }

                .vision-mission-card .icon-circle {
                    width: 80px;
                    height: 80px;
                    background: #fffaf5;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 20px;
                    color: var(--primary-color);
                    font-size: 32px;
                    transition: all 0.4s ease;
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                }

                .vision-mission-card:hover .icon-circle {
                    background: var(--icon-gradient);
                    color: #fff;
                    transform: rotateY(360deg);
                    box-shadow: 0 10px 20px rgba(194, 24, 91, 0.3);
                }

                .vision-mission-card h3 {
                    margin-bottom: 15px;
                    font-size: 24px;
                    color: #333;
                    transition: color 0.3s ease;
                }

                .vision-mission-card:hover h3 {
                    color: var(--primary-color);
                }

                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .vision-mission-card {
                    animation: fadeInUp 1s ease-out forwards;
                }
            </style>
        </div>
    </section>

    <!-- Mission & Vision Cards (Moved Here) -->
    <section style="background-color: #fffaf5; padding: 80px 0;">
        <div class="container">
            <div style="display: flex; gap: 30px; flex-wrap: wrap;">
                <!-- Mission -->
                <div class="vision-mission-card">
                    <div class="icon-circle">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p style="color: #666; line-height: 1.6;">To empower individuals by providing access to authentic
                        Navapashanam products and spiritual wisdom, fostering holistic well-being and inner peace.</p>
                </div>
                <!-- Vision -->
                <div class="vision-mission-card" style="animation-delay: 0.2s;">
                    <div class="icon-circle">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p style="color: #666; line-height: 1.6;">To be a global beacon of Auvri Plus tradition, illuminating
                        the path for millions to realize their true potential and achieve spiritual triumph.</p>
                </div>
            </div>
        </div>
    </section>
@endsection