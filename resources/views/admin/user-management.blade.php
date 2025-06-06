@extends('admin.layouts.app')

@section('title', 'User Management')

@section('description', 'Manage platform users, including bans, role assignments, and deletions.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">User Management</h1>
            <p class="page-subtitle">View and control user accounts with ease.</p>
        </div>

        @if (session('success'))
            <div class="chart-card" style="background: var(--success); color: var(--white); margin-bottom: var(--space-lg);">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="chart-card" style="background: var(--error); color: var(--white); margin-bottom: var(--space-lg);">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">User List</h3>
                <div class="chart-actions">
                    <input type="text" class="search-input" id="userSearch" placeholder="Search users...">
                    <a href="{{ route('admin.create') }}" class="action-btn success">
                        <i class="bi bi-plus-circle"></i> Create Admin
                    </a>
                </div>
            </div>
            <div class="table-container">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('admin.user.role', $user->id) }}" method="POST">
                                        @csrf
                                        <select name="role" class="form-input" onchange="this.form.submit()">
                                            <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $user->status ?? 'Active' }}</td>
                                <td>
                                    <form action="{{ route('admin.user.ban', $user->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit"
                                            class="action-btn {{ ($user->status ?? 'Active') == 'Banned' ? 'success' : 'error' }}">
                                            <i
                                                class="bi {{ ($user->status ?? 'Active') == 'Banned' ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                                            {{ ($user->status ?? 'Active') == 'Banned' ? 'Unban' : 'Ban' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn error"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection