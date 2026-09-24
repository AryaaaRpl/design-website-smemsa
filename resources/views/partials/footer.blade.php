  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <!-- Kolom 1: Profil Sekolah & Kontak -->
        <div>
          <div class="brand-box" style="
                display: flex;
                align-items: center;
                gap: 0.9rem;
                margin-bottom: 1.2rem;
              ">
            <img src="{{ request()->is('lsp*') ? asset('assets/icon/LSP.png') : (request()->is('bkk*') ? asset('assets/bkk.png') : asset('assets/logo.webp')) }}" alt="{{ request()->is('lsp*') ? 'Logo LSP SMKS Muhammadiyah 1 Genteng' : (request()->is('bkk*') ? 'Logo BKK SMKS Muhammadiyah 1 Genteng' : 'Logo SMKS Muhammadiyah 1 Genteng') }}" class="brand-logo"
              style="max-height: 52px; width: auto; object-fit: contain" width="52" height="52" onerror="
                  this.closest('.card')
                    ? this.closest('.card').classList.add('no-image')
                    : null;
                  this.remove();
                " />
            <div>
              <div class="footer-brand-name">SMKS MUHAMMADIYAH 1 GENTENG</div>
              <div class="footer-brand-sub">BANYUWANGI &bull; JAWA TIMUR</div>
            </div>
          </div>
          <p class="footer-address">
            {{ $site->get('address') }}
          </p>

          <!-- A. Baris Kontak dengan Inline SVG Stroke -->
          <ul class="footer-contact-list">
            <li class="footer-contact-item">
              <svg class="footer-contact-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path
                  d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
              </svg>
              <a href="tel:{{ $site->phoneLink() }}" class="footer-contact-link">{{ $site->get('phone') }}</a>
            </li>
            <li class="footer-contact-item">
              <svg class="footer-contact-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path
                  d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
              </svg>
              <a href="{{ $site->whatsappLink() }}" target="_blank" rel="noopener noreferrer"
                class="footer-contact-link">{{ $site->whatsappDisplay() }} (WhatsApp)</a>
            </li>
            <li class="footer-contact-item">
              <svg class="footer-contact-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg>
              <a href="mailto:{{ $site->get('email') }}"
                class="footer-contact-link">{{ $site->get('email') }}</a>
            </li>
          </ul>

          <!-- C. Media Sosial Monokrom -->
          <div class="footer-social-row" aria-label="Media Sosial SMKS Muhammadiyah 1 Genteng">
            <a href="{{ $site->get('instagram_url') }}" target="_blank" rel="noopener noreferrer"
              class="footer-social-btn" aria-label="Instagram SMKS Muhammadiyah 1 Genteng">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor"
                  stroke-width="2" />
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" fill="none" stroke="currentColor"
                  stroke-width="2" />
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" />
              </svg>
            </a>
            <a href="{{ $site->get('youtube_url') }}" target="_blank" rel="noopener noreferrer"
              class="footer-social-btn" aria-label="YouTube SMKS Muhammadiyah 1 Genteng">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path
                  d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"
                  fill="none" stroke="currentColor" stroke-width="2" />
                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor" />
              </svg>
            </a>
            <a href="{{ $site->get('facebook_url') }}" target="_blank" rel="noopener noreferrer"
              class="footer-social-btn" aria-label="Facebook SMKS Muhammadiyah 1 Genteng">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" fill="none"
                  stroke="currentColor" stroke-width="2" />
              </svg>
            </a>
            <a href="{{ $site->get('tiktok_url') }}" target="_blank" rel="noopener noreferrer"
              class="footer-social-btn" aria-label="TikTok SMKS Muhammadiyah 1 Genteng">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </a>
          </div>

          <!-- D. Peta Lokasi Sekolah Google Maps -->
          <div class="footer-map-box">
            <iframe
              src="{{ $site->get('maps_embed_url') }}"
              width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="strict-origin-when-cross-origin"></iframe>
          </div>
        </div>

        <!-- Kolom 2: Halaman Terkait -->
        <div class="footer-col">
          <h4>Halaman Terkait</h4>
          <nav class="footer-nav" aria-label="Navigasi Halaman Terkait">
            <ul class="footer-links">
              <li>
                <a href="/bkk"><span class="footer-chevron" aria-hidden="true">&rsaquo;</span>
                  Bursa Kerja Khusus (BKK)</a>
              </li>
              <li>
                <a href="/visi-misi"><span class="footer-chevron" aria-hidden="true">&rsaquo;</span>
                  Visi &amp; Misi</a>
              </li>
              <li>
                <a href="/fasilitas"><span class="footer-chevron" aria-hidden="true">&rsaquo;</span>
                  Fasilitas Sekolah</a>
              </li>
              <li>
                <a href="/ekstrakurikuler"><span class="footer-chevron" aria-hidden="true">&rsaquo;</span>
                  Ekstrakurikuler &amp; IPM</a>
              </li>
              <li>
                <a href="/prestasi"><span class="footer-chevron" aria-hidden="true">&rsaquo;</span>
                  Galeri Prestasi</a>
              </li>
              <li>
                <a href="/berita"><span class="footer-chevron" aria-hidden="true">&rsaquo;</span>
                  Jurnal &amp; Berita</a>
              </li>
            </ul>
          </nav>
        </div>

        <!-- Kolom 3: Konsentrasi Keahlian (dari database) -->
        <div class="footer-col">
          <h4>{{ trim(($navMajors->count() ?: '') . ' Konsentrasi') }}</h4>
          <nav class="footer-nav" aria-label="Navigasi {{ $majorCountLabel }}">
            <ul class="footer-links">
              @forelse ($navMajors as $major)
              <li>
                {{-- Di beranda: gulir ke panel jurusan. Di halaman lain: buka beranda bagian jurusan. --}}
                <a href="{{ url('/') }}#jurusan" onclick="if (document.getElementById('jurusan')) { event.preventDefault(); jumpToMajor('{{ $major->slug }}'); }"><span class="footer-chevron"
                    aria-hidden="true">&rsaquo;</span>
                  {{ $major->name }}</a>
              </li>
              @empty
              <li>
                <a href="{{ url('/') }}#jurusan"><span class="footer-chevron" aria-hidden="true">&rsaquo;</span>
                  Informasi segera tersedia</a>
              </li>
              @endforelse
            </ul>
          </nav>
        </div>

        <!-- Kolom 4: Identitas Lembaga Resmi -->
        <div class="footer-col">
          <h4>Identitas Lembaga</h4>
          <div class="footer-identity-card">
            <div><strong>NPSN:</strong> {{ $site->get('npsn') }}</div>
            <div><strong>Akreditasi:</strong> {{ $site->get('accreditation') }} ({{ $site->get('accreditation_predicate') }} BAN-S/M)</div>
            <div><strong>Lembaga Sertifikasi:</strong> LSP-P1 BNSP</div>
            <div><strong>Status Sekolah:</strong> SMK Pusat Keunggulan</div>
            <div><strong>Domain Resmi:</strong> smksmuh1gtg.com</div>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div>
          &copy; 2026 SMKS Muhammadiyah 1 Genteng. Seluruh hak cipta
          dilindungi.
        </div>
        <div>Dibuat oleh RPL SMEMSA &bull; SMKS MUHAMMADIYAH 1 GENTENG</div>
      </div>
    </div>
  </footer>
