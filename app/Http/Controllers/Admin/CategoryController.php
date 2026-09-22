<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $type = CategoryType::tryFrom((string) $request->query('type'));

        $categories = Category::query()
            ->withCount(['posts', 'achievements'])
            ->when($type, fn ($query) => $query->ofType($type))
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', [
            'categories' => $categories,
            'types' => CategoryType::cases(),
            'activeType' => $type,
        ]);
    }

    public function create(Request $request): View
    {
        $category = new Category([
            'type' => CategoryType::tryFrom((string) $request->query('type')) ?? CategoryType::Post,
        ]);

        return view('admin.categories.create', [
            'category' => $category,
            'types' => CategoryType::cases(),
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'types' => CategoryType::cases(),
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        // Berita/prestasi terkait tidak ikut terhapus, kategorinya menjadi kosong (nullOnDelete).
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
