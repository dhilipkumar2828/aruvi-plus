@extends('layouts.auri')

@section('title', ($blog->title ?? 'Blog') . ' | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('extra_css')
<style>
    .hero-small {
        position: relative;
        height: 350px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        z-index: 1;
    }

    .hero-small .container {
        position: relative;
        z-index: 2;
    }

    .blog-main-content h1, .blog-main-content h2, .blog-main-content h3 {
        font-family: 'Playfair Display', serif;
        color: #004200;
        margin: 30px 0 15px;
    }

    .blog-main-content p {
        margin-bottom: 20px;
    }

    .btn-premium-outline {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        border: 2px solid #004200;
        color: #004200;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-premium-outline:hover {
        background: #004200;
        color: white;
    }
</style>
@endsection

@section('content')


<section class="shop-hero" style="background-image: linear-gradient(rgba(0, 66, 0, 0.6), rgba(0, 66, 0, 0.6)), url('{{ asset('auri-images/headers/shop_v2.jpg') }}'); background-size: cover; background-position: center; min-height: 350px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; margin-bottom: 30px;">
    <div class="container hero-inner">
        <span class="sub-title" style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; opacity: 0.8; display: block; margin-bottom: 10px;">Aruvi Blogs Detail</span>
        <h1 class="sec-title" style="font-family: 'Playfair Display', serif; font-size: 3.5rem; line-height: 1.2;">At Aurvi, we believe fashion is not just about clothing, but a reflection of culture, identity, and confidence. </h1>
        <p class="p-text" style="max-width: 800px; margin: 15px auto 0; opacity: 0.9;">{{ $blog->title }}</p>
    </div>
</section>


<!-- Blog Detail Section -->
<section style="padding: 60px 0; background: #ffffff;">
    <div class="container" style="max-width: 1000px;">
        
        <!-- Featured Image: Centered with rounded corners and shadow -->
        @if($blog->image)
        <div style="margin-bottom: 50px; display: flex; justify-content: center;">
            <div style="max-width: 800px; width: 100%; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.12);">
                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width: 100%; height: auto; display: block;">
            </div>
        </div>
        @endif

        <div style="max-width: 850px; margin: 0 auto;">
            <!-- Blog Title with Side Accent Line -->
            <div style="margin-bottom: 35px; padding-left: 20px; border-left: 6px solid #d4145a;">
                <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(28px, 4vw, 40px); color: #1a1a1a; line-height: 1.3; margin: 0;">
                    {{ $blog->title }}
                </h1>
            </div>

            <!-- Meta Information -->
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 40px; color: #777; font-size: 0.95rem; font-weight: 500; padding-bottom: 25px; border-bottom: 1px solid #f0f0f0;">
                <span><i class="far fa-calendar-alt" style="color: #d4145a;"></i> {{ optional($blog->published_at)->format('M d, Y') }}</span>
                <span><i class="far fa-user" style="color: #d4145a;"></i> {{ $blog->author ?? 'Bogar Siddha Peedam - Bogar Alchemist LLP' }}</span>
            </div>

            <!-- Blog Description / Content -->
            <div class="blog-main-content" style="font-family: 'Inter', sans-serif; font-size: 1.1rem; color: #444; line-height: 1.9; text-align: left;">
                {!! nl2br($blog->content) !!}
            </div>

            <!-- Footer: Back Button -->
            <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid #f0f0f0;">
                <a href="{{ route('blogs.index') }}" class="btn-premium-outline">
                    <i class="fas fa-arrow-left"></i> BACK TO BLOGS
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
