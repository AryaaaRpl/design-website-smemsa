@php
    // Menu modul. Isi 'route' jika modul sudah selesai, null = belum tersedia.
    $menuGroups = [
        'Master Data' => [
            ['label' => 'Jurusan', 'route' => 'admin.majors.index', 'active' => 'admin.majors.*'],
            ['label' => 'Kategori', 'route' => 'admin.categories.index', 'active' => 'admin.categories.*'],
        ],
        'Konten' => [
            ['label' => 'Berita', 'route' => 'admin.posts.index', 'active' => 'admin.posts.*'],
            ['label' => 'Prestasi', 'route' => null],
            ['label' => 'Guru & Staf', 'route' => null],
            ['label' => 'Fasilitas', 'route' => null],
            ['label' => 'Ekstrakurikuler', 'route' => null],
            ['label' => 'Testimoni', 'route' => null],
        ],
        'BKK' => [
            ['label' => 'Mitra Industri', 'route' => null],
            ['label' => 'Lowongan Kerja', 'route' => null],
        ],
        'Sistem' => [
            ['label' => 'Pengaturan', 'route' => null],
        ],
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

        @foreach ($menuGroups as $group => $menus)
            <div class="sidebar-title">{{ $group }}</div>
            @foreach ($menus as $menu)
                @if ($menu['route'])
                    <a href="{{ route($menu['route']) }}"
                        class="sidebar-link {{ request()->routeIs($menu['active']) ? 'active' : '' }}">
                        {{ $menu['label'] }}
                    </a>
                @else
                    <span class="sidebar-link disabled">
                        {{ $menu['label'] }}
                        <span class="badge-soon">Segera</span>
                    </span>
                @endif
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
