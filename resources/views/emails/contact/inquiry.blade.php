<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inquiry - Auvri Plus</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Outfit', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 0;
            color: #1e293b;
        }
        
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        }
        
        .header {
            background: #063a17;
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .content {
            padding: 40px;
        }
        
        .inquiry-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .field {
            margin-bottom: 15px;
            border-bottom: 1px solid #eef2f6;
            padding-bottom: 12px;
        }
        
        .field:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        .value {
            font-size: 15px;
            color: #334155;
            font-weight: 600;
        }
        
        .message-box {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
            margin-top: 10px;
            border-left: 4px solid #063a17;
        }
        
        .footer {
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            font-size: 13px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('auri-images/logo.png')) }}" alt="Auvri Plus Logo" style="max-width: 150px; height: auto; margin-bottom: 15px;">
            <h1>New Customer Inquiry</h1>
            <p style="opacity: 0.8; margin-top: 5px; font-size: 14px;">Someone is trying to reach out to you via Auvri Plus</p>
        </div>
        
        <div class="content">
            <div class="inquiry-card">
                <div class="field">
                    <span class="label">Full Name</span>
                    <span class="value">{{ $inquiry['name'] }}</span>
                </div>
                <div class="field">
                    <span class="label">Email Address</span>
                    <span class="value">{{ $inquiry['email'] }}</span>
                </div>
                <div class="field">
                    <span class="label">Phone Number</span>
                    <span class="value">{{ $inquiry['phone'] ?? 'Not provided' }}</span>
                </div>
                <div class="field">
                    <span class="label">Subject</span>
                    <span class="value">{{ $inquiry['subject'] }}</span>
                </div>
                <div class="field">
                    <span class="label">Message</span>
                    <div class="message-box">
                        {!! nl2br(e($inquiry['message'])) !!}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} <strong>Auvri Plus</strong>. Admin Portal Notification.</p>
            <p>This message was sent from your website contact form.</p>
        </div>
    </div>
</body>
</html>
