<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = ['visited_on', 'visitor_hash'];

    protected function casts(): array
    {
        return [
            'visited_on' => 'date',
        ];
    }
}
