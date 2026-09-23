<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Simpan model yang punya kolom `is_featured` dengan aturan headline hanya satu.
 * Jika model ini dijadikan headline, headline lama dilepas dalam transaksi yang sama.
 */
trait SavesWithHeadline
{
    /**
     * @return Model|null Headline lama yang digantikan.
     */
    protected function saveWithHeadline(Model $model, array $data): ?Model
    {
        return DB::transaction(function () use ($model, $data) {
            $previousHeadline = null;

            if (! empty($data['is_featured'])) {
                $otherHeadlines = $model->newQuery()
                    ->where('is_featured', true)
                    ->when($model->exists, fn ($query) => $query->whereKeyNot($model->getKey()));

                $previousHeadline = (clone $otherHeadlines)->lockForUpdate()->first();
                $otherHeadlines->update(['is_featured' => false]);
            }

            $model->fill($data)->save();

            return $previousHeadline;
        });
    }

    /**
     * Pesan sukses, ditambah info headline lama yang digantikan (jika ada).
     */
    protected function headlineMessage(string $message, ?Model $previousHeadline, string $label): string
    {
        if (! $previousHeadline) {
            return $message;
        }

        return "{$message} \"{$previousHeadline->title}\" tidak lagi menjadi {$label}.";
    }
}
