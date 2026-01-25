<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForumTopicResource\Pages;
use App\Models\ForumTopic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ForumTopicResource extends Resource
{
    protected static ?string $model = ForumTopic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Форум';
    protected static ?string $modelLabel = 'Тема';
    protected static ?string $pluralModelLabel = 'Темы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Автор')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Категория')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('Содержание')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('views_count')
                            ->label('Просмотры')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_pinned')
                            ->label('Закреплено')
                            ->inline(false),
                        Forms\Components\Toggle::make('is_hot')
                            ->label('Горячее')
                            ->inline(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Автор')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable()
                    ->badge()
                    ->color(fn($record) => match ($record->category->slug) {
                        'questions' => 'danger',
                        'general-discussion' => 'info',
                        'history' => 'warning',
                        'religion' => 'success',
                        'culture' => 'primary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('views_count')
                    ->label('Просмотры')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_pinned')
                    ->label('Закреплено')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_hot')
                    ->label('Горячее')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Категория')
                    ->relationship('category', 'name'),
                Tables\Filters\Filter::make('pinned')
                    ->label('Закрепленные')
                    ->query(fn($query) => $query->where('is_pinned', true)),
                Tables\Filters\Filter::make('hot')
                    ->label('Горячие')
                    ->query(fn($query) => $query->where('is_hot', true)),
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
            'index' => Pages\ListForumTopics::route('/'),
            'create' => Pages\CreateForumTopic::route('/create'),
            'edit' => Pages\EditForumTopic::route('/{record}/edit'),
        ];
    }
}
