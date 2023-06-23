<?php

use App\Http\Controllers\Dashboard\Category_controller;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\BlogController;
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
    return view('auth/login');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', "admin"]], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name("dashboard");

    Route::resources([
        'post' => PostController::class,
        'category' => Category_controller::class,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('blog')->group(function () {
    Route::controller(BlogController::class)->group(function () {
        Route::get('/', 'index')->name("web.blog.index");
        Route::get('/{post}', "show")->name("web.blog.show");
    });
});

Route::get('/vue/{n1?}', function (){//entre mas parametros se necesite se coloca otro parametro {n2?}
    return view('vue');
});

require __DIR__.'/auth.php';
