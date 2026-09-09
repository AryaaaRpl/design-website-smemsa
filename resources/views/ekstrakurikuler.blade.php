@extends('layouts.app')

@section('content')

  <!-- Mobile Drawer -->
  <div class="mobile-overlay" id="mobile-overlay"></div>
  <div class="mobile-drawer" id="mobile-drawer">
    <button class="drawer-close" id="drawer-close-btn">&times;</button>
    <div class="brand-box" style="margin-bottom: 2rem">
      <img src="{{ asset('assets/logo.webp') }}" alt="Logo SMEMSA" class="brand-logo" onerror="
            this.closest('.card')
              ? this.closest('.card').classList.add('no-image')
              : null;
            this.remove();
          " />
      <div>
        <strong style="color: var(--primary); font-size: 1.1rem; display: block">SMEMSA GENTENG</strong>
        <small style="color: var(--text-muted); font-size: 0.75rem">NPSN 20525597 &bull; Akreditasi A</small>
      </div>
    </div>

    <div class="drawer-links">
      <a href="/index">🏠 Beranda</a>

      <div class="drawer-section-title">Halaman Informasi</div>
      <a href="/visi-misi">🎯 Visi & Misi Sekolah</a>
      <a href="/guru">👥 Guru & Tenaga Kependidikan</a>
      <a href="/fasilitas">🏢 Fasilitas Unggulan</a>
      <a href="/ekstrakurikuler" class="active">⚽ Ekstrakurikuler & IPM</a>
      <a href="/prestasi">🏆 Prestasi & Penghargaan</a>
      <a href="/berita">📰 Jurnal & Kabar Sekolah</a>

      <div class="drawer-section-title">Navigasi Halaman Utama</div>
      <a href="index.html#sambutan">👤 Sambutan Kepala Sekolah</a>
      <a href="index.html#jurusan">💻 8 Program Keahlian</a>
      <a href="index.html#blud">🏬 Unit Produksi BLUD</a>
      <a href="/bkk">💼 Bursa Kerja Khusus (BKK)</a>

      <div style="margin-top: 1.5rem">
        <a href="/spmb" class="btn btn-primary"
          style="width: 100%; text-align: center; justify-content: center">Daftar SPMB 2026</a>
      </div>
    </div>
  </div>

  <!-- 2. PAGE HEADER -->
  <header class="page-header">
    <div class="container reveal-item">
      <span class="badge">Pengembangan Karakter & Minat</span>
      <h1 class="page-title">
        Membentuk Karakter,<br />Mengasah Talenta Juara.
      </h1>
      <p class="page-subtitle">
        Beragam pilihan kegiatan ekstrakurikuler di SMKS Muhammadiyah 1
        Genteng untuk menyalurkan potensi, minat, dan melatih jiwa
        kepemimpinan peserta didik.
      </p>
    </div>
  </header>

  <!-- 3. EKSTRAKURIKULER GRID -->
  <section class="ekskul-section container" data-px-stage="light">
    <div class="ekskul-grid">
      <!-- 1. Hizbul Wathan -->
      <div class="ekskul-card featured reveal-item" role="button" tabindex="0" onclick="openEkskulModal('hw')" onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); openEkskulModal('hw'); }">
        <!-- GAMBAR SEMENTARA (Akan diganti dengan dokumentasi asli) -->
        <div class="card-bg" style="background-image: url('{{ asset('assets/ekskul/hw.webp') }}\');"></div>
        <div class="card-content">
          <span class="tag">Kepanduan Islami Wajib</span>
          <h2 class="card-title">Hizbul Wathan (HW)</h2>
          <div class="card-desc">
            Diklat Kemah Tamu Penghela Hizbul Wathan sukses diselenggarakan.
            Ekstrakurikuler wajib kepanduan ini menanamkan kedisiplinan,
            kemandirian, dan nilai-nilai Islami berwawasan kemanusiaan
            universal.
          </div>
          <span class="card-action">Lihat Detail Program &rarr;</span>
        </div>
      </div>

      <!-- 2. Paskibra -->
      <div class="ekskul-card tall reveal-item" role="button" tabindex="0" onclick="openEkskulModal('paskibra')" onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); openEkskulModal('paskibra'); }">
        <!-- GAMBAR SEMENTARA (Akan diganti dengan dokumentasi asli) -->
        <div class="card-bg" style="background-image: url('{{ asset('assets/ekskul/paskibra.webp') }}\');"></div>
        <div class="card-content">
          <span class="tag">Kedisiplinan & Patriotisme</span>
          <h2 class="card-title">Paskibra Pasukan Inti</h2>
          <div class="card-desc">
            Mengajarkan siswa tentang kedisiplinan baris-berbaris presisi,
            ketahanan mental, serta rasa tanggung jawab kebangsaan yang kokoh.
          </div>
          <span class="card-action">Detail Program &rarr;</span>
        </div>
      </div>

      <!-- 3. Pencak Silat Tapak Suci -->
      <div class="ekskul-card reveal-item" role="button" tabindex="0" onclick="openEkskulModal('silat')" onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); openEkskulModal('silat'); }">
        <!-- GAMBAR SEMENTARA (Akan diganti dengan dokumentasi asli) -->
        <div class="card-bg" style="background-image: url('{{ asset('assets/ekskul/silat.webp') }}\');"></div>
        <div class="card-content">
          <span class="tag">Seni Bela Diri Tradisi</span>
          <h2 class="card-title">Pencak Silat Tapak Suci</h2>
          <div class="card-desc">
            Perguruan bela diri berprestasi nasional yang memadukan keahlian
            jurus tradisional, pertahanan diri, dan penguatan aqidah.
          </div>
          <span class="card-action">Detail Program &rarr;</span>
        </div>
      </div>

      <!-- 4. Pramuka -->
      <div class="ekskul-card reveal-item" role="button" tabindex="0" onclick="openEkskulModal('pramuka')" onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); openEkskulModal('pramuka'); }">
        <!-- GAMBAR SEMENTARA (Akan diganti dengan dokumentasi asli) -->
        <div class="card-bg" style="background-image: url('{{ asset('assets/ekskul/pramuka.webp') }}\');"></div>
        <div class="card-content">
          <span class="tag">Kepanduan Penegak</span>
          <h2 class="card-title">Gerakan Pramuka</h2>
          <div class="card-desc">
            Fokus pada pembinaan karakter mandiri, survival skills di alam
            bebas, pioneering, dan pengabdian sosial masyarakat.
          </div>
          <span class="card-action">Detail Program &rarr;</span>
        </div>
      </div>

      <!-- 5. PMR (Palang Merah Remaja) -->
      <div class="ekskul-card reveal-item" role="button" tabindex="0" onclick="openEkskulModal('pmr')" onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); openEkskulModal('pmr'); }">
        <!-- GAMBAR SEMENTARA (Akan diganti dengan dokumentasi asli) -->
        <div class="card-bg" style="background-image: url('{{ asset('assets/ekskul/pmr.webp') }}\');"></div>
        <div class="card-content">
          <span class="tag">Kesehatan & Kemanusiaan</span>
          <h2 class="card-title">PMR Wira Unit SMEMSA</h2>
          <div class="card-desc">
            Pelatihan pertolongan pertama pada kecelakaan (P3K), kesiapsiagaan
            bencana darurat, dan aksi donor darah sukarela.
          </div>
          <span class="card-action">Detail Program &rarr;</span>
        </div>
      </div>

      <!-- 6. Klub Olahraga -->
      <div class="ekskul-card reveal-item" role="button" tabindex="0" onclick="openEkskulModal('olahraga')" onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); openEkskulModal('olahraga'); }">
        <!-- GAMBAR SEMENTARA (Akan diganti dengan dokumentasi asli) -->
        <div class="card-bg" style="background-image: url('{{ asset('assets/ekskul/olahraga.webp') }}\');"></div>
        <div class="card-content">
          <span class="tag">Prestasi Atletik</span>
          <h2 class="card-title">Klub Olahraga Terpadu</h2>
          <div class="card-desc">
            Mewadahi talenta siswa dalam cabang Futsal, Bola Basket, Bola
            Voli, dan E-Sports untuk bersaing di kejurprov pelajar.
          </div>
          <span class="card-action">Detail Program &rarr;</span>
        </div>
      </div>
    </div>
  </section>

  <!-- MODAL EKSTRAKURIKULER -->
  <div class="ekskul-modal-overlay" id="ekskul-modal" onclick="if(event.target===this) closeEkskulModal()">
    <div class="ekskul-modal-content" role="dialog" aria-modal="true" data-lenis-prevent>
      <button class="ekskul-modal-close" onclick="closeEkskulModal()" aria-label="Tutup modal">&times;</button>
      <img src="" alt="" class="ekskul-modal-hero" id="modal-hero">
      <div class="ekskul-modal-body">
        <span class="ekskul-modal-badge" id="modal-badge"></span>
        <h2 class="ekskul-modal-title" id="modal-title"></h2>
        <div class="ekskul-modal-desc" id="modal-desc"></div>
        
        <div class="ekskul-modal-info-grid" id="modal-info-grid">
          <!-- Diisi dinamis -->
        </div>

        <div class="ekskul-modal-achievements" id="modal-achievements" style="display:none;">
          <h4>Prestasi & Penghargaan</h4>
          <ul id="modal-achievements-list"></ul>
        </div>
      </div>
    </div>
  </div>

@endsection
