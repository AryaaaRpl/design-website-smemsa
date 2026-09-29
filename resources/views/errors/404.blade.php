<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan &bull; SMKS Muhammadiyah 1 Genteng</title>
    <link rel="icon" href="{{ asset('assets/logo.webp') }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#1e40af">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">

    @include('errors.partials.styles')

    <style>
        /* Tambahan khusus halaman 404 */
        .status-badge.is-info {
            color: var(--primary);
        }

        .error-code {
            font-size: clamp(4.5rem, 14vw, 6.5rem);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.05em;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .requested-path {
            display: inline-block;
            max-width: 100%;
            margin: -1rem auto 2rem;
            padding: 0.4rem 0.85rem;
            border-radius: var(--radius-full);
            background: var(--bg);
            border: 1px solid var(--border);
            font-size: 0.8rem;
            color: var(--text-muted);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        a.info-item {
            display: block;
            text-decoration: none;
        }

        a.info-item .info-value::after {
            content: " \2192";
            color: var(--primary);
        }
    </style>
</head>

<body>

    <div class="ambient-glow"></div>

    @include('errors.partials.header')

    <!-- Main Content -->
    <main class="main-wrapper">
        <div class="card">

            <div class="status-badge is-info">
                <span>HALAMAN TIDAK DITEMUKAN</span>
            </div>

            <div class="error-code" aria-hidden="true">404</div>

            <h1 class="headline">Ups, halaman ini tidak tersedia</h1>
            <p class="description">
                Alamat yang Anda buka mungkin salah ketik, sudah dipindahkan, atau tidak pernah ada.
                Silakan kembali ke beranda atau pilih halaman populer di bawah ini.
            </p>

            <div class="requested-path" title="{{ request()->fullUrl() }}">/{{ ltrim(request()->path(), '/') }}</div>

            <!-- Halaman populer -->
            <div class="info-grid">
                <a href="{{ url('/jurusan') }}" class="info-item">
                    <div class="info-label">Program</div>
                    <div class="info-value">Konsentrasi Keahlian</div>
                </a>
                <a href="{{ url('/spmb') }}" class="info-item">
                    <div class="info-label">Pendaftaran</div>
                    <div class="info-value">SPMB</div>
                </a>
                <a href="{{ url('/berita') }}" class="info-item">
                    <div class="info-label">Informasi</div>
                    <div class="info-value">Berita Sekolah</div>
                </a>
            </div>

            <div class="action-row">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 10.5 12 3l9 7.5" />
                        <path d="M5 9.5V21h14V9.5" />
                        <path d="M10 21v-6h4v6" />
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>

                <button type="button" class="btn btn-outline" onclick="goBack()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5" />
                        <path d="m12 19-7-7 7-7" />
                    </svg>
                    <span>Halaman Sebelumnya</span>
                </button>
            </div>

        </div>
    </main>

    @include('errors.partials.footer')

    <script>
        // Kembali ke halaman sebelumnya di tab ini (juga saat URL diketik manual, yang tidak punya referrer).
        // Hanya jika tab baru dibuka langsung ke halaman ini (tanpa riwayat), arahkan ke beranda.
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = @json(url('/'));
            }
        }
    </script>
</body>

</html>
