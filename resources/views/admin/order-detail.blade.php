@extends('layouts.admin')

@section('page_title', 'Order Invoice #' . $order->order_number)

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.98);
        --glass-border: rgba(230, 230, 230, 0.6);
        --accent-dark: #1a1a1a;
        --accent-muted: #8892b0;
    }

    body {
        font-family: 'Outfit', sans-serif;
    }

    .order-header-premium-box {
        background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        padding: 40px 30px 80px;
        color: #fff;
        border-radius: 20px;
        margin-bottom: -40px;
        position: relative;
        overflow: hidden;
    }

    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        padding: 40px;
        position: relative;
        z-index: 10;
    }

    .status-tracker {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        position: relative;
    }

    .status-tracker::before {
        content: '';
        position: absolute;
        top: 15px; left: 10%; right: 10%;
        height: 2px; background: #eee;
        z-index: 1;
    }

    .step {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }

    .step-icon {
        width: 32px; height: 32px;
        background: #fff;
        border: 2px solid #eee;
        border-radius: 50%;
        margin: 0 auto 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; color: #ccc;
    }

    .step.active .step-icon {
        border-color: var(--primary);
        background: var(--primary);
        color: #fff;
        box-shadow: 0 0 10px rgba(0, 66, 0, 0.2);
    }

    .step span { 
        font-size: 10px; 
        text-transform: uppercase; 
        color: #94a3b8; 
        letter-spacing: 0.5px; 
        display: block;
        font-weight: 500;
    }

    .step.active span { color: var(--accent-dark); font-weight: 700; }

    .summary-label {
        display: block;
        font-size: 11px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .summary-value {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
    }

    .ledger-table th {
        padding: 15px 10px;
        border-bottom: 2px solid #f1f5f9;
        font-size: 11px;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 800;
    }

    .ledger-table td {
        padding: 20px 10px;
        border-bottom: 1px solid #f8fafc;
        transition: background 0.2s;
    }

    .ledger-table tr:hover td {
        background: #fcfcfc;
    }

    @media print {
        .admin-sidebar, .top-bar, .order-header-premium-box, .status-tracker, .d-print-none {
            display: none !important;
        }
        
        body {
            background: white !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .glass-card {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
        }

        @page {
            size: A4;
            margin: 1cm;
        }
    }
</style>
@endsection

@section('content')
<div class="premium-admin-invoice">
    <div class="order-header-premium-box d-print-none">
        <div style="display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <div class="breadcrumb" style="font-size: 12px; opacity: 0.6; margin-bottom: 8px;">
                    <span>Admin</span> / <span>Orders</span> / <span>Invoice</span>
                </div>
                <h1 style="font-size: 32px; font-weight: 800; margin: 0; letter-spacing: -0.5px; color: #fff;">Order Invoice</h1>
                <p style="opacity: 0.7; font-size: 14px; margin: 5px 0 0; color: #fff;">#{{ $order->order_number }}</p>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('admin.orders') }}" class="admin-btn admin-btn-ghost" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff; box-shadow: none;">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>
                <a href="{{ route('admin.orders.download', $order) }}" class="admin-btn" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; border: none; text-decoration: none; display: flex; align-items: center; justify-content: center; padding: 0 20px; border-radius: 8px; font-weight: 600; font-size: 14px;">
                    <i class="fas fa-file-pdf" style="margin-right: 8px;"></i> PDF Invoice
                </a>
                <button onclick="window.print()" class="admin-btn" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; border: none; display: flex; align-items: center; justify-content: center; padding: 0 20px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer;">
                    <i class="fas fa-print" style="margin-right: 8px;"></i> Print Invoice
                </button>
            </div>
        </div>
    </div>

    <div style="padding: 0 10px;">
        {{-- Progress Area --}}
        <div class="glass-card d-print-none" style="margin-bottom: 25px; padding: 25px; border-radius: 20px;">
            <div class="status-tracker">
                <div class="step active">
                    <div class="step-icon">1</div>
                    <span>Placed</span>
                </div>
                <div class="step {{ in_array($order->status, ['processing', 'shipped', 'delivered', 'completed']) ? 'active' : '' }}">
                    <div class="step-icon">2</div>
                    <span>Process</span>
                </div>
                <div class="step {{ in_array($order->status, ['shipped', 'delivered', 'completed']) ? 'active' : '' }}">
                    <div class="step-icon">3</div>
                    <span>Shipped</span>
                </div>
                <div class="step {{ in_array($order->status, ['delivered', 'completed']) ? 'active' : '' }}">
                    <div class="step-icon">4</div>
                    <span>Delivered</span>
                </div>
            </div>
        </div>

        {{-- Invoice Card --}}
        <div class="glass-card" id="invoice-area">
            
            {{-- Brand Header --}}
            <div class="invoice-box-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px;">
                <div>
                    <img src="{{ asset('auri-images/logo.png') }}" alt="Auvri Plus" style="max-height: 70px; margin-bottom: 15px;">
                    <h2 style="font-size: 24px; font-weight: 800; color: #000; margin: 0;">Auvri Plus</h2>
                    <p style="font-size: 13px; color: #64748b; margin: 5px 0;">GSTIN: XXXXXXXXXXXXX</p>
                </div>
                <div style="text-align: right;">
                    <h5 style="background: #f1f5f9; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; color: #475569; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 10px; display: inline-block;">Tax Invoice</h5>
                    <h3 style="font-size: 22px; font-weight: 700; margin: 0; color: var(--primary);">#{{ $order->order_number }}</h3>
                    <p style="font-size: 13px; color: #94a3b8; margin: 4px 0;">Invoice Date: <strong>{{ $order->created_at->format('d M, Y') }}</strong></p>
                    <p style="font-size: 13px; color: #94a3b8; margin: 4px 0;">Payment Status: <strong style="color: {{ $order->payment_status == 'paid' ? '#059669' : '#dc2626' }};">{{ strtoupper($order->payment_status) }}</strong></p>
                </div>
            </div>

            <div style="height: 1px; background: #f1f5f9; margin-bottom: 35px;"></div>

            {{-- Address Information --}}
            <div class="address-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; margin-bottom: 40px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <span class="summary-label">Billing Details</span>
                        <div class="summary-value">
                            <strong style="display: block; color: #000; margin-bottom: 4px; font-size: 15px;">{{ $order->customer_name }}</strong>
                            {{ $order->customer_email }}<br>
                            {{ $order->phone }}<br>
                            {{ $order->address_line1 }}<br>
                            @if($order->address_line2) {{ $order->address_line2 }}<br> @endif
                            {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}
                        </div>
                    </div>
                    <div>
                        <span class="summary-label">Shipping Details</span>
                        <div class="summary-value">
                            <strong style="display: block; color: #000; margin-bottom: 4px; font-size: 15px;">{{ $order->customer_name }}</strong>
                            {{ $order->phone }}<br>
                            {{ $order->address_line1 }}<br>
                            @if($order->address_line2) {{ $order->address_line2 }}<br> @endif
                            {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}
                        </div>
                    </div>
                </div>
                <div>
                    <span class="summary-label">Order Insights</span>
                    <div style="background: #f8fafc; padding: 20px; border-radius: 16px; font-size: 14px; border: 1px solid #f1f5f9;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                            <span style="color: #64748b;">Order Status</span>
                            <span class="status-badge {{ $order->status == 'completed' || $order->status == 'delivered' ? 'status-success' : 'status-warning' }}" style="padding: 4px 10px; font-size: 9px; min-width: auto;">{{ strtoupper($order->status) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                            <span style="color: #64748b;">Method</span>
                            <strong style="color: #1e293b;">Online</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px dashed #e2e8f0;">
                            <span style="font-weight: 600; color: #1e293b;">Amount Paid</span>
                            <strong style="color: var(--primary); font-size: 18px;">₹{{ number_format($order->amount, 0) }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive" style="margin-bottom: 40px;">
                <table class="ledger-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="width: 40px; text-align: left;">S.No</th>
                            <th style="width: 80px; text-align: center;">Image</th>
                            <th style="text-align: left;">Product Name</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Unit Price</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->items && $order->items->count() > 0)
                            @foreach($order->items as $item)
                            <tr>
                                <td style="color: #cbd5e1; text-align: left;">{{ $loop->iteration }}</td>
                                <td style="text-align: center;">
                                    @if($item->product && $item->product->primary_image)
                                        <img src="{{ asset($item->product->primary_image) }}" alt="{{ $item->product_name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                            <i class="fas fa-image" style="color: #cbd5e1;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong style="display: block; color: #1e293b; font-size: 14px;">{{ $item->product_name }}</strong>
                                    <span style="font-size: 11px; color: #94a3b8; display: block; margin-top: 2px;">HSN: {{ $item->hsn ?? $item->product?->hsn ?? '3004' }}</span>
                                </td>
                                <td style="text-align: center; color: #1e293b; font-weight: 600;">{{ $item->quantity }}</td>
                                <td style="text-align: right; color: #64748b;">₹{{ number_format($item->unit_price, 0) }}</td>
                                <td style="text-align: right; color: #000; font-weight: 800;">₹{{ number_format($item->line_total, 0) }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td style="color: #cbd5e1; text-align: left;">1</td>
                                <td>
                                    <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                        <i class="fas fa-box" style="color: #cbd5e1;"></i>
                                    </div>
                                </td>
                                <td>
                                    <strong style="display: block; color: #1e293b; font-size: 14px;">{{ $order->product_name }}</strong>
                                    <span style="font-size: 11px; color: #94a3b8; display: block; margin-top: 2px;">HSN: 3004</span>
                                </td>
                                <td style="text-align: center; color: #1e293b; font-weight: 600;">{{ $order->quantity }}</td>
                                <td style="text-align: right; color: #64748b;">₹{{ number_format($order->amount / max($order->quantity, 1), 0) }}</td>
                                <td style="text-align: right; color: #000; font-weight: 800;">₹{{ number_format($order->amount, 0) }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Totals Area --}}
            <div style="display: flex; justify-content: flex-end;">
                <div style="width: 320px;">
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; font-size: 14px; color: #64748b; border-bottom: 1px solid #f1f5f9;">
                        <span>Items Subtotal</span>
                        <strong style="color: #333;">₹{{ number_format($order->items->count() > 0 ? $order->items->sum('line_total') : $order->amount, 0) }}</strong>
                    </div>
                    
                    @if($order->discount_amount > 0)
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; font-size: 14px; color: #dc2626; border-bottom: 1px solid #f1f5f9;">
                        <span>Discount @if($order->coupon_code) ({{ $order->coupon_code }}) @endif</span>
                        <strong>- ₹{{ number_format($order->discount_amount, 0) }}</strong>
                    </div>
                    @endif

                    <div style="display: flex; justify-content: space-between; padding: 12px 0; font-size: 14px; color: #64748b; border-bottom: 1px solid #f1f5f9;">
                        <span>Shipping Charges</span>
                        <strong style="color: #333;">₹{{ number_format($order->shipping_amount, 0) }}</strong>
                    </div>

                    @if($order->shipping_discount > 0)
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; font-size: 14px; color: #2e7d32; border-bottom: 1px solid #f1f5f9;">
                        <span>Shipping Discount</span>
                        <strong>- ₹{{ number_format($order->shipping_discount, 0) }}</strong>
                    </div>
                    @endif

                    <div style="display: flex; justify-content: space-between; padding: 12px 0; font-size: 14px; color: #64748b; border-bottom: 1px solid #f1f5f9;">
                        <span>Shipping Amount</span>
                        <strong style="color: var(--primary-dark);">₹{{ number_format($order->shipping_amount - $order->shipping_discount, 0) }}</strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 25px 0; align-items: flex-end;">
                        <span style="font-size: 16px; font-weight: 700; color: #1e293b;">Total Amount</span>
                        <strong style="font-size: 28px; font-weight: 900; color: var(--primary);">₹{{ number_format($order->amount, 0) }}</strong>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div style="margin-top: 80px; display: flex; justify-content: space-between; align-items: flex-end;">
                <div style="max-width: 450px;">
                    <h6 style="font-size: 11px; font-weight: 800; color: #1e293b; text-transform: uppercase; margin-bottom: 12px; letter-spacing: 1px;">Declaration</h6>
                    <p style="font-size: 11px; color: #94a3b8; line-height: 1.8; margin: 0;">
                        This is a computer generated invoice and does not require a physical signature. The items listed above are for the sole use of the customer and are not for resale. Goods once sold cannot be returned unless found damaged upon arrival.
                    </p>
                </div>
                <div style="text-align: center; width: 160px;">
                    <div style="border-bottom: 2px solid #1a1a1a; margin-bottom: 10px;"></div>
                    <p style="font-size: 12px; font-weight: 800; color: #1a1a1a; margin: 0;">Authorized Rep</p>
                    <p style="font-size: 10px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Auvri Plus</p>
                </div>
            </div>
        </div>
        
        <div class="d-print-none" style="text-align: center; margin-top: 40px; padding-bottom: 40px;">
            <p style="font-size: 13px; color: #94a3b8;">Generated from Admin Terminal | {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>
</div>
@endsection
