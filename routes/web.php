<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Signup;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
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