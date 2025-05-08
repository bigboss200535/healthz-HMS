<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserCategoryAccess;

class UserCategoryAccessLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dashboard
        $data = UserCategoryAccess::create([
            'permission_id' => 'p1',
            'role_id' => '0',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

         // patient management
        $data = UserCategoryAccess::create([
            'permission_id' => 'p2',
            'role_id' => true,
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p3',
            'role_id' => true,
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p4',
            'role_id' => true,
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p5',
            'role_id' => true,
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p6',
            'role_id' => true,
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

         // nurses management
         $data = UserCategoryAccess::create([
            'permission_id' => 'p7',
            'role_id' => '2',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p8',
            'role_id' => '2',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p9',
            'role_id' => '2',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p10',
            'role_id' => '2',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p11',
            'role_id' => '2',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p12',
            'role_id' => '2',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p13',
            'role_id' => '2',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

            // opd management
        $data = UserCategoryAccess::create([
            'permission_id' => 'p14',
            'role_id' => '3',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

         // ipd management
        $data = UserCategoryAccess::create([
            'permission_id' => 'p15',
            'role_id' => '4',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p16',
            'role_id' => '4',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p17',
            
            'role_id' => '4',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p17',
            'role_id' => '4',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p18',
            'role_id' => '4',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        // investigations
        $data = UserCategoryAccess::create([
            'permission_id' => 'p19',
            'role_id' => '5',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p20',
            'role_id' => '5',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);
        
        // revenue
        $data = UserCategoryAccess::create([
            'permission_id' => 'p21',
            'role_id' => '6',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);

        $data = UserCategoryAccess::create([
            'permission_id' => 'p22',
            'role_id' => '6',
            'user_roles_id' => 'R1',
            'is_granted' => true,
            'can_read' => true,
            'can_create' => true,
            'can_delete' => true,
            'can_update' => true,
            'added_date' => now(),
            'added_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
        ]);
    }
}
