<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        @page {
            margin: 0;
            size: A4 portrait;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9.5pt;
            color: #1e293b;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .header-box {
            background: #1a1a1a;
            color: #ffffff;
            padding: 25px 30px;
            margin-bottom: 15px;
        }
        .header-box td {
            vertical-align: middle;
        }
        .content-area {
            padding: 0 30px 20px;
        }
        .status-tracker {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px 15px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #f1f5f9;
        }
        .status-step {
            text-align: center;
            width: 25%;
            font-size: 7.5pt;
            color: #94a3b8;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-step.active {
            color: #c2185b;
        }
        .section-title {
            font-size: 7.5pt;
            font-weight: bold;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: block;
        }
        .address-table {
            width: 100%;
            margin-bottom: 15px;
        }
        .address-table td {
            vertical-align: top;
            width: 33.33%;
        }
        .insight-box {
            background: #f8fafc;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #f1f5f9;
        }
        .ledger-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .ledger-table th {
            background: #f8fafc;
            border-bottom: 2px solid #f1f5f9;
            padding: 10px 8px;
            text-align: left;
            font-size: 7.5pt;
            color: #94a3b8;
            text-transform: uppercase;
            font-weight: bold;
        }
        .ledger-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }
        .totals-table {
            width: 280px;
            float: right;
        }
        .totals-table td {
            padding: 6px 0;
            font-size: 9.5pt;
        }
        .total-amount {
            font-size: 16pt;
            font-weight: bold;
            color: #004200;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-muted { color: #64748b; }
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="header-box">
        <table width="100%">
            <tr>
                <td width="100">
                    <img src="{{ public_path('auri-images/logo.png') }}" style="max-height: 70px;">
                </td>
                <td>
                    <div style="font-size: 8pt; opacity: 0.6; margin-bottom: 2px;">TAX INVOICE</div>
                    <div style="font-size: 20pt; font-weight: bold; letter-spacing: -0.5px;">Order Invoice</div>
                    <div style="font-size: 10pt; opacity: 0.8;">#{{ $order->order_number }}</div>
                </td>
                <td class="text-right">
                    <div style="font-size: 16pt; font-weight: bold; color: #d4af37;">AUVRI PLUS</div>
                    <div style="font-size: 8pt; opacity: 0.7;">DIVINE ESSENCE OF WELLNESS</div>
                    <div style="font-size: 7.5pt; opacity: 0.5; margin-top: 4px;">Premium Authentic Siddha Heritage</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="content-area">
        <div class="status-tracker">
            <table width="100%">
                <tr>
                    <td class="status-step active">1. Placed</td>
                    <td class="status-step {{ in_array($order->status, ['processing', 'shipped', 'delivered', 'completed']) ? 'active' : '' }}">2. Process</td>
                    <td class="status-step {{ in_array($order->status, ['shipped', 'delivered', 'completed']) ? 'active' : '' }}">3. Shipped</td>
                    <td class="status-step {{ in_array($order->status, ['delivered', 'completed']) ? 'active' : '' }}">4. Delivered</td>
                </tr>
            </table>
        </div>

        <table class="address-table">
            <tr>
                <td>
                    <span class="section-title">Billing Details</span>
                    <div style="padding-right: 15px; font-size: 9pt;">
                        <strong style="font-size: 10pt; color: #000;">{{ $order->customer_name }}</strong><br>
                        <span class="text-muted">{{ $order->customer_email }}</span><br>
                        <span class="text-muted">{{ $order->phone }}</span><br>
                        {{ $order->address_line1 }}<br>
                        @if($order->address_line2) {{ $order->address_line2 }}<br> @endif
                        {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}
                    </div>
                </td>
                <td>
                    <span class="section-title">Shipping Details</span>
                    <div style="padding-right: 15px; font-size: 9pt;">
                        <strong style="font-size: 10pt; color: #000;">{{ $order->customer_name }}</strong><br>
                        <span class="text-muted">{{ $order->phone }}</span><br>
                        {{ $order->address_line1 }}<br>
                        @if($order->address_line2) {{ $order->address_line2 }}<br> @endif
                        {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}
                    </div>
                </td>
                <td>
                    <span class="section-title">Order Info</span>
                    <div class="insight-box">
                        <table width="100%">
                            <tr>
                                <td class="text-muted" style="padding-bottom: 5px; font-size: 8.5pt;">Date:</td>
                                <td class="text-right" style="padding-bottom: 5px; font-weight: bold; font-size: 8.5pt;">{{ $order->created_at->format('d M, Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted" style="padding-bottom: 5px; font-size: 8.5pt;">Status:</td>
                                <td class="text-right" style="padding-bottom: 5px; font-weight: bold; font-size: 8.5pt;">{{ strtoupper($order->status) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted" style="padding-bottom: 5px; font-size: 8.5pt;">Payment:</td>
                                <td class="text-right" style="padding-bottom: 5px; font-weight: bold; color: {{ $order->payment_status == 'paid' ? '#059669' : '#dc2626' }}; font-size: 8.5pt;">{{ strtoupper($order->payment_status) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted" style="padding-top: 5px; border-top: 1px dashed #e2e8f0; font-size: 8.5pt;">Net Total:</td>
                                <td class="text-right" style="padding-top: 5px; border-top: 1px dashed #e2e8f0; font-weight: bold; color: #004200; font-size: 10.5pt;">₹{{ number_format($order->amount, 0) }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <table class="ledger-table">
            <thead>
                <tr>
                    <th width="30">S.No</th>
                    <th width="50" class="text-center">Image</th>
                    <th>Product Name</th>
                    <th width="50" class="text-center">Qty</th>
                    <th width="90" class="text-right">Unit Price</th>
                    <th width="90" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $items = $order->items && $order->items->count() > 0 ? $order->items : collect([$order]); @endphp
                @foreach($items as $item)
                <tr>
                    <td class="text-muted">{{ $loop->iteration }}</td>
                    <td class="text-center">
                        @if(isset($item->product) && $item->product->primary_image && file_exists(public_path($item->product->primary_image)))
                            <img src="{{ public_path($item->product->primary_image) }}" style="width: 35px; height: 35px; object-fit: cover; border-radius: 4px;">
                        @else
                            <div style="width: 35px; height: 35px; background: #f1f5f9; border-radius: 4px; margin: 0 auto; line-height: 35px; font-size: 8px; color: #cbd5e1;">IMG</div>
                        @endif
                    </td>
                    <td>
                        <strong style="color: #1e293b;">{{ $item->product_name ?? $order->product_name }}</strong><br>
                        <span style="font-size: 8.5pt; color: #94a3b8;">HSN: {{ $item->hsn ?? '3004' }}</span>
                    </td>
                    <td class="text-center" style="font-weight: bold;">{{ $item->quantity }}</td>
                    <td class="text-right text-muted">₹{{ number_format($item->unit_price ?? ($order->amount / max($order->quantity, 1)), 0) }}</td>
                    <td class="text-right" style="font-weight: bold;">₹{{ number_format($item->line_total ?? $order->amount, 0) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="width: 100%;">
            <table class="totals-table">
                <tr>
                    <td class="text-muted">Subtotal</td>
                    <td class="text-right" style="font-weight: bold;">₹{{ number_format($order->items->count() > 0 ? $order->items->sum('line_total') : $order->amount, 0) }}</td>
                </tr>
                @if($order->discount_amount > 0)
                <tr>
                    <td style="color: #dc2626;">Discount @if($order->coupon_code) <span style="font-size: 7.5pt;">({{ $order->coupon_code }})</span> @endif</td>
                    <td class="text-right" style="color: #dc2626; font-weight: bold;">- ₹{{ number_format($order->discount_amount, 0) }}</td>
                </tr>
                @endif
                <tr>
                    <td class="text-muted">Shipping Charges</td>
                    <td class="text-right" style="font-weight: bold;">₹{{ number_format($order->shipping_amount, 0) }}</td>
                </tr>
                @if($order->shipping_discount > 0)
                <tr>
                    <td style="color: #2e7d32;">Shipping Discount</td>
                    <td class="text-right" style="color: #2e7d32; font-weight: bold;">- ₹{{ number_format($order->shipping_discount, 0) }}</td>
                </tr>
                @endif
                <tr>
                    <td class="text-muted">Total Shipping</td>
                    <td class="text-right" style="color: #004200; font-weight: bold;">₹{{ number_format($order->shipping_amount - $order->shipping_discount, 0) }} @if($order->shipping_amount - $order->shipping_discount <= 0) (FREE) @endif</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top: 1px solid #f1f5f9; padding-top: 10px; margin-top: 5px;"></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 11pt;">Final Amount</td>
                    <td class="text-right total-amount">₹{{ number_format($order->amount, 0) }}</td>
                </tr>
            </table>
            <div class="clear"></div>
        </div>

        <div class="footer">
            <table width="100%">
                <tr>
                    <td width="70%">
                        <span class="section-title">Declaration</span>
                        <p style="font-size: 7.5pt; color: #94a3b8; margin: 0;">
                            This is a computer generated invoice and does not require a physical signature. Goods once sold cannot be returned unless found damaged upon arrival. Generated on {{ now()->format('d M, Y H:i A') }}
                        </p>
                    </td>
                    <td width="30%" class="text-center">
                        <div style="border-bottom: 2px solid #1a1a1a; margin-bottom: 5px; width: 100px; margin-left: auto; margin-right: auto;"></div>
                        <div style="font-weight: bold; font-size: 8.5pt;">Authorized Signatory</div>
                        <div style="font-size: 6.5pt; color: #94a3b8; text-transform: uppercase;">Auvri Plus - Premium Wellness</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
