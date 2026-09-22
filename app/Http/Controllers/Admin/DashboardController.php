<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\JobVacancy;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Teacher;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            ['label' => 'Berita', 'value' => Post::count()],
            ['label' => 'Prestasi', 'value' => Achievement::count()],
            ['label' => 'Lowongan Aktif', 'value' => JobVacancy::open()->count()],
            ['label' => 'Mitra Industri', 'value' => Partner::count()],
            ['label' => 'Guru & Staf', 'value' => Teacher::count()],
        ];

        $latestPosts = Post::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestPosts'));
    }
}
