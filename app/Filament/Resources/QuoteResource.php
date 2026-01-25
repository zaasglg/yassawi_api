<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteResource\Pages;
use App\Models\Quote;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationLabel = 'Цитаты';

    protected static ?string $modelLabel = 'Цитата';

    protected static ?string $pluralModelLabel = 'Цитаты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Translations')
                    ->tabs([
                        Tabs\Tab::make('KZ')
                            ->schema([
                                Forms\Components\Textarea::make('text_kz')
                                    ->label('Text (KZ)')
                                    ->required()
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('text', 'kz')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\Textarea::make('text_ru')
                                    ->label('Text (RU)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('text', 'ru')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\Textarea::make('text_en')
                                    ->label('Text (EN)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('text', 'en')))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('TR')
                            ->schema([
                                Forms\Components\Textarea::make('text_tr')
                                    ->label('Text (TR)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('text', 'tr')))
                                    ->dehydrated(false),
                            ]),
                    ])->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Активен')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->label('Text (KZ)')
                    ->limit(50)
                    ->getStateUsing(fn($record) => $record->getTranslation('text', 'kz'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
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
            'index' => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuote::route('/create'),
            'edit' => Pages\EditQuote::route('/{record}/edit'),
        ];
    }
}
