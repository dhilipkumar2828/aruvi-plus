@extends('layouts.auri')

@section('title', 'Shop - Auvri Plus | Authentic Ayurvedic Products')
@section('meta_description', 'Explore our full range of herbal remedies designed for your holistic well-being. Pure, potent, and proven.')

@section('content')
    <!-- Shop Hero -->
    <section class="shop-hero" style="background-image: linear-gradient(rgba(0, 66, 0, 0.6), rgba(0, 66, 0, 0.6)), url('{{ asset('auri-images/headers/shop_v2.jpg') }}'); background-size: cover; background-position: center; min-height: 350px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; margin-bottom: 30px;">
        <div class="container hero-inner">
            <span class="sub-title" style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; opacity: 0.8; display: block; margin-bottom: 10px;">Our Collection</span>
            <h1 class="sec-title" style="font-family: 'Playfair Display', serif; font-size: 3.5rem; line-height: 1.2;">Authentic Ayurvedic Solutions</h1>
            <p class="p-text" style="max-width: 800px; margin: 15px auto 0; opacity: 0.9;">Cared for by nature, crafted with wisdom. Explore our full range of herbal remedies designed for your holistic well-being.</p>
        </div>
    </section>

    <!-- Sort Controls -->
    <section style="padding: 30px 0 0;">
        <div class="container">
            <form method="GET" action="{{ route('shop') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                @if(isset($category))
                    <div style="background: rgba(0,100,0,0.1); padding: 8px 20px; border-radius: 50px; color: var(--primary); font-weight: 600; font-size: 0.9rem;">
                        <i class="fas fa-tag"></i> {{ $category->name }}
                        <a href="{{ route('shop') }}" style="margin-left: 8px; color: #888;"><i class="fas fa-times"></i></a>
                    </div>
                @endif
                <select name="sort" onchange="this.form.submit()" style="padding: 10px 20px; border-radius: 50px; border: 1px solid #ddd; font-family: var(--font-main); font-size: 0.9rem; cursor: pointer; color: #444; background: #fff;">
                    <option value="default" {{ ($selectedSort ?? 'default') == 'default' ? 'selected' : '' }}>Sort by Name</option>
                    <option value="newest" {{ ($selectedSort ?? '') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="low-high" {{ ($selectedSort ?? '') == 'low-high' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="high-low" {{ ($selectedSort ?? '') == 'high-low' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
                {{-- @if(isset($categories) && $categories->count())
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <a href="{{ route('shop') }}" class="filter-pill {{ !isset($category) ? 'active' : '' }}">All</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('category.show', $cat->slug) }}" class="filter-pill {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                @endif --}}
            </form>
        </div>
    </section>

    <!-- Main Shop Grid -->
    <section class="shop-main-section">
        <div class="container">
            <div class="product-grid">
                @forelse($products as $product)
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
                        @if($product->compare_price && $product->compare_price > $product->price)
                            <div style="position: absolute; top: 15px; left: 15px; background: #e53935; color: #fff; padding: 4px 10px; border-radius: 4px; font-size: 0.7rem; font-weight: 800; z-index: 5; box-shadow: 0 4px 10px rgba(229,57,53,0.2);">
                                {{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF
                            </div>
                        @endif
                    </div>
                    <div class="p-info">
                        <div class="p-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= round($product->rating ?? 5) ? 'fas' : 'far' }} fa-star" style="color: #ffd700; font-size: 0.8rem;"></i>
                            @endfor
                        </div>
                        <h4 class="p-title">{{ $product->name }}</h4>
                        @if($product->category_rel)
                            <span style="font-size: 0.8rem; color: var(--primary); opacity: 0.7;">{{ $product->category_rel->name }}</span>
                        @endif
                        <div class="p-bot">
                            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                <span class="p-price" style="font-size: 1.2rem; font-weight: 800; color: #004200;">₹{{ number_format($product->price) }}</span>
                                @if($product->compare_price && $product->compare_price > 0)
                                    <span style="text-decoration: line-through; color: #999; font-size: 0.9rem; letter-spacing: 0.5px; opacity: 0.7;">₹{{ number_format($product->compare_price) }}</span>
                                @endif
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-btn" title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px; color: #888;">
                    <i class="fas fa-box-open" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.3;"></i>
                    <p style="font-size: 1.2rem;">No products available yet.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 20px;">Back to Home</a>
                </div>
                @endforelse</div>
        </div>
    </section>
@endsection
