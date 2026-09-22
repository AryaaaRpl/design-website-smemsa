<?php

namespace App\Models;

use App\Enums\EmploymentType;
use App\Enums\VacancyStatus;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Lowongan kerja BKK.
 */
#[Fillable(['partner_id', 'position', 'slug', 'employment_type', 'location', 'description', 'requirements', 'apply_url', 'status', 'closes_at'])]
class JobVacancy extends Model
{
    use HasSlug;

    protected $attributes = [
        'status' => 'open',
    ];

    protected function casts(): array
    {
        return [
            'employment_type' => EmploymentType::class,
            'status' => VacancyStatus::class,
            'closes_at' => 'date',
        ];
    }

    protected function slugSource(): string
    {
        return 'position';
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Open vacancies whose deadline has not passed.
     */
    #[Scope]
    protected function open(Builder $query): void
    {
        $query->where('status', VacancyStatus::Open)
            ->where(fn (Builder $q) => $q->whereNull('closes_at')->orWhereDate('closes_at', '>=', today()));
    }
}
