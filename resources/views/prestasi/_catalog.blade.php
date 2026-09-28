{{-- Isi katalog prestasi: status, grid, linimasa, keadaan kosong, paginasi.
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
  <!-- VIEW 1: Grid -->
  <div class="awards-catalog-grid" id="awards-grid-container">
    @foreach ($items as $item)
      <article class="award-card" onclick="openAwardModal('{{ $item['id'] }}')" role="button" tabindex="0" aria-label="Detail prestasi: {{ $item['title'] }}">
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
            <h3 class="award-card-title">{{ $item['title'] }}</h3>
            <p class="award-card-desc">{{ $item['excerpt'] }}</p>
          </div>
          <div class="award-card-footer">
            <span class="award-organizer" title="{{ $item['org'] }}">{{ $item['org'] }}</span>
            <span class="award-view-link">Detail &rarr;</span>
          </div>
        </div>
      </article>
    @endforeach
  </div>

  <!-- VIEW 2: Linimasa (dikelompokkan per tahun) -->
  <div class="awards-timeline-wrap" id="awards-timeline-container" style="display: none">
    @foreach ($items->groupBy('year') as $groupYear => $yearItems)
      <div class="timeline-year-block">
        <div class="timeline-year-marker">{{ $groupYear }}</div>
        @foreach ($yearItems as $item)
          <div class="timeline-item-card" onclick="openAwardModal('{{ $item['id'] }}')" role="button" tabindex="0" aria-label="{{ $item['title'] }}">
            <div class="timeline-card-content">
              <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:0.3rem;">
                <span class="{{ $item['level'] === 'nasional' ? 'badge-gold' : 'badge-primary' }}" style="font-size:0.72rem;">{{ $item['badge'] }}</span>
                <span style="font-size:0.8rem; color:var(--text-subtle);">{{ $item['dateStr'] }} &bull; {{ $item['location'] }}</span>
              </div>
              <h3>{{ $item['title'] }}</h3>
              <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6; margin-bottom:0.4rem;">{{ $item['excerpt'] }}</p>
              <span style="font-size:0.8rem; color:var(--text-subtle);">{{ $item['org'] }}</span>
            </div>
            <span class="award-view-link" style="white-space:nowrap;">Lihat &rarr;</span>
          </div>
        @endforeach
      </div>
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

{{-- Data modal detail untuk prestasi di halaman ini (dibaca oleh prestasi.js) --}}
<script type="application/json" id="awards-page-data">{!! Js::encode($awardsData) !!}</script>
