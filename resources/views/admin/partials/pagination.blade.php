@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Navigasi halaman">
        @if ($paginator->onFirstPage())
            <span class="page-link disabled">&larr; Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link">&larr; Sebelumnya</a>
        @endif

        <span class="page-info">Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">Berikutnya &rarr;</a>
        @else
            <span class="page-link disabled">Berikutnya &rarr;</span>
        @endif
    </nav>
@endif
