<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']); // Routing untuk melakukan register 
Route::post('/login', [AuthController::class, 'login']); // Routing untuk melakukan login

Route::middleware(['auth:api'])->group(function() { // Routing untuk grouping yang sudah login
    
    Route::post('/logout', [AuthController::class, 'logout']); // Pengguna bisa logout ketika sudah login

    Route::middleware(['role:admin'])->group(function() { // Hanya admin yang sudah login dapat ke store, update, dan destroy
        Route::apiResource('/books', BookController::class)->only(['store', 'update', 'destroy']);
    });
    
});

// Routes apiResource. Books
Route::apiResource('/books', BookController::class)->only(['index', 'show']); // Pengguna yang belum login dapat mengakses index dan show saja dari books


// Routes apiResource. Genre
Route::apiResource('/genres', GenreController::class)->only(['index', 'show']); // Pengguna yang belum login dapat mengakses index dan show saja dari genre


// Routes apiResource. Authors
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']); // Pengguna yang belum login dapat mengakses index dan show saja dari author