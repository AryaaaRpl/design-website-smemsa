<?php

namespace App\Support;

use App\Enums\TeacherCategory;
use App\Models\JobVacancy;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * Asisten SMEMSA: menyusun system prompt (aturan + pengetahuan sekolah) dan memanggil Google Gemini.
 * File aturan & pengetahuan: storage/app/chatbot/{system-prompt,knowledge}.md.
 */
class ChatAssistant
{
    private const ENDPOINT = 'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent';

    public function __construct(private SiteSettings $site) {}

    /**
     * Isi mentah file aturan (tanpa pengetahuan), untuk pengecekan kebocoran.
     */
    public function rules(): string
    {
        return $this->file('system-prompt.md');
    }

    /**
     * System prompt lengkap: aturan + knowledge.md + data terkini dari database. Cache 1 jam.
     */
    public function systemPrompt(): string
    {
        $version = @filemtime($this->path('system-prompt.md')).'-'.@filemtime($this->path('knowledge.md'));

        return Cache::remember("chat:system-prompt:{$version}", now()->addHour(), function () {
            // Bagian yang belum diisi ([ISI]) dibaca AI sebagai "belum tersedia".
            $knowledge = str_replace('[ISI]', '(belum tersedia, sarankan menghubungi Admin PPDB)', trim($this->file('knowledge.md')))
                ."\n\n".$this->liveKnowledge();

            return str_replace('{{KNOWLEDGE}}', $knowledge, $this->rules());
        });
    }

    /**
     * Kirim pertanyaan ke Gemini. Mengembalikan teks jawaban, string kosong bila diblokir filter keamanan.
     *
     * @param  list<array{role: string, text: string}>  $history
     *
     * @throws RuntimeException bila API key kosong, Gemini error, atau timeout.
     */
    public function ask(string $message, array $history = []): string
    {
        $key = config('services.gemini.key');

        if (blank($key)) {
            throw new RuntimeException('GEMINI_API_KEY belum diisi.');
        }

        $contents = collect($history)
            ->map(fn (array $item) => ['role' => $item['role'], 'parts' => [['text' => $item['text']]]])
            ->push(['role' => 'user', 'parts' => [['text' => $message]]])
            ->values()
            ->all();

        $safety = collect(['HARASSMENT', 'HATE_SPEECH', 'SEXUALLY_EXPLICIT', 'DANGEROUS_CONTENT'])
            ->map(fn (string $category) => ['category' => "HARM_CATEGORY_{$category}", 'threshold' => 'BLOCK_LOW_AND_ABOVE'])
            ->all();

        $model = (string) config('services.gemini.model');
        $payload = [
            'systemInstruction' => ['parts' => [['text' => $this->systemPrompt()]]],
            'contents' => $contents,
            'safetySettings' => $safety,
            'generationConfig' => [
                'temperature' => 0.3,
                'maxOutputTokens' => 400,
                // "Thinking" seminimal mungkin agar jatah token untuk jawaban & respons cepat.
                // Gemini 2.5 memakai thinkingBudget, Gemini 3 ke atas memakai thinkingLevel.
                'thinkingConfig' => str_starts_with($model, 'gemini-2.5')
                    ? ['thinkingBudget' => 0]
                    : ['thinkingLevel' => 'low'],
            ],
        ];

        $response = $this->send($key, $model, $payload);

        // Model yang tidak mengenal pengaturan thinking menolak dengan 400: ulangi sekali tanpa pengaturan itu.
        if ($response->status() === 400) {
            unset($payload['generationConfig']['thinkingConfig']);
            $response = $this->send($key, $model, $payload);
        }

        if ($response->failed()) {
            // Isi body error Gemini tidak memuat API key (key dikirim lewat header).
            throw new RuntimeException('Gemini HTTP '.$response->status().': '.mb_substr((string) $response->json('error.message'), 0, 200));
        }

        return trim(collect($response->json('candidates.0.content.parts', []))->pluck('text')->implode(''));
    }

    /**
     * @param  array<string, mixed>  $payload
     *
     * @throws RuntimeException bila Gemini tidak merespons (timeout/koneksi).
     */
    private function send(string $key, string $model, array $payload): Response
    {
        try {
            return Http::withHeaders(['x-goog-api-key' => $key])
                ->acceptJson()
                ->connectTimeout(5)
                ->timeout(15)
                ->post(sprintf(self::ENDPOINT, $model), $payload);
        } catch (ConnectionException $e) {
            throw new RuntimeException('Gemini tidak merespons: '.$e->getMessage(), previous: $e);
        }
    }

    /**
     * Data yang berubah lewat panel admin (jurusan, kepala sekolah, biaya, kontak, lowongan).
     */
    private function liveKnowledge(): string
    {
        $site = $this->site;
        $lines = ['## Data Terkini dari Website (paling akurat, utamakan bila berbeda dengan data di atas)'];

        try {
            $majors = Major::active()->ordered()->get(['short_name', 'name']);
            if ($majors->isNotEmpty()) {
                $lines[] = "- Konsentrasi keahlian ({$majors->count()}): ".$majors->map(fn ($m) => "{$m->name} ({$m->short_name})")->implode('; ');
            }

            $principal = Teacher::active()->ofCategory(TeacherCategory::Principal)->value('name');
            if ($principal) {
                $lines[] = "- Kepala sekolah: {$principal}";
            }

            $vacancies = JobVacancy::open()->with('partner')->orderBy('closes_at')->take(5)->get();
            $lines[] = '- Lowongan BKK yang sedang dibuka: '.($vacancies->isEmpty()
                ? 'belum ada, pantau halaman BKK.'
                : $vacancies->map(fn ($v) => trim("{$v->position} di {$v->partner?->name}".($v->location ? " ({$v->location})" : '')))->implode('; '));
        } catch (\Throwable $e) {
            Log::warning('Chatbot: gagal membaca data terkini dari database.', ['error' => $e->getMessage()]);
        }

        $tuition = (int) $site->get('fee_tuition');
        $lines[] = "- Tahun ajaran SPMB: {$site->get('spmb_academic_year')}";
        $lines[] = "- Biaya PSM (SPP) 1 tahun: {$site->rupiah($tuition)}, bisa dicicil 2x per semester ({$site->rupiah(intdiv($tuition, 2))} per semester)";
        $lines[] = "- Seragam laki-laki: {$site->rupiah((int) $site->get('fee_uniform_male'))}; seragam perempuan: {$site->rupiah((int) $site->get('fee_uniform_female'))} (sekali bayar)";
        $lines[] = "- Biaya PKL dalam kota: {$site->rupiah((int) $site->get('fee_pkl_local'))}; luar kota: {$site->rupiah((int) $site->get('fee_pkl_outside'))}; sertifikasi kompetensi: {$site->rupiah((int) $site->get('fee_certification'))}";
        $lines[] = "- Alamat: {$site->get('address')}";
        $lines[] = "- Telepon kantor: {$site->get('phone')}; email: {$site->get('email')}";
        $lines[] = "- WhatsApp Panitia SPMB: {$site->whatsappDisplay('spmb')}";
        $lines[] = "- NPSN: {$site->get('npsn')}; akreditasi: {$site->get('accreditation')} ({$site->get('accreditation_predicate')}); berdiri tahun {$site->get('founded_year')}";

        return implode("\n", $lines);
    }

    private function file(string $name): string
    {
        return (string) @file_get_contents($this->path($name));
    }

    private function path(string $name): string
    {
        return storage_path('app/chatbot/'.$name);
    }
}
