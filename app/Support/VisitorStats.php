<?php

namespace App\Support;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Statistik pengunjung website: satu pengunjung dihitung sekali per hari (WIB).
 */
class VisitorStats
{
    /** Zona waktu penentu "hari ini"; aplikasi sendiri tetap UTC. */
    public const TIMEZONE = 'Asia/Jakarta';

    /** Lama angka ringkasan disimpan di cache (detik). */
    private const CACHE_SECONDS = 300;

    private const CACHE_KEY = 'visitor-stats.summary';

    /** Crawler, bot, dan alat pemeriksa tidak dihitung sebagai pengunjung. */
    private const BOT_PATTERN = '/bot|crawl|spider|slurp|facebookexternalhit|whatsapp|telegram|preview|lighthouse|headless|curl|wget|python|monitor|uptime/i';

    public function today(): Carbon
    {
        return Carbon::now(self::TIMEZONE)->locale('id')->startOfDay();
    }

    /** Apakah permintaan ini layak dihitung sebagai kunjungan halaman publik. */
    public function shouldTrack(Request $request): bool
    {
        $userAgent = (string) $request->userAgent();

        return $request->isMethod('GET')
            && ! $request->ajax()
            && ! $request->is('admin', 'admin/*', 'up')
            && $request->header('Purpose') !== 'prefetch'
            && $userAgent !== ''
            && ! preg_match(self::BOT_PATTERN, $userAgent);
    }

    /** Catat pengunjung; kunjungan kedua di hari yang sama diabaikan. */
    public function record(Request $request): void
    {
        $day = $this->today()->toDateString();
        $hash = hash_hmac('sha256', $request->ip().'|'.$request->userAgent().'|'.$day, (string) config('app.key'));

        Visit::query()->insertOrIgnore([
            'visited_on' => $day,
            'visitor_hash' => $hash,
            'created_at' => now(),
        ]);
    }

    /**
     * Angka untuk footer & dashboard.
     *
     * @return array{today: int, month: int, year: int, total: int}
     */
    public function summary(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            $today = $this->today();

            return [
                'today' => $this->countSince($today),
                'month' => $this->countSince($today->copy()->startOfMonth()),
                'year' => $this->countSince($today->copy()->startOfYear()),
                'total' => Visit::query()->count(),
            ];
        });
    }

    /**
     * Pengunjung per hari untuk N hari terakhir (termasuk hari ini).
     *
     * @return Collection<int, array{label: string, date: string, count: int}>
     */
    public function daily(int $days = 30): Collection
    {
        $end = $this->today();
        $start = $end->copy()->subDays($days - 1);
        $counts = $this->countsPerDay($start, $end);

        return collect(range(0, $days - 1))->map(function (int $i) use ($start, $counts) {
            $date = $start->copy()->addDays($i);

            return [
                'label' => $date->translatedFormat('d M'),
                'date' => $date->translatedFormat('l, d F Y'),
                'count' => (int) ($counts[$date->toDateString()] ?? 0),
            ];
        });
    }

    /**
     * Pengunjung per bulan untuk N bulan terakhir (termasuk bulan ini).
     *
     * @return Collection<int, array{label: string, date: string, count: int}>
     */
    public function monthly(int $months = 12): Collection
    {
        $end = $this->today();
        $start = $end->copy()->startOfMonth()->subMonths($months - 1);
        $counts = $this->countsPerDay($start, $end)
            ->groupBy(fn ($count, string $day) => substr($day, 0, 7), preserveKeys: true)
            ->map->sum();

        return collect(range(0, $months - 1))->map(function (int $i) use ($start, $counts) {
            $month = $start->copy()->addMonths($i);

            return [
                'label' => $month->translatedFormat('M'),
                'date' => $month->translatedFormat('F Y'),
                'count' => (int) ($counts[$month->format('Y-m')] ?? 0),
            ];
        });
    }

    private function countSince(Carbon $from): int
    {
        return Visit::query()->where('visited_on', '>=', $from->toDateString())->count();
    }

    /** @return Collection<string, int> kunci: 'Y-m-d' */
    private function countsPerDay(Carbon $start, Carbon $end): Collection
    {
        return Visit::query()
            ->whereBetween('visited_on', [$start->toDateString(), $end->toDateString()])
            ->selectRaw('visited_on, count(*) as total')
            ->groupBy('visited_on')
            ->pluck('total', 'visited_on')
            ->mapWithKeys(fn ($total, $day) => [substr((string) $day, 0, 10) => (int) $total]);
    }
}
