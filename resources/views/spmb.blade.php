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
            target="_blank" rel="noopener noreferrer" class="btn btn-primary">
            Daftar Sekarang
          </a>
          <a href="https://wa.me/6282241356668" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
            Hubungi Panitia (WhatsApp)
          </a>
        </div>
      </div>
    </header>

     <!-- 2. SYARAT & BERKAS PERSYARATAN -->
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

    <!-- 3. ALUR PENDAFTARAN (ONLINE & OFFLINE INTERAKTIF DENGAN ANIMASI GARIS) -->
    <section class="spmb-section spmb-section-alt" id="alur-pendaftaran">
      <div class="container">
        <div class="section-header">
          <span class="badge-primary">Tahapan Seleksi</span>
          <h2 class="section-title">Alur Pendaftaran Siswa Baru</h2>
          <p class="section-desc">
            Pilih jalur pendaftaran online atau offline sesuai kenyamanan Anda untuk bergabung bersama SMKS Muhammadiyah 1 Genteng.
          </p>
        </div>

        <!-- Mode Pendaftaran Switcher (Online vs Offline) -->
        <div class="alur-switch-wrapper">
          <div class="alur-switch-container">
            <button type="button" class="alur-switch-btn active" id="btn-alur-online" onclick="switchAlur('online')">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="2" y1="12" x2="22" y2="12"></line>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
              </svg>
              <span>Pendaftaran Online</span>
            </button>
            <button type="button" class="alur-switch-btn" id="btn-alur-offline" onclick="switchAlur('offline')">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span>Pendaftaran Offline</span>
            </button>
          </div>
        </div>

        <div class="timeline-vertical-wrapper">
          <!-- PANEL ALUR ONLINE -->
          <div class="alur-timeline-panel active" id="alur-panel-online">
            <div class="timeline-vertical-box" id="timeline-box-online">
              <div class="timeline-progress-line">
                <div class="timeline-progress-bar" id="timeline-bar-online"></div>
              </div>

              <!-- Langkah 1 Online -->
              <div class="timeline-step-card-v2">
                <div class="timeline-step-icon">1</div>
                <div class="timeline-step-body">
                  <div class="timeline-step-tag">Tahap 1 • Registrasi Digital</div>
                  <h3 class="step-card-title">Isi Formulir Online</h3>
                  <p class="step-card-desc">
                    Lengkapi formulir pendaftaran digital melalui portal SPMB SMKS Muhammadiyah 1 Genteng atau hubungi narahubung panitia. Pilih 2 konsentrasi keahlian yang diminati.
                  </p>
                </div>
              </div>

              <!-- Langkah 2 Online -->
              <div class="timeline-step-card-v2">
                <div class="timeline-step-icon">2</div>
                <div class="timeline-step-body">
                  <div class="timeline-step-tag">Tahap 2 • Dokumen Persyaratan</div>
                  <h3 class="step-card-title">Unggah Berkas Persyaratan</h3>
                  <p class="step-card-desc">
                    Unggah foto/scan Kartu Keluarga (KK), Akta Kelahiran, SKHUN/Ijazah SMP (dapat menyusul), pas foto 3x4, serta sertifikat/piagam prestasi bagi pendaftar jalur prestasi/beasiswa.
                  </p>
                </div>
              </div>

              <!-- Langkah 3 Online -->
              <div class="timeline-step-card-v2">
                <div class="timeline-step-icon">3</div>
                <div class="timeline-step-body">
                  <div class="timeline-step-tag">Tahap 3 • Validasi Panitia</div>
                  <h3 class="step-card-title">Verifikasi & Konfirmasi Kelulusan</h3>
                  <p class="step-card-desc">
                    Panitia SPMB memvalidasi data dan keabsahan berkas secara daring dalam 1x24 jam. Anda akan menerima notifikasi status penerimaan dan nomor registrasi resmi via WhatsApp.
                  </p>
                </div>
              </div>

              <!-- Langkah 4 Online -->
              <div class="timeline-step-card-v2">
                <div class="timeline-step-icon">4</div>
                <div class="timeline-step-body">
                  <div class="timeline-step-tag">Tahap 4 • Finalisasi & MPLS</div>
                  <h3 class="step-card-title">Daftar Ulang & Orientasi Siswa</h3>
                  <p class="step-card-desc">
                    Konfirmasi daftar ulang dan skema pembayaran PSM (dapat dicicil), fitting/pengambilan seragam kejuruan di sekolah SMEMSA, serta persiapan Masa Pengenalan Lingkungan Sekolah (MPLS).
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- PANEL ALUR OFFLINE -->
          <div class="alur-timeline-panel" id="alur-panel-offline" style="display: none;">
            <div class="timeline-vertical-box" id="timeline-box-offline">
              <div class="timeline-progress-line">
                <div class="timeline-progress-bar" id="timeline-bar-offline"></div>
              </div>

              <!-- Langkah 1 Offline -->
              <div class="timeline-step-card-v2">
                <div class="timeline-step-icon">1</div>
                <div class="timeline-step-body">
                  <div class="timeline-step-tag">Tahap 1 • Kunjungan Sekolah</div>
                  <h3 class="step-card-title">Datang ke Sekretariat SPMB SMEMSA</h3>
                  <p class="step-card-desc">
                    Kunjungi Sekretariat SPMB di SMKS Muhammadiyah 1 Genteng (Jl. KH. Imam Bahri No.10, Genteng) pada jam layanan kantor (Senin–Sabtu, 07.00–14.30 WIB) didampingi orang tua/wali.
                  </p>
                </div>
              </div>

              <!-- Langkah 2 Offline -->
              <div class="timeline-step-card-v2">
                <div class="timeline-step-icon">2</div>
                <div class="timeline-step-body">
                  <div class="timeline-step-tag">Tahap 2 • Pengisian Formulir & Berkas</div>
                  <h3 class="step-card-title">Pengisian Formulir & Penyerahan Berkas Fisik</h3>
                  <p class="step-card-desc">
                    Ambil lembar formulir fisik pendaftaran di loket sekretariat, isi data calon siswa dengan panduan panitia, dan serahkan berkas fotokopi (KK, Akta, Ijazah/SKHUN, & Pas Foto 3x4).
                  </p>
                </div>
              </div>

              <!-- Langkah 3 Offline -->
              <div class="timeline-step-card-v2">
                <div class="timeline-step-icon">3</div>
                <div class="timeline-step-body">
                  <div class="timeline-step-tag">Tahap 3 • Peminatan & Tes Kejuruan</div>
                  <h3 class="step-card-title">Wawancara Minat Bakat & Cek Fisik</h3>
                  <p class="step-card-desc">
                    Mengikuti konsultasi pemilihan jurusan bersama guru BK/panitia, cek kesehatan kejuruan (tes buta warna untuk konsentrasi tertentu), dan validasi kriteria beasiswa jika mengajukan.
                  </p>
                </div>
              </div>

              <!-- Langkah 4 Offline -->
              <div class="timeline-step-card-v2">
                <div class="timeline-step-icon">4</div>
                <div class="timeline-step-body">
                  <div class="timeline-step-tag">Tahap 4 • Administrasi & Seragam</div>
                  <h3 class="step-card-title">Daftar Ulang, Fitting Seragam & Cetak Kartu</h3>
                  <p class="step-card-desc">
                    Menyelesaikan administrasi daftar ulang di loket kasir sekolah, melakukan pengukuran/fitting seragam kejuruan langsung di tempat, serta menerima Surat Tanda Diterima resmi.
                  </p>
                </div>
              </div>
            </div>
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
                    <span class="badge-amber">Siswa Putra (LK)</span>
                    <span class="fee-tag-pill">1x di Awal Masuk</span>
                  </div>
                  <h4 style="font-size: 1.25rem; color: var(--primary-dark); margin-bottom: 0.3rem;">Paket Seragam Laki-laki</h4>
                  <div class="fee-price-amount">Rp 1.550.000</div>
                  <p class="fee-price-note">Termasuk paket seragam kejuruan lengkap, seragam khas sekolah/batik, seragam olahraga, jas almamater, dan atribut sekolah.</p>
                </div>
              </div>

              <!-- Seragam Perempuan -->
              <div class="fee-seragam-card">
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
              <span class="badge-status-open" style="background: var(--secondary-surface); color: #a16207; border: 1px solid rgba(234, 179, 8, 0.35);">Dicicil 2x / Semester</span>
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

            <div class="beasiswa-table-hint">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8L22 12L18 16"/><path d="M6 8L2 12L6 16"/><path d="M2 12H22"/></svg>
              <span>Geser tabel ke samping untuk melihat detail beasiswa</span>
            </div>

            <div class="beasiswa-table-wrapper">
              <div class="beasiswa-table-responsive">
                <table class="beasiswa-table">
                  <thead>
                    <tr>
                      <th style="width: 50px; text-align: center;">No</th>
                      <th style="min-width: 220px;">Skema Beasiswa</th>
                      <th style="min-width: 280px;">Kriteria & Syarat Penerima</th>
                      <th style="min-width: 170px;">Masa Berlaku</th>
                      <th style="min-width: 190px; text-align: right;">Besaran Keringanan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- 1. Voucher Early Bird (100 Pendaftar Pertama) -->
                    <tr class="row-highlight">
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge highlight">1</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Voucher Early Bird</span>
                          <span class="badge-tag-sm amber">100 Pendaftar Pertama</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Khusus 100 pendaftar pertama pada gelombang awal. <em>Potongan langsung pada biaya PSM Tahun Pertama (Kelas X) & dapat dikombinasikan dengan beasiswa prestasi/alumni.</em>
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag amber">PSM Thn Pertama (Kelas X)</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge discount">Potongan Rp 1.000.000</span>
                      </td>
                    </tr>

                    <!-- 2. Alumni SD Muhammadiyah -->
                    <tr>
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge">2</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Beasiswa Alumni Muhammadiyah – SD</span>
                          <span class="badge-tag-sm blue">Jalur Alumni</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Bagi calon peserta didik yang merupakan <strong>alumni SD / MI Muhammadiyah</strong>.
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag">Sekali (Daftar Ulang)</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge nominal">Potongan Rp 200.000</span>
                      </td>
                    </tr>

                    <!-- 3. Alumni SMP Muhammadiyah -->
                    <tr>
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge">3</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Beasiswa Alumni Muhammadiyah – SMP</span>
                          <span class="badge-tag-sm blue">Jalur Alumni</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Bagi calon peserta didik lulusan dari <strong>SMP / MTs Muhammadiyah</strong>.
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag">Sekali (Daftar Ulang)</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge nominal">Potongan Rp 500.000</span>
                      </td>
                    </tr>

                    <!-- 4. Orang Tua Alumni SMK -->
                    <tr>
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge">4</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Beasiswa Orang Tua Alumni SMK</span>
                          <span class="badge-tag-sm slate">Keluarga Alumni</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Bagi calon siswa yang <strong>orang tuanya merupakan alumni SMK Muhammadiyah</strong>.
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag">Sekali (Daftar Ulang)</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge nominal">Potongan Rp 500.000</span>
                      </td>
                    </tr>

                    <!-- 5. Beasiswa Berprestasi -->
                    <tr>
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge">5</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Beasiswa Berprestasi</span>
                          <span class="badge-tag-sm blue">Akademik & Non-Akademik</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Bagi siswa dengan <strong>prestasi akademik atau non-akademik</strong> (kejuaraan olahraga/seni/sains).
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag">Sekali (Daftar Ulang)</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge nominal">Potongan Rp 500.000</span>
                      </td>
                    </tr>

                    <!-- 6. Beasiswa Tidak Mampu -->
                    <tr>
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge">6</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Beasiswa Tidak Mampu (Afirmasi)</span>
                          <span class="badge-tag-sm blue">KIP / PKH / SKTM</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Bagi siswa dari <strong>keluarga kurang mampu</strong> (pemegang KIP/PKH/SKTM kelurahan).
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag blue">Berlaku 3 Tahun</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge discount">Potongan 50% / Tahun</span>
                      </td>
                    </tr>

                    <!-- 7. Beasiswa Yatim / Piatu -->
                    <tr>
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge">7</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Beasiswa Yatim atau Piatu</span>
                          <span class="badge-tag-sm blue">Sosial Afirmasi</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Bagi calon siswa dengan <strong>salah satu orang tua (ayah atau ibu) telah wafat</strong>.
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag blue">Berlaku 3 Tahun</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge discount">Potongan 50% / Tahun</span>
                      </td>
                    </tr>

                    <!-- 8. Beasiswa Yatim Piatu -->
                    <tr class="row-free">
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge green">8</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Beasiswa Yatim Piatu</span>
                          <span class="badge-tag-sm green">Bebas Biaya 100%</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Bagi calon siswa yang <strong>kedua orang tuanya telah wafat</strong>. Bebas biaya pendidikan 100% selama 3 tahun.
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag green">Berlaku 3 Tahun Penuh</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge free">Gratis 100% (Bebas Biaya 3 Thn)</span>
                      </td>
                    </tr>

                    <!-- 9. Beasiswa Hafidz 30 Juz -->
                    <tr class="row-free">
                      <td style="text-align: center;">
                        <span class="beasiswa-num-badge green">9</span>
                      </td>
                      <td>
                        <div class="beasiswa-name-cell">
                          <span class="beasiswa-name">Beasiswa Hafidz 30 Juz</span>
                          <span class="badge-tag-sm green">Bebas Biaya 100%</span>
                        </div>
                      </td>
                      <td>
                        <p class="beasiswa-table-desc">
                          Bagi penghafal <strong>Al-Qur'an 30 Juz</strong> dengan syahadah resmi. Bebas biaya pendidikan 100% selama 3 tahun.
                        </p>
                      </td>
                      <td>
                        <span class="beasiswa-period-tag green">Berlaku 3 Tahun Penuh</span>
                      </td>
                      <td style="text-align: right;">
                        <span class="beasiswa-amount-badge free">Gratis 100% (Bebas Biaya 3 Thn)</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
            <a href="tel:0333845605" target="_blank" rel="noopener noreferrer" class="btn btn-primary" style="width: 100%;">
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
              class="btn btn-primary" style="width: 100%;">
              Buka Google Maps
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

