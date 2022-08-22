<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\linksController;
use App\Http\Controllers\garageController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\operationController;

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


Route::get('login', [userController::class,'login']);
Route::post('login', [userController::class,'create']);
Route::post('/logout', [userController::class, 'logout'])->middleware('auth');
Route::get('signup',[userController::class,'signup']);
Route::post('signup',[userController::class,'store']);
Route::post('/users/authenticate', [userController::class, 'authenticate']);

Route::get('/profile',[profileController::class,'index']);
Route::post('/profile',[profileController::class,'logo']);

Route::get('/garages',[garageController::class,'index']);
Route::get('/',[garageController::class,'index']);
Route::post('/garages',[garageController::class,'store']);
Route::post('/garages/destroy',[garageController::class,'destroy']);
Route::get('/{garage}',[garageController::class,'show']);
Route::post('/garage/invite',[garageController::class,'invite']);

Route::post('/garage/add',[cargoController::class,'store']);
Route::get('/cargo/{cargo}',[cargoController::class,'show']);
Route::post('/cargo/destroy',[cargoController::class,'destroy']);

Route::post('/operation',[operationController::class,'store']);

Route::post('/garage/linupdate',[linksController::class,'update']);
Route::post('/garage/lindelete',[linksController::class,'destroy']);
