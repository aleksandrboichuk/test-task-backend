<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LuckyPageController;
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



//Route::middleware('guest')->group(function (){
    Route::get('/', [RegisterController::class, 'index'])->name('home');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
//});

Route::middleware('auth')->get('/lucky-page/{hash}', [LuckyPageController::class, 'index'])
    ->where(['hash' => "[0-9a-z]+"])
    ->name('lucky-page');

