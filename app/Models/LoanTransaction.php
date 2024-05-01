<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_application_id',
        'remaining_balance',
        'computed_total',
        'payment_amortization',
        'payments'
    ];

    public function loan() {
        return $this->belongsTo(LoanApplication::class);
    }
}
