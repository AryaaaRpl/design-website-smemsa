<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Akun pendaftar SPMB online (guard "applicant").
 */
#[Fillable(['email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class Applicant extends Authenticatable
{
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class);
    }
}
