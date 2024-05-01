<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanApplication>
 */
class LoanApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => function () {
                return User::whereDoesntHave('loanApplications', function ($query) {
                    $query->where('status', '!=', 'Completed');
                })->where('role', 'Employee')->inRandomOrder()->first()->id;
            },
            'loan_amount' => fake()->randomFloat(2, 1000, 10000),
            'start_date' => null,
            'end_date' => null,
            'amortization' => fake()->randomElement([1,2,3]),
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
