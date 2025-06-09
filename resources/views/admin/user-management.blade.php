@extends('admin.layouts.app')

@section('title', 'User Management')

@section('description', 'Manage platform users, including bans, role assignments, and deletions.')

@push('styles')
    <style>
        .users-container {
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
            background: rgba(34, 197, 94, 0.1);
        }

        .alert-error {
            border-color: var(--error);
            background: rgba(239, 68, 68, 0.1);
        }

        .chart-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-lg);
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(20px);
            margin-bottom: var(--space-lg);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-md);
            flex-wrap: wrap;
            gap: var(--space-md);
        }

        .chart-title {
            font-family: var(--font-display);
            font-size: clamp(1.25rem, 4vw, 1.5rem);
            color: var(--white);
            font-weight: 600;
        }

        .chart-actions {
            display: flex;
            gap: var(--space-md);
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-sm) var(--space-md);
            color: var(--white);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            width: clamp(200px, 50vw, 300px);
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .chart-actions .action-btn {
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

        .chart-actions .action-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .table-container {
            overflow-x: auto;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            font-family: var(--font-primary);
        }

        .user-table th,
        .user-table td {
            padding: var(--space-sm) var(--space-md);
            text-align: left;
            border-bottom: 1px solid var(--glass-border);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            color: var(--gray-300);
            text-transform: capitalize;
        }

        .user-table th {
            color: var(--white);
            font-weight: 600;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .user-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .action-group {
            display: flex;
            gap: var(--space-sm);
            flex-wrap: wrap;
        }

        .action-group .action-btn {
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

        .action-group .action-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            transform: scale(1.02);
        }

        .action-group .action-btn.success {
            border-color: var(--success);
            color: var(--success);
            background: rgba(34, 197, 94, 0.1);
        }

        .action-group .action-btn.success:hover {
            background: var(--success);
            border-color: var(--success);
            color: var(--white);
        }

        .action-group .action-btn.error {
            border-color: var(--error);
            color: var(--error);
            background: rgba(239, 68, 68, 0.1);
        }

        .action-group .action-btn.error:hover {
            background: var(--error);
            border-color: var(--error);
            color: var(--white);
        }

        .action-group .action-btn .tooltip {
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

        .action-group .action-btn:hover .tooltip {
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
        body.light .users-container {
            background: var(--gray-50);
        }

        body.light .page-title {
            background: none;
            -webkit-text-fill-color: var(--primary);
        }

        body.light .page-subtitle {
            color: var(--gray-400);
        }

        body.light .alert {
            color: var(--gray-300);
        }

        body.light .chart-card {
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .search-input {
            color: var(--gray-300);
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .user-table th,
        body.light .user-table td {
            color: var(--gray-300);
        }

        body.light .user-table tr:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        body.light .action-group .action-btn {
            color: var(--gray-300);
        }

        body.light .action-group .action-btn:hover {
            color: var(--white);
        }

        body.light .action-group .action-btn .tooltip {
            background: var(--gray-50);
            color: var(--gray-300);
        }

        /* Accessibility */
        .search-input:focus,
        .action-btn:focus,
        .user-table th:focus,
        .user-table td:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .users-container {
                padding: var(--space-md);
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .chart-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .chart-actions {
                flex-direction: column;
                width: 100%;
            }

            .search-input {
                width: 100%;
            }

            .user-table th,
            .user-table td {
                padding: var(--space-xs) var(--space-sm);
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }

            .action-group .action-btn {
                padding: var(--space-xs) var(--space-sm);
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }
        }

        @media (max-width: 640px) {
            .action-group {
                flex-direction: column;
                gap: var(--space-xs);
            }

            .action-group .action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <section class="users-container">
        <div class="content-header">
            <div>
                <h1 class="page-title">User Management</h1>
                <p class="page-subtitle">View and control user accounts with ease.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Users</h3>
                <div class="chart-actions">
                    <input type="text" class="search-input" id="userSearch" placeholder="Search by name or email..." aria-label="Search users">
                    <a href="{{ route('admin.users.create') }}" class="action-btn" aria-label="Create new admin">
                        <i class="bi bi-plus-circle"></i> Create Admin
                    </a>
                </div>
            </div>
            <div class="table-container">
                <table class="user-table" role="grid" aria-label="Users management table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        @foreach ($users as $user)
                            @if ($user->hasRole('user'))
                                <tr role="row">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->status ?? 'active') }}</td>
                                    <td>
                                        <div class="action-group" role="group" aria-label="Actions for {{ $user->name }}">
                                            <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="action-btn {{ ($user->status ?? 'active') == 'banned' ? 'success' : 'error' }}" aria-label="{{ ($user->status ?? 'active') == 'banned' ? 'Unban' : 'Ban' }} {{ $user->name }}">
                                                    <i class="bi {{ ($user->status ?? 'active') == 'banned' ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                                                    {{ ($user->status ?? 'active') == 'banned' ? 'Unban' : 'Ban' }}
                                                    <span class="tooltip">{{ ($user->status ?? 'active') == 'banned' ? 'Unban User' : 'Ban User' }}</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn error" aria-label="Delete {{ $user->name }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                    <span class="tooltip">Delete User</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $users->links('vendor.pagination.custom') }}
                </div>
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

                // Search functionality
                const searchInput = document.getElementById('userSearch');
                const tableBody = document.getElementById('userTableBody');
                const rows = tableBody.querySelectorAll('tr');

                const performSearch = debounce(() => {
                    const searchTerm = searchInput.value.toLowerCase();
                    rows.forEach(row => {
                        const name = row.cells[1].textContent.toLowerCase();
                        const email = row.cells[2].textContent.toLowerCase();
                        if (name.includes(searchTerm) || email.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }, 300);

                if (searchInput) {
                    searchInput.addEventListener('input', performSearch);
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
