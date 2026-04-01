@extends('layouts.auri')

@section('title', 'Blogs | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('content')
<section class="hero-small" style="background-image: url('{{ asset('images/sage_bg_full.jpg') }}');">
    <div class="hero-overlay"></div>
    <div class="container">
        <h1>Blogs</h1>
        <p>Insights from the world of Siddha wisdom.</p>
    </div>
</section>

<section class="articles-section" style="padding: 80px 0;">
    <div class="container">
        <div class="section-header">
            <div class="premium-header-wrapper">
                <span class="title-decoration-line left"></span>
                <h2 class="section-title">Latest Articles</h2>
                <span class="title-decoration-line right"></span>
            </div>
            <p class="section-subtitle">Sacred stories and spiritual guidance from Bogar Siddha Peedam - Bogar Alchemist LLP</p>
        </div>
        <div style="position: relative;">
            <button class="article-slider-arrow prev d-md-none" onclick="document.getElementById('articles-scroll-grid').scrollBy({left: -320, behavior: 'smooth'})"><i class="fas fa-chevron-left"></i></button>
            <button class="article-slider-arrow next d-md-none" onclick="document.getElementById('articles-scroll-grid').scrollBy({left: 320, behavior: 'smooth'})"><i class="fas fa-chevron-right"></i></button>

            <div class="articles-grid" id="articles-scroll-grid">
                @forelse ($blogs as $blog)
                    <div class="article-card">
                        @if ($blog->image)
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="article-image">
                        @endif
                        <div class="article-content">
                            <div class="article-date"><i class="far fa-calendar-alt"></i> {{ optional($blog->published_at)->format('M d, Y') }}</div>
                            <h3 class="article-title">{{ $blog->title }}</h3>
                            <p class="article-excerpt">{{ $blog->excerpt }}</p>
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; color: #777;">No blog posts yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
