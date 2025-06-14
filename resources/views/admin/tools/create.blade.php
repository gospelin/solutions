@extends('admin.layouts.app')

@section('title', __('Create New Tool'))

@section('description', __('Add a new tool to the marketplace.'))

@push('styles')
    <style>
        .create-tool-container {
            padding: var(--space-lg);
            background: var(--dark-bg);
            min-height: 100vh;
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .content-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: var(--space-md);
            margin-bottom: var(--space-xl);
        }

        .page-title {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 5vw, 2rem);
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-subtitle {
            color: var(--gray-400);
            font-size: clamp(0.875rem, 3vw, 1rem);
        }

        .card-tools .action-btn {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--gray-300);
            padding: var(--space-sm) var(--space-md);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            border-radius: var(--radius-md);
            display: inline-flex;
            align-items: center;
            gap: var(--space-xs);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .card-tools .action-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            transform: scale(1.02);
        }

        .form-container {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--space-lg);
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(20px);
        }

        .form-group {
            margin-bottom: var(--space-lg);
        }

        .form-group label {
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            font-weight: 500;
            color: var(--gray-300);
            margin-bottom: var(--space-xs);
            display: block;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--space-sm) var(--space-md);
            color: var(--white);
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            font-family: var(--font-primary);
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group .error {
            color: var(--error);
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            margin-top: var(--space-xs);
            display: block;
        }

        .form-submit {
            background: var(--gradient-primary);
            border: none;
            border-radius: var(--radius-md);
            padding: var(--space-sm) var(--space-md);
            color: var(--white);
            font-weight: 600;
            cursor: pointer;
            font-size: clamp(0.75rem, 2.5vw, 0.875rem);
            display: inline-flex;
            align-items: center;
            gap: var(--space-xs);
            transition: all 0.3s ease;
        }

        .form-submit:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        /* Light Theme */
        body.light .create-tool-container {
            background: var(--gray-50);
        }

        body.light .page-title {
            background: none;
            -webkit-text-fill-color: var(--primary);
        }

        body.light .page-subtitle {
            color: var(--gray-400);
        }

        body.light .form-container {
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .form-group label {
            color: var(--gray-300);
        }

        body.light .form-group input,
        body.light .form-group textarea,
        body.light .form-group select {
            color: var(--gray-300);
        }

        /* Accessibility */
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus,
        .form-submit:focus,
        .action-btn:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .create-tool-container {
                padding: var(--space-md);
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-container {
                padding: var(--space-md);
            }
        }

        @media (max-width: 640px) {
            .form-group label {
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }

            .form-group input,
            .form-group textarea,
            .form-group select {
                font-size: clamp(0.625rem, 2vw, 0.75rem);
            }

            .form-submit,
            .card-tools .action-btn {
                font-size: clamp(0.625rem, 2vw, 0.75rem);
                padding: var(--space-xs) var(--space-sm);
            }
        }
    </style>
@endpush

@section('content')
    <section class="create-tool-container">
        <div class="content-header">
            <div>
                <h1 class="page-title">{{ __('Create New Tool') }}</h1>
                <p class="page-subtitle">{{ __('Fill in the details to add a new tool.') }}</p>
            </div>
            <div class="card-tools">
                <a href="{{ route('admin.tools.index') }}" class="action-btn" aria-label="Back to tools list">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.tools.store') }}" method="POST" enctype="multipart/form-data" class="modal-form"
                role="form" aria-label="Create new tool form">
                @csrf
                <div class="form-group @error('name') error @enderror">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required aria-required="true"
                        aria-label="Tool name">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error('category') error @enderror">
                    <label for="category">{{ __('Category') }}</label>
                    <select name="category" id="category" required aria-required="true" aria-label="Tool category">
                        <option value="" disabled {{ old('category') == '' ? 'selected' : '' }}>{{ __('Select a category') }}
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                {{ ucfirst($category) }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error('description') error @enderror">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea name="description" id="description"
                        aria-label="Tool description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error('price') error @enderror">
                    <label for="price">{{ __('Price ($)') }}</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                        aria-required="true" aria-label="Tool price in USD">
                    @error('price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error('price_ngn') error @enderror">
                    <label for="price_ngn">{{ __('Price (NGN)') }}</label>
                    <input type="number" name="price_ngn" id="price_ngn" value="{{ old('price_ngn') }}" step="0.01" required
                        aria-required="true" aria-label="Tool price in NGN">
                    @error('price_ngn')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error('external_link') error @enderror">
                    <label for="external_link">{{ __('External Link') }}</label>
                    <input type="url" name="external_link" id="external_link" value="{{ old('external_link') }}"
                        aria-label="Tool external link">
                    @error('external_link')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error('image') error @enderror">
                    <label for="image">{{ __('Image') }}</label>
                    <input type="file" name="image" id="image" accept="image/*" aria-label="Tool image upload">
                    @error('image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="form-submit" aria-label="Create new tool">
                    <i class="fas fa-plus"></i> {{ __('Create New Tool') }}
                </button>
            </form>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Sync with sidebar toggle
                document.querySelectorAll('.action-btn, .form-submit').forEach(button => {
                    button.addEventListener('click', () => {
                        if (window.innerWidth <= 1024) {
                            const sidebar = document.getElementById('sidebar');
                            const overlay = document.getElementById('overlay');
                            if (sidebar && sidebar.classList.contains('active')) {
                                sidebar.classList.remove('active');
                                overlay.classList.remove('active');
                                document.getElementById('menuToggle').classList.remove('active');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