@push('scripts')
  <script>
    function switchAlur(mode) {
      const btnOnline = document.getElementById("btn-alur-online");
      const btnOffline = document.getElementById("btn-alur-offline");
      const panelOnline = document.getElementById("alur-panel-online");
      const panelOffline = document.getElementById("alur-panel-offline");

      if (mode === "online") {
        if (btnOnline) btnOnline.classList.add("active");
        if (btnOffline) btnOffline.classList.remove("active");
        if (panelOnline) {
          panelOnline.classList.add("active");
          panelOnline.style.display = "block";
        }
        if (panelOffline) {
          panelOffline.classList.remove("active");
          panelOffline.style.display = "none";
        }
      } else {
        if (btnOffline) btnOffline.classList.add("active");
        if (btnOnline) btnOnline.classList.remove("active");
        if (panelOffline) {
          panelOffline.classList.add("active");
          panelOffline.style.display = "block";
        }
        if (panelOnline) {
          panelOnline.classList.remove("active");
          panelOnline.style.display = "none";
        }
      }

      if (typeof ScrollTrigger !== "undefined") {
        ScrollTrigger.refresh();
      }
    }

    (function () {
      function initSPMBAnimations() {
        if (typeof gsap !== "undefined") {
          if (typeof ScrollTrigger !== "undefined") {
            gsap.registerPlugin(ScrollTrigger);
          }

          // Timeline Progress Bar ScrollTrigger Animation for Online Alur
          const onlineBar = document.getElementById("timeline-bar-online");
          if (onlineBar) {
            gsap.to(onlineBar, {
              height: "100%",
              ease: "none",
              scrollTrigger: {
                trigger: "#timeline-box-online",
                start: "top 75%",
                end: "bottom 70%",
                scrub: 0.5,
              },
            });
          }

          // Timeline Progress Bar ScrollTrigger Animation for Offline Alur
          const offlineBar = document.getElementById("timeline-bar-offline");
          if (offlineBar) {
            gsap.to(offlineBar, {
              height: "100%",
              ease: "none",
              scrollTrigger: {
                trigger: "#timeline-box-offline",
                start: "top 75%",
                end: "bottom 70%",
                scrub: 0.5,
              },
            });
          }
        }

        // FAQ Accordion
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
      }

      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initSPMBAnimations);
      } else {
        initSPMBAnimations();
      }
    })();
  </script>
@endpush

@endsection
