<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FacilityIcon;
use App\Enums\FacilityType;
use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FacilityRequest;
use App\Models\Facility;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FacilityController extends Controller
{
    use HandlesUploads;

    /**
     * Kolom yang bukan milik tabel facilities (diproses terpisah).
     */
    private const NON_FACILITY_FIELDS = ['new_images', 'images'];

    public function index(Request $request): View
    {
        $type = FacilityType::tryFrom((string) $request->query('type'));
        $search = trim((string) $request->query('search'));

        $facilities = Facility::query()
            ->with(['major', 'images'])
            ->when($type, fn ($query) => $query->ofType($type))
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->ordered()
            ->paginate(20)
            ->withQueryString();

        return view('admin.facilities.index', [
            'facilities' => $facilities,
            'types' => FacilityType::cases(),
            'activeType' => $type,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        $facility = new Facility([
            'type' => FacilityType::Supporting,
            'icon' => FacilityIcon::Building,
            'sort_order' => Facility::max('sort_order') + 1,
        ]);

        return $this->form('admin.facilities.create', $facility);
    }

    public function store(FacilityRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $facility = Facility::create($request->safe()->except(self::NON_FACILITY_FIELDS));
            $this->storeNewImages($request, $facility);
        });

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Facility $facility): View
    {
        $facility->load('images');

        return $this->form('admin.facilities.edit', $facility);
    }

    public function update(FacilityRequest $request, Facility $facility): RedirectResponse
    {
        DB::transaction(function () use ($request, $facility) {
            $facility->update($request->safe()->except(self::NON_FACILITY_FIELDS));
            $this->updateExistingImages($request, $facility);
            $this->storeNewImages($request, $facility);
        });

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility): RedirectResponse
    {
        foreach ($facility->images as $image) {
            $this->deleteUpload($image->path);
        }

        // Foto galeri di database ikut terhapus (cascadeOnDelete).
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }

    /**
     * Ubah keterangan/urutan foto lama, atau hapus foto yang dicentang.
     */
    private function updateExistingImages(FacilityRequest $request, Facility $facility): void
    {
        foreach ($request->validated('images', []) as $imageId => $input) {
            $image = $facility->images()->find($imageId);

            if (! $image) {
                continue;
            }

            if (! empty($input['delete'])) {
                $this->deleteUpload($image->path);
                $image->delete();

                continue;
            }

            $image->update([
                'caption' => $input['caption'] ?? null,
                'sort_order' => $input['sort_order'] ?? $image->sort_order,
            ]);
        }
    }

    /**
     * Foto baru ditambahkan di urutan paling belakang galeri.
     */
    private function storeNewImages(FacilityRequest $request, Facility $facility): void
    {
        $nextOrder = (int) $facility->images()->max('sort_order');

        foreach ($request->file('new_images', []) as $file) {
            $facility->images()->create([
                'path' => $this->storeUpload($file, 'facilities'),
                'sort_order' => ++$nextOrder,
            ]);
        }
    }

    private function form(string $view, Facility $facility): View
    {
        return view($view, [
            'facility' => $facility,
            'types' => FacilityType::cases(),
            'icons' => FacilityIcon::cases(),
            'majors' => Major::ordered()->get(),
            // Titik fasilitas lain, ditampilkan samar di peta pemilih titik.
            'otherPoints' => Facility::onMap()
                ->when($facility->exists, fn ($query) => $query->whereKeyNot($facility->id))
                ->get(['name', 'map_x', 'map_y']),
        ]);
    }
}
