<?php

namespace Database\Seeders;

use App\Models\Stores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Stores::create([
            'store_id' => '0012',
            'store' => 'MAIN STORE',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $data = Stores::create([
            'store_id' => '0015',
            'store' => 'DISPENSARY',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $data = Stores::create([
            'store_id' => '0017',
            'store' => 'PHARMACY',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
