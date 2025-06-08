@extends('admin.layouts.app')

@section('title', 'User Management')
@section('description', 'Manage user accounts, roles, and statuses.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">User Management</h1>
            <p class="page-subtitle">View, edit, ban, or delete user accounts.</p>
            <a href="{{ route('admin.users.create') }}" class="form-submit">Create Admin</a>
        </div>
        <div class="table-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('admin.users.role', $user) }}" method="POST">
                                    @csrf
                                    <select name="role" onchange="this.form.submit()">
                                        <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.users.ban', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="form-submit {{ $user->status === 'Banned' ? 'error' : 'success' }}">
                                        {{ $user->status === 'Banned' ? 'Unban' : 'Ban' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.users.delete', $user) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="form-submit error">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </section>
@endsection