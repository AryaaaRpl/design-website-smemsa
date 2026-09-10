@extends('layouts.app')

@section('content')

  <!-- 2. PAGE HEADER -->
  <header class="page-header">
    <svg class="header-bg-pattern" viewBox="0 0 100 100">
      <rect x="20" y="20" width="60" height="60" fill="none" stroke="var(--primary)" stroke-width="2"
        transform="rotate(45 50 50)" />
      <circle cx="50" cy="50" r="15" fill="none" stroke="var(--secondary)" stroke-width="2" />
    </svg>
    <div class="container">
      <div style="
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.4rem 1rem;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--secondary-light);
            margin-bottom: 1.2rem;
          ">
        Penyaluran Lulusan & Karir Alumni
      </div>
      <h1 class="page-title">
        Bursa Kerja Khusus (BKK)<br />SMKS Muhammadiyah 1 Genteng
      </h1>
      <p class="page-subtitle">
        Jembatan karir terpercaya yang menghubungkan alumni dan peserta didik
        dengan ratusan lowongan kerja di mitra industri & DUDIKA terkemuka
        secara nasional.
      </p>
    </div>
  </header>

  <!-- 3. MAIN CONTENT BKK -->
  <section class="section-padding">
    <div class="container">
      <!-- BKK Impact Summary Banner -->
      <div class="bkk-summary-banner">
        <div class="bkk-summary-number">
          <span>92.4%</span>
        </div>
        <div class="bkk-summary-text">
          <h3>Tingkat Keterserapan Alumni SMEMSA</h3>
          <p>
            Sebanyak <strong>450+ lulusan tahun terakhir</strong> langsung
            terserap kerja di mitra DUDIKA, berwirausaha mandiri lewat BLUD,
            dan melanjutkan studi ke perguruan tinggi negeri/swasta ternama.
          </p>
        </div>
      </div>

      <!-- BKK Key Statistics -->
      <div class="bkk-stats-grid">
        <div class="stat-card">
          <div class="stat-value">120+</div>
          <div class="stat-label">Mitra DUDI & Industri</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">92.4%</div>
          <div class="stat-label">Alumni Terserap Kerja</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">85+</div>
          <div class="stat-label">Lowongan Kerja Per Tahun</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">100%</div>
          <div class="stat-label">Fasilitasi Rekrutmen Direct</div>
        </div>
      </div>

      <!-- Section Title for Job Portal -->
      <div class="text-center" style="margin-bottom: 2.5rem">
        <span class="badge badge-primary mb-2">Portal Lowongan Kerja BKK</span>
        <h2 class="font-head" style="
              font-size: 2.2rem;
              color: var(--primary-dark);
              margin-top: 0.5rem;
            ">
          Informasi Loker & Magang Terkini
        </h2>
        <p style="
              color: var(--text-muted);
              max-width: 650px;
              margin: 0.5rem auto 0;
            ">
          Daftar lowongan kerja resmi yang diverifikasi langsung oleh Tim BKK
          SMKS Muhammadiyah 1 Genteng.
        </p>
      </div>

      <!-- BKK Table Card -->
      <div class="bkk-table-card">
        <div class="bkk-table-header">
          <div>Perusahaan Mitra</div>
          <div>Posisi Pekerjaan</div>
          <div>Tipe</div>
          <div>Status</div>
          <div>Aksi</div>
        </div>

        <!-- Job 1 -->
        <div class="bkk-table-row">
          <div>
            <strong style="
                  color: var(--primary);
                  font-size: 1.05rem;
                  display: block;
                ">PT Digital Kreatif Nusantara</strong>
            <small style="color: var(--text-muted)">Surabaya / Banyuwangi</small>
          </div>
          <div style="font-weight: 600">Junior Web Developer</div>
          <div><span class="skill-tag">Full-time</span></div>
          <div>
            <span class="badge badge-primary" style="font-size: 0.75rem">Dibuka</span>
          </div>
          <div>
            <a href="https://wa.me/6282241356668?text=Halo%20BKK%20SMK%20MUHI,%20saya%20tertarik%20melamar%20Junior%20Web%20Developer"
              target="_blank" style="
                  color: var(--secondary);
                  font-weight: 700;
                  font-size: 0.9rem;
                ">Lamar Loker &rarr;</a>
          </div>
        </div>

        <!-- Job 2 -->
        <div class="bkk-table-row">
          <div>
            <strong style="
                  color: var(--primary);
                  font-size: 1.05rem;
                  display: block;
                ">Hotel Ketapang Indah</strong>
            <small style="color: var(--text-muted)">Banyuwangi</small>
          </div>
          <div style="font-weight: 600">PKL Perhotelan & Tata Boga</div>
          <div><span class="skill-tag">Magang / PKL</span></div>
          <div>
            <span class="badge badge-primary" style="font-size: 0.75rem">Dibuka</span>
          </div>
          <div>
            <a href="https://wa.me/6282241356668?text=Halo%20BKK%20SMK%20MUHI,%20saya%20tertarik%20melamar%20PKL%20Perhotelan"
              target="_blank" style="
                  color: var(--secondary);
                  font-weight: 700;
                  font-size: 0.9rem;
                ">Lamar Loker &rarr;</a>
          </div>
        </div>

        <!-- Job 3 -->
        <div class="bkk-table-row">
          <div>
            <strong style="
                  color: var(--primary);
                  font-size: 1.05rem;
                  display: block;
                ">Bank Jatim Syariah Genteng</strong>
            <small style="color: var(--text-muted)">Genteng, Banyuwangi</small>
          </div>
          <div style="font-weight: 600">Staff Administrasi Operasional</div>
          <div><span class="skill-tag">Full-time</span></div>
          <div>
            <span class="badge badge-primary" style="font-size: 0.75rem">Dibuka</span>
          </div>
          <div>
            <a href="https://wa.me/6282241356668?text=Halo%20BKK%20SMK%20MUHI,%20saya%20tertarik%20melamar%20Staff%20Administrasi"
              target="_blank" style="
                  color: var(--secondary);
                  font-weight: 700;
                  font-size: 0.9rem;
                ">Lamar Loker &rarr;</a>
          </div>
        </div>

        <!-- Job 5 -->
        <div class="bkk-table-row">
          <div>
            <strong style="
                  color: var(--primary);
                  font-size: 1.05rem;
                  display: block;
                ">PT Telkom Indonesia (Witel Jatim)</strong>
            <small style="color: var(--text-muted)">Jember / Banyuwangi</small>
          </div>
          <div style="font-weight: 600">Teknisi Jaringan & Fiber Optik</div>
          <div><span class="skill-tag">Full-time</span></div>
          <div>
            <span class="badge badge-primary" style="font-size: 0.75rem">Dibuka</span>
          </div>
          <div>
            <a href="https://wa.me/6282241356668?text=Halo%20BKK%20SMK%20MUHI,%20saya%20tertarik%20melamar%20Teknisi%20Jaringan"
              target="_blank" style="
                  color: var(--secondary);
                  font-weight: 700;
                  font-size: 0.9rem;
                ">Lamar Loker &rarr;</a>
          </div>
        </div>
      </div>

      <!-- LAYANAN UNGGULAN BKK -->
      <div style="margin-top: 5rem">
        <div class="text-center">
          <span class="badge badge-primary mb-2">Program & Fasilitas BKK</span>
          <h2 class="font-head" style="
                font-size: 2.2rem;
                color: var(--primary-dark);
                margin-top: 0.5rem;
              ">
            Layanan Karir Komprehensif
          </h2>
          <p style="
                color: var(--text-muted);
                max-width: 650px;
                margin: 0.5rem auto 0;
              ">
            BKK SMKS Muhammadiyah 1 Genteng membekali siswa sejak bangku
            sekolah hingga siap kerja di dunia industri.
          </p>
        </div>

        <div class="service-grid">
          <div class="service-card">
            <h3>Penyaluran Kerja Direct</h3>
            <p>
              Rekrutmen sekolah langsung (Campus Recruitment) bekerjasama
              dengan puluhan perusahan DUDI terkemuka nasional.
            </p>
          </div>
          <div class="service-card">
            <div class="service-icon">📝</div>
            <h3>Bimbingan Karir & CV Workshop</h3>
            <p>
              Pelatihan pembuatan CV profesional, portofolio digital, dan
              psikotes kerja bagi seluruh calon lulusan.
            </p>
          </div>
          <div class="service-card">
            <div class="service-icon">🎙️</div>
            <h3>Simulasi Interview Kerja</h3>
            <p>
              Sesi wawancara kerja tiruan dengan instruktur industri agar
              alumni percaya diri saat menghadapi HRD perusahaan.
            </p>
          </div>
          <div class="service-card">
            <div class="service-icon">🏢</div>
            <h3>Program Praktik Kerja Lapangan (PKL)</h3>
            <p>
              Penempatan magang terstruktur di Teaching Factory dan industri
              mitra sesuai bidang kompetensi masing-masing.
            </p>
          </div>
        </div>
      </div>

      <!-- MITRA PERUSAHAAN UTAMA -->
      <div style="margin-top: 5rem">
        <div class="text-center">
          <span class="badge badge-amber mb-2">DUDIKA Partner</span>
          <h2 class="font-head" style="
                font-size: 2.2rem;
                color: var(--primary-dark);
                margin-top: 0.5rem;
              ">
            Perusahaan Mitra Industri Utama
          </h2>
          <p style="
                color: var(--text-muted);
                max-width: 650px;
                margin: 0.5rem auto 0;
              ">
            Jaringan kemitraan strategis SMEMSA Genteng bersama institusi
            dan korporasi terkemuka.
          </p>
        </div>

        <div class="mitra-grid">
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/semesta.webp') }}"
                alt="PT. Semesta Multitekno"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>PT. Semesta Multitekno</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/11.jpg') }}" alt="PT. Hummatech"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>PT. Hummatech</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/3.jpg') }}" alt="CircleK"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>CircleK</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/10.jpg') }}"
                alt="TERAS Hotel & Villa"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>TERAS Hotel & Villa</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/22.jpg') }}" alt="KDS Genteng"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>KDS Genteng</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/12.jpg') }}"
                alt="Gold Vitel Surabaya"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Gold Vitel Surabaya</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/2.jpg') }}"
                alt="Deles Spesial Teh Tarik"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Deles Spesial Teh Tarik</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/1.jpg') }}" alt="Rays Hotel VIP"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Rays Hotel VIP</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/4.jpg') }}" alt="PT. Indo Bismar"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>PT. Indo Bismar</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/5.jpg') }}" alt="Ayu Printing"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Ayu Printing</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/6.jpg') }}" alt="Bank BTPN"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Bank BTPN</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/7.jpg') }}" alt="Pegadaian"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Pegadaian</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/8.jpg') }}"
                alt="Pacific Indonesia"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Pacific Indonesia</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/9.jpg') }}"
                alt="LPK Nusantara Gakkou"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>LPK Nusantara Gakkou</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/13.jpg') }}" alt="Alfamart"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Alfamart</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/14.jpg') }}"
                alt="Juragan Tas Online"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Juragan Tas Online</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/15.jpg') }}"
                alt="MicroTik Academy"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>MicroTik Academy</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/16.jpg') }}"
                alt="PT. Sumber Alam Santoso Pratama"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>PT. Sumber Alam Santoso Pratama</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/17.jpg') }}" alt="New Surya Hotel"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>New Surya Hotel</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/18.jpg') }}" alt="Indomaret"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Indomaret</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/19.jpg') }}" alt="BTN"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>BTN</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/20.jpg') }}" alt="Bank Muamalat"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Bank Muamalat</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/21.jpg') }}" alt="YAMAHA"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>YAMAHA</h4>
            </div>
          </div>
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ asset('assets/mitra/23.jpg') }}"
                alt="Surya Mart SMKS Muhammadiyah 1 Genteng"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>Surya Mart SMKS Muhammadiyah 1 Genteng</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. FOOTER -->

@endsection
