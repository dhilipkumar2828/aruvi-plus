@extends('layouts.auri')

@section('title', $product->meta_title ?? ($product->name . ' | Auvri Plus'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
@endsection

@section('content')
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
    $mainImage = $images[0] ?? null;
@endphp

<!-- Product Detail Hero -->
<section class="product-detail-section">
    <div class="container-premium">
        <div class="product-hero-grid" style="display: flex; gap: 30px; align-items: flex-start;">
            <!-- Left: Gallery -->
            <div class="product-gallery" style="flex: 1.2;">
                <div class="main-image-container">
                    @if ($mainImage)
                        <img src="{{ asset($mainImage) }}" alt="{{ $product->name }}" id="mainImg">
                    @else
                        <div style="height: 400px; display: flex; align-items: center; justify-content: center; color: #999; background: #f8f9fa; border-radius: 20px; width: 100%;">No Image</div>
                    @endif
                </div>
                <div class="thumbnail-grid">
                    @foreach ($images as $imageIndex => $image)
                        <div class="thumb-item {{ $imageIndex === 0 ? 'active' : '' }}" onclick="changeImage('{{ asset($image) }}', this)">
                            <img src="{{ asset($image) }}" alt="{{ $product->name }} thumbnail">
                        </div>
                    @endforeach
                </div>
                <div class="gallery-dots">
                    <span class="g-dot active"></span>
                    <span class="g-dot"></span>
                    <span class="g-dot"></span>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="product-info-panel" style="flex: 1;">

                <h1 class="product-title-premium">{{ $product->name }}</h1>
                
                <div class="product-rating-summary" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                    <div class="stars" style="color: #ff9100; font-size: 14px;">
                        @for($i=1; $i<=5; $i++)
                            <i class="{{ $i <= round($product->rating) ? 'fas' : 'far' }} fa-star"></i>
                        @endfor
                    </div>
                    <span style="font-size: 14px; color: #888;">({{ $product->reviews_count ?? 0 }} Customer Reviews)</span>
                </div>
                
                @php
                    $discountPercent = 0;
                    if ($product->compare_price > 0 && $product->compare_price > $product->price) {
                        $discountPercent = round((($product->compare_price - $product->price) / $product->compare_price) * 100);
                    }
                @endphp
                <div class="price-box-premium" style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; flex-wrap: nowrap;">
                    {{-- @if($discountPercent > 0)
                        <span class="discount-badge" style="color: #008a00; font-size: 32px; font-weight: 700; display: flex; align-items: center; white-space: nowrap;">
                            <i class="fas fa-arrow-down" style="font-size: 24px; margin-right: 4px;"></i>{{ $discountPercent }}%
                        </span>
                        <span class="strikethrough-price" style="text-decoration: line-through; color: #757575; font-size: 28px; font-weight: 500; white-space: nowrap;">
                            {{ number_format($product->compare_price, 0) }}
                        </span>
                    @endif --}}
                    <span class="main-price" style="font-size: 36px; font-weight: 800; color: #111; white-space: nowrap;">{{ format_inr($product->price) }}</span><br>

                    {{-- <span class="tax-info" style="font-size: 13px; color: #888; align-self: center; margin-left: 5px; white-space: nowrap;">(Incl of all taxes)</span> --}}
                </div>

                @if($product->short_description)
                <div class="short-description-badge-wrapper" style="margin-bottom: 20px;">
                    <span class="badge" style="background: var(--primary-light); color: var(--primary-color); padding: 5px 15px; border-radius: 5px; font-weight: 700; font-size: 13px; display: inline-block; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid var(--primary-color);">
                        {{ $product->short_description }}
                    </span>
                </div>
                @endif

               

                <div class="short-description-premium">
                    {{ $product->description ?? 'A rare Aurvi Plus statue crafted using nine purified minerals. Each piece is consecrated with traditional rituals, intended for spiritual protection, healing presence, and temple grade reverence.' }}
                </div>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="action-area">
                        <div class="qty-selector">
                            <button class="qty-btn minus" type="button">-</button>
                            <input  name="quantity" value="1" min="1" class="qty-input">
                            <button class="qty-btn plus" type="button">+</button>
                        </div>
                        <button type="submit" class="btn-add-to-cart">Add to Cart</button>
                        @auth
                            @php
                                $inWishlist = \App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
                            @endphp
                            <button type="button" class="wishlist-circle-btn" onclick="toggleWishlist({{ $product->id }}, this)" style="border: none; background: #fff; border: 1px solid #ddd; cursor: pointer;">
                                <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart" style="{{ $inWishlist ? 'color: var(--primary-color);' : '' }}"></i>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="wishlist-circle-btn" style="display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #ddd;">
                                <i class="far fa-heart"></i>
                            </a>
                        @endauth
                    </div>
                </form>

                <div class="feature-highlights">
                    <div class="f-item">
                        <div class="f-icon"><i class="fas fa-hand-sparkles"></i></div>
                        <span class="f-label">Handcrafted</span>
                    </div>
                    <div class="f-item">
                        <div class="f-icon"><i class="fas fa-gem"></i></div>
                        <span class="f-label">9 Pashanam Purity</span>
                    </div>
                    <div class="f-item">
                        <div class="f-icon"><i class="fas fa-gopuram"></i></div>
                        <span class="f-label">Temple Grade</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Description & Reviews Tabs -->
<section class="product-tabs-section">
    <div class="container-premium">
        <div class="tabs-header">
            @if($product->description)
            <div class="tab-trigger active" data-tab="description" style="font-size: 18px; font-weight: 600; color: #111; cursor: pointer; padding-bottom: 10px; position: relative;">
                Description
            </div>
            @endif
            <div class="tab-trigger {{ !$product->description ? 'active' : '' }}" data-tab="reviews" style="font-size: 18px; font-weight: 600; color: {{ !$product->description ? '#111' : '#666' }}; cursor: pointer; padding-bottom: 10px; position: relative;">
                Reviews ({{ $product->reviews_count ?? 0 }})
            </div>
        </div>

        <style>
            .tab-trigger.active { color: #ff6d00 !important; }
            .tab-trigger.active::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 3px;
                background: #ff6d00;
                border-radius: 10px;
            }
            .tab-content { display: none; }
            .tab-content.active { display: block; }
            
            .review-form-group { margin-bottom: 25px; }
            .review-label { display: block; font-size: 14px; font-weight: 600; color: #444; margin-bottom: 10px; }
            .review-input { width: 100%; padding: 15px 20px; border: 1px solid #eee; border-radius: 50px; background: #fff; font-family: inherit; transition: all 0.3s ease; }
            .review-input:focus { outline: none; border-color: #ff6d00; box-shadow: 0 5px 15px rgba(255,109,0,0.05); }
            .review-textarea { border-radius: 20px; resize: vertical; min-height: 150px; }
            
            .star-rating-input { display: flex; gap: 10px; flex-direction: row-reverse; justify-content: flex-end; }
            .star-rating-input input { display: none; }
            .star-rating-input label { font-size: 24px; color: #ddd; cursor: pointer; transition: color 0.2s ease; }
            .star-rating-input label:hover,
            .star-rating-input label:hover ~ label,
            .star-rating-input input:checked ~ label { color: #ff9100; }
        </style>

        @if($product->description)
        <div id="description-tab" class="tab-content active">
            <h2 style="font-size: 24px; font-weight: 800; color: #111; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px;">Product Description</h2>
            <div style="font-size: 18px; color: #555; line-height: 1.8;">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
        @endif

        <div id="reviews-tab" class="tab-content {{ !$product->description ? 'active' : '' }}">
            <div class="reviews-grid">
                <!-- Review List -->
                <div class="review-list">
                    @if($product->reviews->isEmpty())
                        <p style="font-size: 16px; color: #888;">There are no reviews yet.</p>
                    @else
                        @foreach($product->reviews as $review)
                            <div class="review-item" style="border-bottom: 1px solid #f5f5f5; padding-bottom: 30px; margin-bottom: 30px;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                                    <div>
                                        <h4 style="margin: 0 0 5px; font-size: 16px; color: #111;">{{ $review->name }}</h4>
                                        <div class="stars" style="color: #ff9100; font-size: 12px;">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <span style="font-size: 12px; color: #888;">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                                <p style="font-size: 14px; color: #555; line-height: 1.6; margin: 0;">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Review Form -->
                <div class="review-form-container">
                    @auth
                        <h3 style="font-size: 20px; font-weight: 700; color: #111; margin: 0 0 10px;">Review &ldquo;{{ $product->name }}&rdquo;</h3>
                        <p style="font-size: 14px; color: #888; margin-bottom: 30px;">Share your experience with this sacred product.</p>
                        
                        <form action="{{ route('product.review.store', $product) }}" method="POST">
                            @csrf
                            <div class="review-form-group">
                                <label class="review-label">Name *</label>
                                <input type="text" name="name" class="review-input" value="{{ old('name', Auth::user()->name) }}" required>
                            </div>
                            <div class="review-form-group">
                                <label class="review-label">Email *</label>
                                <input type="email" name="email" class="review-input" value="{{ old('email', Auth::user()->email) }}" required>
                            </div>
                            <div class="review-form-group">
                                <label class="review-label">Your rating *</label>
                                <div class="star-rating-input">
                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                                </div>
                            </div>
                            <div class="review-form-group">
                                <label class="review-label">Your Review *</label>
                                <textarea name="comment" class="review-input review-textarea" required>{{ old('comment') }}</textarea>
                            </div>
                            <button type="submit" class="btn-add-to-cart" style="width: 100%; border: none; cursor: pointer; background: linear-gradient(135deg, #FF6D00 0%, #FF9100 100%);">
                                Submit Review
                            </button>
                        </form>
                    @else
                        <div style="background: #fffaf5; border: 1px dashed #ff9100; padding: 40px; border-radius: 20px; text-align: center;">
                            <i class="fas fa-lock" style="font-size: 40px; color: #ff9100; margin-bottom: 20px; display: block;"></i>
                            <h3 style="font-size: 20px; font-weight: 700; color: #111; margin-bottom: 15px;">Want to review this product?</h3>
                            <p style="color: #666; margin-bottom: 25px;">You must be logged in to share your experience with the community.</p>
                            <a href="{{ route('login') }}" class="btn-add-to-cart" style="display: inline-block; text-decoration: none; border: none; background: linear-gradient(135deg, #FF6D00 0%, #FF9100 100%); padding: 12px 40px;">
                                Login to Review
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const triggers = document.querySelectorAll('.tab-trigger');
        const contents = document.querySelectorAll('.tab-content');

        triggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
                const tab = this.getAttribute('data-tab');

                triggers.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                this.classList.add('active');
                document.getElementById(tab + '-tab').classList.add('active');
            });
        });
    });
</script>

@endsection

@section('scripts')
<script>
    function toggleWishlist(productId, btn) {
        fetch('{{ route("wishlist.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const icon = btn.querySelector('i');
                if (data.action === 'added') {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    icon.style.color = 'var(--primary-color)';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    icon.style.color = '';
                }

                // Update Badge Count
                const badge = document.getElementById('wishlist-count-badge');
                if (badge) {
                    let count = parseInt(badge.innerText);
                    count = data.action === 'added' ? count + 1 : Math.max(0, count - 1);
                    badge.innerText = count;
                    if (count === 0) badge.style.display = 'none';
                    else badge.style.display = 'flex';
                } else if (data.action === 'added') {
                    // Create badge if it doesn't exist
                    const link = document.querySelector('a[href="{{ route("wishlist.index") }}"]');
                    if (link) {
                        const newBadge = document.createElement('span');
                        newBadge.id = 'wishlist-count-badge';
                        newBadge.className = 'wishlist-count';
                        newBadge.innerText = '1';
                        link.appendChild(newBadge);
                    }
                }
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function changeImage(src, el) {
        const mainImg = document.getElementById('mainImg');
        if (mainImg) mainImg.src = src;
        document.querySelectorAll('.thumb-item').forEach(thumb => {
            thumb.classList.remove('active');
        });
        el.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.qty-selector').forEach((selector) => {
            const input = selector.querySelector('.qty-input');
            const plusBtn = selector.querySelector('.qty-btn.plus');
            const minusBtn = selector.querySelector('.qty-btn.minus');

            if (!input) return;

            const normalizeQty = (value) => {
                const parsed = parseInt(value, 10);
                return Number.isFinite(parsed) && parsed > 0 ? parsed : 1;
            };

            const setQty = (value) => {
                input.value = Math.max(1, value);
            };

            if (plusBtn) {
                plusBtn.addEventListener('click', () => {
                    setQty(normalizeQty(input.value) + 1);
                });
            }

            if (minusBtn) {
                minusBtn.addEventListener('click', () => {
                    setQty(normalizeQty(input.value) - 1);
                });
            }

            input.addEventListener('change', () => {
                setQty(normalizeQty(input.value));
            });
        });
    });
</script>
@endsection
