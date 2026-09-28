<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\JobVacancy;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Teacher;
use App\Support\VisitorStats;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(VisitorStats $visitorStats): View
    {
        $stats = [
            ['label' => 'Berita', 'value' => Post::count()],
            ['label' => 'Prestasi', 'value' => Achievement::count()],
            ['label' => 'Lowongan Aktif', 'value' => JobVacancy::open()->count()],
            ['label' => 'Mitra Industri', 'value' => Partner::count()],
            ['label' => 'Guru & Staf', 'value' => Teacher::count()],
            ['label' => 'Pesanan BLUD Baru', 'value' => Order::ofStatus(OrderStatus::New)->count()],
        ];

        $latestPosts = Post::latest()->take(5)->get();

        // Statistik pengunjung website (unik per hari, WIB).
        $visitors = $visitorStats->summary();
        $dailyVisitors = $visitorStats->daily(30);
        $monthlyVisitors = $visitorStats->monthly(12);

        return view('admin.dashboard', compact('stats', 'latestPosts', 'visitors', 'dailyVisitors', 'monthlyVisitors'));
    }
}
