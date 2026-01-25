<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'Вопросы';

    protected static ?string $modelLabel = 'Вопрос';

    protected static ?string $pluralModelLabel = 'Вопросы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('test_id')
                    ->label('Тест')
                    ->relationship('test', 'id')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('title', 'kz') ?? 'Test')
                    ->required(),
                Tabs::make('Translations')
                    ->tabs([
                        Tabs\Tab::make('KZ')
                            ->schema([
                                Forms\Components\Textarea::make('question_kz')
                                    ->label('Question (KZ)')
                                    ->required()
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('question', 'kz')))
                                    ->dehydrated(false),
                                Forms\Components\TagsInput::make('options_kz')
                                    ->label('Options (KZ)')
                                    ->helperText('Type option and press Enter')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state(json_decode($record?->getTranslation('options', 'kz') ?? '[]', true)))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\Textarea::make('question_ru')
                                    ->label('Question (RU)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('question', 'ru')))
                                    ->dehydrated(false),
                                Forms\Components\TagsInput::make('options_ru')
                                    ->label('Options (RU)')
                                    ->helperText('Type option and press Enter')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state(json_decode($record?->getTranslation('options', 'ru') ?? '[]', true)))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\Textarea::make('question_en')
                                    ->label('Question (EN)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('question', 'en')))
                                    ->dehydrated(false),
                                Forms\Components\TagsInput::make('options_en')
                                    ->label('Options (EN)')
                                    ->helperText('Type option and press Enter')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state(json_decode($record?->getTranslation('options', 'en') ?? '[]', true)))
                                    ->dehydrated(false),
                            ]),
                        Tabs\Tab::make('TR')
                            ->schema([
                                Forms\Components\Textarea::make('question_tr')
                                    ->label('Question (TR)')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state($record?->getTranslation('question', 'tr')))
                                    ->dehydrated(false),
                                Forms\Components\TagsInput::make('options_tr')
                                    ->label('Options (TR)')
                                    ->helperText('Type option and press Enter')
                                    ->afterStateHydrated(fn($component, $state, $record) =>
                                        $component->state(json_decode($record?->getTranslation('options', 'tr') ?? '[]', true)))
                                    ->dehydrated(false),
                            ]),
                    ])->columnSpanFull(),
                Forms\Components\TextInput::make('correct_answer')
                    ->label('Правильный ответ (Текст)')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test.id')
                    ->label('ID Теста')
                    ->sortable(),
                Tables\Columns\TextColumn::make('question')
                    ->label('Question (KZ)')
                    ->prefix('KZ: ')
                    ->limit(50)
                    ->getStateUsing(fn($record) => $record->getTranslation('question', 'kz'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('correct_answer')
                    ->label('Правильный ответ'),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
