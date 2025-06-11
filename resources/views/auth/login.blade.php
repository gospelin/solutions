<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Premium Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" defer>

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mrsolution.com.ng">
    <meta property="og:image" content="{{ asset('images/mrsolution.jpeg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@mrsolution">
    <meta name="twitter:title" content="Mr Solution - Revolutionary Tech Solutions">
    <meta name="twitter:description" content="Leading-edge technology solutions powered by AI and innovation.">
    <meta name="twitter:image" content="{{ asset('images/mrsolution.jpeg') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/mrsolution.jpeg') }}" type="image/x-icon">
</head>

<body class="login-page">
    <div class="particles"></div>
    <div class="container">
        <div class="auth-container">
            <div class="content-section">
                <a href="{{ url('/') }}" class="back-home">Back to Home</a>
                <h2>Sign In</h2>
                <p>Access exclusive content, personalized insights, and a seamless experience. Transform your digital journey today!</p>
                <a href="{{ route('register') }}" class="cta-btn">Get Started</a>
            </div>
            <div class="login-section">
                <div class="logo-section">
                    <div class="logo">M</div>
                    <h1 class="welcome-text">Welcome Back</h1>
                    <p class="subtitle">Sign in to your account</p>
                </div>
                @if (session('status'))
                    <div class="message-success" style="display: block;">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="message-error" style="display: block;">
                        {{ session('error') }}
                    </div>
                @else
                    <div class="message-error" id="errorMessage" style="display: none;">
                        Invalid credentials. Please try again.
                    </div>
                @endif
                <form id="loginForm" method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-input" placeholder=" "
                            value="{{ old('email') }}" required>
                        <label for="email" class="form-label">Email Address</label>
                        <div class="validation-message" id="emailValidation">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" class="form-input" placeholder=" "
                                required>
                            <label for="password" class="form-label">Password</label>
                            <button type="button" class="password-toggle" id="passwordToggle"
                                aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="validation-message" id="passwordValidation">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="remember-me">
                        <input type="checkbox" id="cloud" name="remember" class="checkbox">
                        <label for="cloud" class="checkbox-label">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" id="forgotPassword">Forgot your password?</a>
                        @endif
                    </div>
                    <button type="submit" class="login-btn" id="loginButton">
                        <span id="buttonText">Sign In</span>
                    </button>
                </form>
                <div class="divider">
                    <span>or continue with</span>
                </div>
                <div class="social-login">
                    <button class="social-btn google" id="googleLogin" title="Continue with Google"
                        aria-label="Sign in with Google">
                        <i class="fab fa-google"></i>
                    </button>
                    <button class="social-btn facebook" id="facebookLogin" title="Continue with Facebook"
                        aria-label="Sign in with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button class="social-btn twitter" id="twitterLogin" title="Continue with Twitter"
                        aria-label="Sign in with Twitter">
                        <i class="fab fa-twitter"></i>
                    </button>
                </div>
                <div class="register-link">
                    Don't have an account? <a href="{{ route('register') }}" id="registerLink">Sign up here</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</body>

</html>