@extends('layouts.app')

@section('content')

  <!-- 2. PAGE HEADER -->
  <header class="page-header" style="margin-bottom: 4rem">
    <div class="hero-bg-art" aria-hidden="true">
      <img src="{{ asset('assets/guru/trio.jpeg') }}" alt="" class="hero-bg-img" />
      <div class="hero-bg-overlay"></div>
    </div>
    <div class="container" style="position: relative; z-index: 2;">
      <span class="badge-gold">Tenaga Pendidik</span>
      <h1 class="page-title">Orang-Orang di Balik<br />Setiap Kompetensi.</h1>
      <p class="page-subtitle">
        Mengenal lebih dekat para pendidik inspiratif dan tenaga kependidikan
        dedikatif yang membimbing siswa-siswi SMKS Muhammadiyah 1 Genteng
        menuju prestasi gemilang.
      </p>
      <!-- Stats Strip -->
      <div style="
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2.5rem;
          ">
        <div style="text-align: center">
          <div class="header-stat-num" style="
                font-size: 2.5rem;
                font-weight: 800;
                font-family: var(--font-display);
                line-height: 1;
              ">
            {{ $stats['teachers'] }}
          </div>
          <div class="header-stat-label" style="
                font-size: 0.85rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-top: 0.5rem;
              ">
            Guru Profesional
          </div>
        </div>
        <div class="header-stat-divider" style="width: 1px; background: rgba(255, 255, 255, 0.15)"></div>
        <div style="text-align: center">
          <div class="header-stat-num" style="
                font-size: 2.5rem;
                font-weight: 800;
                font-family: var(--font-display);
                line-height: 1;
              ">
            <span id="stat-tendik">{{ $stats['staff'] }}</span>
          </div>
          <div class="header-stat-label" style="
                font-size: 0.85rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-top: 0.5rem;
              ">
            Staff Karyawan
          </div>
        </div>
        <div class="header-stat-divider" style="width: 1px; background: rgba(255, 255, 255, 0.15)"></div>
        <div style="text-align: center">
          <div class="header-stat-num" style="
                font-size: 2.5rem;
                font-weight: 800;
                font-family: var(--font-display);
                line-height: 1;
              ">
            {{ $stats['majors'] }}
          </div>
          <div class="header-stat-label" style="
                font-size: 0.85rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-top: 0.5rem;
              ">
            Konsentrasi Keahlian
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- STICKY NAV & SEARCH -->
  <div class="sticky-nav-container">
    <div class="container">
      <div style="
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            flex-wrap: wrap;
          ">
        <a class="filter-btn" href="#pimpinan">Pimpinan</a>
        <a class="filter-btn" href="#k3">Kepala Konsentrasi</a>
        <a class="filter-btn" href="#guru">Guru</a>
        <a class="filter-btn" href="#tendik">Staff Karyawan</a>
      </div>
      <div class="search-wrapper">
        <input aria-label="Cari guru" class="search-input" id="guru-search" placeholder="Cari nama atau jabatan guru..."
          type="text" />
        <div aria-live="polite" class="sr-only" id="search-live-region" style="
              position: absolute;
              width: 1px;
              height: 1px;
              overflow: hidden;
              clip: rect(0, 0, 0, 0);
            "></div>
      </div>
    </div>
  </div>
  <!-- 3. PIMPINAN SEKOLAH -->
  <section class="container" id="pimpinan" style="margin-bottom: 5rem; scroll-margin-top: 150px">
    <div style="text-align: center; margin-top: 3rem; margin-bottom: 3rem">
      <div class="badge-primary" style="margin-bottom: 1rem">
        Manajemen Sekolah
      </div>
      <h2 class="section-title">Pimpinan Utama Sekolah</h2>
      <div style="
            width: 60px;
            height: 4px;
            background: var(--secondary);
            margin: 1rem auto 0;
            border-radius: 2px;
          "></div>
    </div>
    <!-- Struktur 1: Layout 2 Card (Kepsek: Foto di Kiri | Wakasek: Foto di Kanan) -->
    <div class="struktur1-grid" id="pimpinan-utama-container"></div>
    <!-- Guru Pemimpin Lainnya dengan Struktur 2 (Scrollbar Menyamping) -->
    <div style="margin-top: 3.5rem">
      <div style="
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
            flex-wrap: wrap;
            gap: 0.5rem;
          ">
        <h3 style="
              font-family: var(--font-head);
              font-size: 1.25rem;
              font-weight: 800;
              color: var(--primary-dark);
              display: flex;
              align-items: center;
              gap: 0.5rem;
            ">
          Guru Pemimpin &amp; Waka Lainnya
        </h3>
      </div>
      <div class="struktur2-scroll-wrapper">
        <div class="struktur2-scroll-container" id="wakasek-container"></div>
      </div>
    </div>
  </section>
  <!-- KEPALA KONSENTRASI KEAHLIAN -->
  <section class="container" id="k3" style="margin-bottom: 5rem; scroll-margin-top: 150px">
    <div style="
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 1.5rem;
          flex-wrap: wrap;
          gap: 1rem;
        ">
      <div>
        <div class="badge-primary" style="margin-bottom: 0.5rem">
          Ketua Program
        </div>
        <h2 class="section-title" style="text-align: left">
          Kepala Konsentrasi Keahlian
        </h2>
        <p style="color: var(--text-muted); margin-top: 0.3rem">
          Penanggung jawab tiap program keahlian vokasi
        </p>
      </div>
    </div>
    <div class="struktur2-scroll-wrapper">
      <div class="struktur2-scroll-container" id="k3-container"></div>
    </div>
  </section>
  <!-- 4. GURU & PENDIDIK -->
  <section class="container" id="guru" style="margin-bottom: 5rem; scroll-margin-top: 150px">
    <div style="
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 1.5rem;
          flex-wrap: wrap;
          gap: 1rem;
        ">
      <div>
        <div class="badge-primary" style="margin-bottom: 0.5rem">
          Tenaga Pengajar
        </div>
        <h2 class="section-title" style="text-align: left">
          Guru &amp; Pendidik
        </h2>
        <p style="color: var(--text-muted); margin-top: 0.3rem">
          Pendidik inspiratif bidang keahlian dan mata pelajaran umum
        </p>
      </div>
    </div>
    <div class="struktur2-scroll-wrapper">
      <div class="struktur2-scroll-container" id="guru-container"></div>
    </div>
  </section>
  <!-- 5. TENAGA KEPENDIDIKAN -->
  <section class="container" id="tendik" style="margin-bottom: 5rem; scroll-margin-top: 150px">
    <div style="
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 1.5rem;
          flex-wrap: wrap;
          gap: 1rem;
        ">
      <div>
        <div class="badge-primary" style="margin-bottom: 0.5rem">
          Staff Karyawan & Petugas
        </div>
        <h2 class="section-title" style="text-align: left">
          Staff Karyawan
        </h2>
        <p style="color: var(--text-muted); margin-top: 0.3rem">
          Staf Karyawan &amp; administrasi sekolah
        </p>
      </div>
    </div>
    <div class="struktur2-scroll-wrapper">
      <div class="struktur2-scroll-container" id="tendik-container"></div>
    </div>
  </section>
  <noscript>
    <div class="container" style="
          padding: 2rem;
          background: #fff3cd;
          color: #856404;
          border-radius: 8px;
          margin-bottom: 2rem;
        ">
      <strong>Perhatian:</strong> JavaScript dinonaktifkan di browser Anda.
      Berikut adalah daftar guru dan tenaga kependidikan SMKS Muhammadiyah 1
      Genteng:

      @php
        $noscriptGroups = [
          'pimpinan' => 'Pimpinan Sekolah',
          'k3' => 'Kepala Konsentrasi Keahlian',
          'guru' => 'Guru &amp; Pendidik',
          'tendik' => 'Staff Karyawan',
        ];
      @endphp
      @foreach ($noscriptGroups as $groupKey => $groupTitle)
      <h3 style="margin-top: 1.5rem">{!! $groupTitle !!}</h3>
      <ul style="padding-left: 1.5rem">
        @forelse ($groups->get($groupKey, collect()) as $teacher)
        <li><strong>{{ $teacher->name }}</strong> - {{ $teacher->position }}</li>
        @empty
        <li>Data belum tersedia</li>
        @endforelse
      </ul>
      @endforeach
    </div>
  </noscript>
  <button aria-label="Kembali ke atas" id="backToTopBtn" title="Kembali ke atas">
    <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
      <path d="m18 15-6-6-6 6"></path>
    </svg>
  </button>
  <!-- FOOTER -->

