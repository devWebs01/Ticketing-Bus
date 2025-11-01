<?php

namespace App\Filament\Resources\VehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleSeatsRelationManager extends RelationManager
{
    protected static string $relationship = 'seats';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('seat_number')
            ->columns([
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
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('generateSeats')
                    ->label('Generate Kursi Otomatis')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->form([
                        Forms\Components\TextInput::make('total_seats')
                            ->label('Total Kursi')
                            ->numeric()
                            ->default(20)
                            ->required()
                            ->minValue(1)
                            ->maxValue(100),
                        Forms\Components\Select::make('seat_pattern')
                            ->label('Pola Kursi')
                            ->options([
                                'linear' => 'Linear (A01, A02, A03...)',
                                'rows' => 'Per Baris (A01-A10, B01-B10...)',
                            ])
                            ->default('linear')
                            ->required(),
                        Forms\Components\TextInput::make('seats_per_row')
                            ->label('Kursi Per Baris')
                            ->numeric()
                            ->default(10)
                            ->visible(fn (callable $get) => $get('seat_pattern') === 'rows')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $vehicle = $this->getOwnerRecord();
                        $totalSeats = $data['total_seats'];
                        $pattern = $data['seat_pattern'];
                        $seatsPerRow = $data['seats_per_row'] ?? 10;

                        // Clear existing seats
                        $vehicle->seats()->delete();

                        // Generate new seats
                        for ($i = 1; $i <= $totalSeats; $i++) {
                            if ($pattern === 'rows') {
                                $row = chr(65 + floor(($i - 1) / $seatsPerRow)); // A, B, C...
                                $seatNumber = $row.str_pad(($i % $seatsPerRow ?: $seatsPerRow), 2, '0', STR_PAD_LEFT);
                            } else {
                                $seatNumber = 'A'.str_pad($i, 2, '0', STR_PAD_LEFT);
                            }

                            $vehicle->seats()->create([
                                'seat_number' => $seatNumber,
                                'seat_type' => $i <= 2 ? 'vip' : 'regular', // First 2 seats are VIP
                            ]);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
