<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
  public function career(Career $career){ return $career; }
  public function user(User $user){ return $user; }
  
  public function careers(){ return Career::all(); }
  public function users(){ return User::all(); }
}
