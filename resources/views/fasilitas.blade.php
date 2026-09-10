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
    <span class="badge-header">Sekolah Vokasi Terpadu</span>
    <h1 class="page-title">Infrastruktur &<br />Fasilitas Unggulan.</h1>
    <p class="page-subtitle">
      Lingkungan belajar modern yang didesain khusus untuk mendukung
      pengembangan keterampilan vokasi, kreativitas, dan inovasi peserta
      didik.
    </p>
  </div>
</header>
<!-- 2.5 DENAH & PETA SEKOLAH -->
<section class="map-section" id="denah" data-px-stage="light">
  <div class="container">
    <span class="eyebrow">Denah &amp; Unit Produksi</span>
    <h2 class="map-title">Sekolah yang <em>Bekerja Sungguhan.</em></h2>
    <p class="map-desc">
      Enam unit Teaching Factory di sini melayani pelanggan nyata setiap
      hari — hotel, percetakan, binatu, ritel, hingga layanan keuangan. Klik
      titik pada denah untuk melihat detail tiap lokasi.
    </p>
    <div class="filter-row" role="group" aria-label="Saring jenis lokasi">
      <button class="filter-btn active" data-filter="all" aria-pressed="true">
        Semua Lokasi <span class="count">14</span>
      </button>
      <button class="filter-btn" data-filter="tefa" aria-pressed="false">
        Teaching Factory <span class="count">6</span>
      </button>
      <button class="filter-btn" data-filter="fasilitas" aria-pressed="false">
        Fasilitas Umum <span class="count">8</span>
      </button>
    </div>
    <div class="map-layout">
      <!-- ============ PETA ============ -->
      <div class="map-stage">
        <svg class="campus-svg" viewBox="0 0 1000 800" preserveAspectRatio="xMidYMid meet" role="img"
          aria-label="Denah sekolah SMKS Muhammadiyah 1 Genteng, terdiri dari sekolah utara dan sekolah selatan yang dipisah Jalan KH Ahmad Dahlan">
          <rect x="0" y="0" width="1000" height="800" fill="#fdfdfe" rx="12" />
          <!-- ============ SEKOLAH UTARA ============ -->
          <rect class="campus-outline" x="30" y="40" width="935" height="500" rx="6" />
          <!-- Kolom barat: Ruang 07/12, 06/13, 05/14 -->
          <rect class="blk-room" x="55" y="70" width="58" height="52" rx="3" />
          <text class="lbl" x="84" y="96">07</text>
          <rect class="blk-room" x="117" y="70" width="58" height="52" rx="3" />
          <text class="lbl" x="146" y="96">12</text>
          <rect class="blk-room" x="55" y="126" width="58" height="52" rx="3" />
          <text class="lbl" x="84" y="152">06</text>
          <rect class="blk-room" x="117" y="126" width="58" height="52" rx="3" />
          <text class="lbl" x="146" y="152">13</text>
          <rect class="blk-room" x="55" y="182" width="58" height="52" rx="3" />
          <text class="lbl" x="84" y="208">05</text>
          <rect class="blk-room" x="117" y="182" width="58" height="52" rx="3" />
          <text class="lbl" x="146" y="208">14</text>
          <!-- Kolom barat bawah: Ruang 04-01 + Lab -->
          <rect class="blk-room" x="55" y="248" width="58" height="46" rx="3" />
          <text class="lbl" x="84" y="271">04</text>
          <rect class="blk" x="117" y="248" width="58" height="46" rx="3" />
          <text class="lbl lbl-sm" x="146" y="271">LAB</text>
          <rect class="blk-room" x="55" y="298" width="58" height="46" rx="3" />
          <text class="lbl" x="84" y="321">03</text>
          <rect class="blk" x="117" y="298" width="58" height="46" rx="3" />
          <text class="lbl lbl-sm" x="146" y="321">LAB</text>
          <rect class="blk-room" x="55" y="348" width="58" height="46" rx="3" />
          <text class="lbl" x="84" y="371">02</text>
          <rect class="blk" x="117" y="348" width="58" height="46" rx="3" />
          <text class="lbl lbl-sm" x="146" y="371">LAB</text>
          <rect class="blk-room" x="55" y="398" width="58" height="46" rx="3" />
          <text class="lbl" x="84" y="421">01</text>
          <rect class="blk" x="117" y="398" width="58" height="46" rx="3" />
          <text class="lbl lbl-sm" x="146" y="421">LAB</text>
          <!-- Ruang 15, 16, Mini Office MPLB -->
          <rect class="blk-room" x="55" y="458" width="52" height="50" rx="3" />
          <text class="lbl" x="81" y="483">15</text>
          <rect class="blk-room" x="111" y="458" width="52" height="50" rx="3" />
          <text class="lbl" x="137" y="483">16</text>
          <rect class="blk" x="167" y="458" width="70" height="50" rx="3" />
          <text class="lbl lbl-sm" x="202" y="476">MINI OFFICE</text>
          <text class="lbl lbl-sm" x="202" y="490">MPLB</text>
          <text class="lbl-zone" x="55" y="528">Parkir Guru</text>
          <!-- Ruang 08/10, 09/11 -->
          <rect class="blk-room" x="200" y="80" width="52" height="50" rx="3" />
          <text class="lbl" x="226" y="105">08</text>
          <rect class="blk-room" x="256" y="80" width="52" height="50" rx="3" />
          <text class="lbl" x="282" y="105">10</text>
          <rect class="blk-room" x="200" y="134" width="52" height="50" rx="3" />
          <text class="lbl" x="226" y="159">09</text>
          <rect class="blk-room" x="256" y="134" width="52" height="50" rx="3" />
          <text class="lbl" x="282" y="159">11</text>
          <!-- Masjid Namiroh -->
          <rect class="blk" x="322" y="80" width="88" height="104" rx="4" />
          <text class="lbl" x="366" y="126">MASJID</text>
          <text class="lbl lbl-sm" x="366" y="142">Namiroh</text>
          <!-- Lab BDP & R. Pembayaran -->
          <rect class="blk" x="422" y="80" width="56" height="50" rx="3" />
          <text class="lbl lbl-sm" x="450" y="105">LAB BDP</text>
          <rect class="blk" x="422" y="134" width="56" height="50" rx="3" />
          <text class="lbl lbl-sm" x="450" y="153">R. Pem-</text>
          <text class="lbl lbl-sm" x="450" y="166">bayaran</text>
          <!-- R. Kepala Sekolah & Tata Usaha -->
          <rect class="blk" x="492" y="80" width="94" height="50" rx="3" />
          <text class="lbl lbl-sm" x="539" y="99">R. KEPALA</text>
          <text class="lbl lbl-sm" x="539" y="112">SEKOLAH</text>
          <rect class="blk" x="492" y="134" width="94" height="50" rx="3" />
          <text class="lbl lbl-sm" x="539" y="153">TATA</text>
          <text class="lbl lbl-sm" x="539" y="166">USAHA</text>
          <!-- UKS & Sekretariat -->
          <rect class="blk" x="200" y="200" width="72" height="56" rx="3" />
          <text class="lbl lbl-sm" x="236" y="222">RUANG</text>
          <text class="lbl lbl-sm" x="236" y="236">UKS</text>
          <rect class="blk" x="282" y="200" width="150" height="56" rx="3" />
          <text class="lbl lbl-sm" x="357" y="222">R. SEKRETARIAT</text>
          <text class="lbl lbl-sm" x="357" y="236">STS</text>
          <!-- Lapangan utama -->
          <rect class="field" x="212" y="278" width="220" height="140" rx="6" />
          <circle cx="322" cy="348" r="26" fill="none" stroke="#dbeafe" stroke-width="1.5" />
          <text class="lbl-zone" x="322" y="352" text-anchor="middle">
            Lapangan Utama
          </text>
          <!-- Perpustakaan, Koperasi, Pos -->
          <rect class="blk" x="248" y="440" width="104" height="50" rx="3" />
          <text class="lbl lbl-sm" x="300" y="465">R. PERPUSTAKAAN</text>
          <rect class="blk" x="358" y="440" width="60" height="50" rx="3" />
          <text class="lbl lbl-sm" x="388" y="465">R. KOPERASI</text>
          <rect class="blk" x="428" y="458" width="40" height="32" rx="3" />
          <text class="lbl lbl-sm" x="448" y="474">POS</text>
          <!-- Kolom tengah-timur: MBG, BP, Lab, 17-19 -->
          <rect class="blk" x="556" y="200" width="66" height="46" rx="3" />
          <text class="lbl lbl-sm" x="589" y="223">R. MBG</text>
          <rect class="blk" x="556" y="250" width="66" height="56" rx="3" />
          <text class="lbl lbl-sm" x="589" y="271">R. BP /</text>
          <text class="lbl lbl-sm" x="589" y="285">PRAKERIN</text>
          <rect class="blk" x="556" y="310" width="66" height="46" rx="3" />
          <text class="lbl lbl-sm" x="589" y="333">RUANG LAB</text>
          <rect class="blk-room" x="556" y="360" width="66" height="46" rx="3" />
          <text class="lbl" x="589" y="383">17</text>
          <rect class="blk-room" x="556" y="410" width="66" height="46" rx="3" />
          <text class="lbl" x="589" y="433">18</text>
          <rect class="blk-room" x="556" y="460" width="66" height="46" rx="3" />
          <text class="lbl" x="589" y="483">19</text>
          <!-- Kolom Aula -->
          <rect class="blk" x="628" y="200" width="52" height="206" rx="3" />
          <text class="lbl" x="654" y="303" transform="rotate(-90 654 303)">
            AULA
          </text>
          <!-- R. OSIS & lapangan kecil -->
          <rect class="blk" x="692" y="290" width="56" height="44" rx="3" />
          <text class="lbl lbl-sm" x="720" y="312">R. OSIS</text>
          <rect class="field" x="692" y="342" width="80" height="92" rx="4" />
          <text class="lbl-zone" x="732" y="392" text-anchor="middle">
            Lap.
          </text>
          <!-- Blok R. Kelas timur -->
          <rect class="blk-room" x="786" y="330" width="60" height="48" rx="3" />
          <text class="lbl lbl-sm" x="816" y="354">R.Kelas</text>
          <rect class="blk-room" x="850" y="330" width="60" height="48" rx="3" />
          <text class="lbl lbl-sm" x="880" y="354">R.Kelas</text>
          <rect class="blk-room" x="786" y="382" width="60" height="48" rx="3" />
          <text class="lbl lbl-sm" x="816" y="406">R.Kelas</text>
          <rect class="blk-room" x="850" y="382" width="60" height="48" rx="3" />
          <text class="lbl lbl-sm" x="880" y="406">R.Kelas</text>
          <!-- Deret unit produksi tenggara -->
          <rect class="blk" x="628" y="462" width="56" height="46" rx="3" />
          <text class="lbl lbl-sm" x="656" y="485">BMS</text>
          <rect class="blk" x="688" y="462" width="60" height="46" rx="3" />
          <text class="lbl lbl-sm" x="718" y="479">PEGA-</text>
          <text class="lbl lbl-sm" x="718" y="492">DAIAN</text>
          <rect class="blk" x="752" y="462" width="62" height="46" rx="3" />
          <text class="lbl lbl-sm" x="783" y="479">SURYA</text>
          <text class="lbl lbl-sm" x="783" y="492">MART</text>
          <rect class="blk" x="818" y="462" width="62" height="46" rx="3" />
          <text class="lbl lbl-sm" x="849" y="479">TEFA</text>
          <text class="lbl lbl-sm" x="849" y="492">DKV</text>
          <!-- Ruang RPS (timur laut) -->
          <rect class="blk" x="880" y="70" width="70" height="52" rx="3" />
          <text class="lbl lbl-sm" x="915" y="96">RPS 1</text>
          <rect class="blk" x="880" y="126" width="70" height="52" rx="3" />
          <text class="lbl lbl-sm" x="915" y="152">RPS 2</text>
          <rect class="blk" x="880" y="182" width="70" height="52" rx="3" />
          <text class="lbl lbl-sm" x="915" y="208">RPS 3</text>
          <!-- Label zona parkir -->
          <text class="lbl-zone" x="600" y="68">Parkir Siswa</text>
          <text class="lbl-zone" x="470" y="196">
            Parkir Guru &amp; Karyawan
          </text>
          <text class="lbl-zone" x="790" y="290">Parkir Siswa</text>
          <!-- ============ JALAN ============ -->
          <text class="lbl-zone" x="500" y="556" text-anchor="middle">
            Jl. KH. Ahmad Dahlan
          </text>
          <rect class="road" x="0" y="566" width="1000" height="40" />
          <line class="road-dash" x1="0" y1="586" x2="1000" y2="586" />
          <!-- ============ SEKOLAH SELATAN ============ -->
          <rect class="campus-outline" x="255" y="630" width="530" height="150" rx="6" />
          <rect class="blk" x="278" y="646" width="94" height="24" rx="3" />
          <text class="lbl lbl-sm" x="325" y="658">BALAI BALAI</text>
          <rect class="blk" x="278" y="678" width="68" height="38" rx="3" />
          <text class="lbl lbl-sm" x="312" y="692">LAB.</text>
          <text class="lbl lbl-sm" x="312" y="705">LAUNDRY</text>
          <rect class="blk" x="278" y="722" width="68" height="36" rx="3" />
          <text class="lbl lbl-sm" x="312" y="740">BALLROOM</text>
          <rect class="blk" x="420" y="690" width="120" height="68" rx="4" />
          <text class="lbl lbl-sm" x="480" y="724">MUSHOLLA</text>
          <rect class="blk" x="600" y="658" width="104" height="32" rx="3" />
          <text class="lbl lbl-sm" x="652" y="669">FRONT OFFICE</text>
          <text class="lbl lbl-sm" x="652" y="682">eDOTEL</text>
          <rect class="blk" x="600" y="698" width="104" height="22" rx="3" />
          <text class="lbl lbl-sm" x="652" y="709">HOME STAY 1</text>
          <rect class="blk" x="600" y="724" width="104" height="22" rx="3" />
          <text class="lbl lbl-sm" x="652" y="735">HOME STAY 2</text>
          <rect class="blk" x="600" y="750" width="104" height="22" rx="3" />
          <text class="lbl lbl-sm" x="652" y="761">HOME STAY 3</text>
          <text class="lbl-zone" x="418" y="666">Area Parkir Tamu</text>
          <!-- Kompas -->
          <g transform="translate(120 700)">
            <path d="M0 -26 L6 0 L0 26 L-6 0 Z" fill="#1e40af" />
            <path d="M-26 0 L0 -6 L26 0 L0 6 Z" fill="#cbd5e1" />
            <text class="lbl" x="0" y="-36">U</text>
            <text class="lbl" x="0" y="38">S</text>
            <text class="lbl" x="-38" y="0">B</text>
            <text class="lbl" x="38" y="0">T</text>
          </g>
          <!-- ===== HOTSPOT ===== -->
          <g id="hotspot-layer"></g>
        </svg>
        <div class="map-legend">
          <span class="legend-item">
            <span class="legend-dot" style="background: var(--secondary)"></span>
            Teaching Factory (unit produksi)
          </span>
          <span class="legend-item">
            <span class="legend-dot" style="background: var(--primary)"></span>
            Fasilitas penunjang
          </span>
        </div>
      </div>
      <!-- ============ PANEL DETAIL ============ -->
      <div class="detail-panel" id="panel" aria-live="polite">
        <div class="panel-empty" id="panelEmpty">
          <div>
            <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M9 20l-5.5 2.5V6L9 3.5m0 16.5l6-2.5M9 20V3.5m6 14l5.5 2.5V4L15 6.5m0 11V6.5m0 0L9 3.5" />
              <circle cx="12" cy="10" r="1.6" />
            </svg>
            <p>
              Pilih salah satu titik pada denah untuk melihat detail
              lokasinya.
            </p>
          </div>
        </div>
        <div id="panelContent" hidden></div>
      </div>
    </div>
    <div class="index-list">
      <span class="eyebrow" style="margin-bottom: 0">Daftar Lengkap</span>
      <div class="index-grid" id="indexGrid"></div>
    </div>
  </div>
