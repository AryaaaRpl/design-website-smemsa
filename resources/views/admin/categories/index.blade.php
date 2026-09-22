@extends('admin.layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Kategori</h1>
            <p>Kategori untuk berita dan prestasi.</p>
        </div>
        <a href="{{ route('admin.categories.create', ['type' => $activeType?->value]) }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    <div class="filter-tabs">
        <a href="{{ route('admin.categories.index') }}" class="filter-tab {{ $activeType ? '' : 'active' }}">Semua</a>
        @foreach ($types as $type)
            <a href="{{ route('admin.categories.index', ['type' => $type->value]) }}"
                class="filter-tab {{ $activeType === $type ? 'active' : '' }}">
                {{ $type->label() }}
            </a>
        @endforeach
    </div>

    <div class="card">
        @if ($categories->isEmpty())
            <div class="empty-state">Belum ada kategori.</div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Tipe</th>
                            <th>Dipakai</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            @php($usage = $category->posts_count + $category->achievements_count)
                            <tr>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td class="text-muted">{{ $category->slug }}</td>
                                <td>
                                    <span class="status {{ $category->type === \App\Enums\CategoryType::Post ? 'status-on' : 'status-off' }}">
                                        {{ $category->type->label() }}
                                    </span>
                                </td>
                                <td>{{ $usage }} data</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                            data-confirm="Hapus kategori {{ $category->name }}?{{ $usage ? ' '.$usage.' data terkait akan menjadi tanpa kategori.' : '' }}">
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
@endsection
