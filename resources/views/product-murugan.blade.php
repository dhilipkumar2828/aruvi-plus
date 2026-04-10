@extends('layouts.auri')

@section('title', 'Navapasanam Lord Murugan Statue | Auvri Plus')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
@endsection

@section('content')
<!-- Product Detail Section -->
<section class="product-detail-section">
    <div class="container-premium">
        <div class="product-hero-grid" style="display: flex; gap: 50px; flex-wrap: wrap;">
            <!-- Left: Gallery -->
            <div class="product-gallery" style="flex: 1; min-width: 350px;">
                <div class="main-image-container" style="background: #fff; border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 20px;">
                    <img src="{{ asset('images/Aurvi Plus_Murugan_High.png') }}" alt="Navapasanam Lord Murugan Statue" id="mainImg" style="width: 100%; height: auto; object-fit: contain;">
                </div>
                <div class="thumbnail-grid" style="display: flex; gap: 15px;">
                    <div class="thumb-item active" onclick="changeImage('{{ asset('images/Aurvi Plus_Murugan_High.png') }}', this)" style="width: 80px; height: 80px; background: #fff; border-radius: 10px; cursor: pointer; padding: 10px; border: 2px solid transparent;">
                        <img src="{{ asset('images/Aurvi Plus_Murugan_High.png') }}" alt="Front View" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="thumb-item" onclick="changeImage('{{ asset('images/Aurvi Plus_Murugan_Side_A.png') }}', this)" style="width: 80px; height: 80px; background: #fff; border-radius: 10px; cursor: pointer; padding: 10px; border: 2px solid transparent;">
                        <img src="{{ asset('images/Aurvi Plus_Murugan_Side_A.png') }}" alt="Side View A" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="thumb-item" onclick="changeImage('{{ asset('images/Aurvi Plus_Murugan_Side_B.png') }}', this)" style="width: 80px; height: 80px; background: #fff; border-radius: 10px; cursor: pointer; padding: 10px; border: 2px solid transparent;">
                        <img src="{{ asset('images/Aurvi Plus_Murugan_Side_B.png') }}" alt="Side View B" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="product-info-panel" style="flex: 1; min-width: 350px;">
                <div class="category-tag" style="display: inline-block; background: #fce4ec; color: #c2185b; padding: 5px 15px; border-radius: 20px; font-weight: 700; font-size: 12px; margin-bottom: 15px; text-transform: uppercase;">Masterpiece Statues</div>
                <h1 class="product-title-premium" style="font-size: 36px; color: #222; margin-bottom: 20px; font-weight: 800;">Navapasanam Lord Murugan Statue</h1>
                <div class="rating-summary" style="display: flex; align-items: center; gap: 10px; margin-bottom: 25px;">
                    <div class="stars" style="color: #ff9f43; font-size: 14px;">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <span class="review-count" style="color: #888; font-size: 14px;">(42 High-Value Reviews)</span>
                </div>

                <div class="price-box-premium" style="margin-bottom: 30px;">
                    <div class="main-price" style="font-size: 32px; font-weight: 800; color: #222;">₹150,000 <span class="price-info" style="font-size: 14px; color: #888; font-weight: 400; margin-left: 10px;">/ (Rs. 600/gm)</span></div>
                </div>

                <p class="short-description-premium" style="color: #666; line-height: 1.8; font-size: 16px; margin-bottom: 40px;">
                    A unique alchemical masterpiece created from nine distinct poisons (Pashanams) by the great Auvri Plus. Similar to the revered deities enshrined in Palani and Poombarai, this statue is a direct channel of divine healing and protection, meticulously bound using lost ancient formulas.
                </p>

                <!-- Action Box -->
                <div class="action-box">
                    <div class="qty-row" style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px;">
                        <span class="qty-label" style="font-weight: 700; color: #333;">Quantity:</span>
                        <div class="qty-spinner" style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 30px; overflow: hidden; background: #fff;">
                            <button class="qty-btn minus" style="width: 40px; height: 40px; border: none; background: none; cursor: pointer; font-size: 20px;">-</button>
                            <input type="text" value="1" class="qty-input" style="width: 40px; height: 40px; border: none; text-align: center; font-weight: 700; font-size: 16px;">
                            <button class="qty-btn plus" style="width: 40px; height: 40px; border: none; background: none; cursor: pointer; font-size: 20px;">+</button>
                        </div>
                    </div>

                    <div class="button-stack" style="display: flex; gap: 15px; margin-bottom: 30px;">
                        <button class="premium-btn btn-add-cart" style="flex: 1; padding: 15px; border-radius: 50px; border: 2px solid #c2185b; background: transparent; color: #c2185b; font-weight: 700; cursor: pointer; transition: all 0.3s;">Add To Cart</button>
                        <button class="premium-btn btn-buy-now" style="flex: 1; padding: 15px; border-radius: 50px; border: none; background: linear-gradient(135deg, #c2185b 0%, #ad1457 100%); color: #fff; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 10px 20px rgba(194, 24, 91, 0.2);">Acquire Masterpiece</button>
                    </div>

                    <div class="trust-badges" style="display: flex; gap: 20px; border-top: 1px solid #eee; padding-top: 30px;">
                        <div class="trust-item" style="display: flex; align-items: center; gap: 10px;">
                            <div class="trust-icon" style="color: #c2185b;"><i class="fas fa-gem"></i></div>
                            <span class="trust-text" style="font-size: 13px; color: #666; font-weight: 600;">9 Pashanam Purity</span>
                        </div>
                        <div class="trust-item" style="display: flex; align-items: center; gap: 10px;">
                            <div class="trust-icon" style="color: #c2185b;"><i class="fas fa-award"></i></div>
                            <span class="trust-text" style="font-size: 13px; color: #666; font-weight: 600;">Certified Origin</span>
                        </div>
                        <div class="trust-item" style="display: flex; align-items: center; gap: 10px;">
                            <div class="trust-icon" style="color: #c2185b;"><i class="fas fa-box-open"></i></div>
                            <span class="trust-text" style="font-size: 13px; color: #666; font-weight: 600;">Luxury Secure Pkg</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technical Specs -->
