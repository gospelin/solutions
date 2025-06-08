@extends('user.layouts.app')

@section('title', '{{ $item->name }} - Mr Solution')

@section('description', '{{ Str::limit($item->description, 160) }}')

@push('styles')
    <style>
        .market-item-container {
            padding: var(--space-lg) var(--space-md);
            background: var(--dark-bg);
        }

        .market-item-breadcrumb {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            color: var(--gray-400);
            margin-bottom: var(--space-xl);
        }

        .market-item-breadcrumb a {
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .market-item-breadcrumb a:hover {
            color: var(--primary);
        }

        .market-item-breadcrumb .active {
            color: var(--white);
            font-weight: 600;
        }

        .market-item-card {
            background: var(--dark-card);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            padding: var(--space-lg);
            box-shadow: var(--shadow-lg);
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .market-item-card h1 {
            font-family: var(--font-display);
            font-size: clamp(1.75rem, 4.5vw, 2.25rem);
            font-weight: 700;
            color: var(--white);
            margin-bottom: var(--space-md);
        }

        .tool-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: var(--space-md);
        }

        .description {
            color: var(--gray-300);
            font-size: clamp(0.875rem, 3vw, 1rem);
            margin-bottom: var(--space-lg);
        }

        .price {
            color: var(--primary);
            font-size: clamp(1rem, 3.5vw, 1.25rem);
            font-weight: 700;
            margin-bottom: var(--space-md);
        }

        .meta {
            color: var(--gray-400);
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            margin-bottom: var(--space-sm);
        }

        .buy-btn {
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
            width: 100%;
            text-decoration: none;
            margin-top: var(--space-md);
        }

        .buy-btn:hover {
            background: var(--primary-dark);
            box-shadow: var(--shadow-sm);
        }

        .buy-btn.pending {
            background: var(--gray-500);
            cursor: not-allowed;
            pointer-events: none;
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
        body.light .market-item-container {
            background: var(--gray-50);
        }

        body.light .market-item-breadcrumb a,
        body.light .market-item-breadcrumb .active,
        body.light .market-item-card h1 {
            color: var(--gray-500);
        }

        body.light .market-item-card {
            background: var(--white);
            border-color: var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        body.light .description,
        body.light .meta {
            color: var(--gray-400);
        }

        body.light .price {
            color: var(--primary);
        }

        body.light .buy-btn {
            background: var(--primary);
            color: var(--white);
        }

        body.light .buy-btn:hover {
            background: var(--primary-dark);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .market-item-card {
                padding: var(--space-md);
            }

            .market-item-card h1 {
                font-size: clamp(1.5rem, 4vw, 1.75rem);
            }
        }

        @media (max-width: 480px) {
            .market-item-container {
                padding: var(--space-md) var(--space-sm);
            }

            .market-item-card {
                padding: var(--space-sm);
            }
        }
    </style>
@endpush

@section('content')
    <section class="market-item-container">
        <!-- Loading Spinner -->
        <div class="loading-overlay" id="loading-overlay">
            <div class="spinner"></div>
        </div>

        <!-- Breadcrumb -->
        <nav class="market-item-breadcrumb">
            <a href="{{ route('user.dashboard') }}">Home</a>
            <span>/</span>
            <a href="{{ route('market') }}">Market</a>
            <span>/</span>
            <span class="active">{{ $item->name }}</span>
        </nav>

        <!-- Item Card -->
        <div class="market-item-card">
            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" class="tool-image">
            <h1>{{ $item->name }}</h1>
            <p class="description">{{ $item->description }}</p>
            <p class="price">${{ number_format($item->price, 2) }} (₦{{ number_format($item->price_ngn, 2) }})</p>
            <p class="meta">Category: {{ ucfirst($item->category) }}</p>
            <p class="meta">Purchases: {{ $item->purchases_count }}</p>
            <p class="meta">Status: {{ ucfirst($item->status) }}</p>
            <a href="{{ $item->external_link }}" class="buy-btn {{ $item->status === 'pending' ? 'pending' : '' }}" {{ $item->status === 'pending' ? 'onclick="return false;"' : 'target="_self"' }}>
                {{ $item->status === 'pending' ? 'Pending...' : 'Purchase Now' }}
                <i class="bi {{ $item->status === 'pending' ? 'bi-clock' : 'bi-cart-check' }}"></i>
            </a>
        </div>
    </section>

    @push('scripts')
        <script>
            // Loading spinner for external link
            document.querySelectorAll('.buy-btn:not(.pending)').forEach(link => {
                link.addEventListener('click', (e) => {
                    document.getElementById('loading-overlay').style.display = 'flex';
                    setTimeout(() => {
                        document.getElementById('loading-overlay').style.display = 'none';
                    }, 2000);
                });
            });
        </script>
    @endpush
@endsection

@push('scripts')
    <script>
        // Show loading spinner on page load
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('loading-overlay').style.display = 'flex';
            setTimeout(() => {
                document.getElementById('loading-overlay').style.display = 'none';
            }, 2000);
        });
    </script>
    <script>
        // Dark mode toggle
        document.addEventListener('DOMContentLoaded', () => {
            const toggleDarkMode = () => {
                document.body.classList.toggle('dark');
                localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
            };

            const savedTheme = localStorage.getItem('theme') || 'light';
            document.body.classList.add(savedTheme);

            const darkModeToggle = document.getElementById('dark-mode-toggle');
            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', toggleDarkMode);
            }
        });
    </script>
    <script>
        // Responsive adjustments
        window.addEventListener('resize', () => {
            const container = document.querySelector('.market-item-container');
            if (window.innerWidth < 768) {
                container.style.padding = 'var(--space-md) var(--space-sm)';
            } else {
                container.style.padding = 'var(--space-lg) var(--space-md)';
            }
        });
        window.dispatchEvent(new Event('resize')); // Trigger resize on load
    </script>
    <script>
        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <script>
        // Accessibility enhancements
        document.addEventListener('DOMContentLoaded', () => {
            const focusableElements = 'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])';
            const modal = document.querySelector('.market-item-card');

            modal.addEventListener('keydown', (e) => {
                if (e.key === 'Tab') {
                    const firstFocusableElement = modal.querySelectorAll(focusableElements)[0];
                    const lastFocusableElement = modal.querySelectorAll(focusableElements)[modal.querySelectorAll(focusableElements).length - 1];

                    if (e.shiftKey) { // Shift + Tab
                        if (document.activeElement === firstFocusableElement) {
                            e.preventDefault();
                            lastFocusableElement.focus();
                        }
                    } else { // Tab
                        if (document.activeElement === lastFocusableElement) {
                            e.preventDefault();
                            firstFocusableElement.focus();
                        }
                    }
                }
            });
        });
    </script>
    <script>
        // Tooltip for purchase button
        document.querySelectorAll('.buy-btn').forEach(btn => {
            btn.addEventListener('mouseover', () => {
                const tooltip = document.createElement('span');
                tooltip.className = 'tooltip';
                tooltip.textContent = btn.classList.contains('pending') ? 'This item is currently pending.' : 'Click to purchase this item.';
                btn.appendChild(tooltip);
            });

            btn.addEventListener('mouseout', () => {
                const tooltip = btn.querySelector('.tooltip');
                if (tooltip) {
                    tooltip.remove();
                }
            });
        });
    </script>
    <style>
        .tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            padding: 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }
        .tooltip::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: rgba(0, 0, 0, 0.75) transparent transparent transparent;
        }
        .loading-overlay {
            display: none; /* Hide by default */
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
        body.dark .tooltip {
            background: rgba(255, 255, 255, 0.9);
            color: var(--dark-text);
        }
        body.dark .tooltip::after {
            border-color: rgba(255, 255, 255, 0.9) transparent transparent transparent;
        }
        body.light .tooltip {
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
        }
        body.light .tooltip::after {
            border-color: rgba(0, 0, 0, 0.75) transparent transparent transparent;
        }
    </style>
@endpush
@endsection
