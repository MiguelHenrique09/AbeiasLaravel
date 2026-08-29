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
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/pages/homeAdmin', function () {
        return view('pages.homeAdmin');
    })->name('homeAdmin');

    Route::get('/gerenciaStatusp', [PedidoController::class, 'AdminLogado'])->name('gerenciaStatusp');
    Route::put('/gerenciaStatusp/{id}', [PedidoController::class, 'atualizarStatus'])->name('atualizarStatus');
    Route::get('pages/listaClientes', [UsuarioController::class, 'indexClientes'])->name('listaClientes');
    Route::get('pages/relatorioVendas', [RelatorioController::class, 'index'])->name('relatorioVendas');

    //produto
    Route::get('/gerenciaProduto', [CardapioController::class, 'indexAdminProdutos'])->name('EditaProdutos');
    Route::post('/produtos', [CardapioController::class, 'cria'])->name('criarProduto');
    Route::put('/produtos/update/{id}', [CardapioController::class, 'atualizar'])->name('atualizarProduto');
    Route::put('/produtos/status/{id}', [CardapioController::class, 'atualizarStatus'])->name('atualizarStatusProduto');

    //relatorios
    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
});

//clientes
Route::get('pages/usuarioLogin', [UsuarioController::class, 'userLogin'])->name('usuarioLogin');
Route::get('pages/usuarioCadastro', [UsuarioController::class, 'userCadastro'])->name('usuarioCadastro');
Route::get('/cardapio', [CardapioController::class, 'indexClientesProdutos'])->name('cardapio');

Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('pages/facaPedido', [PedidoController::class, 'clientePedido'])->name('facaPedido');
    Route::get('/meusPedidos', [PedidoController::class, 'logado'])->name('meusPedidos');
    Route::post('/pedido', [PedidoController::class, 'salvar'])->name('pedido.salvar');
});