@extends('layouts.auri')

@section('title', 'Your Shopping Cart | Auvri Plus')

@section('extra_css')
<style>
    /* Premium Cart Styles */
    :root {
        --cart-bg: #f9fbf9;
        --accent: #d4af37; /* Gold */
    }

    .cart-page-wrapper {
        background-color: var(--cart-bg);
        padding-bottom: 80px;
        min-height: 80vh;
    }

    /* Hero Banner */
    .cart-hero {
        background: linear-gradient(rgba(0, 66, 0, 0.7), rgba(0, 66, 0, 0.7)), url('{{ asset('auri-images/headers/shop_v2.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 100px 0 60px;
        text-align: center;
        color: white;
        margin-bottom: 50px;
    }

    .cart-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        color: var(--accent) !important;
        margin-bottom: 10px;
    }

    .cart-hero p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Layout */
    .cart-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 40px;
        align-items: start;
    }

    @media (max-width: 992px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Cart Items */
    .cart-items-container {
        background: white;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
    }

    .cart-item {
        display: grid;
        grid-template-columns: 100px 1fr auto auto;
        gap: 25px;
        align-items: center;
        padding: 25px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-img {
        width: 100px;
        height: 100px;
        background: #fdfdfd;
        border-radius: 15px;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-item-img img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .cart-item-info h4 {
        color: var(--primary) !important;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .cart-item-info .price {
        color: #777;
        font-weight: 500;
    }

    .qty-box {
        display: flex;
        align-items: center;
        background: #f5f5f5;
        border-radius: 50px;
        padding: 5px;
    }

    .qty-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        font-size: 0.8rem;
        transition: 0.3s;
    }

    .qty-btn:hover {
        background: var(--primary);
        color: white;
    }

    .qty-input {
        width: 40px;
        text-align: center;
        background: transparent;
        border: none;
        font-weight: 700;
        color: var(--primary);
    }

    .cart-item-subtotal {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--primary);
        min-width: 100px;
        text-align: right;
    }

    .btn-remove {
        color: #ff5252;
        background: #fff5f5;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .btn-remove:hover {
        background: #ff5252;
        color: white;
    }

    /* Summary Card */
    .summary-card {
        background: white;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 15px 50px rgba(0, 66, 0, 0.08);
        border: 1px solid rgba(0, 66, 0, 0.05);
        position: sticky;
        top: 100px;
    }

    .summary-card h3 {
        color: var(--primary) !important;
        font-size: 1.5rem;
        margin-bottom: 25px;
        border-bottom: 2px solid var(--secondary);
        padding-bottom: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 1rem;
        color: #555;
    }

    .summary-row strong {
        color: var(--primary);
    }

    .summary-total {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px dashed #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .total-label {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary);
    }

    .total-value {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary);
    }

    .btn-checkout {
        display: block;
        width: 100%;
        background: var(--primary);
        color: white;
        text-align: center;
        padding: 18px;
        border-radius: 50px;
        font-weight: 700;
        letter-spacing: 1px;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(0, 66, 0, 0.2);
    }

    .btn-checkout:hover {
        transform: translateY(-3px);
        background: var(--primary-hover);
        box-shadow: 0 15px 30px rgba(0, 66, 0, 0.3);
        color: white;
    }

    /* Coupon */
    .coupon-box {
        background: #f9fdf9;
        border-radius: 15px;
        padding: 15px;
        margin-top: 20px;
        border: 1px dashed #c8e6c9;
    }

    .coupon-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #2e7d32;
        margin-bottom: 10px;
        display: block;
    }

    .coupon-input-group {
        display: flex;
        gap: 10px;
    }

    .coupon-input {
        flex: 1;
        padding: 10px 15px;
        border-radius: 50px;
        border: 1px solid #ddd;
        font-size: 0.9rem;
    }

    .btn-apply {
        background: var(--accent);
        color: white;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
    }

    /* Empty State */
    .empty-cart-state {
        text-align: center;
        padding: 100px 20px;
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: #eee;
        margin-bottom: 20px;
    }

    .empty-cart-state h2 {
        color: var(--primary) !important;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    @media (max-width: 576px) {
        .cart-item {
            grid-template-columns: 80px 1fr auto;
            gap: 15px;
        }
        .cart-item-subtotal {
            grid-column: 1 / -1;
            text-align: left;
            border-top: 1px solid #f9f9f9;
            padding-top: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="cart-page-wrapper">
    <!-- Hero Banner -->
    <div class="cart-hero">
        <div class="container">
            <h1>Shopping Cart</h1>
            <p>Review your divine selections before bringing them home. Every product is a step towards holistic wellness.</p>
        </div>
    </div>

    <div class="container">
        @if (empty($cart))
            <div class="empty-cart-state">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <h2>Your Cart is Empty</h2>
                <p>It seems you haven't added any items to your cart yet. Explore our sacred collections and find something special.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary" style="padding: 15px 40px; border-radius: 50px;">
                    <i class="fas fa-store"></i> Start Shopping
                </a>
            </div>
        @else
            <!-- Header Actions -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <a href="{{ route('shop') }}" style="color: var(--primary); font-weight: 600; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
                <form action="{{ route('cart.clear') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="color: #666; font-size: 0.9rem; text-decoration: underline;" onclick="return confirm('Clear all items from your cart?')">
                        Clear Cart
                    </button>
                </form>
            </div>

            <div class="cart-grid">
                <!-- Items List -->
                <div class="cart-items-container">
                    @foreach ($cart as $item)
                        <div class="cart-item">
                            <div class="cart-item-img">
                                <a href="{{ route('product.show', $item['slug']) }}">
                                    @php
                                        $img = $item['image'];
                                        if ($img && !str_starts_with($img, 'http') && !str_starts_with($img, '/')) {
                                            $img = asset($img);
                                        }
                                    @endphp
                                    @if($img)
                                        <img src="{{ $img }}" alt="{{ $item['name'] }}">
                                    @else
                                        <img src="https://via.placeholder.com/100" alt="{{ $item['name'] }}">
                                    @endif
                                </a>
                            </div>
                            <div class="cart-item-info">
                                <a href="{{ route('product.show', $item['slug']) }}">
                                    <h4>{{ $item['name'] }}</h4>
                                </a>
                                <div class="price">₹{{ number_format($item['price']) }} / unit</div>
                            </div>
                            <div class="cart-item-qty">
                                <div class="qty-box">
                                    <button type="button" class="qty-btn" onclick="updateQty('{{ $item['product_id'] }}', -1)"><i class="fas fa-minus"></i></button>
                                    <input type="text" class="qty-input" value="{{ $item['quantity'] }}" readonly id="qty-{{ $item['product_id'] }}">
                                    <button type="button" class="qty-btn" onclick="updateQty('{{ $item['product_id'] }}', 1)"><i class="fas fa-plus"></i></button>
                                </div>
                                <form id="form-{{ $item['product_id'] }}" action="{{ route('cart.update') }}" method="POST" style="display:none;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                    <input type="hidden" name="quantity" id="input-{{ $item['product_id'] }}">
                                </form>
                            </div>
                            <div class="cart-item-subtotal">
                                <div>₹{{ number_format($item['price'] * $item['quantity']) }}</div>
                                <form action="{{ route('cart.remove') }}" method="POST" style="display:inline; margin-top:10px;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                    <button type="submit" class="btn-remove" style="margin-left: auto;"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary Panel -->
                <div class="summary-card">
                    <h3>Order Summary</h3>
                    
                    <div class="summary-row">
                        <span>Items Subtotal</span>
                        <strong>₹{{ number_format($subtotal) }}</strong>
                    </div>

                    <div class="summary-row">
                        <span>Shipping</span>
                        @if($shipping > 0)
                            <strong>₹{{ number_format($shipping) }}</strong>
                        @else
                            <strong style="color: #2e7d32;">FREE</strong>
                        @endif
                    </div>

                    @if ($discount > 0)
                        <div class="summary-row" style="color: #2e7d32;">
                            <span>Coupon Discount</span>
                            <strong>-₹{{ number_format($discount) }}</strong>
                        </div>
                    @endif

                    <div class="coupon-box">
                        <span class="coupon-title">HAVE A COUPON?</span>
                        @if ($coupon)
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-ticket-alt" style="color: var(--accent);"></i>
                                    <strong>{{ $coupon->code }}</strong>
                                </div>
                                <form action="{{ route('cart.coupon.remove') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" style="color: #f44336; font-size: 0.8rem; font-weight: 700;">REMOVE</button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('cart.coupon.apply') }}" method="POST" class="coupon-input-group">
                                @csrf
                                <input type="text" name="code" placeholder="Enter Code" class="coupon-input" required>
                                <button type="submit" class="btn-apply shadow-sm">APPLY</button>
                            </form>
                        @endif
                    </div>

                    <div class="summary-total">
                        <span class="total-label">Total Amount</span>
                        <div class="total-value">₹{{ number_format($total) }}</div>
                    </div>

                    @auth
                        <a href="{{ route('checkout') }}" class="btn-checkout">
                             PROCEED TO CHECKOUT <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-checkout">
                            LOGIN TO CHECKOUT <i class="fas fa-sign-in-alt"></i>
                        </a>
                        <p style="margin: 20px 0 0; color: #888; font-size: 0.85rem; text-align: center;">
                            New customer? <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 700;">Join Auvri Plus</a>
                        </p>
                    @endauth

                    <div style="margin-top: 30px; text-align: center; opacity: 0.4;">
                        <img src="https://checkout.razorpay.com/v1/checkout.js" alt="" style="display:none;">
                        <i class="fab fa-cc-visa" style="font-size: 24px; margin: 0 5px;"></i>
                        <i class="fab fa-cc-mastercard" style="font-size: 24px; margin: 0 5px;"></i>
                        <i class="fas fa-shield-alt" style="font-size: 20px; margin: 0 5px;"></i>
                        <div style="font-size: 0.7rem; margin-top: 5px;">Secure Encryption Enabled</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('extra_js')
<script>
    function updateQty(pid, delta) {
        const inputStr = document.getElementById('qty-' + pid).value;
        let qty = parseInt(inputStr) + delta;
        if (qty < 1) return;
        
        document.getElementById('input-' + pid).value = qty;
        document.getElementById('form-' + pid).submit();
    }
</script>
@endsection
