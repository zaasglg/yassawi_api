<?php

namespace App\Filament\Resources\TestResource\Pages;

use App\Filament\Resources\TestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTest extends CreateRecord
{
    protected static string $resource = TestResource::class;

    protected function afterCreate(): void
    {
        $data = $this->form->getRawState();

        foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
            foreach (['title'] as $field) {
                if (isset($data["{$field}_{$locale}"])) {
                    $this->record->setTranslation($field, $locale, $data["{$field}_{$locale}"]);
                }
            }
        }
    }
}
