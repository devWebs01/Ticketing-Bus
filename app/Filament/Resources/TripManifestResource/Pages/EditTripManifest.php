<?php

namespace App\Filament\Resources\TripManifestResource\Pages;

use App\Filament\Resources\TripManifestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTripManifest extends EditRecord
{
    protected static string $resource = TripManifestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
