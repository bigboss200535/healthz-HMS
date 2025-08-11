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

        $age_groups = [
                ['age_groups' => '< 28 DAYS',        'min' => 0,     'max' => 0.076], // ~28/365
                ['age_groups' => '1 - 11 MONTHS',    'min' => 0.077, 'max' => 0.9],
                ['age_groups' => '1 - 4 YEARS',      'min' => 1,     'max' => 4],
                ['age_groups' => '5 - 9 YEARS',      'min' => 5,     'max' => 9],
                ['age_groups' => '10 - 14 YEARS',    'min' => 10,    'max' => 14],
                ['age_groups' => '15 - 17 YEARS',    'min' => 15,    'max' => 17],
                ['age_groups' => '18 - 19 YEARS',    'min' => 18,    'max' => 19],
                ['age_groups' => '20 - 34 YEARS',    'min' => 20,    'max' => 34],
                ['age_groups' => '35 - 49 YEARS',    'min' => 35,    'max' => 49],
                ['age_groups' => '50 - 59 YEARS',    'min' => 50,    'max' => 59],
                ['age_groups' => '60 - 69 YEARS',    'min' => 60,    'max' => 69],
                ['age_groups' => '>= 70 YEARS',      'min' => 70,    'max' => 150],
           ];

foreach ($age_groups as $index => $group) {
    AgeGroups::create([
        'age_group_id' => $index + 1,
        'age_groups' => $group['age_groups'],
        'min_age' => $group['min'],
        'max_age' => $group['max'],
        'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
        'added_date' => now(),
    ]);
}

        // $user = User::inRandomOrder()->first(); 

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '1',
    //         'age_groups' => '< 28 DAYS',
    //         // 'check_code' => '<28',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '2',
    //         'age_groups' => '1 - 11 MONTHS',
    //         // 'check_code' => '29 - ',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '3',
    //         'age_groups' => '1 - 4 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '4',
    //         'age_groups' => '5 - 9 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '5',
    //         'age_groups' => '10 - 14 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '6',
    //         'age_groups' => '15 - 17 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '7',
    //         'age_groups' => '18 - 19 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '8',
    //         'age_groups' => '20 - 34 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '9',
    //         'age_groups' => '35 - 49 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '10',
    //         'age_groups' => '50 - 59 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '11',
    //         'age_groups' => '60 - 69 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);

    //     $age_group = AgeGroups::create([
    //         'age_group_id' => '12',
    //         'age_groups' => '>= 70 YEARS',
    //         'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
    //         'added_date' => now(),
    //         'status' => 'Active',
    //         'archived' => 'No',
    //     ]);
    }
}
