@extends('admin.layouts.app')

@section('title', isset($searchQuery) && $searchQuery ? 'Search Results' : 'Tools')
@section('description', 'Manage Tools.')

@section('content')
    <section class="content">
        <div class="content-header">
            <p class="page-subtitle">View, create, edit, or delete market items.</p>
            <div class="search-form">
                <form action="{{ route('admin.search') }}" method="GET">
                    <input type="text" name="search" value="{{ $searchQuery ?? '' }}" placeholder="Search market items..."
                        class="form-input">
                    <button type="submit" class="form-submit"><i class="fas fa-search"></i> Search</button>
                </form>
            </div>
            <a href="{{ route('admin.tools.create') }}" class="form-submit"><i class="fas fa-plus"></i> Create Market Item</a>
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
                                <a href="{{ route('admin.tools.edit', $marketItem) }}" class="action-btn"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('admin.tools.destroy', $marketItem) }}" method="POST"
                                    style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn error"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                                @if ($marketItem->status === 'Approved')
                                    <form action="{{ route('admin.tools.reject', $marketItem) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn error"><i class="fas fa-times"></i> Reject</button>
                                    </form>
                                @elseif ($marketItem->status === 'Rejected' || $marketItem->status === 'Pending')
                                    <form action="{{ route('admin.tools.approve', $marketItem) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn success"><i class="fas fa-check"></i> Approve</button>
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