<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MajorRequest;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MajorController extends Controller
{
    public function index(): View
    {
        $majors = Major::ordered()->get();

        return view('admin.majors.index', compact('majors'));
    }

    public function create(): View
    {
        $major = new Major(['sort_order' => Major::max('sort_order') + 1, 'is_active' => true]);

        return view('admin.majors.create', compact('major'));
    }

    public function store(MajorRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['logo', 'student_photo']);
        $data['logo'] = $this->upload($request->file('logo'));
        $data['student_photo'] = $this->upload($request->file('student_photo'));

        Major::create($data);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Major $major): View
    {
        return view('admin.majors.edit', compact('major'));
    }

    public function update(MajorRequest $request, Major $major): RedirectResponse
    {
        $data = $request->safe()->except(['logo', 'student_photo']);

        foreach (['logo', 'student_photo'] as $field) {
            if ($request->hasFile($field)) {
                $this->deleteFile($major->{$field});
                $data[$field] = $this->upload($request->file($field));
            }
        }

        $major->update($data);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Major $major): RedirectResponse
    {
        $this->deleteFile($major->logo);
        $this->deleteFile($major->student_photo);

        $major->delete();

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil dihapus.');
    }

    private function upload(?UploadedFile $file): ?string
    {
        return $file?->store('majors', 'public');
    }

    /**
     * Hapus file upload lama. File bawaan desain (public/assets) tidak disentuh.
     */
    private function deleteFile(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'assets/')) {
            Storage::disk('public')->delete($path);
        }
    }
}
