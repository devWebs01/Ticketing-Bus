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

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Rute')
                    ->schema([
                        Forms\Components\Select::make('route_id')
                            ->relationship('route', 'route_name')
                            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->route_name}")
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Rute'),

                        Forms\Components\DatePicker::make('date')
                            ->required()
                            ->minDate(today())
                            ->label('Tanggal Awal')
                            ->helperText('Tanggal mulai untuk jadwal rutin'),

                        Forms\Components\TimePicker::make('departure_time')
                            ->required()
                            ->label('Jam Berangkat'),

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
                            ->visible(fn($context) => $context === 'create'),

                        Forms\Components\TextInput::make('day_of_week')
                            ->label('Hari Jadwal')
                            ->getStateUsing(fn ($record) => $record?->day_of_week)
                            ->visible(fn($context) => $context !== 'create')
                            ->dehydrated(false), // Don't save this field
                    ]),

                Forms\Components\Section::make('Detail Kendaraan & Harga')
                    ->schema([
                        Forms\Components\TextInput::make('vehicle_number')
                            ->label('Nomor Kendaraan')
                            ->placeholder('B 1234 ABC'),

                        Forms\Components\Select::make('vehicle_type')
                            ->options([
                                'bus' => 'Bus',
                                'minibus' => 'Mini Bus',
                                'van' => 'Van',
                            ])
                            ->default('bus')
                            ->required()
                            ->label('Tipe Kendaraan'),

                        Forms\Components\TextInput::make('total_seats')
                            ->required()
                            ->numeric()
                            ->minValue(10)
                            ->maxValue(60)
                            ->label('Total Kursi'),

                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->label('Harga Tiket'),

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

                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Hari')
                    ->getStateUsing(fn ($record) => $record?->day_of_week)
                    ->sortable(),

                Tables\Columns\TextColumn::make('departure_time')
                    ->label('Berangkat')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('vehicle_number')
                    ->label('No. Kendaraan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('vehicle_type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'bus' => 'success',
                        'minibus' => 'warning',
                        'van' => 'info',
                    }),

                Tables\Columns\TextColumn::make('total_seats')
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
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
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
                    ->query(fn(Builder $query): Builder => $query->whereDate('date', today())),

                Tables\Filters\Filter::make('upcoming')
                    ->label('Mendatang')
                    ->query(fn(Builder $query): Builder => $query->where('date', '>=', today())),

                Tables\Filters\Filter::make('past')
                    ->label('Lampau')
                    ->query(fn(Builder $query): Builder => $query->where('date', '<', today())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('create_manifest')
                    ->label('Buat Manifest')
                    ->icon('heroicon-o-document-text')
                    ->color('info')
                    ->visible(fn($record) => ! $record->tripManifest && $record->status === 'active')
                    ->url(fn($record) => route('filament.admin.resources.trip-manifests.create', [
                        'schedule_id' => $record->id,
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
