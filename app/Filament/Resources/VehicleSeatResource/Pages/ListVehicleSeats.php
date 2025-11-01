<?php

namespace App\Filament\Resources\VehicleSeatResource\Pages;

use App\Filament\Resources\VehicleSeatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleSeats extends ListRecords
{
    protected static string $resource = VehicleSeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
