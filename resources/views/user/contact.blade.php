@extends('user.layouts.app')

@section('title', 'Contact Us - Mr Solution')

@section('description', 'Get in touch with Mr Solution to request tools or inquire about our services.')

@push('styles')
    <style>
        .contact-container {
            padding: var(--space-lg) var(--space-md);
            background: var(--dark-bg);
        }

        .contact-breadcrumb {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            color: var(--gray-400);
            margin-bottom: var(--space-xl);
        }

        .contact-breadcrumb a {
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-breadcrumb a:hover {
            color: var(--primary);
        }

        .contact-breadcrumb .active {
            color: var(--white);
            font-weight: 600;
        }

        .contact-form-card {
            background: var(--dark-card);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            padding: var(--space-lg);
            box-shadow: var(--shadow-lg);
            max-width: 32rem;
            margin: 0 auto;
        }

        .contact-form-card h1 {
            font-family: var(--font-display);
            font-size: clamp(1.75rem, 4.5vw, 2.25rem);
            font-weight: 700;
            color: var(--white);
            margin-bottom: var(--space-md);
            text-align: center;
        }

        .contact-form-card form {
            display: flex;
            flex-direction: column;
            gap: var(--space-md);
        }

        .contact-form-card label {
            color: var(--gray-300);
            font-size: clamp(0.875rem, 3vw, 1rem);
            font-weight: 500;
        }

        .contact-form-card input,
        .contact-form-card textarea {
            padding: var(--space-sm);
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            background: var(--dark-surface);
            color: var(--white);
            border: 1px solid var(--glass-border);
            border-radius: 4px;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .contact-form-card input:focus,
        .contact-form-card textarea:focus {
            border-color: var(--primary);
        }

        .contact-form-card textarea {
            resize: vertical;
            min-height: 100px;
        }

        .contact-form-card button {
            background: var(--primary);
            color: var(--white);
            padding: var(--space-sm) var(--space-lg);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: clamp(0.875rem, 3vw, 1rem);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-xs);
            transition: all 0.3s ease;
        }

        .contact-form-card button:hover {
            background: var(--primary-dark);
            box-shadow: var(--shadow-sm);
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--primary);
            border-top: 4px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Light Theme */
        body.light .contact-container {
            background: var(--gray-50);
        }

        body.light .contact-breadcrumb a,
        body.light .contact-breadcrumb .active,
        body.light .contact-form-card h1 {
            color: var(--gray-500);
        }

        body.light .contact-form-card {
            background: var(--white);
            border-color: var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        body.light .contact-form-card label {
            color: var(--gray-400);
        }

        body.light .contact-form-card input,
        body.light .contact-form-card textarea {
            background: var(--white);
            color: var(--gray-500);
            border-color: var(--gray-200);
        }

        body.light .contact-form-card button {
            background: var(--primary);
            color: var(--white);
        }

        body.light .contact-form-card button:hover {
            background: var(--primary-dark);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contact-form-card {
                padding: var(--space-md);
            }

            .contact-form-card h1 {
                font-size: clamp(1.5rem, 4vw, 1.75rem);
            }
        }

        @media (max-width: 480px) {
            .contact-container {
                padding: var(--space-md) var(--space-sm);
            }

            .contact-form-card {
                padding: var(--space-sm);
            }
        }
    </style>
@endpush

@section('content')
    <section class="contact-container">
        <!-- Loading Spinner -->
        <div class="loading-overlay" id="loading-overlay">
            <div class="spinner"></div>
        </div>

        <!-- Breadcrumb -->
        <nav class="contact-breadcrumb">
            <a href="{{ route('user.dashboard') }}">Home</a>
            <span>/</span>
            <a href="{{ route('market') }}">Market</a>
            <span>/</span>
            <span class="active">Contact</span>
        </nav>

        <!-- Contact Form -->
        <div class="contact-form-card">
            <h1>Contact Us</h1>
            <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                @csrf
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject', 'Tool Request') }}" required>
                    @error('subject')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit">
                    Send Message <i class="bi bi-send-fill"></i>
                </button>
            </form>
        </div>
    </section>

    @push('scripts')
        <script>
            // Loading spinner for contact form
            document.querySelector('.contact-form').addEventListener('submit', (e) => {
                e.preventDefault();
                document.getElementById('loading-overlay').style.display = 'flex';
                setTimeout(() => {
                    e.target.submit();
                }, 2000);
            });
        </script>
    @endpush
@endsection
