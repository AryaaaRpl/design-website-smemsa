<?php

use App\Http\Middleware\TrackVisitor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn () => route('admin.login'));
        $middleware->redirectUsersTo(fn () => route('admin.dashboard'));

        // Situs berada di belakang Cloudflare: pengunjung memakai HTTPS, lalu Cloudflare meneruskan
        // ke server lewat HTTP. Dengan ini Laravel membaca header X-Forwarded-Proto dari Cloudflare,
        // sehingga link aset (font, gambar, CSS, JS) dibuat https:// dan tidak diblokir browser.
        $middleware->trustProxies(at: '*');

        // Penghitung pengunjung unik harian (footer & dashboard admin).
        $middleware->web(append: [TrackVisitor::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
