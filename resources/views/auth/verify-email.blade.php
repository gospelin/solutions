<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email - Mr Solution</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        .login-page {
            background-color: #f4f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            max-width: 800px;
            display: flex;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .content-section {
            background-color: #6c5ce7;
            color: #ffffff;
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .content-section h2 {
            font-size: 24px;
            margin-bottom: 16px;
        }

        .content-section p {
            font-size: 16px;
        }

        .back-home {
            color: #a29bfe;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .back-home:hover {
            text-decoration: underline;
        }

        .login-section {
            padding: 40px;
            flex: 1;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-section img {
            max-width: 120px;
            height: auto;
        }

        .welcome-text {
            font-size: 20px;
            color: #6c5ce7;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: #555555;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        .form-label {
            position: absolute;
            top: 12px;
            left: 12px;
            color: #999;
            transition: all 0.2s;
            pointer-events: none;
        }

        .form-input:focus+.form-label,
        .form-input:not(:placeholder-shown)+.form-label {
            top: -8px;
            left: 8px;
            font-size: 12px;
            color: #6c5ce7;
            background: #ffffff;
            padding: 0 4px;
        }

        .validation-message {
            color: #e3342f;
            font-size: 12px;
            margin-top: 4px;
        }

        .login-btn {
            background-color: #6c5ce7;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color: #5a4ad1;
        }

        .social-btn {
            background-color: #a29bfe;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            width: 100%;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .social-btn:hover {
            background-color: #8c7dfe;
        }

        .message-success {
            color: #38c172;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .message-error {
            color: #e3342f;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .register-link a {
            color: #6c5ce7;
            text-decoration: none;
            font-size: 14px;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="login-page">
    <div class="particles"></div>
    <div class="container">
        <div class="auth-container">
            <div class="content-section">
                <a href="{{ url('/') }}" class="back-home">Back to Home</a>
                <h2>Verify Your Email</h2>
                <p>Please check your email for a verification link or enter the OTP sent to your email address.</p>
            </div>
            <div class="login-section">
                <div class="logo-section">
                    <img src="https://mrsolution.com.ng/images/mrsolution.jpeg" alt="Mr Solution Logo">
                    <h1 class="welcome-text">Verify Email</h1>
                    <p class="subtitle">Complete your registration</p>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <div class="message-success">A new verification link has been sent to your email.</div>
                @endif
                @if (session('error'))
                    <div class="message-error">{{ session('error') }}</div>
                @endif
                <p>A verification link and OTP have been sent to <strong>{{ Auth::user()->email }}</strong>. Please
                    check your inbox or spam folder.</p>
                <form method="POST" action="{{ route('verification.verify.otp') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="otp" name="otp" class="form-input" placeholder=" " required maxlength="6"
                            pattern="\d{6}">
                        <label for="otp" class="form-label">Enter OTP</label>
                        <div class="validation-message" id="otpValidation">
                            @error('otp')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="login-btn">Verify OTP</button>
                </form>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="social-btn" style="width: 100%; margin-top: 16px;">Resend Verification
                        Email</button>
                </form>
                <div class="register-link" style="margin-top: 16px;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">Log out</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</body>

</html>