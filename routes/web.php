<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
    return view('home');
});

Route::prefix('lelang')->group(function () {
    Route::get('/', [Controllers\PelelanganController::class, 'index'])->name('lelang.index');
    Route::get('/show/{id}', [Controllers\PelelanganController::class, 'show'])->name('lelang.show');
});
