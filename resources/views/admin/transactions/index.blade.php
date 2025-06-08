@extends('admin.layouts.app')

@section('title', 'Transactions')
@section('description', 'View transaction logs from Selar payments.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">Transaction Logs</h1>
            <p class="page-subtitle">Monitor payment transactions.</p>
        </div>
        <div class="table-container">
            <table class="transactions-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Tool</th>
                        <th>Amount ($)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                            <td>{{ $transaction->tool->name ?? 'N/A' }}</td>
                            <td>{{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>
                                <a href="{{ route('admin.transactions.show', $transaction) }}" class="action-btn">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $transactions->links() }}
        </div>
    </section>
@endsection
