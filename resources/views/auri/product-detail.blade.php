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

                <div class="luxury-price-card">
                    <div class="price-top">
                        <span class="label">Investment in Wellness</span>
                        <div class="price-val">₹{{ number_format($product->price) }}</div>
                    </div>
                    @if($product->compare_price && $product->compare_price > $product->price)
                    <div style="margin-top: 8px;">
                        <span style="text-decoration: line-through; color: #aaa; font-size: 1rem;">₹{{ number_format($product->compare_price) }}</span>
                        <span style="color: #e53935; font-weight: 600; margin-left: 10px;">{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF</span>
                    </div>
                    @endif
                    <div class="price-badges">
                        <span><i class="fas fa-leaf"></i> 100% Organic</span>
                        <span><i class="fas fa-flask"></i> Lab Tested</span>
                    </div>
                </div>

                <div class="luxury-actions">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                            <label style="font-weight: 600; color: #555;">Qty:</label>
                            <div style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 50px; overflow: hidden;">
                                <button type="button" onclick="changeQty(-1)" style="padding: 10px 18px; border: none; background: #f5f5f5; cursor: pointer; font-size: 1.1rem;">−</button>
                                <input type="number" name="quantity" id="qty-input" value="1" min="1" max="{{ $product->stock ?? 99 }}" style="width: 50px; text-align: center; border: none; font-weight: 600; font-size: 1rem;">
                                <button type="button" onclick="changeQty(1)" style="padding: 10px 18px; border: none; background: #f5f5f5; cursor: pointer; font-size: 1.1rem;">+</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-premium-cart">
                            <span>ADD TO CART</span>
                            <i class="fas fa-shopping-bag"></i>
                        </button>
                    </form>

                    <div class="contact-buttons-luxury" style="margin-top: 15px;">
                        <a href="https://wa.me/919818299669" class="btn-lx-outline"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                        <a href="tel:+919818299669" class="btn-lx-outline"><i class="fas fa-phone-alt"></i> Consultation</a>
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
                @if($product->reviews && $product->reviews->count())
                <button class="lx-tab-btn" onclick="switchLxTab(this, 'lx-reviews')">Reviews ({{ $product->reviews->count() }})</button>
                @endif
            </div>
            <div class="lx-tabs-content">
                <div id="lx-desc" class="lx-content-pane active">
                    <p>{{ $product->description ?? 'Authentic Ayurvedic product crafted with ancient wisdom.' }}</p>
                </div>
                <div id="lx-usage" class="lx-content-pane">
                    <p>Apply a small amount to the focal points or as directed by an Ayurvedic practitioner. Best used during early morning or before sleep for maximum absorption.</p>
                </div>
                @if($product->reviews && $product->reviews->count())
                <div id="lx-reviews" class="lx-content-pane">
                    <div style="display: grid; gap: 20px;">
                        @foreach($product->reviews as $review)
                        <div style="padding: 20px; border-radius: 15px; border: 1px solid rgba(0,100,0,0.1); background: #f9fbf9;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <strong>{{ $review->name }}</strong>
                                <span style="color: gold;">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                            </div>
                            <p style="color: #555; margin: 0;">{{ $review->comment }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
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
        const newVal = Math.max(1, parseInt(input.value || 1) + delta);
        input.value = newVal;
    }
</script>
@endsection
