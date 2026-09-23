<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MajorRequest;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MajorController extends Controller
{
    use HandlesUploads;

    private const UPLOAD_FIELDS = ['logo', 'student_photo'];

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
        $data = $request->safe()->except(self::UPLOAD_FIELDS);

        foreach (self::UPLOAD_FIELDS as $field) {
            $data[$field] = $this->storeUpload($request->file($field), 'majors');
        }

        Major::create($data);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Major $major): View
    {
        return view('admin.majors.edit', compact('major'));
    }

    public function update(MajorRequest $request, Major $major): RedirectResponse
    {
        $data = $request->safe()->except(self::UPLOAD_FIELDS);

        foreach (self::UPLOAD_FIELDS as $field) {
            if ($request->hasFile($field)) {
                $this->deleteUpload($major->{$field});
                $data[$field] = $this->storeUpload($request->file($field), 'majors');
            }
        }

        $major->update($data);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Major $major): RedirectResponse
    {
        foreach (self::UPLOAD_FIELDS as $field) {
            $this->deleteUpload($major->{$field});
        }

        $major->delete();

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
