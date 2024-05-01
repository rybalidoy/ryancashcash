<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(User $user): void
    {
        // Create owner
        $owner = $user->factory()->create([
            'email' => 'owner@example.com',
            'password' => Hash::make('ryan1234'),
        ]);

        $ownerRole = Role::findOrCreate('Owner');
        $owner->assignRole($ownerRole->name);

        // Create administrators
        $administrators = User::factory(5)->create();
        $adminRole = Role::findOrCreate('Administrator');
        $administrators->each(function ($admin) use ($adminRole) {
            $admin->assignRole($adminRole->name);
        });

        // Create payroll officers for each company
        $companies = \App\Models\Company::all();
        foreach ($companies as $company) {
            $payrollOfficers = User::factory(2)->create([
                'company_id' => $company->id,
            ]);
            $payrollOfficerRole = Role::findOrCreate('Payroll Officer');
            $payrollOfficers->each(function ($payrollOfficer) use ($payrollOfficerRole) {
                $payrollOfficer->assignRole($payrollOfficerRole->name);
            });
        }

        foreach ($companies as $company) {
            $employees = User::factory(5)->create([
                'company_id' => $company->id,
            ]);

            $employeeRole = Role::findOrCreate('Employee');

            foreach ($employees as $employee) {
                $employee->assignRole($employeeRole->name);
            }
        }
    }
}
