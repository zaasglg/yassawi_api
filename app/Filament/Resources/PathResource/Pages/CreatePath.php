<?php

namespace App\Filament\Resources\PathResource\Pages;

use App\Filament\Resources\PathResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePath extends CreateRecord
{
    protected static string $resource = PathResource::class;

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
