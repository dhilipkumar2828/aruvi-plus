@extends('layouts.auri')

@section('content')
    <!-- Hero Section -->
    <section class="hero hero-home" data-images='["{{ asset('images/hero_bg.jpg') }}", "{{ asset('images/hero_bg_2.jpg') }}"]'
        style="background-image: url('{{ asset('images/hero_bg.jpg') }}');">
        <div class="hero-content">
            <h1 class="hero-title">
                Navapashanam Beads For <br>Realizing Your Inner Peace
            </h1>
            <a href="{{ url('/shop') }}" class="btn btn-hero">SHOP NOW</a>
        </div>
        <div class="hero-controls">
            <button class="hero-arrow hero-prev"><i class="fas fa-arrow-left"></i></button>
            <button class="hero-arrow hero-next"><i class="fas fa-arrow-right"></i></button>
        </div>

        <style>
            @media (max-width: 991px) {
                section {
                    padding: 40px 0 !important;
                }

                .hero-home {
                    height: 450px !important;
                    /* Keep hero height reasonable */
                    padding: 0 !important;
                }
            }
        </style>
    </section>

    <!-- Product Showcase (Redesigned Spotlight Layout) -->
    <section style="background: var(--theme-gradient); padding: 60px 0;">
        <div class="container">
            <div class="section-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title">Navapashanam Products</h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p class="section-subtitle">Experience the transformative energy of our hand-picked Navapashanam treasures.
                </p>
            </div>

            <!-- Responsive Product Slide Scroll -->
            <div style="position: relative;">
                <button class="article-slider-arrow prev nava-arrow"
                    onclick="document.getElementById('navapashanam-scroll-grid').scrollBy({left: -document.getElementById('navapashanam-scroll-grid').clientWidth, behavior: 'smooth'})"
                    style="display: flex !important; top: 50%; transform: translateY(-50%);"><i
                        class="fas fa-chevron-left"></i></button>
                <button class="article-slider-arrow next nava-arrow"
                    onclick="document.getElementById('navapashanam-scroll-grid').scrollBy({left: document.getElementById('navapashanam-scroll-grid').clientWidth, behavior: 'smooth'})"
                    style="display: flex !important; top: 50%; transform: translateY(-50%);"><i
                        class="fas fa-chevron-right"></i></button>

                <div id="navapashanam-scroll-grid"
                    style="
                display: flex;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                scrollbar-width: none;
                -ms-overflow-style: none;
                padding-top: 20px;
                padding-bottom: 20px;
                gap: 20px;
            ">
                    <style>
                        #navapashanam-scroll-grid::-webkit-scrollbar {
                            display: none;
                        }

                        #navapashanam-scroll-grid .premium-product-card {
                            flex: 0 0 100%;
                            scroll-snap-align: center;
                            margin: 0;
                        }

                        @media (min-width: 992px) {
                            .nava-arrow.prev {
                                left: -50px !important;
                            }

                            .nava-arrow.next {
                                right: -50px !important;
                            }
                        }
                    </style>

                    @forelse ($featuredProducts as $index => $product)
                        @php
                            $gallery = $product->gallery_images ?? [];
                            $gallery = is_array($gallery) ? $gallery : [];
                            $primaryImage = $product->primary_image;
                            $images = [];
                            if ($primaryImage) {
                                $images[] = $primaryImage;
                            }
                            foreach ($gallery as $image) {
                                if ($image && $image !== $primaryImage) {
                                    $images[] = $image;
                                }
                            }
                        @endphp
                        <div class="premium-product-card {{ $index === 0 ? 'active-card' : '' }}">
                            @if ($product->badge_text)
                                <div class="premium-badge">{{ $product->badge_text }}</div>
                            @endif
                            <div class="wishlist-btn"><i class="far fa-heart"></i></div>
                            <div class="premium-img-box" id="product-{{ $product->id }}">
                                <div class="slider-container">
                                    @foreach ($images as $imageIndex => $image)
                                        <div class="slide {{ $imageIndex === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image) }}" alt="{{ $product->name }}" 
                                                 loading="lazy" decoding="async" width="400" height="400">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="premium-card-content">
                                <div>
                                    <div class="premium-category">
                                        @if ($product->category_rel)
                                            <a href="{{ route('category.show', $product->category_rel->slug) }}"
                                                style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 5px; justify-content: flex-start;">
                                                <i class="fas fa-tag" style="font-size: 10px;"></i>
                                                {{ $product->category_rel->name }}
                                            </a>
                                        @else
                                            <div
                                                style="display: flex; align-items: center; gap: 5px; justify-content: flex-start;">
                                                <i class="fas fa-tag" style="font-size: 10px;"></i>
                                                {{ $product->category ?? 'Collection' }}
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="premium-title"><a
                                            href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <p class="premium-desc">{{ $product->short_description }}</p>
                                    <div class="premium-rating"
                                        style="display: flex; gap: 4px; justify-content: flex-start; margin-bottom: 8px; color: #ff9100; font-size: 13px;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= round($product->rating) ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                        @if ($product->reviews_count > 0)
                                            <span
                                                style="color: #888; font-size: 11px; margin-left: 5px;">({{ $product->reviews_count }})</span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="premium-price-row">
                                        <span class="current-price">{{ format_inr($product->price) }}</span>
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="premium-add-btn">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="padding: 40px; color: #888; width: 100%; text-align: center;">No products yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- About Bogar / Sage Section (Parallax) -->
    <section style="position: relative; overflow: hidden; padding: 100px 0;">
        <div
            style="position: absolute; top: -10px; left: -10px; width: calc(100% + 20px); height: calc(100% + 20px); background-image: url('{{ asset('images/sage_bg_full.jpg') }}'); background-attachment: fixed; background-size: cover; background-position: center; filter: blur(0px); z-index: 1;">
        </div>
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 2;">
        </div>
        <div class="container" style="position: relative; z-index: 2; color: #fff; text-align: center;">
            <div class="about-text" style="max-width: 800px; margin: 0 auto;">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title responsive-title" style="color: #f6f6f6; margin-bottom: 0;">Bogar Siddha Peedam
                        - Bogar Alchemist LLP
                        <br><span class="responsive-slogan"
                            style="font-size: 24px; color: #ddd; font-weight: 400;">Illuminating Paths to
                            Spiritual Triumph</span>
                    </h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p style="color: #eee; margin-bottom: 25px; line-height: 1.8; font-size: 16px;">
                    Navapashanam (Sanskrit: Navapashanam) is a secret alchemical preparation created by the
                    great Siddha Bogar. It is an amalgam of nine poisonous substances that are purified and
                    processed to become a life-saving panacea.
                </p>
                <p style="color: #eee; margin-bottom: 30px; line-height: 1.8; font-size: 16px;">
                    Our mission is to empower lives with harmonious principles, creating a transformative
                    journey to success. We illuminate the path with positivity, fostering a fulfilling life for
                    all.
                </p>
                <a href="{{ url('/about') }}" class="btn"
                    style="background: var(--icon-gradient); border: none; color: #fff; box-shadow: 0 5px 15px rgba(194, 24, 91, 0.3);">Read
                    More</a>
            </div>
        </div>
    </section>

    <!-- Section 1: New Arrivals -->
    <section class="bg-theme-light" style="padding-bottom: 40px;">
        <div class="container">
            <div class="section-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title">NEW ARRIVALS</h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p class="section-subtitle">Navapashanam products help elevate life, instill harmony, <br>and usher
                    prosperity. It brings forth transformative energy that enriches every aspect of your existence.</p>
            </div>
            <div class="product-grid">
                @forelse ($newArrivals as $arrival)
                    @php
                        $gallery = $arrival->gallery_images ?? [];
                        $gallery = is_array($gallery) ? $gallery : [];
                        $primaryImage = $arrival->primary_image;
                        $images = [];
                        if ($primaryImage) {
                            $images[] = $primaryImage;
                        }
                        foreach ($gallery as $image) {
                            if ($image && $image !== $primaryImage) {
                                $images[] = $image;
                            }
                        }
                    @endphp
                    <div class="product-card">
                        <div class="product-img-wrapper" id="arrival-{{ $arrival->id }}">
                            @if ($arrival->is_new_arrival)
                                <span class="new-arrival-badge">New arrival</span>
                            @endif
                            <div class="slider-container">
                                @foreach ($images as $imageIndex => $image)
                                    <div class="slide {{ $imageIndex === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image) }}" alt="{{ $arrival->name }}" 
                                             loading="lazy" decoding="async" width="300" height="300">
                                    </div>
                                @endforeach
                                @if (count($images) > 1)
                                    <button class="slider-arrow prev"><i class="fas fa-chevron-left"></i></button>
                                    <button class="slider-arrow next"><i class="fas fa-chevron-right"></i></button>
                                @endif
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a
                                    href="{{ route('product.show', $arrival->slug) }}">{{ $arrival->name }}</a></h3>
                            <div class="product-meta">
                                <div class="price-box"><span
                                        class="product-price">{{ format_inr($arrival->price) }}</span></div>
                                <div class="star-rating" style="color: #ff9100;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= round($arrival->rating) ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                    <span
                                        style="font-size: 12px; color: #888; margin-left: 5px;">{{ $arrival->reviews_count }}
                                        reviews</span>
                                </div>
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" style="margin: 0;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $arrival->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="padding: 20px; color: #888;">No new arrivals yet.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Custom Features Section -->
    <section class="custom-features-section">
        <div class="container">
            <div class="section-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title">Sacred Craftsmanship</h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p class="section-subtitle">Meticulously created for spiritual resonance</p>
            </div>
            <div class="custom-features-wrapper">
                <div class="custom-feature-item">
                    <img src="{{ asset('images/custom_feature_1.png') }}" alt="Handcrafted with care"
                        class="custom-feature-img" loading="lazy" decoding="async" width="500" height="500">
                    <div class="custom-feature-text">Home Blessing<br> home aura with Navapashanam statues<br>with care
                    </div>
                </div>
                <div class="custom-feature-item">
                    <img src="{{ asset('images/artisans_sketch.jpg') }}" alt="Artisans Sketching"
                        class="custom-feature-img" loading="lazy" decoding="async" width="500" height="500">
                    <div class="custom-feature-text">Office Empowerment<br>Foster success with Navapashanam beads</div>
                </div>
                <div class="custom-feature-item">
                    <img src="{{ asset('images/temple_sketch.png') }}" alt="Temple Interior Specialist"
                        class="custom-feature-img" loading="lazy" decoding="async" width="500" height="500">
                    <div class="custom-feature-text">Hand Elegance Enhance individual strength, wear Navapashanam bracelet
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Benefits Section -->
    <section class="benefits-section">
        <div class="benefits-bg-ornament"></div>
        <div class="container">
            <div class="section-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title">Benefits Of Navapashanam Products</h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p class="section-subtitle">Navapashanam products bring forth a transformative journey. Each product holds
                    cosmic energy.</p>
            </div>
            <div class="premium-benefits-grid">
                <div class="divine-benefit-card">
                    <div class="benefit-icon-box"><i class="fas fa-leaf benefit-icon"></i></div>
                    <h4 class="benefit-title">Self-Confidence</h4>
                    <div class="benefit-desc">Instills a deep sense of courage and self-assurance from within.</div>
                </div>
                <div class="divine-benefit-card">
                    <div class="benefit-icon-box"><i class="fas fa-dove benefit-icon"></i></div>
                    <h4 class="benefit-title">Peace of Mind</h4>
                    <div class="benefit-desc">Calms the turbulent mind and brings serene tranquility.</div>
                </div>
                <div class="divine-benefit-card">
                    <div class="benefit-icon-box"><i class="fas fa-shield-alt benefit-icon"></i></div>
                    <h4 class="benefit-title">Evil Eye Protection</h4>
                    <div class="benefit-desc">Acts as a divine shield guarding against negative energies.</div>
                </div>
                <div class="divine-benefit-card">
                    <div class="benefit-icon-box"><i class="fas fa-heartbeat benefit-icon"></i></div>
                    <h4 class="benefit-title">Restores Health</h4>
                    <div class="benefit-desc">Harmonizes the body's energy for overall well-being.</div>
                </div>
                <div class="divine-benefit-card">
                    <div class="benefit-icon-box"><i class="fas fa-brain benefit-icon"></i></div>
                    <h4 class="benefit-title">Mental Clarity</h4>
                    <div class="benefit-desc">Sharpens focus and clears the fog of confusion.</div>
                </div>
                <div class="divine-benefit-card">
                    <div class="benefit-icon-box"><i class="fas fa-balance-scale benefit-icon"></i></div>
                    <h4 class="benefit-title">Balances Chakra</h4>
                    <div class="benefit-desc">Aligns the vital energy centers for spiritual growth.</div>
                </div>
                <div class="divine-benefit-card">
                    <div class="benefit-icon-box"><i class="fas fa-briefcase benefit-icon"></i></div>
                    <h4 class="benefit-title">Career Growth</h4>
                    <div class="benefit-desc">Attracts opportunities and success in professional life.</div>
                </div>
                <div class="divine-benefit-card">
                    <div class="benefit-icon-box"><i class="fas fa-home benefit-icon"></i></div>
                    <h4 class="benefit-title">Family Harmony</h4>
                    <div class="benefit-desc">Fosters love, understanding, and unity in the home.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Origin Section -->
    <section class="origin-section">
        <div class="container">
            <div class="origin-layout">
                <div class="origin-content">
                    <span class="origin-subtitle">Divine Wisdom</span>
                    <h2 class="origin-title">Origin Of Navapashanam: <br>The Elixir of Life</h2>
                    <div class="origin-text">
                        <p>Crafted by the ancient Siddha Bogar, Navapashanam is more than a bead; it is a crystallized form
                            of divine energy.</p>
                        <p>Composed of nine distinct poisons (Pashanams), purified through secret alchemical processes, it
                            transforms into a life-sustaining panacea that balances the body's energy and connects you to
                            the cosmos.</p>
                    </div>
                    <div class="video-btn-wrapper">
                        <div class="play-button"><i class="fas fa-play"></i></div>
                        <div class="watch-text">Discover The Legend
                            <div style="font-size: 11px; color: #888; font-weight: 400; text-transform: none;">Watch the
                                story of Siddha Bogar</div>
                        </div>
                    </div>
                </div>
                <div class="origin-image-container">
                    <a href="https://www.youtube.com/watch?v=Lh0rxXujNPU" target="_blank" class="video-thumbnail-link"
                        style="position: relative; display: block;">
                        <img src="{{ asset('images/video_thumbnail.jpg') }}" alt="Watch Descendants of Bogar"
                            class="origin-image-main" loading="lazy" decoding="async" width="800" height="450">
                        <div class="play-overlay"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 60px; height: 60px; background: rgba(194, 24, 91, 0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                            <i class="fas fa-play"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Divine Process Flow Section -->
    <section class="divine-flow-section bg-theme-light">
        <div class="container">
            <div class="section-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title" style="white-space: nowrap;">How Navapashanam Works</h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p class="section-subtitle">Navapashanam products awaken divine connection, channeling ThalaVriksham's
                    energy. <br>It bridges divine realms. Immerse in elixir or wear as a chain for profound connection.</p>
            </div>
            <div class="process-flow-container">
                <div class="process-row">
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-gopuram step-icon"></i></div>
                        <h4 class="step-title">ThalaVriksham</h4>
                        <p class="step-desc">Initial appearance of divinity in a temple setting.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-crosshairs step-icon"></i></div>
                        <h4 class="step-title">Cock-Etched Spear</h4>
                        <p class="step-desc">Attracts divine energy from thala vriksham directly.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-fire step-icon"></i></div>
                        <h4 class="step-title">Yagna Rituals</h4>
                        <p class="step-desc">Intensify divine presence in the sacred spear.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-bullseye step-icon"></i></div>
                        <h4 class="step-title">Navapashanam Beads</h4>
                        <p class="step-desc">Absorb and transmit this divine energy effectively.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-users step-icon"></i></div>
                        <h4 class="step-title">Profound Connection</h4>
                        <p class="step-desc">Creates a sacred and spiritual link for all around.</p>
                    </div>
                </div>
                <div class="process-row">
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-place-of-worship step-icon"></i></div>
                        <h4 class="step-title">Pooja Room</h4>
                        <p class="step-desc">Placing the Navapashanam statue in your sacred space.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-hand-holding-water step-icon"></i></div>
                        <h4 class="step-title">Offerings</h4>
                        <p class="step-desc">Performing ablution with milk or sacred water.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-prescription-bottle-alt step-icon"></i></div>
                        <h4 class="step-title">Potent Elixir</h4>
                        <p class="step-desc">Consuming the Navapashanam-infused holy offerings.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-bolt step-icon"></i></div>
                        <h4 class="step-title">Divine Energy</h4>
                        <p class="step-desc">Directly awakens the true Self within you.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-icon-box"><i class="fas fa-spa step-icon"></i></div>
                        <h4 class="step-title">Awakening</h4>
                        <p class="step-desc">Deep self-awareness elicited by consuming this elixir.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us-section">
        <div class="container">
            <div class="why-choose-us-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title">Why Choose Us?</h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p class="section-subtitle">Bogar Siddha Peedam - Bogar Alchemist LLP guides to prosperity through ancient
                    wisdom of Navapashanam. Our Navapashanam products help illuminate a transformative path with positivity,
                    fostering fulfillment and success.</p>
            </div>
            <div class="why-container-split">
                <div class="why-visual-side">
                    <div class="image-halo-wrapper">
                        <img src="{{ asset('images/hands_offering.jpg') }}" alt="Divine Offering" class="why-hero-img">
                        <div class="halo-ring ring-1"></div>
                        <div class="halo-ring ring-2"></div>
                    </div>
                </div>
                <div class="why-content-side">
                    <div class="why-features-grid">
                        <div class="why-feature-card">
                            <div class="feature-icon-box"><i class="fas fa-certificate"></i></div>
                            <div class="feature-info">
                                <h4>100% Authentic</h4>
                                <p>Lab-tested and certified for purity to ensure the real power of Navapashanam.</p>
                            </div>
                        </div>
                        <div class="why-feature-card">
                            <div class="feature-icon-box"><i class="fas fa-hand-holding-heart"></i></div>
                            <div class="feature-info">
                                <h4>Artisan Crafted</h4>
                                <p>Handcrafted by skilled artisans following ancient Siddha traditions & sanctity.</p>
                            </div>
                        </div>
                        <div class="why-feature-card">
                            <div class="feature-icon-box"><i class="fas fa-globe-asia"></i></div>
                            <div class="feature-info">
                                <h4>Global Reach</h4>
                                <p>Delivering divine energy to your doorstep anywhere in the world securely.</p>
                            </div>
                        </div>
                        <div class="why-feature-card">
                            <div class="feature-icon-box"><i class="fas fa-headset"></i></div>
                            <div class="feature-info">
                                <h4>24/7 Guidance</h4>
                                <p>Dedicated spiritual support team available to guide your journey.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="festival-section" id="stats"
        style="position: relative; background-image: url('{{ asset('images/navapashanam_bg.png') }}'); background-size: cover; background-position: center; background-attachment: fixed; padding: 100px 0;">
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.3); z-index: 1;">
        </div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="festival-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title" style="color: #fff;">Who We Are</h2>
                    <span class="title-decoration-line right"></span>
                </div>
            </div>
            <div class="festival-grid" style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center;">
                <div class="festival-item" style="width: 200px; text-align: center;">
                    <div class="stat-number"
                        style="font-size: 40px; font-weight: 800; background: var(--icon-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        <span class="counter" data-target="10">0</span><span>+</span>
                    </div>
                    <div class="festival-name" style="color: #fff; text-transform: uppercase;">Navapashanam Products</div>
                </div>
                <div class="festival-item" style="width: 200px; text-align: center;">
                    <div class="stat-number"
                        style="font-size: 40px; font-weight: 800; background: var(--icon-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        <span class="counter" data-target="20">0</span><span>+</span>
                    </div>
                    <div class="festival-name" style="color: #fff; text-transform: uppercase;">Years Of Experience</div>
                </div>
                <div class="festival-item" style="width: 200px; text-align: center;">
                    <div class="stat-number"
                        style="font-size: 40px; font-weight: 800; background: var(--icon-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        <span class="counter" data-target="1000">0</span><span>+</span>
                    </div>
                    <div class="festival-name" style="color: #fff; text-transform: uppercase;">Trusted Clients</div>
                </div>
                <div class="festival-item" style="width: 200px; text-align: center;">
                    <div class="stat-number"
                        style="font-size: 40px; font-weight: 800; background: var(--icon-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        <span class="counter" data-target="30">0</span><span>+</span>
                    </div>
                    <div class="festival-name" style="color: #fff; text-transform: uppercase;">Authentic Alchemists</div>
                </div>
                <div class="festival-item" style="width: 200px; text-align: center;">
                    <div class="stat-number"
                        style="font-size: 40px; font-weight: 800; background: var(--icon-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        <span class="counter" data-target="1000">0</span><span>+</span>
                    </div>
                    <div class="festival-name" style="color: #fff; text-transform: uppercase;">Success Stories</div>
                </div>
            </div>
        </div>
    </section>

    @if (count($testimonials) > 0)
        <!-- Client Testimonials -->
        <section class="celebrity-reviews-section bg-theme-light">
            <div class="container">
                <div class="section-header">
                    <div class="premium-header-wrapper">
                        <span class="title-decoration-line left"></span>
                        <h2 class="section-title">What Our Clients Say</h2>
                        <span class="title-decoration-line right"></span>
                    </div>
                    <p class="section-subtitle">Real experiences from those who embraced the divine</p>
                </div>
                <div class="slider-container review-layout" style="min-height: 500px; position: relative;">
                    @foreach ($testimonials as $index => $testimonial)
                        <div class="slide review-slide {{ $index === 0 ? 'active' : '' }}">
                            <div class="review-image-container">
                                @if ($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}"
                                        class="review-image-main">
                                @else
                                    <div
                                        style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user" style="font-size: 80px; color: #ccc;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="review-content">
                                <span class="review-subtitle">Testimonial</span>
                                <div class="star-rating-review">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star"
                                            style="color: {{ $i <= $testimonial->rating ? '#ff9100' : '#ddd' }}"></i>
                                    @endfor
                                </div>
                                <h2 class="review-title">"{{ $testimonial->content }}"</h2>
                                <div class="review-author-note">{{ $testimonial->name }}
                                    {{ $testimonial->designation ? '- ' . $testimonial->designation : '' }}</div>
                            </div>
                        </div>
                    @endforeach

                    @if (count($testimonials) > 1)
                        <div class="review-controls"
                            style="position: absolute; bottom: 0; left: 50%; width: 100%; display: flex; justify-content: flex-end; padding-right: 20px;">
                            <button class="review-nav-btn prev slider-arrow"
                                style="background: none; border: none; font-size: 24px;"><i
                                    class="fas fa-chevron-left"></i></button>
                            <button class="review-nav-btn next slider-arrow"
                                style="background: none; border: none; font-size: 24px;"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Latest Articles -->
    <section class="articles-section">
        <div class="container">
            <div class="section-header">
                <div class="premium-header-wrapper">
                    <span class="title-decoration-line left"></span>
                    <h2 class="section-title">Latest Articles</h2>
                    <span class="title-decoration-line right"></span>
                </div>
                <p class="section-subtitle">Insights from the world of Siddha wisdom</p>
            </div>

            <div style="position: relative;">
                <button class="article-slider-arrow prev d-md-none"
                    onclick="document.getElementById('articles-scroll-grid').scrollBy({left: -320, behavior: 'smooth'})"><i
                        class="fas fa-chevron-left"></i></button>
                <button class="article-slider-arrow next d-md-none"
                    onclick="document.getElementById('articles-scroll-grid').scrollBy({left: 320, behavior: 'smooth'})"><i
                        class="fas fa-chevron-right"></i></button>

                <div class="articles-grid" id="articles-scroll-grid">
                    @forelse ($latestBlogs as $blog)
                        <div class="article-card">
                            @if ($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="article-image">
                            @endif
                            <div class="article-content">
                                <div class="article-date"><i class="far fa-calendar-alt"></i>
                                    {{ optional($blog->published_at)->format('M d, Y') }}</div>
                                <h3 class="article-title">{{ $blog->title }}</h3>
                                <p class="article-excerpt">{{ $blog->excerpt }}</p>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more-link">Read More <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; color: #777;">No articles yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
