@php
    $menus = [
        ['label' => 'Beranda', 'route' => 'pendaftar.dashboard', 'icon' => '<path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/>'],
        ['label' => 'Pendaftaran', 'route' => 'pendaftar.registration', 'icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M9 15h6"/><path d="M9 11h2"/>'],
        ['label' => 'Pengumuman', 'route' => 'pendaftar.announcement', 'icon' => '<path d="M3 11v2a1 1 0 0 0 1 1h2l5 4V6L6 10H4a1 1 0 0 0-1 1z"/><path d="M15.5 8.5a5 5 0 0 1 0 7"/><path d="M18.5 5.5a9 9 0 0 1 0 13"/>'],
        ['label' => 'Bantuan', 'route' => 'pendaftar.help', 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M9.1 9a3 3 0 0 1 5.8 1c0 2-3 3-3 3"/><path d="M12 17h.01"/>'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title') | SPMB SMEMSA</title>
    <link rel="icon" href="{{ asset('assets/logo.webp') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body>
    <aside class="admin-sidebar" id="admin-sidebar">
        <a href="{{ route('pendaftar.dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('assets/logo.webp') }}" alt="Logo SMEMSA">
            <div>
                <strong>SMEMSA</strong>
                <span>SPMB Online</span>
            </div>
        </a>

        <nav class="admin-navbar">
            @foreach ($menus as $menu)
                <a href="{{ route($menu['route']) }}" class="sidebar-link {{ request()->routeIs($menu['route']) ? 'active' : '' }}">
                    <span class="sidebar-link-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $menu['icon'] !!}</svg>
                        {{ $menu['label'] }}
                    </span>
                </a>
            @endforeach
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('pendaftar.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline btn-block">Keluar</button>
            </form>
        </div>
    </aside>
    <div class="sidebar-backdrop" id="sidebar-backdrop"></div>

    <div class="admin-main">
        <nav class="admin-topbar">
            <div style="display: flex; align-items: center; gap: 12px;">
                <button type="button" class="sidebar-toggle" id="sidebar-toggle" aria-label="Buka menu">&#9776;</button>
                <span class="topbar-title">@yield('title')</span>
            </div>
            @if (request()->routeIs('pendaftar.dashboard'))
                <div class="topbar-user">Halo, <strong>{{ $registration->name }}</strong></div>
            @else
                <div class="topbar-user spmb-topbar-info">
                    <span>No. Pendaftaran <strong>{{ $registration->registration_number }}</strong></span>
                    <span>Sekolah Terdaftar <strong>SMK Muhammadiyah 1 Genteng</strong></span>
                </div>
            @endif
        </nav>

        <main class="admin-content">
            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
