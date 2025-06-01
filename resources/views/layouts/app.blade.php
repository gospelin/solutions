<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page Title -->
    <title>@yield('title', config('app.name', 'Mr Solution - Revolutionary Tech Solutions & AI-Powered Insights | 2025'))</title>
    <!-- Meta Tags -->
    <meta name="description" content="Experience the future of technology with Mr Solution. Advanced AI tools, real-time analytics, and revolutionary solutions for businesses in 2025.">
    <meta name="keywords" content="AI solutions, cloud infrastructure, cybersecurity, custom development, business intelligence, digital transformation, Mr Solution">
    <meta name="author" content="Mr Solution">
    <meta property="og:title" content="Mr Solution - Revolutionary Tech Solutions">
    <meta property="og:description" content="Leading-edge technology solutions powered by AI and innovation for businesses in 2025.">
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

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Playfair Display, Quicksand, Inter, Space Grotesk, JetBrains Mono -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Quicksand:wght@400;500;600;700&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Stacks for Custom Styles -->
    @stack('styles')

    <!-- Structured Data -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [{
                "@type": "Organization",
                "name": "Mr Solution",
                "url": "https://mrsolution.com",
                "logo": "{{ asset('images/logo.png') }}",
                "sameAs": ["https://x.com/mrsolution", "https://linkedin.com/company/mrsolution"],
                "contactPoint": {
                    "@type": "ContactPoint",
                    "email": "contact@mrsolution.com",
                    "contactType": "Customer Support"
                }
            }, {
                "@type": "BreadcrumbList",
                "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://mrsolution.com/#home"
                    },
                    {
                        "@type": "ListItem",
                        "position": 2,
                        "name": "About",
                        "item": "https://mrsolution.com/#about"
                    },
                    {
                        "@type": "ListItem",
                        "position": 3,
                        "name": "Services",
                        "item": "https://mrsolution.com/#services"
                    },
                    {
                        "@type": "ListItem",
                        "position": 4,
                        "name": "Testimonials",
                        "item": "https://mrsolution.com/#testimonials"
                    },
                    {
                        "@type": "ListItem",
                        "position": 5,
                        "name": "FAQ",
                        "item": "https://mrsolution.com/#faq"
                    },
                    {
                        "@type": "ListItem",
                        "position": 6,
                        "name": "Contact",
                        "item": "https://mrsolution.com/#contact"
                    }
                ]
            }, {
                "@type": "FAQPage",
                "mainEntity": [{
                        "@type": "Question",
                        "name": "What services does Mr Solution offer?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Mr Solution provides AI-powered analytics, cloud infrastructure, cybersecurity, custom development, business intelligence, and digital transformation services tailored to your business needs."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "How can I get started with a free trial?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Contact us via the form in the footer or click 'Start Free Trial' in the CTA section, and our team will guide you through the process."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Is my data secure with your solutions?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Absolutely. Our cybersecurity suite uses advanced threat detection and encryption to ensure your data is protected at all times."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Do you offer support for custom projects?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Yes, our custom development team specializes in building bespoke solutions tailored to your unique requirements."
                        }
                    }
                ]
            }]
        }
    </script>
    <!-- Global Laravel Config -->
    <script>
        window.Laravel = {
            translationsUrl: "{{ asset('translations.json') }}",
            locale: '{{ app()->getLocale() }}'
        };
    </script>
</head>

