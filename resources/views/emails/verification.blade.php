<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Waisaka Property</h1>
    </div>
    
    <div class="content">
        <h2>Hello, {{ $userName }}!</h2>
        
        <p>Thank you for registering with Waisaka Property. To complete your registration, please verify your email address by clicking the button below:</p>
        
        <div style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
        </div>
        
        <p>Or copy and paste this link into your browser:</p>
        <p style="word-break: break-all; background-color: #fff; padding: 10px; border-radius: 3px;">
            {{ $verificationUrl }}
        </p>
        
        <p><strong>This link will expire in 24 hours.</strong></p>
        
        <p>If you didn't create an account with Waisaka Property, please ignore this email.</p>
        
        <div class="footer">
            <p>&copy; 2024 Waisaka Property. All rights reserved.</p>
            <p>This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html>