@extends('user.layouts.app')

@section('title', 'Notifications')

@section('description', 'View and manage your notifications.')

@push('styles')
    <style>
        .notifications-container {
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

        .notification-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-lg);
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(20px);
            margin-bottom: var(--space-lg);
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-md);
            flex-wrap: wrap;
            gap: var(--space-md);
        }

        .notification-title {
            font-family: var(--font-display);
            font-size: clamp(1.25rem, 4vw, 1.5rem);
            color: var(--white);
            font-weight: 600;
        }

        .notification-table {
            width: 100%;
            border-collapse: collapse;
            font-family: var(--font-primary);
        }

        .notification-table th,
        .notification-table td {
            padding: var(--space-sm) var(--space-md);
            text-align: left;
            border-bottom: 1px solid var(--glass-border);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            color: var(--gray-300);
        }

        .notification-table th {
            color: var(--white);
            font-weight: 600;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .notification-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .notification-table .unread {
            background: rgba(99, 102, 241, 0.1);
            font-weight: 600;
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

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--space-sm);
            margin-top: var(--space-lg);
        }

        /* Light Theme */
        body.light .notifications-container {
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

        body.light .notification-card {
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .notification-table th,
        body.light .notification-table td {
            color: var(--gray-300);
        }

        body.light .notification-table tr:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        body.light .action-group .action-btn {
            color: var(--gray-300);
        }

        body.light .action-group .action-btn:hover {
            color: var(--white);
        }

        /* Accessibility */
        .action-btn:focus,
        .notification-table th:focus,
        .notification-table td:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .notifications-container {
                padding: var(--space-md);
            }

            .notification-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .notification-table th,
            .notification-table td {
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
    <section class="notifications-container">
        <div class="content-header">
            <div>
                <h1 class="page-title">Notifications</h1>
                <p class="page-subtitle">View and manage your notifications.</p>
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

        <div class="notification-card">
            <div class="notification-header">
                <h3 class="notification-title">Your Notifications</h3>
            </div>
            <div class="table-container">
                <table class="notification-table" role="grid" aria-label="Notifications table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifications as $notification)
                            <tr role="row" @if (!$notification->read) class="unread" @endif>
                                <td>{{ $notification->id }}</td>
                                <td>{{ $notification->type }}</td>
                                <td>{{ $notification->message }}</td>
                                <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $notification->read ? 'Read' : 'Unread' }}</td>
                                <td>
                                    <div class="action-group" role="group" aria-label="Actions for notification {{ $notification->id }}">
                                        @if (!$notification->read)
                                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="action-btn success" aria-label="Mark as read">
                                                    <i class="bi bi-check-circle"></i> Mark as Read
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No notifications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
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
