<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashCareer;
use App\Http\Controllers\Dashboard\DashCategory;
use App\Http\Controllers\Dashboard\DashCertification;
use App\Http\Controllers\Dashboard\DashCooperation;
use App\Http\Controllers\Dashboard\DashHome;
use App\Http\Controllers\Dashboard\DashProduct;
use App\Http\Controllers\Dashboard\DashUser;
use App\Http\Controllers\Dashboard\DashTransaction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);

// DASHBOARD AUTH
Route::get('/dashboard/login', [AuthController::class, 'index'])->name('login');
Route::post('/dashboard/login', [AuthController::class, 'login']);
Route::get('/dashboard/logout', [AuthController::class, 'logout']);

// DASHBOARD PAGE
Route::group(['prefix'=> 'dashboard','middleware'=>['auth:user']], function(){
    Route::get('/', [DashHome::class, 'index']);
    Route::get('/home', [DashHome::class, 'index']);
    Route::get('/career', [DashCareer::class, 'index']);
    Route::get('/category', [DashCategory::class, 'index']);
    Route::get('/certification', [DashCertification::class, 'index']);
    Route::get('/cooperation', [DashCooperation::class, 'index']);
    Route::get('/product', [DashProduct::class, 'index']);
    Route::get('/user', [DashUser::class, 'index']);
    Route::get('/transaction', [DashTransaction::class, 'index']);
    
    Route::post('/career', [DashCareer::class, 'postHandler']);
    Route::post('/category', [DashCategory::class, 'postHandler']);
    Route::post('/certification', [DashCertification::class, 'postHandler']);
    Route::post('/cooperation', [DashCooperation::class, 'postHandler']);
    Route::post('/product', [DashProduct::class, 'postHandler']);
    Route::post('/user', [DashUser::class, 'postHandler']);
    Route::post('/transaction', [DashTransaction::class, 'postHandler']);
});

// API
Route::group(['prefix'=> 'api'], function(){
    //Route::get('/', [DashHome::class, 'index']);
    Route::get('/users', [APIController::class, 'users']);
    Route::get('/user/{user:id}', [APIController::class, 'user']);
    Route::get('/careers', [APIController::class, 'careers']);
    Route::get('/career/{career:id}', [APIController::class, 'career']);
    Route::get('/certifications', [APIController::class, 'certifications']);
    Route::get('/certification/{certification:id}', [APIController::class, 'certification']);
    Route::get('/cooperations', [APIController::class, 'cooperations']);
    Route::get('/cooperation/{cooperation:id}', [APIController::class, 'cooperation']);
    Route::get('/products', [APIController::class, 'products']);
    Route::get('/product/{product:id}', [APIController::class, 'product']);
    Route::get('/transactions', [APIController::class, 'transactions']);
    Route::get('/transaction/{transaction:id}', [APIController::class, 'transaction']);
});

// PRINT
Route::group(['prefix'=> 'print'], function(){
    Route::get('/user', [PrintController::class, 'user']);
    Route::get('/career', [PrintController::class, 'career']);
    Route::get('/certification', [PrintController::class, 'certification']);
    Route::get('/cooperation', [PrintController::class, 'cooperation']);
    Route::get('/transaction', [PrintController::class, 'transaction']);
});