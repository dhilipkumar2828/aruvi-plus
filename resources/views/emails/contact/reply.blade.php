<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Customer Support Response</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.05);">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 45px 0; background-color: #063a17;">
                            <img src="{{ $message->embed(public_path('auri-images/logo.png')) }}" alt="Auvri Plus" width="150" style="display: block;" />
                        </td>
                    </tr>
                    
                    <!-- Content Area -->
                    <tr>
                        <td style="padding: 45px 35px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #1e293b; font-size: 20px; font-weight: 700; padding-bottom: 25px;">
                                        Hello {{ $inquiry->name }},
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #475569; font-size: 16px; line-height: 1.6; padding-bottom: 30px;">
                                        Thank you for contacting Auvri Plus support. We have reviewed your inquiry regarding <strong>"{{ $inquiry->subject }}"</strong>.
                                    </td>
                                </tr>
                                
                                <!-- Admin Response Box -->
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 30px;">
                                            <tr>
                                                <td style="color: #0f172a; font-size: 16px; line-height: 1.8; white-space: pre-wrap;">{{ $replyMessage }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style="padding: 35px 0 10px 0; color: #64748b; font-size: 15px; line-height: 1.6;">
                                        If there is anything else we can help you with, please don't hesitate to reach out.
                                    </td>
                                </tr>
                                
                                <!-- Original Inquiry Snippet -->
                                <tr>
                                    <td style="padding-top: 40px; border-top: 1px solid #f1f5f9;">
                                        <div style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;">Your Original Inquiry</div>
                                        <div style="font-style: italic; color: #64748b; font-size: 14px; padding-left: 20px; border-left: 3px solid #063a17;">
                                            "{{ $inquiry->message }}"
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 35px; background-color: #f8fafc; border-top: 1px solid #f1f5f9; text-align: center;">
                            <div style="color: #94a3b8; font-size: 13px;">
                                <strong style="color: #334155;">Auvri Plus Team</strong><br/>
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
