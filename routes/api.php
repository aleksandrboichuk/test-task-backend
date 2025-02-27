<?php

use App\Http\Controllers\Api\LuckyPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('web')->group(function (){
    Route::get('/im-feeling-lucky/{hash}', [LuckyPageController::class, 'index'])
        ->where(['hash' => "[0-9a-z]+"])
        ->name('im-feeling-lucky');

    Route::get('/history/{hash}', [LuckyPageController::class, 'history'])
        ->where(['hash' => "[0-9a-z]+"])
        ->name('history');

    Route::get('/deactivate/{hash}', [LuckyPageController::class, 'deactivate'])
        ->where(['hash' => "[0-9a-z]+"])
        ->name('history');

    Route::get('/generate-lucky-page-link', [LuckyPageController::class, 'generateNewLink'])
        ->name('history');
});