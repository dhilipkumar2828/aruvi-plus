@extends('layouts.auri')

@section('title', 'My Dashboard | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('styles')
<style>
    @media (max-width: 768px) {
        .table-responsive {
            margin-bottom: 40px !important; /* Added bottom space for mobile */
        }
    }
</style>
@endsection

@section('content')
<section class="hero-small" style="background-image: url('{{ asset('images/sage_bg_full.jpg') }}'); margin-bottom: 0;">
    <div class="hero-overlay"></div>
    <div class="container">
        <h1 class="page-title" style="color: #fff; position: relative; z-index: 2;">My Account</h1>
        <div class="breadcrumb" style="position: relative; z-index: 2;">
            <a href="{{ url('/') }}" style="color: #eee;">Home</a> <span style="color: #ccc;">/</span> <strong style="color: #fff;">My Account</strong>
        </div>
    </div>
</section>

<main class="main-content" style="padding-top: 0;">

    <div class="container account-container">
        <div class="account-layout">
            <div class="account-sidebar-col">
                @include('customer.sidebar')
            </div>
            <div class="account-main-content">
                <h3 class="account-section-title">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </h3>
                
                <div class="account-card">
                    <div class="welcome-msg" style="font-size: 15px; line-height: 1.8; color: #555;">
                        <p>Hello, <strong style="color: var(--primary-color);">{{ $user->name }}</strong></p>
                        <p>From your account dashboard. you can easily check & view your <a href="{{ route('customer.orders') }}" style="color: var(--primary-color); font-weight: 600;">recent orders</a>, manage your <a href="{{ route('customer.address') }}" style="color: var(--primary-color); font-weight: 600;">shipping and billing addresses</a> and <a href="{{ route('customer.details') }}" style="color: var(--primary-color); font-weight: 600;">edit your password and account details</a>.</p>
                    </div>
                </div>

                <h4 style="font-size: 18px; font-weight: 700; margin-bottom: 20px;">Recently Ordered:</h4>
                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 0;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #FF9800, #C2185B);">
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #fff;">S.No</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #fff;">Order Id</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #fff;">Date</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #fff;">Status</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #fff;">Total</th>
                                    <th style="padding: 15px; text-align: center; font-weight: 600; color: #fff;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <td style="padding: 15px; color: #555;">{{ $loop->iteration }}</td>
                                        <td style="padding: 15px; color: #555;">#{{ $order->order_number }}</td>
                                        <td style="padding: 15px; color: #555; white-space: nowrap;">{{ $order->created_at->format('d-m-Y') }}</td>
                                        <td style="padding: 15px;">
                                            <span style="padding: 5px 10px; border-radius: 4px; font-size: 12px; background: #eee; color: #555;">{{ ucfirst($order->status) }}</span>
                                        </td>
                                        <td style="padding: 15px; font-weight: 600; color: #333;">₹{{ number_format($order->amount, 0) }}</td>
                                        <td style="padding: 15px; text-align: center; display: flex; gap: 8px; justify-content: center;">
                                            <a href="{{ route('customer.orders.show', $order) }}" title="View Invoice" class="btn-premium btn-premium-sm" style="padding: 0; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #FF9800, #C2185B); border: none;">
                                                <i class="fas fa-file-invoice" style="font-size: 14px; color: #fff;"></i>
                                            </a>
                                            <a href="{{ route('customer.orders.download', $order) }}" title="Download PDF" class="btn-premium btn-premium-sm" style="padding: 0; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #FF9800, #C2185B); border: none;">
                                                <i class="fas fa-file-pdf" style="font-size: 14px; color: #fff;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="background: #f9f9f9; padding: 30px; border-radius: 8px; text-align: center; color: #777;">
                        <i class="fas fa-shopping-bag" style="font-size: 40px; margin-bottom: 15px; color: #ddd;"></i>
                        <p>No recent orders found.</p>
                        <a href="{{ route('shop') }}" class="btn" style="margin-top: 15px; padding: 10px 25px; font-size: 14px;">Shop Now</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
