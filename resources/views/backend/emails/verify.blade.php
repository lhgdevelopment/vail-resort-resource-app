<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - {{ settings('site_name', 'VAIL RESORTS') }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #032e5c 0%, #1e4a7b 100%);
            padding: 30px 20px;
            text-align: center;
        }
        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 15px;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #032e5c;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        .verification-button {
            display: inline-block;
            background: linear-gradient(135deg, #032e5c 0%, #1e4a7b 100%);
            color: #ffffff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            transition: all 0.3s ease;
        }
        .verification-button:hover {
            background: linear-gradient(135deg, #1e4a7b 0%, #032e5c 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(3, 46, 92, 0.3);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
            color: #6c757d;
            font-size: 14px;
        }
        .security-note {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .security-note p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        .contact-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        .contact-info p {
            margin: 5px 0;
            color: #6c757d;
            font-size: 14px;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                box-shadow: none;
            }
            .content {
                padding: 20px 15px;
            }
            .header {
                padding: 20px 15px;
            }
            .verification-button {
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            @if(settings('logo_white'))
                <img src="{{ url('storage/' . settings('logo_white')) }}" alt="{{ settings('site_name', 'VAIL RESORTS') }}" class="logo">
            @endif
            <h1>Email Verification</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello {{ $user->name }},
            </div>

            <div class="message">
                Thank you for registering with <strong>{{ settings('site_name', 'VAIL RESORTS') }}</strong>! To complete your registration and access your account, please verify your email address by clicking the button below.
            </div>

            <div style="text-align: center;">
                <a href="{{ url('verify/' . $user->email_verification_token) }}" class="verification-button">
                    Verify Email Address
                </a>
            </div>

            <div class="security-note">
                <p><strong>Security Note:</strong> This verification link will expire for security reasons. If you didn't create an account with us, please ignore this email.</p>
            </div>

            <div class="message">
                If the button above doesn't work, you can copy and paste the following link into your browser:
                <br><br>
                <a href="{{ url('verify/' . $user->email_verification_token) }}" style="color: #032e5c; word-break: break-all;">
                    {{ url('verify/' . $user->email_verification_token) }}
                </a>
            </div>

            <div class="contact-info">
                <p><strong>Need Help?</strong></p>
                @if(settings('contact'))
                    <p>{{ settings('contact') }}</p>
                @else
                    <p>If you have any questions, please contact our support team.</p>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ settings('site_name', 'VAIL RESORTS') }}. All rights reserved.</p>
            <p>This email was sent to {{ $user->email }}</p>
        </div>
    </div>
</body>
</html>
