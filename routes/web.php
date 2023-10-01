<?php

use App\Http\Controllers\{ProfileController,
    ComentarioController,
    UserController};
use App\Models\{Comentario};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', [ComentarioController::class, 'index'])->name('comentarios.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/', [ComentarioController::class, 'store'])->name('comentario.store');
    Route::get('/{id}', [ComentarioController::class, 'show'])->name('comentario.show');
    Route::delete('/{id}', [ComentarioController::class, 'destroy'])->name('comentario.destroy');
    
});

require __DIR__.'/auth.php';
