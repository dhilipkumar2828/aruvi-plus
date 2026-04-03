@extends('layouts.auri')

@section('title', 'Blogs | Auvri Plus')

@section('extra_css')
<style>
    /* Section Header Decoration */
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .premium-header-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin-bottom: 10px;
    }

    .premium-header-wrapper h2 {
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 2.2rem;
        color: #1a1a1a;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
    }

    .header-dot {
        width: 8px;
        height: 8px;
        background: #d4145a;
        border-radius: 50%;
    }

    .header-line {
        height: 2px;
        width: 80px;
        background: linear-gradient(to right, transparent, #d4145a);
    }

    .header-line.right {
        background: linear-gradient(to left, transparent, #d4145a);
    }

    .section-subtitle {
        color: #666;
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Articles Grid */
    .articles-section {
        background: #f8f8f8;
        padding: 100px 0;
    }

    .articles-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .article-card {
        background: #163e0a; /* Dark background as per image */
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        border: none;
    }

    .article-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 45px rgba(0,0,0,0.2);
    }

    .article-image-wrapper {
        width: 100%;
        height: 240px;
        overflow: hidden;
    }

    .article-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .article-card:hover .article-image {
        transform: scale(1.1);
    }

    .article-content {
        padding: 30px 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .article-date {
        font-size: 0.85rem;
        color: #d4145a; /* Red color as per image */
        font-weight: 700;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
    }

    .article-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #ffffff; /* White title on dark card */
        margin-bottom: 15px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-excerpt {
        color: #999; /* Grey excerpt */
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 25px;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .read-more-link {
        color: #ffffff;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .read-more-link i {
        font-size: 0.8rem;
        transition: transform 0.3s ease;
    }

    .read-more-link:hover {
        color: #d4145a;
    }

    .read-more-link:hover i {
        transform: translateX(5px);
    }

    /* Slider specific for mobile */
    @media (max-width: 992px) {
        .articles-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .articles-grid {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 20px;
            padding: 10px 5px 30px;
        }
        .article-card {
            min-width: 280px;
            scroll-snap-align: center;
        }
        .section-title {
            font-size: 1.8rem;
        }
    }
</style>
@endsection

@section('content')
<section class="shop-hero" style="background-image: linear-gradient(rgba(0, 66, 0, 0.6), rgba(0, 66, 0, 0.6)), url('{{ asset('auri-images/headers/shop_v2.jpg') }}'); background-size: cover; background-position: center; min-height: 350px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; margin-bottom: 30px;">
    <div class="container hero-inner">
        <span class="sub-title" style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; opacity: 0.8; display: block; margin-bottom: 10px;">Our Blogs</span>
        <h1 class="sec-title" style="font-family: 'Playfair Display', serif; font-size: 3.5rem; line-height: 1.2;">Insights from the world of Auvri Plus wisdom.</h1>
        <p class="p-text" style="max-width: 800px; margin: 15px auto 0; opacity: 0.9;">Sacred stories and spiritual guidance from Auvri Plus</p>
    </div>
</section>


<section class="articles-section" style="padding: 80px 0;">
    <div class="container">
        <div class="section-header">
            <div class="premium-header-wrapper">
                <span class="header-line"></span>
                <span class="header-dot"></span>
                <h2 class="section-title">Latest Articles</h2>
                <span class="header-dot"></span>
                <span class="header-line right"></span>
            </div>
            <p class="section-subtitle">Sacred stories and spiritual guidance from Auvri Plus</p>
        </div>
        
        <div class="articles-grid" id="articles-scroll-grid">
            @forelse ($blogs as $blog)
                <div class="article-card">
                    <div class="article-image-wrapper">
                        @if ($blog->image)
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="article-image">
                        @endif
                    </div>
                    <div class="article-content">
                        <div class="article-date">
                            <i class="far fa-calendar-alt"></i> 
                            {{ optional($blog->published_at)->format('M d, Y') }}
                        </div>
                        <h3 class="article-title">{{ $blog->title }}</h3>
                        <p class="article-excerpt">{{ $blog->excerpt }}</p>
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more-link">READ MORE <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: #777;">No blog posts yet.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
