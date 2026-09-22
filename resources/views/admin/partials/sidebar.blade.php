@php
    // Menu modul yang akan dikerjakan pada tahap berikutnya.
    $upcomingMenus = [
        'Master Data' => ['Jurusan', 'Kategori'],
        'Konten' => ['Berita', 'Prestasi', 'Guru & Staf', 'Fasilitas', 'Ekstrakurikuler', 'Testimoni'],
        'BKK' => ['Mitra Industri', 'Lowongan Kerja'],
        'Sistem' => ['Pengaturan'],
    ];
@endphp

<aside class="admin-sidebar" id="admin-sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <img src="{{ asset('assets/logo.webp') }}" alt="Logo SMEMSA">
        <div>
            <strong>SMEMSA</strong>
            <span>Panel Admin</span>
        </div>
    </a>

    <nav class="admin-navbar" style="overflow-y: auto;">
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        @foreach ($upcomingMenus as $group => $menus)
            <div class="sidebar-title">{{ $group }}</div>
            @foreach ($menus as $menu)
                <span class="sidebar-link disabled">
                    {{ $menu }}
                    <span class="badge-soon">Segera</span>
                </span>
            @endforeach
        @endforeach
    </nav>

    <div class="sidebar-footer">
        <a href="{{ url('/') }}" target="_blank" class="sidebar-link">Lihat Website</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline btn-block" style="margin-top: 8px;">Keluar</button>
        </form>
    </div>
</aside>
