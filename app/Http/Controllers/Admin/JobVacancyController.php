<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentType;
use App\Enums\VacancyStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobVacancyRequest;
use App\Models\JobVacancy;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobVacancyController extends Controller
{
    /**
     * Tab filter di daftar lowongan: key => label.
     */
    private const FILTERS = [
        'active' => 'Tampil di Website',
        'expired' => 'Kedaluwarsa',
        'closed' => 'Ditutup',
        'all' => 'Semua',
    ];

    public function index(Request $request): View
    {
        $filter = array_key_exists($request->query('filter'), self::FILTERS) ? $request->query('filter') : 'active';
        $search = trim((string) $request->query('search'));

        $vacancies = JobVacancy::query()
            ->with('partner')
            ->when($filter === 'active', fn ($query) => $query->open())
            ->when($filter === 'expired', fn ($query) => $query->expired())
            ->when($filter === 'closed', fn ($query) => $query->where('status', VacancyStatus::Closed))
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('position', 'like', "%{$search}%")
                    ->orWhereRelation('partner', 'name', 'like', "%{$search}%");
            }))
            ->orderByRaw('closes_at is null')
            ->orderBy('closes_at')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.vacancies.index', [
            'vacancies' => $vacancies,
            'filters' => self::FILTERS,
            'activeFilter' => $filter,
            'search' => $search,
            'expiredCount' => JobVacancy::expired()->count(),
        ]);
    }

    public function create(Request $request): View
    {
        $vacancy = new JobVacancy([
            'partner_id' => $request->query('partner'),
            'status' => VacancyStatus::Open,
            'closes_at' => today()->addDays(30),
        ]);

        return $this->form('admin.vacancies.create', $vacancy);
    }

    public function store(JobVacancyRequest $request): RedirectResponse
    {
        JobVacancy::create($request->validated());

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(JobVacancy $vacancy): View
    {
        return $this->form('admin.vacancies.edit', $vacancy);
    }

    public function update(JobVacancyRequest $request, JobVacancy $vacancy): RedirectResponse
    {
        $vacancy->update($request->validated());

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(JobVacancy $vacancy): RedirectResponse
    {
        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    private function form(string $view, JobVacancy $vacancy): View
    {
        return view($view, [
            'vacancy' => $vacancy,
            'partners' => Partner::orderBy('name')->get(),
            'employmentTypes' => EmploymentType::cases(),
            'statuses' => VacancyStatus::cases(),
        ]);
    }
}
