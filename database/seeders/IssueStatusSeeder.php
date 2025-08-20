<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IssueStatus;

class IssueStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = IssueStatus::create([
            'issue_id' => '0',
            'issue_value' => 'Pending',
            'color_code' => 'danger',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $data = IssueStatus::create([
            'issue_id' => '1',
            'issue_value' => 'Issued',
            'color_code' => 'success',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $data = IssueStatus::create([
            'issue_id' => '2',
            'issue_value' => 'Waiting',
            'color_code' => 'warning',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $data = IssueStatus::create([
            'issue_id' => '3',
            'issue_value' => 'Completed',
            'color_code' => 'primary',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);

        $data = IssueStatus::create([
            'issue_id' => '4',
            'issue_value' => 'On Hold',
            'color_code' => 'info',
            'user_id' => 'a2c362bf-56df-4337-be34-0062ffae8bd5',
            'added_date' => now(),
            'status' => 'Active',
            'archived' => 'No',
        ]);
    }
}
