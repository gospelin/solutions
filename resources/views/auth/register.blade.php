<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Premium Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="login-page">
    <div class="particles"></div>
    <div class="container">
        <div class="auth-container">
            <div class="content-section">
                <a href="{{ url('/') }}" class="back-home">Back to Home</a>
                <h2>Join Our Premium Portal</h2>
                <p>Create an account to access exclusive content, personalized insights, and a seamless experience.</p>
                <a href="{{ route('register') }}" class="cta-btn">Get Started</a>
            </div>
            <div class="login-section">
                <div class="logo-section">
                    <div class="logo">MS</div>
                    <h1 class="welcome-text">Get Started</h1>
                    <p class="subtitle">Create a new account</p>
                </div>
                @if ($errors->any())
                <div class="error-message" id="errorMessage" style="display: block;">
                    {{ $errors->first() }}
                </div>
                @else
                <div class="error-message" id="errorMessage">
                    Please fix the errors below.
                </div>
                @endif
                @if (session('status'))
                <div class="success-message" id="successMessage" style="display: block;">
                    {{ session('status') }}
                </div>
                @else
                <div class="success-message" id="successMessage">
                    Registration successful! Redirecting...
                </div>
                @endif
                <form id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-input {{ $errors->has('name') ? 'error' : '' }}" placeholder=" " value="{{ old('name') }}" required>
                        <label for="name" class="form-label">Full Name</label>
                        <div class="validation-message" id="nameValidation">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}" placeholder=" " value="{{ old('email') }}" required>
                        <label for="email" class="form-label">Email Address</label>
                        <div class="validation-message" id="emailValidation">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}" placeholder=" " required>
                            <label for="password" class="form-label">Password</label>
                            <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="validation-message" id="passwordValidation">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div style="position: relative;">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input {{ $errors->has('password_confirmation') ? 'error' : '' }}" placeholder=" " required>
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <button type="button" class="password-toggle" id="passwordConfirmToggle" aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="validation-message" id="passwordConfirmationValidation"></div>
                    </div>
                    <div class="remember-me">
                        <input type="checkbox" id="terms" name="terms" class="checkbox" required>
                        <label for="terms" class="checkbox-label">I agree to the <a href="/terms" id="termsLink">Terms & Conditions</a></label>
                    </div>
                    <button type="submit" class="login-btn" id="registerButton">
                        <span id="buttonText">Sign Up</span>
                    </button>
                </form>
                <div class="divider">
                    <span>Or sign up with</span>
                </div>
                <div class="social-login">
                    <button class="social-btn google" id="googleLogin" title="Sign up with Google" aria-label="Sign up with Google">
                        <i class="fab fa-google"></i>
                    </button>
                    <button class="social-btn facebook" id="facebookLogin" title="Sign up with Facebook" aria-label="Sign up with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button class="social-btn twitter" id="twitterLogin" title="Sign up with X" aria-label="Sign up with X">
                        <i class="fab fa-x-twitter"></i>
                    </button>
                </div>
                <div class="register-link">
                    Already have an account? <a href="{{ route('login') }}" id="registerLink">Sign in here</a>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    @endpush
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</body>

</html>