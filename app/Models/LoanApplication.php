<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_amount',
        'start_date',
        'end_date',
        'amortization',
        'status',
        'approved_by',
        'disbursed_date'
    ];


    public function transactions() {
        return $this->hasOne(LoanTransaction::class);
    }

    public function payments() {
        return $this->hasMany(LoanPayments::class);
    }

    public function debtor() {
        return $this->belongsTo(User::class, 'user_id');
    }



}
