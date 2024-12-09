<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PessoaController;
use \App\Http\Controllers\ProfissionalController;
use \App\Http\Controllers\AtendimentoController;
use \App\Http\Controllers\GrupoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('pessoas', PessoaController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update','destroy'])
    ->middleware(['auth', 'verified']);
Route::resource('profissionals', ProfissionalController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update','destroy'])
    ->middleware(['auth', 'verified']);
Route::resource('atendimentos', AtendimentoController::class)
    ->only(['index', 'store', 'edit', 'update'])
    ->middleware(['auth', 'verified']);
Route::resource('grupos', GrupoController::class)
    ->only(['index', 'store', 'edit', 'update'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
