@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h1>Halo, {{ auth()->user()->name }}</h1>
        <p>Ringkasan konten website SMKS Muhammadiyah 1 Genteng.</p>
    </div>

    <div class="stat-grid">
        @foreach ($stats as $stat)
            <div class="stat-card">
                <span>{{ $stat['label'] }}</span>
                <strong>{{ $stat['value'] }}</strong>
            </div>
        @endforeach
    </div>

    <div class="card">
        <div class="card-header">Berita Terbaru</div>

        @if ($latestPosts->isEmpty())
            <div class="empty-state">Belum ada berita.</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestPosts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->status->label() }}</td>
                            <td>{{ $post->created_at->translatedFormat('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
