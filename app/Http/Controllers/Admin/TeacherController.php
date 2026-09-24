<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TeacherCategory;
use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeacherRequest;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    use HandlesUploads;

    public function index(Request $request): View
    {
        $category = TeacherCategory::tryFrom((string) $request->query('category'));
        $search = trim((string) $request->query('search'));

        $teachers = Teacher::query()
            ->with('major')
            ->when($category, fn ($query) => $query->ofCategory($category))
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%");
            }))
            ->ordered()
            ->paginate(20)
            ->withQueryString();

        return view('admin.teachers.index', [
            'teachers' => $teachers,
            'categories' => TeacherCategory::cases(),
            'activeCategory' => $category,
            'search' => $search,
            'counts' => Teacher::query()->selectRaw('category, count(*) as total')->groupBy('category')->pluck('total', 'category'),
        ]);
    }

    public function create(Request $request): View
    {
        $teacher = new Teacher([
            'category' => TeacherCategory::tryFrom((string) $request->query('category')) ?? TeacherCategory::Teacher,
            'sort_order' => Teacher::max('sort_order') + 1,
            'is_active' => true,
        ]);

        return $this->form('admin.teachers.create', $teacher);
    }

    public function store(TeacherRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('photo');
        $data['photo'] = $this->storeUpload($request->file('photo'), 'teachers');

        Teacher::create($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Data guru & staf berhasil ditambahkan.');
    }

    public function edit(Teacher $teacher): View
    {
        return $this->form('admin.teachers.edit', $teacher);
    }

    public function update(TeacherRequest $request, Teacher $teacher): RedirectResponse
    {
        $data = $request->safe()->except('photo');

        if ($request->hasFile('photo')) {
            $this->deleteUpload($teacher->photo);
            $data['photo'] = $this->storeUpload($request->file('photo'), 'teachers');
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Data guru & staf berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        $this->deleteUpload($teacher->photo);
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Data guru & staf berhasil dihapus.');
    }

    private function form(string $view, Teacher $teacher): View
    {
        return view($view, [
            'teacher' => $teacher,
            'categories' => TeacherCategory::cases(),
            'majors' => Major::ordered()->get(),
        ]);
    }
}
