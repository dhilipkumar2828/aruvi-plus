@extends('layouts.auri')

@section('title', 'Auvri Plus - Authentic Ayurvedic Remedies')
@section('meta_description', 'From herbal powders to nourishing oils and capsules, our Ayurvedic remedies support balance, vitality, and daily well-being.')

@section('content')
    <!-- 1. Hero -->
    <section class="hero-section" style="background-image: linear-gradient(rgba(0, 66, 0, 0.5), rgba(0, 66, 0, 0.5)), url('{{ asset('auri-images/background-main.png') }}'); background-size: cover; background-position: center; padding: 120px 0 140px; position: relative;">
        <div class="container hero-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; position: relative; z-index: 2;">
            <div class="hero-content">
                <h1 >Nature's Wisdom for Modern Wellness</h1>
                <p style="font-size: 1.1rem; color: #f0f0f0; margin-bottom: 32px; max-width: 480px;">From herbal powders to nourishing oils and capsules, our Ayurvedic remedies are carefully prepared to support balance, vitality, and daily well-being.</p>
                <div class="hero-btns" style="display: flex; gap: 20px;">
                    <a href="{{ route('shop') }}" class="btn btn-primary" style="background: #004200; color: #fff; padding: 14px 28px; border-radius: 50px; text-decoration: none; font-weight: 600;">Shop Ayurvedic Products</a>
                    <a href="https://wa.me/919818299669" class="btn btn-outline" target="_blank" style="border: 2px solid rgba(255,255,255,0.7); color: #fff; padding: 14px 28px; border-radius: 50px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                        <i class="fab fa-whatsapp"></i> Talk to Our Support Team
                    </a>
                </div>
            </div>
            <div class="hero-image" style="position: relative;">
                <div class="glow-effect" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 300px; height: 300px; background: rgba(255, 255, 255, 0.1); filter: blur(50px); border-radius: 50%; z-index: -1;"></div>
                <video autoplay muted loop playsinline style="width: 100%; border-radius: 30px; box-shadow: 0 30px 60px rgba(0, 66, 0, 0.2);">
                    <source src="{{ asset('auri-images/video/main.webm') }}" type="video/webm">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </section>

    <style>
        @keyframes float {
            0% { transform: scale(1.4) translateY(20px); }
            50% { transform: scale(1.4) translateY(-10px); }
            100% { transform: scale(1.4) translateY(20px); }
        }
    </style>

    <section class="ingredients-section shadow-text-sec">
        <div class="container" style="position: relative;">
            <h2 style="color: var(--primary); text-align: center; margin-bottom: 40px;">Powered by Nature</h2>
            
            <div class="category-wrapper" style="position: relative; padding: 0 30px;">
                <button class="testi-nav testi-prev" onclick="this.parentElement.querySelector('.ing-scroller').scrollBy({left: -300, behavior: 'smooth'})" style="position: absolute; left: -20px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="ing-scroller" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @forelse($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}" class="ing-pill" style="text-decoration: none; color: inherit;">
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" onerror="this.src='https://via.placeholder.com/100?text={{ urlencode($category->name[0]) }}'">
                        @else
                            <img src="https://via.placeholder.com/100?text={{ urlencode($category->name[0]) }}" alt="{{ $category->name }}">
                        @endif
                        <div class="ing-txt"><strong>{{ $category->name }}</strong><span>Collection</span></div>
                    </a>
                    @empty
                    <p style="text-align:center; color:#888;">No categories available yet.</p>
                    @endforelse
                </div>

                <button class="testi-nav testi-next" onclick="this.parentElement.querySelector('.ing-scroller').scrollBy({left: 300, behavior: 'smooth'})" style="position: absolute; right: -20px; top: 50%; transform: translateY(-50%); width: 45px; height: 45px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.08); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
            <style>
                .ing-scroller {
                    display: flex !important;
                    flex-wrap: nowrap !important;
                    overflow-x: auto !important;
                    gap: 15px !important;
                    padding: 10px 0 !important;
                    scroll-behavior: smooth;
                    -webkit-overflow-scrolling: touch;
                }
                .ing-pill {
                    flex: 0 0 calc(25% - 20px) !important;
                    min-width: 260px !important;
                }
                .ing-scroller::-webkit-scrollbar {
                    display: none !important;
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
                        <!-- Wishlist Overlay -->
                        @php
                            $isInWishlist = Auth::check() && Auth::user()->wishlist->contains('product_id', $product->id);
                        @endphp
                        <form action="{{ route('wishlist.toggle') }}" method="POST" class="wishlist-overlay-form" style="position: absolute; top: 15px; right: 15px; z-index: 5;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" style="width: 40px; height: 40px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); cursor: pointer; display: flex; align-items: center; justify-content: center; color: {{ $isInWishlist ? '#d4145a' : 'var(--primary)' }}; transition: all 0.3s ease;">
                                <i class="{{ $isInWishlist ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </form>
                        <a href="{{ route('product.show', $product->slug) }}" class="quick-view-btn">Quick View</a>
                    </div>
                    <div class="p-info">
                        <div class="p-rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->rating ?? 5))★@else☆@endif
                            @endfor
                        </div>
                        <h4 class="p-title">{{ $product->name }}</h4>
                        <div class="p-bot" style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <span class="p-price" style="font-weight: 800; color: #004200; font-size: 1.15rem; font-family: 'Playfair Display', serif;">₹{{ number_format($product->price) }}</span>
                                @if($product->compare_price && $product->compare_price > 0)
                                    <span style="text-decoration: line-through; color: #999; font-size: 0.85rem; font-weight: 500;">₹{{ number_format($product->compare_price) }}</span>
                                @endif
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-btn" title="Add to Cart" style="background: #e8f5e9; color: #004200; width: 35px; height: 35px; border-radius: 50%; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease;"><i class="fas fa-shopping-cart"></i></button>
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
            <div class="testimonial-wrapper" style="position: relative; padding: 0 40px;">
                <button class="testi-nav testi-prev" onclick="this.parentElement.querySelector('.reviews-grid').scrollBy({left: -400, behavior: 'smooth'})" style="position: absolute; left: -20px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.2rem; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="reviews-grid">
                    @forelse($testimonials as $testimonial)
                    <div class="review-card white-floating-card">
                        <div class="reviewer-top">
                            <div class="r-initials" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                @if($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="r-details">
                                <span class="r-name">{{ $testimonial->name }}</span>
                                <span class="r-loc">{{ $testimonial->designation ?? $testimonial->location ?? 'Customer' }}</span>
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

                <button class="testi-nav testi-next" onclick="this.parentElement.querySelector('.reviews-grid').scrollBy({left: 400, behavior: 'smooth'})" style="position: absolute; right: -20px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #004200; font-size: 1.2rem; transition: all 0.3s ease;">
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
            padding: 20px 5px 40px !important;
            scroll-snap-type: x mandatory !important;
            -webkit-overflow-scrolling: touch !important;
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
        }
        .reviews-grid::-webkit-scrollbar {
            display: none !important;
        }
        .testi-nav:hover {
            background: #004200 !important;
            color: #fff !important;
            transform: translateY(-50%) scale(1.1) !important;
        }
        .white-floating-card {
            flex: 0 0 calc(33.333% - 20px) !important;
            scroll-snap-align: start !important;
            min-width: 300px !important;
        }
        @media (max-width: 1100px) {
            .white-floating-card {
                flex: 0 0 calc(50% - 15px) !important;
            }
        }
        @media (max-width: 768px) {
            .white-floating-card {
                flex: 0 0 85% !important;
            }
            .testimonial-wrapper {
                padding: 0 10px !important;
            }
            .testi-nav {
                display: none !important;
            }
        }
    </style>
@endsection
