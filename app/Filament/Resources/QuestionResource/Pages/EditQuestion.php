<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestion extends EditRecord
{
    protected static string $resource = QuestionResource::class;

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
            // Question text
            if (isset($data["question_{$locale}"])) {
                $this->record->setTranslation('question', $locale, $data["question_{$locale}"]);
            }

            // Options JSON
            if (isset($data["options_{$locale}"])) {
                $options = $data["options_{$locale}"];
                // Ensure it is array
                if (is_array($options)) {
                    $this->record->setTranslation('options', $locale, json_encode($options));
                }
            }
        }
    }
}
