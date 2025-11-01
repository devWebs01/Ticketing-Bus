<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Schedule;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Carbon;

class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;

    protected function handleRecordCreation(array $data): Schedule
    {
        $days = $data['days'];
        unset($data['days']);

        // Generate schedules for the next 7 days from the start date (one week)
        $startDate = Carbon::parse($data['date']);
        $endDate = $startDate->copy()->addDays(6); // Next 6 days = 1 week total

        $createdSchedule = null;

        while ($startDate->lte($endDate)) {
            $dayName = strtolower($startDate->format('l')); // monday, tuesday, ...
            if (in_array($dayName, $days)) {
                // Check if a schedule already exists for this date and route
                $existingSchedule = Schedule::where('route_id', $data['route_id'])
                    ->where('date', $startDate->toDateString())
                    ->where('departure_time', $data['departure_time'])
                    ->first();
                
                if (!$existingSchedule) {
                    $schedule = Schedule::create([
                        ...$data,
                        'date' => $startDate->toDateString(),
                    ]);
                    $createdSchedule = $schedule;
                }
            }
            $startDate->addDay();
        }

        // Return the last created schedule for Filament redirect
        return $createdSchedule ?? Schedule::where('route_id', $data['route_id'])
            ->where('departure_time', $data['departure_time'])
            ->orderBy('date', 'desc')
            ->first();
    }
}
