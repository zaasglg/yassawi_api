<?php

namespace App\Filament\Resources\LifeSectionResource\Pages;

use App\Filament\Resources\LifeSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLifeSection extends CreateRecord
{
    protected static string $resource = LifeSectionResource::class;

    protected function afterCreate(): void
    {
        $data = $this->form->getRawState();

        foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
            foreach (['title', 'content'] as $field) {
                if (isset($data["{$field}_{$locale}"])) {
                    $this->record->setTranslation($field, $locale, $data["{$field}_{$locale}"]);
                }
            }
        }
    }
}
