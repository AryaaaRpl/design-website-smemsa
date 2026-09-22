<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title') | Admin SMEMSA</title>
    <link rel="icon" href="{{ asset('assets/logo.webp') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body>
    @include('admin.partials.sidebar')
    <div class="sidebar-backdrop" id="sidebar-backdrop"></div>

    <div class="admin-main">
        <header class="admin-topbar">
            <div style="display: flex; align-items: center; gap: 12px;">
                <button type="button" class="sidebar-toggle" id="sidebar-toggle" aria-label="Buka menu">&#9776;</button>
                <span class="topbar-title">@yield('title')</span>
            </div>
            <div class="topbar-user">
                Masuk sebagai <strong>{{ auth()->user()->name }}</strong>
            </div>
        </header>

        <main class="admin-content">
            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
