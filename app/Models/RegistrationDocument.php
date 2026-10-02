<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Berkas pendaftar (disimpan di disk privat "local", tidak bisa dibuka lewat URL publik).
 */
#[Fillable(['type', 'path', 'original_name'])]
class RegistrationDocument extends Model
{
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function label(): string
    {
        return Registration::DOCUMENTS[$this->type] ?? $this->type;
    }
}
