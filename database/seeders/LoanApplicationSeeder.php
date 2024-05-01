<?php

namespace Database\Seeders;

use App\Models\LoanApplication;
use App\Models\User;
use Carbon\Factory;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Type\Decimal;
use Spatie\Permission\Models\Role;

class LoanApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employees = User::whereHas('roles', function ($query) {
            $query->where('name', 'Employee');
        })->get();

        foreach ($employees as $employee) {
            // Check if the user already has a pending loan
            $amortization = rand(1, 3);
            $loanAmount = $this->randomFloat(5, 10000, 100000); // Assuming randomFloat method is defined elsewhere
            $loan = LoanApplication::create([
                'user_id' => $employee->id,
                'loan_amount' => $loanAmount,
                'start_date' => null, // Start date is nullable
                'end_date' => null,   // End date is nullable
                'amortization' => $amortization,  // Default amortization
                'status' => 'Pending',
            ]);
            $computedTotal = $loan->loan_amount + ($loan->loan_amount * 0.05 * $amortization); // Use $loan->loan_amount
            $computedTotal = round($computedTotal, 4);
            $loan->transactions()->create([
                'loan_application_id' => $loan->id,
                'remaining_balance' => $computedTotal,
                'computed_total' => $computedTotal,
                'payment_amortization' => $computedTotal / $amortization,
                'payments' => 0,
            ]);
        }
    }
    // last working function 04/22/24 5:45am
    // public function run()
    // {
    //     $employees = User::whereHas('roles', function ($query) {
    //         $query->where('name', 'Employee');
    //     })->get();

    //     foreach ($employees as $employee) {
    //         $amortization = rand(1, 3);
    //         $loanAmount = $this->randomFloat(5, 10000, 100000); // Assuming randomFloat method is defined elsewhere
    //         $loan = LoanApplication::create([
    //             'user_id' => $employee->id,
    //             'loan_amount' => $loanAmount,
    //             'start_date' => null, // Start date is nullable
    //             'end_date' => null,   // End date is nullable
    //             'amortization' => $amortization,  // Default amortization
    //             'status' => 'Pending',
    //         ]);
    //         $computedTotal = $loan->loan_amount + ($loan->loan_amount * 0.05 * $amortization); // Use $loan->loan_amount
    //         $computedTotal = round($computedTotal, 4);
    //         $loan->transactions()->create([
    //             'loan_application_id' => $loan->id,
    //             'remaining_balance' => $computedTotal,
    //             'computed_total' => $computedTotal,
    //             'payment_amortization' => $computedTotal / $amortization,
    //             'payments' => 0,
    //         ]);
    //     }
    // }
    function randomFloat($min, $max) {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }
}
