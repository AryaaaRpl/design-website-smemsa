/* ==========================================================================
   EKSTRAKURIKULER - DATA, MODAL & SCROLL ANIMATIONS
   ========================================================================== */

(function () {
  const EKSKUL_DATA = {
    hw: {
      img: "assets/ekskul/hw.webp",
      badge: "Kepanduan Islami Wajib",
      title: "Hizbul Wathan (HW)",
      desc: "<p>Gerakan Kepanduan Hizbul Wathan (HW) Kafilah SMKS Muhammadiyah 1 Genteng merupakan ekstrakurikuler wajib yang menanamkan kedisiplinan, kemandirian, serta nilai-nilai keislaman yang berwawasan kemanusiaan universal.</p><p>Melalui kegiatan kepanduan seperti perkemahan, penjelajahan alam, dan keterampilan pioneering, peserta didik dilatih untuk memiliki fisik yang kuat, mental yang tangguh, serta jiwa kepemimpinan yang berakhlak mulia.</p>",
      jadwal: "Jumat, 13:00 - 15:00 WIB",
      pembina: "Ust. Ramanda Hidayat, S.Pd",
      tempat: "Lapangan Utama & Halaman Sekolah",
      kelas: "Wajib Kelas X & Pilihan Kelas XI",
    },
    paskibra: {
      img: "assets/ekskul/paskibra.webp",
      badge: "Kedisiplinan & Patriotisme",
      title: "Paskibra Pasukan Inti",
      desc: "<p>Pasukan Pengibar Bendera (Paskibra) merupakan ekstrakurikuler unggulan yang bertujuan menanamkan kedisiplinan tingkat tinggi, ketahanan mental, serta rasa tanggung jawab dan cinta tanah air.</p><p>Anggota Paskibra dilatih secara intensif dalam hal Peraturan Baris Berbaris (PBB) formasi presisi, tata upacara bendera, serta etika kepemimpinan. Tim Paskibra selalu menjadi garda terdepan dalam setiap upacara peringatan hari besar nasional di sekolah maupun tingkat kecamatan.</p>",
      jadwal: "Selasa & Kamis, 15:30 WIB",
      pembina: "Bpk. Letda (Purn) Sudirman",
      tempat: "Lapangan Utama SMEMSA",
      kelas: "Semua Tingkat (Seleksi)",
    },
    silat: {
      img: "assets/ekskul/silat.webp",
      badge: "Seni Bela Diri Tradisi",
      title: "Pencak Silat Tapak Suci",
      desc: '<p>Perguruan Seni Bela Diri Indonesia Tapak Suci Putera Muhammadiyah adalah organisasi pencak silat resmi yang mengajarkan keahlian jurus tradisional, pertahanan diri yang efektif, dan penguatan aqidah Islam.</p><p>Dengan moto "Dengan Iman dan Akhlak saya menjadi kuat, tanpa Iman dan Akhlak saya menjadi lemah", anggota diajarkan sportivitas, keberanian, serta pembentukan karakter ksatria. Tapak Suci SMEMSA rutin mengikuti dan memenangkan berbagai kejuaraan baik tingkat regional maupun nasional.</p>',
      jadwal: "Rabu & Sabtu, 15:30 WIB",
      pembina: "Pendekar Muda Surya Nata",
      tempat: "Aula Terbuka SMEMSA",
      kelas: "Terbuka Untuk Umum",
      prestasi: [
        "Juara Umum 1 Kejurda Tapak Suci Banyuwangi 2025",
        "Medali Emas O2SN Tingkat Provinsi Jawa Timur",
        "Juara 2 Kategori Tanding Kelas C Remaja",
      ],
    },
    pramuka: {
      img: "assets/ekskul/pramuka.webp",
      badge: "Kepanduan Penegak",
      title: "Gerakan Pramuka",
      desc: "<p>Ekstrakurikuler Pramuka fokus pada pembinaan karakter mandiri, kepemimpinan regu, serta kecakapan hidup (life skills). Kegiatannya meliputi survival di alam bebas, pioneering, semaphore, dan navigasi darat.</p><p>Selain keterampilan teknis kepramukaan, anggota juga aktif dalam kegiatan pengabdian masyarakat, bakti sosial, dan penanggulangan bencana ringan, membentuk generasi muda yang tanggap, tangguh, dan peduli sesama.</p>",
      jadwal: "Sabtu, 14:00 - 16:30 WIB",
      pembina: "Kak Budi Santoso, S.Pd",
      tempat: "Pangkalan SMEMSA",
      kelas: "Kelas X & XI",
    },
    pmr: {
      img: "assets/ekskul/pmr.webp",
      badge: "Kesehatan & Kemanusiaan",
      title: "PMR Wira Unit SMEMSA",
      desc: "<p>Palang Merah Remaja (PMR) Wira adalah wadah pembinaan generasi muda di bidang kesehatan dan kemanusiaan. Anggota dilatih secara profesional mengenai Pertolongan Pertama Pada Kecelakaan (P3K), perawatan keluarga, hingga evakuasi medis dasar.</p><p>PMR SMEMSA aktif menyelenggarakan donor darah rutin bekerja sama dengan PMI Banyuwangi, serta menjadi tim medis siaga dalam setiap kegiatan besar sekolah maupun perlombaan olahraga antar pelajar.</p>",
      jadwal: "Senin, 15:30 WIB",
      pembina: "Ibu Ratna Medika, S.Kep",
      tempat: "UKS & Ruang Teori",
      kelas: "Terbuka Untuk Umum",
      prestasi: [
        "Juara 1 Lomba Pertolongan Pertama Tingkat Wira Banyuwangi",
        "Penghargaan Unit PMR Teraktif 2024",
      ],
    },
    olahraga: {
      img: "assets/ekskul/olahraga.webp",
      badge: "Prestasi Atletik",
      title: "Klub Olahraga Terpadu",
      desc: "<p>Klub Olahraga Terpadu mewadahi berbagai talenta peserta didik di bidang olahraga, meliputi Futsal, Bola Voli, Bola Basket, hingga cabang modern seperti E-Sports.</p><p>Dengan fasilitas lapangan berstandar dan pelatih berpengalaman, klub ini tidak hanya berfokus pada kebugaran fisik dan teknik permainan, tetapi juga pembentukan mental juara, kerja sama tim (teamwork), dan sportivitas untuk berlaga di kejuaraan tingkat pelajar maupun umum.</p>",
      jadwal: "Menyesuaikan Cabang Olahraga",
      pembina: "Tim Guru Penjasorkes",
      tempat: "Fasilitas Olahraga SMEMSA",
      kelas: "Semua Tingkat (Seleksi)",
    },
  };

  window.openEkskulModal = function (id) {
    const data = EKSKUL_DATA[id];
    if (!data) return;

    const modalHero = document.getElementById("modal-hero");
    const modalBadge = document.getElementById("modal-badge");
    const modalTitle = document.getElementById("modal-title");
    const modalDesc = document.getElementById("modal-desc");
    const infoGrid = document.getElementById("modal-info-grid");
    const achvDiv = document.getElementById("modal-achievements");
    const achvList = document.getElementById("modal-achievements-list");
    const modal = document.getElementById("ekskul-modal");

    if (modalHero) modalHero.src = data.img;
    if (modalBadge) modalBadge.textContent = data.badge;
    if (modalTitle) modalTitle.textContent = data.title;
    if (modalDesc) modalDesc.innerHTML = data.desc;

    if (infoGrid) {
      infoGrid.innerHTML = "";
      const addInfo = (label, value) => {
        if (!value) return;
        const div = document.createElement("div");
        div.className = "info-grid-item";
        div.innerHTML = `<span class="info-grid-label">${label}</span><span class="info-grid-value">${value}</span>`;
        infoGrid.appendChild(div);
      };

      addInfo("Jadwal Latihan", data.jadwal);
      addInfo("Pembina", data.pembina);
      addInfo("Tempat Latihan", data.tempat);
      addInfo("Terbuka Untuk", data.kelas);
    }

    if (achvDiv && achvList) {
      if (data.prestasi && data.prestasi.length > 0) {
        achvDiv.style.display = "block";
        achvList.innerHTML = data.prestasi.map((p) => `<li>${p}</li>`).join("");
      } else {
        achvDiv.style.display = "none";
        achvList.innerHTML = "";
      }
    }

    document.body.style.overflow = "hidden";
    if (window.lenis) window.lenis.stop();
    if (modal) modal.classList.add("active");
  };

  window.closeEkskulModal = function () {
    const modal = document.getElementById("ekskul-modal");
    if (modal) modal.classList.remove("active");
    document.body.style.overflow = "";
    if (window.lenis) window.lenis.start();
  };

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      const modal = document.getElementById("ekskul-modal");
      if (modal && modal.classList.contains("active")) {
        window.closeEkskulModal();
      }
    }
  });

  function initEkskulAnimations() {
    if (typeof gsap !== "undefined") {
      // 1. Header Reveal
      gsap.to(".page-header .reveal-item", {
        y: 0,
        opacity: 1,
        duration: 1,
        ease: "power3.out",
      });

      if (typeof ScrollTrigger !== "undefined") {
        // 2. Card Reveal & Image Animation Batch
        ScrollTrigger.batch(".ekskul-card", {
          start: "top 85%",
          once: true,
          onEnter: (batch) => {
            gsap.to(batch, {
              opacity: 1,
              y: 0,
              duration: 0.8,
              stagger: 0.15,
              ease: "power2.out",
            });

            batch.forEach((card, index) => {
              let bg = card.querySelector(".card-bg");
              if (bg) {
                gsap.fromTo(
                  bg,
                  { scale: 1.3 },
                  {
                    scale: 1,
                    duration: 1.5,
                    delay: index * 0.15,
                    ease: "power2.out",
                    clearProps: "transform",
                  },
                );
              }
            });
          },
        });

        // 3. Parallax Image Scrubbing
        gsap.utils.toArray(".ekskul-card").forEach((card) => {
          let bg = card.querySelector(".card-bg");
          if (bg) {
            gsap.to(bg, {
              backgroundPosition: "50% 100%",
              ease: "none",
              scrollTrigger: {
                trigger: card,
                start: "top bottom",
                end: "bottom top",
                scrub: true,
              },
            });
          }
        });
      }
    }

    // Standard reveal fallback
    const revealItems = document.querySelectorAll(".reveal-item");
    function reveal() {
      const windowHeight = window.innerHeight;
      const elementVisible = 100;
      revealItems.forEach((item) => {
        const elementTop = item.getBoundingClientRect().top;
        if (elementTop < windowHeight - elementVisible) {
          item.classList.add("active");
        }
      });
    }
    window.addEventListener("scroll", reveal);
    reveal();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initEkskulAnimations);
  } else {
    initEkskulAnimations();
  }
})();
