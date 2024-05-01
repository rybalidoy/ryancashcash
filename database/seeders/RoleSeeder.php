<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerPermissions = [
            'add companies',
            'edit companies',
            'add administrators',
            'edit administrators',
            'add employees',
            'edit employees',
            'create loans',
            'view ongoing loans (all companies)',
            'view ongoing loans (all employees)',
            'modify company capital',
            'acknowledge loans',
            'view receivables dashboard',
        ];

        $administratorPermissions = [
            'add companies',
            'edit companies',
            'add payroll officers',
            'edit payroll officers',
            'add employees',
            'edit employees',
            'view ongoing loans (all companies)',
            'view ongoing loans (all employees)',
            'modify company capital',
            'acknowledge loans',
            'view receivables dashboard',
        ];

        $payrollOfficerPermissions = [
            'add employees (own company)',
            'edit employees (own company)',
            'create loans (own company)',
            'view ongoing loans (own company)',
            'modify loans (own company)',
            'approve loans (own company)',
            'complete loans (own company)',
            'view receivables dashboard (own company)',
            'modify company capital (own company)',
        ];

        // Create roles
        $ownerRole = Role::create(['name' => 'owner']);
        $administratorRole = Role::create(['name' => 'administrator']);
        $payrollOfficerRole = Role::create(['name' => 'payroll officer']);

        // Sync permissions with roles
        $ownerRole->syncPermissions($ownerPermissions);
        $administratorRole->syncPermissions($administratorPermissions);
        $payrollOfficerRole->syncPermissions($payrollOfficerPermissions);
    }
}
