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

    <div class="card visitor-card">
        <div class="card-header visitor-card-header">
            <span>Pengunjung Website</span>
            <small>Dihitung 1 kali per pengunjung per hari (WIB)</small>
        </div>

        <div class="visitor-summary">
            @foreach (['today' => 'Hari Ini', 'month' => 'Bulan Ini', 'year' => 'Tahun Ini', 'total' => 'Total'] as $key => $label)
                <div class="visitor-summary-item {{ $key === 'today' ? 'is-today' : '' }}">
                    <span>{{ $label }}</span>
                    <strong>{{ number_format($visitors[$key], 0, ',', '.') }}</strong>
                </div>
            @endforeach
        </div>

        {{-- Pilihan rentang tanpa JavaScript: radio + CSS --}}
        <div class="visitor-tabs">
            <input type="radio" name="visitor-range" id="visitor-range-daily" checked>
            <label for="visitor-range-daily">30 Hari Terakhir</label>
            <input type="radio" name="visitor-range" id="visitor-range-monthly">
            <label for="visitor-range-monthly">12 Bulan Terakhir</label>

            <div class="visitor-panel visitor-panel-daily">
                @include('admin.partials.visitor-chart', ['points' => $dailyVisitors, 'caption' => 'Grafik pengunjung 30 hari terakhir'])
            </div>
            <div class="visitor-panel visitor-panel-monthly">
                @include('admin.partials.visitor-chart', ['points' => $monthlyVisitors, 'caption' => 'Grafik pengunjung 12 bulan terakhir'])
            </div>
        </div>
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
