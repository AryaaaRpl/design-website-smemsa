<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AchievementLevel;
use App\Enums\CategoryType;
use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AchievementRequest;
use App\Models\Achievement;
use App\Models\Category;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AchievementController extends Controller
{
    use HandlesUploads;

    public function index(Request $request): View
    {
        $categories = Category::ofType(CategoryType::Achievement)->orderBy('name')->get();
        $activeCategory = $categories->firstWhere('slug', $request->query('category'));
        $search = trim((string) $request->query('search'));

        $achievements = Achievement::query()
            ->with('category')
            ->when($activeCategory, fn ($query) => $query->where('category_id', $activeCategory->id))
            ->when($search !== '', fn ($query) => $query->where('title', 'like', "%{$search}%"))
            ->latestAchieved()
            ->paginate(10)
            ->withQueryString();

        return view('admin.achievements.index', compact('achievements', 'categories', 'activeCategory', 'search'));
    }

    public function create(): View
    {
        return $this->form('admin.achievements.create', new Achievement);
    }

    public function store(AchievementRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['image'] = $this->storeUpload($request->file('image'), 'achievements');

        Achievement::create($data);

        return redirect()->route('admin.achievements.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(Achievement $achievement): View
    {
        return $this->form('admin.achievements.edit', $achievement);
    }

    public function update(AchievementRequest $request, Achievement $achievement): RedirectResponse
    {
        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $this->deleteUpload($achievement->image);
            $data['image'] = $this->storeUpload($request->file('image'), 'achievements');
        }

        $achievement->update($data);

        return redirect()->route('admin.achievements.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement): RedirectResponse
    {
        // Soft delete: data masih ada di database, foto tetap disimpan.
        $achievement->delete();

        return redirect()->route('admin.achievements.index')->with('success', 'Prestasi berhasil dihapus.');
    }

    private function form(string $view, Achievement $achievement): View
    {
        return view($view, [
            'achievement' => $achievement,
            'categories' => Category::ofType(CategoryType::Achievement)->orderBy('name')->get(),
            'majors' => Major::ordered()->get(),
            'levels' => AchievementLevel::cases(),
        ]);
    }
}
