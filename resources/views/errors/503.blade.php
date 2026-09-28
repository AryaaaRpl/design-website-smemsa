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

    <style>
        :root {
            --primary: #1e40af;
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            --primary-surface: rgba(30, 64, 175, 0.06);
            --navy-dark: #0f172a;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg: #f8fafc;
            --surface: #ffffff;
            --border: #e2e8f0;
            --warning: #f59e0b;
            --warning-surface: #fffbeb;
            --warning-border: #fef3c7;
            --radius-xl: 24px;
            --radius-lg: 16px;
            --radius-full: 9999px;
            --shadow-card: 0 20px 40px -15px rgba(15, 23, 42, 0.08), 0 0 1px 1px rgba(15, 23, 42, 0.03);
            --shadow-glow: 0 0 50px -10px rgba(37, 99, 235, 0.25);
            --font-main: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow-x: hidden;
            background-image:
                radial-gradient(at 100% 0%, rgba(30, 64, 175, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(37, 99, 235, 0.05) 0px, transparent 50%);
        }

        /* Subtle ambient glow circles */
        .ambient-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, rgba(37, 99, 235, 0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 0;
        }

        /* Top Bar / Header */
        .header {
            position: relative;
            z-index: 10;
            padding: 1.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
            color: var(--text-dark);
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }

        .brand-info {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .brand-title {
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--navy-dark);
            line-height: 1.2;
        }

        .brand-subtitle {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Main Container */
        .main-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 680px;
            margin: 0 auto;
            padding: 1.5rem 1.5rem 2.5rem;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 3rem 2.5rem;
            box-shadow: var(--shadow-card);
            text-align: center;
            position: relative;
            backdrop-filter: blur(8px);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            color: #b45309;
            padding: 0.45rem 1rem;
            border-radius: var(--radius-full);
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            margin-bottom: 1.75rem;
        }

        .pulse-dot {
            width: 9px;
            height: 9px;
            background-color: var(--warning);
            border-radius: 50%;
            position: relative;
        }

        .pulse-dot::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background-color: var(--warning);
            opacity: 0.5;
            animation: pulse 1.8s cubic-bezier(0.24, 0, 0.38, 1) infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.9);
                opacity: 0.8;
            }

            70% {
                transform: scale(2.2);
                opacity: 0;
            }

            100% {
                transform: scale(2.2);
                opacity: 0;
            }
        }

        /* Icon Container */
        .illustration-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.08) 0%, rgba(37, 99, 235, 0.15) 100%);
            border: 1px solid rgba(30, 64, 175, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .illustration-icon svg {
            width: 38px;
            height: 38px;
            stroke-width: 1.75;
        }

        .headline {
            font-size: clamp(1.5rem, 3.5vw, 1.95rem);
            font-weight: 800;
            color: var(--navy-dark);
            line-height: 1.3;
            letter-spacing: -0.03em;
            margin-bottom: 0.85rem;
        }

        .description {
            font-size: 0.98rem;
            color: var(--text-muted);
            line-height: 1.65;
            max-width: 520px;
            margin: 0 auto 2rem;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.85rem;
            margin-bottom: 2.25rem;
            text-align: left;
        }

        .info-item {
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 0.95rem 1rem;
            border-radius: var(--radius-lg);
            transition: border-color 0.2s ease;
        }

        .info-item:hover {
            border-color: rgba(30, 64, 175, 0.25);
        }

        .info-label {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--navy-dark);
        }

        /* Button Row */
        .action-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.85rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            padding: 0.78rem 1.45rem;
            border-radius: var(--radius-full);
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            border: 1px solid transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(30, 64, 175, 0.25);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.35);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .btn-outline {
            background: #ffffff;
            color: var(--text-dark);
            border-color: var(--border);
        }

        .btn-outline:hover {
            background: var(--bg);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        .btn svg {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }

        /* Footer */
        .footer {
            position: relative;
            z-index: 10;
            padding: 1.5rem 2rem;
            text-align: center;
            font-size: 0.82rem;
            color: var(--text-muted);
            border-top: 1px solid rgba(226, 232, 240, 0.6);
        }

        .footer-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .header {
                padding: 1.25rem 1rem;
            }

            .card {
                padding: 2rem 1.25rem;
                border-radius: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 0.6rem;
            }

            .action-row {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="ambient-glow"></div>

    <!-- Header / Brand -->
    <header class="header">
        <div class="brand-link">
            <img src="{{ asset('assets/logo.webp') }}" alt="Logo SMEMSA" class="brand-logo"
                onerror="this.src='{{ asset('assets/logo.png') }}'">
            <div class="brand-info">
                <span class="brand-title">SMKS Muhammadiyah 1 Genteng</span>
                <span class="brand-subtitle">SMK Pusat Keunggulan</span>
            </div>
        </div>
    </header>

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

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-note">
            <span>&copy; {{ date('Y') }} SMKS Muhammadiyah 1 Genteng.</span>
            <span>Semua hak cipta dilindungi.</span>
        </div>
    </footer>

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
