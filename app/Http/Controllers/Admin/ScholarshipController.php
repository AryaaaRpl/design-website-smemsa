<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScholarshipRequest;
use App\Models\Scholarship;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Skema beasiswa di halaman SPMB. Nominal biaya (seragam, PSM, PKL, UKK) ada di Pengaturan > Biaya SPMB.
 */
class ScholarshipController extends Controller
{
    public function index(): View
    {
        return view('admin.scholarships.index', ['scholarships' => Scholarship::ordered()->get()]);
    }

    public function create(): View
    {
        return view('admin.scholarships.create', ['scholarship' => new Scholarship([
            'sort_order' => Scholarship::max('sort_order') + 1,
            'tone' => 'nominal',
            'tag_color' => 'blue',
            'is_published' => true,
        ])]);
    }

    public function store(ScholarshipRequest $request): RedirectResponse
    {
        Scholarship::create($request->validated());

        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil ditambahkan.');
    }

    public function edit(Scholarship $scholarship): View
    {
        return view('admin.scholarships.edit', compact('scholarship'));
    }

    public function update(ScholarshipRequest $request, Scholarship $scholarship): RedirectResponse
    {
        $scholarship->update($request->validated());

        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil diperbarui.');
    }

    public function destroy(Scholarship $scholarship): RedirectResponse
    {
        $scholarship->delete();

        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil dihapus.');
    }
}
