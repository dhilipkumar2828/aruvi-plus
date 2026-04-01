@extends('layouts.auri')

@section('title', 'Order Successful | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('styles')
<style>
    .success-section {
        padding: 150px 0 80px; /* Increased top padding to clear sticky header */
        text-align: center;
        background: #fff;
    }

    .success-container {
        max-width: 800px; /* Increased card width */
        margin: 0 auto;
        padding: 60px 40px;
        border-radius: 30px;
        background: #ffffff;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        margin: 0 auto 30px;
        box-shadow: 0 10px 20px rgba(46, 204, 113, 0.2);
        animation: scaleUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes scaleUp {
        0% { transform: scale(0); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .success-title {
        font-family: 'Outfit', sans-serif;
        font-size: 32px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .success-message {
        font-size: 18px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .order-info {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 20px;
        margin-bottom: 40px;
        border: 1px dashed #ddd;
    }

    .order-info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .order-info-item:last-child {
        margin-bottom: 0;
    }

    .order-info-label {
        color: #888;
        font-weight: 500;
    }

    .order-info-value {
        color: #333;
        font-weight: 700;
    }

    .btn-continue-shop {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 16px 35px;
        border-radius: 50px;
        background: linear-gradient(135deg, #C2185B, #880E4F);
        color: white;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(194, 24, 91, 0.2);
    }

    .btn-continue-shop:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(194, 24, 91, 0.3);
        color: white;
    }

    .btn-view-order {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 16px 35px;
        border-radius: 50px;
        background: #f0f0f0;
        color: #333;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-left: 15px;
    }

    .btn-view-order:hover {
        background: #e0e0e0;
        color: #000;
    }

    @media (max-width: 640px) {
        .success-section {
            padding: 110px 0 60px; /* Adjusted for mobile header/space */
        }
        .success-container {
            margin: 0 15px;
            padding: 40px 20px;
        }
        
        .btn-continue-shop, .btn-view-order {
            display: flex;
            margin: 10px 0;
            width: 100%;
            justify-content: center;
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
                    <span class="order-info-value">{{ $order->order_number }}</span>
                </div>
                <div class="order-info-item">
                    <span class="order-info-label">Order Total:</span>
                    <span class="order-info-value">{{ format_inr($order->amount) }}</span>
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
