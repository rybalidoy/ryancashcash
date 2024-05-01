<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Termwind\Components\Hr;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected static function boot() {
    //     parent::boot();


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function loan() {
        return $this->hasMany(LoanApplication::class);
    }

    public function payment() {
        return $this->hasMany(LoanPayments::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *  Functions
     */

    public function getUserByEmail($email) {
        return $this->where('email',$email)->first();
    }

    public function authenticate($validatedData) {
        $user = $this->getUserByEmail($validatedData['email']);
        if(empty($user->id) || !Hash::check($validatedData['password'], $user->password)) {
            return false;
        }
        return $user;
    }

}
