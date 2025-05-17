<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PariwisataController;

Route::get("/", [HomeController::class, "index"]);

Route::prefix('pariwisata')->name('pariwisata.')->group(function () {
    Route::get('/', [PariwisataController::class, 'index'])->name('index');
    // Route::get('/create', [PariwisataController::class, 'create'])->name('create');
    // Route::post('/', [PariwisataController::class, 'store'])->name('store');
    // Route::get('/{id}', [PariwisataController::class, 'show'])->name('show');
    // Route::get('/{id}/edit', [PariwisataController::class, 'edit'])->name('edit');
    // Route::put('/{id}', [PariwisataController::class, 'update'])->name('update');
    // Route::delete('/{id}', [PariwisataController::class, 'destroy'])->name('destroy');
});
