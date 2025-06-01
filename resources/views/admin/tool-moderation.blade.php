@extends('admin.layouts.app')

@section('title', 'Tool Moderation')

@section('description', 'Manage and moderate tools submitted to the platform.')

@section('content')
<section class="content">
    <div class="content-header">
        <h1 class="page-title">Tool Moderation</h1>
        <p class="page-subtitle">Review and approve or reject submitted tools.</p>
    </div>

    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Tool List</h3>
            <div class="chart-actions">
                <input type="text" class="search-input" id="toolSearch" placeholder="Search tools...">
            </div>
        </div>
        <div class="table-container">
            <table class="tool-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Submitted By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="toolTableBody">
                    @foreach ($tools as $tool)
                    <tr>
                        <td>{{ $tool->name }}</td>
                        <td>{{ $tool->category }}</td>
                        <td>{{ $tool->submitted_by }}</td>
                        <td>{{ $tool->status }}</td>
                        <td>
                            @if ($tool->status !== 'Approved')
                            <form action="{{ route('admin.tools.approve', $tool->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="action-btn success">
                                    <i class="bi bi-check-circle"></i> Approve
                                </button>
                            </form>
                            @endif
                            @if ($tool->status !== 'Rejected')
                            <form action="{{ route('admin.tools.reject', $tool->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="action-btn error">
                                    <i class="bi bi-x-circle"></i> Reject
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection