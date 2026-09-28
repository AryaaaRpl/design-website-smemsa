{{-- Paginasi katalog prestasi. Link membawa data-catalog-link agar dimuat tanpa refresh oleh prestasi.js. --}}
@if ($paginator->hasPages())
  <nav class="award-pagination" aria-label="Navigasi halaman prestasi">
    @if ($paginator->onFirstPage())
      <span class="award-page-arrow is-disabled" aria-disabled="true">
        <span aria-hidden="true">&larr;</span><span class="award-page-arrow-text">Sebelumnya</span>
      </span>
    @else
      <a class="award-page-arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" data-catalog-link aria-label="Halaman sebelumnya">
        <span aria-hidden="true">&larr;</span><span class="award-page-arrow-text">Sebelumnya</span>
      </a>
    @endif

    <ol class="award-page-numbers">
      @foreach ($elements as $element)
        @if (is_string($element))
          <li><span class="award-page-gap" aria-hidden="true">&hellip;</span></li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            <li>
              @if ($page == $paginator->currentPage())
                <span class="award-page-number is-current" aria-current="page">{{ $page }}</span>
              @else
                <a class="award-page-number" href="{{ $url }}" data-catalog-link aria-label="Halaman {{ $page }}">{{ $page }}</a>
              @endif
            </li>
          @endforeach
        @endif
      @endforeach
    </ol>

    <span class="award-page-info">Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>

    @if ($paginator->hasMorePages())
      <a class="award-page-arrow" href="{{ $paginator->nextPageUrl() }}" rel="next" data-catalog-link aria-label="Halaman berikutnya">
        <span class="award-page-arrow-text">Berikutnya</span><span aria-hidden="true">&rarr;</span>
      </a>
    @else
      <span class="award-page-arrow is-disabled" aria-disabled="true">
        <span class="award-page-arrow-text">Berikutnya</span><span aria-hidden="true">&rarr;</span>
      </span>
    @endif
  </nav>
@endif
