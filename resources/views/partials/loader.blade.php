<!-- ========================================================
     PRELOADER / ANIMASI LOADING HALAMAN (BLUE THEME)
     SMKS MUHAMMADIYAH 1 GENTENG
     File ini terpisah di resources/views/partials/loader.blade.php
     agar mudah dikembangkan, diatur, atau dikustomisasi.
     ======================================================== -->

<div id="smemsa-page-loader" class="page-loader-wrapper" role="status" aria-live="polite" aria-label="Memuat halaman">
  <div class="loader-backdrop"></div>

  <div class="loader-content-box">
    <!-- Blue Spinner & Pulse Ring Container -->
    <div class="loader-visual">
      <div class="loader-glow"></div>
      <div class="loader-ring-outer"></div>
      <div class="loader-ring-middle"></div>
      <div class="loader-ring-inner"></div>
      <div class="loader-core-dot"></div>
    </div>

    <!-- Loading Text & Animated Dots -->
    <div class="loader-text-wrapper">
      <div class="loader-main-text">
        <span>Memuat halaman</span>
        <span class="loader-dot-pulse">
          <span class="dot dot-1">.</span>
          <span class="dot dot-2">.</span>
          <span class="dot dot-3">.</span>
        </span>
      </div>
      <span class="loader-subtext">SMKS Muhammadiyah 1 Genteng</span>
    </div>

    <!-- Progress Line -->
    <div class="loader-progress-bar">
      <div class="loader-progress-fill"></div>
    </div>
  </div>
</div>

