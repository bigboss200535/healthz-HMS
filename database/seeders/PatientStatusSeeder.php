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
            'patient_status_id' => '1',
            'patient_status' => 'All',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $patient_status = PatientStatus::create([
            'patient_status_id' => '2',
            'patient_status' => 'Out',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $patient_status = PatientStatus::create([
            'patient_status_id' => '3',
            'patient_status' => 'In',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
