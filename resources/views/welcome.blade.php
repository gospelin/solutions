@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-background"></div>
    <div class="floating-elements">
        <div class="floating-element" style="width: 100px; height: 100px; left: 10%; animation-delay: 0s;" data-parallax-speed="0.3"></div>
        <div class="floating-element" style="width: 150px; height: 150px; left: 70%; animation-delay: -5s;" data-parallax-speed="0.5"></div>
        <div class="floating-element" style="width: 80px; height: 80px; left: 40%; animation-delay: -10s;" data-parallax-speed="0.2"></div>
        <div class="floating-element" style="width: 120px; height: 120px; left: 85%; animation-delay: -15s;" data-parallax-speed="0.4"></div>
    </div>
    <div class="hero-content">
        <h1 class="hero-title" id="heroTitle" data-i18n="hero.title">Revolutionary Tech Solutions</h1>
        <p class="hero-subtitle" id="heroSubtitle" data-i18n="hero.subtitle">Empowering businesses with AI-driven innovation and cutting-edge technology that transforms possibilities into reality</p>
        <div class="hero-buttons">
            <a href="#services" class="btn-primary" data-i18n="hero.explore">Explore Solutions</a>
            <a href="#contact" class="btn-secondary" data-i18n="hero.start">Start Your Journey</a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats" id="about">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number" data-count="10000">0</div>
            <div class="stat-label" data-i18n="stats.clients">Satisfied Clients</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" data-count="500">0</div>
            <div class="stat-label" data-i18n="stats.projects">Projects Completed</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" data-count="99">0</div>
            <div class="stat-label" data-i18n="stats.success">Success Rate %</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" data-count="24">0</div>
            <div class="stat-label" data-i18n="stats.support">24/7 Support</div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services" id="services">
    <div class="services-container">
        <h2 class="section-title" data-i18n="services.title">Our Premium Services</h2>
        <div class="services-grid">
            <div class="services-grid tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6">
                @foreach ([
                ['service' => 'ai', 'icon' => '🚀', 'title' => 'services.ai.title', 'desc' => 'services.ai.description'],
                ['service' => 'cloud', 'icon' => '⚡', 'title' => 'services.cloud.title', 'desc' => 'services.cloud.description'],
                ['service' => 'cybersecurity', 'icon' => '🛡️', 'title' => 'services.cybersecurity.title', 'desc' => 'services.cybersecurity.description'],
                ['service' => 'custom', 'icon' => '🔧', 'title' => 'services.custom.title', 'desc' => 'services.custom.description'],
                ['service' => 'bi', 'icon' => '📊', 'title' => 'services.bi.title', 'desc' => 'services.bi.description'],
                ['service' => 'digital', 'icon' => '🌐', 'title' => 'services.digital.title', 'desc' => 'services.digital.description'],
                ] as $service)
                <div class="service-card tw-relative tw-glass tw-rounded-xl tw-p-6 tw-border tw-border-gray-700 tw-transition-all duration-300 tw-hover:shadow-2xl tw-hover:-translate-y-2" data-service="{{ $service['service'] }}">
                    <div class="service-icon tw-text-5xl tw-mb-4">{{ $service['icon'] }}</div>
                    <h3 class="service-title tw-text-xl tw-font-display tw-text-light tw-mb-3" data-i18n="{{ $service['title'] }}">Title</h3>
                    <p class="service-description tw-text-gray-400 tw-mb-4" data-i18n="{{ $service['desc'] }}">Description</p>
                    <a href="#contact" class="tw-text-primary tw-font-semibold tw-text-sm new-trans" data-i18n="services.learnMore">Learn More</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials" id="testimonials">
    <div class="testimonials-container">
        <h2 class="section-title" data-i18n="testimonials.title">What Industry Leaders Say</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <p class="testimonial-text" data-i18n="testimonials.t1.text">"Mr Solution transformed our entire tech infrastructure. Their AI solutions increased our efficiency by 40% and revolutionized how we approach data analytics."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">SJ</div>
                    <div class="author-info">
                        <h4 data-i18n="testimonials.t1.author">Sarah Johnson</h4>
                        <p data-i18n="testimonials.t1.role">CEO, TechNova Inc.</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text" data-i18n="testimonials.t2.text">"The premium support and custom development services exceeded all expectations. Their team delivered solutions that perfectly aligned with our vision."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">MC</div>
                    <div class="author-info">
                        <h4 data-i18n="testimonials.t2.author">Michael Chen</h4>
                        <p data-i18n="testimonials.t2.role">CTO, InnovateX</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text" data-i18n="testimonials.t3.text">"Outstanding cybersecurity implementation. We've had zero security incidents since partnering with Mr Solution. Their proactive approach is unmatched."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">ER</div>
                    <div class="author-info">
                        <h4 data-i18n="testimonials.t3.author">Emily Rodriguez</h4>
                        <p data-i18n="testimonials.t3.role">CISO, SecureCore</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq" id="faq">
    <div class="faq-container tw-max-w-7xl tw-mx-auto tw-px-6 tw-py-16">
        <h2 class="section-title tw-text-center tw-font-display tw-text-4xl tw-mb-12" data-i18n="faq.title">Frequently Asked Questions</h2>
        <div class="faq-grid tw-space-y-4">
            @foreach ([
            ['q' => 'faq.q1', 'a' => 'faq.a1'],
            ['q' => 'faq.q2', 'a' => 'faq.a2'],
            ['q' => 'faq.q3', 'a' => 'faq.a3'],
            ['q' => 'faq.q4', 'a' => 'faq.a4'],
            ] as $faq)
            <div class="faq-item tw-bg-gray-800 tw-rounded-lg tw-border tw-border-gray-700 tw-overflow-hidden">
                <button class="faq-question tw-w-full tw-px-6 tw-py-4 tw-text-left tw-font-display tw-text-lg tw-text-light tw-flex tw-justify-between tw-items-center tw-cursor-pointer tw-transition-all duration-300 tw-hover:bg-gray-700" aria-expanded="false" data-i18n="{{ $faq['q'] }}">
                    <span class="faq-text">Question</span>
                    <span class="faq-toggle tw-text-xl">+</span>
                </button>
                <div class="faq-answer tw-px-6 tw-py-4 tw-text-gray-400">
                    <p data-i18n="{{ $faq['a'] }}">Answer</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" id="premium">
    <div class="cta-content">
        <h2 class="cta-title" data-i18n="cta.title">Ready to Transform Your Business?</h2>
        <p class="cta-description" data-i18n="cta.description">Join thousands of companies already leveraging our premium solutions to stay ahead in the digital revolution. Get started with our exclusive premium plan today.</p>
        <div class="hero-buttons">
            <a href="#contact" class="btn-primary" data-i18n="cta.button">Start Free Trial</a>
            <a href="#services" class="btn-secondary" data-i18n="cta.view">View Pricing</a>
        </div>
    </div>
</section>
@endsection