@extends('layouts.app')

@section('content')

    <!-- 2. PAGE HEADER -->
    <header class="page-header">
        <div class="container">
            <span class="badge-gold">Warta & Jurnalistik Sekolah</span>
            <h1 class="page-title">Kabar Terkini &<br>Inovasi Vokasi MUHI.</h1>
            <p class="page-subtitle">
                Ikuti liputan kegiatan belajar mengajar, kerja sama industri nasional, pengabdian masyarakat, dan
                prestasi mutakhir civitas akademika SMKS Muhammadiyah 1 Genteng.
            </p>

            <!-- Filter Pills -->
            <div class="filter-container">
                <button class="filter-btn active" onclick="filterCategory('all')">Semua Berita</button>
                <button class="filter-btn" onclick="filterCategory('akademik')">Akademik & TEFA</button>
                <button class="filter-btn" onclick="filterCategory('industri')">Kerja Sama Industri</button>
                <button class="filter-btn" onclick="filterCategory('kegiatan')">Kegiatan Siswa</button>
                <button class="filter-btn" onclick="filterCategory('prestasi')">Prestasi Kejuaraan</button>
            </div>
        </div>
    </header>

    <!-- 3. FEATURED HEADLINE ARTICLE -->
    <section class="featured-news-section container">
        <article class="featured-news-card" onclick="openNewsModal('me-awards-liputan')">
            <div class="featured-news-img-wrap">
                <img src="{{ asset('assets/juara-me-awards.jpg') }}" alt="Liputan ME Awards SMKS MUHI" class="featured-news-img"
                    onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
            </div>
            <div class="featured-news-body">
                <div style="display:flex; align-items:center; gap:0.8rem; margin-bottom:1rem;">
                    <span class="badge-gold" style="font-size:0.75rem;">HEADLINE UTAMA</span>
                    <span style="font-size:0.85rem; color:var(--text-subtle); font-weight:600;">18 Juni 2026 &bull; Tim
                        Jurnalistik</span>
                </div>
                <h2 class="font-display"
                    style="font-size: clamp(1.6rem, 2.5vw, 2.2rem); color: var(--primary-dark); margin-bottom: 1rem; line-height: 1.25;">
                    SMKS MUHI Genteng Raih Juara Umum ME Awards Tingkat Nasional 2026
                </h2>
                <p style="color: var(--text-muted); font-size: 1rem; line-height: 1.7; margin-bottom: 1.8rem;">
                    Delegasi SMKS Muhammadiyah 1 Genteng berhasil menorehkan prestasi gemilang dengan memboyong trofi
                    Juara Umum dalam perhelatan akbar Muhammadiyah Education Awards 2026 di Surabaya setelah memenangkan
                    beragam cabang lomba digital dan inovasi kejuruan.
                </p>
                <div
                    style="display:flex; align-items:center; gap:0.5rem; color:var(--primary); font-family:var(--font-head); font-weight:700; font-size:0.92rem;">
                    Baca Liputan Lengkap &rarr;
                </div>
            </div>
        </article>
    </section>

    <!-- 4. NEWS CARDS GRID -->
    <section id="news-card" class="container">
        <div class="news-grid">

            <!-- Card 1: Featured ME Awards -->
            <article id="1" class="news-card" data-category="prestasi" onclick="openNewsModal('me-awards-liputan')">
                <div class="news-card-img-wrap">
                    <img src="{{ asset('assets/juara-me-awards.jpg') }}" alt="Liputan ME Awards SMKS MUHI" class="news-card-img"
                        onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
                </div>
                <div class="news-card-body">
                    <div>
                        <div class="news-card-meta">
                            <span class="badge-primary" style="font-size:0.72rem;">PRESTASI KEJUARAAN</span>
                            <span>&bull; 18 Juni 2026</span>
                        </div>
                        <h3 class="news-card-title">SMKS MUHI Genteng Raih Juara Umum ME Awards Tingkat Nasional 2026</h3>
                        <p class="news-card-excerpt">
                            Delegasi SMKS Muhammadiyah 1 Genteng berhasil menorehkan prestasi gemilang dengan memboyong trofi Juara Umum dalam perhelatan akbar ME Awards 2026.
                        </p>
                    </div>
                    <div class="news-card-footer">
                        <span>Surabaya</span>
                        <span>Baca Warta &rarr;</span>
                    </div>
                </div>
            </article>

            <!-- Card 2: Pengenalan Jurusan -->
            <article id="2" class="news-card" data-category="kegiatan" onclick="openNewsModal('mpls-jurusan')">
                <div class="news-card-img-wrap">
                    <img src="{{ asset('assets/berita/mpls.jpeg') }}" alt="MPLS Pengenalan Jurusan" class="news-card-img"
                        onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
                </div>
                <div class="news-card-body">
                    <div>
                        <div class="news-card-meta">
                            <span class="badge-primary" style="font-size:0.72rem;">KEGIATAN SISWA</span>
                            <span>&bull; 17 Juni 2026</span>
                        </div>
                        <h3 class="news-card-title">SMKS Muhammadiyah 1 Genteng Gelar Pengenalan Jurusan untuk Siswa Baru</h3>
                        <p class="news-card-excerpt">
                            Ratusan siswa diajak lab tour interaktif dan simulasi dunia kerja agar memiliki arah yang jelas serta mentalitas juara.
                        </p>
                    </div>
                    <div class="news-card-footer">
                        <span>Kampus MUHI</span>
                        <span>Baca Warta &rarr;</span>
                    </div>
                </div>
            </article>

            <!-- Card 3: Taekwondo -->
            <article id="3" class="news-card" data-category="prestasi" onclick="openNewsModal('taekwondo-liputan')">
                <div class="news-card-img-wrap">
                    <img src="{{ asset('assets/berita/juara-tapak-suci.jpg') }}" alt="Juara Taekwondo" class="news-card-img"
                        onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
                </div>
                <div class="news-card-body">
                    <div>
                        <div class="news-card-meta">
                            <span class="badge-primary" style="font-size:0.72rem;">PRESTASI KEJUARAAN</span>
                            <span>&bull; Juni 2026</span>
                        </div>
                        <h3 class="news-card-title">Dua Siswa SMEMSA Sabet Juara 3 Kejurprov Taekwondo Antar Pelajar</h3>
                        <p class="news-card-excerpt">
                            Ibellino Novendra dan Ahmad Husaini sukses mengharumkan nama sekolah di tingkat Provinsi Jawa Timur.
                        </p>
                    </div>
                    <div class="news-card-footer">
                        <span>Malang, Jatim</span>
                        <span>Baca Warta &rarr;</span>
                    </div>
                </div>
            </article>

            <!-- Card 4: Karaoke -->
            <article id="4" class="news-card" data-category="prestasi" onclick="openNewsModal('karaoke-liputan')">
                <div class="news-card-img-wrap">
                    <img src="{{ asset('assets/berita/lomba-karaoke.jpg') }}" alt="Lomba Karaoke" class="news-card-img"
                        onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
                </div>
                <div class="news-card-body">
                    <div>
                        <div class="news-card-meta">
                            <span class="badge-primary" style="font-size:0.72rem;">PRESTASI KEJUARAAN</span>
                            <span>&bull; Juni 2026</span>
                        </div>
                        <h3 class="news-card-title">Siswi SMEMSA Raih Juara 1 & 2 Lomba Karaoke Indonesia Berbakat</h3>
                        <p class="news-card-excerpt">
                            Chelsea Princes F. dan Rennyyu Galuh Sivanni tampil gemilang di tingkat Kabupaten Banyuwangi.
                        </p>
                    </div>
                    <div class="news-card-footer">
                        <span>Banyuwangi</span>
                        <span>Baca Warta &rarr;</span>
                    </div>
                </div>
            </article>

            <!-- Card 5: Pembekalan PKL -->
            <article id="5" class="news-card" data-category="kegiatan" onclick="openNewsModal('pembekalan-pkl')">
                <div class="news-card-img-wrap">
                    <img src="{{ asset('assets/berita/pembekalan-pkl.jpg') }}" alt="Pembekalan PKL" class="news-card-img"
                        onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
                </div>
                <div class="news-card-body">
                    <div>
                        <div class="news-card-meta">
                            <span class="badge-primary" style="font-size:0.72rem;">KEGIATAN SISWA</span>
                            <span>&bull; 11-13 Juni 2026</span>
                        </div>
                        <h3 class="news-card-title">Pembekalan Intensif Praktik Kerja Lapangan (PKL) Siswa Kelas XI</h3>
                        <p class="news-card-excerpt">
                            Membekali peserta didik dengan pengetahuan, etos kerja, dan kesadaran hukum sebelum terjun ke DUDIKA.
                        </p>
                    </div>
                    <div class="news-card-footer">
                        <span>Aula MUHI</span>
                        <span>Baca Warta &rarr;</span>
                    </div>
                </div>
            </article>

        </div>
    </section>

    <!-- 5. INTERACTIVE NEWS DETAIL MODAL -->
    <div class="modal-overlay" id="news-modal-overlay" onclick="closeNewsModalOnOverlay(event)">
        <div class="news-modal-card" id="news-modal-card">
            <!-- Modal Hero Header -->
            <div class="modal-news-hero">
                <img src="{{ asset('assets/juara-me-awards.jpg') }}" alt="Header Berita" id="modal-news-img"
                    onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
                <button class="modal-close-btn" onclick="closeNewsModal()" aria-label="Tutup Berita">&times;</button>
            </div>

            <!-- Modal Content Body -->
            <div class="modal-body">
                <div style="display:flex; align-items:center; gap:0.8rem;">
                    <span class="badge-gold" id="modal-news-category" style="font-size:0.75rem;">KATEGORI</span>
                    <span id="modal-news-date"
                        style="font-size:0.85rem; color:var(--text-subtle); font-weight:600;">Tanggal</span>
                </div>

                <h2 class="modal-headline" id="modal-news-title">Judul Berita Lengkap</h2>

                <div class="modal-full-text" id="modal-news-body">
                    <!-- Dynamic Full Text Paragraphs -->
                </div>

                <div
                    style="border-top:1px solid var(--border-card); padding-top:1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
                    <span style="font-size:0.88rem; color:var(--text-muted);">Bagikan warta ini ke civitas & alumni
                        &bull; <strong>SMKS MUHI</strong></span>
                    <a href="index.html#ppdb" class="btn btn-primary" style="padding:0.5rem 1.4rem; font-size:0.88rem;">
                        Gabung Bersama SMKS MUHI &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->

@endsection
