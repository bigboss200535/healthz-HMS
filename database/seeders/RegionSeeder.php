<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\User;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $region = Region::create([
            'region_id' => '001',
            'region' => 'ASHANTI',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '002',
            'region' => 'BRONG AHAFO',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '003',
            'region' => 'CENTRAL',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '004',
            'region' => 'EASTERN',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '005',
            'region' => 'GREATER ACCRA',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '006',
            'region' => 'NORTHERN',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '007',
            'region' => 'UPPER EAST',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '008',
            'region' => 'UPPER WEST',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '009',
            'region' => 'VOLTA',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '010',
            'region' => 'WESTERN',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '011',
            'region' => 'SAVANNAH',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '012',
            'region' => 'BONO EAST',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '013',
            'region' => 'OTI',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '014',
            'region' => 'AHAFO',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '015',
            'region' => 'WESTERN NORTH',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $region = Region::create([
            'region_id' => '016',
            'region' => 'NORTH EAST',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

    }
}
