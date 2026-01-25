<?php

namespace App\Filament\Resources\LifeSectionResource\Pages;

use App\Filament\Resources\LifeSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLifeSections extends ListRecords
{
    protected static string $resource = LifeSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
