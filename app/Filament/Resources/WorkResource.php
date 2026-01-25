<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkResource\Pages;
use App\Models\Work;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WorkResource extends Resource
{
    protected static ?string $model = Work::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Труды';

    protected static ?string $modelLabel = 'Труд';

    protected static ?string $pluralModelLabel = 'Труды';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                                Forms\Components\Textarea::make('short_description_kz')
                                    ->label('Short Description (KZ)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('short_description', 'kz')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('main_content_kz')
                                    ->label('Main Content (KZ)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('main_content', 'kz')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('spiritual_value_kz')
                                    ->label('Spiritual Value (KZ)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('spiritual_value', 'kz')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\TextInput::make('title_ru')
                                    ->label('Title (RU)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('title', 'ru')))
                                    ->dehydrated(false),
                                Forms\Components\Textarea::make('short_description_ru')
                                    ->label('Short Description (RU)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('short_description', 'ru')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('main_content_ru')
                                    ->label('Main Content (RU)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('main_content', 'ru')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('spiritual_value_ru')
                                    ->label('Spiritual Value (RU)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('spiritual_value', 'ru')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Title (EN)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('title', 'en')))
                                    ->dehydrated(false),
                                Forms\Components\Textarea::make('short_description_en')
                                    ->label('Short Description (EN)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('short_description', 'en')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('main_content_en')
                                    ->label('Main Content (EN)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('main_content', 'en')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('spiritual_value_en')
                                    ->label('Spiritual Value (EN)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('spiritual_value', 'en')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('TR')
                            ->schema([
                                Forms\Components\TextInput::make('title_tr')
                                    ->label('Title (TR)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('title', 'tr')))
                                    ->dehydrated(false),
                                Forms\Components\Textarea::make('short_description_tr')
                                    ->label('Short Description (TR)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('short_description', 'tr')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('main_content_tr')
                                    ->label('Main Content (TR)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('main_content', 'tr')))
                                    ->dehydrated(false),
                                Forms\Components\RichEditor::make('spiritual_value_tr')
                                    ->label('Spiritual Value (TR)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('spiritual_value', 'tr')))
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
            'index' => Pages\ListWorks::route('/'),
            'create' => Pages\CreateWork::route('/create'),
            'edit' => Pages\EditWork::route('/{record}/edit'),
        ];
    }
}
