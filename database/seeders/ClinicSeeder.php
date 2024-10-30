<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Age;
use App\Models\User;
use App\Models\Gender;
use App\Models\Clinic;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first(); 
        $gender = Gender::inRandomOrder()->first(); 
        $age = Age::inRandomOrder()->first(); 

        $service = Clinic::create([
            'clinic_id' => 'C01',
            'clinic' => 'General',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C02',
            'clinic' => 'Direct Service',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C03',
            'clinic' => 'Antenatal',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C04',
            'clinic' => 'Postnatal',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C05',
            'clinic' => 'In-patient',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C06',
            'clinic' => 'Physiotherapy',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C07',
            'clinic' => 'Eye',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C08',
            'clinic' => 'Paediatric',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C09',
            'clinic' => 'Gynaecology',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C10',
            'clinic' => 'ENT',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C11',
            'clinic' => 'Dental',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C12',
            'clinic' => 'Medical',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C13',
            'clinic' => 'Diabetic',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C14',
            'clinic' => 'Casualty',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C15',
            'clinic' => 'Psychiatric',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C16',
            'clinic' => 'Maternity',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C17',
            'clinic' => 'Direct Pharmacy',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $service = Clinic::create([
            'clinic_id' => 'C18',
            'clinic' => 'Art',
            // 'gender_id' => $gender->gender_id,
            // 'age_id' => $age->age_id,
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

    }
}

