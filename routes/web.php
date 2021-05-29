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
})->name('home');

Route::prefix('lelang')->name('lelang.')->group(function () {
    Route::get('/', [Controllers\PelelanganController::class, 'index'])->name('index');
    Route::get('/search', [Controllers\PelelanganController::class, 'search'])->name('search');
    Route::get('/show/{id}', [Controllers\PelelanganController::class, 'show'])->name('show');
});

Route::prefix('bid')->name('bid.')->group(function () {
    Route::get('/', [Controllers\BidController::class, 'index'])->name('index');
    Route::post('/', [Controllers\BidController::class, 'create'])->name('create');
});

Route::prefix('klaim')->name('klaim.')->group(function () {
    Route::get('', [Controllers\KlaimController::class, 'index'])->name('index');
    Route::get('/show/{id}', [Controllers\KlaimController::class, 'show'])->name('show');
    Route::post('/', [Controllers\KlaimController::class, 'create'])->name('create');
});

Route::prefix('barangku')->name('barangku.')->group(function () {
    Route::get('/form', [Controllers\BarangkuController::class, 'form'])->name('form');
    Route::post('/form', [Controllers\BarangkuController::class, 'create'])->name('create');
    Route::get('/', [Controllers\BarangkuController::class, 'index'])->name('index');
    Route::get('/show/{id}', [Controllers\BarangkuController::class, 'show'])->name('show');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
