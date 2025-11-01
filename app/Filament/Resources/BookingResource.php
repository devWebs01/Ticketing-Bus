<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $modelLabel = 'Pemesanan';

    protected static ?string $pluralModelLabel = 'Pemesanan';

    protected static ?string $navigationLabel = 'Pemesanan';

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pemesan')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} ({$record->email})")
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Pelanggan'),
                    ]),

                Forms\Components\Section::make('Detail Perjalanan')
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

                        Forms\Components\Select::make('seat_id')
                            ->relationship('seat', 'seat_number')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "Kursi {$record->seat_number} ({$record->seat_type}) - ".
                                number_format($record->price, 0, ',', '.')
                            )
                            ->options(function (callable $get) {
                                $scheduleId = $get('schedule_id');
                                if (! $scheduleId) {
                                    return [];
                                }

                                return \App\Models\Seat::where('schedule_id', $scheduleId)
                                    ->where('status', 'available')
                                    ->get()
                                    ->mapWithKeys(fn ($seat) => [
                                        $seat->id => "Kursi {$seat->seat_number} ({$seat->seat_type}) - Rp ".
                                                     number_format($seat->price, 0, ',', '.'),
                                    ]);
                            })
                            ->searchable()
                            ->required()
                            ->label('Kursi'),
                    ]),

                Forms\Components\Section::make('Detail Pemesanan')
                    ->schema([
                        Forms\Components\DateTimePicker::make('booking_date')
                            ->default(now())
                            ->required()
                            ->label('Tanggal Pemesanan'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Menunggu Konfirmasi',
                                'confirmed' => 'Dikonfirmasi',
                                'cancelled' => 'Dibatalkan',
                                'checked' => 'Sudah Check-in',
                            ])
                            ->default('pending')
                            ->required()
                            ->label('Status'),

                        Forms\Components\TextInput::make('total_price')
                            ->prefix('Rp')
                            ->numeric()
                            ->required()
                            ->label('Total Harga'),

                        Forms\Components\TextInput::make('booking_reference')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->label('Nomor Referensi'),

                        Forms\Components\Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull()
                            ->label('Catatan'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_reference')
                    ->label('No. Referensi')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),

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

                Tables\Columns\TextColumn::make('seat.seat_number')
                    ->label('Kursi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'checked' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu Konfirmasi',
                        'confirmed' => 'Dikonfirmasi',
                        'cancelled' => 'Dibatalkan',
                        'checked' => 'Sudah Check-in',
                    }),

                Tables\Columns\TextColumn::make('booking_date')
                    ->label('Tgl. Pesan')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),

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
                        'pending' => 'Menunggu Konfirmasi',
                        'confirmed' => 'Dikonfirmasi',
                        'cancelled' => 'Dibatalkan',
                        'checked' => 'Sudah Check-in',
                    ]),

                Tables\Filters\Filter::make('today')
                    ->label('Hari Ini')
                    ->query(fn (Builder $query): Builder => $query->whereDate('booking_date', today())),

                Tables\Filters\Filter::make('this_week')
                    ->label('Minggu Ini')
                    ->query(fn (Builder $query): Builder => $query->whereBetween('booking_date', [
                        now()->startOfWeek(),
                        now()->endOfWeek(),
                    ])),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
