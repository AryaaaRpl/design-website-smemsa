// Widget chat "Asisten SMEMSA". Dimuat lazy oleh partials/chat-widget.blade.php saat tombol diklik.
import css from '../css/chat-widget.css?inline';

const MAX_HISTORY = 6;
const GREETING = "Assalamu'alaikum! Saya **Asisten SMEMSA**, siap membantu info jurusan, SPMB, biaya, beasiswa, fasilitas, dan kontak SMKS Muhammadiyah 1 Genteng. Silakan bertanya 😊";
const MESSAGES = {
    rateLimited: 'Terlalu banyak pesan, coba lagi sebentar ya. Sambil menunggu, Anda juga bisa bertanya langsung ke Admin PPDB via WhatsApp.',
    invalid: 'Pesan terlalu panjang atau kosong. Tulis pertanyaan maksimal 500 karakter, ya.',
    offline: 'Maaf, koneksi sedang bermasalah sehingga pesan belum terkirim. Silakan coba lagi, atau hubungi Admin PPDB via WhatsApp.',
};

const escapeHtml = (text) =>
    text.replace(/[&<>"']/g, (ch) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[ch]);

// Markdown minimal & aman: teks di-escape dulu, baru **tebal** dan daftar "- " / "1. " diubah ke HTML.
function renderMarkdown(text) {
    const inline = (line) => escapeHtml(line).replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
    const html = [];
    let list = null;

    for (const raw of text.split('\n')) {
        const line = raw.trim();
        const item = line.match(/^(?:[-*•]|\d+[.)])\s+(.*)$/);

        if (item) {
            list ??= [];
            list.push(`<li>${inline(item[1])}</li>`);
            continue;
        }
        if (list) {
            html.push(`<ul>${list.join('')}</ul>`);
            list = null;
        }
        if (line) html.push(`<p>${inline(line)}</p>`);
    }
    if (list) html.push(`<ul>${list.join('')}</ul>`);

    return html.join('');
}

const icon = (paths) =>
    `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">${paths}</svg>`;

function init(toggle) {
    const { chatUrl, faqUrl, whatsapp } = toggle.dataset;
    const history = [];
    let busy = false;

    const style = document.createElement('style');
    style.textContent = css;
    document.head.appendChild(style);

    const panel = document.createElement('div');
    panel.className = 'chat-panel';
    panel.id = 'chat-panel';
    panel.setAttribute('role', 'dialog');
    panel.setAttribute('aria-label', 'Asisten SMEMSA');
    panel.setAttribute('data-lenis-prevent', '');
    panel.innerHTML = `
        <div class="chat-header">
            <div class="chat-header-avatar" aria-hidden="true">AS</div>
            <div class="chat-header-text">
                <div class="chat-header-title">Asisten SMEMSA</div>
                <div class="chat-header-sub">Asisten virtual SMKS Muhammadiyah 1 Genteng</div>
            </div>
            <button type="button" class="chat-close" aria-label="Tutup chat">${icon('<path d="M18 6 6 18"/><path d="m6 6 12 12"/>')}</button>
        </div>
        <div class="chat-body" aria-live="polite"></div>
        <div class="chat-faq" aria-label="Pertanyaan cepat"></div>
        <form class="chat-form" novalidate>
            <input type="text" name="message" maxlength="500" autocomplete="off" placeholder="Ketik pertanyaan Anda..." aria-label="Ketik pertanyaan" />
            <button type="submit" class="chat-send" aria-label="Kirim pesan">${icon('<path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>')}</button>
        </form>
        <a class="chat-wa" target="_blank" rel="noopener noreferrer">${icon('<path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"/>')} Chat Admin PPDB via WhatsApp</a>`;
    document.body.appendChild(panel);

    const body = panel.querySelector('.chat-body');
    const faqBar = panel.querySelector('.chat-faq');
    const form = panel.querySelector('.chat-form');
    const input = form.elements.message;
    const sendBtn = panel.querySelector('.chat-send');
    const waLink = panel.querySelector('.chat-wa');

    // Pesan WhatsApp terisi otomatis dengan pertanyaan terakhir pengunjung.
    const updateWaLink = (question) => {
        const text = question
            ? `Assalamu'alaikum Admin PPDB SMEMSA, saya ingin bertanya: ${question}`
            : "Assalamu'alaikum Admin PPDB SMEMSA, saya ingin bertanya tentang pendaftaran siswa baru.";
        waLink.href = `https://wa.me/${whatsapp}?text=${encodeURIComponent(text)}`;
    };
    updateWaLink('');

    const addMessage = (text, sender) => {
        const div = document.createElement('div');
        div.className = `chat-msg ${sender}`;
        if (sender === 'bot') div.innerHTML = renderMarkdown(text);
        else div.textContent = text;
        body.appendChild(div);
        body.scrollTop = body.scrollHeight;
        return div;
    };

    const remember = (role, text) => {
        history.push({ role, text });
        if (history.length > MAX_HISTORY) history.splice(0, history.length - MAX_HISTORY);
    };

    const setBusy = (state) => {
        busy = state;
        sendBtn.disabled = state;
    };

    async function send(message) {
        if (busy) return;
        message = message.trim();
        if (!message) return;

        addMessage(message, 'user');
        updateWaLink(message);
        setBusy(true);

        const typing = document.createElement('div');
        typing.className = 'chat-msg bot';
        typing.innerHTML = '<span class="chat-typing">Sedang mengetik <span></span><span></span><span></span></span>';
        body.appendChild(typing);
        body.scrollTop = body.scrollHeight;

        let reply;
        try {
            const response = await fetch(chatUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
                body: JSON.stringify({ message, history }),
            });

            if (response.status === 429) reply = MESSAGES.rateLimited;
            else if (response.status === 422) reply = MESSAGES.invalid;
            else if (!response.ok) reply = MESSAGES.offline;
            else reply = (await response.json()).reply || MESSAGES.offline;

            if (response.ok) {
                remember('user', message);
                remember('model', reply);
            }
        } catch {
            reply = MESSAGES.offline;
        }

        typing.remove();
        addMessage(reply, 'bot');
        setBusy(false);
        input.focus();
    }

    // Chip FAQ: dijawab dari data yang sudah diambil, tanpa memanggil AI.
    fetch(faqUrl, { headers: { Accept: 'application/json' } })
        .then((response) => (response.ok ? response.json() : { faqs: [] }))
        .then(({ faqs }) => {
            for (const faq of faqs) {
                const chip = document.createElement('button');
                chip.type = 'button';
                chip.className = 'chat-chip';
                chip.textContent = faq.question;
                chip.title = faq.question;
                chip.addEventListener('click', () => {
                    if (busy) return;
                    addMessage(faq.question, 'user');
                    addMessage(faq.answer, 'bot');
                    updateWaLink(faq.question);
                    remember('user', faq.question);
                    remember('model', faq.answer);
                });
                faqBar.appendChild(chip);
            }
        })
        .catch(() => {});

    addMessage(GREETING, 'bot');

    const setOpen = (open) => {
        panel.classList.toggle('active', open);
        toggle.classList.toggle('active', open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Tutup Tanya Asisten SMEMSA' : 'Buka Tanya Asisten SMEMSA');
        if (open) setTimeout(() => input.focus(), 50);
        else toggle.focus();
    };

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const message = input.value;
        input.value = '';
        send(message);
    });
    toggle.addEventListener('click', () => setOpen(!panel.classList.contains('active')));
    panel.querySelector('.chat-close').addEventListener('click', () => setOpen(false));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && panel.classList.contains('active')) setOpen(false);
    });

    // Paksa reflow dulu agar animasi masuk tetap berjalan, lalu buka panel.
    void panel.offsetHeight;
    setOpen(true);
}

// Vite tidak mempertahankan export pada entry, jadi widget langsung berjalan saat file dimuat.
init(document.getElementById('chatbot-toggle'));
