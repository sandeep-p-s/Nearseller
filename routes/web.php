<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserLoggedController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('user.main', ['title' => 'Home']);
})->name('home');
Route::controller(HomeController::class)->group(function (){
    Route::get('index','index')->name('Home');
    Route::get('login','Login')->name('login');
    Route::post('register', 'RegisterPage')->name('Register');
    Route::get('verifyMail/{verificationToken}', 'VerifyMailPage')->name('verifyMail');
    Route::post('existemail','ExistEmailCheck')->name('existemail');
    Route::post('existmobno','ExistMobnoCheck')->name('existmobno');
    Route::post('ResetPaswd','otpGenrateReset')->name('ResetPaswd');
    Route::post('notregister','NotRegMobnoEmail')->name('notregister');
    Route::post('regenerateotp','otpRegenGenrate')->name('regenerateotp');
    Route::post('verifyOTP','verifyOTPCheck')->name('verifyOTP');
    Route::post('newpaswrd','ResetNewPaswd')->name('newpaswrd');
    Route::post('mobotpgenrte','MobLoginOTPgenrte')->name('mobotpgenrte');
    Route::get('/getDistricts/{state}', 'getDistricts')->name('getDistricts');    ;
    Route::get('/getStates/{country}', 'getStates')->name('getStates');
});

Route::controller(UserLoggedController::class)->group(function (){
    Route::post('LoggedPage/{sentoval}', 'LoggedUserPage')->name('LoggedPage');
});
