<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

    // Course Routes
    Route::get('courses', [CourseController::class,'courses'])->name('courses');

    //Dashboard Settings Route
    Route::get('settings/profile',[DashboardController::class,'profile'])->name('profile');
    Route::post('settings/profile',[DashboardController::class,'profile_save'])->name('profile.save');
    Route::get('settings/security',[DashboardController::class,'security'])->name('security');
    Route::post('settings/security',[DashboardController::class,'security_save'])->name('security.save');
    Route::post('settings/billing/switch_plan',[BillingController::class,'switch_plan'])->name('billing.switch_plan');
    Route::get('settings/invoices', [DashboardController::class,'invoices'])->name('invoices');
    Route::get('settings/invoices/download/{invoice}', [DashboardController::class,'invoices_download'])->name('invoices.download');
    Route::get('settings/billing/cancel', [BillingController::class,'cancel'])->name('cancel');
    Route::get('settings/billing/resume', [BillingController::class,'resume'])->name('resume');

    Route::get('support', [SupportController::class,'index'])->name('support');
    Route::post('support', [SupportController::class,'send'])->name('support.send');

    Route::get('announcements', [AnnouncementController::class,'index'])->name('announcements');
    Route::get('announcements/unread',  [AnnouncementController::class,'unread'])->name('announcements.unread');
    Route::get('announcement/{id}',  [AnnouncementController::class,'announcement'])->name('announcement');

});

Route::domain('{subdomain}.' . env('DOMAIN'))->group(function () {
    Route::get('/', [CourseController::class,'course']);
});

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('settings/billing',[BillingController::class,'billing'])->name('billing');
    Route::post('settings/billing',[BillingController::class,'billing_save'])->name('billing.save');
});

//OAuth providers
Route::get('login/github', [LoginController::class,'redirectToGithubProvider']);
Route::get('login/github/callback', [LoginController::class,'handleGithubProviderCallback']);
Route::get('login/google', [LoginController::class,'redirectToGoogleProvider']);
Route::get('login/google/callback', [LoginController::class,'handleGoogleProviderCallback']);
Route::get('login/facebook', [LoginController::class,'redirectToFacebookProvider']);
Route::get('login/facebook/callback', [LoginController::class,'handleFacebookProviderCallback']);




Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('p/{slug}', [PageController::class,'page'])->name('page');
