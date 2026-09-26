@extends('admin.layouts.app')

@section('title', 'Produk BLUD')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Produk BLUD</h1>
            <p>Barang dan jasa yang bisa dipesan pengunjung dari halaman detail produk.</p>
        </div>
        <a href="{{ route('admin.products.create', ['unit' => $unitId]) }}" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <div class="toolbar">
        <div class="filter-tabs">
            <a href="{{ route('admin.products.index', ['search' => $search ?: null]) }}"
                class="filter-tab {{ $unitId ? '' : 'active' }}">Semua</a>
            @foreach ($units as $unit)
                <a href="{{ route('admin.products.index', ['unit' => $unit->id, 'search' => $search ?: null]) }}"
                    class="filter-tab {{ $unitId === $unit->id ? 'active' : '' }}">{{ $unit->name }}</a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.products.index') }}" class="search-form">
            <input type="hidden" name="unit" value="{{ $unitId }}">
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari nama produk...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($products->isEmpty())
            <div class="empty-state">
                {{ $search ? 'Tidak ada produk yang cocok dengan pencarian.' : 'Belum ada produk.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Produk</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    @if ($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="Foto {{ $product->name }}" class="thumb">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    @if ($product->is_featured)
                                        <span class="status status-on" style="margin-left: 4px;">Unggulan</span>
                                    @endif
                                    <div class="text-muted" style="font-size: 13px;">{{ $product->businessUnit->name }}</div>
                                </td>
                                <td>{{ $product->type->label() }}</td>
                                <td>{{ $product->price_label }}</td>
                                <td>{{ $product->tracksStock() ? $product->stock : '-' }}</td>
                                <td>
                                    <span class="status {{ $product->is_active ? 'status-on' : 'status-off' }}">
                                        {{ $product->is_active ? 'Tampil' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('blud.show', $product) }}" target="_blank" class="btn btn-outline btn-sm">Lihat</a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                            data-confirm="Hapus produk &quot;{{ $product->name }}&quot;? Riwayat pesanannya tetap tersimpan.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{ $products->links('admin.partials.pagination') }}
@endsection
