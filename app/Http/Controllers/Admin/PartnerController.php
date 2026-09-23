<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Models\Major;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PartnerController extends Controller
{
    use HandlesUploads;

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search'));

        $partners = Partner::query()
            ->withCount(['jobVacancies', 'jobVacancies as open_vacancies_count' => fn ($query) => $query->open()])
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        return view('admin.partners.index', compact('partners', 'search'));
    }

    public function create(): View
    {
        $partner = new Partner(['sort_order' => Partner::max('sort_order') + 1, 'is_active' => true]);

        return $this->form('admin.partners.create', $partner);
    }

    public function store(PartnerRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['logo', 'majors']);
        $data['logo'] = $this->storeUpload($request->file('logo'), 'partners');

        DB::transaction(function () use ($data, $request) {
            $partner = Partner::create($data);
            $partner->majors()->sync($request->validated('majors', []));
        });

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil ditambahkan.');
    }

    public function edit(Partner $partner): View
    {
        return $this->form('admin.partners.edit', $partner);
    }

    public function update(PartnerRequest $request, Partner $partner): RedirectResponse
    {
        $data = $request->safe()->except(['logo', 'majors']);

        if ($request->hasFile('logo')) {
            $this->deleteUpload($partner->logo);
            $data['logo'] = $this->storeUpload($request->file('logo'), 'partners');
        }

        DB::transaction(function () use ($partner, $data, $request) {
            $partner->update($data);
            $partner->majors()->sync($request->validated('majors', []));
        });

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil diperbarui.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        // Lowongan milik mitra ini ikut terhapus (cascadeOnDelete).
        $this->deleteUpload($partner->logo);
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil dihapus.');
    }

    private function form(string $view, Partner $partner): View
    {
        return view($view, [
            'partner' => $partner,
            'majors' => Major::ordered()->get(),
            'selectedMajors' => $partner->exists ? $partner->majors()->pluck('majors.id')->all() : [],
        ]);
    }
}
