<?php

use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// sync data
Route::post('provinces/syncAll', [ProvinceController::class, 'syncAll'])
    ->name('provinces.syncAll');

Route::middleware(['web'])->prefix('cart')->group(function () {
    Route::get('/', [CartApiController::class, 'index'])->name('api.cart');
    Route::post('/add', [CartApiController::class, 'addToCart'])->name('api.cart.add');
});
