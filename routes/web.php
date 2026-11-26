<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

// Rutas de Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas de EliasCms
Route::prefix('cms')->name('cms.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // Productos
    Route::post('/productos', [ProductController::class, 'store'])->name('products.store');
    Route::put('/productos/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/productos/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Categorías
    Route::post('/categorias', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categorias/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categorias/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Clientes
    Route::post('/clientes', [ClientsController::class, 'store'])->name('clients.store');
    Route::put('/clientes/{client}', [ClientsController::class, 'update'])->name('clients.update');
    Route::delete('/clientes/{client}', [ClientsController::class, 'destroy'])->name('clients.destroy');
});