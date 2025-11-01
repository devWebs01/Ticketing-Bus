<?php

namespace App\Filament\Resources\VehicleSeatResource\Pages;

use App\Filament\Resources\VehicleSeatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleSeat extends EditRecord
{
    protected static string $resource = VehicleSeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
