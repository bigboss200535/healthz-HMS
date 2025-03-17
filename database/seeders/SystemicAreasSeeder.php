<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SystemicAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = database_path('seeders/seeds/15_systemic_areas.sql');
        $sql_one = file_get_contents($data);
        DB::unprepared($sql_one); 
    }
}
