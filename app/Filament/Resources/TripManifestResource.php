<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripManifestResource\Pages;
use App\Models\TripManifest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TripManifestResource extends Resource
{
    protected static ?string $model = TripManifest::class;

    protected static ?string $modelLabel = 'Surat Jalan';

    protected static ?string $pluralModelLabel = 'Surat Jalan';

    protected static ?string $navigationLabel = 'Surat Jalan';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Perjalanan')
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

                        Forms\Components\TextInput::make('manifest_number')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Nomor Manifest')
                            ->placeholder('MF-20241101-001'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'prepared' => 'Disiapkan',
                                'active' => 'Berjalan',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->default('prepared')
                            ->required()
                            ->label('Status'),
                    ]),

                Forms\Components\Section::make('Kru Kendaraan')
                    ->schema([
                        Forms\Components\Select::make('driver_id')
                            ->relationship('driver', 'name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} ({$record->userDetail?->phone})"
                            )
                            ->searchable()
                            ->preload()
                            ->label('Supir'),

                        Forms\Components\Select::make('conductor_id')
                            ->relationship('conductor', 'name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} ({$record->userDetail?->phone})"
                            )
                            ->searchable()
                            ->preload()
                            ->label('Kondektur'),
                    ]),

                Forms\Components\Section::make('Waktu & Data Perjalanan')
                    ->schema([
                        Forms\Components\DateTimePicker::make('departure_time_actual')
                            ->label('Waktu Keberangkatan Aktual'),

                        Forms\Components\DateTimePicker::make('arrival_time_actual')
                            ->label('Waktu Kedatangan Aktual'),

                        Forms\Components\TextInput::make('total_passengers')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->label('Total Penumpang'),

                        Forms\Components\TextInput::make('total_revenue')
                            ->numeric()
                            ->default(0)
                            ->prefix('Rp')
                            ->label('Total Pendapatan'),

                        Forms\Components\Textarea::make('notes')
                            ->rows(3)
                            ->label('Catatan'),

                        Forms\Components\Textarea::make('staff_notes')
                            ->rows(3)
                            ->label('Catatan Staff'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('manifest_number')
                    ->label('No. Manifest')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

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

                Tables\Columns\TextColumn::make('driver.name')
                    ->label('Supir')
                    ->searchable(),

                Tables\Columns\TextColumn::make('conductor.name')
                    ->label('Kondektur')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_passengers')
                    ->label('Penumpang')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Pendapatan')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'prepared' => 'warning',
                        'active' => 'success',
                        'completed' => 'info',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'prepared' => 'Disiapkan',
                        'active' => 'Berjalan',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    }),

                Tables\Columns\TextColumn::make('departure_time_actual')
                    ->label('Berangkat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('arrival_time_actual')
                    ->label('Tiba')
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
                        'prepared' => 'Disiapkan',
                        'active' => 'Berjalan',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ]),

                Tables\Filters\Filter::make('today')
                    ->label('Hari Ini')
                    ->query(fn (Builder $query): Builder => $query->whereHas('schedule', fn ($q) => $q->whereDate('date', today()))),

                Tables\Filters\Filter::make('active')
                    ->label('Sedang Berjalan')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'active')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('activate')
                    ->label('Aktifkan')
                    ->icon('heroicon-o-play')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'prepared' && $record->canBeActivated())
                    ->requiresConfirmation()
                    ->modalHeading('Aktifkan Manifest')
                    ->modalDescription('Apakah Anda yakin ingin mengaktifkan manifest perjalanan ini?')
                    ->modalSubmitActionLabel('Ya, Aktifkan')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'active',
                            'departure_time_actual' => now(),
                        ]);
                    }),

                Tables\Actions\Action::make('complete')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('info')
                    ->visible(fn ($record) => $record->status === 'active')
                    ->requiresConfirmation()
                    ->modalHeading('Selesaikan Perjalanan')
                    ->modalDescription('Apakah perjalanan telah selesai?')
                    ->modalSubmitActionLabel('Ya, Selesai')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'completed',
                            'arrival_time_actual' => now(),
                        ]);
                    }),

                Tables\Actions\Action::make('print_manifest')
                    ->label('Cetak Manifest')
                    ->icon('heroicon-o-printer')
                    ->color('gray')
                    ->url(fn ($record) => route('manifest.print', $record->id))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListTripManifests::route('/'),
            'create' => Pages\CreateTripManifest::route('/create'),
            'edit' => Pages\EditTripManifest::route('/{record}/edit'),
        ];
    }
}
