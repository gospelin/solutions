@extends('admin.layouts.app')

@section('title', isset($searchQuery) && $searchQuery ? 'Search Results' : 'Market Items')
@section('description', 'Manage marketplace items.')

@push('styles')
<style>
/* Admin Dashboard Styles */
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --success-color: #2ecc71;
    --error-color: #e74c3c;
    --background-color: #f5f7fa;
    --text-color: #333;
    --border-color: #ddd;
    --shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    --font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

body {
    font-family: var(--font-family);
    background-color: var(--background-color);
    color: var(--text-color);
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

.content {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.content-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    gap: 1rem;
}

.page-title {
    font-size: 2rem;
    color: var(--primary-color);
    margin: 0;
}

.page-subtitle {
    font-size: 1rem;
    color: #666;
    margin: 0.5rem 0 0;
}

.search-form {
    display: flex;
    gap: 0.5rem;
}

.form-input {
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    outline: none;
    transition: border-color 0.3s ease;
}

.form-input:focus {
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
}

.form-submit {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    color: #fff;
    background-color: var(--secondary-color);
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-submit:hover {
    background-color: #2980b9;
}

.table-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: var(--shadow);
    overflow-x: auto;
}

.market-item-table {
    width: 100%;
    border-collapse: collapse;
}

.market-item-table th,
.market-item-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.market-item-table th {
    background-color: var(--primary-color);
    color: #fff;
    font-weight: 600;
}

.market-item-table tr:hover {
    background-color: #f9f9f9;
}

.action-btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    color: #fff;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: opacity 0.3s ease;
    margin-right: 0.5rem;
}

.action-btn:hover {
    opacity: 0.9;
}

.action-btn.success {
    background-color: var(--success-color);
}

.action-btn.error {
    background-color: var(--error-color);
}

.action-btn:not(.success):not(.error) {
    background-color: var(--secondary-color);
}

/* Pagination Styles */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 1.5rem;
    gap: 0.5rem;
}

.pagination a,
.pagination span {
    padding: 0.5rem 1rem;
    font-size: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    text-decoration: none;
    color: var(--text-color);
    transition: background-color 0.3s ease;
}

.pagination a:hover {
    background-color: var(--secondary-color);
    color: #fff;
    border-color: var(--secondary-color);
}

.pagination .current {
    background-color: var(--primary-color);
    color: #fff;
    border-color: var(--primary-color);
}

/* Responsive Design */
@media (max-width: 768px) {
    .content-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .search-form {
        width: 100%;
    }

    .form-input {
        width: 100%;
    }

    .market-item-table th,
    .market-item-table td {
        padding: 0.75rem;
        font-size: 0.9rem;
    }

    .action-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }

    .page-subtitle {
        font-size: 0.9rem;
    }

    .market-item-table th,
    .market-item-table td {
        padding: 0.5rem;
    }

    .action-btn {
        display: block;
        margin-bottom: 0.5rem;
        margin-right: 0;
    }
}
</style>
@endpush

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">
                {{ isset($searchQuery) && $searchQuery ? 'Search Results for "' . e($searchQuery) . '"' : 'Market Items' }}
            </h1>
            <p class="page-subtitle">View, create, edit, or delete market items.</p>
            <div class="search-form">
                <form action="{{ route('admin.search') }}" method="GET">
                    <input type="text" name="search" value="{{ $searchQuery ?? '' }}" placeholder="Search market items..."
                        class="form-input">
                    <button type="submit" class="form-submit">Search</button>
                </form>
            </div>
            <a href="{{ route('admin.tools.create') }}" class="form-submit">Create Market Item</a>
        </div>
        <div class="table-container">
            <table class="market-item-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price ($)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marketItems as $marketItem)
                        <tr>
                            <td>{{ $marketItem->id }}</td>
                            <td>{{ $marketItem->name }}</td>
                            <td>{{ $marketItem->category }}</td>
                            <td>{{ number_format($marketItem->price, 2) }}</td>
                            <td>{{ $marketItem->status }}</td>
                            <td>
                                <a href="{{ route('admin.tools.edit', $marketItem) }}" class="action-btn">Edit</a>
                                <form action="{{ route('admin.tools.destroy', $marketItem) }}" method="POST"
                                    style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn error">Delete</button>
                                </form>
                                @if ($marketItem->status === 'Approved')
                                    <form action="{{ route('admin.tools.reject', $marketItem) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn error">Reject</button>
                                    </form>
                                @elseif ($marketItem->status === 'Rejected' || $marketItem->status === 'Pending')
                                    <form action="{{ route('admin.tools.approve', $marketItem) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn success">Approve</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $marketItems->links('vendor.pagination.custom') }}
        </div>
    </section>
@endsection