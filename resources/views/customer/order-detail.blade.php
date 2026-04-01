@extends('layouts.auri')

@section('title', 'Order Details #' . $order->order_number . ' | Bogar Siddha Peedam - Bogar Alchemist LLP')

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
        background-color: #f8fafc;
    }

    /* Use a div instead of header to avoid global header CSS conflicts */
    .order-header-premium-box {
        background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        padding: 60px 0 100px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    /* Ensure it doesn't overlap with the fixed top menu by adding padding-top */
    .premium-order-page {
        padding-top: 100px; /* Offset for fixed global header */
    }

    .content-wrapper-shifted {
        margin-top: -60px;
        position: relative;
        z-index: 10;
        padding-bottom: 60px;
    }

    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        padding: 30px;
        position: relative;
    }

    /* Status Tracker Mobile Optimization */
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
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: #fff;
        box-shadow: 0 0 10px rgba(194, 24, 91, 0.2);
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

    /* Summary Labels */
    .summary-label { 
        font-size: 11px; 
        font-weight: 800; 
        color: #94a3b8; 
        text-transform: uppercase; 
        letter-spacing: 1px; 
        margin-bottom: 8px; 
        display: block; 
    }

    .summary-value { font-size: 14px; color: #334155; line-height: 1.6; }

    /* Table Mobile View */
    @media (max-width: 768px) {
        .premium-order-page { padding-top: 80px; }
        .order-header-premium-box { padding: 40px 0 80px; text-align: center; }
        .order-header-premium-box .header-flex { flex-direction: column; gap: 20px; align-items: center !important; }
        .glass-card { padding: 20px; border-radius: 12px; }
        
        .invoice-box-header { flex-direction: column; text-align: center; gap: 20px; }
        .invoice-box-header > div { width: 100%; text-align: center !important; }
        .invoice-box-header img { display: block; margin: 0 auto 15px; }
        .invoice-box-header div:last-child { text-align: center !important; }
        
        .address-grid { grid-template-columns: 1fr !important; gap: 30px !important; }
        .meta-grid { grid-template-columns: 1fr !important; }
        
        .ledger-table thead { display: none; }
        .ledger-table tr { display: block; padding: 15px 0; border-bottom: 1px solid #f1f5f9; }
        .ledger-table td { 
            display: flex; 
            justify-content: space-between; 
            padding: 5px 0 !important; 
            text-align: right !important;
            font-size: 13px;
        }
        .ledger-table td::before {
            content: attr(data-label);
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            font-size: 11px;
            text-align: left;
        }
        .ledger-table td.product-cell { 
            flex-direction: column; 
            text-align: left !important; 
            align-items: flex-start;
            margin-bottom: 10px;
        }
        .ledger-table td.product-cell::before { display: none; }
        
        .totals-wrapper { width: 100% !important; }
        .invoice-footer-meta { flex-direction: column; text-align: center; gap: 30px; }
        .invoice-footer-meta div:last-child { margin: 0 auto; }
        
        .btn-action-glass-premium { width: 100%; border-radius: 8px; justify-content: center; }
    }

    .ledger-table td { padding: 20px 10px; border-bottom: 1px solid #f8fafc; transition: background 0.2s; }
    .ledger-table tr:hover td { background: #fcfcfc; }

    @media print {
        /* Hide everything except the invoice area */
        header, footer, .order-header-premium-box, .account-sidebar-col, .d-print-none, .status-tracker, .btn-action-glass-premium {
            display: none !important;
        }
        
        body {
            background: white !important;
            margin: 0 !important;
            padding: 0 !important;
            font-family: 'Outfit', sans-serif !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .premium-order-page {
            padding-top: 0 !important;
        }

        .content-wrapper-shifted {
            margin-top: 0 !important;
            padding: 0 !important;
        }

        .container {
            width: 100% !important;
            max-width: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .account-layout {
            display: block !important;
            margin: 0 !important;
        }

        .account-main-content {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
        }

        .glass-card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            background: white !important;
            backdrop-filter: none !important;
        }

        #invoice-area {
            padding: 20px !important;
            width: 100% !important;
            box-sizing: border-box;
        }

        /* HARD FIX: Force Flex/Grid items to be side-by-side in Print */
        .invoice-box-header {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: flex-start !important;
            margin-bottom: 30px !important;
            text-align: left !important;
        }

        .invoice-box-header div:last-child {
            text-align: right !important;
        }

        .address-grid {
            display: grid !important;
            grid-template-columns: 2fr 1fr !important;
            gap: 40px !important;
            margin-bottom: 30px !important;
            text-align: left !important;
        }

        .meta-grid {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 20px !important;
        }

        .invoice-footer-meta {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: flex-end !important;
            text-align: left !important;
        }

        /* Force table contents back to standard view */
        .ledger-table thead { display: table-header-group !important; }
        .ledger-table tr { display: table-row !important; }
        .ledger-table td { display: table-cell !important; text-align: left !important; }
        .ledger-table td.product-cell { text-align: left !important; }
        .ledger-table td::before { display: none !important; }

        .ledger-table th {
            background-color: #f8fafc !important;
            border-bottom: 2px solid #e2e8f0 !important;
        }

        .ledger-table td {
            border-bottom: 1px solid #f1f5f9 !important;
        }

        /* Prevent ugly page breaks */
        .invoice-box-header, .address-grid, .totals-wrapper, .invoice-footer-meta, tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        /* Ensure fonts are legible */
        h1, h2, h3, h5, strong {
            color: #000 !important;
        }

        .summary-label {
            color: #64748b !important;
        }

        @page {
            size: A4;
            margin: 1cm;
        }
    }
</style>
@endsection

@section('content')
<div class="premium-order-page">
    <div class="order-header-premium-box d-print-none">
        <div class="container">
            <div class="header-flex" style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div>
                    <div class="breadcrumb" style="font-size: 12px; opacity: 0.6; margin-bottom: 5px;">
                        <a href="{{ url('/') }}" style="color: #fff; text-decoration: none;">Home</a> / 
                        <a href="{{ route('customer.dashboard') }}" style="color: #fff; text-decoration: none;">Account</a> /
                        <a href="{{ route('customer.orders') }}" style="color: #fff; text-decoration: none;">Orders</a>
                    </div>
                    <h1 style="font-size: 32px; font-weight: 800; margin: 0; letter-spacing: -0.5px; color: #fff;">Order Details</h1>
                    <p style="opacity: 0.7; font-size: 14px; margin: 5px 0 0; color: #fff;">Transaction perspective for #{{ $order->order_number }}</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('customer.orders') }}" class="btn-action-glass-premium" style="display: inline-flex; align-items: center; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff; padding: 10px 20px; border-radius: 10px; font-size: 13px; text-decoration: none;">
                        <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Back
                    </a>
                    <a href="{{ route('customer.orders.download', $order) }}" class="btn-action-glass-premium" style="display: inline-flex; align-items: center; background: linear-gradient(135deg, #FF9800, #C2185B); border: none; color: #fff; padding: 10px 20px; border-radius: 10px; font-size: 13px; text-decoration: none;">
                        <i class="fas fa-file-pdf" style="margin-right: 8px;"></i> PDF
                    </a>
                    <button onclick="printInvoice()" class="btn-action-glass-premium" style="display: inline-flex; align-items: center; background: linear-gradient(135deg, #FF9800, #C2185B); border: none; color: #fff; padding: 10px 20px; border-radius: 10px; font-size: 13px; cursor: pointer;">
                        <i class="fas fa-print" style="margin-right: 8px;"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    <main class="main-content-premium content-wrapper-shifted">
        <div class="container">
            <div class="account-layout">
                <div class="account-sidebar-col d-print-none">
                    @include('customer.sidebar')
                </div>
                <div class="account-main-content">
                    
                    {{-- Progress Area --}}
                    <div class="glass-card d-print-none" style="margin-bottom: 25px; padding: 25px;">
                        <div class="status-tracker">
                            <div class="step active">
                                <div class="step-icon">1</div>
                                <span>Placed</span>
                            </div>
                            <div class="step {{ in_array($order->status, ['processing', 'completed', 'delivered']) ? 'active' : '' }}">
                                <div class="step-icon">2</div>
                                <span>Process</span>
                            </div>
                            <div class="step {{ in_array($order->status, ['shipped', 'completed', 'delivered']) ? 'active' : '' }}">
                                <div class="step-icon">3</div>
                                <span>Shipped</span>
                            </div>
                            <div class="step {{ in_array($order->status, ['completed', 'delivered']) ? 'active' : '' }}">
                                <div class="step-icon">4</div>
                                <span>Delivered</span>
                            </div>
                        </div>
                    </div>

                    {{-- Invoice Box --}}
                    <div class="glass-card" id="invoice-area">
                        
                        {{-- Brand Header --}}
                        <div class="invoice-box-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px;">
                            <div>
                                <img src="{{ asset('images/logo_final.png') }}" alt="Bogar Siddha" style="max-height: 70px; margin-bottom: 15px;">
                                <h2 style="font-size: 22px; font-weight: 800; color: #000; margin: 0;">Bogar Siddha Peedam - Bogar Alchemist LLP</h2>
                                <p style="font-size: 13px; color: #64748b; margin: 5px 0;">GSTIN: XXXXXXXXXXXXX</p>
                            </div>
                            <div style="text-align: right;">
                                <h5 style="background: #f1f5f9; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; color: #475569; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 10px; display: inline-block;">Tax Invoice</h5>
                                <h3 style="font-size: 20px; font-weight: 700; margin: 0;">#{{ $order->order_number }}</h3>
                                <p style="font-size: 13px; color: #94a3b8; margin: 4px 0;">{{ $order->created_at->format('d M, Y') }}</p>
                            </div>
                        </div>

                        <div style="height: 1px; background: #f1f5f9; margin-bottom: 35px;"></div>

                        {{-- Info Sections --}}
                        <div class="address-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; margin-bottom: 40px;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;" class="meta-grid">
                                <div>
                                    <span class="summary-label">Billing Address</span>
                                    <div class="summary-value">
                                        <strong style="display: block; color: #000; margin-bottom: 4px;">{{ $order->customer_name ?? Auth::user()->name }}</strong>
                                        {{ $order->address_line1 }}<br>
                                        @if($order->address_line2) {{ $order->address_line2 }}<br> @endif
                                        {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}<br>
                                        <span style="font-size: 12px; color: #64748b; margin-top: 5px; display: block;"><i class="fas fa-phone"></i> {{ $order->phone }}</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="summary-label">Shipping Address</span>
                                    <div class="summary-value">
                                        <strong style="display: block; color: #000; margin-bottom: 4px;">{{ $order->customer_name ?? Auth::user()->name }}</strong>
                                        {{ $order->address_line1 }} {{ $order->address_line2 ? ', ' . $order->address_line2 : '' }}<br>
                                        {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span class="summary-label">Financial Overview</span>
                                <div style="background: #f8fafc; padding: 15px; border-radius: 12px; font-size: 13px;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                        <span style="color: #64748b;">Order Status</span>
                                        <span style="font-weight: 700; color: {{ in_array($order->status, ['completed', 'delivered']) ? '#059669' : '#f59e0b' }};">{{ strtoupper($order->status) }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                        <span style="color: #64748b;">Method</span>
                                        <strong style="color: #1e293b;">Online</strong>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                        <span style="color: #64748b;">Payment</span>
                                        <span style="font-weight: 700; color: {{ $order->payment_status == 'paid' ? '#059669' : '#dc2626' }};">{{ strtoupper($order->payment_status) }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; padding-top: 10px; border-top: 1px dashed #e2e8f0; margin-top: 10px;">
                                        <span style="font-weight: 600;">Total Paid</span>
                                        <strong style="color: var(--primary-color); font-size: 16px;">₹{{ number_format($order->amount, 0) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Line Items --}}
                        <div class="table-responsive">
                            <table class="ledger-table" style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <thead>
                                    <tr style="border-bottom: 2px solid #f1f5f9;">
                                        <th style="padding: 15px 0; text-align: left; font-size: 11px; color: #94a3b8; text-transform: uppercase;">S.No</th>
                                        <th style="padding: 15px 10px; text-align: center; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Image</th>
                                        <th style="padding: 15px 10px; text-align: left; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Product Name</th>
                                        <th style="padding: 15px 10px; text-align: center; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Qty</th>
                                        <th style="padding: 15px 10px; text-align: right; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Rate</th>
                                        <th style="padding: 15px 0; text-align: right; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($order->items) && $order->items->count() > 0)
                                        @foreach($order->items as $index => $item)
                                        <tr>
                                            <td style="width: 30px; color: #cbd5e1;" data-label="S.No">{{ $loop->iteration }}</td>
                                            <td class="text-center" data-label="Image">
                                                @if($item->product && $item->product->primary_image)
                                                    <img src="{{ asset($item->product->primary_image) }}" alt="{{ $item->product_name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                                        <i class="fas fa-image" style="color: #cbd5e1;"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="product-cell" data-label="Product Name">
                                                <strong style="color: #1e293b; font-size: 14px;">{{ $item->product_name }}</strong>
                                                <span style="font-size: 11px; color: #94a3b8;">{{ $item->hsn ?? $item->product?->hsn ?? '3004' }}</span>
                                            </td>
                                            <td style="text-align: center; color: #1e293b; font-weight: 600;" data-label="Qty">{{ $item->quantity }}</td>
                                            <td style="text-align: right; color: #64748b;" data-label="Rate">₹{{ number_format($item->unit_price, 0) }}</td>
                                            <td style="text-align: right; color: #000; font-weight: 800;" data-label="Total">₹{{ number_format($item->line_total, 0) }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td data-label="S.No">1</td>
                                            <td class="text-center" data-label="Image">
                                                <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                                    <i class="fas fa-box" style="color: #cbd5e1;"></i>
                                                </div>
                                            </td>
                                            <td class="product-cell" data-label="Product Name"><strong>{{ $order->product_name }}</strong></td>
                                            <td data-label="Qty">{{ $order->quantity }}</td>
                                            <td data-label="Rate">₹{{ number_format($order->amount / max($order->quantity, 1), 0) }}</td>
                                            <td data-label="Total">₹{{ number_format($order->amount, 0) }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Totals --}}
                        <div style="display: flex; justify-content: flex-end;">
                            <div class="totals-wrapper" style="width: 300px;">
                                <div style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">
                                    <span>Subtotal</span>
                                    <span>₹{{ number_format($order->items->count() > 0 ? $order->items->sum('line_total') : $order->amount, 0) }}</span>
                                </div>
                                @if($order->discount_amount > 0)
                                <div style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 13px; color: #dc2626; border-bottom: 1px solid #f1f5f9;">
                                    <span>Discount @if($order->coupon_code) ({{ $order->coupon_code }}) @endif</span>
                                    <span>- ₹{{ number_format($order->discount_amount, 0) }}</span>
                                </div>
                                @endif
                                <div style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">
                                    <span>Shipping Charges</span>
                                    <span>₹{{ number_format($order->shipping_amount, 0) }}</span>
                                </div>
                                @if($order->shipping_discount > 0)
                                <div style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 13px; color: #2e7d32; border-bottom: 1px solid #f1f5f9;">
                                    <span>Shipping Discount</span>
                                    <span>- ₹{{ number_format($order->shipping_discount, 0) }}</span>
                                </div>
                                @endif
                                <div style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 13px; color: #64748b; border-bottom: 1px solid #f1f5f9;">
                                    <span>Shipping Amount</span>
                                    <strong style="color: #c2185b;">₹{{ number_format($order->shipping_amount - $order->shipping_discount, 0) }}</strong>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 20px 0; align-items: flex-end;">
                                    <span style="font-weight: 700; color: #1e293b;">Total Amount</span>
                                    <strong style="font-size: 24px; font-weight: 900; color: var(--primary-color);">₹{{ number_format($order->amount, 0) }}</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Signature/Footer --}}
                        <div class="invoice-footer-meta" style="margin-top: 60px; display: flex; justify-content: space-between; align-items: flex-end;">
                            <div style="max-width: 400px;">
                                <h6 style="font-size: 10px; font-weight: 800; color: #1e293b; text-transform: uppercase; margin-bottom: 10px;">Declaration</h6>
                                <p style="font-size: 10px; color: #94a3b8; line-height: 1.6; margin: 0;">
                                    This is a computer generated invoice and does not require a physical signature. Goods once sold cannot be returned unless found damaged upon arrival.
                                </p>
                            </div>
                            <div style="text-align: center; width: 140px;">
                                <div style="border-bottom: 1px solid #1a1a1a; margin-bottom: 8px;"></div>
                                <p style="font-size: 11px; font-weight: 800; color: #1a1a1a; margin: 0;">Authorized Rep</p>
                                <p style="font-size: 9px; color: #94a3b8; text-transform: uppercase;">Bogar Siddha Peedam - Bogar Alchemist LLP</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-print-none" style="text-align: center; margin-top: 30px;">
                        <p style="font-size: 13px; color: #94a3b8;">Questions? <a href="{{ route('contact') }}" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Reach out to support</a></p>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function printInvoice() {
        window.print();
    }
</script>
@endsection
