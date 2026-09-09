@extends('layouts.app')

@section('content')

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
          <a href="{{ url('/#jurusan') }}" class="btn-gold">
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

@push('scripts')
  <script>
    /* ---------- 1. SKEMA SERTIFIKASI ---------- */
    const SKEMA = [
      {
        nama: "KKNI Level II pada Kompetensi Keahlian Teknik Komputer dan Jaringan",
        jurusan: "TJKT",
        kode: "SS.TJKT.02",
        acuan: "SKKNI 2018",
        units: [
          "Merakit Komputer",
          "Melakukan Instalasi Sistem Operasi",
          "Mengkonfigurasi Jaringan Komputer",
          "Mendiagnosis Permasalahan Jaringan",
          "Melakukan Perbaikan Jaringan",
        ],
        catatan: "Peserta uji wajib membawa laptop saat asesmen.",
      },
      {
        nama: "KKNI Level II pada Kompetensi Keahlian Manajemen Perkantoran dan Layanan Bisnis",
        jurusan: "MPLB",
        kode: "SS.MPLB.02",
        acuan: "SKKNI 2019",
        units: [
          "Mengelola Dokumen Perkantoran",
          "Melakukan Komunikasi di Tempat Kerja",
          "Mengoperasikan Aplikasi Perkantoran",
          "Menyusun Agenda Kegiatan",
          "Memberikan Layanan Pelanggan",
        ],
        catatan: "Asesmen menggunakan aplikasi simulasi perkantoran.",
      },
      {
        nama: "KKNI Level II pada Kompetensi Keahlian Perhotelan",
        jurusan: "Perhotelan",
        kode: "SS.PH.02",
        acuan: "SKKNI 2018",
        units: [
          "Menyediakan Layanan Housekeeping",
          "Melayani Tamu di Front Office",
          "Menyiapkan Kamar Tamu",
          "Menangani Keluhan Pelanggan",
          "Mengoperasikan Sistem Informasi Hotel",
        ],
        catatan: "Dilakukan di Edohotel SMEMSA.",
      },
      {
        nama: "KKNI Level II pada Kompetensi Keahlian Desain Komunikasi Visual",
        jurusan: "DKV",
        kode: "SS.DKV.02",
        acuan: "SKKNI 2019",
        units: [
          "Mengoperasikan Perangkat Lunak Desain",
          "Membuat Karya Desain Grafis",
          "Melakukan Teknik Fotografi",
          "Membuat Animasi 2D/3D",
          "Menyusun Konsep Visual",
        ],
        catatan: "Portofolio karya wajib dikumpulkan sebelum hari H.",
      },
      {
        nama: "KKNI Level II pada Kompetensi Keahlian Bisnis Digital",
        jurusan: "Bisnis Digital",
        kode: "SS.BD.02",
        acuan: "SKKNI 2020",
        units: [
          "Melakukan Pemasaran Digital",
          "Mengelola Toko Online",
          "Membuat Konten Pemasaran",
          "Melayani Transaksi E-commerce",
          "Menganalisis Data Penjualan",
        ],
        catatan: "Uji praktik dilakukan dengan studi kasus nyata.",
      },
      {
        nama: "KKNI Level II pada Kompetensi Keahlian Pengembang Perangkat Lunak & Gim",
        jurusan: "PPLG",
        kode: "SS.PPLG.02",
        acuan: "SKKNI 2018",
        units: [
          "Membuat Dokumen Kode Program",
          "Melakukan Pengkodean Terstruktur",
          "Mengoperasikan Basis Data",
          "Membuat Antarmuka Aplikasi",
          "Melakukan Pengujian Aplikasi",
        ],
        catatan: "Studi kasus berupa pengembangan aplikasi CRUD.",
      },
      {
        nama: "KKNI Level II pada Kompetensi Keahlian Akuntansi dan Keuangan Lembaga",
        jurusan: "AKL",
        kode: "SS.AKL.02",
        acuan: "SKKNI 2019",
        units: [
          "Mengelola Jurnal Akuntansi",
          "Menyusun Laporan Keuangan",
          "Mengoperasikan Aplikasi Akuntansi (MYOB)",
          "Melakukan Rekonsiliasi Bank",
          "Menghitung Pajak Dasar",
        ],
        catatan: "Uji kompetensi menggunakan aplikasi MYOB Accounting.",
      },
    ];

    /* ---------- 2. ALUR ASESMEN ---------- */
    const ALUR = [
      {
        judul: "Pendaftaran",
        desc: "Peserta didik mendaftar melalui sekolah dan melengkapi berkas persyaratan.",
      },
      {
        judul: "Asesmen Mandiri",
        desc: "Peserta menilai kesiapan dirinya terhadap setiap unit kompetensi bersama asesor.",
      },
      {
        judul: "Uji Kompetensi",
        desc: "Pelaksanaan asesmen di TUK melalui praktik, observasi, dan wawancara.",
      },
      {
        judul: "Keputusan Asesmen",
        desc: "Asesor memutuskan status kompeten atau belum kompeten berdasarkan bukti.",
      },
      {
        judul: "Penerbitan Sertifikat",
        desc: "Sertifikat kompetensi berlogo Garuda diterbitkan dan berlaku nasional.",
      },
    ];

    /* ---------- 3. ASESOR KOMPETENSI ---------- */
    const ASESOR = [
      {
        nama: "Wahid Wahyudi, S.E, M.M",
        bidang: "Kepala Sekolah",
        reg: "MET.000.004187 2021",
        foto: "{{ asset('assets/PAK-WAHID-AI-e1781064934191.png') }}",
      },
      {
        nama: "Aan Cahyanto Sri Setyo, M.Pd",
        bidang: "Wakil Kepala Sekolah",
        reg: "MET.000.004191 2021",
        foto: "{{ asset('assets/guru/kategori-pimpinan/WAKIL KS - Aan Cahyanto Sri Setyo, M.Pd.webp') }}",
      },
      {
        nama: "Teguh Santosa, S.Kom",
        bidang: "Teknik Jaringan Komputer & Telekomunikasi",
        reg: "MET.000.004195 2021",
        foto: "{{ asset('assets/guru/kategori-k3/Teguh Santosa, S.Kom.webp') }}",
      },
      {
        nama: "Wuri Handayani, S.E",
        bidang: "Bendahara Sekolah",
        reg: "MET.000.004190 2021",
        foto: "{{ asset('assets/guru/kategori-pimpinan/BENDAHARA SEKOLAH - Wuri Handayani, S.E.webp') }}",
      },
      {
        nama: "Dedy Wijanarko, SST.,Par.,S.Pd.",
        bidang: "Perhotelan",
        reg: "MET.000.004194 2021",
        foto: "{{ asset('assets/guru/kategori-k3/Dedy Wijanarko, SST.,Par.,S.Pd.webp') }}",
      },
      {
        nama: "Tri Wahyu S, S.Pd",
        bidang: "Manajemen Perkantoran & Layanan Bisnis",
        reg: "MET.000.007322 2022",
        foto: "{{ asset('assets/guru/kategori-k3/Tri Wahyu S, S.Pd.webp') }}",
      },
      {
        nama: "Dinda Nurmawati, S.Kom",
        bidang: "Pengembangan Perangkat Lunak & Gim",
        reg: "MET.000.004196 2021",
        foto: "{{ asset('assets/guru/kategori-k3/Dinda Nurmawati, S.Kom.webp') }}",
      },
      {
        nama: "Endah Dila Kurniawati, S.Kom",
        bidang: "Pengembangan Perangkat Lunak & Gim",
        reg: "MET.000.008346 2024",
        foto: "{{ asset('assets/guru/kategori-guru/Endah Dila K., S.Kom.webp') }}",
      },
    ];

    /* ---------- 4. TEMPAT UJI KOMPETENSI ---------- */
    const TUK = [
      {
        nama: "TUK Laboratorium Komputer Utama",
        untuk: "TJKT, PPLG, DKV, Bisnis Digital",
        desc: "Laboratorium ber-AC dengan PC spesifikasi industri dan koneksi internet fiber.",
        tautan: "{{ url('/fasilitas') }}",
      },
      {
        nama: "TUK Edohotel SMEMSA",
        untuk: "Perhotelan",
        desc: "Mini hotel standar industri untuk uji kompetensi Front Office dan Housekeeping.",
        tautan: "{{ url('/fasilitas') }}",
      },
      {
        nama: "TUK Perkantoran & Akuntansi",
        untuk: "MPLB, AKL",
        desc: "Ruang simulasi kantor lengkap dengan peralatan filling, komputer akuntansi, dan meja resepsionis.",
        tautan: "{{ url('/fasilitas') }}",
      },
    ];

    /* =====================================================================
         RENDER LOGIC
      ===================================================================== */
    document.addEventListener("DOMContentLoaded", function () {
      // Update scheme count
      const schemeCountEl = document.getElementById("scheme-count");
      if (schemeCountEl) {
        schemeCountEl.textContent = SKEMA.length + " Skema";
      }

      /* ---- 1. Render Skema (accordion) ---- */
      const list = document.getElementById("scheme-list");
      if (list) {
        SKEMA.forEach(function (s, i) {
          const item = document.createElement("div");
          item.className = "scheme-item";
          const bodyId = "scheme-body-" + i;

          item.innerHTML =
            '<button class="scheme-head" aria-expanded="false" aria-controls="' +
            bodyId +
            '">' +
            '<span class="scheme-num">' +
            String(i + 1).padStart(2, "0") +
            "</span>" +
            "<span>" +
            '<span class="scheme-name">' +
            s.nama +
            "</span>" +
            '<span class="scheme-sub">Acuan: ' +
            s.acuan +
            " &middot; Kode: " +
            s.kode +
            "</span>" +
            "</span>" +
            '<span class="scheme-tag">' +
            s.jurusan +
            "</span>" +
            '<span class="scheme-toggle" aria-hidden="true">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>' +
            "</span>" +
            "</button>" +
            '<div class="scheme-body" id="' +
            bodyId +
            '">' +
            '<div class="scheme-body-grid">' +
            "<div>" +
            '<div class="unit-head">Unit Kompetensi (' +
            s.units.length +
            " Unit)</div>" +
            '<ul class="unit-list">' +
            s.units
              .map(function (u) {
                return "<li>" + u + "</li>";
              })
              .join("") +
            "</ul>" +
            "</div>" +
            "<div>" +
            '<div class="unit-head">Informasi Skema</div>' +
            '<ul class="unit-list">' +
            "<li>Konsentrasi keahlian: " +
            s.jurusan +
            "</li>" +
            "<li>Kode skema: " +
            s.kode +
            "</li>" +
            "<li>Standar acuan: " +
            s.acuan +
            "</li>" +
            "</ul>" +
            "</div>" +
            "</div>" +
            (s.catatan
              ? '<div class="scheme-note">' + s.catatan + "</div>"
              : "") +
            "</div>";

          list.appendChild(item);
        });

        // Toggle accordion - satu panel aktif dalam satu waktu
        list.querySelectorAll(".scheme-head").forEach(function (head) {
          head.addEventListener("click", function () {
            const isOpen = head.getAttribute("aria-expanded") === "true";
            list.querySelectorAll(".scheme-head").forEach(function (h) {
              h.setAttribute("aria-expanded", "false");
              const body = document.getElementById(h.getAttribute("aria-controls"));
              if (body) body.classList.remove("open");
            });
            if (!isOpen) {
              head.setAttribute("aria-expanded", "true");
              const body = document.getElementById(head.getAttribute("aria-controls"));
              if (body) body.classList.add("open");
            }
          });
        });
      }

      /* ---- 2. Render Alur Asesmen ---- */
      const flow = document.getElementById("flow-list");
      if (flow) {
        ALUR.forEach(function (a, i) {
          const step = document.createElement("div");
          step.className = "flow-step";
          step.innerHTML =
            '<div class="flow-num">' +
            (i + 1) +
            "</div>" +
            '<h3 class="flow-title">' +
            a.judul +
            "</h3>" +
            '<p class="flow-desc">' +
            a.desc +
            "</p>";
          flow.appendChild(step);
        });
      }

      /* ---- 3. Render Asesor Kompetensi ---- */
      const ag = document.getElementById("assessor-grid");
      if (ag) {
        ASESOR.forEach(function (p) {
          const initial = p.nama
            .split(" ")
            .map((w) => w[0])
            .slice(0, 2)
            .join("")
            .toUpperCase();

          const card = document.createElement("article");
          card.className = "assessor-card";

          const photoDiv = document.createElement("div");
          photoDiv.className = "assessor-photo";

          if (p.foto) {
            const img = document.createElement("img");
            img.src = p.foto;
            img.alt = "Foto " + p.nama;
            img.loading = "lazy";
            img.width = 300;
            img.height = 400;

            img.onerror = function () {
              photoDiv.classList.add("has-fallback");
              photoDiv.innerHTML =
                '<span class="assessor-initial">' + initial + "</span>";
            };

            photoDiv.appendChild(img);
          } else {
            photoDiv.innerHTML =
              '<span class="assessor-initial">' + initial + "</span>";
          }

          const bodyDiv = document.createElement("div");
          bodyDiv.className = "assessor-body";
          bodyDiv.innerHTML =
            '<h3 class="assessor-name">' +
            p.nama +
            "</h3>" +
            '<div class="assessor-meta">' +
            p.bidang +
            "</div>" +
            (p.reg
              ? '<span class="assessor-reg">Reg. ' + p.reg + "</span>"
              : "");

          card.appendChild(photoDiv);
          card.appendChild(bodyDiv);
          ag.appendChild(card);
        });
      }

      /* ---- 4. Render Tempat Uji Kompetensi (TUK) ---- */
      const tg = document.getElementById("tuk-grid");
      if (tg) {
        TUK.forEach(function (t) {
          const card = document.createElement("article");
          card.className = "tuk-card";
          card.innerHTML =
            '<div class="tuk-for">' +
            t.untuk +
            "</div>" +
            '<h3 class="tuk-name">' +
            t.nama +
            "</h3>" +
            '<p class="tuk-desc">' +
            t.desc +
            "</p>" +
            (t.tautan
              ? '<a class="tuk-link" href="' +
                t.tautan +
                '">Lihat di fasilitas &rarr;</a>'
              : "");
          tg.appendChild(card);
        });
      }
    });
  </script>
@endpush

@endsection
