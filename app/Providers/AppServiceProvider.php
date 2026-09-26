<?php

namespace App\Providers;

use App\Enums\OrderStatus;
use App\Enums\TeacherCategory;
use App\Models\JobVacancy;
use App\Models\Major;
use App\Models\Order;
use App\Models\Teacher;
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

        // Kepala Sekolah (modul Guru) untuk sambutan beranda & chatbot.
        $this->app->scoped('site.principal', fn () => Teacher::active()->ofCategory(TeacherCategory::Principal)->first());

        // Lowongan yang sedang dibuka untuk jawaban chatbot.
        $this->app->scoped('site.chatVacancies', fn () => JobVacancy::open()
            ->with('partner')
            ->orderByRaw('closes_at is null')
            ->orderBy('closes_at')
            ->take(5)
            ->get());
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

        View::composer(['layouts.app', 'index'], fn ($view) => $view->with('principal', app('site.principal')));
        View::composer('layouts.app', fn ($view) => $view->with('chatVacancies', app('site.chatVacancies')));

        // Jumlah pesanan BLUD yang belum ditangani, untuk penanda di menu admin.
        View::composer('admin.partials.sidebar', fn ($view) => $view->with(
            'newOrdersCount', Order::ofStatus(OrderStatus::New)->count(),
        ));
    }
}