</section>
<!-- 3. TEFA SECTION (Featured) -->
<section class="tefa-section">
  <div class="watermark">TEFA</div>
  <div class="container tefa-grid">
    <div class="">
      <div class="visi-label" style="
              background: rgba(234, 179, 8, 0.2);
              color: var(--secondary-light);
            ">
        Standar Industri
      </div>
      <h2 class="tefa-title font-head">
        Teaching Factory (TEFA)<br />Terlengkap.
      </h2>
      <p class="tefa-desc">
        SMKS Muhammadiyah 1 Genteng merupakan sekolah dengan Tefa
        terlengkap. Setiap kompetensi keahlian dilengkapi ruang produksi
        mandiri yang beroperasi mematuhi standar industri sesungguhnya.
        Memberikan siswa pengalaman praktik langsung di bawah bimbingan
        Dudika (Dunia Usaha Dunia Industri) terkait.
      </p>
    </div>
    <div class="tefa-list">
      <div class="tefa-item" onclick="openItemModal('tefa-printing')">
        <span class="tefa-number">01</span>
        <div>
          <strong style="font-family: var(--font-head); font-size: 1.1rem">Tefa SMEMSA Printing</strong><br />
          <span style="font-size: 0.9rem; opacity: 0.85">Desain Komunikasi Visual (DKV)</span>
        </div>
      </div>
      <div class="tefa-item" onclick="openItemModal('tefa-edotel')">
        <span class="tefa-number">02</span>
        <div>
          <strong style="font-family: var(--font-head); font-size: 1.1rem">Edotel SMEMSA & Sun Wash
            Laundry</strong><br />
          <span style="font-size: 0.9rem; opacity: 0.85">Perhotelan</span>
        </div>
      </div>
      <div class="tefa-item" onclick="openItemModal('tefa-pegadaian')">
        <span class="tefa-number">03</span>
        <div>
          <strong style="font-family: var(--font-head); font-size: 1.1rem">Agen Pegadaian Mentari</strong><br />
          <span style="font-size: 0.9rem; opacity: 0.85">Manajemen Perkantoran (MPLB)</span>
        </div>
      </div>
      <div class="tefa-item" onclick="openItemModal('tefa-bank')">
        <span class="tefa-number">04</span>
        <div>
          <strong style="font-family: var(--font-head); font-size: 1.1rem">Bank Mini Sekolah (BMS) BTM</strong><br />
          <span style="font-size: 0.9rem; opacity: 0.85">Akuntansi dan Keuangan (AKL)</span>
        </div>
      </div>
      <div class="tefa-item" onclick="openItemModal('tefa-tekaje')">
        <span class="tefa-number">05</span>
        <div>
          <strong style="font-family: var(--font-head); font-size: 1.1rem">Tefa Tekaje Solution</strong><br />
          <span style="font-size: 0.9rem; opacity: 0.85">Teknik Komputer dan Jaringan (TJKT)</span>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- 4. FASILITAS GRID -->
