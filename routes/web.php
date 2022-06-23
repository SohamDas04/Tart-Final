<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Signup;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ViewPeople;
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
    return view('welcome');
});
Route::get('/signup',[signup::class,'signupage']);
Route::post('/signup',[signup::class,'register']);
Route::view('/view','complete');
Route::get('/login',[LoginController::class,'login']);
Route::post('/check',[LoginController::class,'authenticate']);
Route::get('dashboard',[LoginController::class,'dashboard']);
Route::get('/myaccount',[AccountController::class,'myaccount']);
Route::get('/logout',[LoginController::class,'logout']);
Route::post('/uploadp',[AccountController::class,'uploadp']);
Route::post('/uploacp',[AccountController::class,'uploacp']);
Route::post('/createdu',[AccountController::class,'senddata']);
Route::post('/preview',[AccountController::class,'preview']);
Route::post('/postit',[AccountController::class,'postit']);
Route::post('/notpostit',[AccountController::class,'notpostit']);
Route::post('/search',[AccountController::class,'search']);
Route::post('/viewpeople',[ViewPeople::class,'viewpeople']);
Route::get('/showpeople',[ViewPeople::class,'showpeople']);
Route::post('/requestsend',[AccountController::class,'sendrequest']);
Route::post('/respondtorequest',[AccountController::class,'respondtorequest']);
Route::post('/viewstatus',[AccountController::class,'viewstatus']);
Route::post('/acceptrequest',[AccountController::class,'acceptrequest']);
Route::post('/deleterequest',[AccountController::class,'deleterequest']);
Route::post('/like',[AccountController::class,'like']);
Route::post('/likelist',[AccountController::class,'likelist']);
Route::post('/comment',[AccountController::class,'comment']);
Route::post('/viewcomments',[AccountController::class,'viewcomments']);