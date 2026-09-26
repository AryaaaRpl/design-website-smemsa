@extends('admin.layouts.app')

@section('title', 'Unit Usaha')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Unit Usaha</h1>
            <p>Unit usaha BLUD yang dikelola siswa atau sekolah. Setiap unit menerima pesanan lewat WhatsApp sendiri.</p>
        </div>
        <a href="{{ route('admin.business-units.create') }}" class="btn btn-primary">+ Tambah Unit Usaha</a>
    </div>

    <div class="toolbar">
        <div></div>
        <form method="GET" action="{{ route('admin.business-units.index') }}" class="search-form">
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari nama unit usaha...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($units->isEmpty())
            <div class="empty-state">
                {{ $search ? 'Tidak ada unit usaha yang cocok dengan pencarian.' : 'Belum ada unit usaha.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Foto</th>
                            <th>Unit Usaha</th>
                            <th>Pengelola</th>
                            <th>WhatsApp</th>
                            <th>Produk</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                            <tr>
                                <td>{{ $unit->sort_order }}</td>
                                <td>
                                    @if ($unit->image_url)
                                        <img src="{{ $unit->image_url }}" alt="Foto {{ $unit->name }}" class="thumb">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $unit->name }}</strong>
                                    @if ($unit->tagline)
                                        <div class="text-muted" style="font-size: 13px;">{{ $unit->tagline }}</div>
                                    @endif
                                </td>
                                <td>{{ $unit->manager_label }}</td>
                                <td>{{ $unit->whatsapp }}</td>
                                <td>
                                    <a href="{{ route('admin.products.index', ['unit' => $unit->id]) }}">{{ $unit->products_count }} produk</a>
                                </td>
                                <td>
                                    <span class="status {{ $unit->is_active ? 'status-on' : 'status-off' }}">
                                        {{ $unit->is_active ? 'Tampil' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.products.create', ['unit' => $unit->id]) }}" class="btn btn-outline btn-sm">+ Produk</a>
                                        <a href="{{ route('admin.business-units.edit', $unit) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.business-units.destroy', $unit) }}"
                                            data-confirm="Hapus unit usaha &quot;{{ $unit->name }}&quot;?{{ $unit->products_count ? ' '.$unit->products_count.' produk milik unit ini ikut terhapus.' : '' }}">
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

    {{ $units->links('admin.partials.pagination') }}
@endsection
