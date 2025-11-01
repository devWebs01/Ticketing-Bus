<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $modelLabel = 'Jadwal';

    protected static ?string $pluralModelLabel = 'Jadwal';

    protected static ?string $navigationLabel = 'Jadwal';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Jadwal')
                    ->schema([
                        Forms\Components\Select::make('route_id')
                            ->relationship('route', 'route_name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->route_name}")
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Rute'),

                        Forms\Components\Select::make('vehicle_id')
                            ->relationship('vehicle', 'vehicle_number')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->vehicle_type} - {$record->vehicle_number} ({$record->total_seats} kursi)")
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Kendaraan'),

                        Forms\Components\TimePicker::make('departure_time')
                            ->required()
                            ->label('Jam Berangkat')
                            ->seconds(false),

                        Forms\Components\CheckboxList::make('days')
                            ->label('Hari Operasional')
                            ->options([
                                'monday' => 'Senin',
                                'tuesday' => 'Selasa',
                                'wednesday' => 'Rabu',
                                'thursday' => 'Kamis',
                                'friday' => 'Jumat',
                                'saturday' => 'Sabtu',
                                'sunday' => 'Minggu',
                            ])
                            ->columns(4)
                            ->helperText('Pilih hari-hari keberangkatan rutin.')
                            ->required()
                            ->live()
                            ->afterStateHydrated(function ($component, $state, $record) {
                                // Isi state dengan data dari relationship
                                if ($record && $record->days) {
                                    $component->state($record->days->pluck('day_of_week')->toArray());
                                }
                            }),
                    ]),

                Forms\Components\Section::make('Harga & Status')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->label('Harga Tiket')
                            ->step(0.01),

                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Aktif',
                                'cancelled' => 'Dibatalkan',
                                'completed' => 'Selesai',
                            ])
                            ->default('active')
                            ->required()
                            ->label('Status'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('route.origin')
                    ->label('Asal')
                    ->searchable(),

                Tables\Columns\TextColumn::make('route.destination')
                    ->label('Tujuan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('departure_time')
                    ->label('Berangkat')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('days_list')
                    ->label('Hari Operasional')
                    ->getStateUsing(function ($record) {
                        if ($record && $record->days) {
                            $dayMap = [
                                'monday' => 'Senin',
                                'tuesday' => 'Selasa',
                                'wednesday' => 'Rabu',
                                'thursday' => 'Kamis',
                                'friday' => 'Jumat',
                                'saturday' => 'Sabtu',
                                'sunday' => 'Minggu',
                            ];

                            return $record->days->pluck('day_of_week')->map(function ($day) use ($dayMap) {
                                return $dayMap[$day] ?? $day;
                            })->join(', ');
                        }

                        return '';
                    })
                    ->limit(30),

                Tables\Columns\TextColumn::make('vehicle.vehicle_number')
                    ->label('No. Kendaraan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('vehicle.vehicle_type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bus' => 'success',
                        'minibus' => 'warning',
                        'van' => 'info',
                    }),

                Tables\Columns\TextColumn::make('vehicle.total_seats')
                    ->label('Total Kursi')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Aktif',
                        'cancelled' => 'Dibatalkan',
                        'completed' => 'Selesai',
                    }),

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
                        'active' => 'Aktif',
                        'cancelled' => 'Dibatalkan',
                        'completed' => 'Selesai',
                    ]),

                Tables\Filters\SelectFilter::make('vehicle_type')
                    ->label('Tipe Kendaraan')
                    ->options([
                        'bus' => 'Bus',
                        'minibus' => 'Mini Bus',
                        'van' => 'Van',
                    ]),

                Tables\Filters\Filter::make('today')
                    ->label('Hari Ini')
                    ->query(fn (Builder $query): Builder => $query->activeToday()),

                Tables\Filters\SelectFilter::make('day_of_week')
                    ->label('Hari Operasional')
                    ->options([
                        'monday' => 'Senin',
                        'tuesday' => 'Selasa',
                        'wednesday' => 'Rabu',
                        'thursday' => 'Kamis',
                        'friday' => 'Jumat',
                        'saturday' => 'Sabtu',
                        'sunday' => 'Minggu',
                    ])
                    ->query(
                        fn (Builder $query, array $data): Builder => isset($data['value']) ? $query->activeOnDay($data['value']) : $query
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('create_manifest')
                    ->label('Buat Manifest')
                    ->icon('heroicon-o-document-text')
                    ->color('info')
                    ->visible(fn ($record) => ! $record->tripManifest && $record->status === 'active')
                    ->url(fn ($record) => route('filament.admin.resources.trip-manifests.create', [
                        'schedule_id' => $record->id,
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('departure_time', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function mutateFormDataBeforeFill(array $data): array
    {
        // Coba ambil id dari data atau dari route param ('record' karena route '/{record}/edit')
        $id = $data['id'] ?? request()->route('record');

        if ($id) {
            $schedule = \App\Models\Schedule::with('days')->find($id);

            if ($schedule) {
                $data['days'] = $schedule->days->pluck('day_of_week')->toArray();
            }
        }

        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
