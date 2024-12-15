<?php

namespace Database\Seeders;

use App\Models\PatientStatus;
use App\Models\User;
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
        $user = User::where('archived', '=', 'No')->first();

        $patient_status = PatientStatus::create([
            'patient_status' => '1',
            'status_patient' => 'All',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $patient_status = PatientStatus::create([
            'patient_status' => '2',
            'status_patient' => 'Out',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $patient_status = PatientStatus::create([
            'patient_status' => '3',
            'status_patient' => 'In',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
