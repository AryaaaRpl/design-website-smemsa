<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegistrationRequest;
use App\Models\Major;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Data pendaftar SPMB. Status di sini yang dilihat calon siswa di halaman cek status.
 */
class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $activeStatus = RegistrationStatus::tryFrom((string) $request->query('status'));
        $search = trim((string) $request->query('search'));

        $registrations = Registration::query()
            ->with('major')
            ->when($activeStatus, fn ($query) => $query->ofStatus($activeStatus))
            ->when($search !== '', fn ($query) => $query->where(fn ($query) => $query
                ->where('registration_number', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('school_origin', 'like', "%{$search}%")))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $statusCounts = Registration::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.registrations.index', [
            'registrations' => $registrations,
            'statuses' => RegistrationStatus::cases(),
            'statusCounts' => $statusCounts,
            'activeStatus' => $activeStatus,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return $this->form('admin.registrations.create', new Registration);
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        $registration = Registration::create($request->validated());

        return redirect()->route('admin.registrations.index')
            ->with('success', "Pendaftar {$registration->name} ditambahkan dengan nomor {$registration->registration_number}.");
    }

    public function edit(Registration $registration): View
    {
        return $this->form('admin.registrations.edit', $registration);
    }

    public function update(RegistrationRequest $request, Registration $registration): RedirectResponse
    {
        $registration->update($request->validated());

        return redirect()->route('admin.registrations.index')
            ->with('success', "Data {$registration->registration_number} berhasil diperbarui.");
    }

    public function destroy(Registration $registration): RedirectResponse
    {
        $registration->delete();

        return back()->with('success', "Pendaftar {$registration->registration_number} berhasil dihapus.");
    }

    private function form(string $view, Registration $registration): View
    {
        return view($view, [
            'registration' => $registration,
            'majors' => Major::ordered()->get(),
            'statuses' => RegistrationStatus::cases(),
            'pathways' => Registration::PATHWAYS,
        ]);
    }
}
