<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BusinessManager;
use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BusinessUnitRequest;
use App\Models\BusinessUnit;
use App\Models\Major;
use App\Support\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BusinessUnitController extends Controller
{
    use HandlesUploads;

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search'));

        $units = BusinessUnit::query()
            ->with('majors')
            ->withCount('products')
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        return view('admin.business-units.index', compact('units', 'search'));
    }

    public function create(): View
    {
        $unit = new BusinessUnit([
            'sort_order' => BusinessUnit::max('sort_order') + 1,
            'is_active' => true,
            'whatsapp' => app(SiteSettings::class)->whatsapp(),
        ]);

        return $this->form('admin.business-units.create', $unit);
    }

    public function store(BusinessUnitRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'majors']);
        $data['image'] = $this->storeUpload($request->file('image'), 'business-units');

        DB::transaction(function () use ($data, $request) {
            $unit = BusinessUnit::create($data);
            $unit->majors()->sync($request->validated('majors', []));
        });

        return redirect()->route('admin.business-units.index')->with('success', 'Unit usaha berhasil ditambahkan.');
    }

    public function edit(BusinessUnit $businessUnit): View
    {
        return $this->form('admin.business-units.edit', $businessUnit);
    }

    public function update(BusinessUnitRequest $request, BusinessUnit $businessUnit): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'majors']);

        if ($request->hasFile('image')) {
            $this->deleteUpload($businessUnit->image);
            $data['image'] = $this->storeUpload($request->file('image'), 'business-units');
        }

        DB::transaction(function () use ($businessUnit, $data, $request) {
            $businessUnit->update($data);
            $businessUnit->majors()->sync($request->validated('majors', []));
        });

        return redirect()->route('admin.business-units.index')->with('success', 'Unit usaha berhasil diperbarui.');
    }

    public function destroy(BusinessUnit $businessUnit): RedirectResponse
    {
        // Produk milik unit ini ikut terhapus (cascadeOnDelete). Riwayat pesanan tetap disimpan.
        $businessUnit->products->each(fn ($product) => $this->deleteUpload($product->image));
        $this->deleteUpload($businessUnit->image);
        $businessUnit->delete();

        return redirect()->route('admin.business-units.index')->with('success', 'Unit usaha berhasil dihapus.');
    }

    private function form(string $view, BusinessUnit $unit): View
    {
        return view($view, [
            'unit' => $unit,
            'majors' => Major::ordered()->get(),
            'managers' => BusinessManager::cases(),
            'selectedMajors' => $unit->exists ? $unit->majors()->pluck('majors.id')->all() : [],
        ]);
    }
}
