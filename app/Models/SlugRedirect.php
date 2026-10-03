<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * Slug lama yang dialihkan ke data terbarunya (lihat HasSlug).
 */
#[Fillable(['model_type', 'model_id', 'old_slug'])]
class SlugRedirect extends Model {}
