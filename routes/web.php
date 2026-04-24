<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
    use App\Http\Controllers\CardapioController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas — sem controllers adicionais por enquanto
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');



Route::get('/cardapio', [CardapioController::class, 'index'])->name('cardapio');

Route::post('/contato', function () {
    return back()->with('success', 'Mensagem enviada!');
})->name('contato.enviar');


