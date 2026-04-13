<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #333; margin: 0; padding: 0; }
        .header { margin-bottom: 30px; border-bottom: 2px solid #004200; padding-bottom: 20px; }
        .logo { width: 100px; }
        .title { text-align: right; float: right; }
        .title h1 { color: #004200; margin: 0; font-size: 24px; text-transform: uppercase; }
        .title p { margin: 5px 0 0; color: #666; font-size: 10px; }
        .stats { margin-bottom: 30px; width: 100%; border-collapse: collapse; }
        .stats td { width: 50%; padding: 15px; background: #f9fafb; border: 1px solid #eee; text-align: center; }
        .stats b { display: block; font-size: 18px; color: #004200; margin-top: 5px; }
        .stats .revenue b { color: #063a17; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #004200; color: #fff; text-align: left; padding: 10px; font-size: 10px; text-transform: uppercase; }
        td { padding: 8px 10px; border-bottom: 1px solid #eee; }
        .text-right { text-align: right; }
        .status { padding: 3px 8px; border-radius: 10px; font-size: 9px; font-weight: bold; text-transform: uppercase; }
        .status-paid { background: #e8f5e9; color: #2e7d32; }
        .status-pending { background: #fff7ed; color: #c2410c; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; border-top: 1px solid #eee; padding-top: 10px; font-size: 9px; color: #999; }
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>
    <div class="header clearfix">
        <div style="float: left;">
            <img src="{{ public_path('auri-images/logo.png') }}" class="logo">
            <div style="margin-top: 10px; font-weight: bold; color: #063a17;">Auvri Plus</div>
        </div>
        <div class="title">
            <h1>Transaction Report</h1>
            <p>Generated on: {{ date('d M, Y H:i') }}</p>
        </div>
    </div>

    <table class="stats">
        <tr>
            <td>
                TOTAL ORDERS
                <b>{{ $totalOrders }}</b>
            </td>
            <td class="revenue">
                TOTAL REVENUE (PAID)
                <b>₹{{ number_format($totalRevenue, 2) }}</b>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Order #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Taxable</th>
                <th>GST</th>
                <th>Total</th>
                <th>Method</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
            @php
                $amount = (float)$order->amount;
                $shipping = (float)($order->shipping_amount ?? 0);
                $discount = (float)($order->shipping_discount ?? 0);
                $productTotal = $amount - ($shipping - $discount);
                
                $taxable = (float)$order->taxable_value;
                if ($taxable <= 0) $taxable = $productTotal / 1.18;
                
                $gst = (float)$order->gst_amount;
                if ($gst <= 0) $gst = $productTotal - $taxable;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="font-weight: bold;">#{{ $order->order_number }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>₹{{ number_format($taxable, 2) }}</td>
                <td>₹{{ number_format($gst, 2) }}</td>
                <td style="font-weight: bold;">₹{{ number_format($amount, 2) }}</td>
                <td>{{ strtoupper($order->payment_method ?: 'ONLINE') }}</td>
                <td>
                    <span class="status status-{{ $order->payment_status }}">
                        {{ $order->payment_status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Auvri Plus Admin System - Confidential Transaction Report
    </div>
</body>
</html>
