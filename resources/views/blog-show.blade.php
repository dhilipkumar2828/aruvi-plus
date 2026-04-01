@extends('layouts.auri')

@section('title', ($blog->title ?? 'Blog') . ' | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('content')
<!-- Blog Hero -->
<section class="hero-small" style="background-image: url('{{ asset('images/sage_bg_full.jpg') }}'); min-height: 450px;">
    <div class="hero-overlay" style="background: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.4));"></div>
    <div class="container" style="max-width: 1000px;">
        <h1 style="font-size: clamp(24px, 5vw, 42px); line-height: 1.2; margin-bottom: 20px;">{{ $blog->title }}</h1>
        <div style="display: flex; align-items: center; justify-content: center; gap: 15px; color: rgba(255,255,255,0.9); font-weight: 500;">
            <span><i class="far fa-calendar-alt"></i> {{ optional($blog->published_at)->format('M d, Y') }}</span>
            <span style="width: 5px; height: 5px; background: #fff; border-radius: 50%;"></span>
            <span><i class="far fa-user"></i> {{ $blog->author ?? 'Bogar Siddha Peedam - Bogar Alchemist LLP' }}</span>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section style="padding: 60px 0; background: #fff;">
    <div class="container" style="max-width: 850px;">
        <!-- Featured Image at top of description -->
        @if($blog->image)
        <div style="margin-bottom: 40px; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width: 100%; height: auto; display: block;">
        </div>
        @endif

        <div style="font-size: 18px; color: #333; line-height: 1.8; font-weight: 500; margin-bottom: 30px; padding-left: 20px; border-left: 4px solid var(--primary-color);">
            {{ $blog->excerpt }}
        </div>

        <div class="blog-main-content" style="font-size: 17px; color: #444; line-height: 2; text-align: justify;">
            {!! nl2br(e($blog->content)) !!}
        </div>

        <!-- Social Share or Back Button -->
        <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('blogs.index') }}" class="btn-premium-outline">
                <i class="fas fa-arrow-left"></i> Back to Blogs
            </a>
            {{-- <div style="display: flex; gap: 15px;">
                <span style="color: #888; font-size: 14px; font-weight: 600;">SHARE:</span>
                <a href="#" style="color: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                <a href="#" style="color: #1da1f2;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: #25d366;"><i class="fab fa-whatsapp"></i></a>
            </div> --}}
        </div>
    </div>
</section>
@endsection
