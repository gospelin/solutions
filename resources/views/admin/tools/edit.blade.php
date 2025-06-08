@extends('admin.layouts.app')

@section('title', 'Edit Market Item')
@section('description', 'Update an existing market item.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">Edit Market Item</h1>
            <p class="page-subtitle">Modify the details of the market item.</p>
        </div>
        <form action="{{ route('admin.tools.update', $tool) }}" method="POST" enctype="multipart/form-data"
            class="modal-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $tool->name) }}" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-input"
                    value="{{ old('category', $tool->category) }}" required>
                @error('category') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description"
                    class="form-input">{{ old('description', $tool->description) }}</textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" name="price" id="price" class="form-input" value="{{ old('price', $tool->price) }}"
                    step="0.01" required>
                @error('price') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="price_ngn">Price (NGN)</label>
                <input type="number" name="price_ngn" id="price_ngn" class="form-input"
                    value="{{ old('price_ngn', $tool->price_ngn) }}" step="0.01" required>
                @error('price_ngn') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="external_link">External Link</label>
                <input type="url" name="external_link" id="external_link" class="form-input"
                    value="{{ old('external_link', $tool->external_link) }}">
                @error('external_link') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-input">
                @if ($tool->image)
                    <p>Current Image: <img src="{{ asset('storage/' . $tool->image) }}" alt="Current Image"
                            style="max-width: 100px;"></p>
                @endif
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="form-submit">Update Market Item</button>
        </form>
    </section>
@endsection