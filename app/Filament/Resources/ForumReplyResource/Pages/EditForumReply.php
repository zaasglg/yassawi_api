<?php

namespace App\Filament\Resources\ForumReplyResource\Pages;

use App\Filament\Resources\ForumReplyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditForumReply extends EditRecord
{
    protected static string $resource = ForumReplyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
