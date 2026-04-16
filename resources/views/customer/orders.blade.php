@extends('layouts.auri')

@section('title', 'My Orders | Auvri Plus')

@section('content')
    <div class="luxury-account-page">
        <div class="container">
            <!-- Page Header -->
            <div class="account-page-header">
                <h1 class="account-title">My Orders</h1>
                <div class="account-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <a href="{{ route('customer.dashboard') }}">Account</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <span>Orders</span>
                </div>
            </div>

            <div class="account-grid">
                <!-- Sidebar -->
                <aside class="account-sidebar-col">
                    @include('customer.sidebar')
                </aside>

                <!-- Main Content -->
                <div class="account-main-content">
                    <div class="section-card">
                        <div class="section-header-flex">
                            <h3 class="premium-section-title">Order History</h3>
                            <span class="order-count">{{ $orders->total() }} Total Orders</span>
                        </div>

                        @if($orders->count() > 0)
                            <div class="luxury-order-grid">
                                @foreach($orders as $order)
                                    <div class="luxury-order-card">
                                        <div class="order-card-header">
                                            <div class="id-date">
                                                <span class="order-number">#{{ $order->order_number }}</span>
                                                <span class="order-date">{{ $order->created_at->format('M d, Y') }}</span>
                                            </div>
                                            <span class="status-badge status-{{ strtolower($order->status) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <div class="order-card-body">
                                            <div class="info-item">
                                                <span class="label">Payment Status:</span>
                                                <span class="pmt-badge {{ strtolower($order->payment_status) == 'paid' ? 'pmt-paid' : 'pmt-unpaid' }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </div>
                                            <div class="info-item">
                                                <span class="label">Order Amount:</span>
                                                <span class="price">₹{{ number_format($order->amount, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="order-card-footer">
                                            <a href="{{ route('customer.orders.show', $order) }}" class="btn-action view-btn">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            <a href="{{ route('customer.orders.download', $order) }}" class="btn-action download-btn" title="Download Invoice">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="luxury-pagination">
                                {{ $orders->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                                <p>You haven't placed any orders yet.</p>
                                <a href="{{ route('shop') }}" class="btn btn-premium">Start Shopping</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Orders Page Specific Styles */
        .luxury-account-page {
            background: var(--beige-light);
            padding: 60px 0 100px;
            min-height: 80vh;
        }

        .account-page-header {
            margin-bottom: 40px;
            margin-top: 30px;
        }

        .account-title {
            font-size: 38px;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .account-breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #888;
        }

        .account-breadcrumb a {
            color: var(--primary);
            font-weight: 600;
        }

        .account-breadcrumb .separator {
            font-size: 10px;
            opacity: 0.5;
        }

        /* Layout Grid */
        .account-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 40px;
            align-items: start;
        }

        /* Section Card */
        .section-card {
            background: #fff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--beige-soft);
        }

        .section-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 1px solid var(--beige-light);
            padding-bottom: 20px;
        }

        .premium-section-title {
            font-size: 24px;
            color: var(--primary);
            margin: 0;
        }

        .order-count {
            font-size: 14px;
            color: #888;
            background: var(--beige-light);
            padding: 5px 15px;
            border-radius: 50px;
        }

        /* Luxury Order Grid */
        .luxury-order-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .luxury-order-card {
            background: #fff;
            border: 1px solid var(--beige-soft);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .luxury-order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-color: var(--primary);
        }

        .order-card-header {
            padding: 20px;
            background: var(--luxury-green-soft);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .id-date {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .order-number {
            font-weight: 800;
            color: var(--primary);
            font-size: 16px;
        }

        .order-date {
            font-size: 13px;
            color: #888;
        }

        .order-card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-item .label {
            font-size: 13px;
            color: #888;
            font-weight: 500;
        }

        .info-item .price {
            font-weight: 800;
            color: #333;
            font-size: 16px;
        }

        .order-card-footer {
            padding: 15px 20px;
            background: #fafafa;
            border-top: 1px solid #f5f5f5;
            display: flex;
            gap: 12px;
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .view-btn {
            background: var(--primary);
            color: #fff !important;
            flex: 1;
            gap: 8px;
        }

        .view-btn:hover {
            background: #003300;
        }

        .download-btn {
            background: #fff;
            color: var(--primary) !important;
            border: 1px solid var(--beige-soft);
            width: 42px;
        }

        .download-btn:hover {
            background: #f8f8f8;
            border-color: var(--primary);
        }

        .pmt-badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .pmt-paid {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .pmt-unpaid {
            background: #fff3e0;
            color: #ef6c00;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-pending { background: #fff8e1; color: #ffa000; }
        .status-completed { background: #e8f5e9; color: #2e7d32; }
        .status-shipped { background: #e3f2fd; color: #1976d2; }
        .status-cancelled { background: #ffebee; color: #d32f2f; }

        @media (max-width: 768px) {
            .luxury-order-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Luxury Pagination */
        .luxury-pagination {
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }

        .luxury-pagination .pagination {
            display: flex !important;
            flex-direction: row !important;
            align-items: center;
            gap: 10px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .luxury-pagination .page-item {
            margin: 0;
        }

        .luxury-pagination .page-link {
            width: 44px;
            height: 44px;
            display: flex !important;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            border: 1px solid var(--beige-soft) !important;
            background: #fff !important;
            color: var(--primary) !important;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            padding: 0 !important;
            line-height: 1;
        }

        .luxury-pagination .page-item.active .page-link {
            background: var(--primary) !important;
            color: #fff !important;
            border-color: var(--primary) !important;
            box-shadow: 0 8px 20px rgba(0, 66, 0, 0.2);
            transform: scale(1.1);
        }

        .luxury-pagination .page-item:not(.active):not(.disabled):hover .page-link {
            background: var(--primary) !important;
            color: #fff !important;
            border-color: var(--primary) !important;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .luxury-pagination .page-item.disabled .page-link {
            opacity: 0.4;
            background: #f9f9f9 !important;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Prev/Next Icon Adjustments */
        .luxury-pagination .page-link span {
            font-size: 18px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            font-size: 80px;
            color: var(--beige-dark);
            margin-bottom: 25px;
        }

        .btn-premium {
            background: var(--primary);
            color: #fff;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            margin-top: 25px;
            display: inline-block;
        }

        @media (max-width: 1200px) {
            .account-grid {
                grid-template-columns: 280px 1fr;
                gap: 25px;
            }

            .section-card {
                padding: 25px;
            }

            .luxury-table td,
            .luxury-table th {
                padding: 15px 10px;
                font-size: 14px;
            }

            .order-id {
                font-size: 13px;
            }
        }

        @media (max-width: 991px) {
            .account-grid {
                grid-template-columns: 1fr;
            }

            .account-title {
                font-size: 32px;
            }
        }

        @media (max-width: 768px) {
            .luxury-account-page .container {
                padding-left: 15px !important;
                padding-right: 15px !important;
                width: 100% !important;
                max-width: 100% !important;
            }
        }

        @media (max-width: 600px) {
            .luxury-account-page {
                padding: 30px 0 80px;
            }

            .account-title {
                font-size: 28px;
            }

            .section-card {
                padding: 20px;
            }

            .premium-section-title {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .luxury-account-page .container {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
        }
    </style>
@endsection