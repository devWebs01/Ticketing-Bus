<?php

namespace Database\Seeders;

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
            'email' => 'admin@eticketing.com',
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
    }
}
