<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudyResource\Pages;
use App\Models\Study;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudyResource extends Resource
{
    protected static ?string $model = Study::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Учеба';

    protected static ?string $modelLabel = 'Учеба';

    protected static ?string $pluralModelLabel = 'Учеба';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Тип')
                    ->options([
                        'video' => 'Видео',
                        'article' => 'Статья',
                        'audio' => 'Аудио',
                    ])
                    ->required()
                    ->reactive(),
                Forms\Components\TextInput::make('video_url')
                    ->label('Ссылка на видео')
                    ->url()
                    ->visible(fn($get) => $get('type') === 'video')
                    ->required(fn($get) => $get('type') === 'video'),
                Forms\Components\TextInput::make('audio_url')
                    ->label('Ссылка на аудио')
                    ->url()
                    ->visible(fn($get) => $get('type') === 'audio')
                    ->required(fn($get) => $get('type') === 'audio'),
                Tabs::make('Translations')
                    ->tabs([
                        Tabs\Tab::make('KZ')
                            ->schema([
                                Forms\Components\TextInput::make('title_kz')
                                    ->label('Title (KZ)')
                                    ->required()
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('title', 'kz')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('content_kz')
                                    ->label('Content (KZ)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('content', 'kz')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\TextInput::make('title_ru')
                                    ->label('Title (RU)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('title', 'ru')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('content_ru')
                                    ->label('Content (RU)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('content', 'ru')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Title (EN)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('title', 'en')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('content_en')
                                    ->label('Content (EN)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('content', 'en')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('TR')
                            ->schema([
                                Forms\Components\TextInput::make('title_tr')
                                    ->label('Title (TR)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('title', 'tr')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('content_tr')
                                    ->label('Content (TR)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('content', 'tr')))
                                    ->dehydrated(false),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title (KZ)')
                    ->getStateUsing(fn($record) => $record->getTranslation('title', 'kz'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->searchable(),
                Tables\Columns\TextColumn::make('video_url')
                    ->label('Видео URL')
                    ->visible(fn($record) => $record && $record->type === 'video'),
                Tables\Columns\TextColumn::make('audio_url')
                    ->label('Аудио URL')
                    ->visible(fn($record) => $record && $record->type === 'audio'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'video' => 'Video',
                        'article' => 'Article',
                        'audio' => 'Audio',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudies::route('/'),
            'create' => Pages\CreateStudy::route('/create'),
            'edit' => Pages\EditStudy::route('/{record}/edit'),
        ];
    }
}
