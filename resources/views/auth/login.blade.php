<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Premium Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Modern accessible color palette */
            --primary: #3B82F6;
            --primary-hover: #2563EB;
            --primary-light: #EFF6FF;
            --secondary: #6366F1;
            --secondary-hover: #4F46E5;
            --accent: #10B981;
            --accent-hover: #059669;
            --background: #FFFFFF;
            --surface: #F8FAFC;
            --surface-hover: #F1F5F9;
            --border: #E2E8F0;
            --border-focus: #CBD5E1;
            --dark-background: #0F172A;
            --dark-surface: #1E293B;
            --dark-surface-hover: #334155;
            --dark-border: #475569;
            --dark-border-focus: #64748B;
            --text-primary: #0F172A;
            --text-secondary: #475569;
            --text-muted: #64748B;
            --text-inverse: #FFFFFF;
            --text-inverse-secondary: #CBD5E1;
            --success: #10B981;
            --error: #EF4444;
            --warning: #F59E0B;
            --info: #3B82F6;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--surface) 0%, #E0E7FF 100%);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            color: var(--text-primary);
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(99, 102, 241, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(16, 185, 129, 0.03) 0%, transparent 50%);
            z-index: -1;
            animation: subtleFloat 20s ease-in-out infinite;
        }

        @keyframes subtleFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(180deg);
            }
        }

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0.1;
            animation: particleFloat 20s linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }

            10% {
                opacity: 0.1;
            }

            90% {
                opacity: 0.1;
            }

            100% {
                transform: translateY(-100vh) translateX(50px);
                opacity: 0;
            }
        }

        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 2;
        }

        .auth-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 1200px;
            min-height: 700px;
            background: var(--background);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            position: relative;
        }

        .content-section {
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            position: relative;
            overflow: hidden;
        }

        .content-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            z-index: 1;
        }

        .back-home {
            color: var(--text-inverse-secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .back-home:hover {
            color: var(--text-inverse);
            transform: translateX(-5px);
        }

        .back-home::before {
            content: '←';
            font-size: 16px;
        }

        .content-section h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            font-weight: 700;
            color: var(--text-inverse);
            margin-bottom: 20px;
            line-height: 1.2;
            position: relative;
            z-index: 2;
        }

        .content-section p {
            font-size: 18px;
            color: var(--text-inverse-secondary);
            margin-bottom: 40px;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 32px;
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-inverse);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 2;
            overflow: hidden;
            width: fit-content;
        }

        .cta-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .login-section {
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            background: var(--background);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--text-inverse);
            margin: 0 auto 24px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .welcome-text {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 16px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px;
            background: var(--surface);
            border: 2px solid var(--border);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 16px;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--background);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }

        .form-input:not(:placeholder-shown)+.form-label,
        .form-input:focus+.form-label {
            transform: translateY(-28px) scale(0.85);
            color: var(--primary);
            font-weight: 500;
        }

        .form-label {
            position: absolute;
            left: 20px;
            top: 16px;
            color: var(--text-muted);
            font-size: 16px;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: left center;
            background: var(--background);
            padding: 0 4px;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 18px;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--text-primary);
            background: var(--surface);
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid var(--border);
            border-radius: 6px;
            background: var(--background);
            cursor: pointer;
            position: relative;
            appearance: none;
            transition: all 0.3s ease;
        }

        .checkbox:checked {
            background: var(--primary);
            border-color: var(--primary);
        }

        .checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--text-inverse);
            font-size: 12px;
            font-weight: 700;
        }

        .checkbox:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .checkbox-label {
            color: var(--text-secondary);
            font-size: 14px;
            cursor: pointer;
            user-select: none;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 32px;
        }

        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .forgot-password a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            border: none;
            border-radius: 12px;
            color: var(--text-inverse);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .login-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid var(--text-inverse);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translateY(-50%) rotate(0deg);
            }

            100% {
                transform: translateY(-50%) rotate(360deg);
            }
        }

        .divider {
            text-align: center;
            margin: 32px 0;
            position: relative;
            color: var(--text-muted);
            font-size: 14px;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            background: var(--background);
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .social-login {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
        }

        .social-btn {
            flex: 1;
            padding: 16px;
            background: var(--surface);
            border: 2px solid var(--border);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .social-btn:hover {
            background: var(--surface-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .social-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .google:hover {
            border-color: #db4437;
            color: #db4437;
        }

        .facebook:hover {
            border-color: #1877f2;
            color: #1877f2;
        }

        .twitter:hover {
            border-color: #1da1f2;
            color: #1da1f2;
        }

        .register-link {
            text-align: center;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .error-message,
        .success-message {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            border: 1px solid;
        }

        .error-message {
            background: #FEF2F2;
            border-color: #FCA5A5;
            color: #DC2626;
        }

        .success-message {
            background: #F0FDF4;
            border-color: #86EFAC;
            color: #166534;
        }

        .validation-message {
            font-size: 12px;
            margin-top: 8px;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(-5px);
        }

        .validation-message.error {
            color: var(--error);
            opacity: 1;
            transform: translateY(0);
        }

        .validation-message.success {
            color: var(--success);
            opacity: 1;
            transform: translateY(0);
        }

        .form-input.error {
            border-color: var(--error);
            background: #FEF2F2;
        }

        .form-input.success {
            border-color: var(--success);
            background: #F0FDF4;
        }

        @media (max-width: 1024px) {
            .auth-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .content-section,
            .login-section {
                padding: 40px;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 16px;
            }

            .auth-container {
                border-radius: 16px;
                min-height: auto;
            }

            .content-section,
            .login-section {
                padding: 32px 24px;
            }

            .content-section h2 {
                font-size: 2rem;
                margin-bottom: 16px;
            }

            .content-section p {
                font-size: 16px;
                margin-bottom: 24px;
            }

            .welcome-text {
                font-size: 24px;
            }

            .logo {
                width: 60px;
                height: 60px;
                font-size: 24px;
                margin-bottom: 20px;
            }
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--surface);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        *:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        .form-input:focus,
        .login-btn:focus,
        .social-btn:focus,
        .checkbox:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="particles"></div>
    <div class="container">
        <div class="auth-container">
            <div class="content-section">
                <a href="{{ url('/') }}" class="back-home">Back to Home</a>
                <h2>Join Our Premium Portal</h2>
                <p>Access exclusive content, personalized insights, and a seamless experience. Transform your digital journey today!</p>
                <a href="{{ route('register') }}" class="cta-btn">Get Started</a>
            </div>
            <div class="login-section">
                <div class="logo-section">
                    <div class="logo">P</div>
                    <h1 class="welcome-text">Welcome Back</h1>
                    <p class="subtitle">Sign in to your account</p>
                </div>
                @if ($errors->any())
                <div class="error-message" id="errorMessage" style="display: block;">
                    {{ $errors->first() }}
                </div>
                @else
                <div class="error-message" id="errorMessage">
                    Invalid credentials. Please try again.
                </div>
                @endif
                @if (session('status'))
                <div class="success-message" id="successMessage" style="display: block;">
                    {{ session('status') }}
                </div>
                @else
                <div class="success-message" id="successMessage">
                    Login successful! Redirecting...
                </div>
                @endif
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-input" placeholder=" " value="{{ old('email') }}" required autofocus>
                        <label for="email" class="form-label">Email Address</label>
                        <div class="validation-message" id="emailValidation"></div>
                    </div>
                    <div class="form-group">
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" class="form-input" placeholder=" " required>
                            <label for="password" class="form-label">Password</label>
                            <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="validation-message" id="passwordValidation"></div>
                    </div>
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" class="checkbox">
                        <label for="remember" class="checkbox-label">Remember me</label>
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
                    <span>Or continue with</span>
                </div>
                <div class="social-login">
                    <button class="social-btn google" id="googleLogin" title="Continue with Google" aria-label="Sign in with Google">
                        <i class="fab fa-google"></i>
                    </button>
                    <button class="social-btn facebook" id="facebookLogin" title="Continue with Facebook" aria-label="Sign in with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button class="social-btn twitter" id="twitterLogin" title="Continue with X" aria-label="Sign in with X">
                        <i class="fab fa-x-twitter"></i>
                    </button>
                </div>
                <div class="register-link">
                    Don't have an account? <a href="{{ route('register') }}" id="registerLink">Sign up here</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function createParticles() {
                const particlesContainer = document.querySelector('.particles');
                const particleCount = 50;
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 15 + 's';
                    particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                    particlesContainer.appendChild(particle);
                }
            }
            createParticles();

            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            const loginButton = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');

            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            passwordToggle.addEventListener('click', () => {
                const icon = passwordToggle.querySelector('i');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            emailInput.addEventListener('input', debounce(function() {
                const email = this.value.trim();
                const emailValidation = document.getElementById('emailValidation');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) {
                    this.classList.remove('success', 'error');
                    emailValidation.classList.remove('success', 'error');
                    emailValidation.textContent = '';
                } else if (!emailRegex.test(email)) {
                    this.classList.add('error');
                    this.classList.remove('success');
                    emailValidation.textContent = 'Please enter a valid email address';
                    emailValidation.classList.add('error');
                    emailValidation.classList.remove('success');
                } else {
                    this.classList.remove('error');
                    this.classList.add('success');
                    emailValidation.textContent = '✓ Valid email';
                    emailValidation.classList.remove('error');
                    emailValidation.classList.add('success');
                }
            }, 300));

            passwordInput.addEventListener('input', debounce(function() {
                const password = this.value;
                const passwordValidation = document.getElementById('passwordValidation');
                if (!password) {
                    this.classList.remove('success', 'error');
                    passwordValidation.classList.remove('success', 'error');
                    passwordValidation.textContent = '';
                } else if (password.length < 6) {
                    this.classList.add('error');
                    this.classList.remove('success');
                    passwordValidation.textContent = 'Password must be at least 6 characters';
                    passwordValidation.classList.add('error');
                    passwordValidation.classList.remove('success');
                } else {
                    this.classList.remove('error');
                    this.classList.add('success');
                    passwordValidation.textContent = '✓ Password looks good';
                    passwordValidation.classList.remove('error');
                    passwordValidation.classList.add('success');
                }
            }, 300));

            loginForm.addEventListener('submit', function(e) {
                loginButton.classList.add('loading');
                buttonText.textContent = 'Signing In...';
                loginButton.disabled = true;
                errorMessage.style.display = 'none';
                successMessage.style.display = 'none';
            });

            document.getElementById('googleLogin').addEventListener('click', () => {
                gsap.to('#googleLogin', {
                    scale: 0.95,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
                console.log('Google sign-in clicked');
            });

            document.getElementById('facebookLogin').addEventListener('click', () => {
                gsap.to('#facebookLogin', {
                    scale: 0.95,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
                console.log('Facebook sign-in clicked');
            });

            document.getElementById('twitterLogin').addEventListener('click', () => {
                gsap.to('#twitterLogin', {
                    scale: 0.95,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
                console.log('Twitter sign-in clicked');
            });

            document.querySelectorAll('.form-input').forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        loginForm.dispatchEvent(new Event('submit'));
                    }
                });
            });

            const isMobile = window.matchMedia('(max-width: 768px)').matches;
            gsap.set(['.content-section > *', '.form-group', '.login-btn', '.social-login', '.register-link'], {
                opacity: 0,
                y: 30
            });
            gsap.set('.logo', {
                opacity: 0,
                scale: 0.8,
                rotationY: 180
            });
            const tl = gsap.timeline({
                delay: 0.2
            });
            tl.to('.auth-container', {
                    opacity: 1,
                    scale: 1,
                    duration: 0.8,
                    ease: "back.out(1.2)"
                })
                .to('.logo', {
                    opacity: 1,
                    scale: 1,
                    rotationY: 0,
                    duration: 0.8,
                    ease: "back.out(1.7)"
                }, '-=0.4')
                .to('.content-section > *', {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.1,
                    ease: "power3.out"
                }, '-=0.6')
                .to(['.welcome-text', '.subtitle'], {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    ease: "power3.out"
                }, '-=0.4')
                .to('.form-group', {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    stagger: 0.1,
                    ease: "power3.out"
                }, '-=0.3')
                .to(['.remember-me', '.forgot-password'], {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    ease: "power3.out"
                }, '-=0.2')
                .to('.login-btn', {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    ease: "back.out(1.7)"
                }, '-=0.2')
                .to(['.divider', '.social-login', '.register-link'], {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    stagger: 0.1,
                    ease: "power3.out"
                }, '-=0.3');

            const interactiveElements = document.querySelectorAll('.form-input, .login-btn, .social-btn, .cta-btn');
            interactiveElements.forEach(element => {
                element.addEventListener('mouseenter', () => {
                    gsap.to(element, {
                        scale: 1.02,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
                element.addEventListener('mouseleave', () => {
                    gsap.to(element, {
                        scale: 1,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
            });

            gsap.to('.content-section::before', {
                rotation: 360,
                duration: 60,
                repeat: -1,
                ease: "none"
            });
            gsap.to('.logo', {
                y: -5,
                duration: 2,
                repeat: -1,
                yoyo: true,
                ease: "power2.inOut"
            });

            function animateParticles() {
                const particles = document.querySelectorAll('.particle');
                particles.forEach((particle, index) => {
                    gsap.set(particle, {
                        x: Math.random() * window.innerWidth,
                        y: window.innerHeight + 10,
                        opacity: 0
                    });
                    gsap.to(particle, {
                        y: -100,
                        x: `+=${Math.random() * 200 - 100}`,
                        opacity: 1,
                        duration: Math.random() * 10 + 10,
                        repeat: -1,
                        delay: Math.random() * 5,
                        ease: "none",
                        onComplete: () => {
                            gsap.set(particle, {
                                y: window.innerHeight + 10,
                                opacity: 0
                            });
                        }
                    });
                });
            }
            animateParticles();

            document.querySelectorAll('input, button, a').forEach(element => {
                element.addEventListener('focus', () => {
                    gsap.to(element, {
                        boxShadow: "0 0 20px rgba(79, 172, 254, 0.3)",
                        duration: 0.3
                    });
                });
                element.addEventListener('blur', () => {
                    gsap.to(element, {
                        boxShadow: "none",
                        duration: 0.3
                    });
                });
            });

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallax = scrolled * 0.5;
                gsap.to('.content-section::before', {
                    transform: `translateY(${parallax}px)`,
                    duration: 0.1
                });
            });

            const mediaQuery = window.matchMedia('(max-width: 768px)');

            function handleScreenChange(e) {
                if (e.matches) {
                    gsap.set('.auth-container', {
                        scale: 1,
                        transformOrigin: "center center"
                    });
                } else {
                    gsap.set('.auth-container', {
                        scale: 1,
                        transformOrigin: "center center"
                    });
                }
            }
            mediaQuery.addListener(handleScreenChange);
            handleScreenChange(mediaQuery);

            const isLowEndDevice = navigator.hardwareConcurrency < 4;
            if (isLowEndDevice) {
                gsap.globalTimeline.timeScale(1.5);
                document.querySelectorAll('.particle').forEach((particle, index) => {
                    if (index > 20) particle.remove();
                });
            }

            console.log('Premium login page initialized successfully!');
        });
    </script>
</body>

</html>