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
            width: 50%;
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
            width: 300px;
            float: right;
        }
        .totals-table td {
            padding: 8px 0;
            font-size: 10pt;
            color: #1e293b;
        }
        .totals-line-label {
            color: #64748b;
        }
        .totals-line-value {
            text-align: right;
            font-weight: 700;
            color: #1e293b;
        }
        .discount-label {
            color: #1a5d1a;
        }
        .discount-value {
            color: #1a5d1a;
            text-align: right;
            font-weight: 700;
        }
        .taxable-row td {
            border-top: 1px solid #f1f5f9;
            padding-top: 15px !important;
        }
        .final-total-label {
            color: #9d174d;
            font-size: 11pt;
            font-weight: bold;
            padding-top: 15px !important;
        }
        .final-total-value {
            color: #9d174d;
            font-size: 12pt;
            font-weight: bold;
            text-align: right;
            padding-top: 15px !important;
        }
        .gst-note {
            font-size: 8pt;
            color: #64748b;
            text-align: right;
            margin-top: -3px;
        }
        .support-contact {
            text-align: center;
            color: #94a3b8;
            font-size: 11pt;
            margin-top: 50px;
        }
        .support-contact b {
            color: #c2185b;
            font-weight: bold;
            font-size: 12.5pt;
        }
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
                    <div style="font-size: 7.5pt; opacity: 0.5; margin-top: 4px;">Premium Authentic Auvri Plus Heritage</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="content-area">
        <table class="address-table">
            <tr>
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

        @php
            $gst_rate = 0.18;
            $subtotal_inc = $order->items->count() > 0 ? $order->items->sum('line_total') : $order->amount;
            $discount_inc = $order->discount_amount;
            $shipping_inc = max(0, $order->shipping_amount - $order->shipping_discount);
            
            // Taxable breakdown to match the image logic:
            $net_product_taxable = ($subtotal_inc - $discount_inc) / (1 + $gst_rate);
            $shipping_taxable = $shipping_inc / (1 + $gst_rate);
            $taxable_value = $net_product_taxable + $shipping_taxable;
            $gst_amount = $order->amount - $taxable_value;
        @endphp
        <div style="width: 100%;">
            <table class="totals-table">
                <tr>
                    <td class="totals-line-label">Product Value</td>
                    <td class="totals-line-value">₹{{ number_format($net_product_taxable, 2) }}</td>
                </tr>
                @if($order->discount_amount > 0)
                <tr>
                    <td class="discount-label">Coupon Discount</td>
                    <td class="discount-value">- ₹{{ number_format($order->discount_amount, 0) }}</td>
                </tr>
                @endif
                <tr>
                    <td class="totals-line-label">Shipping Charges</td>
                    <td class="totals-line-value">₹{{ number_format($shipping_taxable, 2) }}</td>
                </tr>
                <tr class="taxable-row">
                    <td style="font-weight: bold;">Taxable Value</td>
                    <td class="totals-line-value" style="font-size: 11pt;">₹{{ number_format($taxable_value, 2) }}</td>
                </tr>
                <tr>
                    <td class="totals-line-label">GST (18%)</td>
                    <td class="totals-line-value">₹{{ number_format($gst_amount, 2) }}</td>
                </tr>
                <tr style="border-top: 1px solid #f1f5f9;">
                    <td class="final-total-label">Final Total</td>
                    <td class="final-total-value">₹{{ number_format($order->amount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="gst-note">(inclusive of GST)</td>
                </tr>
            </table>
            <div class="clear"></div>
        </div>

        <div class="footer">
            <table width="100%">
                <tr>
                    <td width="60%" style="vertical-align: top;">
                        <div style="font-weight: bold; font-size: 7.5pt; color: #1e293b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">DECLARATION</div>
                        <p style="font-size: 7.5pt; color: #94a3b8; margin: 0; line-height: 1.6; font-weight: 300;">
                            This is a computer generated invoice and does not require a physical signature. Goods once sold cannot be returned unless found damaged upon arrival.
                        </p>
                    </td>
                    <td width="5%"></td>
                    <td width="35%" style="vertical-align: top;">
                        <div style="border-top: 1px solid #cbd5e1; margin-bottom: 12px; width: 100%;"></div>
                        <div style="font-weight: bold; font-size: 9pt; color: #1e293b; margin-bottom: 4px;">Authorized Rep</div>
                        <div style="font-size: 7pt; color: #94a3b8; line-height: 1.4; font-weight: 300;">BOGAR SIDDHA PEEDAM -<br>BOGAR ALCHEMIST LLP</div>
                    </td>
                </tr>
            </table>
            <div class="support-contact">
                Questions? <b style="margin-left: 5px;">Reach out to support</b>
            </div>
        </div>
    </div>
</body>
</html>
