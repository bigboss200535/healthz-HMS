<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\User;
use App\Models\SponsorType;

class SponsorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $sponsor = SponsorType::create([
            'sponsor_type_id' => 'P001',
            'sponsor_type' => 'CASH PAYMENT',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = SponsorType::create([
            'sponsor_type_id' => 'N002',
            'sponsor_type' => 'NHIS (PUBLIC)',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = SponsorType::create([
            'sponsor_type_id' => 'PI03',
            'sponsor_type' => 'PRIVATE INSURANCE',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $sponsor = SponsorType::create([
            'sponsor_type_id' => 'PC04',
            'sponsor_type' => 'PRIVATE COMPANY',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    
    }
}
