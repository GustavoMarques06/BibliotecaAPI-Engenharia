<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Livro;
use App\Models\Review;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ReviewController;



Route::get('/user', function (Request $request) {
    return $request->user();
});

// Usuarios
Route::controller(UsuarioController::class)->group(function () {
    Route::get('/usuarios', 'get');
    Route::get('/usuarios/{id}', 'details');
    Route::get('/usuarios/{id}/reviews', [UsuarioController::class, 'getReviews']); // listar review de usuarios
    Route::post('/usuarios', 'store');
    Route::patch('/usuarios/{id}', 'update');
    Route::delete('/usuarios/{id}', 'delete');
});

// Autores
Route::controller(AutorController::class)->group(function () {
    Route::get('/autores', 'get');
    Route::get('/autores/{id}', 'details');
    Route::get('/autoreslivros', [AutorController::class, 'getAutoresLivrosTitulos']);
    Route::post('/autores', 'store');
    Route::patch('/autores/{id}', 'update');
    Route::delete('/autores/{id}', 'delete');
});

// Gêneros
Route::controller(GeneroController::class)->group(function () {
    Route::get('/generos', 'get');
    Route::get('/generos/{id}', 'details');
    Route::get('/generos/{id}/livros', [GeneroController::class, 'getLivros']); // listar livros relacionados Ao genero
    Route::post('/generos', 'store');
    Route::patch('/generos/{id}', 'update');
    Route::delete('/generos/{id}', 'delete');
});

// Livros
Route::controller(LivroController::class)->group(function () {
    Route::get('/livros', 'get');
    Route::get('/livros/{id}', 'details');
    Route::get('/livros/{id}/reviews','getReviews');
    Route::get('/livros/detalhados','getDetalhados');
    Route::post('/livros', 'store');
    Route::patch('/livros/{id}', 'update');
    Route::delete('/livros/{id}', 'delete');
});

// Reviews
Route::controller(ReviewController::class)->group(function () {
    Route::get('/review', 'get');
    Route::get('/review/{id}', 'details');
    Route::post('/review', 'store');
    Route::patch('/review/{id}', 'update');
    Route::delete('/review/{id}', 'delete');
});