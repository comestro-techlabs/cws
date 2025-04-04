<?php

use App\Http\Controllers\CategoryControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryControllerApi::class, 'index'])->name('categories.index');
    Route::post('/', [CategoryControllerApi::class, 'store'])->name('categories.store');
    Route::get('/{slug}', [CategoryControllerApi::class, 'show'])->name('categories.show');
    Route::put('/{slug}', [CategoryControllerApi::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryControllerApi::class, 'destroy'])->name('categories.destroy');
});