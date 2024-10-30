<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_one = database_path('seeders/seeds/04_service_fee.sql');
        $sql_one = file_get_contents($data_one);
        DB::unprepared($sql_one); 
    }
}
