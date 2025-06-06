<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - Mr Solution</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f4f7fa;
            color: #333333;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #6c5ce7;
            padding: 20px;
            text-align: center;
        }

        .header img {
            max-width: 120px;
            height: auto;
        }

        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin-top: 10px;
            font-weight: 600;
        }

        .content {
            padding: 30px;
            text-align: center;
        }

        .content h2 {
            font-size: 20px;
            color: #6c5ce7;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .content p {
            font-size: 16px;
            color: #555555;
            margin-bottom: 20px;
        }

        .otp-code {
            display: inline-block;
            background-color: #a29bfe;
            color: #ffffff;
            padding: 15px 25px;
            font-size: 24px;
            font-weight: 700;
            border-radius: 6px;
            margin: 20px 0;
            letter-spacing: 2px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #6c5ce7;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            border-radius: 6px;
            margin: 15px 0;
        }

        .button:hover {
            background-color: #5a4ad1;
        }

        .footer {
            background-color: #f4f7fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #777777;
        }

        .footer a {
            color: #6c5ce7;
            text-decoration: none;
        }

        @media only screen and (max-width: 600px) {
            .container {
                margin: 10px;
            }

            .content {
                padding: 20px;
            }

            .otp-code {
                font-size: 20px;
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://mrsolution.com.ng/images/mrsolution.jpeg" alt="Mr Solution Logo">
            <h1>Mr Solution Tech</h1>
        </div>
        <div class="content">
            <h2>Welcome, {{ $notifiable->email }}!</h2>
            <p>Thank you for joining Mr Solution Tech. To verify your email, please use the OTP code below or click the
                button:</p>
            <div class="otp-code">{{ $otpCode }}</div>
            <p>This OTP expires in 10 minutes.</p>
            <a href="{{ $verificationUrl }}" class="button">Verify Your Email</a>
            <p>If you didn’t register, please contact <a href="https://mrsolution.com.ng/support-email">support</a>.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Mr Solution Tech. All rights reserved.</p>
            <p><a href="https://mrsolution.com.ng/support-email">Contact Support</a> | <a
                    href="https://mrsolution.com/support-privacy">Privacy Policy</a></p>
        </div>
    </div>
</body>

</html>