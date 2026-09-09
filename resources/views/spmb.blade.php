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
            <div class="timeline-step-item">
              <div class="timeline-step-bullet">1</div>
              <div class="timeline-step-card">
                <h3 class="step-card-title">Isi Formulir Online</h3>
                <p class="step-card-desc">Lengkapi data calon siswa secara online melalui formulir resmi SPMB SMKS SMEMSA Genteng atau hubungi sekretariat pendaftaran.</p>
              </div>
            </div>
            <div class="timeline-step-item">
              <div class="timeline-step-bullet">2</div>
              <div class="timeline-step-card">
                <h3 class="step-card-title">Unggah Berkas Persyaratan</h3>
                <p class="step-card-desc">Siapkan scan pas foto, Kartu Keluarga, SKHUN/Ijazah, dan piagam prestasi (bagi pendaftar jalur prestasi/beasiswa).</p>
              </div>
            </div>
            <div class="timeline-step-item">
              <div class="timeline-step-bullet">3</div>
              <div class="timeline-step-card">
                <h3 class="step-card-title">Verifikasi Panitia</h3>
                <p class="step-card-desc">Panitia SPMB akan memvalidasi data administrasi dan mengonfirmasi jurusan pilihan Anda dalam waktu 1x24 jam kerja.</p>
              </div>
            </div>
            <div class="timeline-step-item">
              <div class="timeline-step-bullet">4</div>
              <div class="timeline-step-card">
                <h3 class="step-card-title">Daftar Ulang & Orientasi</h3>
                <p class="step-card-desc">Daftar ulang fisik di sekolah, fitting seragam kejuruan, dan pembekalan Masa Pengenalan Lingkungan Sekolah (MPLS).</p>
              </div>
            </div>
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
          <!-- Berkas Wajib -->
          <div class="berkas-card featured">
            <div class="berkas-category-tag" style="color: var(--primary);">Semua Jalur</div>
            <h3 class="berkas-title">Berkas Wajib</h3>
            <ul class="berkas-list">
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Scan/Fotokopi Kartu Keluarga (KK)</span>
              </li>
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Scan/Fotokopi Akta Kelahiran</span>
              </li>
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Scan/Fotokopi SKHUN atau Ijazah SMP/MTs (bisa menyusul)</span>
              </li>
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Pas Foto Berwarna 3x4 terbaru (3 lembar)</span>
              </li>
            </ul>
          </div>

          <!-- Jalur Prestasi -->
          <div class="berkas-card">
            <div class="berkas-category-tag" style="color: #a16207;">Jalur Khusus</div>
            <h3 class="berkas-title">Jalur Prestasi</h3>
            <ul class="berkas-list">
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Seluruh dokumen persyaratan berkas wajib</span>
              </li>
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Sertifikat/Piagam Kejuaraan Akademik atau Non-Akademik min. tingkat Kabupaten</span>
              </li>
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Surat rekomendasi dari Kepala Sekolah SMP/MTs asal (opsional)</span>
              </li>
            </ul>
          </div>

          <!-- Jalur Bantuan & Beasiswa -->
          <div class="berkas-card">
            <div class="berkas-category-tag" style="color: #15803d;">Jalur Bantuan</div>
            <h3 class="berkas-title">Jalur Beasiswa & KIP</h3>
            <ul class="berkas-list">
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Seluruh dokumen persyaratan berkas wajib</span>
              </li>
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Kartu Indonesia Pintar (KIP) / Kartu PKH / KKS aktif</span>
              </li>
              <li class="berkas-item">
                <svg class="berkas-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan/Desa</span>
              </li>
            </ul>
          </div>
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
          <div class="schedule-empty-banner">
            <div class="badge-amber mb-2" style="margin-bottom: 0.8rem;">Status Penjadwalan</div>
            <h3 class="font-head" style="font-size: 1.4rem; margin-bottom: 0.5rem; color: var(--primary-dark);">Jadwal Resmi Akan Diumumkan</h3>
            <p style="max-width: 580px; margin: 0 auto 1.5rem; font-size: 0.95rem; line-height: 1.6;">
              Kalender resmi gelombang pendaftaran Tahun Ajaran 2026/2027 sedang difinalisasi oleh Panitia SPMB SMKS Muhammadiyah 1 Genteng.
            </p>
            <a href="https://wa.me/6282241356668?text=Halo%20Panitia%20SPMB,%20apakah%20jadwal%20gelombang%20sudah%20dapat%20diperoleh?" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
              Dapatkan Notifikasi via WhatsApp &rarr;
            </a>
          </div>
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
            Status ketersediaan kuota kelas pada 7 konsentrasi keahlian unggulan.
          </p>
        </div>

        <div class="quota-grid" id="quota-container">
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
        </div>
      </div>
    </section>

    <!-- 6. BIAYA PENDIDIKAN & SKEMA BEASISWA (SUMBER: Rincian_Biaya_Pendidikan_dan_Beasiswa) -->
    <section class="spmb-section spmb-section-alt" id="biaya-pendidikan">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Transparansi Biaya & Beasiswa</span>
          <h2 class="section-title">Rincian Biaya Pendidikan & Skema Beasiswa</h2>
          <p class="section-desc">
            Komitmen SMKS Muhammadiyah 1 Genteng menghadirkan pendidikan vokasi berkualitas unggul dengan skema pembiayaan yang transparan, opsi cicilan 1 tahun, serta beragam peluang beasiswa.
          </p>
        </div>

        <div class="fee-section-wrapper">
          <!-- TAHAP 1: BIAYA SERAGAM SEKOLAH -->
          <div class="fee-group-block">
            <div class="fee-subheading">
              <span class="fee-subheading-badge">1. Biaya Masuk</span>
              <h3 class="fee-subheading-title">Biaya Seragam Sekolah (Sekali Bayar saat Masuk)</h3>
            </div>
            
            <div class="fee-seragam-grid">
              <!-- Seragam Laki-laki -->
              <div class="fee-seragam-card">
                <div>
                  <div class="fee-card-top">
                    <span class="badge-primary">Siswa Putra (LK)</span>
                    <span class="fee-tag-pill">1x di Awal Masuk</span>
                  </div>
                  <h4 style="font-size: 1.25rem; color: var(--primary-dark); margin-bottom: 0.3rem;">Paket Seragam Laki-laki</h4>
                  <div class="fee-price-amount">Rp 1.550.000</div>
                  <p class="fee-price-note">Termasuk paket seragam kejuruan lengkap, seragam khas sekolah/batik, seragam olahraga, jas almamater, dan atribut sekolah.</p>
                </div>
              </div>

              <!-- Seragam Perempuan -->
              <div class="fee-seragam-card female">
                <div>
                  <div class="fee-card-top">
                    <span class="badge-amber">Siswi Putri (PR)</span>
                    <span class="fee-tag-pill">1x di Awal Masuk</span>
                  </div>
                  <h4 style="font-size: 1.25rem; color: var(--primary-dark); margin-bottom: 0.3rem;">Paket Seragam Perempuan</h4>
                  <div class="fee-price-amount">Rp 1.700.000</div>
                  <p class="fee-price-note">Termasuk paket seragam kejuruan muslimah lengkap, rok panjang, jilbab seragam, seragam olahraga, jas almamater, dan atribut.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- TAHAP 2: BIAYA PENDIDIKAN & PROGRAM KHUSUS PER TINGKAT KELAS -->
          <div class="fee-group-block">
            <div class="fee-subheading">
              <span class="fee-subheading-badge">2. Biaya Pendidikan</span>
              <h3 class="fee-subheading-title">Biaya Pendidikan & Program Khusus per Tingkat Kelas</h3>
            </div>

            <!-- Banner Fasilitas Cicilan Semester -->
            <div class="fee-cicilan-banner">
              <div style="display: flex; align-items: center; gap: 0.75rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary); flex-shrink: 0;">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="16" x2="12" y2="12"></line>
                  <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <div class="fee-cicilan-text">
                  <strong>Skema Cicilan PSM:</strong> Biaya PSM 1 Tahun & Daftar Ulang (Rp 6.350.000) <strong>bisa dicicil 2x per semester (Rp 3.175.000 / semester)</strong> guna memudahkan perencanaan keuangan keluarga.
                </div>
              </div>
              <span class="badge-status-open" style="background: rgba(34, 197, 94, 0.15); color: #15803d; border-color: rgba(34, 197, 94, 0.3);">Dicicil 2x / Semester</span>
            </div>

            <div class="fee-grade-grid">
              <!-- KELAS X -->
              <div class="fee-grade-card">
                <div>
                  <span class="fee-grade-badge">Tingkat Pertama</span>
                  <h4 class="fee-grade-title">Kelas X (Sepuluh)</h4>
                  <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 0.5rem;">Fase fondasi kejuruan, praktikum lab industri & penguatan karakter Islami.</p>
                  
                  <div class="fee-item-row">
                    <div class="fee-item-detail">
                      <span class="label">Biaya PSM 1 Tahun:</span>
                      <span class="val">Rp 6.350.000</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">Opsi Cicilan (2x/Thn):</span>
                      <span class="val" style="color: #15803d;">Rp 3.175.000 / semester</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">Program Khusus:</span>
                      <span class="val" style="color: var(--text-muted);">-</span>
                    </div>
                  </div>
                </div>

                <div class="fee-total-box">
                  <div class="fee-total-label">Estimasi Total Biaya / Tahun</div>
                  <div class="fee-total-val">Rp 6.350.000</div>
                </div>
              </div>

              <!-- KELAS XI -->
              <div class="fee-grade-card featured-grade">
                <div>
                  <span class="fee-grade-badge" style="background: var(--secondary-surface); color: #a16207; border: 1px solid rgba(234, 179, 8, 0.35);">Tingkat Kedua • Program PKL</span>
                  <h4 class="fee-grade-title">Kelas XI (Sebelas)</h4>
                  <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 0.5rem;">Praktik Kerja Lapangan (PKL) langsung di dunia usaha & industri mitra.</p>
                  
                  <div class="fee-item-row">
                    <div class="fee-item-detail">
                      <span class="label">Biaya PSM 1 Tahun:</span>
                      <span class="val">Rp 6.350.000</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">Opsi Cicilan (2x/Thn):</span>
                      <span class="val" style="color: #15803d;">Rp 3.175.000 / semester</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">Program Khusus PKL:</span>
                      <span class="val" style="color: var(--primary);">Praktik Industri</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">• PKL Dalam Kota:</span>
                      <span class="val">Rp 950.000</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">• PKL Luar Kota:</span>
                      <span class="val">Rp 1.200.000</span>
                    </div>
                  </div>
                </div>

                <div class="fee-total-box">
                  <div class="fee-total-label">Estimasi Total Biaya / Tahun</div>
                  <div class="fee-total-val">
                    Rp 7.300.000 <small style="font-size: 0.75rem; font-weight: normal; color: var(--text-muted);">(Dlm Kota)</small><br>
                    <span style="font-size: 1.05rem;">Rp 7.550.000</span> <small style="font-size: 0.75rem; font-weight: normal; color: var(--text-muted);">(Luar Kota)</small>
                  </div>
                </div>
              </div>

              <!-- KELAS XII -->
              <div class="fee-grade-card">
                <div>
                  <span class="fee-grade-badge">Tingkat Akhir • Uji Sertifikasi</span>
                  <h4 class="fee-grade-title">Kelas XII (Dua Belas)</h4>
                  <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 0.5rem;">Uji Kompetensi Keahlian (UKK) & Sertifikasi Profesi Nasional LSP-P1 BNSP.</p>
                  
                  <div class="fee-item-row">
                    <div class="fee-item-detail">
                      <span class="label">Biaya PSM 1 Tahun:</span>
                      <span class="val">Rp 6.350.000</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">Opsi Cicilan (2x/Thn):</span>
                      <span class="val" style="color: #15803d;">Rp 3.175.000 / semester</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">Program Khusus:</span>
                      <span class="val" style="color: var(--primary);">Ujian UKK & LSP</span>
                    </div>
                    <div class="fee-item-detail">
                      <span class="label">• Biaya UKK & LSP:</span>
                      <span class="val">Rp 1.250.000</span>
                    </div>
                  </div>
                </div>

                <div class="fee-total-box">
                  <div class="fee-total-label">Estimasi Total Biaya / Tahun</div>
                  <div class="fee-total-val">Rp 7.600.000</div>
                </div>
              </div>
            </div>
          </div>

          <!-- TAHAP 3: SKEMA BEASISWA & KERINGANAN BIAYA (9 KATEGORI LENGKAP) -->
          <div class="fee-group-block">
            <div class="fee-subheading">
              <span class="fee-subheading-badge" style="background: var(--secondary-surface); color: #a16207;">9 Kategori Beasiswa</span>
              <h3 class="fee-subheading-title">3. Skema Beasiswa & Keringanan Biaya</h3>
            </div>
            
            <p style="font-size: 0.95rem; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6;">
              Dukungan nyata SMKS Muhammadiyah 1 Genteng melalui 9 kategori beasiswa. Program beasiswa sosial/tahfidz berlaku berkelanjutan <strong>selama 3 tahun masa studi</strong>, dan voucher pendaftaran awal dapat dikombinasikan dengan jalur beasiswa prestasi/alumni.
            </p>

            <div class="beasiswa-grid">
              <!-- 1. Voucher Pendaftaran (100 Pendaftar Pertama) -->
              <div class="beasiswa-card highlight">
                <div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="beasiswa-num">1</div>
                    <span class="badge-amber" style="font-size: 0.68rem; padding: 0.2rem 0.55rem;">PSM Thn Pertama</span>
                  </div>
                  <h4 class="beasiswa-title">Voucher Early Bird (100 Pendaftar Pertama)</h4>
                  <p class="beasiswa-kriteria">Khusus 100 pendaftar pertama pada gelombang awal. <em>Potongan langsung pada biaya PSM Tahun Pertama (Kelas X) & dapat dikombinasikan dengan beasiswa prestasi/alumni.</em></p>
                </div>
                <div class="beasiswa-amount-badge discount">
                  <span>Potongan Rp 1.000.000</span>
                </div>
              </div>

              <!-- 2. Alumni SMP Muhammadiyah -->
              <div class="beasiswa-card">
                <div>
                  <div class="beasiswa-num">2</div>
                  <h4 class="beasiswa-title">Beasiswa Alumni Muhammadiyah – SMP</h4>
                  <p class="beasiswa-kriteria">Bagi calon peserta didik lulusan dari <strong>SMP / MTs Muhammadiyah</strong>.</p>
                </div>
                <div class="beasiswa-amount-badge nominal">
                  <span>Potongan Rp 500.000</span>
                </div>
              </div>

              <!-- 3. Orang Tua Alumni SMK -->
              <div class="beasiswa-card">
                <div>
                  <div class="beasiswa-num">3</div>
                  <h4 class="beasiswa-title">Beasiswa Orang Tua Alumni SMK</h4>
                  <p class="beasiswa-kriteria">Bagi calon siswa yang <strong>orang tuanya merupakan alumni SMK Muhammadiyah</strong>.</p>
                </div>
                <div class="beasiswa-amount-badge nominal">
                  <span>Potongan Rp 500.000</span>
                </div>
              </div>

              <!-- 4. Beasiswa Berprestasi -->
              <div class="beasiswa-card">
                <div>
                  <div class="beasiswa-num">4</div>
                  <h4 class="beasiswa-title">Beasiswa Berprestasi</h4>
                  <p class="beasiswa-kriteria">Bagi siswa dengan <strong>prestasi akademik atau non-akademik</strong> (kejuaraan olahraga/seni/sains).</p>
                </div>
                <div class="beasiswa-amount-badge nominal">
                  <span>Potongan Rp 500.000</span>
                </div>
              </div>

              <!-- 5. Alumni SD Muhammadiyah -->
              <div class="beasiswa-card">
                <div>
                  <div class="beasiswa-num">5</div>
                  <h4 class="beasiswa-title">Beasiswa Alumni Muhammadiyah – SD</h4>
                  <p class="beasiswa-kriteria">Bagi calon peserta didik yang merupakan <strong>alumni SD / MI Muhammadiyah</strong>.</p>
                </div>
                <div class="beasiswa-amount-badge nominal">
                  <span>Potongan Rp 200.000</span>
                </div>
              </div>

              <!-- 6. Beasiswa Tidak Mampu -->
              <div class="beasiswa-card">
                <div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="beasiswa-num">6</div>
                    <span class="badge-primary" style="font-size: 0.68rem; padding: 0.2rem 0.55rem;">Berlaku 3 Tahun</span>
                  </div>
                  <h4 class="beasiswa-title">Beasiswa Tidak Mampu (Afirmasi)</h4>
                  <p class="beasiswa-kriteria">Bagi siswa dari <strong>keluarga kurang mampu</strong> (pemegang KIP/PKH/SKTM kelurahan). Berlaku selama 3 tahun masa studi.</p>
                </div>
                <div class="beasiswa-amount-badge discount">
                  <span>Potongan 50% / Tahun</span>
                </div>
              </div>

              <!-- 7. Beasiswa Yatim / Piatu -->
              <div class="beasiswa-card">
                <div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="beasiswa-num">7</div>
                    <span class="badge-primary" style="font-size: 0.68rem; padding: 0.2rem 0.55rem;">Berlaku 3 Tahun</span>
                  </div>
                  <h4 class="beasiswa-title">Beasiswa Yatim / Piatu</h4>
                  <p class="beasiswa-kriteria">Bagi calon siswa dengan <strong>salah satu orang tua (ayah atau ibu) telah wafat</strong>. Berlaku selama 3 tahun masa studi.</p>
                </div>
                <div class="beasiswa-amount-badge discount">
                  <span>Potongan 50% / Tahun</span>
                </div>
              </div>

              <!-- 8. Beasiswa Yatim Piatu -->
              <div class="beasiswa-card full-free">
                <div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="beasiswa-num">8</div>
                    <span class="badge-status-open" style="font-size: 0.68rem; padding: 0.2rem 0.55rem;">Berlaku 3 Tahun Penuh</span>
                  </div>
                  <h4 class="beasiswa-title">Beasiswa Yatim Piatu</h4>
                  <p class="beasiswa-kriteria">Bagi calon siswa yang <strong>kedua orang tuanya telah wafat</strong>. Bebas biaya pendidikan 100% selama 3 tahun.</p>
                </div>
                <div class="beasiswa-amount-badge free">
                  <span>Gratis 100% (Bebas Biaya 3 Thn)</span>
                </div>
              </div>

              <!-- 9. Beasiswa Hafidz 30 Juz -->
              <div class="beasiswa-card full-free">
                <div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="beasiswa-num">9</div>
                    <span class="badge-status-open" style="font-size: 0.68rem; padding: 0.2rem 0.55rem;">Berlaku 3 Tahun Penuh</span>
                  </div>
                  <h4 class="beasiswa-title">Beasiswa Hafidz 30 Juz</h4>
                  <p class="beasiswa-kriteria">Bagi penghafal <strong>Al-Qur'an 30 Juz</strong> dengan syahadah resmi. Bebas biaya pendidikan 100% selama 3 tahun.</p>
                </div>
                <div class="beasiswa-amount-badge free">
                  <span>Gratis 100% (Bebas Biaya 3 Thn)</span>
                </div>
              </div>
            </div>

            <!-- Callout Konsultasi & Pengajuan Beasiswa -->
            <div class="beasiswa-cta-box">
              <div class="beasiswa-cta-text">
                <h4>Konsultasi & Verifikasi Beasiswa</h4>
                <p>
                  Ingin mengonfirmasi kombinasi Voucher Early Bird dengan jalur beasiswa prestasi/alumni? Tim Panitia SPMB SMEMSA siap memandu Anda melalui WhatsApp.
                </p>
              </div>
              <a href="https://wa.me/6282241356668?text=Halo%20Panitia%20SPMB,%20saya%20ingin%20berkonsultasi%20mengenai%20skema%20beasiswa%20dan%20keringanan%20biaya"
                target="_blank" rel="noopener noreferrer" class="btn btn-amber" style="white-space: nowrap;">
                Konsultasi Beasiswa via WhatsApp &rarr;
              </a>
            </div>
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
            Temukan jawaban cepat atas pertanyaan umum seputar proses pendaftaran siswa baru, rincian biaya, dan beasiswa.
          </p>
        </div>

        <div class="faq-wrapper" id="faq-container">
          <div class="faq-item">
            <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-1">
              <span>Kapan periode pendaftaran siswa baru Tahun Ajaran 2026/2027 dibuka?</span>
              <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </button>
            <div class="faq-content" id="faq-ans-1">
              <p>Pendaftaran gelombang awal telah dibuka secara online dan offline. Anda dapat langsung berkonsultasi dan mendaftar melalui sekretariat sekolah atau via WhatsApp resmi panitia.</p>
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-2">
              <span>Bagaimana mekanisme cicilan biaya pendidikan (PSM)?</span>
              <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </button>
            <div class="faq-content" id="faq-ans-2">
              <p>Biaya PSM 1 Tahun sebesar Rp 6.350.000 dapat dicicil 2 kali per semester (Rp 3.175.000 per semester) pada Semester Ganjil dan Genap guna memberikan fleksibilitas pembayaran.</p>
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-3">
              <span>Berapa lama masa berlaku beasiswa di SMKS Muhammadiyah 1 Genteng?</span>
              <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </button>
            <div class="faq-content" id="faq-ans-3">
              <p>Beasiswa sosial/afirmasi (Yatim Piatu, Yatim/Piatu, Tidak Mampu) dan Beasiswa Hafidz 30 Juz berlaku selama 3 tahun penuh (Kelas X, XI, dan XII). Sedangkan Voucher Early Bird Rp 1.000.000 berlaku khusus untuk pemotongan biaya PSM di tahun pertama (Kelas X).</p>
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-4">
              <span>Apakah Voucher 100 Pendaftar Pertama bisa digabung dengan beasiswa lain?</span>
              <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </button>
            <div class="faq-content" id="faq-ans-4">
              <p>Ya, Voucher Early Bird pendaftaran awal dapat dikombinasikan dengan salah satu beasiswa alumni (SMP/SD Muhammadiyah) atau beasiswa prestasi. Untuk beasiswa gratis 100% (Yatim Piatu / Tahfidz 30 Juz), biaya sudah otomatis bebas sepenuhnya.</p>
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-5">
              <span>Apakah calon siswa boleh memilih konsentrasi keahlian cadangan?</span>
              <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </button>
            <div class="faq-content" id="faq-ans-5">
              <p>Ya, calon siswa dapat memilih jurusan prioritas utama dan jurusan alternatif cadangan saat mengisi formulir pendaftaran.</p>
            </div>
          </div>
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

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const faqItems = document.querySelectorAll(".faq-item");
      faqItems.forEach(function (item) {
        const trigger = item.querySelector(".faq-trigger");
        if (trigger) {
          trigger.addEventListener("click", function () {
            const isActive = item.classList.contains("active");
            faqItems.forEach(function (other) {
              other.classList.remove("active");
              const otherTrigger = other.querySelector(".faq-trigger");
              if (otherTrigger) otherTrigger.setAttribute("aria-expanded", "false");
            });
            if (!isActive) {
              item.classList.add("active");
              trigger.setAttribute("aria-expanded", "true");
            }
          });
        }
      });
    });
  </script>

@endsection
