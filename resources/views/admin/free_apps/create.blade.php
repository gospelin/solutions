@extends('admin.layouts.app')

@section('title', 'Create Free App')

@section('description', 'Add a new free app to the Mr Solution platform.')

@push('styles')
    <style>
        .create-app-container {
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
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
        }

        .form-group .error {
            color: var(--error);
            font-size: clamp(0.625rem, 2vw, 0.75rem);
            margin-top: var(--space-xs);
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
            transition: all 0.3ilers ease;
        }

        .form-submit:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        /* Light Theme */
        body.light .create-app-container {
            background: var(--gray-50);
        }

        body.light .page-title {
            background: none;
            -webkit-text-fill-color: var(--primary);
        }

        body.light .form-container {
            background: var(--glass-bg);
            border-color: var(--glass-border);
        }

        body.light .form-group label {
            color: var(--gray-300);
        }

        /* Accessibility */
        .form-group input:focus,
        .form-group textarea:focus,
        .form-submit:focus,
        .action-btn:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .create-app-container {
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

            .form-submit,
            .card-tools .action-btn {
                font-size: clamp(0.625rem, 2vw, 0.75rem);
                padding: var(--space-xs) var(--space-sm);
            }
        }
    </style>
@endpush

@section('content')
    <section class="create-app-container">
        <div class="content-header">
            <div>
                <h1 class="page-title">Add New Free App</h1>
                <p class="page-subtitle">Create a new free app for the platform.</p>
            </div>
            <div class="card-tools">
                <a href="{{ route('admin.free-apps.index') }}" class="action-btn" aria-label="Back to free apps list">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.free-apps.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-form" role="form" aria-label="Create free app form">
                @csrf
                <div class="form-group @error('name') error @enderror">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required aria-required="true"
                        aria-label="App name">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('description') error @enderror">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"
                        aria-label="App description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('category') error @enderror">
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}" required
                        aria-required="true" aria-label="App category">
                    @error('category')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('external_link') error @enderror">
                    <label for="external_link">External Link</label>
                    <input type="url" name="external_link" id="external_link" value="{{ old('external_link') }}"
                        aria-label="App external link">
                    @error('external_link')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('image') error @enderror">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" aria-label="App image upload">
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="form-submit" aria-label="Save new app">
                    <i class="fas fa-save"></i> Save
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
