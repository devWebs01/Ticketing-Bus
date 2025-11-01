<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Schedule;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchedule extends EditRecord
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {

        $schedule = Schedule::with('days')->find($data['id']);

        if ($schedule && $schedule->days) {
            $data['days'] = $schedule->days->pluck('day_of_week')->toArray();
        }

        return $data;
    }

    protected function handleRecordUpdate($record, array $data): Schedule
    {
        $days = $data['days'] ?? [];
        unset($data['days']);

        $record->update($data);

        $record->days()->delete(); // Remove existing days
        if (! empty($days)) {
            foreach ($days as $day) {
                $record->days()->create(['day_of_week' => $day]);
            }
        }

        return $record;
    }
}
