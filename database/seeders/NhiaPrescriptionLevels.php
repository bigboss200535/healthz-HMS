<?php

namespace Database\Seeders;

use App\Models\HealthFacilityLevels;
// use App\Models\NhiaPrescriptionLevels;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NhiaPrescriptionLevels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first(); 

        $levels = HealthFacilityLevels::create([
            'level_id' => '1',
            'levels' => 'Community',
            'level_order' => '1',
            'code' => 'A',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $levels = HealthFacilityLevels::create([
            'level_id' => '2',
            'levels' => 'Midwifery',
            'level_order' => '2',
            'code' => 'M',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $levels = HealthFacilityLevels::create([
            'level_id' => '3',
            'levels' => 'Health Center without Doctor',
            'level_order' => '3',
            'code' => 'B1',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $levels = HealthFacilityLevels::create([
            'level_id' => '4',
            'levels' => 'Health Center with Doctor',
            'level_order' => '4',
            'code' => 'B2',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $levels = HealthFacilityLevels::create([
            'level_id' => '5',
            'levels' => 'District',
            'level_order' => '5',
            'code' => 'C',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $levels = HealthFacilityLevels::create([
            'level_id' => '6',
            'levels' => 'Regional/Teaching',
            'level_order' => '6',
            'code' => 'D',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $levels = HealthFacilityLevels::create([
            'level_id' => '7',
            'levels' => 'Specialist',
            'level_order' => '7',
            'code' => 'SD',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
