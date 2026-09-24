<?php

namespace App\Http\Controllers;

use App\Enums\TeacherCategory;
use App\Models\Teacher;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __invoke(): View
    {
        $teachers = Teacher::active()->with('major')->ordered()->get();

        // Dikelompokkan sesuai section di halaman: pimpinan, k3, guru, tendik.
        $groups = $teachers->groupBy(fn (Teacher $teacher) => $teacher->category->pageGroup());

        $stats = [
            'teachers' => $teachers->reject(fn (Teacher $teacher) => $teacher->category === TeacherCategory::Staff)->count(),
            'staff' => $groups->get('tendik', collect())->count(),
            'majors' => app('site.majors')->count(),
        ];

        $guruData = $teachers->map->toPageArray()->values();

        return view('guru', compact('groups', 'stats', 'guruData'));
    }
}
