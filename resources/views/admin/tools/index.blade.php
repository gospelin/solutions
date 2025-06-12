@extends('admin.layouts.app')

@section('title', isset($searchQuery) && $searchQuery ? 'Search Results' : 'Tools Management')

@section('description', 'Manage marketplace items with search, activation, and moderation tools.')

@push('styles')
    <style>
        .tools-container {
            padding: var(--space-lg);
            background: var(--dark-bg);
            min-height: 100vh;
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .content-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: var(--space-md);
            margin-bottom: var(--space-xl);
        }

        .page-title {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 5vw, 2rem);
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-subtitle {
            color: var(--gray-400);
            font-size: clamp(0.875rem, 3vw, 1rem);
        }

        .search-form {
            position: relative;
            max-width: clamp(200px, 50vw, 400px);
            width: 100%;
        }

        .search-form input {
            width: 100%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-sm) var(--space-md) var(--space-sm) 2.5rem;
            color: var(--white);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            transition: all 0.3s ease;
            backdrop-filter: blur(20px);
        }

        .search-form input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .search-form .search-icon {
            position: absolute;
            left: var(--space-sm);
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
        }

        .search-form button {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            background: var(--gradient-primary);
            border: none;
            border-radius: 0 var(--radius-xl) var(--radius-xl) 0;
            padding: var(--space-sm) var(--space-md);
            color: var(--white);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-form button:hover {
            background: var(--primary-dark);
        }

        .create-tool-btn {
            background: var(--gradient-primary);
            border: none;
            color: var(--white);
            padding: var(--space-sm) var(--space-md);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            border-radius: var(--radius-md);
            display: inline-flex;
            align-items: center;
            gap: var(--space-xs);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .create-tool-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .table-container {
            overflow-x: auto;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-md);
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(20px);
        }

        .market-item-table {
            width: 100%;
            border-collapse: collapse;
            font-family: var(--font-primary);
        }

        .market-item-table th,
        .market-item-table td {
            padding: var(--space-sm) var(--space-md);
            text-align: left;
            border-bottom: 1px solid var(--glass-border);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            color: var(--gray-300);
            text-transform: capitalize;
        }

        .market-item-table th {
            color: var(--white);
            font-weight: 600;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .market-item-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .market-item-table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: var(--radius-sm);
        }

        .market-item-table .action-btn {
            margin-right: var(--space-sm);
            padding: var(--space-sm) var(--space-md);
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            color: var(--gray-300);
            display: inline-flex;
            align-items: center;
            gap: var(--space-xs);
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .market-item-table .action-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            transform: scale(1.02);
        }

        .market-item-table .action-btn.success {
            border-color: var(--success);
            color: var(--success);
            background: rgba(34, 197, 94, 0.1);
        }

        .market-item-table .action-btn.success:hover {
            background: var(--success);
            border-color: var(--success);
            color: var(--white);
        }

        .market-item-table .action-btn.error {
            border-color: var(--error);
            color: var(--error);
            background: rgba(239, 68, 68, 0.1);
        }

        .market-item-table .action-btn.error:hover {
            background: var(--error);
            border-color: var(--error);
            color: var(--white);
        }

        .market-item-table .action-btn.deactivate {
            border-color: var(--warning);
            color: var(--warning);
            background: rgba(234, 179, 8, 0.1);
        }

        .market-item-table .action-btn.deactivate:hover {
            background: var(--warning);
            border-color: var(--warning);
            color: var(--white);
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--space-sm);
            margin-top: var(--space-lg);
        }

        /* Light Theme */
        body.light .tools-container {
            background: var(--gray-50);
        }

        body.light .page-title {
            background: none;
            -webkit-text-fill-color: var(--primary);
        }

        body.light .page-subtitle {
            color: var(--gray-400);
        }

        body.light .search-form input {
            color: var(--gray-300);
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .search-form button {
            color: var(--white);
        }

        body.light .market-item-table th,
        body.light .market-item-table td {
            color: var(--gray-300);
        }

        body.light .market-item-table tr:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        body.light .market-item-table .action-btn {
            color: var(--gray-300);
        }

        body.light .market-item-table .action-btn:hover {
            color: var(--white);
        }

        /* Accessibility */
        .search-form input:focus,
        .search-form button:focus,
        .create-tool-btn:focus,
        .action-btn:focus,
        .market-item-table th:focus,
        .market-item-table td:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .tools-container {
                padding: var(--space-md);
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-form {
                max-width: 100%;
                margin-bottom: var(--space-md);
            }

            .market-item-table th,
            .market-item-table td {
                padding: var(--space-xs) var(--space-sm);
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }

            .market-item-table img {
                width: 40px;
                height: 40px;
            }

            .market-item-table .action-btn {
                padding: var(--space-xs) var(--space-sm);
                font-size: clamp(0.625rem, 2vw, 0.75rem);
                margin-right: var(--space-xs);
            }
        }

        @media (max-width: 640px) {
            .market-item-table img {
                width: 32px;
                height: 32px;
            }

            .market-item-table .action-btn {
                margin-right: 0;
                margin-bottom: var(--space-xs);
                display: block;
            }
        }
    </style>
@endpush

@section('content')
    <section class="tools-container">
        <div class="content-header">
            <div>
                <h1 class="page-title">
                    {{ isset($searchQuery) && $searchQuery ? 'Search Results for "' . e($searchQuery) . '"' : 'Tools Management' }}
                </h1>
                <p class="page-subtitle">View, create, edit, or delete tools.</p>
            </div>
            <div class="search-form">
                <form action="{{ route('admin.tools.search') }}" method="GET" role="search" aria-label="Search tools">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="search" value="{{ $searchQuery ?? '' }}" placeholder="Search by name, category, or price..." aria-label="Search tools">
                    <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a href="{{ route('admin.tools.create') }}" class="create-tool-btn" aria-label="Create new tool">
                <i class="fas fa-plus"></i> Create New Tool
            </a>
        </div>

        <div class="table-container">
            <table class="market-item-table" role="grid" aria-label="Tools management table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price ($)</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tools as $tool)
                        <tr role="row">
                            <td>{{ $tool->id }}</td>
                            <td>
                                @if ($tool->image_url)
                                    <img src="{{ $tool->image_url }}" alt="{{ $tool->name }} icon" width="50" height="50" loading="lazy">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $tool->name }}</td>
                            <td>{{ $tool->category }}</td>
                            <td>{{ number_format($tool->price, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ strtolower($tool->status) === 'active' ? 'success' : (strtolower($tool->status) === 'pending' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($tool->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-group" role="group" aria-label="Actions for {{ $tool->name }}">
                                    <a href="{{ route('admin.tools.edit', $tool) }}" class="action-btn" aria-label="Edit {{ $tool->name }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.tools.destroy', $tool) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to permanently delete this market item and all related records (e.g., orders, reviews)? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn error" aria-label="Delete {{ $tool->name }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    @if ($tool->isActive())
                                        <form action="{{ route('admin.tools.deactivate', $tool) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn deactivate" aria-label="Deactivate {{ $tool->name }}">
                                                <i class="fas fa-ban"></i> Deactivate
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.tools.activate', $tool) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn success" aria-label="Activate {{ $tool->name }}">
                                                <i class="fas fa-check"></i> Activate
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center" role="alert">No market items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination">
                {{ $tools->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Debounce utility
                const debounce = (func, wait) => {
                    let timeout;
                    return (...args) => {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => func.apply(this, args), wait);
                    };
                };

                // Search input debouncing
                const searchInput = document.querySelector('.search-form input');
                const searchForm = document.querySelector('.search-form form');

                if (searchInput && searchForm) {
                    const handleSearch = debounce(() => {
                        searchForm.submit();
                    }, 300);
                    searchInput.addEventListener('input', handleSearch);
                }

                // Accessibility: Keyboard navigation for action buttons
                document.querySelectorAll('.action-group .action-btn').forEach(button => {
                    button.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            button.click();
                        }
                    });
                });

                // Sync with sidebar toggle
                document.querySelectorAll('.action-btn, .create-tool-btn, .pagination a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 768) {
                            const sidebar = document.getElementById('sidebar');
                            const overlay = document.getElementById('overlay');
                            if (sidebar && sidebar.classList.contains('active')) {
                                sidebar.classList.remove('active');
                                overlay.classList.remove('active');
                                document.getElementById('menuToggle').classList.remove('active');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
