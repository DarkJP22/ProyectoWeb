<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Models\Movie;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Middleware\CheckAdmin;

// Ruta para la página de inicio
Route::get('/', [MovieController::class, 'home'])->name('HomePage');

// Ruta para filtrar películas por categoría en la página de inicio
Route::get('/movies/category/{category}', [MovieController::class, 'index'])->name('movies.byCategory');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para en el panel de administración
Route::middleware([CheckAdmin::class])->group(function () {
    // Rutas para Movies 
    Route::get('/movies', [MovieController::class, 'index'])->name('movies');
    //Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::get('/movies/create', [MovieController::class, 'showCreate'])->name('movies.show');
    Route::post('/movies/store', [MovieController::class, 'store']);
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit']);
    Route::put('/movies/{movie}/update', [MovieController::class, 'update']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);

    // Rutas para Categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Rutas para Authors
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    // Ruta para el Dashboard
    Route::get('/dashboard', [MovieController::class, 'showDashboard'])->name('dashboard');
});


require __DIR__ . '/auth.php';
