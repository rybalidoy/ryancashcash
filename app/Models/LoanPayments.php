<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPayments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_application_id',
        'amount',
        'payment_date',
        'status',
        'payment'
    ];

    public function loan() {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }

    public function payer() {
        return $this->belongsTo(User::class,'user_id');
    }



}
