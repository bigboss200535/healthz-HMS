<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\HealthFacilityLevels;

class HealthFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first(); 

        $clinic = HealthFacilityLevels::create([
            'health_facility_level_id' => '1',
            'levels' => 'Clinic',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $clinic = HealthFacilityLevels::create([
            'health_facility_level_id' => '2',
            'levels' => 'Diagnostic Centre',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $clinic = HealthFacilityLevels::create([
            'health_facility_level_id' => '3',
            'levels' => 'Health Centre',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $clinic = HealthFacilityLevels::create([
            'health_facility_level_id' => '4',
            'levels' => 'Primary',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $clinic = HealthFacilityLevels::create([
            'health_facility_level_id' => '5',
            'levels' => 'Secondary',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $clinic = HealthFacilityLevels::create([
            'health_facility_level_id' => '6',
            'levels' => 'Tertiary',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
