<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;
//principal
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// admin

Route::get('/pages/homeAdmin', function () {
    return view('pages.homeAdmin');
})->name('homeAdmin')->middleware(['auth', 'admin']);
Route::get('/gerenciaStatusp', [PedidoController::class, 'AdminLogado'])->name('gerenciaStatusp')->middleware(['auth', 'admin']);
Route::put('/gerenciaStatusp/{id}', [PedidoController::class, 'atualizarStatus'])->name('atualizarStatus')->middleware(['auth', 'admin']);
Route::get('pages/listaClientes', [UsuarioController::class, 'indexClientes'])->name('listaClientes')->middleware(['auth', 'admin']);
Route::get('pages/relatorioVendas', [RelatorioController::class, 'index'])->name('relatorioVendas')->middleware(['auth', 'admin']);





//produto
Route::get('/gerenciaProduto', [CardapioController::class, 'indexAdminProdutos'])->name('EditaProdutos')->middleware(['auth', 'admin']);
Route::post('/produtos', [CardapioController::class, 'cria'])->name('criarProduto')->middleware(['auth', 'admin']);
Route::put('/produtos/update/{id}', [CardapioController::class, 'atualizar'])->name('atualizarProduto')->middleware(['auth', 'admin']);
Route::put('/produtos/status/{id}', [CardapioController::class, 'atualizarStatus'])->name('atualizarStatusProduto')->middleware(['auth', 'admin']);




//relatorios

Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index')->middleware(['auth', 'admin']);



//clientes
Route::get('pages/usuarioLogin', [UsuarioController::class, 'userLogin'])->name('usuarioLogin');
Route::get('pages/usuarioCadastro', [UsuarioController::class, 'userCadastro'])->name('usuarioCadastro');
Route::get('/cardapio', [CardapioController::class, 'indexClientesProdutos'])->name('cardapio');
Route::get('pages/facaPedido', [PedidoController::class, 'clientePedido'])->name('facaPedido')->middleware(['auth', 'cliente']);
Route::get('/meusPedidos', [PedidoController::class, 'logado'])->name('meusPedidos')->middleware(['auth', 'cliente']);
Route::post('/pedido', [PedidoController::class, 'salvar'])->name('pedido.salvar')->middleware(['auth', 'cliente']);
