<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $modelLabel = 'Pembayaran';

    protected static ?string $pluralModelLabel = 'Pembayaran';

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pembayaran')
                    ->schema([
                        Forms\Components\Select::make('booking_id')
                            ->relationship('booking', 'booking_reference')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "Ref: {$record->booking_reference} - {$record->user->name} - ".
                                "{$record->schedule->route->origin} → {$record->schedule->route->destination}"
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Pemesanan'),

                        Forms\Components\Select::make('payment_method')
                            ->options([
                                'cash' => 'Tunai',
                                'transfer' => 'Transfer Bank',
                                'credit_card' => 'Kartu Kredit',
                                'e_wallet' => 'E-Wallet',
                            ])
                            ->required()
                            ->label('Metode Pembayaran'),

                        Forms\Components\TextInput::make('amount')
                            ->prefix('Rp')
                            ->numeric()
                            ->required()
                            ->label('Jumlah'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Menunggu Konfirmasi',
                                'success' => 'Berhasil',
                                'failed' => 'Gagal',
                                'refunded' => 'Dikembalikan',
                            ])
                            ->default('pending')
                            ->required()
                            ->label('Status'),

                        Forms\Components\DateTimePicker::make('payment_date')
                            ->default(now())
                            ->label('Tanggal Pembayaran'),

                        Forms\Components\TextInput::make('transaction_id')
                            ->label('ID Transaksi'),

                        Forms\Components\FileUpload::make('payment_proof')
                            ->label('Bukti Pembayaran')
                            ->image()
                            ->directory('payment-proofs')
                            ->visibility('public'),

                        Forms\Components\Textarea::make('payment_gateway_response')
                            ->label('Response Gateway')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking.booking_reference')
                    ->label('No. Referensi')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('booking.user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'cash' => 'success',
                        'transfer' => 'info',
                        'credit_card' => 'warning',
                        'e_wallet' => 'primary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cash' => 'Tunai',
                        'transfer' => 'Transfer',
                        'credit_card' => 'Kartu Kredit',
                        'e_wallet' => 'E-Wallet',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'success' => 'Berhasil',
                        'failed' => 'Gagal',
                        'refunded' => 'Dikembalikan',
                    }),

                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Tgl. Bayar')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('transaction_id')
                    ->label('ID Transaksi')
                    ->searchable()
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
                        'success' => 'Berhasil',
                        'failed' => 'Gagal',
                        'refunded' => 'Dikembalikan',
                    ]),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Metode')
                    ->options([
                        'cash' => 'Tunai',
                        'transfer' => 'Transfer Bank',
                        'credit_card' => 'Kartu Kredit',
                        'e_wallet' => 'E-Wallet',
                    ]),

                Tables\Filters\Filter::make('today')
                    ->label('Hari Ini')
                    ->query(fn (Builder $query): Builder => $query->whereDate('payment_date', today())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pembayaran')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui pembayaran ini?')
                    ->modalSubmitActionLabel('Ya, Setujui')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'success',
                            'payment_date' => now(),
                        ]);

                        // Update booking status to confirmed
                        $record->booking->update(['status' => 'confirmed']);
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3),
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Pembayaran')
                    ->modalDescription('Berikan alasan penolakan pembayaran ini.')
                    ->modalSubmitActionLabel('Tolak Pembayaran')
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'failed',
                            'payment_gateway_response' => [
                                'rejection_reason' => $data['rejection_reason'],
                                'rejected_at' => now()->toISOString(),
                                'rejected_by' => auth()->id() ? auth()->user()->name : 'System',
                            ],
                        ]);

                        // Update booking status to cancelled
                        $record->booking->update(['status' => 'cancelled']);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Remove bulk delete as per requirements
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePayments::route('/'),
        ];
    }
}
