@extends('layouts.auri')

@section('title', 'Navapashanam Shivlingam | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
<style>
    @media (max-width: 991px) {
        .rating-summary .stars {
            font-size: 11px !important;
        }
        .rating-summary .review-count {
            font-size: 11px !important;
        }
    }
</style>
@endsection

@section('content')
<!-- Product Detail Section -->
<section class="product-detail-section">
    <div class="container-premium">
        <div class="product-hero-grid" style="display: flex; gap: 50px; flex-wrap: wrap;">
            <!-- Left: Gallery -->
            <div class="product-gallery" style="flex: 1; min-width: 350px;">
                <div class="main-image-container" style="background: #fff; border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 20px;">
                    <img src="{{ asset('images/Navapashanam_Shivlingam_New_Side1.png') }}" alt="Navapashanam Shivlingam" id="mainImg" style="width: 100%; height: auto; object-fit: contain;">
                </div>
                <div class="thumbnail-grid" style="display: flex; gap: 15px;">
                    <div class="thumb-item active" onclick="changeImage('{{ asset('images/Navapashanam_Shivlingam_New_Side1.png') }}', this)" style="width: 80px; height: 80px; background: #fff; border-radius: 10px; cursor: pointer; padding: 10px; border: 2px solid transparent;">
                        <img src="{{ asset('images/Navapashanam_Shivlingam_New_Side1.png') }}" alt="Side 1" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="thumb-item" onclick="changeImage('{{ asset('images/Navapashanam_Shivlingam_New_Side2.png') }}', this)" style="width: 80px; height: 80px; background: #fff; border-radius: 10px; cursor: pointer; padding: 10px; border: 2px solid transparent;">
                        <img src="{{ asset('images/Navapashanam_Shivlingam_New_Side2.png') }}" alt="Side 2" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="product-info-panel" style="flex: 1; min-width: 350px;">
                <div class="category-tag" style="display: inline-flex; align-items: center; gap: 8px; background: #fce4ec; color: #c2185b; padding: 5px 15px; border-radius: 20px; font-weight: 700; font-size: 12px; margin-bottom: 15px; text-transform: uppercase;"><i class="fas fa-tag"></i> Sacred Artifacts</div>
                <h1 class="product-title-premium" style="font-size: 36px; color: #222; margin-bottom: 20px; font-weight: 800;">Navapashanam Shivlingam</h1>
                <div class="rating-summary" style="display: flex; align-items: center; gap: 10px; margin-bottom: 25px;">
                    <div class="stars" style="color: #ff9f43; font-size: 14px;">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <span class="review-count" style="color: #888; font-size: 14px;">(128 Verified Reviews)</span>
                </div>

                <div class="price-box-premium" style="margin-bottom: 30px;">
                    <div class="main-price" style="font-size: 32px; font-weight: 800; color: #222;">₹6,000 <span class="price-info" style="font-size: 14px; color: #888; font-weight: 400; margin-left: 10px;">/ Inclusive of all taxes</span></div>
                </div>

                <p class="short-description-premium" style="color: #666; line-height: 1.8; font-size: 16px; margin-bottom: 40px;">
                    A divine manifestation created through the ancient alchemical science of Siddha Bogar. This Shivlingam represents the synthesis of cosmic energy and earthly detoxification, formulated with nine sacred "Pashanams" to safeguard your dwelling and spiritual health.
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
                        <button class="premium-btn btn-buy-now" style="flex: 1; padding: 15px; border-radius: 50px; border: none; background: linear-gradient(135deg, #c2185b 0%, #ad1457 100%); color: #fff; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 10px 20px rgba(194, 24, 91, 0.2);">Buy Now Instantly</button>
                    </div>

                    <div class="trust-badges" style="display: flex; gap: 20px; border-top: 1px solid #eee; padding-top: 30px;">
                        <div class="trust-item" style="display: flex; align-items: center; gap: 10px;">
                            <div class="trust-icon" style="color: #c2185b;"><i class="fas fa-certificate"></i></div>
                            <span class="trust-text" style="font-size: 13px; color: #666; font-weight: 600;">100% Authentic</span>
                        </div>
                        <div class="trust-item" style="display: flex; align-items: center; gap: 10px;">
                            <div class="trust-icon" style="color: #c2185b;"><i class="fas fa-shield-alt"></i></div>
                            <span class="trust-text" style="font-size: 13px; color: #666; font-weight: 600;">Secure Lab Tested</span>
                        </div>
                        <div class="trust-item" style="display: flex; align-items: center; gap: 10px;">
                            <div class="trust-icon" style="color: #c2185b;"><i class="fas fa-shipping-fast"></i></div>
                            <span class="trust-text" style="font-size: 13px; color: #666; font-weight: 600;">Global shipping</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Narrative -->
<section class="product-narrative" style="padding: 100px 0; background-color: #fce4ec; text-align: center;">
    <div class="container-premium">
        <div class="narrative-content" style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 32px; color: #222; margin-bottom: 25px; font-weight: 800;">The Alchemy of Bogar</h2>
            <p style="color: #555; line-height: 2; font-size: 18px;">
                Perfected by the legendary Siddha Bogar at the Palani Hills, Navapashanam is more than a material; it is a spiritual battery. By purifying nine distinct poisons and binding them through secret herbal processes, Bogar created a permanent source of divine vibration that heals the body and aligns the soul.
            </p>
            <div class="premium-header-wrapper" style="display: flex; align-items: center; justify-content: center; margin-top: 40px;">
                <span class="title-decoration-line left" style="flex: 1; height: 1px; background: #ddd; max-width: 100px;"></span>
                <i class="fas fa-om" style="font-size: 30px; color: #c2185b; margin: 0 20px;"></i>
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
