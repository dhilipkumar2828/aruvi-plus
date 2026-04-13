<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Order Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Outfit', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 40px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="650" style="border-collapse: collapse; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    <!-- Elegant Header -->
                    <tr>
                        <td align="center" style="padding: 50px 0; background-color: #063a17;">
                            <img src="{{ $message->embed(public_path('auri-images/logo.png')) }}" alt="Auvri Plus" width="140" style="display: block; margin-bottom: 15px;" />
                            <h2 style="color: #ffffff; font-size: 24px; margin: 0; font-weight: 700;">We've Got Your Order!</h2>
                            <p style="color: rgba(255,255,255,0.8); margin: 5px 0 0; font-size: 14px;">Order #{{ $order->order_number }}</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 40px;">
                            <p style="color: #475569; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                                Hello {{ $order->customer_name }}, thank you for choosing Auvri Plus. Your order has been successfully placed and is being prepared for dispatch.
                            </p>

                            <!-- Order Summary Table -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #063a17; font-size: 20px; font-weight: 700; padding-bottom: 25px;">Order Summary</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: left; font-size: 13px; color: #94a3b8; text-transform: uppercase; padding-bottom: 15px; border-bottom: 1px solid #f1f5f9;">Product</th>
                                                    <th style="text-align: center; font-size: 13px; color: #94a3b8; text-transform: uppercase; padding-bottom: 15px; border-bottom: 1px solid #f1f5f9;" width="80">Qty</th>
                                                    <th style="text-align: right; font-size: 13px; color: #94a3b8; text-transform: uppercase; padding-bottom: 15px; border-bottom: 1px solid #f1f5f9;" width="120">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $subtotal = 0; @endphp
                                                @foreach($order->items as $item)
                                                @php $subtotal += $item->line_total; @endphp
                                                <tr>
                                                    <td style="padding: 20px 0; border-bottom: 1px solid #f8f9fa; font-size: 15px; color: #1e293b; font-weight: 500;">{{ $item->product_name }}</td>
                                                    <td style="padding: 20px 0; border-bottom: 1px solid #f8f9fa; text-align: center; font-size: 15px; color: #475569;">{{ $item->quantity }}</td>
                                                    <td style="padding: 20px 0; border-bottom: 1px solid #f8f9fa; text-align: right; font-size: 15px; color: #1e293b; font-weight: 600;">₹{{ number_format($item->line_total, 2) }}</td>
                                                </tr>
                                                @endforeach
                                                
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 20px 15px 5px 0; font-size: 14px; color: #94a3b8;">Subtotal:</td>
                                                    <td style="text-align: right; padding: 20px 0 5px 0; font-size: 15px; color: #1e293b; font-weight: 600;">₹{{ number_format($subtotal, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 5px 15px 5px 0; font-size: 14px; color: #94a3b8;">Shipping:</td>
                                                    <td style="text-align: right; padding: 5px 0; font-size: 15px; color: #1e293b; font-weight: 600;">₹{{ number_format($order->shipping_cost ?? 0, 2) }}</td>
                                                </tr>
                                                @if($order->discount_amount > 0)
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 5px 15px 5px 0; font-size: 14px; color: #dc2626;">Discount:</td>
                                                    <td style="text-align: right; padding: 5px 0; font-size: 15px; color: #dc2626; font-weight: 600;">-₹{{ number_format($order->discount_amount, 2) }}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 25px 15px 20px 0; font-size: 16px; font-weight: 700; color: #D81B60;">Total Amount:</td>
                                                    <td style="text-align: right; padding: 25px 0 20px 0; font-size: 18px; font-weight: 800; color: #D81B60;">₹{{ number_format($order->amount, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <div align="center" style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #f1f5f9;">
                                <a href="{{ url('/customer/orders/' . $order->id) }}" style="display: inline-block; background-color: #063a17; color: #ffffff; padding: 18px 50px; border-radius: 12px; text-decoration: none; font-size: 16px; font-weight: 700;">Track Your Order</a>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 40px; background-color: #f8fafc; border-top: 1px solid #f1f5f9;">
                            <div style="color: #94a3b8; font-size: 13px; line-height: 1.6;">
                                <strong style="color: #334155;">Auvri Plus</strong><br/>
                                Traditional Wisdom, Modern Science<br/>
                                © {{ date('Y') }} All Rights Reserved.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
