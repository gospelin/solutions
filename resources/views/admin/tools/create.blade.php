@extends('admin.layouts.app')

@section('title', __('Create New Tool'))
@section('description', __('Add a new tool to the marketplace.'))

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">{{ __('Create New Tool') }}</h1>
            <p class="page-subtitle">{{ __('Fill in the details to add a new tool.') }}</p>
        </div>
        <form action="{{ route('admin.tools.store') }}" method="POST" enctype="multipart/form-data" class="modal-form">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="category">{{ __('Category') }}</label>
                <select name="category" id="category" class="form-input" required>
                    <option value="" disabled {{ old('category') == '' ? 'selected' : '' }}>{{ __('Select a category') }}
                    </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}
                        </option>
                    @endforeach
                </select>
                @error('category') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <textarea name="description" id="description" class="form-input">{{ old('description') }}</textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="price">{{ __('Price ($)') }}</label>
                <input type="number" name="price" id="price" class="form-input" value="{{ old('price') }}" step="0.01"
                    required>
                @error('price') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="price_ngn">{{ __('Price (NGN)') }}</label>
                <input type="number" name="price_ngn" id="price_ngn" class="form-input" value="{{ old('price_ngn') }}"
                    step="0.01" required>
                @error('price_ngn') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="external_link">{{ __('External Link') }}</label>
                <input type="url" name="external_link" id="external_link" class="form-input"
                    value="{{ old('external_link') }}">
                @error('external_link') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="image">{{ __('Image') }}</label>
                <input type="file" name="image" id="image" class="form-input">
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="form-submit"><i class="fas fa-plus"></i> {{ __('Create New Tool') }}</button>
        </form>
    </section>
@endsection