<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LifeSectionResource\Pages;
use App\Models\LifeSection;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LifeSectionResource extends Resource
{
    protected static ?string $model = LifeSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Разделы жизни';

    protected static ?string $modelLabel = 'Раздел жизни';

    protected static ?string $pluralModelLabel = 'Разделы жизни';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('slug')
                    ->label('Слаг (URL)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->label('Порядок сортировки')
                    ->numeric()
                    ->default(0),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image(),
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
                                    ->required()
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
                Tables\Columns\TextColumn::make('slug')
                    ->label('Слаг')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')->label('Изображение'),
                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLifeSections::route('/'),
            'create' => Pages\CreateLifeSection::route('/create'),
            'edit' => Pages\EditLifeSection::route('/{record}/edit'),
        ];
    }
}
