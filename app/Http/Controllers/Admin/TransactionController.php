<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'tool'])->paginate(10);
        return view('admin.transactions', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'tool']);
        return view('admin.transactions.show', compact('transaction'));
    }
}
