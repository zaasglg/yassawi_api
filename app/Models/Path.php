<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Path extends Model
{
    use HasFactory;

    protected $fillable = [
        'coordinates',
    ];

    protected $casts = [
        'coordinates' => 'array',
    ];

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'model');
    }

    public function getTranslation(string $field, string $locale): ?string
    {
        return $this->translations()
            ->where('field', $field)
            ->where('locale', $locale)
            ->value('value') ?? $this->translations()
                ->where('field', $field)
                ->where('locale', 'kz')
                ->value('value');
    }

    public function setTranslation(string $field, string $locale, ?string $value): void
    {
        $this->translations()->updateOrCreate(
            ['field' => $field, 'locale' => $locale],
            ['value' => $value]
        );
    }
}
