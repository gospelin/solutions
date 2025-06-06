@extends('admin.layouts.app')

@section('title', 'Create Admin')

@section('description', 'Create a new admin account for the platform.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">Create Admin</h1>
            <p class="page-subtitle">Add a new administrator to manage the platform.</p>
        </div>

        @if (session('message'))
            <div class="chart-card" style="background: var(--success); color: var(--white); margin-bottom: var(--space-lg);">
                <p>{{ session('message') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="chart-card" style="background: var(--error); color: var(--white); margin-bottom: var(--space-lg);">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Admin Creation Form</h3>
            </div>
            <form action="{{ route('admin.store') }}" method="POST" class="modal-form">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error-text"
                            style="color: var(--error); font-size: clamp(0.625rem, 2vw, 0.75rem);">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error-text"
                            style="color: var(--error); font-size: clamp(0.625rem, 2vw, 0.75rem);">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-input" required>
                    @error('password')
                        <span class="error-text"
                            style="color: var(--error); font-size: clamp(0.625rem, 2vw, 0.75rem);">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input"
                        required>
                </div>
                <button type="submit" class="form-submit">Create Admin</button>
            </form>
        </div>
    </section>
@endsection
