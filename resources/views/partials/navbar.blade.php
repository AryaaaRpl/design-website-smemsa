  <header class="header-wrapper">
    <nav class="nav-island" id="main-nav">
      <a href="{{ url('/') }}" class="brand-box">
        <img src="{{ request()->is('lsp*') ? asset('assets/LSP.png') : (request()->is('bkk*') ? asset('assets/bkk.png') : asset('assets/logo.png')) }}" alt="{{ request()->is('lsp*') ? 'Logo LSP SMKS Muhammadiyah 1 Genteng' : (request()->is('bkk*') ? 'Logo BKK SMKS Muhammadiyah 1 Genteng' : 'Logo SMKS Muhammadiyah 1 Genteng') }}" class="brand-logo" onerror="
              this.closest('.card')
                ? this.closest('.card').classList.add('no-image')
                : null;
              this.remove();
            " />
      </a>

      <div class="nav-menu">
        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>

        <!-- Profil & Info Dropdown -->
        <div class="nav-item">
          <a href="{{ url('/visi-misi') }}" class="nav-link {{ request()->is('visi-misi*', 'guru*', 'fasilitas*', 'ekstrakurikuler*', 'prestasi*') ? 'active' : '' }}">
            Profil & Info <span style="font-size: 0.65rem">▼</span>
          </a>
          <div class="dropdown-menu">
            <a href="{{ url('/visi-misi') }}" class="dropdown-item {{ request()->is('visi-misi*') ? 'active' : '' }}">
              <span class="dropdown-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10" />
                  <circle cx="12" cy="12" r="6" />
                  <circle cx="12" cy="12" r="2" />
                </svg>
              </span>
              <div>
                <div>Visi & Misi</div>
                <small style="color: var(--text-subtle); font-size: 0.75rem">Arah & Tujuan Lembaga</small>
              </div>
            </a>
            <a href="{{ url('/guru') }}" class="dropdown-item {{ request()->is('guru*') ? 'active' : '' }}">
              <span class="dropdown-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                  <circle cx="9" cy="7" r="4" />
                  <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                  <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
              </span>
              <div>
                <div>Guru & Tendik</div>
                <small style="color: var(--text-subtle); font-size: 0.75rem">Tenaga Pendidik</small>
              </div>
            </a>
            <a href="{{ url('/fasilitas') }}" class="dropdown-item {{ request()->is('fasilitas*') ? 'active' : '' }}">
              <span class="dropdown-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z" />
                  <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2" />
                  <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2" />
                  <path d="M10 6h4" />
                  <path d="M10 10h4" />
                  <path d="M10 14h4" />
                  <path d="M10 18h4" />
                </svg>
              </span>
              <div>
                <div>Fasilitas Sekolah</div>
                <small style="color: var(--text-subtle); font-size: 0.75rem">Laboratorium & Ruang Belajar</small>
              </div>
            </a>
            <a href="{{ url('/ekstrakurikuler') }}" class="dropdown-item {{ request()->is('ekstrakurikuler*') ? 'active' : '' }}">
              <span class="dropdown-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path
                    d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2" />
                </svg>
              </span>
              <div>
                <div>Ekstrakurikuler & IPM</div>
                <small style="color: var(--text-subtle); font-size: 0.75rem">Bakat, Seni & Karakter</small>
              </div>
            </a>
            <a href="{{ url('/prestasi') }}" class="dropdown-item {{ request()->is('prestasi*') ? 'active' : '' }}">
              <span class="dropdown-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6" />
                  <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18" />
                  <path d="M4 22h16" />
                  <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22" />
                  <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22" />
                  <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z" />
                </svg>
              </span>
              <div>
                <div>Galeri Prestasi</div>
                <small style="color: var(--text-subtle); font-size: 0.75rem">Piala & Penghargaan Nasional</small>
              </div>
            </a>
          </div>
        </div>

        <a href="{{ url('/jurusan') }}" class="nav-link {{ request()->is('jurusan*') ? 'active' : '' }}">Konsentrasi Keahlian</a>

        <a href="{{ url('/lsp') }}" class="nav-link {{ request()->is('lsp*') ? 'active' : '' }}">LSP</a>

        <a href="{{ url('/bkk') }}" class="nav-link {{ request()->is('bkk*') ? 'active' : '' }}">BKK</a>

        <!-- Layanan Siswa (BLUD) -->
        <a href="{{ route('blud.index') }}" class="nav-link {{ request()->is('blud*') ? 'active' : '' }}">BLUD</a>

        <a href="{{ url('/berita') }}" class="nav-link {{ request()->is('berita*') ? 'active' : '' }}">Berita</a>
        <a href="{{ url('/spmb') }}" class="btn btn-primary {{ request()->is('spmb*') ? 'active' : '' }}" style="padding: 0.55rem 1.4rem; font-size: 0.88rem">Daftar SPMB</a>
      </div>

      <a href="{{ url('/spmb') }}" class="btn btn-primary nav-mobile-cta" style="display: none">Daftar SPMB</a>
      <button class="hamburger" id="hamburger-btn" aria-label="Buka Menu Navigasi">
        ☰
      </button>
    </nav>
  </header>

  <!-- Mobile Drawer -->
  <div class="mobile-overlay" id="mobile-overlay"></div>
  <div class="mobile-drawer" id="mobile-drawer">
    <button class="drawer-close" id="drawer-close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
        <path d="M18 6 6 18" />
        <path d="m6 6 12 12" />
      </svg></button>
    <div class="brand-box" style="margin-bottom: 2rem">
      <img src="{{ request()->is('lsp*') ? asset('assets/LSP.png') : (request()->is('bkk*') ? asset('assets/bkk.png') : asset('assets/logo.webp')) }}" alt="{{ request()->is('lsp*') ? 'Logo LSP SMEMSA' : (request()->is('bkk*') ? 'Logo BKK SMEMSA' : 'Logo SMEMSA') }}" class="brand-logo" onerror="
            this.closest('.card')
              ? this.closest('.card').classList.add('no-image')
              : null;
            this.remove();
          " />
      <div>
        <strong style="color: var(--primary); font-size: 1.1rem; display: block">SMEMSA GENTENG</strong>
        <small style="color: var(--text-muted); font-size: 0.75rem">NPSN {{ $site->get('npsn') }} &bull; Akreditasi {{ $site->get('accreditation') }}</small>
      </div>
    </div>

    <div class="drawer-links">
      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>

      <div class="drawer-section-title">Halaman Informasi</div>
      <a href="{{ url('/bkk') }}" class="{{ request()->is('bkk*') ? 'active' : '' }}">Bursa Kerja Khusus (BKK)</a>
      <a href="{{ url('/visi-misi') }}" class="{{ request()->is('visi-misi*') ? 'active' : '' }}">Visi & Misi Sekolah</a>
      <a href="{{ url('/guru') }}" class="{{ request()->is('guru*') ? 'active' : '' }}">Guru & Tenaga Kependidikan</a>
      <a href="{{ url('/fasilitas') }}" class="{{ request()->is('fasilitas*') ? 'active' : '' }}">Fasilitas Unggulan</a>
      <a href="{{ url('/ekstrakurikuler') }}" class="{{ request()->is('ekstrakurikuler*') ? 'active' : '' }}">Ekstrakurikuler & IPM</a>
      <a href="{{ url('/prestasi') }}" class="{{ request()->is('prestasi*') ? 'active' : '' }}">Prestasi & Penghargaan</a>
      <a href="{{ url('/berita') }}" class="{{ request()->is('berita*') ? 'active' : '' }}">Jurnal & Kabar Sekolah</a>

      <div class="drawer-section-title">Navigasi Halaman Utama</div>
      <a href="{{ url('/#sambutan') }}">👤 Sambutan Kepala Sekolah</a>
      <a href="{{ url('/jurusan') }}" class="{{ request()->is('jurusan*') ? 'active' : '' }}">💻 {{ trim(($navMajors->count() ?: '') . ' Program Keahlian') }}</a>
      <a href="{{ url('/lsp') }}" class="{{ request()->is('lsp*') ? 'active' : '' }}">📜 LSP-P1</a>
      <a href="{{ route('blud.index') }}" class="{{ request()->is('blud*') ? 'active' : '' }}">🏬 Unit Produksi BLUD</a>

      <div style="margin-top: 1.5rem">
        <a href="{{ url('/spmb') }}" class="btn btn-primary"
          style="width: 100%; text-align: center; justify-content: center">Daftar SPMB {{ $site->spmbYear() }}</a>
      </div>
    </div>
  </div>