<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Age;
use App\Models\User;

class AgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first(); 

        $age = Age::create([
            'age_id' => '1',
            'age_description' => 'CHILD',
            'usage' => '0',
            'category' => '1',
            'min_age' => '0',
            'max_age' => '12',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $age = Age::create([
            'age_id' => '2',
            'age_description' => 'ADULT',
            'usage' => '0',
            'category' => '1',
            'min_age' => '13',
            'max_age' => '1000',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $age = Age::create([
            'age_id' => '3',
            'age_description' => 'ALL',
            'usage' => '0',
            'category' => '0',
            'min_age' => '0',
            'max_age' => '1000',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $age = Age::create([
            'age_id' => '4',
            'age_description' => 'INFANT',
            'usage' => '1',
            'category' => '0',
            'min_age' => '0',
            'max_age' => '3',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'Yes',
        ]);

        $age = Age::create([
            'age_id' => '5',
            'age_description' => 'INFANT CHILD',
            'usage' => '1',
            'category' => '0',
            'min_age' => '0',
            'max_age' => '12',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'Yes',
        ]);

    }
}
