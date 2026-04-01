<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: 'Poppins', Helvetica, Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; color: #333;">
    <div style="max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee;">
        
        <!-- Header with Gradient -->
        <div style="background: linear-gradient(135deg, #FF9100 0%, #F44336 50%, #D81B60 100%); padding: 40px 20px; text-align: center; color: white;">
            <img src="{{ $message->embed(public_path('images/logo_final.png')) }}" alt="Navapashanam Logo" style="max-width: 150px; height: auto; margin-bottom: 15px;">
            <h1 style="margin: 0; font-size: 24px; font-weight: 600; color: #ffffff;">New Order Alert!</h1>
            <p style="color: rgba(255,255,255,0.9); margin-top: 5px; font-size: 14px;">Order #{{ $order->order_number }}</p>
        </div>
        
        <!-- Content -->
        <div style="padding: 30px;">
            
            <!-- Customer Card -->
            <div style="background: #fdfdfd; border: 1px solid #eee; border-radius: 12px; padding: 20px; margin-bottom: 25px;">
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 15px; color: #F44336; border-bottom: 2px solid #f8f9fa; padding-bottom: 8px; text-transform: uppercase;">Customer Details</div>
                <div style="font-size: 15px; line-height: 1.8;">
                    <span style="color: #888; width: 100px; display: inline-block;">Name:</span> <strong style="color: #333;">{{ $order->customer_name }}</strong><br>
                    <span style="color: #888; width: 100px; display: inline-block;">Email:</span> <a href="mailto:{{ $order->customer_email }}" style="color: #F44336; text-decoration: none;">{{ $order->customer_email }}</a><br>
                    <span style="color: #888; width: 100px; display: inline-block;">Phone:</span> <span style="color: #333;">{{ $order->phone }}</span><br>
                    <span style="color: #888; width: 100px; display: inline-block;">Amount:</span> <strong style="color: #D81B60; font-size: 18px;">₹{{ number_format($order->amount, 2) }}</strong>
                </div>
            </div>
            
            <!-- Items Table -->
            <div style="background: #fdfdfd; border: 1px solid #eee; border-radius: 12px; padding: 20px; margin-bottom: 25px;">
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 15px; color: #F44336; border-bottom: 2px solid #f8f9fa; padding-bottom: 8px; text-transform: uppercase;">Order Items</div>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr>
                            <th style="text-align: left; font-size: 13px; color: #888; padding-bottom: 10px; border-bottom: 1px solid #eee;">Product</th>
                            <th style="text-align: center; font-size: 13px; color: #888; padding-bottom: 10px; border-bottom: 1px solid #eee;">Qty</th>
                            <th style="text-align: right; font-size: 13px; color: #888; padding-bottom: 10px; border-bottom: 1px solid #eee;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td style="padding: 12px 0; border-bottom: 1px solid #f8f9fa; font-size: 14px;">{{ $item->product_name }}</td>
                            <td style="padding: 12px 0; border-bottom: 1px solid #f8f9fa; font-size: 14px; text-align: center;">{{ $item->quantity }}</td>
                            <td style="padding: 12px 0; border-bottom: 1px solid #f8f9fa; font-size: 14px; text-align: right;">₹{{ number_format($item->line_total, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" style="text-align: right; padding-top: 15px; font-weight: 600; color: #888;">Grand Total:</td>
                            <td style="text-align: right; padding-top: 15px; font-size: 20px; font-weight: 700; color: #D81B60;">₹{{ number_format($order->amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Address -->
            <div style="background: #f8f9fa; padding: 20px; border-radius: 12px; margin-bottom: 25px;">
                <div style="font-weight: 600; margin-bottom: 10px; color: #333;">Shipping Address</div>
                <div style="font-size: 14px; line-height: 1.6; color: #666;">
                    {{ $order->customer_name }}<br>
                    {{ $order->address_line1 }}<br>
                    {{ $order->address_line2 ? $order->address_line2 . ',' : '' }}
                    {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}<br>
                    {{ $order->country }}
                </div>
            </div>
            
            <!-- Action Button -->
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ url('/admin/orders/' . $order->id) }}" style="display: inline-block; background: linear-gradient(135deg, #FF9100 0%, #F44336 100%); color: white !important; text-decoration: none; padding: 15px 40px; border-radius: 30px; font-weight: 600; box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);">Manage Order</a>
            </div>
            
        </div>
        
        <!-- Footer -->
        <div style="background: #f8f9fa; padding: 25px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee;">
            <p style="margin: 0;">&copy; {{ date('Y') }} <strong>Navapashanam Admin</strong>. All Rights Reserved.</p>
        </div>
        
    </div>
</body>
</html>
