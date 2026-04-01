@extends('layouts.auri')

@section('title', 'Auvri Plus - Authentic Ayurvedic Remedies')
@section('meta_description', 'From herbal powders to nourishing oils and capsules, our Ayurvedic remedies support balance, vitality, and daily well-being.')

@section('content')
    <!-- 1. Hero -->
    <section class="hero-section">
        <div class="container hero-grid">
            <div class="hero-content">
                <h1>Nature's Wisdom for Modern Wellness</h1>
                <p>From herbal powders to nourishing oils and capsules, our Ayurvedic remedies are carefully prepared to support balance, vitality, and daily well-being.</p>
                <div class="hero-btns">
                    <a href="{{ route('shop') }}" class="btn btn-primary">Shop Ayurvedic Products</a>
                    <a href="https://wa.me/919818299669" class="btn btn-outline" target="_blank"><i class="fab fa-whatsapp"></i> Talk to Our Support Team</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="glow-effect"></div>
                <video autoplay muted loop playsinline style="width: 100%; border-radius: 30px; box-shadow: 0 30px 60px rgba(0, 66, 0, 0.2);">
                    <source src="{{ asset('auri-images/video/main.webm') }}" type="video/webm">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </section>

    <!-- 2. Ingredients Spotlight -->
    <section class="ingredients-section">
        <div class="container">
            <h3 style="color: var(--primary);">Powered by Nature</h3>
            <div class="ing-scroller">
                <div class="ing-pill">
                    <img src="{{ asset('auri-images/ingredients/aloe.png') }}" alt="Aloe">
                    <div class="ing-txt"><strong>Aloe Vera</strong><span>Hydration</span></div>
                </div>
                <div class="ing-pill">
                    <img src="{{ asset('auri-images/ingredients/turmeric.png') }}" alt="Turmeric">
                    <div class="ing-txt"><strong>Turmeric</strong><span>Anti-inflam</span></div>
                </div>
                <div class="ing-pill">
                    <img src="{{ asset('auri-images/ingredients/neem.png') }}" alt="Neem">
                    <div class="ing-txt"><strong>Neem</strong><span>Purifying</span></div>
                </div>
                <div class="ing-pill">
                    <img src="{{ asset('auri-images/ingredients/ginger.png') }}" alt="Ginger">
                    <div class="ing-txt"><strong>Ginger</strong><span>Digestion</span></div>
                </div>
                <div class="ing-pill">
                    <img src="{{ asset('auri-images/ingredients/ashwagandha.png') }}" alt="Ashwagandha">
                    <div class="ing-txt"><strong>Ashwagandha</strong><span>Stress Relief</span></div>
                </div>
            </div>
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

    <!-- 4. Best Sellers -->
    <section class="products-section" id="bestsellers">
        <div class="container">
            <div class="sec-head">
                <h2 style="color: var(--primary);">Best Selling Products</h2>
                <a href="{{ route('shop') }}" class="link-view-all">View All Products <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="product-grid">
                @forelse($featuredProducts as $product)
                <div class="product-card">
                    <div class="p-img-wrap">
                        <a href="{{ route('product.show', $product->slug) }}">
                            @php
                                $img_path = $product->primary_image;
                                if ($img_path && !str_starts_with($img_path, 'http') && !str_starts_with($img_path, '/')) {
                                    $img_path = asset($img_path);
                                }
                            @endphp
                            @if($img_path)
                                <img src="{{ $img_path }}" alt="{{ $product->name }}" onerror="this.src='https://via.placeholder.com/300?text=Auvri+Product'">
                            @else
                                <img src="https://via.placeholder.com/300?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
                            @endif
                        </a>
                        <a href="{{ route('product.show', $product->slug) }}" class="quick-view-btn">Quick View</a>
                    </div>
                    <div class="p-info">
                        <div class="p-rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->rating ?? 5))★@else☆@endif
                            @endfor
                        </div>
                        <h4 class="p-title">{{ $product->name }}</h4>
                        <div class="p-bot">
                            <span class="p-price">₹{{ number_format($product->price) }}</span>
                            <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-btn"><i class="fas fa-plus"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <p style="text-align:center; color:#888; grid-column: 1/-1;">No products available yet.</p>
                @endforelse
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
            <div class="reviews-grid">
                @forelse($testimonials as $testimonial)
                <div class="review-card white-floating-card">
                    <div class="quote-watermark"><i class="fas fa-quote-right"></i></div>
                    <div class="reviewer-top">
                        <div class="r-initials">{{ strtoupper(substr($testimonial->name, 0, 2)) }}</div>
                        <div class="r-details">
                            <span class="r-name">{{ $testimonial->name }}</span>
                            <span class="r-loc">{{ $testimonial->location ?? 'India' }}</span>
                        </div>
                    </div>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= ($testimonial->rating ?? 5))★@else☆@endif
                        @endfor
                    </div>
                    <p class="review-text">"{{ $testimonial->message }}"</p>
                </div>
                @empty
                <!-- Static fallback testimonials -->
                <div class="review-card white-floating-card">
                    <div class="quote-watermark"><i class="fas fa-quote-right"></i></div>
                    <div class="reviewer-top">
                        <div class="r-initials">AM</div>
                        <div class="r-details">
                            <span class="r-name">Arjun Mehta</span>
                            <span class="r-loc">Mumbai, India</span>
                        </div>
                    </div>
                    <div class="stars">★★★★★</div>
                    <p class="review-text">"The pain relief oil worked wonders for my joint pain. Highly authentic stuff and very effective."</p>
                </div>
                <div class="review-card white-floating-card">
                    <div class="quote-watermark"><i class="fas fa-quote-right"></i></div>
                    <div class="reviewer-top">
                        <div class="r-initials">KR</div>
                        <div class="r-details">
                            <span class="r-name">Kavita Reddy</span>
                            <span class="r-loc">Bangalore, India</span>
                        </div>
                    </div>
                    <div class="stars">★★★★★</div>
                    <p class="review-text">"Packaging was secure and delivery was fast. The hair oil smells pure and feels premium."</p>
                </div>
                <div class="review-card white-floating-card">
                    <div class="quote-watermark"><i class="fas fa-quote-right"></i></div>
                    <div class="reviewer-top">
                        <div class="r-initials">ZA</div>
                        <div class="r-details">
                            <span class="r-name">Zainab Ali</span>
                            <span class="r-loc">Delhi, India</span>
                        </div>
                    </div>
                    <div class="stars">★★★★☆</div>
                    <p class="review-text">"I appreciate the consultation service. Helped me pick the right detox plan for my lifestyle."</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
