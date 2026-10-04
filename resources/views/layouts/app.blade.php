<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script>document.documentElement.classList.add('js')</script>
  <title>
    SMKS Muhammadiyah 1 Genteng - Pusat Keunggulan Vokasi & Karakter Islami
  </title>
  <link rel="icon" href="{{ asset('assets/logo.webp') }}">
  <meta name="description"
    content="Website Resmi SMKS Muhammadiyah 1 Genteng (SMEMSA / SMEMSA Genteng) Banyuwangi. SMK Pusat Keunggulan, Akreditasi A BAN-S/M, Berlisensi LSP-P1 BNSP, dengan {{ $majorCountLabel }} Industri." />

  <!-- Open Graph / WhatsApp Preview Meta Tags: link yang dibagikan menampilkan logo, judul & deskripsi.
       URL gambar harus absolut (memakai APP_URL), jadi di server APP_URL wajib https://smksmuh1gtg.my.id -->
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="SMKS Muhammadiyah 1 Genteng" />
  <meta property="og:locale" content="id_ID" />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta property="og:title" content="SMKS Muhammadiyah 1 Genteng - Good Skill, Good Attitude" />
  <meta property="og:description"
    content="SMK Pusat Keunggulan di Genteng Banyuwangi. Terakreditasi A, LSP-P1 BNSP, Kelas Industri Dudika, dan {{ $majorCountLabel }} Unggulan." />
  <meta property="og:image" content="{{ asset('assets/logo.webp') }}" />
  <meta property="og:image:secure_url" content="{{ asset('assets/logo.webp') }}" />
  <meta property="og:image:type" content="image/webp" />
  <meta property="og:image:width" content="173" />
  <meta property="og:image:height" content="156" />
  <meta property="og:image:alt" content="Logo SMKS Muhammadiyah 1 Genteng" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="SMKS Muhammadiyah 1 Genteng - Good Skill, Good Attitude" />
  <meta name="twitter:image" content="{{ asset('assets/logo.webp') }}" />

  <!-- Structured Data (JSON-LD) for School -->
  <script type="application/ld+json">
      {
        "@@context": "https://schema.org",
        "@@type": "School",
        "name": "SMKS Muhammadiyah 1 Genteng",
        "alternateName": ["SMEMSA", "SMEMSA Genteng"],
        "url": "https://smksmuh1gtg.my.id",
        "logo": "{{ asset('assets/logo.webp') }}",
        "image": "{{ asset('assets/logo.webp') }}",
        "description": "Sekolah Menengah Kejuruan Pusat Keunggulan di Genteng Banyuwangi dengan {{ $majorCountLabel }} Industri dan Lisensi LSP-P1 BNSP.",
        "address": {
          "@@type": "PostalAddress",
          "streetAddress": "{{ $site->get('address') }}",
          "addressLocality": "Genteng, Banyuwangi",
          "addressRegion": "Jawa Timur",
          "postalCode": "68465",
          "addressCountry": "ID"
        },
        "telephone": "{{ $site->phoneInternational() }}",
        "email": "{{ $site->get('email') }}"
      }
    </script>

  <!-- Typography: Plus Jakarta Sans di-host sendiri (lihat partials/fonts).
       Subset latin (huruf yang dipakai hampir semua teks) diunduh paling awal. -->
  <link rel="preload" href="{{ asset('fonts/plus-jakarta-sans/LDIoaomQNQcsA88c7O9yZ4KMCoOg4Ko20yw.woff2') }}"
    as="font" type="font/woff2" crossorigin />
  @include('partials.fonts')

  <!-- Library animasi & script bersama (di-host sendiri). defer: diunduh paralel tanpa menahan
       tampilan, lalu dijalankan berurutan setelah HTML selesai dibaca, SEBELUM script halaman (Vite). -->
  <script defer src="{{ asset('vendor/gsap-3.12.5.min.js') }}"></script>
  <script defer src="{{ asset('vendor/ScrollTrigger-3.12.5.min.js') }}"></script>
  <script defer src="{{ asset('vendor/lenis-1.1.20.min.js') }}"></script>
  <script defer src="{{ asset('js/site.js') }}?v={{ filemtime(public_path('js/site.js')) }}"></script>

    @php
    $path = trim(request()->path(), '/');
    if (empty($path) || $path === '/') {
        $pageName = 'index';
    } else {
        // Segmen pertama URL: /jurusan & /jurusan/rpl sama-sama memakai jurusan.css
        $pageName = explode('/', $path)[0];
    }

    $pageAssets = ['resources/css/app.css'];

    if (file_exists(resource_path('css/pages/' . $pageName . '.css'))) {
        $pageAssets[] = 'resources/css/pages/' . $pageName . '.css';
    } else {
        $pageAssets[] = 'resources/css/pages/index.css';
    }

    $pageAssets[] = 'resources/js/app.js';

    if (file_exists(resource_path('js/pages/' . $pageName . '.js'))) {
        $pageAssets[] = 'resources/js/pages/' . $pageName . '.js';
    }
  @endphp

  @vite($pageAssets)
  @stack('styles')
</head>

<body>
  <!-- 0. PAGE PRELOADER ANIMATION -->
  @include('partials.loader')

  <!-- 1. FLOATING ISLAND NAVBAR WITH GLASSMORPHISM 2.0 -->
    @include('partials.navbar')
    <main id="konten">
    @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.back-to-top')

  <!-- 14. CHATBOT AI ASISTEN SMEMSA -->
  @include('partials.chat-widget')

  <!-- Data dari server untuk public/js/site.js (navbar, beranda, chatbot) -->
  <script>
    window.SITE_DATA = {{ Js::from([
      'majors' => $majorsData ?? [],
      'chatMajors' => $navMajors->map(fn ($m) => ['code' => $m->code, 'name' => $m->name])->values(),
      'chatVacancies' => $chatVacancies->map(fn ($v) => [
        'position' => $v->position,
        'company' => $v->partner?->name,
        'location' => $v->location,
        'type' => $v->employment_type->label(),
      ])->values(),
      'spmbWhatsapp' => $site->whatsappDisplay('spmb'),
      'spmbAcademicYear' => $site->get('spmb_academic_year'),
      'address' => $site->get('address'),
      'principalAnswer' => 'Kepala Sekolah SMKS Muhammadiyah 1 Genteng adalah Bapak '.($principal?->name ?: 'Wahid Wahyudi, S.E., M.M.').'.',
    ]) }};
  </script>
  @stack('scripts')
</body>

</html>