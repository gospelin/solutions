@extends('admin.layouts.app')

@section('title', 'Create Admin')
@section('description', 'Create a new admin account.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">Create Admin</h1>
            <p class="page-subtitle">Add a new administrator to the platform.</p>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST" class="modal-form">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required>
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-input" required>
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" required>
                @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="form-submit">Create Admin</button>
        </form>
    </section>
@endsection