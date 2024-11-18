<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titledata = UserRole::create([
            // 'role_id' => 'R1',
            'role' => 'Developer',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R2',
            'role' => 'System Administrator',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R3',
            'role' => 'IT Officer',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R4',
            'role' => 'Claim Officer',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R5',
            'role' => 'Hospital Administrator',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R6',
            'role' => 'Hospital Managers',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R7',
            'role' => 'Accounts Officer',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R8',
            'role' => 'Accountant',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R9',
            'role' => 'Nurse',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R10',
            'role' => 'Physician Assistant',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $titledata = UserRole::create([
            // 'role_id' => 'R11',
            'role' => 'Medical Doctor',
            // 'user' => $gender->gender_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
