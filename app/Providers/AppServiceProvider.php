<?php

namespace App\Providers;

use App\Models\Major;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
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