<section class="specs-section" style="padding: 80px 0; background: #fff;">
    <div class="container-premium">
        <div class="section-header" style="text-align: center; margin-bottom: 60px;">
            <h2 class="section-title" style="font-size: 32px; color: #222; margin-bottom: 15px; font-weight: 800;">Divine Attributes</h2>
            <p class="section-subtitle" style="color: #888;">Precision alchemical specifications for high-energy resonance</p>
        </div>
        <div class="specs-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 30px;">
            <div class="spec-card" style="text-align: center; background: #fce4ec; padding: 30px; border-radius: 20px;">
                <div class="spec-icon-wrapper" style="font-size: 24px; color: #c2185b; margin-bottom: 15px;"><i class="fas fa-weight-hanging"></i></div>
                <h4 style="font-size: 18px; color: #333; margin-bottom: 10px;">Estimated Weight</h4>
                <p style="font-size: 20px; font-weight: 700; color: #222;">250 <span class="spec-unit" style="font-size: 14px; font-weight: 400; color: #888;">Grams (Approx)</span></p>
            </div>
            <div class="spec-card" style="text-align: center; background: #fce4ec; padding: 30px; border-radius: 20px;">
                <div class="spec-icon-wrapper" style="font-size: 24px; color: #c2185b; margin-bottom: 15px;"><i class="fas fa-ruler-vertical"></i></div>
                <h4 style="font-size: 18px; color: #333; margin-bottom: 10px;">Height</h4>
                <p style="font-size: 20px; font-weight: 700; color: #222;">6.5 <span class="spec-unit" style="font-size: 14px; font-weight: 400; color: #888;">Inches</span></p>
            </div>
            <div class="spec-card" style="text-align: center; background: #fce4ec; padding: 30px; border-radius: 20px;">
                <div class="spec-icon-wrapper" style="font-size: 24px; color: #c2185b; margin-bottom: 15px;"><i class="fas fa-flask"></i></div>
                <h4 style="font-size: 18px; color: #333; margin-bottom: 10px;">Alchemy</h4>
                <p style="font-size: 20px; font-weight: 700; color: #222;">9 <span class="spec-unit" style="font-size: 14px; font-weight: 400; color: #888;">Purified Pashanams</span></p>
            </div>
            <div class="spec-card" style="text-align: center; background: #fce4ec; padding: 30px; border-radius: 20px;">
                <div class="spec-icon-wrapper" style="font-size: 24px; color: #c2185b; margin-bottom: 15px;"><i class="fas fa-sun"></i></div>
                <h4 style="font-size: 18px; color: #333; margin-bottom: 10px;">Energy Level</h4>
                <p style="font-size: 20px; font-weight: 700; color: #222;">Infinite <span class="spec-unit" style="font-size: 14px; font-weight: 400; color: #888;">Cosmic Field</span></p>
            </div>
        </div>
    </div>
</section>

<!-- Narrative -->
<section class="product-narrative" style="padding: 100px 0; background-color: #fce4ec; text-align: center;">
    <div class="container-premium">
        <div class="narrative-content" style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 32px; color: #222; margin-bottom: 25px; font-weight: 800;">The Legend of Palani</h2>
            <p style="color: #555; line-height: 2; font-size: 18px;">
                Thousands of years ago, Auvri Plus formulated the Aurvi Plus to save humanity from impending ailments. The Lord Murugan statue he created for the Palani Hills remains the world's most powerful spiritual artifact. Our Lord Murugan statues are crafted with the same devotional rigor and purified minerals, ensuring that your home receives the same cleansing vibrations that have blessed the Palani temple for millennia.
            </p>
            <div class="premium-header-wrapper" style="display: flex; align-items: center; justify-content: center; margin-top: 40px;">
                <span class="title-decoration-line left" style="flex: 1; height: 1px; background: #ddd; max-width: 100px;"></span>
                <i class="fas fa-dharmachakra" style="font-size: 30px; color: #c2185b; margin: 0 20px;"></i>
                <span class="title-decoration-line right" style="flex: 1; height: 1px; background: #ddd; max-width: 100px;"></span>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function changeImage(src, el) {
        document.getElementById('mainImg').src = src;
        document.querySelectorAll('.thumb-item').forEach(thumb => {
            thumb.style.borderColor = 'transparent';
            thumb.classList.remove('active');
        });
        el.style.borderColor = '#c2185b';
        el.classList.add('active');
    }

    // Qty Spinner
    document.querySelector('.plus').addEventListener('click', () => {
        let input = document.querySelector('.qty-input');
        input.value = parseInt(input.value) + 1;
    });

    document.querySelector('.minus').addEventListener('click', () => {
        let input = document.querySelector('.qty-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });
</script>
@endsection
