<?php

namespace App\Filament\Resources\ForumReplyResource\Pages;

use App\Filament\Resources\ForumReplyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForumReplies extends ListRecords
{
    protected static string $resource = ForumReplyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
