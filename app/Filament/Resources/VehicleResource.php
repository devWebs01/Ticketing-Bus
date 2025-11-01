<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $modelLabel = 'Kendaraan';

    protected static ?string $pluralModelLabel = 'Kendaraan';

    protected static ?string $navigationLabel = 'Kendaraan';

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kendaraan')
                    ->schema([
                        Forms\Components\TextInput::make('vehicle_number')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Nomor Kendaraan')
                            ->placeholder('B 1234 ABC'),

                        Forms\Components\Select::make('vehicle_type')
                            ->options([
                                'bus' => 'Bus',
                                'minibus' => 'Mini Bus',
                                'van' => 'Van',
                                'truck' => 'Truk',
                            ])
                            ->required()
                            ->label('Tipe Kendaraan'),

                        Forms\Components\TextInput::make('total_seats')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->label('Total Kursi'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                                'maintenance' => 'Perawatan',
                            ])
                            ->default('active')
                            ->required()
                            ->label('Status'),

                        Forms\Components\Textarea::make('notes')
                            ->rows(3)
                            ->label('Catatan')
                            ->helperText('Kapasitas, fasilitas, atau informasi tambahan'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vehicle_number')
                    ->label('Nomor Kendaraan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('vehicle_type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bus' => 'success',
                        'minibus' => 'warning',
                        'van' => 'info',
                        'truck' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'bus' => 'Bus',
                        'minibus' => 'Mini Bus',
                        'van' => 'Van',
                        'truck' => 'Truk',
                        default => $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_seats')
                    ->label('Total Kursi')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'maintenance' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'maintenance' => 'Perawatan',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('schedules_count')
                    ->label('Jadwal')
                    ->getStateUsing(fn ($record) => $record->schedules()->count())
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'maintenance' => 'Perawatan',
                    ]),

                Tables\Filters\SelectFilter::make('vehicle_type')
                    ->label('Tipe Kendaraan')
                    ->options([
                        'bus' => 'Bus',
                        'minibus' => 'Mini Bus',
                        'van' => 'Van',
                        'truck' => 'Truk',
                    ]),
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
            ->defaultSort('vehicle_number', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VehicleSeatsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
