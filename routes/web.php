<?php

use App\Http\Controllers\Dashboard\Category_controller;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\TestController2 as DashboardTestController2;
use App\Http\Controllers\TestController;
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

//Route::get('/',[TestController::class,'test']);

Route::get('/',[DashboardTestController2::class,'index']); //Ruta por la cual va dirigida la dirección url

Route::resource('post', PostController::class);
Route::resource('category', Category_controller::class);

// Route::get('post', [PostController::class,'index']);
// Route::get('post/{post}', [PostController::class,'show']);
// Route::get('post/create', [PostController::class,'create']);
// Route::get('post/{post}', [PostController::class,'edit']);

// Route::post('post', [PostController::class,'store']);
// Route::put('post/{post}', [PostController::class,'update']);
// Route::delete('post/{post}', [PostController::class,'delete']);
