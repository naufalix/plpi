<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Certification;
use App\Models\Cooperation;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
  public function career(Career $career){ return $career; }
  public function certification(Certification $certification){ return $certification; }
  public function cooperation(Cooperation $cooperation){ return $cooperation; }
  public function product(Product $product){ return $product; }
  public function transaction(Transaction $transaction){ return $transaction; }
  public function user(User $user){ return $user; }
  
  public function careers(){ return Career::all(); }
  public function certifications(){ return Certification::all(); }
  public function cooperations(){ return Cooperation::all(); }
  public function transactions(){ return Transaction::all(); }
  public function products(){ return Product::all(); }
  public function users(){ return User::all(); }
}
