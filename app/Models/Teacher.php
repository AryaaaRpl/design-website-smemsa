<?php

namespace App\Models;

use App\Enums\TeacherCategory;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Guru & tenaga kependidikan.
 */
#[Fillable(['major_id', 'name', 'slug', 'nip', 'position', 'category', 'photo', 'profile_url', 'sort_order', 'is_active'])]
class Teacher extends Model
{
    use HasSlug;

    protected function casts(): array
    {
        return [
            'category' => TeacherCategory::class,
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function coachedExtracurriculars(): HasMany
    {
        return $this->hasMany(Extracurricular::class, 'coach_id');
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }

    #[Scope]
    protected function ofCategory(Builder $query, TeacherCategory $category): void
    {
        $query->where('category', $category);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('name');
    }
}
