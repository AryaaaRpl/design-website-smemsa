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

// Markdown minimal & aman: teks di-escape dulu, baru format umum dari AI diubah ke HTML.
// Didukung: **tebal**/__tebal__, *miring*/_miring_, `kode`, [teks](url) (jadi teks saja), judul "#",
// kutipan ">", daftar "- "/"• " dan "1. ". Sisa tanda * yang tidak berpasangan dibuang agar rapi.
function inlineMarkdown(line) {
    return escapeHtml(line)
        .replace(/\[([^\]]+)\]\((?:[^()]|\([^)]*\))*\)/g, '$1')
        .replace(/`([^`]+)`/g, '$1')
        .replace(/(\*\*|__)(?=\S)(.+?)(?<=\S)\1/g, '<strong>$2</strong>')
        .replace(/(^|[^\w*])\*(?=\S)([^*]+?)(?<=\S)\*(?!\w)/g, '$1<em>$2</em>')
        .replace(/(^|[^\w])_(?=\S)([^_]+?)(?<=\S)_(?!\w)/g, '$1<em>$2</em>')
        .replace(/\*+/g, '');
}

function renderMarkdown(text) {
    const html = [];
    let list = null;

    const closeList = () => {
        if (list) html.push(`<${list.tag}>${list.items.join('')}</${list.tag}>`);
        list = null;
    };

    for (const raw of text.replace(/\r/g, '').split('\n')) {
        const line = raw.trim().replace(/^>\s?/, '');
        const bullet = line.match(/^[-*•]\s+(.*)$/);
        const numbered = line.match(/^\d+[.)]\s+(.*)$/);
        const heading = line.match(/^#{1,6}\s+(.*)$/);

        if (bullet || numbered) {
            const tag = bullet ? 'ul' : 'ol';
            if (list?.tag !== tag) {
                closeList();
                list = { tag, items: [] };
            }
            list.items.push(`<li>${inlineMarkdown((bullet || numbered)[1])}</li>`);
            continue;
        }

        closeList();
        if (heading) html.push(`<p><strong>${inlineMarkdown(heading[1])}</strong></p>`);
        else if (line && !/^([-*_])\1{2,}$/.test(line)) html.push(`<p>${inlineMarkdown(line)}</p>`);
    }
    closeList();

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
            <a class="chat-wa" target="_blank" rel="noopener noreferrer" aria-label="Chat Admin PPDB via WhatsApp" title="Chat Admin PPDB via WhatsApp"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.21 3.07c.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.07-.13-.27-.2-.57-.35M12.05 21.5h-.01a9.4 9.4 0 0 1-4.8-1.31l-.34-.2-3.57.93.95-3.48-.22-.36a9.4 9.4 0 0 1-1.44-5.02c0-5.2 4.24-9.44 9.45-9.44a9.4 9.4 0 0 1 6.68 2.77 9.4 9.4 0 0 1 2.76 6.68c0 5.21-4.24 9.44-9.45 9.44m8.04-17.48A11.3 11.3 0 0 0 12.05.7C5.78.7.68 5.8.68 12.06c0 2 .52 3.96 1.52 5.68L.58 23.7l6.1-1.6a11.3 11.3 0 0 0 5.37 1.37h.01c6.26 0 11.36-5.1 11.37-11.37a11.3 11.3 0 0 0-3.34-8.04"/></svg></a>
        </form>`;
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