<style>
  /* ----------------------------------------------------
     LOADER CONTAINER & BACKDROP
     ---------------------------------------------------- */
  .page-loader-wrapper {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    opacity: 1;
    visibility: visible;
    transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                visibility 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: opacity, visibility;
    user-select: none;
    -webkit-user-select: none;
  }

  .page-loader-wrapper.loaded {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: scale(1.02);
  }

  .loader-backdrop {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 45%, rgba(239, 246, 255, 0.95) 0%, rgba(255, 255, 255, 0.98) 70%, #ffffff 100%);
    pointer-events: none;
  }

  .loader-content-box {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem 1.5rem;
    max-width: 90vw;
    text-align: center;
  }

  /* ----------------------------------------------------
     BLUE ANIMATED SPINNER & GLOW EFFECT
     ---------------------------------------------------- */
  .loader-visual {
    position: relative;
    width: 84px;
    height: 84px;
    margin-bottom: 1.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .loader-glow {
    position: absolute;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(59, 130, 246, 0.08) 50%, transparent 70%);
    animation: loaderPulseGlow 2.4s ease-in-out infinite;
    pointer-events: none;
  }

  .loader-ring-outer {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #1d4ed8;
    border-right-color: #3b82f6;
    animation: loaderSpin 1.4s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
    filter: drop-shadow(0 0 6px rgba(29, 78, 216, 0.35));
  }

  .loader-ring-middle {
    position: absolute;
    inset: 9px;
    border-radius: 50%;
    border: 2.5px solid transparent;
    border-bottom-color: #2563eb;
    border-left-color: #60a5fa;
    animation: loaderSpinReverse 1.1s linear infinite;
  }

  .loader-ring-inner {
    position: absolute;
    inset: 18px;
    border-radius: 50%;
    border: 2px dashed rgba(59, 130, 246, 0.6);
    animation: loaderSpin 3s linear infinite;
  }

  .loader-core-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    box-shadow: 0 0 12px rgba(37, 99, 235, 0.8), 0 0 4px #60a5fa;
    animation: loaderDotBeat 1.4s ease-in-out infinite alternate;
  }

  /* ----------------------------------------------------
     TYPOGRAPHY & TEXT EFFECTS
     ---------------------------------------------------- */
  .loader-text-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.35rem;
  }

  .loader-main-text {
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    font-size: 1.15rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    color: #1e3a8a;
    display: flex;
    align-items: baseline;
    justify-content: center;
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #1d4ed8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .loader-dot-pulse {
    display: inline-flex;
    margin-left: 2px;
    -webkit-text-fill-color: #2563eb;
    color: #2563eb;
    font-weight: 800;
  }

  .loader-dot-pulse .dot {
    animation: loaderDotWave 1.4s infinite;
    opacity: 0.2;
  }

  .loader-dot-pulse .dot-1 {
    animation-delay: 0s;
  }

  .loader-dot-pulse .dot-2 {
    animation-delay: 0.2s;
  }

  .loader-dot-pulse .dot-3 {
    animation-delay: 0.4s;
  }

  .loader-subtext {
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: #64748b;
    opacity: 0.85;
  }

  /* ----------------------------------------------------
     ELEGANT BLUE PROGRESS BAR
     ---------------------------------------------------- */
  .loader-progress-bar {
    width: 140px;
    height: 4px;
    background: rgba(226, 232, 240, 0.8);
    border-radius: 999px;
    margin-top: 1.25rem;
    overflow: hidden;
    position: relative;
  }

  .loader-progress-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 40%;
    background: linear-gradient(90deg, transparent, #2563eb, #60a5fa, transparent);
    border-radius: 999px;
    animation: loaderProgressSlide 1.6s ease-in-out infinite;
  }

  /* ----------------------------------------------------
     KEYFRAME ANIMATIONS
     ---------------------------------------------------- */
  @keyframes loaderSpin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }

  @keyframes loaderSpinReverse {
    0% {
      transform: rotate(360deg);
    }
    100% {
      transform: rotate(0deg);
    }
  }

  @keyframes loaderPulseGlow {
    0%, 100% {
      transform: scale(0.9);
      opacity: 0.4;
    }
    50% {
      transform: scale(1.15);
      opacity: 0.85;
    }
  }

  @keyframes loaderDotBeat {
    0% {
      transform: scale(0.75);
      opacity: 0.7;
    }
    100% {
      transform: scale(1.15);
      opacity: 1;
    }
  }

  @keyframes loaderDotWave {
    0%, 20% {
      opacity: 0.2;
      transform: translateY(0);
    }
    50% {
      opacity: 1;
      transform: translateY(-2px);
    }
    80%, 100% {
      opacity: 0.2;
      transform: translateY(0);
    }
  }

  @keyframes loaderProgressSlide {
    0% {
      left: -40%;
    }
    100% {
      left: 100%;
    }
  }

  /* ----------------------------------------------------
     RESPONSIVE MEDIA QUERIES
     ---------------------------------------------------- */
  @media (max-width: 640px) {
    .loader-visual {
      width: 72px;
      height: 72px;
      margin-bottom: 1.25rem;
    }

    .loader-glow {
      width: 85px;
      height: 85px;
    }

    .loader-main-text {
      font-size: 1.05rem;
    }

    .loader-subtext {
      font-size: 0.72rem;
    }

    .loader-progress-bar {
      width: 120px;
      height: 3.5px;
      margin-top: 1rem;
    }
  }
</style>

<script>
  (function () {
    const loaderEl = document.getElementById('smemsa-page-loader');
    if (!loaderEl) return;

    let isHidden = false;

    function hidePageLoader() {
      if (isHidden) return;
      isHidden = true;

      loaderEl.classList.add('loaded');
      document.body.style.overflow = 'hidden';

      // Bersihkan style display setelah animasi fade-out selesai
      setTimeout(function () {
        if (loaderEl && loaderEl.parentNode) {
          loaderEl.style.display = 'none';
          document.body.style.overflow = 'none';
        }
      }, 550);
    }

    // Hilangkan loading saat seluruh window & aset selesai dimuat
    if (document.readyState === 'complete') {
      setTimeout(hidePageLoader, 200);
    } else {
      window.addEventListener('load', function () {
        setTimeout(hidePageLoader, 200);
      });
    }

    // Safety fallback: maksimal 3.5 detik jika ada koneksi lambat atau resource tertahan
    setTimeout(hidePageLoader, 3500);

    // Tangani navigasi bfcache (Back/Forward Cache browser)
    window.addEventListener('pageshow', function (event) {
      if (event.persisted) {
        hidePageLoader();
      }
    });
  })();
</script>
