<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Affiliate\AffiliateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/register',[RegistrationController::class,'showRegistrationForm'])->name('showRegistrationForm');
Route::post('/register',[RegistrationController::class,'showRegistrationForm'])->name('showRegistrationForm');
Route::controller(LoginController::class)
->group(function(){
    Route::get('/login','showLoginForm')->name('showLoginForm');
    Route::post('/login','login')->name('login');
    Route::post('/logout','logout')->name('logout');
});


Route::controller(RegistrationController::class)
   ->group(function(){
    Route::get('/register','showRegistrationForm')->name('showRegistrationForm');
    Route::post('/register','register')->name('register');
});

Route::controller(AdminController::class)
  ->middleware('auth:admin')
  ->name('admin.')
  ->prefix('/admin')
  ->group(function(){
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::get('/affiliates','affiliates')->name('affiliates.index');
    Route::get('/affiliates/create','affiliateForm')->name('affiliates.create');
    Route::post('/affiliates','addNewAffiliateUser')->name('affiliates.store');

    Route::get('/users','users')->name('users');
    Route::get('/users/{userId}/transactions','transactionsViaUser')->name('transactionsViaUser');

    Route::get('/transactions','transactions')->name('transactions');
});
Route::controller(AffiliateController::class)
  ->middleware('auth:affiliate')
  ->name('affiliate.')
  ->prefix('affiliate')
  ->group(function(){
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::get('/sub-affiliates','subAffiliates')->name('sub-affiliates.index');
    Route::get('/sub-affiliates/create','subAffiliateForm')->name('sub-affiliates.create');
    Route::post('/sub-affiliates','addNewSubAffiliateUser')->name('affiliates.store');
});

Route::controller(HomeController::class)
  ->middleware('auth')
  ->prefix('/user')
  ->name('user.')
  ->group(function(){
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::get('/transactions','transactions')->name('transactions.index');
    Route::get('/transaction','transactionForm')->name('transactionForm');
    Route::post('/transaction','transaction')->name('transaction');
});



