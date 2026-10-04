{{-- Isi katalog prestasi: status, grid, keadaan kosong, paginasi.
     Dirender di server; saat filter/halaman berganti, bagian ini dimuat ulang oleh prestasi.js. --}}
@php
  $items = collect($achievements->items())->map->toCatalogArray();
  $hasFilter = $search !== '' || $activeCategory || $year;
@endphp

<!-- Status -->
<div class="catalog-status-bar" id="catalog-status-bar">
  <span id="catalog-count-text">
    @if ($achievements->total() > 0)
      Menampilkan {{ $achievements->firstItem() }}–{{ $achievements->lastItem() }} dari {{ $achievements->total() }} prestasi
      @if ($hasFilter) (Total {{ $totalAchievements }} koleksi) @endif
    @else
      Menampilkan 0 dari {{ $totalAchievements }} prestasi
    @endif
  </span>
  <span id="active-filter-indicator" style="font-size: 0.85rem; color: var(--primary); font-weight: 700">
    {{ collect([$activeCategory?->name, $year ? 'Tahun '.$year : null, $search !== '' ? '"'.$search.'"' : null])->filter()->implode(' • ') }}
  </span>
</div>

@if ($items->isNotEmpty())
  <div class="awards-catalog-grid" id="awards-grid-container">
    @foreach ($items as $item)
      <a href="{{ route('prestasi.show', $item['id']) }}" class="award-card" data-reveal aria-label="Detail prestasi: {{ $item['title'] }}">
        <div class="award-card-header {{ $item['imageUrl'] ? 'has-image' : '' }}" @if ($item['imageUrl']) style="background-image: url('{{ $item['imageUrl'] }}');" @endif>
          <div class="award-card-tags-row">
            <span class="award-badge-pill {{ $item['level'] === 'nasional' ? 'national' : '' }}">{{ $item['badge'] }}</span>
            <span class="award-year-tag">{{ $item['year'] }}</span>
          </div>
          <div class="award-headline-typo">{{ $item['categoryLabel'] }}</div>
        </div>
        <div class="award-card-body">
          <div>
            <div class="award-sub-meta">
              <span>{{ $item['dateStr'] }}</span>
              <span>&bull;</span>
              <span>{{ $item['location'] }}</span>
            </div>
            <h3 class="award-card-title" aria-level="2">{{ $item['title'] }}</h3>
            <p class="award-card-desc">{{ $item['excerpt'] }}</p>
          </div>
          <div class="award-card-footer">
            <span class="award-organizer" title="{{ $item['org'] }}">{{ $item['org'] }}</span>
            <span class="award-view-link">Detail &rarr;</span>
          </div>
        </div>
      </a>
    @endforeach
  </div>

  {{ $achievements->onEachSide(1)->links('prestasi._pagination') }}
@else
  <!-- Keadaan kosong -->
  <div class="catalog-empty-state active" id="catalog-empty-state">
    <h3 style="color: var(--primary-dark); font-size: 1.4rem; margin-bottom: 0.6rem;">
      {{ $totalAchievements === 0 ? 'Belum ada data prestasi' : 'Tidak ada prestasi yang cocok' }}
    </h3>
    <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 1.5rem;">
      @if ($totalAchievements === 0)
        Rekam jejak prestasi siswa sedang disiapkan. Silakan kembali lagi nanti.
      @else
        Coba gunakan kata kunci pencarian lain atau atur ulang filter kategori dan tahun.
      @endif
    </p>
    @if ($totalAchievements > 0)
      <a class="btn btn-outline" href="{{ route('prestasi') }}#katalog-prestasi" data-catalog-link>Atur Ulang Filter</a>
    @endif
  </div>
@endif
