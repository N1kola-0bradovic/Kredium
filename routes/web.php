<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('client')->group(function () {
    Route::get('index', [App\Http\Controllers\ClientController::class, 'index'])->name('client.index');
    Route::post('store', [App\Http\Controllers\ClientController::class, 'store'])->name('client.store');
    Route::get('create', [App\Http\Controllers\ClientController::class, 'create'])->name('client.create');
    // Route::get('show/{id}', [App\Http\Controllers\ClientController::class, 'show'])->name('client.show');
    Route::get('edit/{client}', [App\Http\Controllers\ClientController::class, 'edit'])->name('client.edit');
    Route::put('update/{client}', [App\Http\Controllers\ClientController::class, 'update'])->name('client.update');
    Route::delete('destroy/{client}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('client.destroy');
});

Route::prefix('report')->group(function () {
    Route::get('index', [App\Http\Controllers\ProductController::class, 'index'])->name('report.index');
    Route::get('export', [App\Http\Controllers\ProductController::class, 'export'])->name('report.export');
});