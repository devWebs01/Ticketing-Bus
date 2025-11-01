<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Pengguna';

    protected static ?string $pluralModelLabel = 'Pengguna';

    protected static ?string $navigationLabel = 'Pengguna';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Nama Lengkap'),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Email'),

                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('Email Diverifikasi'),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->minLength(8)
                            ->label('Password')
                            ->helperText('Minimal 8 karakter'),
                    ]),

                Forms\Components\Section::make('Detail Pengguna')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->label('No. Telepon'),

                        Forms\Components\Textarea::make('address')
                            ->rows(3)
                            ->label('Alamat'),

                        Forms\Components\FileUpload::make('profile_image')
                            ->image()
                            ->directory('profile-images')
                            ->visibility('public')
                            ->label('Foto Profil'),

                        Forms\Components\DatePicker::make('date_of_birth')
                            ->maxDate(today()->subYears(17))
                            ->label('Tanggal Lahir'),

                        Forms\Components\Select::make('gender')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->label('Jenis Kelamin'),

                        Forms\Components\TextInput::make('identity_number')
                            ->label('No. KTP')
                            ->unique(ignoreRecord: true)
                            ->length(16)
                            ->helperText('16 digit nomor KTP'),

                        Forms\Components\TextInput::make('emergency_contact_name')
                            ->label('Kontak Darurat - Nama'),

                        Forms\Components\TextInput::make('emergency_contact_phone')
                            ->tel()
                            ->label('Kontak Darurat - Telepon'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('userDetail.profile_image')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl('/images/default-avatar.png'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('userDetail.role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'customer' => 'info',
                        'admin' => 'danger',
                        'checker' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'customer' => 'Pelanggan',
                        'admin' => 'Administrator',
                        'checker' => 'Petugas Tiket',
                    }),

                Tables\Columns\TextColumn::make('userDetail.phone')
                    ->label('Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('userDetail.gender')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                        default => '-',
                    }),

                Tables\Columns\TextColumn::make('userDetail.identity_number')
                    ->label('No. KTP')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Verifikasi')
                    ->dateTime('d/m/Y H:i')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'warning')
                    ->formatStateUsing(fn ($state) => $state ? 'Terverifikasi' : 'Belum'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Bergabung')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Role')
                    ->options([
                        'customer' => 'Pelanggan',
                        'admin' => 'Administrator',
                        'checker' => 'Petugas Tiket',
                    ]),

                Tables\Filters\SelectFilter::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),

                Tables\Filters\Filter::make('verified')
                    ->label('Email Terverifikasi')
                    ->query(fn ($query) => $query->whereNotNull('email_verified_at')),

                Tables\Filters\Filter::make('unverified')
                    ->label('Email Belum Verifikasi')
                    ->query(fn ($query) => $query->whereNull('email_verified_at')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('verify_email')
                    ->label('Verifikasi Email')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => is_null($record->email_verified_at))
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Email')
                    ->modalDescription('Apakah Anda yakin ingin memverifikasi email pengguna ini?')
                    ->modalSubmitActionLabel('Ya, Verifikasi')
                    ->action(fn ($record) => $record->update(['email_verified_at' => now()])),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
