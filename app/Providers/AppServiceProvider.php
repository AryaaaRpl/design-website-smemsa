<?php

namespace App\Providers;

use App\Models\Major;
use App\Support\SiteSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Daftar jurusan aktif untuk layout & footer, diambil sekali per request.
        $this->app->scoped('site.majors', fn () => Major::active()->ordered()->get());

        // Pengaturan situs (kontak, sosmed, statistik, SPMB), dibaca sekali per request.
        $this->app->scoped(SiteSettings::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $site tersedia di semua view, contoh: {{ $site->get('npsn') }}.
        View::composer('*', fn ($view) => $view->with('site', app(SiteSettings::class)));

        View::composer(['layouts.app', 'partials.footer'], function ($view) {
            $majors = app('site.majors');

            $view->with([
                'navMajors' => $majors,
                // Contoh: "7 Konsentrasi Keahlian". Tanpa angka jika belum ada data.
                'majorCountLabel' => trim(($majors->count() ?: '').' Konsentrasi Keahlian'),
            ]);
        });
    }
}
