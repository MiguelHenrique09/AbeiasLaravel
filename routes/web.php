<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
    use App\Http\Controllers\CardapioController;
    use App\Http\Controllers\UsuarioController;
    use App\Http\Controllers\PedidoController;


Route::get('/', function () {
    return view('pages.home');
})->name('home');



Route::get('/cardapio', [CardapioController::class, 'index'])->name('cardapio');
Route::get('pages/facaPedido', [PedidoController::class, 'index'])->name('facaPedido');

//Route::post('/contato', function () {
  //  return back()->with('success', 'Mensagem enviada!');
//})->name('contato.enviar');
Route::get('/pages/homeAdmin', function () {
    return view('pages.homeAdmin');
})->name('home');

Route::get('pages/usuarioLogin', [UsuarioController::class, 'userLogin'])->name('usuarioLogin');
Route::get('pages/usuarioCadastro', [UsuarioController::class, 'userCadastro'])->name('usuarioCadastro');
Route::get('/meusPedidos', [PedidoController::class, 'index2'])->name('meusPedidos');


//Route::get('/cliente/clienteCarrinho', [CardapioController::class, 'indexCarrinho'])->name('clienteCarrinho');


