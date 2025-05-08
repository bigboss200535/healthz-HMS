<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use Illuminate\Database\Seeder;

class UserPermissionTestSeeder extends Seeder
{
    // Constants for reusable IDs
    const ADMIN_USER_ID = 'b2c362bf-56df-4337-be34-7062ffae8bd5';
    const ADMIN_ROLE_ID = 'R1';
    
    // Permission categories
    protected $permissionGroups = [
        'dashboard' => [
            'access' => 'p1'
        ],
        'patient' => [
            'view' => 'p2',
            'create' => 'p3',
            'delete' => 'p4',
            'update' => 'p5',
            'manage' => 'p6'
        ],
        'nurse' => [
            'vitals' => 'p7',
            'notes' => 'p8',
            'reports' => 'p9',
            'medications' => 'p10',
            'anc' => 'p11'
        ],
        'opd' => [
            'consultations' => 'p14'
        ],
        'ipd' => [
            'consultations' => 'p15',
            'surgery' => 'p16',
            'discharges' => 'p17',
            'transfers' => 'p18'
        ],
        'investigations' => [
            'laboratory' => 'p19',
            'imaging' => 'p20'
        ],
        'revenue' => [
            'billing' => 'p21',
            'invoices' => 'p22'
        ],
        'report' => [
            'general' => 'p23',
            'invoices' => 'p22'
        ]
    ];

    public function run()
    {
        // Grant admin all permissions
        foreach ($this->permissionGroups as $group => $permissions) {
            foreach ($permissions as $permission => $permissionId) {
                UserPermission::create([
                    'permission_id' => $permissionId,
                    'user_id' => self::ADMIN_USER_ID,
                    'role_id' => $this->getRoleIdForGroup($group),
                    'user_roles_id' => self::ADMIN_ROLE_ID,
                    'is_granted' => true,
                    'can_read' => true,
                    'can_create' => true,
                    'can_delete' => true,
                    'can_update' => true,
                    'added_date' => now(),
                    'facility_id' => 'FAC000001',
                    'added_id' => self::ADMIN_USER_ID,
                    'status' => 'Active'
                ]);
            }
        }
    }

    protected function getRoleIdForGroup($group)
    {
        // Map permission groups to role IDs
        $mapping = [
            'dashboard' => '0',
            'patient' => '1',
            'nurse' => '2',
            'opd' => '3',
            'ipd' => '4',
            'investigations' => '5',
            'revenue' => '6',
            'report' => '7'
        ];
        
        return $mapping[$group] ?? '0';
    }
}