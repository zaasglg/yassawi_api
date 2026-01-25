<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Translation extends Model
{
    protected $fillable = [
        'model_type',
        'model_id',
        'field',
        'locale',
        'value',
    ];

    public function translatable(): MorphTo
    {
        return $this->morphTo('model');
    }
}
