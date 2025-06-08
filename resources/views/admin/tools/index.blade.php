@extends('admin.layouts.app')

@section('title', isset($searchQuery) && $searchQuery ? 'Search Results' : 'Tools Management')
@section('description', 'Manage marketplace items.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">
                {{ isset($searchQuery) && $searchQuery ? 'Search Results for "' . e($searchQuery) . '"' : 'Tools Management' }}
            </h1>
            <p class="page-subtitle">View, create, edit, or delete tools.</p>
            <div class="search-form">
                <form action="{{ route('admin.tools.search') }}" method="GET">
                    <input type="text" name="search" value="{{ $searchQuery ?? '' }}" placeholder="Search Tools..."
                        class="form-input">
                    <button type="submit" class="form-submit"><i class="fas fa-search"></i> Search</button>
                </form>
            </div>
            <a href="{{ route('admin.tools.create') }}" class="form-submit"><i class="fas fa-plus"></i> Create New
                Tool</a>
        </div>
        <div class="table-container">
            <table class="market-item-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price ($)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($marketItems as $marketItem)
                        <tr>
                            <td>{{ $marketItem->id }}</td>
                            <td>
                                @if ($marketItem->image_url)
                                    <img src="{{ $marketItem->image_url }}" alt="{{ $marketItem->name }}"
                                        style="max-width: 50px; max-height: 50px; object-fit: cover; border-radius: var(--radius-md);">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td style="text-transform: capitalize;">{{ $marketItem->name }}</td>
                            <td style="text-transform: capitalize;">{{ $marketItem->category }}</td>
                            <td>{{ number_format($marketItem->price, 2) }}</td>
                            <td style="text-transform: capitalize;">{{ $marketItem->status }}</td>
                            <td>
                                <a href="{{ route('admin.tools.edit', $marketItem) }}" class="action-btn"><i
                                        class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('admin.tools.destroy', $marketItem) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Are you sure you want to permanently delete this market item and all related records (e.g., orders, reviews)? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn error"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                                @if ($marketItem->isActive())
                                    <form action="{{ route('admin.tools.deactivate', $marketItem) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn error"><i class="fas fa-times"></i> {{ __('Deactivate') }}</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.tools.activate', $marketItem) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn success"><i class="fas fa-check"></i> {{ __('Activate') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No market items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $marketItems->links('vendor.pagination.custom') }}
        </div>
    </section>
@endsection
