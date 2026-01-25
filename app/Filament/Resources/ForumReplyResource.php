<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForumReplyResource\Pages;
use App\Models\ForumReply;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ForumReplyResource extends Resource
{
    protected static ?string $model = ForumReply::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Форум';
    protected static ?string $modelLabel = 'Ответ';
    protected static ?string $pluralModelLabel = 'Ответы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('topic_id')
                    ->relationship('topic', 'title')
                    ->label('Тема')
                    ->searchable()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Пользователь')
                    ->searchable()
                    ->required(),
                Forms\Components\Toggle::make('is_best_answer')
                    ->label('Лучший ответ'),
                Forms\Components\Textarea::make('content')
                    ->label('Содержание')
                    ->required()
                    ->columnSpanFull()
                    ->rows(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('topic.title')
                    ->label('Тема')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Пользователь')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Содержание')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_best_answer')
                    ->label('Лучший ответ')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('topic')
                    ->label('Тема')
                    ->relationship('topic', 'title')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForumReplies::route('/'),
            'create' => Pages\CreateForumReply::route('/create'),
            'edit' => Pages\EditForumReply::route('/{record}/edit'),
        ];
    }
}
