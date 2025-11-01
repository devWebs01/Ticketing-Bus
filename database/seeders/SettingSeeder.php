<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageContents = file_get_contents('https://fourbest.co.id/img/Logo_FBS1.png');
        if ($imageContents === false) {
            throw new \Exception('Could not get contents from URL.');
        }
        $imageName = Str::random(20).'.jpg';
        $imagePath = 'setting/'.$imageName;
        Storage::disk('public')->put($imagePath, $imageContents);

        Log::info('Image for PT. Four Best Synergy saved to '.$imagePath);
        Setting::create([
            'name' => 'PT. Four Best Synergy',
            'logo' => $imagePath,
            'address' => 'Jalan Peta Barat Citra Business Park Blok H No.18 RT.1/RW.7 Kalideres Kec. Kalideres Kota Jakarta Barat Daerah Khusus Ibukota Jakarta 11840 - Indonesia',
            'phone' => '+62 822-6017-3314',
        ]);
    }
}