@push('scripts')
  <script>
    // Data guru & staf dari database (dikirim oleh TeacherController)
    const guruData = {{ Js::from($guruData) }};

    // Escape teks sebelum dimasukkan ke HTML (data berasal dari input admin).
    function escapeHtml(value) {
      return String(value ?? "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }

    function createFallbackImage(name) {
      let n = name && name !== "Nama menyusul" ? name : "NN";
      const initials = n
        .split(" ")
        .map((part) => part[0])
        .slice(0, 2)
        .join("")
        .toUpperCase();
      return `<div style="width:100%; height:100%; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #fff; font-family: var(--font-display); font-weight: 800;">${escapeHtml(initials)}</div>`;
    }

    function createCardHTML(guru) {
      const nama = escapeHtml(guru.nama);
      const jabatan = escapeHtml(guru.jabatan);

      // Tanpa foto: langsung tampilkan inisial nama.
      let imgHTML = guru.foto
        ? `<img src="${escapeHtml(guru.foto)}" alt="Foto ${nama}, ${jabatan}" class="guru-img" loading="lazy" data-name="${nama}" onerror="this.outerHTML=createFallbackImage(this.dataset.name)">`
        : createFallbackImage(guru.nama);

      let badgeHTML = "";
      let linkHTML = "";
      if (guru.kategori === "k3") {
        // Label jurusan diambil dari data jurusan yang dipilih di admin.
        const major = guru.jurusan || (guru.jabatan !== "Ketua Program" ? guru.jabatan : "Konsentrasi");

        badgeHTML = `<div style="position: absolute; top: 1rem; right: 1rem; background: var(--secondary); color: #fff; padding: 0.3rem 0.8rem; border-radius: 20px; font-weight: 700; font-size: 0.75rem; z-index: 10;">${escapeHtml(major)}</div>`;
        linkHTML = `<a href="{{ url('/') }}#jurusan" style="display: block; font-size: 0.75rem; color: var(--secondary); font-weight: 700; margin-top: 0.5rem;">Lihat alur karier jurusan ini &rarr;</a>`;
      }

      return `
            <div class="guru-card">
                <div class="guru-img-wrap">
                    ${badgeHTML}
                    ${imgHTML}
                    <div class="guru-overlay"></div>
                </div>
                <div class="guru-info">
                    <div class="guru-name">${nama}</div>
                    <div class="guru-jabatan">${guru.kategori === "k3" ? "Kepala Konsentrasi " + (guru.jabatan !== "Ketua Program" ? jabatan : "") : jabatan}</div>
                    ${linkHTML}
                </div>
            </div>`;
    }

    function renderGuru(dataToRender = guruData) {
      const utamaContainer = document.getElementById(
        "pimpinan-utama-container",
      );
      const wakasekContainer = document.getElementById("wakasek-container");
      const k3Container = document.getElementById("k3-container");
      const guruContainer = document.getElementById("guru-container");
      const tendikContainer = document.getElementById("tendik-container");

      let kepsekCardHTML = "";
      let wakasekCardHTML = "";
      let wakasekHTML = "";
      let k3HTML = "";
      let guruHTML = "";
      let tendikHTML = "";

      if (utamaContainer) utamaContainer.innerHTML = "";

      dataToRender.forEach((guru) => {
        if (guru.kategori === "pimpinan") {
          // Kartu besar: Kepala Sekolah (foto kiri) & Wakil Kepala Sekolah (foto kanan).
          if (guru.peran === "kepsek" || guru.peran === "wakasek") {
            const isKepsek = guru.peran === "kepsek";
            const nama = escapeHtml(guru.nama);
            const title = escapeHtml(guru.judulKartu);
            const quoteHTML = guru.kutipan
              ? `<div class="struktur1-desc">"${escapeHtml(guru.kutipan)}"</div>`
              : "";
            const imgHTML = guru.foto
              ? `<img src="${escapeHtml(guru.foto)}" alt="Foto ${nama}" class="struktur1-img" onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">`
              : createFallbackImage(guru.nama);

            if (isKepsek) {
              kepsekCardHTML = `
                  <div class="struktur1-card kepsek-card">
                    <div class="struktur1-img-wrap">
                      ${imgHTML}
                    </div>
                    <div class="struktur1-body">
                      <div class="struktur1-name">${nama}</div>
                      <div class="struktur1-role">${title}</div>
                      ${quoteHTML}
                    </div>
                  </div>`;
            } else {
              wakasekCardHTML = `
                  <div class="struktur1-card wakasek-card">
                    <div class="struktur1-body">
                      <div class="struktur1-name">${nama}</div>
                      <div class="struktur1-role">${title}</div>
                      ${quoteHTML}
                    </div>
                    <div class="struktur1-img-wrap">
                      ${imgHTML}
                    </div>
                  </div>`;
            }
          } else {
            wakasekHTML += createCardHTML(guru);
          }
        } else if (guru.kategori === "k3") {
          k3HTML += createCardHTML(guru);
        } else if (guru.kategori === "guru") {
          guruHTML += createCardHTML(guru);
        } else if (guru.kategori === "tendik") {
          tendikHTML += createCardHTML(guru);
        }
      });

      if (utamaContainer) {
        utamaContainer.innerHTML = kepsekCardHTML + wakasekCardHTML;
      }
      if (wakasekContainer)
        wakasekContainer.innerHTML =
          wakasekHTML ||
          '<p style="color:var(--text-muted); font-size:0.9rem; padding:1rem;">Tidak ada profil ditemukan.</p>';
      if (k3Container)
        k3Container.innerHTML =
          k3HTML ||
          '<p style="color:var(--text-muted); font-size:0.9rem; padding:1rem;">Tidak ada profil ditemukan.</p>';
      if (guruContainer)
        guruContainer.innerHTML =
          guruHTML ||
          '<p style="color:var(--text-muted); font-size:0.9rem; padding:1rem;">Tidak ada profil ditemukan.</p>';
      if (tendikContainer)
        tendikContainer.innerHTML =
          tendikHTML ||
          '<p style="color:var(--text-muted); font-size:0.9rem; padding:1rem;">Tidak ada profil ditemukan.</p>';

      // --- MULAI AUTO-SCROLL CAROUSEL ---
      if (window.autoScrollInstances) {
        window.autoScrollInstances.forEach((rafId) => cancelAnimationFrame(rafId));
      }
      window.autoScrollInstances = [];

      if (window.autoScrollAbortController) {
        window.autoScrollAbortController.abort();
      }
      window.autoScrollAbortController = new AbortController();
      const signal = window.autoScrollAbortController.signal;

      const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

      function setupAutoScroll(containerId, speed, reverse = false, isSearch = false) {
        const container = document.getElementById(containerId);
        if (!container || container.innerHTML.includes("Tidak ada profil ditemukan")) return;

        const wrapper = container.closest(".struktur2-scroll-wrapper");
        if (!wrapper) return;

        let btn = wrapper.querySelector(".auto-scroll-btn");
        if (isSearch) {
          if (btn) btn.remove();
          return;
        }

        // Gandakan konten untuk efek infinite scroll
        const originalChildren = Array.from(container.children);
        if (originalChildren.length === 0) return;

        originalChildren.forEach(child => {
          const clone = child.cloneNode(true);
          clone.setAttribute("aria-hidden", "true");
          container.appendChild(clone);
        });

        if (prefersReducedMotion || window.innerWidth < 768) return;

        if (!btn) {
          btn = document.createElement("button");
          btn.className = "auto-scroll-btn";
          btn.style.cssText = "position:absolute; top:10px; right:10px; width:44px; height:44px; border-radius:50%; background:var(--primary); color:#fff; border:none; z-index:10; cursor:pointer; display:flex; align-items:center; justify-content:center; box-shadow:var(--shadow-card); transition:var(--transition);";
          wrapper.appendChild(btn);
        }
        let isPausedByBtn = false;

        function updateBtn() {
          if (isPausedByBtn) {
            btn.setAttribute("aria-label", "Lanjutkan gulir otomatis");
            btn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>`;
          } else {
            btn.setAttribute("aria-label", "Jeda gulir otomatis");
            btn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M6 4h4v16H6zm8 0h4v16h-4z"/></svg>`;
          }
        }
        updateBtn();

        let state = {
          hovered: false,
          focused: false,
          interacting: false,
        };
        let interactionTimeout;

        container.classList.add('is-autoscroll');

        function togglePause() {
          isPausedByBtn = !isPausedByBtn;
          updateBtn();
          if (isPausedByBtn) {
            container.classList.remove('is-autoscroll');
          } else {
            container.classList.add('is-autoscroll');
          }
        }

        btn.addEventListener("click", togglePause, { signal });

        wrapper.addEventListener("mouseenter", () => { state.hovered = true; }, { signal });
        wrapper.addEventListener("mouseleave", () => { state.hovered = false; }, { signal });
        wrapper.addEventListener("focusin", () => { state.focused = true; }, { signal });
        wrapper.addEventListener("focusout", () => { state.focused = false; }, { signal });

        let isDragging = false;
        let startX;
        let startScrollLeft;

        const interactionStart = () => {
          state.interacting = true;
          container.classList.remove('is-autoscroll');
          clearTimeout(interactionTimeout);
        };

        const mouseStart = (e) => {
          interactionStart();
          isDragging = true;
          startX = e.pageX;
          startScrollLeft = container.scrollLeft;
          container.style.cursor = 'grabbing';
        };

        const mouseMove = (e) => {
          if (!isDragging) return;
          e.preventDefault();
          const walk = (e.pageX - startX) * 1.5;
          container.scrollLeft = startScrollLeft - walk;
          pos = container.scrollLeft;
        };

        const interactionEnd = () => {
          isDragging = false;
          container.style.cursor = '';
          interactionTimeout = setTimeout(() => {
            state.interacting = false;
            if (!isPausedByBtn) {
              container.classList.add('is-autoscroll');
            }
          }, 2000);
        };

        wrapper.addEventListener("mousedown", mouseStart, { signal });
        wrapper.addEventListener("mousemove", mouseMove, { signal });
        wrapper.addEventListener("mouseup", interactionEnd, { signal });
        wrapper.addEventListener("mouseleave", () => {
          if (isDragging) interactionEnd();
          state.hovered = false;
        }, { signal });

        wrapper.addEventListener("touchstart", interactionStart, { passive: true, signal });
        wrapper.addEventListener("touchend", interactionEnd, { passive: true, signal });
        wrapper.addEventListener("touchcancel", interactionEnd, { passive: true, signal });

        // Calculate exact reset point distance
        const firstOriginal = originalChildren[0];
        const firstClone = container.children[originalChildren.length];
        // Determine the pixel distance we need to travel for a full loop
        let resetPoint = 0;

        let raf;
        function step() {
          if (resetPoint === 0 && firstClone && firstOriginal) {
            // wait for layout to be ready
            const dist = firstClone.offsetLeft - firstOriginal.offsetLeft;
            if (dist > 0) {
              resetPoint = dist;
              if (reverse) pos = resetPoint;
            }
          }

          const shouldPause = isPausedByBtn || state.hovered || state.focused || state.interacting || document.visibilityState !== 'visible';

          if (!shouldPause && resetPoint > 0) {
            pos += reverse ? -speed : speed;
            if (pos >= resetPoint) pos -= resetPoint;
            if (pos < 0) pos += resetPoint;
            container.scrollLeft = pos;
          }
          raf = requestAnimationFrame(step);
        }

        let pos = 0; // will be set correctly when resetPoint is found
        raf = requestAnimationFrame(step);
        window.autoScrollInstances.push(raf);
      }

      requestAnimationFrame(() => {
        const isSearch = dataToRender !== guruData;
        setupAutoScroll("wakasek-container", 0.4, false, isSearch);
        setupAutoScroll("k3-container", 0.4, true, isSearch);
        setupAutoScroll("guru-container", 0.4, false, isSearch);
        setupAutoScroll("tendik-container", 0.4, true, isSearch);
      });
      // --- SELESAI AUTO-SCROLL CAROUSEL ---

      // Update stats
      const statGuru = document.getElementById("stat-guru");
      const statTendik = document.getElementById("stat-tendik");
      const statK3 = document.getElementById("stat-k3");

      if (statGuru)
        statGuru.innerText = dataToRender.filter(
          (g) => g.kategori === "guru" || g.kategori === "pimpinan",
        ).length;
      if (statTendik)
        statTendik.innerText = dataToRender.filter(
          (g) => g.kategori === "tendik",
        ).length;
      if (statK3)
        statK3.innerText = dataToRender.filter(
          (g) => g.kategori === "k3",
        ).length;
    }

    document.addEventListener("DOMContentLoaded", () => {
      renderGuru();

      const searchInput = document.getElementById("guru-search");
      const ariaLive = document.getElementById("search-live-region");
      if (searchInput) {
        searchInput.addEventListener("input", (e) => {
          const q = e.target.value.toLowerCase();
          const filtered = guruData.filter(
            (g) =>
              g.nama.toLowerCase().includes(q) ||
              g.jabatan.toLowerCase().includes(q),
          );
          renderGuru(filtered);

          if (ariaLive) {
            ariaLive.innerText = `Menampilkan ${filtered.length} profil`;
          }
        });
      }

      // Back to top
      const btt = document.getElementById("backToTopBtn");
      if (btt) {
        window.addEventListener("scroll", () => {
          if (window.scrollY > 600) {
            btt.style.display = "flex";
            btt.style.opacity = "1";
          } else {
            btt.style.opacity = "0";
            setTimeout(() => {
              if (window.scrollY <= 600) btt.style.display = "none";
            }, 300);
          }
        });
        btt.addEventListener("click", () => {
          if (window.lenis) lenis.scrollTo(0);
          else window.scrollTo({ top: 0, behavior: "smooth" });
        });
      }

      // Fix sticky chips
      document.querySelectorAll(".filter-btn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
          e.preventDefault();
          const target = document.querySelector(btn.getAttribute("href"));
          if (target) {
            if (window.lenis) lenis.scrollTo(target, { offset: -500 });
            else target.scrollIntoView({ behavior: "smooth" });
          }
        });
      });
    });
  </script>
@endpush

@endsection
