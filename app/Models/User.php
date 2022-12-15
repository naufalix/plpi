<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //public $timestamps = false;
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
        "email_verified_at",
        "created_at",
        "updated_at", 
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function career(){
        return $this->hasMany(Career::class);
    }

    public function certification(){
        return $this->hasMany(Certification::class);
    }

    public function cooperation(){
        return $this->hasMany(Cooperation::class);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
