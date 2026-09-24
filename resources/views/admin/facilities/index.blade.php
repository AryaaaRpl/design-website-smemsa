@extends('admin.layouts.app')

@section('title', 'Fasilitas')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Fasilitas</h1>
            <p>Titik denah, daftar TEFA, dan grid fasilitas unggulan di halaman fasilitas.</p>
        </div>
        <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary">+ Tambah Fasilitas</a>
    </div>

    <div class="toolbar">
        <div class="filter-tabs">
            <a href="{{ route('admin.facilities.index', ['search' => $search ?: null]) }}"
                class="filter-tab {{ $activeType ? '' : 'active' }}">Semua</a>
            @foreach ($types as $type)
                <a href="{{ route('admin.facilities.index', ['type' => $type->value, 'search' => $search ?: null]) }}"
                    class="filter-tab {{ $activeType === $type ? 'active' : '' }}">{{ $type->label() }}</a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.facilities.index') }}" class="search-form">
            @if ($activeType)
                <input type="hidden" name="type" value="{{ $activeType->value }}">
            @endif
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari nama fasilitas...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($facilities->isEmpty())
            <div class="empty-state">
                {{ $search ? 'Tidak ada fasilitas yang cocok dengan pencarian.' : 'Belum ada fasilitas.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Tampil di</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilities as $facility)
                            <tr>
                                <td>{{ $facility->sort_order }}</td>
                                <td>
                                    @if ($facility->images->isNotEmpty())
                                        <img src="{{ $facility->images->first()->url }}" alt="" class="thumb thumb-cover">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $facility->name }}</strong>
                                    <div class="text-muted" style="font-size: 13px;">
                                        {{ $facility->images->count() }} foto{{ $facility->major ? ' · '.$facility->major->code : '' }}
                                    </div>
                                </td>
                                <td>
                                    <span class="status {{ $facility->is_tefa ? 'status-off' : 'status-on' }}">
                                        {{ $facility->type->label() }}
                                    </span>
                                </td>
                                <td class="text-muted" style="font-size: 13px;">
                                    {{ collect([
                                        $facility->map_x !== null ? 'Denah' : null,
                                        $facility->show_in_tefa_list ? 'Daftar TEFA' : null,
                                        $facility->is_featured ? 'Grid Unggulan' : null,
                                    ])->filter()->implode(', ') ?: 'Belum tampil' }}
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.facilities.edit', $facility) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.facilities.destroy', $facility) }}"
                                            data-confirm="Hapus fasilitas &quot;{{ $facility->name }}&quot; beserta galerinya?">
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

    {{ $facilities->links('admin.partials.pagination') }}
@endsection
