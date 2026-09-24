<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\Admin\AchievementController as AdminAchievementController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExtracurricularController as AdminExtracurricularController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\JobVacancyController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\BkkController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\VisionMissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/peta-kampus', function () {
    return view('peta-kampus');
});

Route::get('/visi-misi', VisionMissionController::class)->name('visi-misi');

Route::get('/lsp', function () {
    return view('lsp');
});

Route::get('/bkk', BkkController::class)->name('bkk');

Route::get('/spmb', function () {
    return view('spmb');
});

Route::get('/ekstrakurikuler', ExtracurricularController::class)->name('ekstrakurikuler');

Route::get('/prestasi', AchievementController::class)->name('prestasi');

Route::get('/berita', NewsController::class)->name('berita');

Route::get('/guru', TeacherController::class)->name('guru');

Route::get('/fasilitas', FacilityController::class)->name('fasilitas');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'create'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])
            ->middleware('throttle:5,1')
            ->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

        Route::resource('majors', MajorController::class)->except('show');
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('posts', PostController::class)->except('show');
        Route::resource('achievements', AdminAchievementController::class)->except('show');
        Route::resource('extracurriculars', AdminExtracurricularController::class)->except('show');
        Route::resource('teachers', AdminTeacherController::class)->except('show');
        Route::resource('facilities', AdminFacilityController::class)->except('show');
        Route::resource('partners', PartnerController::class)->except('show');
        Route::get('settings/{group?}', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings/{group}', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('vacancies', JobVacancyController::class)
            ->parameters(['vacancies' => 'vacancy'])
            ->except('show');
    });
});
