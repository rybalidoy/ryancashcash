<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
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
            'add payroll officers',
            'edit payroll officers',
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


        // Sync permissions with roles
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
