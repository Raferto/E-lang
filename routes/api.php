<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [API\AuthController::class, 'register']);
Route::post('login', [API\AuthController::class, 'login']);


// route pencarian barang
Route::prefix('search')->name('search.')->group(function () {
    Route::post('/', [API\SearchAPIController::class, 'index'])->name('index');
    Route::post('/show', [API\SearchAPIController::class, 'show'])->name('show');
    Route::post('/search', [API\SearchAPIController::class, 'search'])->name('search');
});

Route::middleware('auth:sanctum')->group(function () {
    // route bid
    Route::prefix('bid')->name('bid.')->group(function () {
        Route::get('/', [API\BidController::class, 'index'])->name('index');
        Route::post('/', [API\BidController::class, 'create'])->name('create');
    });

    // route klaim/pembayaran
    Route::prefix('klaim')->name('klaim.')->group(function () {
        Route::post('/', [API\KlaimAPIController::class, 'index'])->name('index');
        Route::post('/show', [API\KlaimAPIController::class, 'show'])->name('show');
        Route::post('/create', [API\KlaimAPIController::class, 'create'])->name('create');
    });

    // route barangku
    Route::prefix('barangku')->name('barangku.')->group(function () {
        Route::post('/create', [API\BarangController::class, 'create'])->name('create');
        Route::get('/', [API\BarangController::class, 'index'])->name('index');
        Route::post('/show', [API\BarangController::class, 'show'])->name('show');
    });
});
