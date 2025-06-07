<div class="flex justify-center items-center gap-2 mt-8">
    @if ($paginator->hasPages())
        <!-- Previous Button -->
        @if ($paginator->onFirstPage())
            <span class="pagination-link pagination-disabled">
                Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link pagination-active">
                Previous
            </a>
        @endif

        <!-- Page Numbers -->
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination-ellipsis">{{ $element }}</span>
            @elseif (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-link pagination-current">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="pagination-link pagination-active">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Button -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link pagination-active">
                Next
            </a>
        @else
            <span class="pagination-link pagination-disabled">
                Next
            </span>
        @endif
    @endif
</div>

<style>
    .pagination-link {
        padding: var(--space-sm) var(--space-md);
        font-size: clamp(0.75rem, 2.5vw, 0.875rem);
        border-radius: var(--radius-md);
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .pagination-active {
        color: var(--primary);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
    }

    .pagination-active:hover {
        color: var(--primary-light);
        background: var(--dark-surface);
        border-color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    .pagination-current {
        color: var(--white);
        background: var(--primary);
        border: 1px solid var(--primary);
        box-shadow: var(--shadow-md);
    }

    .pagination-disabled {
        color: var(--gray-400);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        cursor: not-allowed;
    }

    .pagination-ellipsis {
        padding: var(--space-sm) var(--space-md);
        color: var(--gray-400);
    }

    /* Light Theme Styles */
    body.light .pagination-active {
        color: var(--primary);
        background: var(--white);
        border-color: var(--gray-200);
    }

    body.light .pagination-active:hover {
        background: var(--gray-50);
        border-color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    body.light .pagination-current {
        color: var(--white);
        background: var(--primary);
        border-color: var(--primary);
    }

    body.light .pagination-disabled {
        color: var(--gray-400);
        background: var(--white);
        border-color: var(--gray-200);
    }

    body.light .pagination-ellipsis {
        color: var(--gray-400);
    }
</style>
