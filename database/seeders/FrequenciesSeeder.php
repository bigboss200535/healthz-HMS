<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Frequencies;
use App\Models\User;

class FrequenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $frequency = Frequencies::create([
            'frequency_id' => '1',
            'frequencies' => 'OD',
            'numerical_values' => '1',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '2',
            'frequencies' => 'BID',
            'numerical_values' => '2',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '3',
            'frequencies' => 'TID',
            'numerical_values' => '3',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '4',
            'frequencies' => 'QID',
            'numerical_values' => '4',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '5',
            'frequencies' => '5 x DAILY',
            'numerical_values' => '5',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '6',
            'frequencies' => 'STAT',
            'numerical_values' => '1',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '7',
            'frequencies' => 'COS',
            'numerical_values' => '1',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '8',
            'frequencies' => 'NOCTE',
            'numerical_values' => '1',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);


        $frequency = Frequencies::create([
            'frequency_id' => '9',
            'frequencies' => 'EVERY OTHER DAY',
            'numerical_values' => '0.50',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '10',
            'frequencies' => 'EVERY OTHER NIGHT',
            'numerical_values' => '1',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '11',
            'frequencies' => 'WEEKLY',
            'numerical_values' => '1/7',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '12',
            'frequencies' => 'EVERY OTHER WEEK',
            'numerical_values' => '14',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '13',
            'frequencies' => 'EVERY 1 HOUR',
            'numerical_values' => '24',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '14',
            'frequencies' => 'EVERY 2 HOURS',
            'numerical_values' => '12',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '15',
            'frequencies' => 'EVERY 3 HOURS',
            'numerical_values' => '8',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '16',
            'frequencies' => 'EVERY 4 HOURS',
            'numerical_values' => '6',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '17',
            'frequencies' => 'EVERY 6 HOURS',
            'numerical_values' => '4',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '18',
            'frequencies' => 'EVERY 8 HOURS',
            'numerical_values' => '3',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '19',
            'frequencies' => 'EVERY 12 HOURS',
            'numerical_values' => '2',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '20',
            'frequencies' => 'EVERY 1 MINUTE',
            'numerical_values' => '1440',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '21',
            'frequencies' => 'EVERY 2 MINUTES',
            'numerical_values' => '720',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '22',
            'frequencies' => 'EVERY 5 MINUTES',
            'numerical_values' => '288',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '23',
            'frequencies' => 'EVERY 10 MINUTES',
            'numerical_values' => '144',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '24',
            'frequencies' => 'EVERY 15 MINUTES',
            'numerical_values' => '96',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '25',
            'frequencies' => 'EVERY 30 MINUTES',
            'numerical_values' => '48',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '26',
            'frequencies' => 'PRN',
            'numerical_values' => '1',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $frequency = Frequencies::create([
            'frequency_id' => '27',
            'frequencies' => 'MANE',
            'numerical_values' => '1',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);


    }

}
