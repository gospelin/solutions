@extends('admin.layouts.app')

@section('title', isset($searchQuery) && $searchQuery ? 'Search Results' : 'Market Items')
@section('description', 'Manage marketplace items.')

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