<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RouteResource\Pages;
use App\Models\Route;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RouteResource extends Resource
{
    protected static ?string $model = Route::class;

    protected static ?string $modelLabel = 'Rute';

    protected static ?string $pluralModelLabel = 'Rute';

    protected static ?string $navigationLabel = 'Rute';

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Rute')
                    ->schema([
                        Forms\Components\TextInput::make('origin')
                            ->required()
                            ->label('Kota Asal')
                            ->placeholder('Contoh: Jakarta'),

                        Forms\Components\TextInput::make('destination')
                            ->required()
                            ->label('Kota Tujuan')
                            ->placeholder('Contoh: Bandung'),

                        Forms\Components\TextInput::make('estimated_duration_hours')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(24)
                            ->label('Durasi Perkiraan (Jam)')
                            ->helperText('Durasi perjalanan dalam jam'),

                        Forms\Components\Select::make('is_active')
                            ->label('Status aktif rute')
                            ->options([
                                1 => 'Aktif',
                                0 => 'Tidak Aktif',
                            ])
                            ->default(1)
                            ->helperText('Status rute')
                            ->native(false),

                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->label('Deskripsi')
                            ->helperText('Deskripsi rute perjalanan')
                            ->columnSpanFull(),

                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('origin')
                    ->label('Asal')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('destination')
                    ->label('Tujuan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('route_name')
                    ->label('Rute')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('estimated_duration_hours')
                    ->label('Durasi (Jam)')
                    ->numeric()
                    ->sortable()
                    ->suffix(' jam'),

                Tables\Columns\TextColumn::make('schedules_count')
                    ->label('Jadwal')
                    ->getStateUsing(fn($record) => $record->schedules()->count())
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        true => 'Aktif',
                        false => 'Tidak Aktif',
                    ]),

                Tables\Filters\Filter::make('has_schedules')
                    ->label('Memiliki Jadwal')
                    ->query(fn($query) => $query->has('schedules')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('origin', 'asc');
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
            'index' => Pages\ListRoutes::route('/'),
            'create' => Pages\CreateRoute::route('/create'),
            'edit' => Pages\EditRoute::route('/{record}/edit'),
        ];
    }
}
