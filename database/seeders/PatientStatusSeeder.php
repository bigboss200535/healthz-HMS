<?php

namespace Database\Seeders;

use App\Models\PatientStatus;
// use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $patient_status = PatientStatus::create([
            'patient_status_id' => '1',
            'patient_status' => 'ALL',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $patient_status = PatientStatus::create([
            'patient_status_id' => '2',
            'patient_status' => 'OUT',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $patient_status = PatientStatus::create([
            'patient_status_id' => '3',
            'patient_status' => 'IN',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
