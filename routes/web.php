<?php

use App\Http\Controllers\HomeController;
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

Route::get('index',[HomeController::class,'index'])->name('Home');
Route::get('login',[HomeController::class,'Login'])->name('login');
Route::post('register', [HomeController::class, 'RegisterPage'])->name('Register');
Route::get('verifyMail/{verificationToken}', [HomeController::class, 'VerifyMailPage'])->name('verifyMail');
Route::post('existemail',[HomeController::class,'ExistEmailCheck'])->name('existemail');
Route::post('existmobno',[HomeController::class,'ExistMobnoCheck'])->name('existmobno');
Route::post('ResetPaswd',[HomeController::class,'otpGenrateReset'])->name('ResetPaswd');
Route::post('notregister',[HomeController::class,'NotRegMobnoEmail'])->name('notregister');
Route::post('regenerateotp',[HomeController::class,'otpRegenGenrate'])->name('regenerateotp');
Route::post('verifyOTP',[HomeController::class,'verifyOTPCheck'])->name('verifyOTP');
Route::post('newpaswrd',[HomeController::class,'ResetNewPaswd'])->name('newpaswrd');
