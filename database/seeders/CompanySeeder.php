<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 10; $i++) {
            Company::create([
                'name' => 'Company ' . $i,
                'company_id' => 'COMP' . sprintf('%03d', $i),
                'capital' => 100000.00, // Sample capital value
            ]);
        }
    }
}
