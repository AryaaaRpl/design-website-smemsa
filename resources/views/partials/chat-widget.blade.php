{{-- Chatbot "Asisten SMEMSA": hanya tombol ini yang ikut dimuat; panel & script dimuat saat tombol diklik. --}}
<button type="button" class="chatbot-btn" id="chatbot-toggle" aria-label="Buka Tanya Asisten SMEMSA" aria-expanded="false"
  aria-controls="chat-panel"
  data-src="{{ Vite::asset('resources/js/chat-widget.js') }}"
  data-chat-url="{{ url('/api/chat') }}"
  data-faq-url="{{ url('/api/chat/faq') }}"
  data-whatsapp="{{ $site->whatsapp('spmb') }}"
  data-whatsapp-display="{{ $site->whatsappDisplay('spmb') }}">
  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chatbot-icon-open" aria-hidden="true">
    <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
    <path d="M8 12h.01" />
    <path d="M12 12h.01" />
    <path d="M16 12h.01" />
  </svg>
  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chatbot-icon-close" aria-hidden="true">
    <path d="M18 6 6 18" />
    <path d="m6 6 12 12" />
  </svg>
</button>
<script>
  // Muat widget chat hanya saat tombol pertama kali diklik (tidak membebani loading awal).
  (function () {
    var btn = document.getElementById('chatbot-toggle');
    var loading = false;
    btn.addEventListener('click', function onFirstClick() {
      if (loading) return;
      loading = true;
      btn.setAttribute('aria-busy', 'true');
      btn.removeEventListener('click', onFirstClick);
      // Widget membuka panel sendiri & menangani klik berikutnya.
      import(btn.dataset.src).then(function () {
        btn.removeAttribute('aria-busy');
      }).catch(function () {
        loading = false;
        btn.removeAttribute('aria-busy');
        btn.addEventListener('click', onFirstClick);
        window.open('https://wa.me/' + btn.dataset.whatsapp, '_blank', 'noopener');
      });
    });
  })();
</script>