<body class="public-page">
    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <div class="loading-spinner"></div>
    </div>
    <!-- Scroll Indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>
    <!-- Custom Cursor -->
    <div class="cursor" id="cursor"></div>
    <div class="cursor-follower" id="cursorFollower"></div>
    <!-- Theme Toggle Tray -->
    <div class="theme-toggle-container" id="themeToggleContainer">
        <button class="theme-toggle-button" id="themeToggleButton" aria-label="Toggle theme">
            <svg class="theme-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="sun" d="M12 3V4M12 20V21M3 12H4M20 12H21M5.636 5.636L6.343 6.343M17.657 17.657L18.364 18.364M5.636 18.364L6.343 17.657M17.657 6.343L18.364 5.636M12 6C9.243 6 7 8.243 7 11C7 13.757 9.243 16 12 16C14.757 16 17 13.757 17 11C17 8.243 14.757 6 12 6Z" stroke="currentColor" stroke-width="2" />
                <path class="moon" d="M12 3C7.029 3 3 7.029 3 12C3 16.971 7.029 21 12 21C14.285 21 16.346 20.174 17.899 18.899C17.404 18.965 16.902 19 16.4 19C12.283 19 9 15.717 9 11.6C9 7.483 12.283 4.2 16.4 4.2C16.902 4.2 17.404 4.235 17.899 4.301C16.346 3.126 14.285 2.3 12 2.3V3Z" fill="currentColor" />
            </svg>
        </button>
        <div class="theme-tray" id="themeTray">
            <button class="theme-option" data-theme="light">Light</button>
            <button class="theme-option" data-theme="dark">Dark</button>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="logo">
                <img src="{{ asset('images/mrsolution.jpeg') }}" alt="Mr Solution Logo" class="logo-img" id="logo-img">
                <!--<span class="logo-text" data-i18n="nav.logo">Mr Solution</span>-->
            </div>
            <div class="nav-right">
                <ul class="nav-links" id="navLinks">
                    <li><a href="#home" class="nav-link" data-i18n="nav.home">Home</a></li>
                    <li><a href="#about" class="nav-link" data-i18n="nav.about">About</a></li>
                    <li><a href="#services" class="nav-link" data-i18n="nav.services">Services</a></li>
                    <li><a href="#contact" class="nav-link" data-i18n="nav.contact">Contact</a></li>
                    <li><a href="#premium" class="cta-button" data-i18n="nav.premium">Get Premium</a></li>
                    @guest
                    @if (Route::has('login'))
                    <li><a class="nav-link" href="{{ route('login') }}" data-i18n="nav.login">Login</a></li>
                    @endif
                    @if (Route::has('register'))
                    <li><a class="nav-link" href="{{ route('register') }}" data-i18n="nav.register">Register</a></li>
                    @endif
                    @endguest
                </ul>
                <select id="languageSwitcher" class="language-switcher" aria-label="Select language">
                    <option value="en">English</option>
                    <option value="es">Español</option>
                    <option value="fr">Français</option>
                </select>
                <div class="mobile-menu" id="mobileMenu">
                    <div class="hamburger"></div>
                    <div class="hamburger"></div>
                    <div class="hamburger"></div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <div class="footer-section">
                <h3 data-i18n="footer.about.title">Mr Solution</h3>
                <p data-i18n="footer.about.description">Leading the future of technology with innovative solutions that empower businesses to achieve unprecedented growth and efficiency.</p>
            </div>
            <div class="footer-section">
                <h3 data-i18n="footer.services.title">Services</h3>
                <p><a href="#services" data-i18n="services.ai.title">AI-Powered Analytics</a></p>
                <p><a href="#services" data-i18n="services.cloud.title">Cloud Infrastructure</a></p>
                <p><a href="#services" data-i18n="services.cybersecurity.title">Cybersecurity</a></p>
                <p><a href="#services" data-i18n="services.custom.title">Custom Development</a></p>
            </div>
            <div class="footer-section">
                <h3 data-i18n="footer.links.title">Quick Links</h3>
                <p><a href="#home" data-i18n="nav.home">Home</a></p>
                <p><a href="#about" data-i18n="nav.about">About</a></p>
                <p><a href="#testimonials" data-i18n="nav.testimonials">Testimonials</a></p>
                <p><a href="#premium" data-i18n="nav.premium">Get Premium</a></p>
            </div>
            <div class="footer-section">
                <h3 data-i18n="footer.contact.title">Contact</h3>
                <form id="contactForm" class="contact-form">
                    @csrf
                    <div class="form-group">
                        <label for="name" data-i18n="form.label.name">Your Name</label>
                        <input type="text" id="name" name="name" data-i18n-placeholder="form.name" placeholder="Your Name" required aria-label="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="email" data-i18n="form.label">Your Email</label>
                        <input type="email" id="email" name="email" data-i18n-placeholder="form.email" placeholder="Your Email" required aria-label="Your Email">
                    </div>
                    <div class="form-group">
                        <label for="message" data-i18n="form.label.message">Your Message</label>
                        <textarea id="message" name="message" data-i18n-placeholder="form.message" placeholder="Your Message" required aria-label="Your Message"></textarea>
                    </div>
                    <button type="submit" class="cta-button" id="cta-button" data-i18n="form.submit">Submit</button>
                    <p class="form-message" id="formMessage"></p>
                </form>
            </div>
            <div class="footer-section">
                <h3 data-i18n="footer.newsletter.title">Newsletter</h3>
                <p data-i18n="footer.newsletter.description">Stay updated with the latest tech insights and offers!</p>
                <form id="newsletterForm" class="newsletter-form">
                    @csrf
                    <div class="form-group">
                        <label for="newsletterEmail" data-i18n="form.label.email">Your Email</label>
                        <input type="email" id="newsletterEmail" name="email" data-i18n-placeholder="form.email" placeholder="Your Email" required aria-label="Newsletter Email">
                    </div>
                    <button type="submit" class="cta-button" id="cta-button" data-i18n="newsletter.submit">Subscribe</button>
                    <p class="form-message" id="newsletterMessage"></p>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p data-i18n="footer.copyright">© 2025 Mr Solution. All rights reserved.</p>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button type="button" class="back-to-top" id="backToTop" aria-label="Back to top">↑</button>

    <!-- Modal for Service Cards -->
    <div class="modal" id="serviceModal" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-content">
            <span class="modal-close" id="modalClose" role="button" aria-label="Close modal">×</span>
            <div class="modal-icon" id="modalIcon"></div>
            <h3 class="modal-title" id="modalTitle"></h3>
            <p class="modal-description" id="modalDescription"></p>
            <a href="#contact" class="btn-primary modal-cta" data-i18n="modal.cta">Get Started</a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @endpush
    @stack('scripts')
</body>

</html>