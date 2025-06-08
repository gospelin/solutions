@extends('user.layouts.app')

@section('title', 'Marketplace - Mr Solution')

@section('description', 'Explore premium tech solutions and tools in the Mr Solution marketplace.')

@push('styles')
    <style>
        .market-container {
            padding: var(--space-lg) var(--space-md);
            background: var(--dark-bg);
        }

        .market-breadcrumb {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            color: var(--gray-400);
            margin-bottom: var(--space-xl);
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
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-md);
            margin-bottom: var(--space-xl);
        }

        .category-list a {
            color: var(--primary);
            font-size: clamp(0.875rem, 3vw, 1rem);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .category-list a:hover {
            color: var(--primary-light);
        }

        .category-list a.active {
            color: var(--white);
            font-weight: bold;
        }

        .market-tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-lg);
        }

        .tool-card {
            background: var(--dark-card);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            padding: var(--space-md);
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .tool-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .tool-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: var(--space-sm);
        }

        .tool-name {
            font-family: var(--font-display);
            font-size: clamp(1rem, 3vw, 1.125rem);
            font-weight: 600;
            color: var(--white);
            margin-bottom: var(--space-sm);
        }

        .price {
            color: var(--primary);
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            font-weight: 700;
            margin-bottom: var(--space-md);
        }

        .buy-btn {
            background: var(--primary);
            color: var(--white);
            padding: var(--space-sm) var(--space-md);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-xs);
            transition: all 0.3s ease;
            width: 100%;
            text-decoration: none;
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

        .not-found {
            color: var(--gray-400);
            text-align: center;
            margin-top: var(--space-lg);
        }

        .not-found a {
            color: var(--primary);
            text-decoration: none;
        }

        .not-found a:hover {
            color: var(--primary-light);
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--space-sm);
            margin-top: var(--space-xl);
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
        body.light .market-container {
            background: var(--gray-50);
        }

        body.light .market-breadcrumb a,
        body.light .market-breadcrumb .active,
        body.light .market-section h2,
        body.light .tool-name {
            color: var(--gray-500);
        }

        body.light .search-bar input {
            background: var(--white);
            color: var(--gray-500);
            border-color: var(--gray-200);
        }

        body.light .search-bar button {
            background: var(--primary);
            color: var(--white);
        }

        body.light .category-list a.active {
            color: var(--gray-500);
        }

        body.light .tool-card {
            background: var(--white);
            border-color: var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        body.light .tool-card:hover {
            box-shadow: var(--shadow-md);
        }

        body.light .price {
            color: var(--primary);
        }

        body.light .not-found {
            color: var(--gray-400);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .market-tools-grid {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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
        <nav class="market-breadcrumb">
            <a href="{{ route('user.dashboard') }}">Home</a>
            <span>/</span>
            <span class="active">Marketplace</span>
        </nav>

        <!-- Category Filter -->
        <div class="market-section category-list">
            <h2>Filter by Category</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('market') }}" class="{{ !$category ? 'active' : '' }}">All</a>
                @foreach ($categories as $cat)
                    <a href="{{ route('market.category', $cat) }}" class="{{ $category == $cat ? 'active' : '' }}">
                        {{ ucfirst($cat) }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Tools Grid -->
        <div class="market-section">
            <h2>All Tools</h2>
            <div class="market-tools-grid" id="tool-list">
                @foreach ($paginator as $item)
                    <div class="tool-card" data-name="{{ strtolower($item->name) }}">
                        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" class="tool-image">
                        <h2 class="tool-name">{{ $item->name }}</h2>
                        <p class="price">${{ number_format($item->price, 2) }} (₦{{ number_format($item->price_ngn, 2) }})</p>
                        <a href="{{ $item->external_link }}" class="buy-btn {{ $item->status === 'pending' ? 'pending' : '' }}"
                            {{ $item->status === 'pending' ? 'onclick="return false;"' : 'target="_self"' }}>
                            {{ $item->status === 'pending' ? 'Pending...' : 'Buy Now' }}
                            <i class="bi {{ $item->status === 'pending' ? 'bi-clock' : 'bi-bag-fill' }}"></i>
                        </a>
                    </div>
                @endforeach
            </div>
            <p class="not-found" id="not-found" style="display: none;">
                Tool not found, kindly <a class="request" href="{{ route('contact') }}">request for the tool</a>
            </p>
            <!-- Pagination -->
            <div class="pagination-container">
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
            // Loading spinner for external links
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
