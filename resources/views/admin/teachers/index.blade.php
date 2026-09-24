@extends('admin.layouts.app')

@section('title', 'Guru & Staf')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Guru & Staf</h1>
            <p>Data pimpinan, guru, dan staff karyawan di halaman guru.</p>
        </div>
        <a href="{{ route('admin.teachers.create', ['category' => $activeCategory?->value]) }}" class="btn btn-primary">+ Tambah Data</a>
    </div>

    <div class="toolbar">
        <div class="filter-tabs">
            <a href="{{ route('admin.teachers.index', ['search' => $search ?: null]) }}"
                class="filter-tab {{ $activeCategory ? '' : 'active' }}">Semua ({{ $counts->sum() }})</a>
            @foreach ($categories as $category)
                <a href="{{ route('admin.teachers.index', ['category' => $category->value, 'search' => $search ?: null]) }}"
                    class="filter-tab {{ $activeCategory === $category ? 'active' : '' }}">
                    {{ $category->label() }} ({{ $counts[$category->value] ?? 0 }})
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.teachers.index') }}" class="search-form">
            @if ($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory->value }}">
            @endif
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari nama atau jabatan...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($teachers->isEmpty())
            <div class="empty-state">
                {{ $search ? 'Tidak ada data yang cocok dengan pencarian.' : 'Belum ada data di kategori ini.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->sort_order }}</td>
                                <td>
                                    @if ($teacher->photo_url)
                                        <img src="{{ $teacher->photo_url }}" alt="" class="thumb thumb-cover">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $teacher->name }}</strong>
                                    <div class="text-muted" style="font-size: 13px;">
                                        {{ $teacher->position }}{{ $teacher->major ? ' · '.$teacher->major->code : '' }}
                                    </div>
                                </td>
                                <td>{{ $teacher->category->label() }}</td>
                                <td>
                                    <span class="status {{ $teacher->is_active ? 'status-on' : 'status-off' }}">
                                        {{ $teacher->is_active ? 'Tampil' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}"
                                            data-confirm="Hapus data &quot;{{ $teacher->name }}&quot;?">
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

    {{ $teachers->links('admin.partials.pagination') }}
@endsection
