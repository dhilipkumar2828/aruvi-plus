<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - {{ $order->order_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        
        .header {
            background: linear-gradient(135deg, #FF9100 0%, #F44336 50%, #D81B60 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .intro {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .order-card {
            background: #fdfdfd;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .order-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 15px;
            color: #F44336;
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 10px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .items-table th {
            text-align: left;
            font-size: 14px;
            color: #888;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .items-table td {
            padding: 15px 0;
            border-bottom: 1px solid #f8f9fa;
            font-size: 15px;
        }
        
        .total-row td {
            padding: 8px 0;
            border-bottom: none;
        }
        
        .grand-total {
            font-size: 20px;
            font-weight: 700;
            color: #D81B60;
            padding-top: 15px !important;
            border-top: 2px solid #eee !important;
        }
        
        .address-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #FF9100 0%, #F44336 100%);
            color: white;
            text-decoration: none;
            padding: 15px 35px;
            border-radius: 30px;
            font-weight: 600;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }
        
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            font-size: 13px;
            color: #888;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #666;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('auri-images/logo.png')) }}" alt="Navapashanam Logo" style="max-width: 150px; height: auto; margin-bottom: 10px;">
            <h1>We've Got Your Order!</h1>
            <p style="color: rgba(255,255,255,0.9); margin-top: 5px; font-size: 14px;">Order #{{ $order->order_number }}</p>
        </div>
        
        <div class="content">
            <div class="intro">
                Hello <strong>{{ $order->customer_name }}</strong>,<br><br>
                Thank you for your order! We're excited to let you know that your order <strong>#{{ $order->order_number }}</strong> has been received and is now being processed with care.
            </div>
            
            <div class="order-card">
                <div class="order-title">Order Summary</div>
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right;">₹{{ number_format($item->line_total, 2) }}</td>
                        </tr>
                        @endforeach
                        
                        <tr class="total-row">
                            <td colspan="2" style="text-align: right; color: #888;">Subtotal:</td>
                            <td style="text-align: right;">₹{{ number_format($order->amount - $order->shipping_amount + $order->shipping_discount + $order->discount_amount, 2) }}</td>
                        </tr>
                        
                        @if($order->discount_amount > 0)
                        <tr class="total-row">
                            <td colspan="2" style="text-align: right; color: #888;">Discount:</td>
                            <td style="text-align: right; color: #F44336;">-₹{{ number_format($order->discount_amount, 2) }}</td>
                        </tr>
                        @endif
                        
                        <tr class="total-row">
                            <td colspan="2" style="text-align: right; color: #888;">Shipping:</td>
                            <td style="text-align: right;">{{ $order->shipping_amount - $order->shipping_discount > 0 ? '₹'.number_format($order->shipping_amount - $order->shipping_discount, 2) : 'FREE' }}</td>
                        </tr>
                        
                        <tr class="total-row">
                            <td colspan="2" style="text-align: right;" class="grand-total">Total Amount:</td>
                            <td style="text-align: right;" class="grand-total">₹{{ number_format($order->amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="address-box">
                <div style="font-weight: 600; margin-bottom:10px;">Delivery Address</div>
                <div style="font-size: 14px; line-height: 1.6; color: #666;">
                    {{ $order->customer_name }}<br>
                    {{ $order->address_line1 }}<br>
                    {{ $order->address_line2 ? $order->address_line2 . ',' : '' }}
                    {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}<br>
                    {{ $order->country }}<br>
                    Phone: {{ $order->phone }}
                </div>
            </div>
            
            
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} <strong>Navapashanam | Bogar Siddha Peedam</strong>. All Rights Reserved.</p>
            <p>Palani, Tamil Nadu, India</p>
            <div class="social-links">
                <a href="#">Facebook</a> | <a href="#">Instagram</a> | <a href="#">WhatsApp</a>
            </div>
            <p style="margin-top: 20px;">If you have any questions, reply to this email or contact us at <a href="mailto:care@bogaralchemist.com" style="color: #F44336;">care@bogaralchemist.com</a></p>
        </div>
    </div>
</body>
</html>
