@extends('layouts.app')

@section('content')

  <main>
    <!-- 1. PAGE HEADER -->
    <header class="page-header">
      <div class="container">
        <div class="badge-amber mb-2">Tahun Ajaran 2026/2027</div>
        <h1 class="page-title">Sistem Penerimaan Siswa Baru</h1>
        <p class="page-subtitle">
          Wujudkan potensi dan keahlian vokasi masa depan bersama SMK Pusat Keunggulan berstandar nasional dan
          berkarakter Islami.
        </p>
        <div class="header-actions">
          <a href="https://wa.me/6282241356668?text=Halo%20Panitia%20SPMB%20SMKS%20Muhammadiyah%201%20Genteng,%20saya%20ingin%20mendaftar%20siswa%20baru"
            target="_blank" rel="noopener noreferrer" class="btn btn-amber">
            Daftar Sekarang
          </a>
          <a href="https://wa.me/6282241356668" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
            Hubungi Panitia (WhatsApp)
          </a>
        </div>
      </div>
    </header>

    <!-- 2. ALUR PENDAFTARAN (LINIMASA VERTIKAL BERNOMOR) -->
    <section class="spmb-section spmb-section-alt" id="alur-pendaftaran">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Tahapan Seleksi</span>
          <h2 class="section-title">Alur Pendaftaran Siswa Baru</h2>
          <p class="section-desc">
            Empat langkah praktis menuju status siswa resmi SMKS Muhammadiyah 1 Genteng.
          </p>
        </div>

        <div class="timeline-vertical-wrapper">
          <div class="timeline-vertical-track" id="steps-container">
            <!-- Rendered by JavaScript fallback provided -->
            <noscript>
              <div class="timeline-step-item">
                <div class="timeline-step-bullet">1</div>
                <div class="timeline-step-card">
                  <h3 class="step-card-title">Isi Formulir Online</h3>
                  <p class="step-card-desc">Lengkapi data calon siswa secara online melalui formulir resmi SPMB SMKS
                    SMEMSA Genteng.</p>
                </div>
              </div>
              <div class="timeline-step-item">
                <div class="timeline-step-bullet">2</div>
                <div class="timeline-step-card">
                  <h3 class="step-card-title">Unggah Berkas Persyaratan</h3>
                  <p class="step-card-desc">Siapkan scan pas foto, Kartu Keluarga, SKHUN/Ijazah, dan piagam prestasi.
                  </p>
                </div>
              </div>
              <div class="timeline-step-item">
                <div class="timeline-step-bullet">3</div>
                <div class="timeline-step-card">
                  <h3 class="step-card-title">Verifikasi Panitia</h3>
                  <p class="step-card-desc">Panitia SPMB akan memvalidasi data dan mengonfirmasi jurusan pilihan Anda.
                  </p>
                </div>
              </div>
              <div class="timeline-step-item">
                <div class="timeline-step-bullet">4</div>
                <div class="timeline-step-card">
                  <h3 class="step-card-title">Daftar Ulang & Orientasi</h3>
                  <p class="step-card-desc">Daftar ulang fisik di sekolah, fitting seragam kejuruan, dan pembekalan Masa
                    Pengenalan Lingkungan Sekolah.</p>
                </div>
              </div>
            </noscript>
          </div>
        </div>
      </div>
    </section>

    <!-- 3. SYARAT & BERKAS PERSYARATAN -->
    <section class="spmb-section" id="syarat-berkas">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Kelengkapan Administrasi</span>
          <h2 class="section-title">Syarat & Berkas Pendaftaran</h2>
          <p class="section-desc">
            Persiapkan dokumen berikut sesuai dengan jalur pendaftaran yang Anda pilih.
          </p>
        </div>

        <div class="berkas-grid" id="berkas-container">
          <!-- Rendered by JavaScript fallback provided -->
          <noscript>
            <div class="berkas-card featured">
              <div class="berkas-category-tag" style="color: var(--primary);">Semua Jalur</div>
              <h3 class="berkas-title">Berkas Wajib</h3>
              <ul class="berkas-list">
                <li class="berkas-item">✓ Scan/Fotokopi Kartu Keluarga (KK)</li>
                <li class="berkas-item">✓ Scan/Fotokopi Akta Kelahiran</li>
                <li class="berkas-item">✓ Scan/Fotokopi SKHUN atau Ijazah SMP/MTs (bisa menyusul)</li>
                <li class="berkas-item">✓ Pas Foto Berwarna 3x4 terbaru (3 lembar)</li>
              </ul>
            </div>
            <div class="berkas-card">
              <div class="berkas-category-tag" style="color: #a16207;">Jalur Khusus</div>
              <h3 class="berkas-title">Jalur Prestasi</h3>
              <ul class="berkas-list">
                <li class="berkas-item">✓ Seluruh dokumen berkas wajib</li>
                <li class="berkas-item">✓ Sertifikat/Piagam Kejuaraan Akademik atau Non-Akademik minimal tingkat
                  Kabupaten</li>
                <li class="berkas-item">✓ Surat rekomendasi dari kepala sekolah SMP/MTs asal (opsional)</li>
              </ul>
            </div>
            <div class="berkas-card">
              <div class="berkas-category-tag" style="color: #15803d;">Jalur Bantuan</div>
              <h3 class="berkas-title">Jalur Beasiswa & KIP</h3>
              <ul class="berkas-list">
                <li class="berkas-item">✓ Seluruh dokumen berkas wajib</li>
                <li class="berkas-item">✓ Kartu Indonesia Pintar (KIP) / Kartu PKH / KKS aktif</li>
                <li class="berkas-item">✓ Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan/Desa</li>
              </ul>
            </div>
          </noscript>
        </div>
      </div>
    </section>

    <!-- 4. JADWAL GELOMBANG -->
    <section class="spmb-section spmb-section-alt" id="jadwal-gelombang">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Agenda Pendaftaran</span>
          <h2 class="section-title">Jadwal Gelombang SPMB</h2>
          <p class="section-desc">
            Informasi periode pendaftaran, tes bakat kejuruan, dan pengumuman hasil seleksi.
          </p>
        </div>

        <div id="schedule-container">
          <!-- Rendered dynamically by JavaScript -->
          <noscript>
            <div class="schedule-empty-banner">
              <h3 class="font-head" style="margin-bottom: 0.5rem; color: var(--primary-dark)">Jadwal Resmi Akan
                Diumumkan</h3>
              <p>Jadwal gelombang pendaftaran Tahun Ajaran 2026/2027 sedang difinalisasi oleh panitia SPMB SMKS
                Muhammadiyah 1 Genteng.</p>
            </div>
          </noscript>
        </div>
      </div>
    </section>

    <!-- 5. KUOTA PER KONSENTRASI KEAHLIAN (KUALITATIF) -->
    <section class="spmb-section" id="kuota-jurusan">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Kapasitas Kelas</span>
          <h2 class="section-title">Kuota Konsentrasi Keahlian</h2>
          <p class="section-desc">
            Status ketersediaan kuota kelas pada 8 konsentrasi keahlian unggulan.
          </p>
        </div>

        <div class="quota-grid" id="quota-container">
          <!-- Rendered dynamically by JavaScript with qualitative tags -->
          <noscript>
            <div class="quota-item-card">
              <div class="quota-item-head">
                <span class="quota-code-badge">PPLG</span>
                <span class="badge-quota-available">Kuota Tersedia</span>
              </div>
              <h3 class="quota-major-name">Pengembangan Perangkat Lunak dan Gim</h3>
              <p class="quota-major-desc">Web development, mobile apps, database cloud, dan TEFA Software House.</p>
            </div>
            <div class="quota-item-card">
              <div class="quota-item-head">
                <span class="quota-code-badge">TJKT</span>
                <span class="badge-quota-available">Kuota Tersedia</span>
              </div>
              <h3 class="quota-major-name">Teknik Jaringan Komputer dan Telekomunikasi</h3>
              <p class="quota-major-desc">Infrastruktur jaringan enterprise, fiber optic, server linux & Mikrotik.</p>
            </div>
            <div class="quota-item-card">
              <div class="quota-item-head">
                <span class="quota-code-badge">DKV</span>
                <span class="badge-quota-limited">Kuota Terbatas</span>
              </div>
              <h3 class="quota-major-name">Desain Komunikasi Visual</h3>
              <p class="quota-major-desc">Multimedia kreatif, videografi, animasi 2D/3D, branding periklanan.</p>
            </div>
            <div class="quota-item-card">
              <div class="quota-item-head">
                <span class="quota-code-badge">BD</span>
                <span class="badge-quota-available">Kuota Tersedia</span>
              </div>
              <h3 class="quota-major-name">Bisnis Digital</h3>
              <p class="quota-major-desc">Omnichannel marketplace, digital ads Meta/Google, live commerce studio.</p>
            </div>
            <div class="quota-item-card">
              <div class="quota-item-head">
                <span class="quota-code-badge">AKL</span>
                <span class="badge-quota-available">Kuota Tersedia</span>
              </div>
              <h3 class="quota-major-name">Akuntansi & Keuangan Lembaga</h3>
              <p class="quota-major-desc">Komputer akuntansi Accurate, perpajakan digital, dan Bank Mini Syariah.</p>
            </div>
            <div class="quota-item-card">
              <div class="quota-item-head">
                <span class="quota-code-badge">MPLB</span>
                <span class="badge-quota-available">Kuota Tersedia</span>
              </div>
              <h3 class="quota-major-name">Manajemen Perkantoran</h3>
              <p class="quota-major-desc">Otomasi perkantoran digital, public relations, kearsipan cloud modern.</p>
            </div>
            <div class="quota-item-card">
              <div class="quota-item-head">
                <span class="quota-code-badge">PH</span>
                <span class="badge-quota-limited">Kuota Terbatas</span>
              </div>
              <h3 class="quota-major-name">Perhotelan</h3>
              <p class="quota-major-desc">Front office hotel, housekeeping bintang 5, F&B service, Edutel SMEMSA.</p>
            </div>
          </noscript>
        </div>
      </div>
    </section>

    <!-- 6. BIAYA PENDIDIKAN (KERANGKA TRANSPARAN) -->
    <section class="spmb-section spmb-section-alt" id="biaya-pendidikan">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Transparansi Investasi</span>
          <h2 class="section-title">Biaya Pendidikan & Seragam</h2>
          <p class="section-desc">
            Komitmen kami menghadirkan pendidikan vokasi berkualitas unggul dengan skema pembiayaan yang transparan dan
            terjangkau.
          </p>
        </div>

        <div class="fee-container-card">
          <div class="fee-info-box">
            <h3 class="font-head" style="font-size: 1.45rem; color: var(--primary-dark);">Rincian Biaya & Skema
              Keringanan</h3>
            <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.65;">
              Biaya pendidikan mencakup seragam kejuruan lengkap, modul pembelajaran praktikum, akses laboratorium
              berstandar industri, serta persiapan sertifikasi kompetensi LSP-P1 BNSP.
            </p>
            <div class="fee-notice-card">
              <div class="badge-amber mb-2" style="margin-bottom: 0.8rem;">Informasi Resmi Panitia</div>
              <p style="font-size: 0.95rem; color: var(--text-dark); font-weight: 600; margin-bottom: 0.5rem;">
                Tabel rincian biaya lengkap dapat ditanyakan langsung kepada Panitia SPMB.
              </p>
              <small style="color: var(--text-muted); display: block;">Tersedia beasiswa prestasi dan program cicilan
                bagi orang tua/wali murid.</small>
            </div>
          </div>

          <div class="fee-contact-callout">
            <h4 style="font-size: 1.3rem; margin-bottom: 0.6rem; color: #ffffff;">Konsultasi Biaya & Potongan Khusus
            </h4>
            <p style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 1.5rem; line-height: 1.6;">
              Dapatkan informasi promo pendaftaran awal gelombang 1 dan skema beasiswa KIP/prestasi.
            </p>
            <a href="https://wa.me/6282241356668?text=Halo%20Panitia%20SPMB,%20saya%20ingin%20menanyakan%20rincian%20biaya%20pendidikan"
              target="_blank" rel="noopener noreferrer" class="btn btn-amber"
              style="width: 100%; text-decoration: none;">
              Tanya Biaya via WhatsApp &rarr;
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- 7. FAQ AKORDEON (ACCESSIBLE) -->
    <section class="spmb-section" id="faq">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Tanya Jawab</span>
          <h2 class="section-title">Pertanyaan Sering Diajukan (FAQ)</h2>
          <p class="section-desc">
            Temukan jawaban cepat atas pertanyaan umum seputar proses pendaftaran siswa baru.
          </p>
        </div>

        <div class="faq-wrapper" id="faq-container">
          <!-- Rendered dynamically by JavaScript -->
          <noscript>
            <div class="faq-item">
              <div class="faq-trigger">Kapan pendaftaran siswa baru Tahun Ajaran 2026/2027 dibuka?</div>
              <div class="faq-content" style="display: block;">Pendaftaran gelombang 1 telah dibuka secara online.
                Silakan hubungi panitia melalui WhatsApp untuk panduan formulir.</div>
            </div>
            <div class="faq-item">
              <div class="faq-trigger">Apakah calon siswa boleh memilih lebih dari satu konsentrasi keahlian?</div>
              <div class="faq-content" style="display: block;">Ya, pendaftar dapat memilih pilihan jurusan utama dan
                jurusan cadangan pada formulir pendaftaran.</div>
            </div>
            <div class="faq-item">
              <div class="faq-trigger">Apakah ada tes masuk dalam proses SPMB?</div>
              <div class="faq-content" style="display: block;">Terdapat tes pemetaan minat dan bakat kejuruan serta
                wawancara untuk penempatan kelas industri.</div>
            </div>
          </noscript>
        </div>
      </div>
    </section>

    <!-- 8. KONTAK PANITIA -->
    <section class="spmb-section spmb-section-alt" id="kontak-panitia">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Bantuan & Layanan</span>
          <h2 class="section-title">Sekretariat Panitia SPMB</h2>
          <p class="section-desc">
            Kunjungi sekolah kami atau hubungi panitia untuk informasi lengkap pendaftaran.
          </p>
        </div>

        <div class="contact-panitia-grid">
          <!-- WhatsApp Panitia -->
          <div class="contact-panitia-card">
            <div>
              <div class="panitia-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path
                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                </svg>
              </div>
              <h3 class="panitia-card-title">WhatsApp Resmi</h3>
              <p class="panitia-card-desc">Layanan konsultasi cepat SPMB, pengiriman bukti berkas, dan panduan formulir.
              </p>
            </div>
            <a href="https://wa.me/6282241356668" target="_blank" rel="noopener noreferrer" class="btn btn-primary"
              style="width: 100%;">
              0822-4135-6668
            </a>
          </div>

          <!-- Telepon Sekolah -->
          <div class="contact-panitia-card">
            <div>
              <div class="panitia-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path
                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
              </div>
              <h3 class="panitia-card-title">Telepon Sekolah</h3>
              <p class="panitia-card-desc">Jam layanan kantor: Senin – Sabtu, pukul 07.00 – 14.30 WIB.</p>
            </div>
            <a href="tel:0333845605" class="btn btn-outline" style="width: 100%;">
              (0333) 845605
            </a>
          </div>

          <!-- Lokasi Sekolah -->
          <div class="contact-panitia-card">
            <div>
              <div class="panitia-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                  <circle cx="12" cy="10" r="3" />
                </svg>
              </div>
              <h3 class="panitia-card-title">Lokasi Sekolah</h3>
              <p class="panitia-card-desc">Jl. KH. Imam Bahri No.10, Dusun Krajan, Genteng Wetan, Genteng, Banyuwangi
                68465.</p>
            </div>
            <a href="https://maps.google.com/?q=SMKS+Muhammadiyah+1+Genteng" target="_blank" rel="noopener noreferrer"
              class="btn btn-outline" style="width: 100%;">
              Buka Google Maps
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->

@endsection
