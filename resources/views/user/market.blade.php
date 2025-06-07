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
            margin-bottom: var(--space-lg);
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
            font-weight: 700;
        }

        .market-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: var(--space-lg);
        }

        .market-card {
            background: var(--dark-card);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: var(--space-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
        }

        .market-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .market-card h3 {
            font-family: var(--font-display);
            font-size: clamp(1.125rem, 3.5vw, 1.25rem);
            font-weight: 600;
            color: var(--white);
            margin-bottom: var(--space-sm);
        }

        .market-card p.description {
            color: var(--gray-400);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            margin-bottom: var(--space-md);
        }

        .market-card p.price {
            color: var(--primary);
            font-size: clamp(0.875rem, 3vw, 1rem);
            font-weight: 700;
            margin-bottom: var(--space-sm);
        }

        .market-card p.meta {
            color: var(--gray-500);
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            margin-bottom: var(--space-sm);
        }

        .market-card a.view-details {
            color: var(--primary);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-xs);
            transition: color 0.2s ease;
        }

        .market-card a.view-details:hover {
            color: var(--primary-light);
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--space-sm);
            margin-top: var(--space-xl);
        }

        /* Light Theme Styles */
        body.light .market-container {
            background: var(--gray-50);
        }

        body.light .market-breadcrumb a {
            color: var(--gray-400);
        }

        body.light .market-breadcrumb .active {
            color: var(--gray-500);
        }

        body.light .market-section h2 {
            color: var(--gray-500);
        }

        body.light .category-list a {
            color: var(--primary);
        }

        body.light .category-list a.active {
            color: var(--gray-500);
        }

        body.light .market-card {
            background: var(--white);
            border-color: var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        body.light .market-card:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--primary);
        }

        body.light .market-card h3 {
            color: var(--gray-500);
        }

        body.light .market-card p.description {
            color: var(--gray-400);
        }

        body.light .market-card p.price {
            color: var(--primary);
        }

        body.light .market-card p.meta {
            color: var(--gray-400);
        }

        body.light .market-card a.view-details {
            color: var(--primary);
        }

        body.light .pagination-container {
            background: var(--gray-50);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .market-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .market-section h2 {
                font-size: clamp(1.25rem, 3.5vw, 1.5rem);
            }
        }

        @media (max-width: 480px) {
            .market-grid {
                grid-template-columns: 1fr;
            }

            .market-card {
                padding: var(--space-sm);
            }
        }
    </style>
@endpush

@section('content')
    <section class="market-container">
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

        <!-- Popular Items -->
        <div class="market-section">
            <h2>Popular Items</h2>
            <div class="market-grid">
                @foreach ($popularItems as $item)
                    <div class="market-card">
                        <h3>{{ $item->name }}</h3>
                        <p class="description">{{ \Illuminate\Support\Str::limit($item->description, 100) }}</p>
                        <p class="price">${{ number_format($item->price, 2) }}</p>
                        <p class="meta">Purchases: {{ $item->purchases_count }}</p>
                        <a href="{{ route('market.item', $item->id) }}" class="view-details">
                            View Details <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Latest Items -->
        <div class="market-section">
            <h2>Latest Items</h2>
            <div class="market-grid">
                @foreach ($latestItems as $item)
                    <div class="market-card">
                        <h3>{{ $item->name }}</h3>
                        <p class="description">{{ \Illuminate\Support\Str::limit($item->description, 100) }}</p>
                        <p class="price">${{ number_format($item->price, 2) }}</p>
                        <p class="meta">Purchases: {{ $item->purchases_count }}</p>
                        <a href="{{ route('market.item', $item->id) }}" class="view-details">
                            View Details <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- All Items -->
        <div class="market-section">
            <h2>All Items</h2>
            <div class="market-grid">
                @foreach ($items as $item)
                    <div class="market-card">
                        <h3>{{ $item->name }}</h3>
                        <p class="description">{{ \Illuminate\Support\Str::limit($item->description, 100) }}</p>
                        <p class="price">${{ number_format($item->price, 2) }}</p>
                        <p class="meta">Category: {{ ucfirst($item->category) }}</p>
                        <p class="meta">Purchases: {{ $item->purchases_count }}</p>
                        <a href="{{ route('market.item', $item->id) }}" class="view-details">
                            View Details <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="pagination-container">
                @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $items->links('vendor.pagination.custom') }}
                @else
                    <p class="text-[var(--gray-400)] text-center">No pagination data available.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
