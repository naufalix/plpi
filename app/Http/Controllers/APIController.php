<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
  public function user(User $user){
    return $user;
  }
  public function users(){
    return User::all();
  }
}
