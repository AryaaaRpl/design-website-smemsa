<?php

namespace App\Models;

use App\Models\Concerns\HasMediaUrl;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Foto galeri fasilitas. Foto dengan urutan paling kecil = foto utama.
 */
#[Fillable(['facility_id', 'path', 'caption', 'sort_order'])]
class FacilityImage extends Model
{
    use HasMediaUrl;

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    protected function url(): Attribute
    {
        return Attribute::get(fn () => $this->mediaUrl($this->path));
    }
}
