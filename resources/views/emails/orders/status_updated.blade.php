<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Order Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7f6; font-family: 'Outfit', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 40px 0 30px 0; background: linear-gradient(135deg, #063a17 0%, #0a5a24 100%);">
                            <img src="{{ $message->embed(public_path('auri-images/logo.png')) }}" alt="Auvri Plus" width="160" style="display: block; margin-bottom: 15px;" />
                            <h1 style="color: #ffffff; font-size: 26px; margin: 0; font-weight: 700; letter-spacing: -0.5px;">Order Update</h1>
                        </td>
                    </tr>
                    
                    <!-- Main Body -->
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #1e293b; font-size: 18px; font-weight: 600;">
                                        Hello {{ $order->customer_name }},
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 0 10px 0; color: #64748b; font-size: 16px; line-height: 24px;">
                                        Exciting news! Your order status has been updated. We are working hard to get your traditional wellness products to you as soon as possible.
                                    </td>
                                </tr>
                                
                                <!-- Status Badge -->
                                <tr>
                                    <td align="center" style="padding: 30px 0;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="background-color: #ecfdf5; border: 1px solid #10b981; border-radius: 50px; padding: 12px 35px; color: #065f46; font-size: 20px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                                                    {{ str_replace('_', ' ', $order->status) }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Order Details Box -->
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border-radius: 16px; padding: 25px;">
                                            <tr>
                                                <td style="color: #063a17; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
                                                    Order Information
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 15px;">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td style="color: #94a3b8; font-size: 13px; font-weight: 600; padding: 5px 0;">Order Number:</td>
                                                            <td style="color: #334155; font-size: 14px; font-weight: 700; text-align: right; padding: 5px 0;">#{{ $order->order_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="color: #94a3b8; font-size: 13px; font-weight: 600; padding: 5px 0;">Update Time:</td>
                                                            <td style="color: #334155; font-size: 14px; font-weight: 700; text-align: right; padding: 5px 0;">{{ now()->format('d M, Y h:i A') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="color: #94a3b8; font-size: 13px; font-weight: 600; padding: 5px 0;">Total Amount:</td>
                                                            <td style="color: #063a17; font-size: 16px; font-weight: 800; text-align: right; padding: 5px 0;">₹{{ number_format($order->amount, 2) }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- CTA Button -->
                                <tr>
                                    <td align="center" style="padding: 40px 0 0 0;">
                                        <a href="{{ route('customer.orders.show', $order->id) }}" style="background-color: #063a17; color: #ffffff; padding: 18px 45px; border-radius: 14px; text-decoration: none; font-size: 16px; font-weight: 700; box-shadow: 0 10px 20px rgba(6, 58, 23, 0.15);">Track Your Journey</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 30px; background-color: #f8fafc; border-top: 1px solid #f1f5f9;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="color: #94a3b8; font-size: 13px; line-height: 20px;">
                                        <strong style="color: #334155;">Auvri Plus</strong><br/>
                                        Traditional Wisdom, Modern Science<br/>
                                        © {{ date('Y') }} All Rights Reserved.
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 20px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding: 0 10px;"><a href="#" style="color: #063a17; text-decoration: none; font-size: 12px; font-weight: 600;">Facebook</a></td>
                                                <td style="color: #e2e8f0;">|</td>
                                                <td style="padding: 0 10px;"><a href="#" style="color: #063a17; text-decoration: none; font-size: 12px; font-weight: 600;">Instagram</a></td>
                                                <td style="color: #e2e8f0;">|</td>
                                                <td style="padding: 0 10px;"><a href="#" style="color: #063a17; text-decoration: none; font-size: 12px; font-weight: 600;">WhatsApp</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 25px; color: #cbd5e1; font-size: 11px;">
                                        This is an automated notification. Please do not reply directly to this email.<br/>
                                        Need help? Contact us at <a href="mailto:care@auvriplus.com" style="color: #063a17; text-decoration: underline;">care@auvriplus.com</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
