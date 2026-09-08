  <header class="header-wrapper">
    <nav class="nav-island" id="main-nav">
      <a href="#hero" class="brand-box">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo SMKS Muhammadiyah 1 Genteng" class="brand-logo" onerror="
              this.closest('.card')
                ? this.closest('.card').classList.add('no-image')
                : null;
              this.remove();
            " />
      </a>

      <div class="nav-menu">
        <a href="#hero" class="nav-link active">Beranda</a>

        <!-- Profil & Info Dropdown -->
        <div class="nav-item">
          <a href="visi-misi.html#sambutan" class="nav-link">
            Profil & Info <span style="font-size: 0.65rem">▼</span>
          </a>
          <div class="dropdown-menu">
            <a href="/visi-misi" class="dropdown-item">
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
            <a href="/guru" class="dropdown-item">
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
            <a href="/fasilitas" class="dropdown-item">
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
            <a href="/ekstrakurikuler" class="dropdown-item">
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
            <a href="/prestasi" class="dropdown-item">
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

        <a href="#jurusan" class="nav-link">Konsentrasi Keahlian</a>

        <a href="/lsp" class="nav-link">LSP</a>

        <a href="/bkk" class="nav-link">BKK</a>

        <!-- Layanan Siswa (BLUD) -->
        <a href="#blud" class="nav-link">BLUD</a>

        <a href="/berita" class="nav-link">Berita</a>
        <a href="/spmb" class="btn btn-primary" style="padding: 0.55rem 1.4rem; font-size: 0.88rem">Daftar SPMB</a>
      </div>

      <a href="#spmb" class="btn btn-primary nav-mobile-cta" style="display: none">Daftar SPMB</a>
      <button class="hamburger" id="hamburger-btn" aria-label="Buka Menu Navigasi">
        ☰
      </button>
    </nav>
  </header>
