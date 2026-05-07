@extends('layouts.auri')

@section('title', 'Shop - Auvri Plus | Authentic Ayurvedic Products')
@section('meta_description', 'Explore our full range of herbal remedies designed for your holistic well-being. Pure, potent, and proven.')

@section('content')
    <style>
        @media (min-width: 992px) {
            .product-grid-shop {
                display: grid;
                grid-template-columns: repeat(4, 1fr) !important;
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .shop-hero .sec-title {
                font-size: 2.5rem !important;
            }
            .shop-hero .container {
                padding: 0 20px;
            }
            .shop-hero {
                min-height: 280px !important;
            }
        }

        @media (max-width: 480px) {
            .shop-hero .sec-title {
                font-size: 2rem !important;
            }
        }

        .sec-title {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        .show-more-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100%;
        }
        
        .btn-show-more {
            background: var(--primary);
            color: #fff !important;
            padding: 16px 40px;
            border-radius: 50px;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 600;
            text-decoration: none !important;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 66, 0, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            border: 2px solid var(--primary);
        }
        
        .btn-show-more:hover {
            background: #d4af37;
            border-color: #d4af37;
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(212, 175, 55, 0.4);
            color: #000 !important;
        }
        
        .btn-show-more i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }
        
        .btn-show-more:hover i {
            transform: translateX(5px);
        }
    </style>
    <!-- Shop Hero -->
    @php
        $isNavapashanamPage = (isset($pageTitle) && str_contains(strtolower($pageTitle), 'navapashanam')) || (isset($category) && str_contains(strtolower($category->slug), 'navapashanam'));
        $heroBg = $isNavapashanamPage ? asset('images/navapashanam_bg.png') : asset('auri-images/headers/shop_v2.jpg');
    @endphp
    <section class="shop-hero" style="background-image: linear-gradient(rgba(0, 40, 0, 0.7), rgba(0, 40, 0, 0.7)), url('{{ $heroBg }}'); background-size: cover; background-position: center; min-height: 350px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; margin-bottom: 30px; width: 100%; overflow: hidden;">
        <div class="container hero-inner">
            <span class="sub-title" style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; opacity: 0.8; display: block; margin-bottom: 10px;">Our Collection</span>
            <h1 class="sec-title" style="font-size: 3.5rem; line-height: 1.2;">{{ $pageTitle ?? ($category->name ?? 'Authentic Ayurvedic Solutions') }}</h1>
            <p class="p-text" style="max-width: 800px; margin: 15px auto 0; opacity: 0.9;">Cared for by nature, crafted with wisdom. Explore our full range of herbal remedies designed for your holistic well-being.</p>
        </div>
    </section>

    <!-- Sort Controls -->
    <section style="padding: 30px 0 0;">
        <div class="container">
            <form method="GET" action="{{ route('shop') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <!-- @if(isset($category) || isset($pageTitle))
                    <div style="background: rgba(0,100,0,0.1); padding: 8px 20px; border-radius: 50px; color: var(--primary); font-weight: 600; font-size: 0.9rem;">
                        <i class="fas fa-tag"></i> {{ $pageTitle ?? $category->name }}
                        <a href="{{ route('shop') }}" style="margin-left: 8px; color: #888;"><i class="fas fa-times"></i></a>
                    </div>
                @endif
                <select name="sort" onchange="this.form.submit()" style="padding: 10px 20px; border-radius: 50px; border: 1px solid #ddd; font-family: var(--font-main); font-size: 0.9rem; cursor: pointer; color: #444; background: #fff;">
                    <option value="default" {{ ($selectedSort ?? 'default') == 'default' ? 'selected' : '' }}>Sort by Name</option>
                    <option value="newest" {{ ($selectedSort ?? '') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="low-high" {{ ($selectedSort ?? '') == 'low-high' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="high-low" {{ ($selectedSort ?? '') == 'high-low' ? 'selected' : '' }}>Price: High to Low</option>
                </select> -->
            </form>
        </div>
    </section>

    <!-- Main Shop Grid -->
    @if(isset($herbalProducts) && isset($navapashanamProducts))
        <!-- Herbal Products Section -->
        <section class="shop-main-section" style="padding: 20px 0 30px;">
            <div class="container">
                <h2 style="color: var(--primary); margin-bottom: 45px; text-align: center; font-family: 'Playfair Display', serif; font-size: 2.8rem; position: relative; padding-bottom: 15px;">
                    Herbal Products
                    <span style="content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background: var(--accent-gold); border-radius: 2px;"></span>
                </h2>
                <div class="product-grid product-grid-shop">
                    @foreach($herbalProducts as $product)
                        @include('auri.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Navapashanam Section -->
        <section class="shop-main-section" style="padding: 20px 0 60px;">
            <div class="container">
                <h2 style="color: var(--primary); margin-bottom: 45px; text-align: center; font-family: 'Playfair Display', serif; font-size: 2.8rem; position: relative; padding-bottom: 15px;">
                    Navapashanam
                    <span style="content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background: var(--accent-gold); border-radius: 2px;"></span>
                </h2>
                <div class="product-grid product-grid-shop">
                    @foreach($navapashanamProducts as $product)
                        @include('auri.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <!-- Single Section View (Category or Specific List) -->
        <section class="shop-main-section" style="padding: 20px 0 60px;">
            <div class="container">
                @if(isset($pageTitle) || isset($category))
                <h2 style="color: var(--primary); margin-bottom: 45px; text-align: center; font-family: 'Playfair Display', serif; font-size: 2.8rem; position: relative; padding-bottom: 15px;">
                    {{ $pageTitle ?? $category->name }}
                    <span style="content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background: var(--accent-gold); border-radius: 2px;"></span>
                </h2>
                @endif
                <div class="product-grid">
                    @forelse($products as $product)
                        @include('auri.partials.product-card', ['product' => $product])
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
    @endif
@endsection
