<?php

namespace App\Http\Middleware;

use App\Support\VisitorStats;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Mencatat pengunjung unik harian. Pencatatan dilakukan SETELAH halaman terkirim
 * (terminate), jadi tidak memperlambat waktu muat halaman.
 */
class TrackVisitor
{
    public function __construct(private VisitorStats $stats) {}

    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        $isPage = $response->isSuccessful()
            && str_contains((string) $response->headers->get('Content-Type'), 'text/html');

        if (! $isPage || ! $this->stats->shouldTrack($request)) {
            return;
        }

        try {
            $this->stats->record($request);
        } catch (\Throwable $e) {
            // Penghitung tidak boleh membuat halaman gagal (misal tabel belum dimigrasi).
            report($e);
        }
    }
}
