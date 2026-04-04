@extends('layouts.auri')

@section('title', $product->name . ' - Auvri Plus')
@section('meta_description', Str::limit(strip_tags($product->description ?? ''), 160))

@section('content')
<div class="luxury-detail-wrapper animate-fade">
    <!-- 1. Product Hero Section -->
    <section class="product-hero-premium">
        <div class="container hero-grid-luxury">
            <!-- Left: Gallery -->
            <div class="gallery-luxury">
                <div class="thumb-strip-vertical">
                    @php
                        $main_img = $product->primary_image;
                        if ($main_img && !str_starts_with($main_img, 'http') && !str_starts_with($main_img, '/')) {
                            $main_img = asset($main_img);
                        }
                    @endphp
                    @if($main_img)
                        <div class="v-thumb active" onclick="swapImgLuxury(this, '{{ $main_img }}')">
                            <img src="{{ $main_img }}" alt="{{ $product->name }}">
                        </div>
                    @endif
                    @if($product->gallery_images && is_array($product->gallery_images))
                        @foreach(array_slice($product->gallery_images, 0, 3) as $img)
                            @php
                                $thumb_img = $img;
                                if ($thumb_img && !str_starts_with($thumb_img, 'http') && !str_starts_with($thumb_img, '/')) {
                                    $thumb_img = asset($thumb_img);
                                }
                            @endphp
                            <div class="v-thumb" onclick="swapImgLuxury(this, '{{ $thumb_img }}')">
                                <img src="{{ $thumb_img }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="main-img-luxury">
                    <img src="{{ $main_img ?: 'https://via.placeholder.com/500?text=' . urlencode($product->name) }}" id="main-product-img-luxury" alt="{{ $product->name }}">
                    
                    <div class="wishlist-overlay-badge-detail" style="position: absolute; top: 20px; right: 20px; z-index: 10;">
                        @php
                            $isInWishlist = Auth::check() && Auth::user()->wishlist->contains('product_id', $product->id);
                        @endphp
                        <form action="{{ route('wishlist.toggle') }}" method="POST" class="wishlist-overlay-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" style="width: 50px; height: 50px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); cursor: pointer; display: flex; align-items: center; justify-content: center; color: {{ $isInWishlist ? '#d4145a' : 'var(--primary)' }}; transition: all 0.3s ease; font-size: 1.4rem;">
                                <i class="{{ $isInWishlist ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </form>
                    </div>
                    
                    <div class="zoom-indicator"><i class="fas fa-search-plus"></i></div>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="info-luxury">
                <nav class="luxury-breadcrumbs">
                    <a href="{{ route('home') }}">Home</a> / <a href="{{ route('shop') }}">Shop</a> / <span>{{ $product->category_rel->name ?? $product->category ?? 'Products' }}</span>
                </nav>

                <h1 class="luxury-title">{{ $product->name }}</h1>

                <div class="luxury-rating">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= round($product->rating ?? 5) ? 'fas' : 'far' }} fa-star"></i>
                        @endfor
                    </div>
                    <span class="review-count">({{ $product->reviews_count ?? 0 }} Reviews)</span>
                </div>

                <div class="luxury-price-card" style="background: white; border-radius: 20px; padding: 25px 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); margin-bottom: 35px; border: 1px solid #f0f0f0;">
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <span class="label" style="text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: #999; font-weight: 700;">Investment in Wellness</span>
                        <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                            <div class="price-val" style="font-family: 'Playfair Display', serif; font-size: 3.2rem; color: #004200; font-weight: 800; line-height: 1;">₹{{ number_format($product->price) }}</div>
                            @if($product->compare_price && $product->compare_price > 0)
                                <span style="text-decoration: line-through; color: #bbb; font-size: 1.4rem; font-weight: 500;">₹{{ number_format($product->compare_price) }}</span>
                                @if($product->compare_price > $product->price)
                                    <span style="background: #e53935; color: #fff; padding: 4px 12px; border-radius: 50px; font-size: 0.8rem; font-weight: 800; box-shadow: 0 5px 15px rgba(229,57,53,0.2);">{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF</span>
                                @endif
                            @endif

                            <p style="color: #666; font-size: 0.85rem; display: flex; align-items: center; gap: 8px;">{{ $product->short_description }}</p>
                        </div>
                    </div>
                    <div class="price-badges" style="margin-top: 20px; display: flex; gap: 25px; border-top: 1px solid #f5f5f5; padding-top: 20px;">
                        <span style="color: #666; font-size: 0.85rem; display: flex; align-items: center; gap: 8px;"><i class="fas fa-leaf" style="color: #81c784;"></i> 100% Organic</span>
                        <span style="color: #666; font-size: 0.85rem; display: flex; align-items: center; gap: 8px;"><i class="fas fa-flask" style="color: #81c784;"></i> Lab Tested</span>
                    </div>
                </div>

                <div class="luxury-actions">
                    <form action="{{ route('cart.add') }}" method="POST" id="product-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                            <label style="font-weight: 700; color: var(--primary); text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Quantity:</label>
                            <div class="container-qty-stepper">
                                <button type="button" onclick="changeQty(-1)" class="stepper-btn">−</button>
                                <input type="number" name="quantity" id="qty-input" value="1" min="1" max="{{ $product->stock ?? 99 }}" readonly>
                                <button type="button" onclick="changeQty(1)" class="stepper-btn">+</button>
                            </div>
                        </div>

                        <div class="buy-now-wrapper-premium" style="display: flex; gap: 12px; margin-bottom: 25px;">
                            <button type="submit" name="action" value="add" class="btn-premium-cart-lx">
                                <i class="fas fa-shopping-bag"></i>
                                <span>ADD TO CART</span>
                            </button>
                            <button type="submit" name="action" value="buy" class="btn-premium-buy-lx">
                                <i class="fas fa-bolt"></i>
                                <span>BUY NOW</span>
                            </button>
                        </div>
                    </form>

                    <div class="contact-buttons-luxury" style="margin-top: 20px;">
                        <a href="https://wa.me/919818299669?text=I'm interested in {{ urlencode($product->name) }}" target="_blank" class="btn-lx-outline"><i class="fab fa-whatsapp"></i> WhatsApp Inquiry</a>
                        <a href="tel:+919818299669" class="btn-lx-outline"><i class="fas fa-phone-alt"></i> Consultation Call</a>
                    </div>
                </div>

                <div class="benefit-highlights-row">
                    <div class="b-mini"><i class="fas fa-check-circle"></i> Chemical Free</div>
                    <div class="b-mini"><i class="fas fa-check-circle"></i> Artisan Crafted</div>
                    <div class="b-mini"><i class="fas fa-check-circle"></i> Ancient Recipe</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Ayurvedic Benefits Section -->
    <section class="benefits-luxury-sec">
        <div class="container">
            <h2 class="lx-sec-title">Healing Benefits</h2>
            <div class="benefits-glass-grid">
                <div class="glass-card">
                    <div class="glass-icon"><i class="fas fa-heartbeat"></i></div>
                    <h3>Vitality Boost</h3>
                    <p>Restores your natural energy balance and strengthens the immune system through potent botanical extracts.</p>
                </div>
                <div class="glass-card">
                    <div class="glass-icon"><i class="fas fa-spa"></i></div>
                    <h3>Deep Calm</h3>
                    <p>Infused with meditative herbs that soothe the nervous system and promote restorative mental peace.</p>
                </div>
                <div class="glass-card">
                    <div class="glass-icon"><i class="fas fa-feather-alt"></i></div>
                    <h3>Pure Detox</h3>
                    <p>Gently flushes out environmental toxins, leaving your body feeling light, clean, and rejuvenated.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Tabs Section -->
    <section class="tabs-luxury-sec">
        <div class="container">
            <div class="lx-tabs-header">
                <button class="lx-tab-btn active" onclick="switchLxTab(this, 'lx-desc')">Description</button>
                <button class="lx-tab-btn" onclick="switchLxTab(this, 'lx-usage')">Usage Instructions</button>
                <button class="lx-tab-btn" onclick="switchLxTab(this, 'lx-reviews')">Reviews ({{ $product->reviews->count() ?? 0 }})</button>
            </div>
            <div class="lx-tabs-content">
                <div id="lx-desc" class="lx-content-pane active">
                    <p>{{ $product->description ?? 'Authentic Ayurvedic product crafted with ancient wisdom.' }}</p>
                </div>
                <div id="lx-usage" class="lx-content-pane">
                    <p>{{ $product->short_description ?? 'Authentic Ayurvedic product crafted with ancient wisdom.' }}</p>
                </div>
                <div id="lx-reviews" class="lx-content-pane">
                    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 40px; align-items: start;">
                        <!-- Review List -->
                        <div>
                            <h4 style="font-family: 'Playfair Display', serif; font-size: 1.5rem; margin-bottom: 25px; color: #004200;">Community Experiences</h4>
                            @if($product->reviews && $product->reviews->count())
                                <div style="display: grid; gap: 20px;">
                                    @foreach($product->reviews as $review)
                                    <div style="padding: 25px; border-radius: 20px; border: 1px solid #f0f0f0; background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div style="width: 40px; height: 40px; border-radius: 50%; background: #e8f5e9; color: #2e7d32; display: flex; align-items: center; justify-content: center; font-weight: 700;">{{ substr($review->name, 0, 1) }}</div>
                                                <div>
                                                    <div style="font-weight: 700; color: #333;">{{ $review->name }}</div>
                                                    <div style="font-size: 0.75rem; color: #999;">{{ $review->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                            <div style="color: #ffd700; font-size: 0.85rem;">
                                                @for($i=1; $i<=5; $i++)
                                                    <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p style="color: #555; line-height: 1.6; margin: 0; font-size: 0.95rem;">{{ $review->comment }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div style="padding: 60px 20px; text-align: center; background: #fdfdfd; border-radius: 20px; border: 1px dashed #ddd;">
                                    <i class="far fa-comment-dots" style="font-size: 3rem; color: #ccc; margin-bottom: 20px;"></i>
                                    <p style="color: #888; font-size: 1rem;">Be the first to share your journey with this remedy.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Review Form -->
                        <div style="position: sticky; top: 100px; background: #f9fbf9; padding: 30px; border-radius: 25px; border: 1px solid rgba(0,66,0,0.08);">
                            @auth
                                <h5 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; margin-bottom: 20px; color: #004200;">Share Your Thoughts</h5>
                                <form action="{{ route('product.review.store', $product->slug) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                    
                                    <div style="margin-bottom: 20px;">
                                        <label style="display: block; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; color: #666; margin-bottom: 10px;">Your Rating</label>
                                        <div class="star-rating" style="display: flex; gap: 8px; font-size: 1.5rem; color: #ddd; cursor: pointer;">
                                            <i class="far fa-star star-btn" data-value="1"></i>
                                            <i class="far fa-star star-btn" data-value="2"></i>
                                            <i class="far fa-star star-btn" data-value="3"></i>
                                            <i class="far fa-star star-btn" data-value="4"></i>
                                            <i class="far fa-star star-btn" data-value="5"></i>
                                            <input type="hidden" name="rating" id="review_rating" value="5" required>
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <label style="display: block; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; color: #666; margin-bottom: 10px;">Experience Details</label>
                                        <textarea name="comment" rows="4" style="width: 100%; border-radius: 15px; border: 1px solid #ddd; padding: 15px; font-family: inherit; font-size: 0.9rem; resize: none; background: #fff;" placeholder="How did this product help you?" required></textarea>
                                    </div>

                                    <button type="submit" style="width: 100%; border: none; padding: 15px; border-radius: 50px; font-weight: 700; letter-spacing: 1px; background: #004200; color: #fff; cursor: pointer; transition: transform 0.2s ease;">SUBMIT REVIEW</button>
                                </form>
                            @else
                                <div style="text-align: center;">
                                    <div style="width: 60px; height: 60px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
                                        <i class="fas fa-lock" style="color: #004200;"></i>
                                    </div>
                                    <h5 style="font-family: 'Playfair Display', serif; font-size: 1.2rem; margin-bottom: 10px;">Want to review this?</h5>
                                    <p style="font-size: 0.85rem; color: #666; margin-bottom: 25px;">Please login to your account to share your experience with others.</p>
                                    <a href="{{ route('login') }}" style="display: block; text-decoration: none; padding: 15px; border-radius: 50px; font-weight: 700; letter-spacing: 1px; background: #004200; color: #fff;">LOGIN TO REVIEW</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Trust Indicators -->
    <section class="trust-lx-sec">
        <div class="container lx-trust-flex">
            <div class="lx-trust-item"><i class="fas fa-medal"></i> <span>GMP Certified</span></div>
            <div class="lx-trust-item"><i class="fas fa-leaf"></i> <span>100% Natural</span></div>
            <div class="lx-trust-item"><i class="fas fa-microscope"></i> <span>Lab Tested</span></div>
            <div class="lx-trust-item"><i class="fas fa-award"></i> <span>Safe &amp; Authentic</span></div>
        </div>
    </section>

    <!-- 5. Related Remedies -->
    @if(isset($relatedProducts) && $relatedProducts->count())
    <section class="related-lx-sec">
        <div class="container">
            <div class="lx-sec-header-flex">
                <h2 class="lx-sec-title">Related Remedies</h2>
                <a href="{{ route('shop') }}" class="lx-link">Explore Collection <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
            <div class="product-grid">
                @foreach($relatedProducts as $related)
                <div class="product-card">
                    <div class="p-img-wrap">
                        <a href="{{ route('product.show', $related->slug) }}">
                            @php
                                $rel_img = $related->primary_image;
                                if ($rel_img && !str_starts_with($rel_img, 'http') && !str_starts_with($rel_img, '/')) {
                                    $rel_img = asset($rel_img);
                                }
                            @endphp
                            @if($rel_img)
                                <img src="{{ $rel_img }}" alt="{{ $related->name }}" onerror="this.src='https://via.placeholder.com/300'">
                            @else
                                <img src="https://via.placeholder.com/300?text={{ urlencode($related->name) }}" alt="{{ $related->name }}">
                            @endif
                        </a>
                        <!-- Wishlist Overlay -->
                        @php
                            $isRelInWishlist = Auth::check() && Auth::user()->wishlist->contains('product_id', $related->id);
                        @endphp
                        <form action="{{ route('wishlist.toggle') }}" method="POST" class="wishlist-overlay-form" style="position: absolute; top: 15px; right: 15px; z-index: 5;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $related->id }}">
                            <button type="submit" style="width: 35px; height: 35px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); cursor: pointer; display: flex; align-items: center; justify-content: center; color: {{ $isRelInWishlist ? '#d4145a' : 'var(--primary)' }}; transition: all 0.3s ease; font-size: 0.9rem;">
                                <i class="{{ $isRelInWishlist ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </form>
                    </div>
                    <div class="p-info">
                        <h4 class="p-title">{{ $related->name }}</h4>
                        <div class="p-bot">
                            <span class="p-price">₹{{ number_format($related->price) }}</span>
                            <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $related->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-btn"><i class="fas fa-plus"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection

@section('extra_js')
<script>
    function swapImgLuxury(el, src) {
        const main = document.getElementById('main-product-img-luxury');
        if (main) {
            main.style.opacity = '0';
            setTimeout(() => { main.src = src; main.style.opacity = '1'; }, 300);
        }
        document.querySelectorAll('.v-thumb').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }

    function switchLxTab(btn, targetId) {
        document.querySelectorAll('.lx-tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.lx-content-pane').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById(targetId).classList.add('active');
    }

    function changeQty(delta) {
        const input = document.getElementById('qty-input');
        const max = parseInt(input.getAttribute('max')) || 99;
        let newVal = parseInt(input.value || 1) + delta;
        newVal = Math.max(1, Math.min(max, newVal));
        input.value = newVal;
    }

    $(document).ready(function() {
        // Star Rating Interaction
        $('.star-btn').on('mouseover', function() {
            let val = $(this).data('value');
            $('.star-btn').each(function() {
                if ($(this).data('value') <= val) {
                    $(this).removeClass('far').addClass('fas').css('color', '#ffd700');
                } else {
                    $(this).removeClass('fas').addClass('far').css('color', '#ddd');
                }
            });
        }).on('mouseout', function() {
            let currentVal = $('#review_rating').val();
            $('.star-btn').each(function() {
                if ($(this).data('value') <= currentVal) {
                    $(this).removeClass('far').addClass('fas').css('color', '#ffd700');
                } else {
                    $(this).removeClass('fas').addClass('far').css('color', '#ddd');
                }
            });
        }).on('click', function() {
            let val = $(this).data('value');
            $('#review_rating').val(val);
        });

        // Initialize stars on load
        let initialVal = $('#review_rating').val();
        $('.star-btn').each(function() {
            if ($(this).data('value') <= initialVal) {
                $(this).removeClass('far').addClass('fas').css('color', '#ffd700');
            }
        });
    });
</script>
@endsection
