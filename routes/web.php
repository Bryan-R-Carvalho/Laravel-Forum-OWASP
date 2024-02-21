<?php

use App\Http\Controllers\{ProfileController,
    ComentarioController,
    SeguidoresController};
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', [ComentarioController::class, 'index'])->name('comentarios.index');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',  [ SeguidoresController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/{id}', [SeguidoresController::class, 'store'])->name('seguir.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('comentario')->group(function(){

        Route::post('/', [ComentarioController::class, 'store'])->name('comentario.store');
        Route::get('/{id}', [ComentarioController::class, 'show'])->name('comentario.show');
        Route::post('/{id}/responder', [ComentarioController::class, 'responder'])->name('comentario.responder');
        Route::get('/{id}/edit', [ComentarioController::class, 'edit'])->name('comentario.edit');
        Route::put('/{id}', [ComentarioController::class, 'update'])->name('comentario.update');
        Route::post('/{id}/desativar', [ComentarioController::class, 'desativar'])->name('comentario.desativar')->middleware('can:desativar,comentario');

        Route::delete('/{id}', [ComentarioController::class, 'destroy'])->name('comentario.destroy');
    });
        
});

require __DIR__.'/auth.php';
