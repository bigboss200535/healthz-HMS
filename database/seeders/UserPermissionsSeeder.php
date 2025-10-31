<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserPermission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dashboard
        $data = UserPermission::create([
            'permission_id' => 'p1',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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
        $data = UserPermission::create([
            'permission_id' => 'p2',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p3',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p4',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p5',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p6',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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
         $data = UserPermission::create([
            'permission_id' => 'p7',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p8',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p9',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p10',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p11',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p12',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p13',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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
        $data = UserPermission::create([
            'permission_id' => 'p14',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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
        $data = UserPermission::create([
            'permission_id' => 'p15',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p16',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p17',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p17',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p18',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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
        $data = UserPermission::create([
            'permission_id' => 'p19',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p20',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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
        $data = UserPermission::create([
            'permission_id' => 'p21',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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

        $data = UserPermission::create([
            'permission_id' => 'p22',
            'user_id' => 'b2c362bf-56df-4337-be34-7062ffae8bd5',
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