<section class="section-padding container" data-px-stage="subtle">
  <div class="text-center">
    <span class="badge-header">Sarana Penunjang</span>
    <h2 class="font-display" style="
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-top: 0.5rem;
          ">
      Fasilitas Sekolah Unggulan
    </h2>
  </div>
  <div class="fasilitas-grid">
    <!-- Lab Komputer -->
    <div class="fac-card" onclick="openItemModal('fac-lab')">
      <div class="fac-icon-wrapper">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
          <line x1="8" y1="21" x2="16" y2="21"></line>
          <line x1="12" y1="17" x2="12" y2="21"></line>
        </svg>
      </div>
      <h3>Laboratorium Komputer</h3>
      <p>
        Dilengkapi dengan perangkat komputer terkini yang mendukung proses
        pembelajaran IT. Tempat ideal bagi siswa untuk praktik pemrograman,
        desain grafis, jaringan, dan penguasaan aplikasi perangkat lunak.
      </p>
    </div>
    <!-- Studio Desain -->
    <div class="fac-card" onclick="openItemModal('fac-studio')">
      <div class="fac-icon-wrapper">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
          <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
          <path d="M2 2l7.586 7.586"></path>
          <circle cx="11" cy="11" r="2"></circle>
        </svg>
      </div>
      <h3>Studio Desain & Multimedia</h3>
      <p>
        Ruang kreatif yang dirancang khusus dengan peralatan multimedia
        terkini. Lingkungan yang kondusif bagi siswa DKV untuk bereksplorasi
        dalam ilustrasi, animasi, dan produksi media visual profesional.
      </p>
    </div>
    <!-- Perpustakaan -->
    <div class="fac-card" onclick="openItemModal('fac-perpus')">
      <div class="fac-icon-wrapper">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
          <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
        </svg>
      </div>
      <h3>Perpustakaan Digital</h3>
      <p>
        Pusat sumber belajar dengan koleksi buku dan jurnal yang
        komprehensif. Selain literatur cetak, perpustakaan ini juga
        menyediakan akses penuh ke sumber daya digital dan internet untuk
        riset mendalam.
      </p>
    </div>
    <!-- Wi-Fi (Wide Card) -->
    <div class="fac-card wide" onclick="openItemModal('fac-wifi')">
      <div class="fac-icon-wrapper" style="margin-bottom: 0">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
          <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
          <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
          <line x1="12" y1="20" x2="12.01" y2="20"></line>
        </svg>
      </div>
      <div>
        <h3>Konektivitas Wi-Fi Berkecepatan Tinggi</h3>
        <p>
          Mendukung proses pembelajaran digital (e-learning) tanpa batas.
          Jaringan Wi-Fi berkecepatan tinggi tersedia di seluruh area kelas
          maupun lingkungan sekolah, dapat diakses penuh oleh siswa dan staf
          agar senantiasa terhubung dengan teknologi dan sumber literasi
          global terkini.
        </p>
      </div>
    </div>
    <!-- Sarana Olahraga -->
    <div class="fac-card" onclick="openItemModal('fac-sport')">
      <div class="fac-icon-wrapper">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
          <line x1="9" y1="9" x2="9.01" y2="9"></line>
          <line x1="15" y1="9" x2="15.01" y2="9"></line>
        </svg>
      </div>
      <h3>Sarana Olahraga Terpadu</h3>
      <p>
        Wadah pengembangan minat dan bakat fisik siswa. Kami menyediakan
        infrastruktur lengkap meliputi Lapangan Basket, Futsal, Bola Voli,
        Badminton, hingga fasilitas Tenis Meja.
      </p>
    </div>
    <!-- SMEMSA Ball Room -->
    <div class="fac-card" onclick="openItemModal('fac-ballroom')">
      <div class="fac-icon-wrapper">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path
            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
          </path>
          <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
          <line x1="12" y1="22.08" x2="12" y2="12"></line>
        </svg>
      </div>
      <h3>SMEMSA Ball Room & Convention</h3>
      <p>
        Ruang serbaguna representatif yang terintegrasi di kompleks
        perhotelan sekolah. Ideal dan sering digunakan untuk pelaksanaan
        meeting, seminar, rapat, maupun kegiatan seremonial formal lainnya.
      </p>
    </div>
  </div>
