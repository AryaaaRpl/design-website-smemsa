<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CardStyle;
use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExtracurricularRequest;
use App\Models\Extracurricular;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExtracurricularController extends Controller
{
    use HandlesUploads;

    private const UPLOAD_FIELDS = ['image', 'modal_image'];

    public function index(): View
    {
        $extracurriculars = Extracurricular::ordered()->get();

        return view('admin.extracurriculars.index', compact('extracurriculars'));
    }

    public function create(): View
    {
        $extracurricular = new Extracurricular([
            'sort_order' => Extracurricular::max('sort_order') + 1,
            'card_style' => CardStyle::Normal,
            'is_active' => true,
        ]);

        return $this->form('admin.extracurriculars.create', $extracurricular);
    }

    public function store(ExtracurricularRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(self::UPLOAD_FIELDS);

        foreach (self::UPLOAD_FIELDS as $field) {
            $data[$field] = $this->storeUpload($request->file($field), 'extracurriculars');
        }

        Extracurricular::create($data);

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit(Extracurricular $extracurricular): View
    {
        return $this->form('admin.extracurriculars.edit', $extracurricular);
    }

    public function update(ExtracurricularRequest $request, Extracurricular $extracurricular): RedirectResponse
    {
        $data = $request->safe()->except(self::UPLOAD_FIELDS);

        foreach (self::UPLOAD_FIELDS as $field) {
            if ($request->hasFile($field)) {
                $this->deleteUpload($extracurricular->{$field});
                $data[$field] = $this->storeUpload($request->file($field), 'extracurriculars');
            }
        }

        $extracurricular->update($data);

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Extracurricular $extracurricular): RedirectResponse
    {
        foreach (self::UPLOAD_FIELDS as $field) {
            $this->deleteUpload($extracurricular->{$field});
        }

        $extracurricular->delete();

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }

    private function form(string $view, Extracurricular $extracurricular): View
    {
        return view($view, [
            'extracurricular' => $extracurricular,
            'cardStyles' => CardStyle::cases(),
        ]);
    }
}
