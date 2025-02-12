<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AgeGroups;
use App\Models\User;

class AgeGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first(); 

        $age_group = AgeGroups::create([
            'age_group_id' => '1',
            'age_groups' => '< 28 DAYS',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $age_group = AgeGroups::create([
            'age_group_id' => '2',
            'age_groups' => '1 - 11 MONTHS',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $age_group = AgeGroups::create([
            'age_group_id' => '3',
            'age_groups' => '1 - 4 YEARS',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $age_group = AgeGroups::create([
            'age_group_id' => '4',
            'age_groups' => '5 - 9 YEARS',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
