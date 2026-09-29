<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Visit;
use App\Support\VisitorStats;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class VisitorStatsTest extends TestCase
{
    use RefreshDatabase;

    private const BROWSER = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/130.0 Safari/537.36';

    private function visit(string $uri = '/', array $headers = []): void
    {
        $this->withHeaders($headers + ['User-Agent' => self::BROWSER])->get($uri)->assertOk();
    }

    public function test_same_visitor_is_counted_once_per_day(): void
    {
        $this->visit('/');
        $this->visit('/visi-misi');
        $this->visit('/');

        $this->assertSame(1, Visit::count());
    }

    public function test_same_visitor_is_counted_again_the_next_day(): void
    {
        $this->visit('/');
        $this->travel(1)->days();
        $this->visit('/');

        $this->assertSame(2, Visit::count());
    }

    public function test_different_browsers_are_counted_separately(): void
    {
        $this->visit('/');
        $this->visit('/', ['User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0) Safari/604.1']);

        $this->assertSame(2, Visit::count());
    }

    public function test_bots_ajax_and_admin_pages_are_not_counted(): void
    {
        $this->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1)'])->get('/')->assertOk();
        $this->visit('/prestasi', ['X-Requested-With' => 'XMLHttpRequest']);
        $this->visit(route('admin.login', [], false));

        $this->assertSame(0, Visit::count());
    }

    public function test_visitor_hash_does_not_contain_the_ip_address(): void
    {
        $this->visit('/');

        $visit = Visit::first();
        $this->assertSame(64, strlen($visit->visitor_hash));
        $this->assertStringNotContainsString('127.0.0.1', $visit->visitor_hash);
    }

    public function test_summary_counts_today_month_year_and_total(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-09-28 10:00', VisitorStats::TIMEZONE));
        $rows = [
            ['2026-09-28', 'a'], ['2026-09-28', 'b'], // hari ini
            ['2026-09-02', 'c'],                     // bulan ini
            ['2026-03-15', 'd'],                     // tahun ini
            ['2025-12-31', 'e'],                     // tahun lalu
        ];
        foreach ($rows as [$day, $hash]) {
            Visit::create(['visited_on' => $day, 'visitor_hash' => str_repeat($hash, 64)]);
        }

        $this->assertSame(
            ['today' => 2, 'month' => 3, 'year' => 4, 'total' => 5],
            app(VisitorStats::class)->summary(),
        );
    }

    public function test_today_follows_jakarta_time(): void
    {
        // 18:30 UTC = 01:30 WIB keesokan harinya.
        Carbon::setTestNow(Carbon::parse('2026-09-28 18:30', 'UTC'));
        $this->visit('/');

        $this->assertSame('2026-09-29', Visit::first()->visited_on->toDateString());
    }

    public function test_footer_shows_visitor_statistics(): void
    {
        Visit::create(['visited_on' => app(VisitorStats::class)->today(), 'visitor_hash' => str_repeat('a', 64)]);
        Cache::flush();

        $this->get('/')
            ->assertOk()
            ->assertSee('Statistik Pengunjung')
            ->assertSee('Hari Ini')
            ->assertSee('Tahun Ini');
    }

    public function test_admin_dashboard_shows_visitor_chart(): void
    {
        Visit::create(['visited_on' => app(VisitorStats::class)->today(), 'visitor_hash' => str_repeat('a', 64)]);

        $this->actingAs(User::factory()->create())
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Pengunjung Website')
            ->assertSee('30 Hari Terakhir')
            ->assertSee('12 Bulan Terakhir')
            ->assertSee('visitor-bar is-current', false);
    }

    public function test_daily_and_monthly_series_have_fixed_length(): void
    {
        $stats = app(VisitorStats::class);

        $this->assertCount(30, $stats->daily(30));
        $this->assertCount(12, $stats->monthly(12));
    }
}
