{{-- Kartu produk BLUD. Butuh $product dengan relasi businessUnit. --}}
<a href="{{ route('blud.show', $product) }}" class="bl-card" aria-label="Lihat detail {{ $product->name }}">
  <div class="bl-card-photo">
    @if ($product->image_url)
      <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
    @else
      <span class="bl-noimg">Belum ada gambar</span>
    @endif
    <span class="bl-card-type">{{ $product->type->label() }}</span>
  </div>
  <div class="bl-card-body">
    <span class="bl-card-unit">{{ $product->businessUnit->name }}</span>
    <h3>{{ $product->name }}</h3>
    @if ($product->summary)
      <p>{{ $product->summary }}</p>
    @endif
    <span class="bl-card-link">{{ $product->isAvailable() ? 'Lihat & Pesan' : 'Stok Habis · Lihat Detail' }} &rarr;</span>
  </div>
</a>
