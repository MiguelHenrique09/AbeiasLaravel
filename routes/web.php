<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// Público
Route::view('/', 'paginas.home')->name('home');
Route::get('/cardapio', [CardapioController::class, 'indexClientesProdutos'])->name('cardapio');

// Visitante (quem já está logado é redirecionado)
Route::middleware('guest')->group(function () {
    Route::get('pages/usuarioLogin', [UsuarioController::class, 'userLogin'])->name('usuarioLogin');
    Route::get('pages/usuarioCadastro', [UsuarioController::class, 'userCadastro'])->name('usuarioCadastro');
});

// Administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/pages/homeAdmin', 'paginas.admin.homeAdmin')->name('homeAdmin');

    //Gerenciamento de Pedidos
    Route::get('/gerenciaStatusp', [PedidoController::class, 'AdminLogado'])->name('gerenciaStatusp');
    Route::put('/gerenciaStatusp/{id}', [PedidoController::class, 'atualizarStatus'])->name('atualizarStatus');

    //Gerenciamento de Usuários
    Route::get('pages/listaClientes', [UsuarioController::class, 'indexClientes'])->name('listaClientes');

    // Gerenciamento de Produtos
    Route::get('/gerenciaProduto', [CardapioController::class, 'indexAdminProdutos'])->name('EditaProdutos');
    Route::post('/produtos', [CardapioController::class, 'cria'])->name('criarProduto');
    Route::put('/produtos/update/{id}', [CardapioController::class, 'atualizar'])->name('atualizarProduto');
    Route::put('/produtos/status/{id}', [CardapioController::class, 'atualizarStatus'])->name('atualizarStatusProduto');

    // Gerenciamento de Relatórios
    Route::get('pages/relatorioVendas', [RelatorioController::class, 'index'])->name('relatorioVendas');
    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
});

//Cliente
Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('pages/facaPedido', [PedidoController::class, 'clientePedido'])->name('facaPedido');
    Route::get('/meusPedidos', [PedidoController::class, 'logado'])->name('meusPedidos');
    Route::post('/pedido', [PedidoController::class, 'salvar'])->name('pedido.salvar');
});
Route::middleware('auth','cliente')->get('/app/token', function (Request $request) {
    $user = $request->user();
    $query = http_build_query([
        'token' => $user->createToken('app')->plainTextToken,
        'nome' => $user->nome,
        'email' => $user->email,
    ]);
    return redirect('/app/token-ok?' . $query);
});

Route::get('/app/token-ok', fn () => 'Login concluído');