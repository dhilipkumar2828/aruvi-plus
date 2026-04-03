@extends('layouts.auri')

@section('title', 'Order Successful | Auvri Plus')

@section('extra_css')
<style>
    :root {
        --primary: #004200;
        --accent: #d4af37;
    }

    .success-section {
        padding: 120px 0 80px;
        text-align: center;
        background: #f8faf8;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    .success-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 60px 40px;
        border-radius: 32px;
        background: #ffffff;
        box-shadow: 0 20px 60px rgba(0, 66, 0, 0.06);
        border: 1px solid rgba(0, 66, 0, 0.05);
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: var(--primary);
        color: var(--accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        margin: 0 auto 30px;
        box-shadow: 0 10px 20px rgba(0, 66, 0, 0.15);
        animation: scaleUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes scaleUp {
        0% { transform: scale(0); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .success-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .success-message {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 35px;
    }

    .order-info {
        background: #f0f4f0;
        padding: 25px;
        border-radius: 20px;
        margin-bottom: 40px;
        border: 1px dashed rgba(0, 66, 0, 0.2);
    }

    .order-info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 1rem;
    }

    .order-info-label {
        color: #666;
        font-weight: 500;
    }

    .order-info-value {
        color: var(--primary);
        font-weight: 700;
    }

    .btn-continue-shop, .btn-view-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        min-width: 240px;
        padding: 18px 25px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0, 66, 0, 0.2);
        letter-spacing: 1px;
    }

    .btn-continue-shop:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0, 66, 0, 0.3);
        background: #003300;
    }

    .btn-view-order {
        background: #fff;
        color: var(--primary) !important;
        border: 1px solid var(--primary);
        box-shadow: none; /* Secondary action */
    }

    .btn-view-order:hover {
        background: var(--primary);
        color: #fff !important;
        box-shadow: 0 10px 20px rgba(0, 66, 0, 0.2);
    }

    .actions {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    @media (max-width: 640px) {
        .success-container {
            margin: 0 15px;
            padding: 40px 20px;
        }
        
        .actions {
            flex-direction: column;
            gap: 15px;
        }

        .btn-continue-shop, .btn-view-order {
            display: flex;
            margin: 10px 0;
            width: 100%;
            min-width: unset;
        }

        .btn-view-order {
            margin-left: 0;
        }
    }
</style>
@endsection

@section('content')
<section class="success-section">
    <div class="container">
        <div class="success-container">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            
            <h1 class="success-title">Order Successful!</h1>
            <p class="success-message" style="text-align: center; font-size: 16px;">
                Thank you for your purchase. Your order has been successfully placed and is being processed.
            </p>

            <div class="order-info">
                <div class="order-info-item">
                    <span class="order-info-label">Order Number:</span>
                    <span class="order-info-value">#{{ $order->order_number }}</span>
                </div>
                <div class="order-info-item">
                    <span class="order-info-label">Items Subtotal:</span>
                    <span class="order-info-value">{{ format_inr($order->items->sum('line_total')) }}</span>
                </div>
                @if($order->discount_amount > 0)
                <div class="order-info-item" style="color: #2e7d32;">
                    <span class="order-info-label">Coupon Savings @if($order->coupon_code) ({{ $order->coupon_code }}) @endif:</span>
                    <span class="order-info-value">-{{ format_inr($order->discount_amount) }}</span>
                </div>
                @endif
                @if($order->shipping_amount > 0)
                <div class="order-info-item">
                    <span class="order-info-label">Shipping:</span>
                    <span class="order-info-value">{{ format_inr($order->shipping_amount - $order->shipping_discount) }}</span>
                </div>
                @endif
                <div class="order-info-item" style="border-top: 1px dashed #ced4ce; padding-top: 10px; margin-top: 10px;">
                    <span class="order-info-label" style="font-size: 1.2rem; color: var(--primary);">Final Payable:</span>
                    <span class="order-info-value" style="font-size: 1.2rem;">{{ format_inr($order->amount) }}</span>
                </div>
                <div class="order-info-item">
                    <span class="order-info-label">Date:</span>
                    <span class="order-info-value">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('shop') }}" class="btn-continue-shop">
                    <i class="fas fa-shopping-cart"></i> CONTINUE SHOPPING
                </a>
                <a href="{{ route('customer.orders.show', $order->id) }}" class="btn-view-order">
                    <i class="fas fa-file-invoice"></i> VIEW ORDER
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
