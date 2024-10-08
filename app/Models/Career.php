<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    //public $timestamps = false;
    protected $guarded = ['id'];

    protected $hidden = [
        "created_at",
        "updated_at", 
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
