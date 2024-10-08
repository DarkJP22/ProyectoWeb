<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;
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
    Route::get('/movies/create', [MovieController::class, 'showCreate'])->name('movies.show');
    Route::post('/movies/store', [MovieController::class, 'store']);
    Route::get('/movies/edit/{movie}', [MovieController::class, 'edit']);
    Route::put('/movies/{movie}/update', [MovieController::class, 'update']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);

    // Rutas para Categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');


    // Ruta para el Dashboard
    Route::get('/dashboard', [MovieController::class, 'showDashboard'])->name('dashboard');
});


require __DIR__ . '/auth.php';
