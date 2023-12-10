<?php

use App\Http\Controllers\{ProfileController,
    ComentarioController,
    SeguidoresController,
    UserController};
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', [ComentarioController::class, 'index'])->name('comentarios.index');

Route::middleware('auth')->group(function () {
    //Route::get('/dashboard', [UserController::class, 'seguidores'])->name('dashboard');
    Route::get('/dashboard',  [ SeguidoresController::class, 'seguidores'])->name('dashboard');
    Route::post('/dashboard/{id}', [SeguidoresController::class, 'store'])->name('seguir.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/', [ComentarioController::class, 'store'])->name('comentario.store');
    Route::get('/{id}', [ComentarioController::class, 'show'])->name('comentario.show');
    // Route::post('/{id}', [ComentarioController::class, 'resposta'])->name('comentario.resposta');
    Route::delete('/{id}', [ComentarioController::class, 'destroy'])->name('comentario.destroy');
    Route::post('/{id}/like', [ComentarioController::class, 'like'])->name('comentario.like');
    Route::post('/{id}/desativar', [ComentarioController::class, 'desativar'])->name('comentario.desativar')->middleware('can:desativar,comentario');
    
});

require __DIR__.'/auth.php';
