@extends('layouts.auri')

@section('title', 'Order Details #' . $order->order_number . ' | Auvri Plus')

@section('content')
    <div class="luxury-account-page">
        <div class="container">
            <!-- Page Header -->
            <div class="account-page-header d-print-none">
                <h1 class="account-title">Order Details</h1>
                <div class="account-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <a href="{{ route('customer.dashboard') }}">Account</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <a href="{{ route('customer.orders') }}">Orders</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <span>#{{ $order->order_number }}</span>
                </div>
            </div>

            <div class="account-grid">
                <!-- Sidebar -->
                <aside class="account-sidebar-col d-print-none">
                    @include('customer.sidebar')
                </aside>

                <!-- Main Content -->
                <div class="account-main-content">
                    <div class="section-card">
                        <!-- Action Bar -->
                        <div class="order-action-bar d-print-none">
                            <div class="order-meta-summary">
                                <span class="order-number-badge">#{{ $order->order_number }}</span>
                                <span class="order-date">{{ $order->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="action-buttons">
                                <button onclick="window.print()" class="btn-icon-text">
                                    <i class="fas fa-print"></i> Print Invoice
                                </button>
                                <a href="{{ route('customer.orders.download', $order) }}"
                                    class="btn-icon-text download-btn">
                                    <i class="fas fa-file-pdf"></i> Download PDF
                                </a>
                            </div>
                        </div>

                        <!-- Progress Tracker -->
                        <div class="order-tracker-container d-print-none">
                            <div class="tracker-steps">
                                <div
                                    class="step {{ in_array($order->status, ['placed', 'shipped', 'out_for_delivery', 'delivered', 'completed']) ? 'active' : '' }}">
                                    <div class="step-circle"><i class="fas fa-shopping-bag"></i></div>
                                    <span class="step-label">Placed</span>
                                </div>
                                <div
                                    class="step {{ in_array($order->status, ['shipped', 'out_for_delivery', 'delivered', 'completed']) ? 'active' : '' }}">
                                    <div class="step-circle"><i class="fas fa-truck"></i></div>
                                    <span class="step-label">Shipped</span>
                                </div>
                                <div
                                    class="step {{ in_array($order->status, ['out_for_delivery', 'delivered', 'completed']) ? 'active' : '' }}">
                                    <div class="step-circle"><i class="fas fa-shipping-fast"></i></div>
                                    <span class="step-label">Out for Delivery</span>
                                </div>
                                <div
                                    class="step {{ in_array($order->status, ['delivered', 'completed']) ? 'active' : '' }}">
                                    <div class="step-circle"><i class="fas fa-check-circle"></i></div>
                                    <span class="step-label">Delivered</span>
                                </div>
                            </div>
                            <div class="tracker-line">
                                <div class="tracker-line-fill status-{{ strtolower($order->status) }}"></div>
                            </div>
                        </div>

                        <!-- Invoice Content -->
                        <div class="luxury-invoice-box" id="invoice-content">
                            <!-- Invoice Header -->
                            <div class="invoice-header">
                                <div class="brand-info">
                                    <img src="{{ asset('auri-images/logo.png') }}" alt="Auvri Plus" class="invoice-logo">
                                    <h2 class="company-name">Auvri Plus - Luxury Wellness</h2>
                                    <p class="company-sub">Traditional Wisdom, Modern Science</p>
                                </div>
                                <div class="invoice-meta">
                                    <h3 class="invoice-label">Tax Invoice</h3>
                                    <div class="meta-item">
                                        <span class="label">Invoice No:</span>
                                        <span class="value">#{{ $order->order_number }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="label">Date:</span>
                                        <span class="value">{{ $order->created_at->format('d M, Y') }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="label">Status:</span>
                                        <span
                                            class="status-value {{ strtolower($order->status) }}">{{ strtoupper($order->status) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Address Sections -->
                            <div class="invoice-addresses">

                                <div class="address-col">
                                    <h4 class="address-title">Shipping Address</h4>
                                    <div class="address-content">
                                        <strong>{{ $order->customer_name ?? $user->name }}</strong>
                                        <p>{{ $order->address_line1 }}<br>
                                            @if($order->address_line2) {{ $order->address_line2 }}<br> @endif
                                            {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}<br>
                                            {{ $order->country }}
                                        </p>
                                    </div>
                                </div>
                                <div class="address-col info-card">
                                    <h4 class="address-title">Payment Info</h4>
                                    <div class="info-content">
                                        <div class="info-row">
                                            <span>Status:</span>
                                            <strong
                                                class="{{ $order->payment_status == 'paid' ? 'text-success' : 'text-warning' }}">
                                                {{ strtoupper($order->payment_status) }}
                                            </strong>
                                        </div>
                                        <div class="info-row">
                                            <span>Method:</span>
                                            <strong>Online Payment</strong>
                                        </div>
                                        <div class="info-row total-paid">
                                            <span>Paid Amount:</span>
                                            <strong>₹{{ number_format($order->amount, 2) }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items Table -->
                            <div class="invoice-table-wrapper">
                                <table class="invoice-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Line Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td data-label="Product">
                                                    <div class="product-info">
                                                        <div class="product-name">{{ $item->product_name }}</div>
                                                        <div class="product-sku">SKU: {{ $item->product?->sku ?? 'N/A' }}</div>
                                                    </div>
                                                </td>
                                                <td data-label="Quantity" class="text-center">{{ $item->quantity }}</td>
                                                <td data-label="Rate" class="text-right">
                                                    ₹{{ number_format($item->unit_price, 2) }}</td>
                                                <td data-label="Line Total" class="text-right font-bold">
                                                    ₹{{ number_format($item->line_total, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Invoice Footer / Totals -->
                            <div class="invoice-footer" style="justify-content: flex-end;">
                                @php
                                    $gst_rate = 0.18;
                                    $subtotal_inc = $order->items->sum('line_total');
                                    $discount_inc = $order->discount_amount;
                                    $shipping_inc = max(0, $order->shipping_amount - $order->shipping_discount);

                                    // Taxable breakdown to match the image logic
                                    $net_product_taxable = ($subtotal_inc - $discount_inc) / (1 + $gst_rate);
                                    $shipping_taxable = $shipping_inc / (1 + $gst_rate);
                                    $taxable_value = $net_product_taxable + $shipping_taxable;
                                    $gst_amount = $order->amount - $taxable_value;
                                @endphp
                                <div class="totals-calculation" style="width: 300px; margin-left: auto;">
                                    <div class="calc-row">
                                        <span class="label">Product Value</span>
                                        <span class="value">₹{{ number_format($net_product_taxable, 2) }}</span>
                                    </div>

                                    @if($order->discount_amount > 0)
                                        <div class="calc-row discount-row">
                                            <span class="label">Coupon Discount</span>
                                            <span class="value">- ₹{{ number_format($order->discount_amount, 0) }}</span>
                                        </div>
                                    @endif

                                    <div class="calc-row">
                                        <span class="label">Shipping Charges</span>
                                        <span class="value">₹{{ number_format($shipping_taxable, 2) }}</span>
                                    </div>

                                    <div class="calc-row taxable-value-row">
                                        <span class="label" style="font-weight: 700; color: #333;">Taxable Value</span>
                                        <span class="value"
                                            style="font-weight: 700; color: #333;">₹{{ number_format($taxable_value, 2) }}</span>
                                    </div>

                                    <div class="calc-row">
                                        <span class="label">GST (18%)</span>
                                        <span class="value">₹{{ number_format($gst_amount, 2) }}</span>
                                    </div>

                                    <div class="calc-row grand-total-row">
                                        <div class="total-label-box">
                                            <div class="final-total-label">Final Total</div>
                                            <div class="gst-inclusive-note">(inclusive of GST)</div>
                                        </div>
                                        <span class="final-total-value">₹{{ number_format($order->amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="invoice-signature-block"
                                style="margin-top: 80px; display: flex; flex-direction: row; justify-content: space-between; align-items: flex-start; width: 100%;">
                                <div style="width: 55%; text-align: left;">
                                    <div
                                        style="font-weight: bold; font-size: 14px; color: #1e293b; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                                        DECLARATION</div>
                                    <p
                                        style="font-size: 13px; color: #94a3b8; margin: 0; line-height: 1.6; font-weight: 300;">
                                        This is a computer generated invoice and does not require a physical signature.
                                        Goods once sold cannot be returned unless found damaged upon arrival.
                                    </p>
                                </div>
                                <div style="width: 35%; text-align: left;">
                                    <div style="border-top: 1px solid #cbd5e1; margin-bottom: 15px; width: 100%;"></div>
                                    <div style="font-weight: bold; font-size: 16px; color: #1e293b; margin-bottom: 5px;">
                                        Authorized Rep</div>
                                    <div style="font-size: 13px; color: #94a3b8; line-height: 1.4; font-weight: 300;">Aruvi
                                        Plus</div>
                                </div>
                            </div>

                            <div class="support-contact-web"
                                style="text-align: center; margin-top: 100px; padding-bottom: 20px;">
                                <span style="color: #94a3b8; font-size: 18px;">Questions?</span> <b
                                    style="color: #c2185b; font-weight: 800; font-size: 20px; margin-left: 5px;">Reach out
                                    to support</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                /* Order Details Redesign */
                .luxury-account-page {
                    background: var(--beige-light);
                    padding: 60px 0 100px;
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

                .account-grid {
                    display: grid;
                    grid-template-columns: 320px 1fr;
                    gap: 40px;
                }

                .section-card {
                    background: #fff;
                    border-radius: 20px;
                    padding: 35px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                    border: 1px solid var(--beige-soft);
                }

                /* Action Bar */
                .order-action-bar {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 40px;
                }

                .order-number-badge {
                    background: var(--primary);
                    color: #fff;
                    padding: 8px 15px;
                    border-radius: 50px;
                    font-weight: 700;
                    font-size: 18px;
                    margin-right: 15px;
                }

                .order-date {
                    color: #888;
                    font-size: 15px;
                    font-weight: 600;
                }

                .btn-icon-text {
                    padding: 10px 20px;
                    border-radius: 10px;
                    background: var(--luxury-green-soft);
                    color: var(--primary);
                    border: 1px solid var(--beige-soft);
                    font-weight: 600;
                    font-size: 14px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    outline: none;
                }

                .btn-icon-text:hover {
                    background: var(--primary);
                    color: #fff;
                    box-shadow: 0 5px 15px rgba(0, 66, 0, 0.15);
                    border-color: var(--primary);
                }

                .download-btn {
                    background: var(--primary);
                    color: #fff;
                    border-color: var(--primary);
                }

                /* Progress Tracker */
                .order-tracker-container {
                    margin-bottom: 60px;
                    position: relative;
                    padding: 0 10%;
                }

                .tracker-steps {
                    display: flex;
                    justify-content: space-between;
                    position: relative;
                    z-index: 2;
                }

                .step {
                    text-align: center;
                    width: 100px;
                }

                .step-circle {
                    width: 50px;
                    height: 50px;
                    background: #fff;
                    border: 2px solid var(--beige-dark);
                    border-radius: 50%;
                    margin: 0 auto 10px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: var(--beige-dark);
                    font-size: 20px;
                    transition: all 0.4s ease;
                }

                .step.active .step-circle {
                    background: var(--primary);
                    border-color: var(--primary);
                    color: #fff;
                    box-shadow: 0 0 20px rgba(0, 66, 0, 0.3);
                }

                .step-label {
                    font-size: 13px;
                    font-weight: 700;
                    color: #aaa;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    transition: all 0.4s ease;
                }

                .step.active .step-label {
                    color: var(--primary);
                }

                .tracker-line {
                    position: absolute;
                    top: 25px;
                    left: 15%;
                    width: 70%;
                    height: 3px;
                    background: var(--beige-light);
                    z-index: 1;
                }

                .tracker-line-fill {
                    height: 100%;
                    background: var(--primary);
                    transition: width 0.8s ease;
                }

                .tracker-line-fill.status-placed {
                    width: 0%;
                }

                .tracker-line-fill.status-shipped {
                    width: 33.33%;
                }

                .tracker-line-fill.status-out_for_delivery {
                    width: 66.66%;
                }

                .tracker-line-fill.status-completed,
                .tracker-line-fill.status-delivered {
                    width: 100%;
                }

                /* Luxury Invoice Box */
                .luxury-invoice-box {
                    border: 1px solid var(--beige-soft);
                    padding: 50px;
                    border-radius: 20px;
                    background: #fff;
                }

                .invoice-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    margin-bottom: 50px;
                }

                .invoice-logo {
                    max-height: 80px;
                    margin-bottom: 15px;
                }

                .company-name {
                    font-size: 24px;
                    color: var(--primary);
                    margin: 0;
                }

                .company-sub {
                    font-size: 14px;
                    color: #888;
                }

                .invoice-label {
                    font-size: 28px;
                    color: var(--primary);
                    margin: 0 0 15px;
                    text-align: right;
                }

                .meta-item {
                    display: flex;
                    justify-content: flex-end;
                    gap: 10px;
                    margin-bottom: 8px;
                    font-size: 14px;
                }

                .meta-item .label {
                    color: #888;
                }

                .meta-item .value {
                    font-weight: 700;
                    color: #333;
                }

                .status-value {
                    padding: 4px 10px;
                    border-radius: 5px;
                    font-size: 11px;
                    font-weight: 800;
                }

                .status-value.processing {
                    background: #fff8e1;
                    color: #ffa000;
                }

                .status-value.delivered,
                .status-value.completed {
                    background: #e8f5e9;
                    color: #2e7d32;
                }

                /* Addresses */
                .invoice-addresses {
                    display: grid;
                    grid-template-columns: 1fr 1.2fr;
                    gap: 40px;
                    margin-bottom: 50px;
                }

                .address-title {
                    font-size: 13px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    color: #aaa;
                    margin-bottom: 15px;
                    border-bottom: 1px solid var(--beige-light);
                    padding-bottom: 8px;
                }

                .address-content strong {
                    display: block;
                    margin-bottom: 8px;
                    color: #333;
                    font-size: 16px;
                }

                .address-content p {
                    font-size: 14px;
                    color: #666;
                    line-height: 1.6;
                    margin: 0;
                }

                .contact-info {
                    margin-top: 10px !important;
                    color: var(--primary) !important;
                    font-weight: 600;
                }

                .info-card {
                    background: var(--luxury-green-soft);
                    padding: 20px;
                    border-radius: 15px;
                }

                .info-card .address-title {
                    border-color: rgba(0, 66, 0, 0.1);
                    color: var(--primary);
                    opacity: 0.7;
                }

                .info-row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 10px;
                    font-size: 14px;
                }

                .info-row span {
                    color: #666;
                }

                .total-paid {
                    margin-top: 15px;
                    padding-top: 15px;
                    border-top: 1px dashed rgba(0, 66, 0, 0.2);
                }

                .total-paid strong {
                    font-size: 20px;
                    color: var(--primary);
                }

                .text-success {
                    color: #2e7d32;
                }

                .text-warning {
                    color: #ef6c00;
                }

                /* Table */
                .invoice-table-wrapper {
                    margin-bottom: 40px;
                }

                .invoice-table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .invoice-table th {
                    text-align: left;
                    padding: 15px;
                    background: var(--beige-light);
                    font-size: 13px;
                    color: #888;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .invoice-table td {
                    padding: 18px 15px;
                    border-bottom: 1px solid var(--beige-light);
                    color: #444;
                    font-size: 15px;
                }

                .product-name {
                    font-weight: 700;
                    color: #333;
                    margin-bottom: 4px;
                }

                .product-sku {
                    font-size: 11px;
                    color: #999;
                }

                .font-bold {
                    font-weight: 700;
                }

                .text-center {
                    text-align: center;
                }

                .text-right {
                    text-align: right;
                }

                /* Invoice Footer */
                .invoice-footer {
                    display: flex;
                    justify-content: space-between;
                    gap: 40px;
                }

                .disclaimer {
                    flex: 1;
                }

                .disclaimer h5 {
                    font-size: 14px;
                    color: #333;
                    margin: 0 0 10px;
                }

                .disclaimer p {
                    font-size: 12px;
                    color: #888;
                    margin: 0 0 5px;
                    line-height: 1.5;
                }

                .totals-calculation {
                    width: 320px;
                }

                .calc-row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 12px;
                    font-size: 15px;
                    color: #64748b;
                }

                .calc-row .value {
                    font-weight: 700;
                    color: #1e293b;
                }

                .calc-row.discount-row {
                    color: #1a5d1a;
                }

                .calc-row.discount-row .value {
                    color: #1a5d1a;
                }

                .taxable-value-row {
                    border-top: 1px solid #f1f5f9;
                    padding-top: 15px;
                    margin-top: 5px;
                }

                .grand-total-row {
                    border-top: 1px solid #f1f5f9;
                    margin-top: 15px;
                    padding-top: 20px;
                    align-items: flex-start;
                }

                .invoice-signature-block {
                    border-top: 1px solid #f1f5f9;
                    padding-top: 40px;
                    margin-top: 40px;
                }

                .final-total-label {
                    font-size: 16px;
                    font-weight: 800;
                    color: #9d174d;
                    line-height: 1;
                }

                .gst-inclusive-note {
                    font-size: 12px;
                    color: #64748b;
                    font-weight: 500;
                    margin-top: 4px;
                }

                .final-total-value {
                    font-size: 20px;
                    font-weight: 800;
                    color: #9d174d;
                    line-height: 1;
                }

                /* Print Specific */
                @media print {
                    .luxury-account-page {
                        padding: 0;
                        background: #fff;
                    }

                    .section-card {
                        border: none;
                        box-shadow: none;
                        padding: 0;
                    }

                    .luxury-invoice-box {
                        border: none;
                        padding: 0;
                    }

                    .d-print-none {
                        display: none !important;
                    }

                    .d-print-flex {
                        display: flex !important;
                    }

                    .print-signature {
                        display: flex;
                        justify-content: space-between;
                        margin-top: 80px;
                    }

                    .signature-line {
                        width: 250px;
                        border-top: 1px solid #333;
                        padding-top: 10px;
                        font-size: 12px;
                    }

                    @page {
                        margin: 1cm;
                    }
                }

                @media (max-width: 991px) {
                    .account-grid {
                        grid-template-columns: 1fr;
                    }

                    .invoice-addresses {
                        grid-template-columns: 1fr 1fr;
                    }
                }

                @media (max-width: 768px) {
                    .luxury-account-page {
                        padding: 30px 0 80px !important;
                    }

                    .luxury-account-page .container {
                        padding-left: 15px !important;
                        padding-right: 15px !important;
                        width: 100% !important;
                        max-width: 100% !important;
                    }

                    .account-page-header {
                        margin-bottom: 30px;
                        margin-top: 20px;
                        text-align: center;
                    }

                    .account-title {
                        font-size: 28px !important;
                    }

                    .account-breadcrumb {
                        justify-content: center;
                    }

                    .account-grid {
                        grid-template-columns: 1fr !important;
                        gap: 30px !important;
                    }

                    .section-card {
                        padding: 25px 20px !important;
                    }

                    .order-action-bar {
                        flex-direction: column;
                        gap: 20px;
                        text-align: center;
                    }

                    .action-buttons {
                        width: 100%;
                        display: flex;
                        justify-content: center;
                        gap: 15px;
                    }

                    .order-tracker-container {
                        padding: 0;
                        margin-bottom: 40px;
                    }

                    .tracker-steps {
                        justify-content: space-around;
                    }

                    .step {
                        width: 80px;
                    }

                    .step-circle {
                        width: 45px;
                        height: 45px;
                        font-size: 18px;
                    }

                    .step-label {
                        font-size: 10px;
                    }

                    .tracker-line {
                        top: 22px;
                        width: 80%;
                        left: 10%;
                    }

                    .luxury-invoice-box {
                        padding: 30px 20px !important;
                    }

                    .invoice-header {
                        flex-direction: column;
                        text-align: center;
                        gap: 30px;
                    }

                    .invoice-meta {
                        text-align: center;
                        width: 100%;
                    }

                    .meta-item {
                        justify-content: center;
                    }

                    .invoice-label {
                        text-align: center;
                    }

                    .invoice-addresses {
                        grid-template-columns: 1fr;
                        gap: 25px;
                    }

                    .info-card {
                        grid-column: 1;
                    }

                    .invoice-footer {
                        flex-direction: column;
                        align-items: flex-end;
                    }

                    .totals-calculation {
                        width: 100% !important;
                        max-width: 350px;
                        margin-left: auto !important;
                    }
                }

                @media (max-width: 580px) {
                    .section-card {
                        padding: 20px 15px !important;
                    }

                    .luxury-invoice-box {
                        padding: 20px 15px !important;
                    }

                    .action-buttons {
                        flex-direction: column;
                        width: 100%;
                    }

                    .btn-icon-text {
                        width: 100%;
                        justify-content: center;
                    }

                    .order-number-badge {
                        margin-right: 0;
                        margin-bottom: 10px;
                        display: inline-block;
                    }

                    .tracker-line {
                        top: 20px;
                    }

                    .step {
                        width: 70px;
                    }

                    .step-circle {
                        width: 40px;
                        height: 40px;
                        font-size: 16px;
                    }

                    .step-label {
                        font-size: 9px;
                    }
                }

                @media (max-width: 570px) {
                    .luxury-account-page {
                        padding: 30px 0 60px !important;
                    }

                    .luxury-account-page .container {
                        padding-left: 8px !important;
                        padding-right: 8px !important;
                        width: 100% !important;
                        max-width: 100% !important;
                    }

                    .account-page-header {
                        margin-bottom: 25px;
                        margin-top: 15px;
                        text-align: center;
                    }

                    .account-title {
                        font-size: 24px !important;
                        margin-bottom: 8px;
                    }

                    .account-breadcrumb {
                        justify-content: center;
                        font-size: 11px;
                        flex-wrap: wrap;
                        line-height: 1.5;
                    }

                    .account-grid {
                        width: 100% !important;
                        display: flex !important;
                        flex-direction: column !important;
                        gap: 15px !important;
                    }

                    .account-sidebar-col,
                    .account-main-content {
                        width: 100% !important;
                        max-width: 100% !important;
                    }

                    .section-card {
                        padding: 15px 10px !important;
                        border-radius: 15px;
                    }

                    .order-action-bar {
                        flex-direction: column;
                        gap: 15px;
                        text-align: center;
                        margin-bottom: 25px;
                    }

                    .order-number-badge {
                        font-size: 15px;
                        padding: 6px 12px;
                        margin-right: 0;
                        margin-bottom: 5px;
                        display: inline-block;
                    }

                    .action-buttons {
                        width: 100%;
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 8px;
                    }

                    .btn-icon-text {
                        padding: 8px 5px;
                        font-size: 11px;
                        width: 100%;
                        justify-content: center;
                    }

                    .order-tracker-container {
                        padding: 0;
                        margin-bottom: 30px;
                    }

                    .tracker-steps {
                        gap: 5px;
                    }

                    .step {
                        width: auto;
                        flex: 1;
                    }

                    .step-circle {
                        width: 35px;
                        height: 35px;
                        font-size: 14px;
                    }

                    .step-label {
                        font-size: 9px;
                    }

                    .tracker-line {
                        top: 18px;
                        width: 80%;
                        left: 10%;
                    }

                    .luxury-invoice-box {
                        padding: 15px 10px !important;
                        border-radius: 12px;
                    }

                    .invoice-logo {
                        max-height: 50px;
                    }

                    .company-name {
                        font-size: 18px;
                    }

                    .company-sub {
                        font-size: 12px;
                    }

                    .invoice-label {
                        font-size: 20px;
                        margin-bottom: 10px;
                    }

                    .meta-item {
                        font-size: 12px;
                    }

                    .address-title {
                        font-size: 11px;
                        margin-bottom: 10px;
                    }

                    .address-content strong {
                        font-size: 14px;
                    }

                    .address-content p {
                        font-size: 12px;
                    }

                    .info-card {
                        padding: 15px;
                    }

                    .info-row {
                        font-size: 12px;
                    }

                    .total-paid strong {
                        font-size: 16px;
                    }

                    /* Invoice Table to Card */
                    .invoice-table thead {
                        display: none;
                    }

                    .invoice-table tr {
                        display: block;
                        padding: 12px 0;
                        border-bottom: 1px solid #f5f5f5;
                    }

                    .invoice-table td {
                        display: block;
                        width: 100%;
                        border: none;
                        padding: 5px 0 !important;
                        text-align: left !important;
                    }

                    .invoice-table td::before {
                        content: attr(data-label);
                        font-weight: 700;
                        font-size: 11px;
                        color: #999;
                        text-transform: uppercase;
                        margin-right: 10px;
                        display: inline-block;
                        width: 80px;
                    }

                    .invoice-table td.text-right,
                    .invoice-table td.text-center {
                        text-align: left !important;
                    }

                    .product-info {
                        padding-left: 0;
                    }

                    .product-name {
                        font-size: 14px;
                    }

                    .invoice-footer {
                        flex-direction: column;
                    }

                    .totals-calculation {
                        width: 100% !important;
                        margin-left: 0 !important;
                    }

                    .calc-row {
                        font-size: 13px;
                    }

                    .final-total-value {
                        font-size: 18px;
                    }

                    .invoice-signature-block {
                        flex-direction: column !important;
                        gap: 30px;
                        margin-top: 40px !important;
                    }

                    .invoice-signature-block>div {
                        width: 100% !important;
                        text-align: center !important;
                    }

                    .invoice-signature-block>div:first-child p {
                        font-size: 12px;
                    }

                    .support-contact-web {
                        margin-top: 40px !important;
                    }

                    .support-contact-web b {
                        font-size: 16px;
                    }
                }

                @media (max-width: 360px) {
                    .account-title {
                        font-size: 20px !important;
                    }

                    .action-buttons {
                        grid-template-columns: 1fr;
                    }

                    .step-label {
                        display: none;
                    }

                    .step-circle {
                        width: 40px;
                        height: 40px;
                    }

                    .tracker-line {
                        top: 20px;
                    }
                }
            </style>
@endsection