<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Religion;
// use App\Models\User;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::inRandomOrder()->first(); 
        $region = Religion::create([
            'religion_id' => 'R001',
            'religion' => 'Islam',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Religion::create([
            'religion_id' => 'R002',
            'religion' => 'Christianity',
            'added_date' => now(),
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Religion::create([
            'religion_id' => 'R003',
            'religion' => 'Atheist',
            'added_date' => now(),
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Religion::create([
            'religion_id' => 'R004',
            'religion' => 'Hinduism',
            'added_date' => now(),
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Religion::create([
            'religion_id' => 'R005',
            'religion' => 'Judaism',
            'added_date' => now(),
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Religion::create([
            'religion_id' => 'R006',
            'religion' => 'Traditional',
            'added_date' => now(),
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
