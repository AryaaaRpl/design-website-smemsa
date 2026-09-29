@php
    $whatsappUrl = isset($site) && is_object($site) ? $site->whatsappLink('spmb') : 'https://wa.me/6281336181180';
    $phone = isset($site) && is_object($site) ? $site->get('phone', '(0333) 845258') : '(0333) 845258';
    $email = isset($site) && is_object($site) ? $site->get('email', 'smksmuh1gtg@gmail.com') : 'smksmuh1gtg@gmail.com';
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Sedang Dalam Pemeliharaan &bull; SMKS Muhammadiyah 1 Genteng</title>
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
</head>

<body>

    <div class="ambient-glow"></div>

    @include('errors.partials.header')

    <!-- Main Content -->
    <main class="main-wrapper">
        <div class="card">

            <!-- Status Indicator -->
            <div class="status-badge">
                <span>PEMELIHARAAN SISTEM TERJADWAL</span>
            </div>

            <!-- Maintenance Icon -->
            <div class="illustration-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-settings preview-icon">
                    <path
                        d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
            </div>

            <!-- Title & Message -->
            <h1 class="headline">Website Sedang Ditingkatkan</h1>
            <p class="description">
                Layanan web resmi SMEMSA saat ini sedang dalam proses pemeliharaan berkala untuk peningkatan performa,
                pembaruan data, dan keamanan sistem. Mohon maaf atas ketidaknyamanan ini.
            </p>

            <!-- Key Info Grid -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Status</div>
                    <div class="info-value" style="color: #b45309;">Maintenance</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Layanan SPMB</div>
                    <div class="info-value">Tetap Buka Offline</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Bantuan CS</div>
                    <div class="info-value">WhatsApp Aktif</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-row">
                <button type="button" class="btn btn-primary" onclick="handleRefresh(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                        <path d="M3 3v5h5" />
                        <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                        <path d="M16 21h5v-5" />
                    </svg>
                    <span id="btn-refresh-text">Coba Muat Ulang</span>
                </button>

                @if ($whatsappUrl)
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                        <span>Hubungi CS Sekolah</span>
                    </a>
                @endif
            </div>

        </div>
    </main>

    @include('errors.partials.footer')

    <script>
        function handleRefresh(button) {
            const span = document.getElementById('btn-refresh-text');
            if (span) span.textContent = 'Memeriksa...';
            button.style.opacity = '0.7';
            button.style.pointerEvents = 'none';
            setTimeout(() => {
                window.location.reload();
            }, 600);
        }
    </script>
</body>

</html>
