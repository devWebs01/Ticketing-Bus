<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleSeat;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample vehicles
        $vehicles = [
            [
                'vehicle_number' => 'B 1234 ABC',
                'vehicle_type' => 'bus',
                'total_seats' => 40,
                'status' => 'active',
                'notes' => 'Bus besar dengan AC',
            ],
            [
                'vehicle_number' => 'B 5678 XYZ',
                'vehicle_type' => 'minibus',
                'total_seats' => 15,
                'status' => 'active',
                'notes' => 'Minibus nyaman',
            ],
            [
                'vehicle_number' => 'B 9012 PQR',
                'vehicle_type' => 'van',
                'total_seats' => 8,
                'status' => 'active',
                'notes' => 'Van eksekutif',
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $vehicle = Vehicle::create($vehicleData);

            // Create seats for each vehicle based on its type
            $this->createSeatsForVehicle($vehicle);
        }
    }

    private function createSeatsForVehicle($vehicle): void
    {
        $seatTypes = [];

        if ($vehicle->vehicle_type === 'bus') {
            // Create 40 seats for bus: A1-A20, B1-B20
            for ($i = 1; $i <= 20; $i++) {
                $seatTypes[] = ['number' => 'A'.str_pad($i, 2, '0', STR_PAD_LEFT), 'type' => 'regular'];
                $seatTypes[] = ['number' => 'B'.str_pad($i, 2, '0', STR_PAD_LEFT), 'type' => 'regular'];
            }
        } elseif ($vehicle->vehicle_type === 'minibus') {
            // Create 15 seats for minibus: A1-A15
            for ($i = 1; $i <= 15; $i++) {
                $seatTypes[] = ['number' => 'A'.str_pad($i, 2, '0', STR_PAD_LEFT), 'type' => 'regular'];
            }
        } elseif ($vehicle->vehicle_type === 'van') {
            // Create 8 seats for van: A1-A8
            for ($i = 1; $i <= 8; $i++) {
                $seatTypes[] = ['number' => 'A'.str_pad($i, 2, '0', STR_PAD_LEFT), 'type' => 'regular'];
            }
        }

        // Add VIP seats for buses
        if ($vehicle->vehicle_type === 'bus') {
            $seatTypes[0]['type'] = 'vip'; // A01
            $seatTypes[1]['type'] = 'vip'; // A02
            $seatTypes[2]['type'] = 'vip'; // B01
            $seatTypes[3]['type'] = 'vip'; // B02
        }

        foreach ($seatTypes as $seat) {
            VehicleSeat::create([
                'vehicle_id' => $vehicle->id,
                'seat_number' => $seat['number'],
                'seat_type' => $seat['type'],
            ]);
        }
    }
}
