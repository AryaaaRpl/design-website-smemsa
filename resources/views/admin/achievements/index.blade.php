@extends('admin.layouts.app')

@section('title', 'Prestasi')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Prestasi</h1>
            <p>Katalog prestasi yang tampil di halaman prestasi.</p>
        </div>
        <a href="{{ route('admin.achievements.create') }}" class="btn btn-primary">+ Tambah Prestasi</a>
    </div>

    <div class="toolbar">
        <div class="filter-tabs">
            <a href="{{ route('admin.achievements.index', ['search' => $search ?: null]) }}"
                class="filter-tab {{ $activeCategory ? '' : 'active' }}">Semua</a>
            @foreach ($categories as $category)
                <a href="{{ route('admin.achievements.index', ['category' => $category->slug, 'search' => $search ?: null]) }}"
                    class="filter-tab {{ $activeCategory?->is($category) ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.achievements.index') }}" class="search-form">
            @if ($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory->slug }}">
            @endif
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari judul prestasi...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($achievements->isEmpty())
            <div class="empty-state">
                {{ $search ? 'Tidak ada prestasi yang cocok dengan pencarian.' : 'Belum ada prestasi.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tingkat</th>
                            <th>Waktu</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($achievements as $achievement)
                            <tr>
                                <td>
                                    @if ($achievement->image_url)
                                        <img src="{{ $achievement->image_url }}" alt="" class="thumb thumb-cover">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $achievement->title }}</strong>
                                    @if ($achievement->is_featured)
                                        <span class="badge-soon">Unggulan</span>
                                    @endif
                                </td>
                                <td>{{ $achievement->category?->name ?? '-' }}</td>
                                <td>
                                    <span class="status {{ $achievement->level === \App\Enums\AchievementLevel::National || $achievement->level === \App\Enums\AchievementLevel::International ? 'status-on' : 'status-off' }}">
                                        {{ $achievement->level?->label() }}
                                    </span>
                                </td>
                                <td>{{ $achievement->achieved_label ?? '-' }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.achievements.edit', $achievement) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.achievements.destroy', $achievement) }}"
                                            data-confirm="Hapus prestasi &quot;{{ $achievement->title }}&quot;?">
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

    {{ $achievements->links('admin.partials.pagination') }}
@endsection
