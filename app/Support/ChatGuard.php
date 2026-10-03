<?php

namespace App\Support;

/**
 * Pengaman chatbot: menolak pola jailbreak sebelum AI dipanggil (lapisan 1)
 * dan mencegah isi system prompt/knowledge bocor di jawaban AI (lapisan 3).
 */
class ChatGuard
{
    /** Kalimat penolakan baku (juga dipakai AI lewat system prompt). */
    public const REFUSAL = 'Maaf, aku hanya bisa membantu informasi seputar SMKS Muhammadiyah 1 Genteng, seperti jurusan, PPDB, biaya, dan fasilitas. Ada yang ingin kamu tanyakan tentang sekolah kami? 😊';

    /** Pola jailbreak umum (Bahasa Indonesia & Inggris), dicocokkan pada teks huruf kecil. */
    private const JAILBREAK_PATTERNS = [
        // Menyuruh mengabaikan instruksi.
        '/\b(abaikan|lupakan|acuhkan|hiraukan|langgar|lewati)\b.{0,40}\b(instruksi|perintah|aturan|prompt|batasan|arahan)/u',
        '/\b(ignore|disregard|forget|override|bypass|skip)\b.{0,40}\b(instructions?|rules?|prompts?|guidelines?|restrictions?|above|previous|prior)\b/u',
        // Mengganti peran / mode tanpa batas.
        '/\b(kamu|anda|lo|lu|kau)\s+(sekarang|mulai sekarang|kini)\s+(adalah|jadi|menjadi|berperan)/u',
        '/\b(you are now|from now on you|act as|pretend (to be|you)|roleplay as|role-play as)\b/u',
        '/\b(bertindak|berperan|berpura-pura|pura-pura)\s+(sebagai|jadi|menjadi)\b/u',
        '/\b(jailbreak|dan mode|developer mode|mode pengembang|mode developer|god mode|sudo mode|do anything now)\b/u',
        '/\b(tanpa|bebas)\s+(batasan|batas|filter|sensor|aturan)\b/u',
        '/\b(without|no)\s+(any\s+)?(restrictions?|limits?|limitations?|filters?|censorship|rules)\b/u',
        // Meminta isi prompt/instruksi/data internal (termasuk terselubung: terjemahkan, ringkas, ulangi).
        '/\b(system\s*prompt|sistem\s*prompt|prompt\s*sistem|system\s*message|system\s*instruction|initial\s*prompt|hidden\s*prompt)\b/u',
        '/\b(instruksi|perintah|prompt|arahan|pesan)\s+(awal|asli|sistem|pertama|tersembunyi|rahasia|sebelumnya|dasar)/u',
        '/\b(instruksi|aturan|prompt|konfigurasi|pengaturan)\s*(mu|kamu|anda)\b/u',
        '/\b(your|the)\s+(initial|original|hidden|secret|system|first|previous|underlying)\s+(instructions?|prompts?|rules|message|configuration)\b/u',
        '/\b(your)\s+(instructions?|prompts?|rules|configuration|guidelines)\b/u',
        '/\b(tampilkan|tunjukkan|perlihatkan|bocorkan|ungkapkan|tuliskan ulang|tulis ulang|ulangi|salin|terjemahkan|ringkas|cetak)\b.{0,40}\b(instruksi|prompt|konfigurasi|knowledge|basis pengetahuan|data internal|kata pertama)/u',
        '/\b(show|reveal|print|repeat|translate|output|leak|dump|display|summari[sz]e|copy)\b.{0,40}\b(instructions?|prompts?|configuration|knowledge base|internal data|words above|text above)\b/u',
        // Mengaku sebagai pihak berwenang untuk meminta data internal.
        '/\bsaya\s+(adalah\s+)?(admin|administrator|developer|pengembang|programmer|pembuat|pemilik|operator)\b/u',
        '/\b(i am|i\'m|im)\s+(the\s+|an?\s+)?(admin|administrator|developer|owner|creator|operator)\b/u',
        '/\b(data|informasi|dokumen)\s+(internal|rahasia)\b/u',
        '/\b(internal|confidential|secret)\s+(data|information|documents?)\b/u',
        // Format penyamaran umum.
        '/\b(base64|rot13|hex encode|encode)\b/u',
    ];

    /**
     * Apakah pesan pengguna terlihat sebagai upaya jailbreak.
     */
    public function isJailbreak(string $message): bool
    {
        $text = $this->normalize($message);

        foreach (self::JAILBREAK_PATTERNS as $pattern) {
            if (preg_match($pattern, $text)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Apakah jawaban AI memuat potongan mentah system prompt / knowledge.
     */
    public function leaksPrompt(string $reply, string $systemPrompt): bool
    {
        $text = $this->normalize($reply);

        // Penanda khusus file prompt & struktur knowledge mentah (judul markdown beruntun).
        if (str_contains($text, '{{knowledge}}') || str_contains($text, 'data_sekolah') || str_contains($text, '[isi]') || preg_match_all('/^#{1,3}\s/m', $reply) >= 2) {
            return true;
        }

        // Potongan 8 kata berurutan dari aturan system prompt yang muncul di jawaban (termasuk kutipan sebagian).
        // Kalimat dalam tanda kutip (template jawaban penolakan) memang boleh diucapkan AI, jadi dikecualikan.
        $rules = $this->words(preg_replace('/"[^"]*"/u', ' ', $systemPrompt));
        $ruleGrams = array_flip($this->ngrams($rules, 8));

        foreach ($this->ngrams($this->words($reply), 8) as $gram) {
            if (isset($ruleGrams[$gram])) {
                return true;
            }
        }

        return false;
    }

    /** Teks huruf kecil, hanya huruf/angka dipisah satu spasi. */
    private function words(string $text): string
    {
        return $this->normalize(preg_replace('/[^\p{L}\p{N}]+/u', ' ', $text));
    }

    /**
     * @return list<string>
     */
    private function ngrams(string $words, int $size): array
    {
        $tokens = $words === '' ? [] : explode(' ', $words);
        $grams = [];

        for ($i = 0; $i + $size <= count($tokens); $i++) {
            $grams[] = implode(' ', array_slice($tokens, $i, $size));
        }

        return $grams;
    }

    private function normalize(string $text): string
    {
        return trim(preg_replace('/\s+/u', ' ', mb_strtolower($text)));
    }
}
