<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Certification;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
  public function career(Career $career){ return $career; }
  public function certification(Certification $certification){ return $certification; }
  public function user(User $user){ return $user; }
  
  public function careers(){ return Career::all(); }
  public function certifications(){ return Certification::all(); }
  public function users(){ return User::all(); }
}
