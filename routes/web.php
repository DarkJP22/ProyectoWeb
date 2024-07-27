<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Models\Movie;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;

// Ruta para la página de inicio
Route::get('/', [MovieController::class, 'index'])->name('HomePage');

// Ruta para filtrar películas por categoría en la página de inicio
Route::get('/movies/category/{category}', [MovieController::class, 'index'])->name('movies.byCategory');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para en el panel de administración
Route::middleware('auth')->group(function () {
    // Rutas para Movies 
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store')->can('create', Movie::class);
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit')->can('update', 'movie');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update')->can('update', 'movie');
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy')->can('delete', 'movie');

    // Rutas para Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Rutas para Authors
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    // Ruta para el Dashboard
    Route::get('/dashboard', [MovieController::class, 'showDashboard'])->name('dashboard');
});

require __DIR__ . '/auth.php';