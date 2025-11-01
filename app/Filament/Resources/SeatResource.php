<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeatResource\Pages;
use App\Models\Seat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeatResource extends Resource
{
    protected static ?string $model = Seat::class;

    protected static ?string $modelLabel = 'Kursi';

    protected static ?string $pluralModelLabel = 'Kursi';

    protected static ?string $navigationLabel = 'Kursi';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kursi')
                    ->schema([
                        Forms\Components\Select::make('schedule_id')
                            ->relationship('schedule', 'route.origin')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->route->origin} → {$record->route->destination} | ".
                                $record->date->format('d/m/Y').' | '.
                                $record->departure_time->format('H:i')
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Jadwal'),

                        Forms\Components\TextInput::make('seat_number')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Nomor Kursi')
                            ->placeholder('A01, B05, dll'),

                        Forms\Components\Select::make('seat_type')
                            ->options([
                                'regular' => 'Regular',
                                'vip' => 'VIP',
                                'business' => 'Business',
                            ])
                            ->default('regular')
                            ->required()
                            ->label('Tipe Kursi'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'available' => 'Tersedia',
                                'booked' => 'Dipesan',
                                'blocked' => 'Diblokir',
                            ])
                            ->default('available')
                            ->required()
                            ->label('Status'),

                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('Rp')
                            ->label('Harga Kursi')
                            ->helperText('Kosongkan untuk menggunakan harga jadwal default'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('schedule.departure_city')
                    ->label('Asal')
                    ->searchable(),

                Tables\Columns\TextColumn::make('schedule.arrival_city')
                    ->label('Tujuan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('schedule.date')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('seat_number')
                    ->label('No. Kursi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('seat_type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'regular' => 'gray',
                        'vip' => 'warning',
                        'business' => 'success',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'booked' => 'danger',
                        'blocked' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'available' => 'Tersedia',
                        'booked' => 'Dipesan',
                        'blocked' => 'Diblokir',
                    }),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->getStateUsing(fn ($record) => $record->price ?? $record->schedule->price)
                    ->sortable(),

                Tables\Columns\TextColumn::make('schedule.vehicle_number')
                    ->label('Kendaraan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Tersedia',
                        'booked' => 'Dipesan',
                        'blocked' => 'Diblokir',
                    ]),

                Tables\Filters\SelectFilter::make('seat_type')
                    ->label('Tipe Kursi')
                    ->options([
                        'regular' => 'Regular',
                        'vip' => 'VIP',
                        'business' => 'Business',
                    ]),

                Tables\Filters\SelectFilter::make('schedule_id')
                    ->label('Jadwal')
                    ->relationship('schedule', 'departure_city')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->departure_city} → {$record->arrival_city} ({$record->date->format('d/m/Y')})"
                    )
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('block')
                    ->label('Blokir')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->visible(fn ($record) => $record->status === 'available')
                    ->requiresConfirmation()
                    ->modalHeading('Blokir Kursi')
                    ->modalDescription('Apakah Anda yakin ingin memblokir kursi ini?')
                    ->modalSubmitActionLabel('Ya, Blokir')
                    ->action(fn ($record) => $record->update(['status' => 'blocked'])),

                Tables\Actions\Action::make('unblock')
                    ->label('Buka Blokir')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'blocked')
                    ->requiresConfirmation()
                    ->modalHeading('Buka Blokir Kursi')
                    ->modalDescription('Apakah Anda yakin ingin membuka blokir kursi ini?')
                    ->modalSubmitActionLabel('Ya, Buka Blokir')
                    ->action(fn ($record) => $record->update(['status' => 'available'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListSeats::route('/'),
            'create' => Pages\CreateSeat::route('/create'),
            'edit' => Pages\EditSeat::route('/{record}/edit'),
        ];
    }
}
