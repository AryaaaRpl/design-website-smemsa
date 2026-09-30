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

  <!-- Open Graph / WhatsApp Preview Meta Tags -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://smksmuh1gtg.com/" />
  <meta property="og:title" content="SMKS Muhammadiyah 1 Genteng - Good Skill, Good Attitude" />
  <meta property="og:description"
    content="SMK Pusat Keunggulan di Genteng Banyuwangi. Terakreditasi A, LSP-P1 BNSP, Kelas Industri Dudika, dan {{ $majorCountLabel }} Unggulan." />
  <meta property="og:image" content="assets/logo.png" />

  <!-- Structured Data (JSON-LD) for School -->
  <script type="application/ld+json">
      {
        "@@context": "https://schema.org",
        "@@type": "School",
        "name": "SMKS Muhammadiyah 1 Genteng",
        "alternateName": ["SMEMSA", "SMEMSA Genteng"],
        "url": "https://smksmuh1gtg.com",
        "logo": "assets/logo.png",
        "image": "assets/logo.png",
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
    @yield('content')
    @include('partials.footer')
    @include('partials.back-to-top')

  <!-- 14. CHATBOT AI ASISTEN VIRTUAL -->
  <button class="chatbot-btn" id="chatbot-toggle" aria-label="Buka Asisten AI">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-message-circle-more-icon lucide-message-circle-more chatbot-icon-open">
      <path
        d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
      <path d="M8 12h.01" />
      <path d="M12 12h.01" />
      <path d="M16 12h.01" />
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
      stroke-linejoin="round" class="lucide lucide-x chatbot-icon-close">
      <path d="M18 6 6 18" />
      <path d="m6 6 12 12" />
    </svg>
  </button>
  <div class="chat-panel" id="chat-panel" data-lenis-prevent>
    <div class="chat-header">
      <span>Asisten AI SMEMSA</span>
      <span style="
            font-size: 0.75rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
          ">Online</span>
    </div>
    <div class="chat-body" id="chat-body" data-lenis-prevent>
      <div class="chat-msg bot">
        Assalamu'alaikum! Saya asisten AI resmi SMKS Muhammadiyah 1 Genteng.
        Ada yang bisa saya bantu terkait info {{ $navMajors->isNotEmpty() ? $navMajors->count() . ' ' : '' }}jurusan, alur pendaftaran SPMB,
        sertifikasi LSP-P1 BNSP, fasilitas, atau loker BKK?
      </div>
    </div>
    <div class="chat-quick-pills">
      <button class="chat-pill" onclick="sendQuickMsg('Info Jurusan')">
        Info {{ $navMajors->isNotEmpty() ? $navMajors->count() . ' ' : '' }}Jurusan
      </button>
      <button class="chat-pill" onclick="sendQuickMsg('Alur Pendaftaran SPMB')">
        Alur SPMB
      </button>
      <button class="chat-pill" onclick="sendQuickMsg('Info LSP-P1 BNSP')">
        LSP-P1 BNSP
      </button>
      <button class="chat-pill" onclick="sendQuickMsg('Lowongan BKK')">
        Lowongan BKK
      </button>
    </div>
    <div class="chat-input-bar">
      <input type="text" id="chat-input-text" placeholder="Ketik pertanyaan Anda..." />
      <button onclick="handleChatSubmit()">Kirim</button>
    </div>
  </div>

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