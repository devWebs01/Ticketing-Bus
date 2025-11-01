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
                Tables\Actions\AssociateAction::make(),
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
