<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\employersController;
use App\Http\Controllers\wearhouseController;
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

Route::get('/wearhouses',[wearhouseController::class,'index']);
Route::get('/',[wearhouseController::class,'index']);
Route::post('/wearhouses',[wearhouseController::class,'store']);
Route::post('/wearhouses/destroy',[wearhouseController::class,'destroy']);
Route::get('/{wearhouse}',[wearhouseController::class,'show']);
Route::post('/wearhouse/invite',[wearhouseController::class,'invite']);

Route::post('/wearhouse/add',[cargoController::class,'store']);
Route::get('/cargo/{cargo}',[cargoController::class,'show']);
Route::post('/cargo/destroy',[cargoController::class,'destroy']);

Route::post('/operation',[operationController::class,'store']);

Route::post('/wearhouse/linupdate',[employersController::class,'update']);
Route::post('/wearhouse/lindelete',[employersController::class,'destroy']);

Route::get('/{wearhouse}/transactions', [wearhouseController::class,'transaction']);
Route::get('/{wearhouse}/transactions/list', [wearhouseController::class,'list']);
Route::get('/transaction/{bill}', [wearhouseController::class,'bills_show']);
Route::post('/{wearhouse}/transaction', [wearhouseController::class,'store_bill']);
