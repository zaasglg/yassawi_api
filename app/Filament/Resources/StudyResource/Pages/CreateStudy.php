<?php

namespace App\Filament\Resources\StudyResource\Pages;

use App\Filament\Resources\StudyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudy extends CreateRecord
{
    protected static string $resource = StudyResource::class;

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
