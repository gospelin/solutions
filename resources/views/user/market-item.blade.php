@extends('user.layouts.app')

@section('title', '{{ $item->name }} - Market')

@section('description', '{{ \Illuminate\Support\Str::limit($item->description, 160) }}')

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
            border-radius: var(--radius-lg);
            padding: var(--space-lg);
            box-shadow: var(--shadow-lg);
            max-width: 48rem;
            margin: 0 auto;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .market-item-card h1 {
            font-family: var(--font-display);
            font-size: clamp(1.75rem, 4.5vw, 2.25rem);
            font-weight: 700;
            color: var(--white);
            margin-bottom: var(--space-md);
        }

        .market-item-card p.description {
            color: var(--gray-300);
            font-size: clamp(0.875rem, 3vw, 1rem);
            line-height: 1.6;
            margin-bottom: var(--space-lg);
        }

        .market-item-card p.price {
            color: var(--primary);
            font-size: clamp(1.25rem, 3.5vw, 1.5rem);
            font-weight: 700;
            margin-bottom: var(--space-md);
        }

        .market-item-card p.meta {
            color: var(--gray-500);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            margin-bottom: var(--space-sm);
        }

        .market-item-card button.purchase-btn {
            background: var(--primary);
            color: var(--white);
            font-size: clamp(0.875rem, 3vw, 1rem);
            font-weight: 500;
            padding: var(--space-sm) var(--space-lg);
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: var(--space-xs);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .market-item-card button.purchase-btn:hover {
            background: var(--primary-dark);
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        /* Light Theme Styles */
        body.light .market-item-container {
            background: var(--gray-50);
        }

        body.light .market-item-breadcrumb a {
            color: var(--gray-400);
        }

        body.light .market-item-breadcrumb .active {
            color: var(--gray-500);
        }

        body.light .market-item-card {
            background: var(--white);
            border-color: var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        body.light .market-item-card h1 {
            color: var(--gray-500);
        }

        body.light .market-item-card p.description {
            color: var(--gray-400);
        }

        body.light .market-item-card p.price {
            color: var(--primary);
        }

        body.light .market-item-card p.meta {
            color: var(--gray-400);
        }

        body.light .market-item-card button.purchase-btn {
            background: var(--primary);
            color: var(--white);
        }

        body.light .market-item-card button.purchase-btn:hover {
            background: var(--primary-dark);
            box-shadow: var(--shadow-md);
        }

        /* Responsive Design */
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
        <!-- Breadcrumb -->
        <nav class="market-item-breadcrumb">
            <a href="{{ route('user.dashboard') }}">Home</a>
            <span>/</span>
            <a href="{{ route('market') }}">Market</a>
            <span>/</span>
            <span class="active">{{ \Illuminate\Support\Str::limit($item->name, 30) }}</span>
        </nav>

        <!-- Item Details -->
        <div class="market-item-card">
            <h1>{{ $item->name }}</h1>
            <p class="description">{{ $item->description }}</p>
            <p class="price">${{ number_format($item->price, 2) }}</p>
            <p class="meta">Category: {{ ucfirst($item->category) }}</p>
            <p class="meta">Purchases: {{ $item->purchases_count }}</p>
            <form action="{{ route('market.purchase', $item->id) }}" method="POST">
                @csrf
                <button type="submit" class="purchase-btn">
                    Purchase Now <i class="bi bi-cart-check"></i>
                </button>
            </form>
        </div>
    </section>
@endsection
