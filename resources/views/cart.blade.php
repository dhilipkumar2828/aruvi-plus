@extends('layouts.auri')

@section('title', 'Your Shopping Cart | Auvri Plus')

@section('extra_css')
    <style>
        /* Premium Cart Styles */
        :root {
            --cart-bg: #f9fbf9;
            --accent: #d4af37;
            /* Gold */
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

        .total-value {
            font-size: 3.5rem;
            font-weight: 900;
            color: #b0185e !important;
        }

        @media (max-width: 992px) {
            .cart-grid {
                grid-template-columns: 1fr;
            }

            .total-value {
                font-size: 3.5rem;
                font-weight: 900;
                color: #b0185e !important;
            }
        }

        /* Cart Items */
        .cart-items-container {
            background: white;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 1fr auto auto;
            gap: 25px;
            align-items: center;
            padding: 30px 0;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
            /* For absolute positioning of actions */
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

        .cart-item-actions-corner {
            position: absolute;
            top: 20px;
            right: 0;
            display: flex;
            gap: 8px;
        }

        .btn-action-small {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-wishlist {
            background: #f0f7ff;
            color: #2196f3;
        }

        .btn-wishlist:hover {
            background: #2196f3;
            color: #fff;
        }

        .btn-remove-small {
            background: #fff5f5;
            color: #ff5252;
        }

        .btn-remove-small:hover {
            background: #ff5252;
            color: #fff;
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
            width: fit-content;
            margin: 5px 0;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            min-width: 130px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
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
            .container {
                width: 100% !important;
            }

            .total-value {
                font-size: 2rem;
                font-weight: 900;
                color: #b0185e !important;
            }

            .cart-hero {
                padding: 80px 0 40px;
            }

            .cart-hero h1 {
                font-size: 2.2rem;
            }

            .cart-item {
                grid-template-columns: 80px 1fr;
                gap: 15px;
                padding: 20px 0;
            }

            .cart-item-qty {
                grid-column: 2;
            }

            .cart-item-subtotal {
                grid-column: 1 / -1;
                text-align: left;
                border-top: 1px solid #f9f9f9;
                padding-top: 15px;
                margin-top: 5px;
            }

            .cart-hero p {
                font-size: 0.95rem;
                padding: 0 15px;
            }
        }

        @media (max-width: 480px) {
            .cart-item {
                grid-template-columns: 70px 1fr;
                gap: 12px;
            }

            .cart-item-img {
                width: 70px;
                height: 70px;
            }

            .cart-item-info h4 {
                font-size: 1rem;
            }

            .cart-items-container {
                padding: 15px;
            }

            .summary-card {
                padding: 20px;
            }

            .total-value {
                font-size: 1.5rem;
            }

            .cart-actions-header {
                flex-direction: column !important;
                gap: 15px !important;
                align-items: flex-start !important;
            }
        }

        @media (max-width: 400px) {
            .container {
                padding: 0 12px !important;
            }

            .cart-items-container {
                padding: 15px 10px !important;
            }

            .cart-grid {
                grid-template-columns: 1fr;
                position: relative;
            }

            .total-value {
                font-size: 1.5rem;
                font-weight: 900;
                color: #b0185e;
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
                <p>Review your divine selections before bringing them home. Every product is a step towards holistic
                    wellness.</p>
            </div>
        </div>

        <div class="container">
            @if (empty($cart))
                <div class="empty-cart-state" style="max-width: 600px; margin: 0 auto; padding: 30px 10px;">
                    <div class="empty-cart-icon" style="margin-bottom: 30px; opacity: 0.6;">
                        <i class="fas fa-shopping-basket" style="font-size: 4.5rem; color: #d4e1d4;"></i>
                    </div>
                    <h2 style="font-size: 2.2rem; color: #004200; margin-bottom: 15px;">Your Cart is Empty</h2>
                    <p style="color: #666; font-size: 1.05rem; line-height: 1.6; margin-bottom: 35px;">It seems you haven't
                        added any items to your cart yet. Explore our sacred collections and find something special for your
                        wellness journey.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary"
                        style="padding: 12px 35px; font-weight: 700; letter-spacing: 0.5px; box-shadow: 0 10px 20px rgba(0, 66, 0, 0.15);">
                        <i class="fas fa-store" style="font-size: 0.9rem; margin-right: 8px;"></i> Start Shopping
                    </a>
                </div>
            @else
                <!-- Header Actions -->
                <div class="cart-actions-header"
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <a href="{{ route('shop') }}" class="btn-continue-shopping">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                    <style>
                        .btn-continue-shopping {
                            color: var(--primary);
                            font-weight: 600;
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            padding: 10px 20px;
                            border: 1px solid var(--primary);
                            border-radius: 50px;
                            transition: all 0.3s ease;
                            text-decoration: none;
                        }

                        .btn-continue-shopping:hover {
                            background: var(--primary);
                            color: #fff !important;
                            box-shadow: 0 5px 15px rgba(0, 66, 0, 0.1);
                        }
                    </style>
                    <form action="{{ route('cart.clear') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-clear-cart"
                            style="color: #666; font-size: 0.9rem; text-decoration: underline; background: none; border: none; cursor: pointer;">
                            Clear Cart
                        </button>
                    </form>
                </div>

                {{-- <div style="margin-bottom: 30px;">
                    @if(session('success'))
                    <div
                        style="background: #f0fff4; border: 1px solid #c6f6d5; color: #2f855a; padding: 15px 25px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div
                        style="background: #fff5f5; border: 1px solid #fed7d7; color: #c53030; padding: 15px 25px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                    @endif
                    @if($errors->has('coupon'))
                    <div
                        style="background: #fffaf0; border: 1px solid #feebc8; color: #c05621; padding: 15px 25px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-ticket-alt"></i> {{ $errors->first('coupon') }}
                    </div>
                    @endif
                </div> --}}

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
                                        <button type="button" class="qty-btn"
                                            onclick="updateQty('{{ $item['product_id'] }}', -1)"><i
                                                class="fas fa-minus"></i></button>
                                        <input type="text" class="qty-input" value="{{ $item['quantity'] }}" readonly
                                            id="qty-{{ $item['product_id'] }}">
                                        <button type="button" class="qty-btn" onclick="updateQty('{{ $item['product_id'] }}', 1)"><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                    <form id="form-{{ $item['product_id'] }}" action="{{ route('cart.update') }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                        <input type="hidden" name="quantity" id="input-{{ $item['product_id'] }}">
                                    </form>
                                </div>
                                <div class="cart-item-subtotal">
                                    <div style="font-size: 1.4rem; font-weight: 800; color: #004200;">
                                        ₹{{ number_format($item['price'] * $item['quantity']) }}</div>
                                </div>

                                <div class="cart-item-actions-corner">

                                    <form action="{{ route('cart.remove') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                        <button type="submit" class="btn-action-small btn-remove-small confirm-delete"
                                            title="Remove Item">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary Panel -->
                    <div class="summary-card">
                        <div style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 25px;">
                            <div class="summary-row">
                                <span style="color: #666;">Items Subtotal</span>
                                <strong style="color: var(--primary);">₹{{ number_format($subtotal) }}</strong>
                            </div>

                            @if($discount > 0)
                                <div class="summary-row" style="color: #1b5e20;">
                                    <span style="font-weight: 600;">Coupon Discount</span>
                                    <strong>- ₹{{ number_format($discount) }}</strong>
                                </div>
                            @endif
                        </div>

                        <!-- Coupon Applied Box -->
                        @if($coupon)
                            <div
                                style="background: #f0fff4; border: 1px solid #c6f6d5; border-radius: 12px; padding: 15px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div
                                        style="width: 24px; height: 24px; background: #38a169; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem;">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div>
                                        <div style="color: #2f855a; font-weight: 800; font-size: 1rem; letter-spacing: 0.5px;">
                                            {{ $coupon->code }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #38a169; font-weight: 600;">Coupon Applied</div>
                                    </div>
                                </div>
                                <form action="{{ route('cart.coupon.remove') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit"
                                        style="color: #e53e3e; font-size: 0.85rem; font-weight: 700; background: none; border: none; cursor: pointer; text-decoration: none;">Remove</button>
                                </form>
                            </div>
                        @endif

                        <!-- Coupon Input (only if NOT applied) -->
                        @if(!$coupon)
                            <div style="margin-bottom: 25px;">
                                <form action="{{ route('cart.coupon.apply') }}" method="POST"
                                    style="display: flex; align-items: center; background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; padding: 4px;">
                                    @csrf
                                    <input type="text" name="code" placeholder="COUPON CODE"
                                        style="flex: 1; padding: 10px 15px; border: none; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; outline: none;"
                                        required>
                                    <button type="submit"
                                        style="background: var(--primary); color: white; border: none; padding: 0 20px; border-radius: 8px; font-weight: 700; font-size: 0.75rem; cursor: pointer; height: 38px;">APPLY</button>
                                </form>
                            </div>
                        @endif

                        <div
                            style="border-top: 1px dashed #e2e8f0; padding-top: 20px; margin-bottom: 20px; display: flex; flex-direction: column; gap: 12px;">
                            <div class="summary-row">
                                <span style="color: #718096; font-size: 0.95rem;">Product Value</span>
                                <strong
                                    style="color: #2d3748; font-weight: 600;">₹{{ number_format($taxable_value, 2) }}</strong>
                            </div>

                            <div class="summary-row">
                                <span style="color: #2d3748; font-weight: 700; font-size: 0.95rem;">Taxable Value</span>
                                <strong
                                    style="color: #2d3748; font-weight: 700;">₹{{ number_format($taxable_value, 2) }}</strong>
                            </div>

                            <div class="summary-row">
                                <span style="color: #718096; font-size: 0.95rem;">GST (18%)</span>
                                <strong style="color: #2d3748; font-weight: 600;">₹{{ number_format($gst_amount, 2) }}</strong>
                            </div>
                        </div>

                        <div class="summary-total"
                            style="background: #fff5f8; border: 1px solid #ffebeb; border-radius: 15px; padding: 5px 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 1.3rem; font-weight: 800; color: #b0185e;">Total</span>
                            <div class="total-value">₹{{ number_format($total, 0) }}</div>
                        </div>

                        @auth
                            <a href="{{ route('checkout') }}" class="btn-checkout"
                                style="display: block; width: 100%; padding: 20px; text-align: center; background: var(--primary); color: #fff; border-radius: 50px; font-weight: 700; letter-spacing: 1px;">
                                PROCEED TO CHECKOUT
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-checkout"
                                style="display: block; width: 100%; padding: 20px; text-align: center; background: var(--primary); color: #fff; border-radius: 50px; font-weight: 700; letter-spacing: 1px;">
                                LOGIN TO CHECKOUT <i class="fas fa-sign-in-alt" style="margin-left: 8px;"></i>
                            </a>
                            <p style="margin: 20px 0 0; color: #888; font-size: 0.85rem; text-align: center;">
                                New customer? <a href="{{ route('register') }}"
                                    style="color: var(--primary); font-weight: 700;">Join Auvri Plus</a>
                            </p>
                        @endauth

                        <div style="margin-top: 30px; text-align: center; opacity: 0.5;">
                            <img src="https://checkout.razorpay.com/v1/checkout.js" alt="" style="display:none;">
                            <i class="fab fa-cc-visa" style="font-size: 24px; margin: 0 8px;"></i>
                            <i class="fab fa-cc-mastercard" style="font-size: 24px; margin: 0 8px;"></i>
                            <i class="fas fa-shield-alt" style="font-size: 20px; margin: 0 8px;"></i>
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

        $(document).ready(function () {
            // Confirm Item Removal
            $('.confirm-delete').on('click', function (e) {
                e.preventDefault();
                const $form = $(this).closest('form');

                Swal.fire({
                    title: 'Remove this item?',
                    text: "You can always add it back later!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#004200',
                    cancelButtonColor: '#ff5252',
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'No, keep it',
                    background: '#fff',
                    borderRadius: '24px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $form.submit();
                    }
                });
            });

            // Confirm Clear Cart
            $('.btn-clear-cart').on('click', function (e) {
                e.preventDefault();
                const $form = $(this).closest('form');

                Swal.fire({
                    title: 'Clear your entire cart?',
                    text: "This will remove all items from your basket.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#004200',
                    cancelButtonColor: '#666',
                    confirmButtonText: 'Yes, clear it',
                    cancelButtonText: 'Wait, keep them',
                    background: '#fff',
                    borderRadius: '24px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $form.submit();
                    }
                });
            });
        });
    </script>
@endsection