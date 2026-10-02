@extends('layouts.app')

@section('title', 'Produtos — Abeias Burguer')

@section('content')
    <div class="container bg-dark py-5">

        <div class="mb-4 mt-5">
            <h2 class="fw-bold text-white">Gerenciar Produtos</h2>
            <small class="text-muted">Adicione, edite ou inative produtos do sistema</small>
        </div>

        {{-- Erros de validação dos modais (adicionar/editar) --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Ações, filtro e busca --}}
        <div class="d-flex gap-2 mb-3">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAdd">
                Adicionar Produto
            </button>

            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select bg-dark text-white" onchange="this.form.submit()">
                    <option value="todos" @selected($filtro === 'todos')>Todos</option>
                    <option value="ativos" @selected($filtro === 'ativos')>Ativos</option>
                    <option value="inativos" @selected($filtro === 'inativos')>Inativos</option>
                    <option value="recentes" @selected($filtro === 'recentes')>Recentes</option>
                    <option value="antigos" @selected($filtro === 'antigos')>Antigos</option>
                </select>

                <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar produto"
                    class="form-control">
            </form>
        </div>

        {{-- Tabela --}}
        <div class="card border-0 bg-dark shadow-sm p-3">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->idProduto }}</td>
                                <td>{{ $produto->nome_produto }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>R$ {{ number_format($produto->preco_atual, 2, ',', '.') }}</td>

                                <td>
                                    @if ($produto->ativo)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $produto->idProduto }}">
                                            Editar
                                        </button>

                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#status{{ $produto->idProduto }}">
                                            {{ $produto->ativo ? 'Inativar' : 'Ativar' }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Nenhum produto encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $produtos->links() }}
            </div>

            <div class="mt-3">
                <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">Voltar</a>
            </div>
        </div>

    </div>

    {{-- Modais: adicionar, editar e ativar/inativar --}}
    @include('paginas.admin.modais.modaisProduto')
@endsection
