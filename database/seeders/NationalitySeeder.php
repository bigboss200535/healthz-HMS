<?php

namespace Database\Seeders;

use App\Models\Nationality;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first(); 

        $nationality = Nationality::create([
            'nationality_id' => '10001',
            'nationality' => 'Ghanaian',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $nationality = Nationality::create([
            'nationality_id' => '20002',
            'nationality' => 'Non-Ghanaian',
            'user_id' => $user->user_id,
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
