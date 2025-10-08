<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarrinhoController;

// Redireciona a rota raiz para a página principal do cardápio
Route::get('/', function () {
    return redirect()->route('pratos.index');
});

// --- ROTAS DE PRATOS ---
// A ordem aqui é crucial. Rotas específicas primeiro.
Route::get('/pratos', [PratoController::class, 'index'])->name('pratos.index');
Route::get('/pratos/create', [PratoController::class, 'create'])->name('pratos.create')->middleware('auth'); // Movida para cima e protegida
Route::get('/pratos/{prato}', [PratoController::class, 'show'])->name('pratos.show'); // Rota dinâmica por último


// Grupo de rotas que exigem que o usuário esteja logado
Route::middleware('auth')->group(function () {
    // Rota do Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rotas do Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas de AÇÃO (POST, PUT, DELETE) para os pratos
    Route::post('/pratos', [PratoController::class, 'store'])->name('pratos.store');
    Route::get('/pratos/{prato}/edit', [PratoController::class, 'edit'])->name('pratos.edit');
    Route::put('/pratos/{prato}', [PratoController::class, 'update'])->name('pratos.update');
    Route::delete('/pratos/{prato}', [PratoController::class, 'destroy'])->name('pratos.destroy');
    
    // Rotas do Carrinho
    Route::post('/carrinho/adicionar/{prato}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::get('/carrinho', [CarrinhoController::class, 'mostrar'])->name('carrinho.mostrar');
    Route::post('/carrinho/finalizar', [CarrinhoController::class, 'finalizar'])->name('carrinho.finalizar');
});

// Inclui as rotas de autenticação
require __DIR__.'/auth.php';