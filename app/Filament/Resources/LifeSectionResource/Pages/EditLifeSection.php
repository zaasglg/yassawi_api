<?php

namespace App\Filament\Resources\LifeSectionResource\Pages;

use App\Filament\Resources\LifeSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLifeSection extends EditRecord
{
    protected static string $resource = LifeSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
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