</section>

<!-- 6. INTERACTIVE DETAIL MODAL -->
<div class="modal-overlay" id="facility-modal-overlay" onclick="closeItemModalOnOverlay(event)">
  <div class="facility-modal-card" id="facility-modal-card">
    <!-- Modal Header Banner -->
    <div class="modal-banner" id="modal-banner">
      <div class="modal-banner-icon" id="modal-icon">🏢</div>
      <button class="modal-close-btn" onclick="closeItemModal()" aria-label="Tutup Detail">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
          <path d="M18 6 6 18" />
          <path d="m6 6 12 12" />
        </svg>
      </button>
    </div>
    <!-- Modal Content Body -->
    <div class="modal-body">
      <span class="modal-tag" id="modal-tag">FASILITAS UNGGULAN</span>
      <h3 class="modal-title" id="modal-title">Nama Fasilitas</h3>
      <p class="modal-desc" id="modal-desc">
        Deskripsi detail fasilitas sekolah.
      </p>
      <div class="modal-features-box">
        <div class="modal-section-title">
          Spesifikasi & Keunggulan Fasilitas:
        </div>
        <div class="modal-chips-row" id="modal-features">
          <!-- Chips dynamically rendered -->
        </div>
      </div>
      <div class="modal-highlight-box">
        <div class="modal-section-title" style="color: var(--primary); margin-bottom: 0.4rem">
          Nilai Tambah Pembelajaran:
        </div>
        <div class="modal-highlight-text" id="modal-highlight">
          Informasi nilai tambah.
        </div>
      </div>
      <div class="modal-footer-cta">
        <span style="font-size: 0.85rem; color: var(--text-muted)">Sekolah Berstandar Industri &bull;
          <strong>SMEMSA Genteng</strong></span>
        <a href="/spmb" class="btn-primary" style="text-decoration: none">
          Daftar & Rasakan Fasilitasnya &rarr;
        </a>
      </div>
    </div>
  </div>
</div>
<!-- 13. FOOTER -->

@endsection