<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleSeatResource\Pages;
use App\Models\VehicleSeat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleSeatResource extends Resource
{
    protected static ?string $model = VehicleSeat::class;

    protected static ?string $modelLabel = 'Kursi Kendaraan';

    protected static ?string $pluralModelLabel = 'Kursi Kendaraan';

    protected static ?string $navigationLabel = 'Kursi Kendaraan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kursi')
                    ->schema([
                        Forms\Components\Select::make('vehicle_id')
                            ->relationship('vehicle', 'vehicle_number')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->vehicle_type} - {$record->vehicle_number}")
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Kendaraan'),

                        Forms\Components\TextInput::make('seat_number')
                            ->required()
                            ->label('Nomor Kursi')
                            ->placeholder('A01, B05, dll'),

                        Forms\Components\Select::make('seat_type')
                            ->options([
                                'regular' => 'Regular',
                                'vip' => 'VIP',
                                'business' => 'Bisnis',
                                'driver' => 'Supir',
                                'conductor' => 'Kondektur',
                            ])
                            ->default('regular')
                            ->required()
                            ->label('Tipe Kursi'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vehicle.vehicle_number')
                    ->label('Kendaraan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('vehicle.vehicle_type')
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

                Tables\Columns\TextColumn::make('seat_number')
                    ->label('Nomor Kursi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('seat_type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'regular' => 'gray',
                        'vip' => 'warning',
                        'business' => 'success',
                        'driver' => 'danger',
                        'conductor' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'regular' => 'Regular',
                        'vip' => 'VIP',
                        'business' => 'Bisnis',
                        'driver' => 'Supir',
                        'conductor' => 'Kondektur',
                    })
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('seat_type')
                    ->label('Tipe Kursi')
                    ->options([
                        'regular' => 'Regular',
                        'vip' => 'VIP',
                        'business' => 'Bisnis',
                        'driver' => 'Supir',
                        'conductor' => 'Kondektur',
                    ]),

                Tables\Filters\SelectFilter::make('vehicle.vehicle_type')
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
            ->defaultSort('vehicle.vehicle_number', 'asc');
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
            'index' => Pages\ListVehicleSeats::route('/'),
            'create' => Pages\CreateVehicleSeat::route('/create'),
            'edit' => Pages\EditVehicleSeat::route('/{record}/edit'),
        ];
    }
}
