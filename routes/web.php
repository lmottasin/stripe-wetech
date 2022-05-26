<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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
    return view('home');
});

Route::get('logout', function(){
    Auth::logout();
    return redirect('/');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified','subscriber']], function(){
    Route::resource('dashboard',DashboardController::class);

    //Dashboard Settings Route
    Route::get('settings/profile',[DashboardController::class,'profile'])->name('profile');
    Route::post('settings/profile',[DashboardController::class,'profile_save'])->name('profile.save');

    Route::get('settings/security',[DashboardController::class,'security'])->name('security');
    Route::post('settings/security',[DashboardController::class,'security_save'])->name('security.save');

    Route::post('settings/billing/switch_plan',[BillingController::class,'switch_plan'])->name('billing.switch_plan');

});

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('settings/billing',[BillingController::class,'billing'])->name('billing');
    Route::post('settings/billing',[BillingController::class,'billing_save'])->name('billing.save');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

