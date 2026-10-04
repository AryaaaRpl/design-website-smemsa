<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Models\Faq;
use App\Support\ChatAssistant;
use App\Support\ChatGuard;
use App\Support\SiteSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Chatbot "Asisten SMEMSA" (widget di semua halaman publik).
 * Respons: { reply, source: ai|cache|guard|fallback|faq }.
 */
class ChatController extends Controller
{
    public function __construct(private ChatAssistant $assistant, private ChatGuard $guard) {}

    public function reply(ChatRequest $request, SiteSettings $site): JsonResponse
    {
        $message = trim($request->validated('message'));
        $history = $request->recentHistory();

        // Lapisan 1: tolak pola jailbreak tanpa memanggil AI.
        if ($this->guard->isJailbreak($message)) {
            return $this->respond(ChatGuard::REFUSAL, 'guard');
        }

        // Pertanyaan yang persis sama dengan FAQ dijawab dari database.
        $faq = $this->faqs()->first(fn(array $item) => mb_strtolower($item['question']) === mb_strtolower($message));
        if ($faq) {
            return $this->respond($faq['answer'], 'faq');
        }

        // Pertanyaan identik tanpa riwayat memakai jawaban tersimpan (hemat kuota & tahan trafik tinggi).
        $cacheKey = 'chat:reply:' . sha1(config('services.gemini.model') . '|' . mb_strtolower(preg_replace('/\s+/u', ' ', $message)));
        if ($history === [] && ($cached = Cache::get($cacheKey))) {
            return $this->respond($cached, 'cache');
        }

        try {
            $reply = $this->assistant->ask($message, $history);
        } catch (\Throwable $e) {
            Log::warning('Chatbot: Gemini gagal, memakai jawaban cadangan.', ['error' => $e->getMessage()]);

            return $this->respond(
                'Maaf, Asisten SMEMSA sedang sibuk sehingga belum bisa menjawab. Silakan coba lagi sebentar lagi, atau hubungi Admin SPMB via WhatsApp di ' . $site->whatsappDisplay('spmb') . '.',
                'fallback',
            );
        }

        // Kosong = diblokir filter keamanan Gemini. Lapisan 3: cegah isi prompt/knowledge bocor.
        if ($reply === '' || $this->guard->leaksPrompt($reply, $this->assistant->rules())) {
            return $this->respond(ChatGuard::REFUSAL, 'guard');
        }

        if ($history === []) {
            Cache::put($cacheKey, $reply, now()->addHours(6));
        }

        return $this->respond($reply, 'ai');
    }

    /**
     * Pertanyaan cepat (chip) beserta jawabannya, dari FAQ SPMB yang tayang.
     */
    public function faq(): JsonResponse
    {
        return response()->json(['faqs' => $this->faqs()->values()]);
    }

    /**
     * Maks. 5 FAQ tayang, kode {…} sudah diganti nilai Pengaturan. Cache 10 menit.
     *
     * @return Collection<int, array{question: string, answer: string}>
     */
    private function faqs(): Collection
    {
        return collect(Cache::remember('chat:faqs', now()->addMinutes(10), fn() => Faq::published()->ordered()->take(5)->get()
            ->map(fn(Faq $faq) => [
                'question' => Faq::withValues($faq->question),
                'answer' => Faq::withValues($faq->answer),
            ])
            ->all()));
    }

    private function respond(string $reply, string $source): JsonResponse
    {
        return response()->json(['reply' => $reply, 'source' => $source]);
    }
}
