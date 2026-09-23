@extends('admin.layouts.app')

@section('title', 'Berita')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Berita</h1>
            <p>Berita yang terbit tampil di beranda dan halaman berita.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">+ Tulis Berita</a>
    </div>

    <div class="toolbar">
        <div class="filter-tabs">
            <a href="{{ route('admin.posts.index', ['search' => $search ?: null]) }}"
                class="filter-tab {{ $activeStatus ? '' : 'active' }}">Semua</a>
            @foreach ($statuses as $status)
                <a href="{{ route('admin.posts.index', ['status' => $status->value, 'search' => $search ?: null]) }}"
                    class="filter-tab {{ $activeStatus === $status ? 'active' : '' }}">
                    {{ $status->label() }}
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.posts.index') }}" class="search-form">
            @if ($activeStatus)
                <input type="hidden" name="status" value="{{ $activeStatus->value }}">
            @endif
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari judul berita...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($posts->isEmpty())
            <div class="empty-state">
                {{ $search ? 'Tidak ada berita yang cocok dengan pencarian.' : 'Belum ada berita.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal Terbit</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    @if ($post->thumbnail_url)
                                        <img src="{{ $post->thumbnail_url }}" alt="" class="thumb thumb-cover">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $post->title }}</strong>
                                    @if ($post->is_featured)
                                        <span class="badge-soon">Headline</span>
                                    @endif
                                </td>
                                <td>{{ $post->category?->name ?? '-' }}</td>
                                <td>
                                    <span class="status {{ $post->status === \App\Enums\PostStatus::Published ? 'status-on' : 'status-off' }}">
                                        {{ $post->status->label() }}
                                    </span>
                                </td>
                                <td>{{ $post->published_date ?? '-' }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                            data-confirm="Hapus berita &quot;{{ $post->title }}&quot;?">
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

    {{ $posts->links('admin.partials.pagination') }}
@endsection
