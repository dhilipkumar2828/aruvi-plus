@extends('layouts.auri')

@section('title', 'Shop - Auvri Plus | Authentic Ayurvedic Products')
@section('meta_description', 'Explore our full range of herbal remedies designed for your holistic well-being. Pure, potent, and proven.')

@section('content')
    <!-- Shop Hero -->
    <section class="shop-hero">
        <div class="container hero-inner" style="text-align: center;">
            <span class="sub-title">Our Collection</span>
            <h1 class="sec-title">Authentic Ayurvedic Solutions</h1>
            <p class="p-text" style="max-width: 800px; margin: 0 auto;">Cared for by nature, crafted with wisdom. Explore our full range of herbal remedies designed for your holistic well-being.</p>
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
                @if(isset($categories) && $categories->count())
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <a href="{{ route('shop') }}" class="filter-pill {{ !isset($category) ? 'active' : '' }}">All</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('category.show', $cat->slug) }}" class="filter-pill {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                @endif
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
                        <a href="{{ route('product.show', $product->slug) }}" class="quick-view-btn">Quick View</a>
                    </div>
                    <div class="p-info">
                        <div class="p-rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->rating ?? 5))★@else☆@endif
                            @endfor
                        </div>
                        <h4 class="p-title">{{ $product->name }}</h4>
                        @if($product->category_rel)
                            <span style="font-size: 0.8rem; color: var(--primary); opacity: 0.7;">{{ $product->category_rel->name }}</span>
                        @endif
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
                <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px; color: #888;">
                    <i class="fas fa-box-open" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.3;"></i>
                    <p style="font-size: 1.2rem;">No products available yet.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 20px;">Back to Home</a>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
