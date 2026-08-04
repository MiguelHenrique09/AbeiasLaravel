<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
    use App\Http\Controllers\CardapioController;
    use App\Http\Controllers\UsuarioController;
    use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('pages.home');
})->name('home');



Route::get('/cardapio', [CardapioController::class, 'index'])->name('cardapio');

Route::get('/gerenciaProduto', [CardapioController::class, 'indexAdminProdutos'])->name('EditaProdutos')->middleware(['auth', 'admin']);

Route::get('pages/facaPedido', [PedidoController::class, 'index'])->name('facaPedido');

//Route::post('/contato', function () {
  //  return back()->with('success', 'Mensagem enviada!');
//})->name('contato.enviar');
Route::get('/pages/homeAdmin', function () {
    return view('pages.homeAdmin');
})->name('homeAdmin')->middleware(['auth', 'admin']);

Route::get('pages/usuarioLogin', [UsuarioController::class, 'userLogin'])->name('usuarioLogin');
Route::get('pages/usuarioCadastro', [UsuarioController::class, 'userCadastro'])->name('usuarioCadastro');
Route::get('/meusPedidos', [PedidoController::class, 'index2'])->name('meusPedidos');

Route::get('/gerenciaStatusp', [PedidoController::class, 'index3'])->name('gerenciaStatusp')->middleware(['auth', 'admin']);

//Route::get('/cliente/clienteCarrinho', [CardapioController::class, 'indexCarrinho'])->name('clienteCarrinho');

Route::get('pages/listaClientes', [UsuarioController::class, 'indexClientes'])->name('listaClientes')->middleware(['auth', 'admin']);




Route::get('pages/relatorioVendas', function () {
    return view('pages.relatorioVendas');
})->name('relatorioVendas') ->middleware(['auth', 'admin']);
