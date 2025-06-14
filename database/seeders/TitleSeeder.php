<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = Title::create([
            'title_id' => 'T001',
            'title' => 'Mr',
            'gender_id' => '2',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $title = Title::create([
            'title_id' => 'T002',
            'title' => 'Mrs',
            'gender_id' => '3',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $title = Title::create([
            'title_id' => 'T003',
            'title' => 'Miss',
            'gender_id' => '3',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $title = Title::create([
            'title_id' => 'T005',
            'title' => 'Dr',
            'gender_id' => '1',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $title = Title::create([
            'title_id' => 'T006',
            'title' => 'Madam',
            'gender_id' => '3',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $title = Title::create([
            'title_id' => 'T007',
            'title' => 'Alhaji',
            'gender_id' => '2',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $title = Title::create([
            'title_id' => 'T008',
            'title' => 'Hajia',
            'gender_id' => '3',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        // $title = Title::create([
        //     'title_id' => 'T009',
        //     'title' => 'Hajia',
        //     'gender_id' => '3',
        //     'added_date' => now(),
        //     'status' => 'Active',
        //     'archived' => 'No',
        // ]);
    }
}
