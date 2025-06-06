@extends('user.layouts.app')

@section('title', '{{ $item->name }} - Market')

@section('description', '{{ Str::limit($item->description, 160) }}')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
            <a href="{{ route('user.dashboard') }}" class="hover:underline">Home</a>
            <span>/</span>
            <a href="{{ route('market') }}" class="hover:underline">Market</a>
            <span>/</span>
            <span class="font-semibold">{{ Str::limit($item->name, 30) }}</span>
        </nav>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $item->name }}</h1>
            <p class="text-gray-700 mb-4">{{ $item->description }}</p>
            <p class="text-lg font-bold mb-4">${{ number_format($item->price, 2) }}</p>
            <p class="text-gray-600 mb-4">Category: {{ $item->category }}</p>
            <p class="text-gray-600 mb-4">Purchases: {{ $item->purchases_count }}</p>
            <a href="{{ route('market.purchase', $item->id) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Purchase Now</a>
        </div>
    </div>
@endsection