@extends('user.layouts.app')

@section('title', 'Marketplace - Mr Solution')

@section('description', 'Explore premium tech solutions and tools in the Mr Solution marketplace.')

@push('styles')
    <style>
        .market-container {
            padding: var(--space-lg) var(--space-md);
            background: var(--dark-bg);
            min-height: 100vh;
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .market-breadcrumb {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            color: var(--gray-400);
            margin-bottom: var(--space-xl);
            font-family: var(--font-primary);
        }

        .market-breadcrumb a {
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .market-breadcrumb a:hover {
            color: var(--primary);
        }

        .market-breadcrumb .active {
            color: var(--white);
            font-weight: 600;
        }

        .market-section {
            margin-bottom: var(--space-2xl);
        }

        .market-section h2 {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1rem;
            position: relative;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-md);
            margin-bottom: var(--space-xl);
            padding: var(--space-sm);
            background: var(--glass-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(20px);
        }

        .category-list a {
            color: var(--gray-300);
            font-size: clamp(0.875rem, 3vw, 1rem);
            font-weight: 500;
            text-decoration: none;
            padding: var(--space-sm) var(--space-md);
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            font-family: var(--font-primary);
        }

        .category-list a:hover {
            color: var(--white);
            background: var(--primary-dark);
        }

        .category-list a.active {
            color: var(--white);
            background: var(--gradient-primary);
            font-weight: bold;
        }

        .market-tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: var(--space-lg);
            opacity: 0;
            animation: fadeIn 0.5s ease forwards;
        }

        .tool-card {
            background: var(--dark-card);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: var(--space-md);
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .tool-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .tool-image {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            margin-bottom: var(--space-sm);
            transition: transform 0.3s ease;
        }

        .tool-card:hover .tool-image {
            transform: scale(1.05);
        }

        .tool-name {
            font-family: var(--font-display);
            font-size: clamp(1rem, 3vw, 1.125rem);
            font-weight: 600;
            color: var(--white);
            margin-bottom: var(--space-sm);
        }

        .price {
            color: var(--success);
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            font-weight: 700;
            margin-bottom: var(--space-md);
            font-family: var(--font-primary);
        }

        .buy-btn {
            background: var(--gradient-primary);
            color: var(--white);
            padding: var(--space-sm) var(--space-md);
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-xs);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            text-decoration: none;
            font-weight: 500;
            font-family: var(--font-primary);
        }

        .buy-btn:hover {
            background: var(--primary-dark);
            box-shadow: var(--shadow-sm);
            transform: translateY(-2px);
        }

        .buy-btn.pending,
        .buy-btn.deactivated {
            background: var(--gray-500);
            cursor: not-allowed;
            pointer-events: none;
            opacity: 0.7;
        }

        .not-found {
            color: var(--gray-400);
            text-align: center;
            margin-top: var(--space-lg);
            font-size: clamp(0.875rem, 3vw, 1rem);
            opacity: 0;
            animation: fadeIn 0.5s ease forwards;
            font-family: var(--font-primary);
        }

        .not-found a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .not-found a:hover {
            color: var(--primary-light);
            text-decoration: underline;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--space-sm);
            margin-top: var(--space-xl);
        }

        .pagination-container a,
        .pagination-container span {
            padding: var(--space-sm) var(--space-md);
            border-radius: var(--radius-md);
            color: var(--gray-400);
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: var(--font-primary);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
        }

        .pagination-container a:hover {
            background: var(--gradient-primary);
            color: var(--white);
        }

        .pagination-container .current {
            background: var(--gradient-primary);
            color: var(--white);
            font-weight: bold;
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease;
        }

        .loading-overlay.active {
            display: flex;
            opacity: 1;
        }

        .spinner {
            width: 48px;
            height: 48px;
            border: 5px solid var(--primary);
            border-top: 5px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Light Theme */
        body.light .market-container {
            background: var(--gray-50);
        }

        body.light .market-breadcrumb a,
        body.light .market-breadcrumb .active,
        body.light .market-section h2,
        body.light .tool-name {
            color: var(--gray-500);
        }

        body.light .category-list a {
            color: var(--gray-500);
        }

        body.light .category-list a.active {
            color: var(--white);
        }

        body.light .tool-card {
            background: var(--dark-card);
            border-color: var(--dark-border);
            box-shadow: var(--shadow-sm);
        }

        body.light .tool-card:hover {
            box-shadow: var(--shadow-md);
        }

        body.light .price {
            color: var(--success);
        }

        body.light .not-found {
            color: var(--gray-400);
        }

        body.light .buy-btn {
            color: var(--white);
        }

        /* Accessibility */
        .tool-card:focus-within,
        .buy-btn:focus,
        .category-list a:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .market-tools-grid {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            }

            .category-list a {
                padding: var(--space-xs) var(--space-sm);
                font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            }
        }

        @media (max-width: 480px) {
            .market-tools-grid {
                grid-template-columns: 1fr;
            }

            .tool-card {
                padding: var(--space-sm);
            }
        }
    </style>
@endpush

