<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'correct_answer',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

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

    public function getOptionsAttribute(): array
    {
        $locale = app()->getLocale();
        $options = $this->getTranslation('options', $locale);
        return $options ? json_decode($options, true) : [];
    }

    public function setOptionsAttribute(array $value): void
    {
        $locale = app()->getLocale();
        $this->setTranslation('options', $locale, json_encode($value));
    }
}