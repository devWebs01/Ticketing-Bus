<?php

namespace Database\Seeders;

use App\Models\Route;
use App\Models\Schedule;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing routes and vehicles
        $routes = Route::all();
        $vehicles = Vehicle::all();

        if ($routes->isEmpty() || $vehicles->isEmpty()) {
            $this->command->warn('Routes or Vehicles not found. Please run RouteSeeder and VehicleSeeder first.');

            return;
        }

        // Create sample schedules
        $schedules = [
            [
                'route_id' => $routes->firstWhere('origin', 'Jakarta')->id ?? $routes->first()->id,
                'vehicle_id' => $vehicles->firstWhere('vehicle_type', 'bus')->id ?? $vehicles->first()->id,
                'departure_time' => '08:00:00',
                'price' => 150000.00,
                'status' => 'active',
                'days' => ['monday', 'wednesday', 'friday'],
            ],
            [
                'route_id' => $routes->firstWhere('origin', 'Jakarta')->id ?? $routes->first()->id,
                'vehicle_id' => $vehicles->firstWhere('vehicle_type', 'minibus')->id ?? $vehicles->skip(1)->first()->id,
                'departure_time' => '14:00:00',
                'price' => 120000.00,
                'status' => 'active',
                'days' => ['tuesday', 'thursday', 'saturday'],
            ],
            [
                'route_id' => $routes->skip(1)->first()->id,
                'vehicle_id' => $vehicles->firstWhere('vehicle_type', 'van')->id ?? $vehicles->skip(2)->first()->id,
                'departure_time' => '10:00:00',
                'price' => 100000.00,
                'status' => 'active',
                'days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
            ],
            [
                'route_id' => $routes->skip(2)->first()?->id ?? $routes->first()->id,
                'vehicle_id' => $vehicles->first()->id,
                'departure_time' => '16:00:00',
                'price' => 180000.00,
                'status' => 'active',
                'days' => ['saturday', 'sunday'],
            ],
            [
                'route_id' => $routes->first()->id,
                'vehicle_id' => $vehicles->skip(1)->first()->id,
                'departure_time' => '20:00:00',
                'price' => 200000.00,
                'status' => 'cancelled',
                'days' => ['friday', 'sunday'],
            ],
        ];

        foreach ($schedules as $scheduleData) {
            $days = $scheduleData['days'];
            unset($scheduleData['days']);

            $schedule = Schedule::create($scheduleData);

            foreach ($days as $day) {
                $schedule->days()->create(['day_of_week' => $day]);
            }

            $this->command->info("Created schedule: {$schedule->id} with ".count($days).' operating days');
        }

        $this->command->info('Schedule seeder completed successfully!');
    }
}
