<?php

namespace Database\Seeders;

use App\Models\Sponsors;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SponsorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::inRandomOrder()->first(); 

        // $sponsor = Sponsors::create([
        //     'sponsor_type_id' => 'P001',
        //     'sponsor_type' => 'CASH',
        //     'user_id' => $user->user_id,
        //     'added_date' => now(),
        //     'status' => 'Active',
        //     'archived' => 'No',
        // ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '000',
            'sponsor_type_id' => 'N002',
            'sponsor_name' => 'NATIONAL HEALTH INSURANCE',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '001',
            'sponsor_type_id' => 'PI03',
            'sponsor_name' => 'PREMIER HEALTH INSURANCE',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '002',
            'sponsor_type_id' => 'PC04',
            'sponsor_name' => 'AMANSIE RURAL BANK LTD',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '003',
            'sponsor_type_id' => 'PI03',
            'sponsor_name' => 'APEX INSURANCE',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '004',
            'sponsor_type_id' => 'PI03',
            'sponsor_name' => 'ACE MEDICAL INSURANCE',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
        
        $sponsor = Sponsors::create([
            'sponsor_id' => '005',
            'sponsor_type_id' => 'PC04',
            'sponsor_name' => 'GOLDEN BEAN HOTEL',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '006',
            'sponsor_type_id' => 'PC04',
            'sponsor_name' => 'AGATE MABOT LTD',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '007',
            'sponsor_type_id' => 'PC04',
            'sponsor_name' => 'ALS COMPANY LTD',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '008',
            'sponsor_type_id' => 'PI03',
            'sponsor_name' => 'GAB MEDICAL INSURANCE',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = Sponsors::create([
            'sponsor_id' => '009',
            'sponsor_type_id' => 'PI03',
            'sponsor_name' => 'KAISER MEDICAL INSURANCE',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
