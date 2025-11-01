<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Route;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\TripManifest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user with user details
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@testing.com',
        ]);

        UserDetail::factory()->admin()->create([
            'user_id' => $admin->id,
            'phone' => '08123456789',
            'address' => 'Jakarta Pusat, Indonesia',
        ]);

        // Create sample customers with user details
        $customers = User::factory()->count(10)->create();
        foreach ($customers as $customer) {
            UserDetail::factory()->customer()->create(['user_id' => $customer->id]);
        }

        // Create sample checkers with user details
        $checkers = User::factory()->count(3)->create();
        foreach ($checkers as $checker) {
            UserDetail::factory()->checker()->create(['user_id' => $checker->id]);
        }

        // Create sample routes
        $routes = Route::factory()->count(8)->active()->create();

        // Create sample schedules for each route
        foreach ($routes as $route) {
            // Create 2-3 schedules per route
            $scheduleCount = rand(2, 3);
            for ($i = 0; $i < $scheduleCount; $i++) {
                Schedule::factory()->forRoute($route)->create();
            }
        }

        // Get all schedules for seat creation
        $schedules = Schedule::all();

        // Create seats for each schedule
        foreach ($schedules as $schedule) {
            $seatNumbers = [];
            for ($i = 1; $i <= $schedule->total_seats; $i++) {
                $seatNumbers[] = 'A'.str_pad($i, 2, '0', STR_PAD_LEFT);
            }

            foreach ($seatNumbers as $seatNumber) {
                Seat::factory()->create([
                    'schedule_id' => $schedule->id,
                    'seat_number' => $seatNumber,
                ]);
            }
        }

        // Create sample bookings
        $bookings = Booking::factory()->count(20)->create();

        // Create payments for bookings
        foreach ($bookings as $booking) {
            Payment::factory()->create([
                'booking_id' => $booking->id,
            ]);
        }

        // Create trip manifests for some schedules
        $manifestSchedules = $schedules->take(3);
        foreach ($manifestSchedules as $schedule) {
            TripManifest::factory()->create([
                'schedule_id' => $schedule->id,
            ]);
        }
    }
}
