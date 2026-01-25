<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PathResource\Pages;
use App\Models\Path;
use Filament\Forms;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PathResource extends Resource
{
    protected static ?string $model = Path::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = 'Пути';

    protected static ?string $modelLabel = 'Путь';

    protected static ?string $pluralModelLabel = 'Пути';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Map::make('coordinates')
                    ->label('Маршрут')
                    ->columnSpanFull()
                    ->dehydrated(true)
                    ->extraAttributes(['style' => 'min-height: 500px; border-radius: 8px;'])
                    ->formatStateUsing(function ($state) {
                        if (empty($state) || !is_array($state))
                            return null;

                        $coords = [];
                        $firstPoint = null;

                        foreach ($state as $p) {
                            if (isset($p['lat'], $p['lng'])) {
                                $coords[] = [(float) $p['lng'], (float) $p['lat']];
                                if (!$firstPoint) {
                                    $firstPoint = $p;
                                }
                            }
                        }

                        if (empty($coords))
                            return null;

                        $geometryType = count($coords) > 1 ? 'LineString' : 'Point';
                        $coordinates = count($coords) > 1 ? $coords : $coords[0];

                        // Возвращаем в формате, который ожидает карта
                        return [
                            'lat' => $firstPoint['lat'],
                            'lng' => $firstPoint['lng'],
                            'geojson' => [
                                'type' => 'FeatureCollection',
                                'features' => [
                                    [
                                        'type' => 'Feature',
                                        'properties' => [],
                                        'geometry' => [
                                            'type' => $geometryType,
                                            'coordinates' => $coordinates
                                        ]
                                    ]
                                ]
                            ]
                        ];
                    })
                    ->dehydrateStateUsing(function ($state) {
                        if (empty($state))
                            return [];
                        if (!is_array($state))
                            return [];

                        $geoJson = $state['geojson'] ?? $state;
                        $features = $geoJson['features'] ?? [];

                        if (empty($features))
                            return [];

                        $coordinates = [];

                        foreach ($features as $feature) {
                            $geometry = $feature['geometry'] ?? [];
                            $type = $geometry['type'] ?? '';
                            $coords = $geometry['coordinates'] ?? [];

                            if ($type === 'LineString') {
                                foreach ($coords as $point) {
                                    if (is_array($point) && count($point) >= 2) {
                                        $coordinates[] = [
                                            'lat' => (float) $point[1],
                                            'lng' => (float) $point[0]
                                        ];
                                    }
                                }
                            } elseif ($type === 'Point') {
                                if (is_array($coords) && count($coords) >= 2) {
                                    $coordinates[] = [
                                        'lat' => (float) $coords[1],
                                        'lng' => (float) $coords[0]
                                    ];
                                }
                            }
                        }
                        return $coordinates;
                    })
                    ->defaultLocation(43.2973, 68.2734)
                    ->geoMan(true)
                    ->drawPolyline(true)
                    ->drawMarker(false)
                    ->drawPolygon(false)
                    ->drawCircle(false)
                    ->drawCircleMarker(false)
                    ->drawRectangle(false)
                    ->drawText(false)
                    ->rotateMode(false)
                    ->dragMode(true)
                    ->cutPolygon(false)
                    ->editPolygon(true)
                    ->deleteLayer(true)
                    ->setColor('#3388ff')
                    ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png")
                    ->zoom(15),
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
                Tables\Columns\TextColumn::make('coordinates')
                    ->label('Точки')
                    ->formatStateUsing(fn($state) => count(is_array($state) ? $state : []) . ' точек'),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListPaths::route('/'),
            'create' => Pages\CreatePath::route('/create'),
            'edit' => Pages\EditPath::route('/{record}/edit'),
        ];
    }
}
