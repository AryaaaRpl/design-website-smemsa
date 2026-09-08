@extends('layouts.app')

@section('content')

    <!-- Mobile Drawer -->
    <div class="mobile-overlay" id="mobile-overlay"></div>
    <div class="mobile-drawer" id="mobile-drawer">
      <button class="drawer-close" id="drawer-close-btn">&times;</button>
      <div class="brand-box" style="margin-bottom: 2rem">
        <img
          src="{{ asset('assets/logo.webp') }}"
          alt="Logo SMEMSA"
          class="brand-logo"
          onerror="
            this.closest('.card')
              ? this.closest('.card').classList.add('no-image')
              : null;
            this.remove();
          "
        />
        <div>
          <strong
            style="color: var(--primary); font-size: 1.1rem; display: block"
            >SMEMSA GENTENG</strong
          >
          <small style="color: var(--text-muted); font-size: 0.75rem"
            >NPSN 20525597 &bull; Akreditasi A</small
          >
        </div>
      </div>

      <div class="drawer-links">
        <a href="index.html#hero">🏠 Beranda</a>

        <div class="drawer-section-title">Halaman Informasi</div>
        <a href="/bkk">💼 Bursa Kerja Khusus (BKK)</a>
        <a href="/visi-misi">🎯 Visi & Misi Sekolah</a>
        <a href="/guru">👥 Guru & Tenaga Kependidikan</a>
        <a href="/fasilitas">🏢 Fasilitas Unggulan</a>
        <a href="/ekstrakurikuler">⚽ Ekstrakurikuler & IPM</a>
        <a href="/prestasi">🏆 Prestasi & Penghargaan</a>
        <a href="/berita">📰 Jurnal & Kabar Sekolah</a>

        <div class="drawer-section-title">Navigasi Halaman Utama</div>
        <a href="visi-misi.html#sambutan">👤 Sambutan Kepala Sekolah</a>
        <a href="index.html#jurusan">💻 7 Program Keahlian</a>

        <a href="/lsp" class="nav-link">LSP</a>
        <a href="index.html#blud">🏬 Unit Produksi BLUD</a>

        <div style="margin-top: 1.5rem">
          <a
            href="/spmb"
            class="btn btn-primary"
            style="width: 100%; text-align: center; justify-content: center"
            >Daftar SPMB 2026</a
          >
        </div>
      </div>
    </div>

    <!-- ============ PAGE HEADER ============ -->
    <header class="page-header">
      <div class="container">
        <span class="eyebrow">Lembaga Sertifikasi Profesi</span>
        <h1 class="page-title">LSP <em>SMKS Muhammadiyah 1 Genteng.</em></h1>
        <p class="page-lead">
          Lembaga Sertifikasi Profesi Pihak Pertama yang menyelenggarakan uji
          kompetensi bagi peserta didik. Lulusan tidak hanya membawa ijazah,
          tetapi juga sertifikat kompetensi berlogo Garuda yang diakui secara
          nasional.
        </p>

        <!-- Strip legitimasi -->
        <div class="legit-strip">
          <div class="legit-item">
            <div class="legit-label">Nomor Lisensi BNSP</div>
            <div class="legit-value is-placeholder" data-fill="nomor-lisensi">
              BNSP-LSP-1911-ID
            </div>
          </div>
          <div class="legit-item">
            <div class="legit-label">Tanggal Penetapan</div>
            <div class="legit-value is-placeholder" data-fill="tanggal-lisensi">
              Menunggu data
            </div>
          </div>
          <div class="legit-item">
            <div class="legit-label">Masa Berlaku</div>
            <div class="legit-value is-placeholder" data-fill="masa-berlaku">
              2031-04-24
            </div>
          </div>
          <div class="legit-item">
            <div class="legit-label">Jumlah Skema</div>
            <div class="legit-value" id="scheme-count">9 Skema</div>
          </div>
        </div>
      </div>
    </header>

    <!-- ============ 1. TENTANG ============ -->
    <section class="section">
      <div class="container about-grid">
        <div class="about-text">
          <span class="eyebrow">Tentang Lembaga</span>
          <h2 class="section-title">Sertifikasi yang Diakui Industri.</h2>
          <p style="margin-top: 1.2rem">
            LSP-P1 adalah lembaga sertifikasi yang dibentuk oleh satuan
            pendidikan dan memperoleh lisensi dari Badan Nasional Sertifikasi
            Profesi (BNSP) untuk melaksanakan uji kompetensi bagi peserta
            didiknya sendiri.
          </p>
          <p>
            Melalui LSP-P1, peserta didik SMKS Muhammadiyah 1 Genteng mengikuti
            asesmen yang menguji kemampuan nyata sesuai standar kerja yang
            berlaku di industri — bukan sekadar ujian tulis. Sertifikat yang
            diterbitkan berlaku secara nasional dan menjadi bukti kompetensi
            saat melamar kerja maupun melanjutkan studi.
          </p>
          <p
            data-fill="paragraf-tambahan"
            style="color: var(--text-subtle); font-style: italic"
          >
            [Ruang untuk sejarah singkat pendirian LSP, jumlah lulusan
            tersertifikasi, atau informasi lain dari pihak sekolah.]
          </p>
        </div>

        <aside class="id-card">
          <h3>Identitas Lembaga</h3>
          <dl>
            <div class="id-row">
              <dt>Nama LSP</dt>
              <dd class="is-placeholder" data-fill="nama-lsp">
                SMK Muhammadiyah 1 Genteng
              </dd>
            </div>
            <div class="id-row">
              <dt>Jenis</dt>
              <dd>LSP Pihak Pertama (P1)</dd>
            </div>
            <div class="id-row">
              <dt>No. Lisensi</dt>
              <dd class="is-placeholder" data-fill="nomor-lisensi">
                BNSP-LSP-1911-ID
              </dd>
            </div>
            <div class="id-row">
              <dt>Ketua LSP</dt>
              <dd class="is-placeholder" data-fill="ketua-lsp">
                Menunggu data
              </dd>
            </div>
            <div class="id-row">
              <dt>Induk</dt>
              <dd>SMKS Muhammadiyah 1 Genteng</dd>
            </div>
            <div class="id-row">
              <dt>NPSN</dt>
              <dd>20525597</dd>
            </div>
          </dl>
        </aside>
      </div>
    </section>

    <!-- ============ 2. SKEMA SERTIFIKASI ============ -->
    <section class="section alt" id="skema">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Skema Sertifikasi</span>
          <h2 class="section-title">Skema yang Diselenggarakan.</h2>
          <p class="section-desc">
            Setiap konsentrasi keahlian memiliki skema sertifikasi tersendiri
            dengan unit kompetensi yang mengacu pada Standar Kompetensi Kerja
            Nasional Indonesia (SKKNI). Klik salah satu skema untuk melihat
            rincian unit kompetensinya.
          </p>
        </div>

        <div class="scheme-list" id="scheme-list">
          <!-- Diisi oleh JavaScript dari array SKEMA -->
        </div>
      </div>
    </section>

    <!-- ============ 3. ALUR ASESMEN ============ -->
    <section class="section">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Proses Sertifikasi</span>
          <h2 class="section-title">Alur Uji Kompetensi.</h2>
          <p class="section-desc">
            Lima tahap yang dilalui peserta didik sejak mendaftar hingga
            menerima sertifikat kompetensi.
          </p>
        </div>

        <div class="flow" id="flow-list">
          <!-- Diisi oleh JavaScript dari array ALUR -->
        </div>
      </div>
    </section>

    <!-- ============ 4. ASESOR ============ -->
    <section class="section alt" id="asesor">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Sumber Daya</span>
          <h2 class="section-title">Asesor Kompetensi.</h2>
          <p class="section-desc">
            Uji kompetensi dilaksanakan oleh asesor bersertifikat BNSP yang
            berasal dari internal sekolah maupun praktisi industri mitra.
          </p>
        </div>

        <div class="assessor-grid" id="assessor-grid">
          <!-- Diisi oleh JavaScript dari array ASESOR -->
        </div>
      </div>
    </section>

    <!-- ============ 5. TUK ============ -->
    <section class="section" id="tuk">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Tempat Uji Kompetensi</span>
          <h2 class="section-title">TUK Terverifikasi.</h2>
          <p class="section-desc">
            Asesmen dilaksanakan di tempat uji kompetensi yang telah
            diverifikasi sesuai standar, sebagian besar merupakan unit Teaching
            Factory yang beroperasi nyata.
          </p>
        </div>

        <div class="tuk-grid" id="tuk-grid">
          <!-- Diisi oleh JavaScript dari array TUK -->
        </div>
      </div>
    </section>

    <!-- ============ 6. CTA ============ -->
    <section class="section">
      <div class="container">
        <div class="cta-band">
          <div>
            <h3>Kompetensi yang Terbukti, Bukan Sekadar Ijazah.</h3>
            <p>
              Setiap peserta didik SMKS Muhammadiyah 1 Genteng berkesempatan
              mengikuti uji kompetensi sesuai konsentrasi keahliannya. Pelajari
              alur karier tiap jurusan, dari ruang kelas sampai tempat kerja.
            </p>
          </div>
          <a href="index.html#jurusan" class="btn-gold">
            Lihat Konsentrasi Keahlian
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2.4"
              stroke-linecap="round"
              stroke-linejoin="round"
              aria-hidden="true"
            >
              <path d="M5 12h14M13 6l6 6-6 6" />
            </svg>
          </a>
        </div>
      </div>
    </section>

    <!-- ============ FOOTER ============ -->

@endsection
