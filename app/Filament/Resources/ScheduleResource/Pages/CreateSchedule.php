<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Schedule;
use Filament\Resources\Pages\CreateRecord;

class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;

    protected function handleRecordCreation(array $data): Schedule
    {
        $days = $data['days'];
        unset($data['days']);

        $schedule = Schedule::create($data);

        foreach ($days as $day) {
            $schedule->days()->create(['day_of_week' => $day]);
        }

        // Generate seats based on the vehicle template
        $this->generateSeatsFromVehicle($schedule);

        return $schedule;
    }

    private function generateSeatsFromVehicle(Schedule $schedule): void
    {
        if ($schedule->vehicle) {
            foreach ($schedule->vehicle->seats as $vehicleSeat) {
                $schedule->seats()->create([
                    'seat_number' => $vehicleSeat->seat_number,
                    'seat_type' => $vehicleSeat->seat_type,
                    'status' => 'available',
                ]);
            }
        }
    }
}
