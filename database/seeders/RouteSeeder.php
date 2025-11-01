<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sample routes
        $routes = [
            [
                'origin' => 'Jakarta',
                'destination' => 'Bandung',
                'estimated_duration_hours' => 3,
                'description' => 'Rute Jakarta - Bandung via Tol Cipularang',
                'is_active' => true,
            ],
            [
                'origin' => 'Jakarta',
                'destination' => 'Surabaya',
                'estimated_duration_hours' => 10,
                'description' => 'Rute Jakarta - Surabaya via Tol Trans Jawa',
                'is_active' => true,
            ],
            [
                'origin' => 'Jakarta',
                'destination' => 'Yogyakarta',
                'estimated_duration_hours' => 9,
                'description' => 'Rute Jakarta - Yogyakarta via Tol Trans Jawa',
                'is_active' => true,
            ],
            [
                'origin' => 'Bandung',
                'destination' => 'Surabaya',
                'estimated_duration_hours' => 8,
                'description' => 'Rute Bandung - Surabaya via Tol Cipularang dan Tol Trans Jawa',
                'is_active' => true,
            ],
            [
                'origin' => 'Surabaya',
                'destination' => 'Yogyakarta',
                'estimated_duration_hours' => 6,
                'description' => 'Rute Surabaya - Yogyakarta via Tol Trans Jawa',
                'is_active' => true,
            ],
        ];

        foreach ($routes as $routeData) {
            Route::create($routeData);
        }

        // Create additional random routes using the factory
        Route::factory()->count(10)->create();
    }
}
