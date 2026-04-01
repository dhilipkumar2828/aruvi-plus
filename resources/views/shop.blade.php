@extends('layouts.auri')

@section('title', 'Shop Collections | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('content')
<!-- Page Title / Hero -->
<section class="hero-small" style="background-image: url('{{ asset('images/hero_bg.jpg') }}');">
    <div class="hero-overlay"></div>
    <div class="container">
        <h1>{{ isset($category) ? $category->name . ' Collections' : 'Shop Collections' }}</h1>
        <p>{{ isset($category) ? 'Explore our exclusive ' . strtolower($category->name) . ' range' : 'Discover the Divine Energy of Navapashanam' }}</p>
    </div>
</section>

<!-- Shop Content -->
<section style="padding: 20px 0; background-color: #f9f9f9;">
    <div class="container shop-layout-container">
        <!-- Filter / Sort Bar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; border-bottom: 1px solid #ddd; padding-bottom: 20px;">
            <p style="margin: 0; color: #666;">Showing all {{ $products->count() }} results</p>
            <form method="GET" action="{{ route('shop') }}">
                <div class="shop-sort-container">
                    <select class="shop-sort-select" id="sortSelect" name="sort" onchange="this.form.submit()">
                        <option value="default" {{ $selectedSort === 'default' ? 'selected' : '' }}>Default Sorting</option>
                        <option value="low-high" {{ $selectedSort === 'low-high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="high-low" {{ $selectedSort === 'high-low' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="newest" {{ $selectedSort === 'newest' ? 'selected' : '' }}>Newest First</option>
                    </select>
                    <i class="fas fa-chevron-down shop-sort-icon"></i>
                </div>
            </form>
        </div>

        <div class="shop-layout" style="display: flex; gap: 40px; align-items: flex-start;">
            <!-- Category Sidebar -->
            <aside class="shop-sidebar" style="width: 280px; flex-shrink: 0;">
                <div class="category-wrapper">
                    <input type="checkbox" id="category-toggle" class="category-dropdown-input">
                    <label for="category-toggle" class="category-dropdown-label">
                        <span>Product Categories</span>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </label>
                    
                    <div class="category-content-mobile">
                        <h3 class="sidebar-desktop-title" style="font-size: 22px; font-weight: 700; color: #232323; margin-bottom: 12px; font-family: 'Poppins', sans-serif;">Product Categories</h3>
                        <div class="sidebar-title-line" style="width: 100px; height: 1px; background: #ff6a00; margin-bottom: 25px;"></div>
                        
                        <div class="sidebar-categories" style="display: flex; flex-direction: column;">
                            @forelse ($categories as $cat)
                                <a href="{{ route('category.show', $cat->slug) }}" class="sidebar-category-pill {{ (isset($category) && $category->id == $cat->id) ? 'active' : '' }}">
                                    <div class="pill-icon"><i class="fas fa-tag"></i></div>
                                    <span class="pill-text">{{ $cat->name }}</span>
                                </a>
                            @empty
                                <div style="color: #888; font-size: 14px; padding: 10px 0;">No categories found</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Shop Content -->
            <div style="flex: 1;">
                <!-- Product Grid -->
                <div class="shop-product-grid">
                    @forelse ($products as $product)
                        @php
                            $gallery = $product->gallery_images ?? [];
                            $images = count($gallery) ? $gallery : ($product->primary_image ? [$product->primary_image] : []);
                        @endphp
                        <div class="premium-product-card">
                            @if ($product->badge_text)
                                <div class="premium-badge">{{ $product->badge_text }}</div>
                            @endif
                            @auth
                                @php
                                    $inWishlist = \App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
                                @endphp
                                <div class="wishlist-btn" onclick="toggleWishlist({{ $product->id }}, this)" style="cursor: pointer;">
                                    <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart" style="{{ $inWishlist ? 'color: var(--primary-color);' : '' }}"></i>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="wishlist-btn" style="cursor: pointer;">
                                    <i class="far fa-heart"></i>
                                </a>
                            @endauth
                            <div class="premium-img-box">
                                <div class="slider-container">
                                    @foreach ($images as $imageIndex => $image)
                                        <div class="slide {{ $imageIndex === 0 ? 'active' : '' }}"><img src="{{ asset($image) }}" alt="{{ $product->name }}"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="premium-card-content">
                                <!-- Category Pill Card (Embedded) -->
                                <div style="margin-bottom: 12px;">
                                    @if($product->category_rel)
                                        <a href="{{ route('category.show', $product->category_rel->slug) }}" class="category-pill-card-small" style="display: inline-flex; align-items: center; gap: 8px; background: #fff; padding: 4px 12px 4px 4px; border-radius: 50px; border: 1px solid #f0f0f0; text-decoration: none; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                                            <div style="width: 24px; height: 24px; border-radius: 50%; background: #fce4ec; color: #c2185b; display: flex; align-items: center; justify-content: center; font-size: 10px;"><i class="fas fa-tag"></i></div>
                                            <span style="font-size: 11px; font-weight: 700; color: #c2185b; text-transform: uppercase;">{{ $product->category_rel->name }}</span>
                                        </a>
                                    @else
                                        <div class="premium-category">{{ $product->category ?? 'Collection' }}</div>
                                    @endif
                                </div>
                                <h3 class="premium-title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>
                                <div class="premium-rating" style="display: flex; gap: 4px; justify-content: center; margin-bottom: 8px; color: #ff9100; font-size: 13px;">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="{{ $i <= round($product->rating) ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                    @if($product->reviews_count > 0)
                                        <span style="color: #888; font-size: 11px; margin-left: 5px;">({{ $product->reviews_count }} reviews)</span>
                                    @endif
                                </div>
                                <div class="premium-price-row">
                                    <span class="current-price">{{ format_inr($product->price) }}</span>
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST" style="margin: 0; width: 100%;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" name="action" value="buy" class="premium-add-btn">BUY NOW</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; color: #666; padding: 100px 0;">
                            <i class="fas fa-search" style="font-size: 40px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                            No products found in {{ isset($category) ? $category->name : 'this' }} collection.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Category Dropdown Logic */
    .category-dropdown-input {
        display: none !important;
    }

    .category-wrapper {
        background: #faf8f5;
        border-radius: 8px;
        border: 1px solid #f1ece4;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .category-dropdown-label {
        display: none; /* Hidden on desktop */
        padding: 15px 20px;
        background: #fff;
        color: #232323;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f1ece4;
    }

    .category-dropdown-label .toggle-icon {
        transition: transform 0.3s ease;
        color: #c2185b;
    }

    .category-content-mobile {
        padding: 35px 25px;
    }

    /* Shop Layout Grid */
    .shop-product-grid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 20px !important;
    }
    
    /* Expand container to remove unwanted side space */
    .shop-layout-container {
        max-width: 100% !important;
        width: 100% !important;
        padding: 0 30px !important;
    }

    @media (max-width: 991px) {
        section {
            padding: 40px 0 !important;
        }

        .shop-layout-container {
            padding: 0 15px !important;
        }

        .category-dropdown-label {
            display: flex; /* Show on mobile */
        }

        .category-content-mobile {
            max-height: 0;
            padding: 0 15px !important;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-desktop-title, .sidebar-title-line {
            display: none !important;
        }

        .category-dropdown-input:checked ~ .category-content-mobile {
            max-height: 800px; /* Large enough to fit all categories */
            padding: 20px 15px !important;
            opacity: 1;
        }

        .category-dropdown-input:checked ~ .category-dropdown-label .toggle-icon {
            transform: rotate(180deg);
        }

        .shop-sidebar {
            margin-bottom: 20px !important;
        }
        
        .shop-product-grid {
            gap: 10px !important;
            grid-template-columns: repeat(2, 1fr) !important;
        }

        .shop-product-grid .premium-product-card {
            border-radius: 12px !important;
        }

        .shop-product-grid .premium-img-box {
            height: 140px !important;
        }

        .shop-product-grid .premium-card-content {
            padding: 10px 12px !important;
            gap: 5px !important;
        }

        .shop-product-grid .premium-title {
            font-size: 14px !important;
            min-height: 40px !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }

        .shop-product-grid .current-price {
            font-size: 16px !important;
        }

        .shop-product-grid .premium-add-btn {
            padding: 8px !important;
            font-size: 11px !important;
        }

        .shop-product-grid .premium-rating {
            font-size: 10px !important;
            gap: 2px !important;
        }

        .shop-product-grid .premium-rating span {
            font-size: 9px !important;
        }

        .shop-product-grid .premium-badge {
            font-size: 9px !important;
            padding: 4px 10px !important;
            top: 10px !important;
            left: 10px !important;
        }
        
        .shop-layout {
            gap: 20px !important;
            flex-direction: column;
        }
    }

    /* Premium Sorting Dropdown */
    .shop-sort-container {
        position: relative;
        display: inline-block;
    }

    .shop-sort-select {
        appearance: none;
        -webkit-appearance: none;
        background: #fff;
        border: 2px solid #f0f0f0;
        border-radius: 50px;
        padding: 10px 45px 10px 20px;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        outline: none;
        min-width: 180px;
    }

    .shop-sort-select:hover {
        border-color: #ff9800;
        box-shadow: 0 4px 15px rgba(255, 152, 0, 0.15);
    }

    .shop-sort-select:focus {
        border-color: #c2185b;
    }

    .shop-sort-icon {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #c2185b;
        font-size: 12px;
        transition: all 0.3s ease;
    }

    .shop-sort-container:hover .shop-sort-icon {
        transform: translateY(-50%) rotate(180deg);
    }

    @media (max-width: 1400px) {
        .shop-product-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 992px) {
        .shop-layout {
            flex-direction: column;
        }
        .shop-sidebar {
            width: 100% !important;
            margin-bottom: 30px !important;
        }
        
        /* Ensure the main content div expands fully */
        .shop-layout > div:last-child {
            width: 100% !important;
        }
    }
    
    .shop-product-grid .premium-product-card {
        background: #fff !important;
        border-radius: 20px !important;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        height: auto !important;
        min-height: unset !important;
        border: 1px solid #f0f0f0 !important;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05) !important;
    }
    .shop-product-grid .premium-img-box {
        width: 100% !important;
        height: 180px; /* Reduced further for 3-col layout balance */
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fdfcfb;
    }
    .shop-product-grid .premium-img-box img,
    .shop-product-grid .premium-img-box .slide img {
        position: static;
        transform: none;
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        padding: 15px;
        display: block;
        margin: 0 auto;
    }
    .shop-product-grid .premium-card-content {
        padding: 15px 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        width: 100% !important;
        flex: 1;
        background: #fff;
    }
    .shop-product-grid .premium-title {
        margin: 0;
        font-size: 18px; /* Slightly smaller for 3-col */
        font-weight: 700;
        line-height: 1.3;
        color: var(--primary-color);
        min-height: unset;
    }
    .shop-product-grid .premium-price-row {
        margin: 2px 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .shop-product-grid .current-price {
        font-size: 20px;
        font-weight: 800;
        color: var(--primary-color);
    }
    .shop-product-grid .premium-add-btn {
        width: 100%;
        background: var(--icon-gradient) !important;
        color: #fff !important;
        padding: 12px;
        font-weight: 700;
        font-size: 13px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(194, 24, 91, 0.2);
        transition: all 0.3s ease;
        margin-top: 5px;
    }
    .shop-product-grid .premium-add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(194, 24, 91, 0.3);
    }
    
    /* Sidebar Pill Styles */
    .sidebar-category-pill {
        display: flex;
        align-items: center;
        gap: 15px;
        background: #fff;
        padding: 10px;
        border-radius: 50px;
        border: 1px solid transparent;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }
    .sidebar-category-pill:not(:last-child) {
        margin-bottom: 12px;
    }
    .sidebar-category-pill:hover, .sidebar-category-pill.active {
        background: #fff;
        border-color: #fce4ec;
        box-shadow: 0 8px 20px rgba(194, 24, 91, 0.08);
        transform: translateX(5px);
    }
    .sidebar-category-pill .pill-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .sidebar-category-pill .pill-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fafafa;
        color: #bbb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        border: 1px solid #eee;
    }
    .sidebar-category-pill:hover .pill-icon, .sidebar-category-pill.active .pill-icon {
        background: #fce4ec;
        color: #c2185b;
        border-color: #fce4ec;
    }
    .sidebar-category-pill .pill-text {
        font-size: 14px;
        font-weight: 700;
        color: #555;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: color 0.3s;
    }
    .sidebar-category-pill:hover .pill-text, .sidebar-category-pill.active .pill-text {
        color: #c2185b;
    }
</style>
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
</script>
@endsection
