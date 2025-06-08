@extends('admin.layouts.app')

@section('title', 'View Transaction')
@section('description', 'View details of a specific transaction.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">Transaction Details</h1>
            <p class="page-subtitle">Details of the transaction.</p>
        </div>
        <div class="stat-card">
            <p><strong>ID:</strong> {{ $transaction->id }}</p>
            <p><strong>User:</strong> {{ $transaction->user->name ?? 'N/A' }}</p>
            <p><strong>Tool:</strong> {{ $transaction->tool->name ?? 'N/A' }}</p>
            <p><strong>Amount:</strong> ${{ number_format($transaction->amount, 2) }}
                (₦{{ number_format($transaction->amount_ngn, 2) }})</p>
            <p><strong>Status:</strong> {{ $transaction->status }}</p>
            <p><strong>Selar Transaction ID:</strong> {{ $transaction->selar_transaction_id }}</p>
            <p><strong>Created:</strong> {{ $transaction->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
        <a href="{{ route('admin.transactions.index') }}" class="action-btn">Back</a>
    </section>
@endsection
