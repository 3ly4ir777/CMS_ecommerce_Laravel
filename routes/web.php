<?php

// use Illuminate\Support\Facades\Route;

// Route::inertia('/', 'welcome')->name('home');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::inertia('dashboard', 'dashboard')->name('dashboard');
// });

// require __DIR__.'/settings.php';


use App\Http\Controllers\ProductController;

// Rutas de tu nuevo EliasCms en Laravel
Route::get('/cms', [ProductController::class, 'index'])->name('cms.index');
Route::post('/cms/productos', [ProductController::class, 'store'])->name('cms.products.store');
Route::delete('/cms/productos/{product}', [ProductController::class, 'destroy'])->name('cms.products.destroy');
