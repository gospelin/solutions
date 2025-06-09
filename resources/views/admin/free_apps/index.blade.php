@extends('admin.layouts.app')

@section('title', 'Free Apps Management')

@section('description', 'Manage free apps with search, activation, and moderation tools.')

@push('styles')
    <style>
        .free-apps-container {
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

        .card-tools .action-btn {
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

        .card-tools .action-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .search-form {
            position: relative;
            max-width: clamp(200px, 50vw, 400px);
            width: 100%;
            margin-bottom: var(--space-lg);
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

        .alert {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: var(--space-md);
            margin-bottom: var(--space-lg);
            color: var(--white);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            position: relative;
            backdrop-filter: blur(20px);
        }

        .alert-success {
            border-color: var(--success);
            background: rgba(16, 185, 129, 0.1);
        }

        .alert-danger {
            border-color: var(--error);
            background: rgba(239, 68, 68, 0.1);
        }

        .alert .close {
            position: absolute;
            top: var(--space-sm);
            right: var(--space-sm);
            background: none;
            border: none;
            color: var(--gray-400);
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .alert .close:hover {
            color: var(--white);
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

        .table {
            width: 100%;
            border-collapse: collapse;
            font-family: var(--font-primary);
        }

        .table th,
        .table td {
            padding: var(--space-sm) var(--space-md);
            text-align: left;
            border-bottom: 1px solid var(--glass-border);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            color: var(--gray-300);
        }

        .table th {
            color: var(--white);
            font-weight: 600;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: var(--radius-sm);
        }

        .table .badge {
            padding: var(--space-xs) var(--space-sm);
            border-radius: var(--radius-md);
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            font-weight: 600;
        }

        .badge-success {
            background: var(--success);
            color: var(--white);
        }

        .badge-warning {
            background: var(--warning);
            color: var(--white);
        }

        .badge-danger {
            background: var(--error);
            color: var(--white);
        }

        .btn-group {
            display: flex;
            gap: var(--space-sm);
            flex-wrap: wrap;
        }

        .btn-group .action-btn {
            position: relative;
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
            backdrop-filter: blur(10px);
        }

        .btn-group .action-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            transform: scale(1.02);
        }

        .btn-group .action-btn.success {
            border-color: var(--success);
            color: var(--success);
            background: rgba(34, 197, 94, 0.1);
        }

        .btn-group .action-btn.success:hover {
            background: var(--success);
            border-color: var(--success);
            color: var(--white);
        }

        .btn-group .action-btn.error {
            border-color: var(--error);
            color: var(--error);
            background: rgba(239, 68, 68, 0.1);
        }

        .btn-group .action-btn.error:hover {
            background: var(--error);
            border-color: var(--error);
            color: var(--white);
        }

        .btn-group .action-btn.deactivate {
            border-color: var(--warning);
            color: var(--warning);
            background: rgba(234, 179, 8, 0.1);
        }

        .btn-group .action-btn.deactivate:hover {
            background: var(--warning);
            border-color: var(--warning);
            color: var(--white);
        }

        .btn-group .action-btn .tooltip {
            position: absolute;
            top: -2.5rem;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark-bg);
            color: var(--white);
            padding: var(--space-xs) var(--space-sm);
            border-radius: var(--radius-sm);
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 20;
        }

        .btn-group .action-btn:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--space-sm);
            margin-top: var(--space-lg);
        }

        /* Light Theme */
        body.light .free-apps-container {
            background: var(--gray-50);
        }

        body.light .page-title {
            background: none;
            -webkit-text-fill-color: var(--primary);
        }

        body.light .search-form input {
            color: var(--gray-300);
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .search-form button {
            color: var(--white);
        }

        body.light .alert {
            color: var(--gray-300);
        }

        body.light .table th,
        body.light .table td {
            color: var(--gray-300);
        }

        body.light .table tr:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        body.light .btn-group .action-btn {
            color: var(--gray-300);
        }

        body.light .btn-group .action-btn:hover {
            color: var(--white);
        }

        body.light .btn-group .action-btn .tooltip {
            background: var(--gray-50);
            color: var(--gray-300);
        }

        /* Accessibility */
        .search-form input:focus,
        .search-form button:focus,
        .action-btn:focus,
        .table th:focus,
        .table td:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .free-apps-container {
                padding: var(--space-md);
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-form {
                max-width: 100%;
            }

            .table th,
            .table td {
                padding: var(--space-xs) var(--space-sm);
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }

            .table img {
                width: 40px;
                height: 40px;
            }

            .btn-group .action-btn {
                padding: var(--space-xs) var(--space-sm);
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }
        }

        @media (max-width: 640px) {
            .table img {
                width: 32px;
                height: 32px;
            }

            .btn-group {
                flex-direction: column;
                gap: var(--space-xs);
            }

            .btn-group .action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <section class="free-apps-container">
        <div class="content-header">
            <div>
                <h1 class="page-title">Free Apps Management</h1>
                <p class="page-subtitle">Manage and moderate free apps for the platform.</p>
            </div>
            <div class="card-tools">
                <a href="{{ route('admin.free-apps.create') }}" class="action-btn" aria-label="Add new free app">
                    <i class="fas fa-plus"></i> Add New App
                </a>
            </div>
        </div>

        <!-- Search Form -->
        <div class="search-form">
            <form action="{{ route('admin.free-apps.search') }}" method="GET" role="search" aria-label="Search free apps">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="search" placeholder="Search by name, category, or link..."
                    value="{{ $searchQuery ?? '' }}" aria-label="Search free apps">
                <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="close" aria-label="Close alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
                <button type="button" class="close" aria-label="Close alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Free Apps Table -->
        <div class="table-container">
            <table class="table tool-table" role="grid" aria-label="Free apps table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Link</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($freeApps as $app)
                        <tr role="row">
                            <td>{{ $app->id }}</td>
                            <td>
                                @if ($app->image_url)
                                    <img src="{{ $app->image_url }}" alt="{{ $app->name }} icon" loading="lazy">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $app->name }}</td>
                            <td>{{ $app->category }}</td>
                            <td>
                                @if ($app->external_link)
                                    <a href="{{ $app->external_link }}" target="_blank" class="action-btn"
                                        aria-label="Visit {{ $app->name }} link">
                                        <i class="fas fa-link"></i> Link
                                        <span class="tooltip">Visit Link</span>
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                <span
                                    class="badge badge-{{ strtolower($app->status) === 'active' ? 'success' : (strtolower($app->status) === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Actions for {{ $app->name }}">
                                    <a href="{{ route('admin.free-apps.edit', $app) }}" class="action-btn"
                                        aria-label="Edit {{ $app->name }}">
                                        <i class="fas fa-edit"></i> Edit
                                        <span class="tooltip">Edit App</span>
                                    </a>
                                    <form action="{{ route('admin.free-apps.destroy', $app) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this free app?');"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn error" aria-label="Delete {{ $app->name }}">
                                            <i class="fas fa-trash"></i> Delete
                                            <span class="tooltip">Delete App</span>
                                        </button>
                                    </form>
                                    @if (strtolower($app->status) !== 'active')
                                        <form action="{{ route('admin.free-apps.activate', $app) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn success" aria-label="Activate {{ $app->name }}">
                                                <i class="fas fa-check"></i> Activate
                                                <span class="tooltip">Activate App</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.free-apps.deactivate', $app) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn deactivate"
                                                aria-label="Deactivate {{ $app->name }}">
                                                <i class="fas fa-ban"></i> Deactivate
                                                <span class="tooltip">Deactivate App</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center" role="alert">No free apps found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $freeApps->appends(['search' => $searchQuery ?? ''])->links('vendor.pagination.custom') }}
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Close alerts
                document.querySelectorAll('.alert .close').forEach(button => {
                    button.addEventListener('click', () => {
                        button.closest('.alert').style.display = 'none';
                    });
                });

                // Accessibility: Keyboard navigation for table actions
                document.querySelectorAll('.btn-group .action-btn').forEach(button => {
                    button.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            button.click();
                        }
                    });
                });

                // Debounce search input
                const debounce = (func, wait) => {
                    let timeout;
                    return (...args) => {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => func.apply(this, args), wait);
                    };
                };

                const searchInput = document.querySelector('.search-form input');
                const searchForm = document.querySelector('.search-form form');

                if (searchInput && searchForm) {
                    const handleSearch = debounce(() => {
                        searchForm.submit();
                    }, 300);
                    searchInput.addEventListener('input', handleSearch);
                }

                // Sync with sidebar toggle
                document.querySelectorAll('.action-btn, .pagination a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 1024) {
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