@section('content')
    <section class="market-container">
        <!-- Loading Spinner -->
        <div class="loading-overlay" id="loading-overlay">
            <div class="spinner"></div>
        </div>

        <!-- Breadcrumb -->
        <nav class="market-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('user.dashboard') }}">Home</a>
            <span aria-hidden="true">/</span>
            <span class="active" aria-current="page">Marketplace</span>
        </nav>

        <!-- Category Filter -->
        <div class="market-section category-list">
            <h2>Filter by Category</h2>
            <div class="flex flex-wrap gap-4" role="navigation" aria-label="Category filter">
                <a 
                    href="{{ route('market') }}" 
                    class="{{ !$category ? 'active' : '' }}"
                    aria-current="{{ !$category ? 'true' : 'false' }}"
                >
                    All
                </a>
                @foreach ($categories as $cat)
                    <a 
                        href="{{ route('market.category', $cat) }}" 
                        class="{{ $category == $cat ? 'active' : '' }}"
                        aria-current="{{ $category == $cat ? 'true' : 'false' }}"
                    >
                        {{ ucfirst($cat) }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Tools Grid -->
        <div class="market-section">
            <h2>Premium Tools</h2>
            <div class="market-tools-grid" id="tool-list" role="list" aria-label="Marketplace tools list">
                @foreach ($paginator as $item)
                    <div 
                        class="tool-card" 
                        data-name="{{ strtolower($item->name) }}"
                        role="listitem"
                        aria-label="{{ $item->name }} tool"
                        tabindex="0"
                    >
                        @if ($item->image_url)
                            <img 
                                src="{{ $item->image_url }}" 
                                alt="{{ $item->name }} icon" 
                                class="tool-image"
                                width="200"
                                height="140"
                                loading="lazy"
                            >
                        @else
                            <div 
                                class="tool-image placeholder" 
                                style="background: var(--gray-500); display: flex; align-items: center; justify-content: center; height: 140px; border-radius: var(--radius-sm);"
                                aria-hidden="true"
                            >
                                No Image
                            </div>
                        @endif
                        <h3 class="tool-name">{{ $item->name }}</h3>
                        <p class="price">${{ number_format($item->price, 2) }} (₦{{ number_format($item->price_ngn, 2) }})</p>
                        <a 
                            href="{{ $item->external_link }}"
                            class="buy-btn {{ in_array(strtolower($item->status), ['pending', 'deactivated']) ? strtolower($item->status) : '' }}"
                            {{ in_array(strtolower($item->status), ['pending', 'deactivated']) ? 'aria-disabled="true"' : '' }}
                            aria-label="{{ strtolower($item->status) === 'pending' ? 'Pending purchase for ' . $item->name : (strtolower($item->status) === 'deactivated' ? 'Unavailable purchase for ' . $item->name : 'Buy ' . $item->name) }}"
                        >
                            {{ strtolower($item->status) === 'pending' ? 'Pending...' : (strtolower($item->status) === 'deactivated' ? 'Unavailable' : 'Buy Now') }}
                            <i class="bi {{ strtolower($item->status) === 'pending' ? 'bi-clock' : (strtolower($item->status) === 'deactivated' ? 'bi-lock-fill' : 'bi-bag-fill') }}"></i>
                        </a>
                    </div>
                @endforeach
            </div>
            <p class="not-found" id="not-found" style="display: none;" role="alert">
                Tool not found, kindly <a class="request" href="{{ route('contact') }}">request for the tool</a>
            </p>
            <!-- Pagination -->
            <div class="pagination-container" role="navigation" aria-label="Pagination">
                @if ($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $paginator->links('vendor.pagination.custom') }}
                @else
                    <p class="text-[var(--gray-400)] text-center">No pagination data available.</p>
                @endif
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Debounce utility
            const debounce = (func, wait) => {
                let timeout;
                return (...args) => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            };

            // Loading spinner for buy links
            const handleBuy = (e) => {
                e.preventDefault();
                const link = e.currentTarget;
                const href = link.getAttribute('href');
                const loadingOverlay = document.getElementById('loading-overlay');

                if (!href || link.classList.contains('pending') || link.classList.contains('deactivated')) {
                    return;
                }

                loadingOverlay.classList.add('active');
                setTimeout(() => {
                    loadingOverlay.classList.remove('active');
                    window.location.href = href;
                }, 1500); // Reduced from 5000ms to 1500ms for better UX
            };

            document.querySelectorAll('.buy-btn:not(.pending):not(.deactivated)').forEach(link => {
                link.addEventListener('click', handleBuy);
            });

            // Category filter smooth navigation
            document.querySelectorAll('.category-list a').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const href = link.getAttribute('href');
                    const loadingOverlay = document.getElementById('loading-overlay');
                    loadingOverlay.classList.add('active');
                    setTimeout(() => {
                        window.location.href = href;
                    }, 500);
                });
            });

            // Accessibility: Keyboard navigation for tool cards
            document.querySelectorAll('.tool-card').forEach(card => {
                card.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        const buyBtn = card.querySelector('.buy-btn');
                        if (buyBtn && !buyBtn.classList.contains('pending') && !buyBtn.classList.contains('deactivated')) {
                            buyBtn.click();
                        }
                    }
                });
            });

            // Error handling for image loading
            document.querySelectorAll('.tool-image img').forEach(img => {
                img.addEventListener('error', () => {
                    img.outerHTML = `<div class="tool-image placeholder" style="background: var(--gray-500); display: flex; align-items: center; justify-content: center; height: 140px; border-radius: var(--radius-sm);" aria-hidden="true">No Image</div>`;
                });
            });

            // Sync with sidebar toggle
            document.addEventListener('DOMContentLoaded', () => {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                document.querySelectorAll('.category-list a, .buy-btn:not(.pending):not(.deactivated)').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 1024 && sidebar.classList.contains('active')) {
                            sidebar.classList.remove('active');
                            overlay.classList.remove('active');
                            document.getElementById('menuToggle').classList.remove('active');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
