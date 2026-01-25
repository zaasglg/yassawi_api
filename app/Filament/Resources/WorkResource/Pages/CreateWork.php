<?php

namespace App\Filament\Resources\WorkResource\Pages;

use App\Filament\Resources\WorkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWork extends CreateRecord
{
    protected static string $resource = WorkResource::class;

    protected function afterCreate(): void
    {
        $data = $this->form->getRawState();

        foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
            foreach (['title', 'short_description', 'main_content', 'spiritual_value'] as $field) {
                if (isset($data["{$field}_{$locale}"])) {
                    $this->record->setTranslation($field, $locale, $data["{$field}_{$locale}"]);
                }
            }
        }
    }
}
