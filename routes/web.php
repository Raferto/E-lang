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

Route::prefix('lelang')->name('lelang.')->group(function () {
    Route::get('/', [Controllers\PelelanganController::class, 'index'])->name('index');
    Route::get('/show/{id}', [Controllers\PelelanganController::class, 'show'])->name('show');
});

Route::prefix('bid')->name('bid.')->group(function () {
    Route::get('/', [Controllers\BidController::class, 'index'])->name('index');
    Route::post('/', [Controllers\BidController::class, 'create'])->name('create');
});

Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
    Route::post('/', [Controllers\PengajuanController::class, 'create'])->name('create');
    Route::get('/', [Controllers\PengajuanController::class, 'index'])->name('index');
    Route::get('/show/id', [Controllers\PengajuanController::class, 'show'])->name('show');
});
