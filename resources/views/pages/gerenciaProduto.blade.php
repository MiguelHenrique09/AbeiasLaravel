@extends('layouts.app')

@section('content')
    <div class="container bg-dark py-5">

        {{-- TÍTULO --}}
        <div class="mb-4 mt-3">
            <h2 class="fw-bold text-white">Gerenciar Produtos</h2>
            <small class="text-muted">Adicione, edite ou inative produtos do sistema</small>
        </div>

        {{-- BOTÃO ADICIONAR --}}
        <div class="mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">
                Adicionar Produto
            </button>
        </div>

        {{-- TABELA --}}
        <div class="card border-0 bg-dark shadow-sm p-3">

            <div class="table-responsive">

                <table class="table table-dark table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($produtos as $produto)
                            <tr>

                                {{-- ID --}}
                                <td>{{ $produto->idProduto }}</td>

                                {{-- NOME --}}
                                <td>{{ $produto->nome_produto }}</td>

                                {{-- PREÇO --}}
                                <td>
                                    R$ {{ number_format($produto->preco_atual, 2, ',', '.') }}
                                </td>

                                {{-- STATUS --}}
                                <td>
                                    @if ($produto->ativo)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>

                                {{-- AÇÕES --}}
                                <td class="d-flex gap-2">

                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $produto->idProduto }}">
                                        Editar
                                    </button>

                                    {{-- INATIVAR / ATIVAR --}}
                                    <form action="{{ url('produtos/alterarStatus/' . $produto->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <form action="{{ url('produtos/alterarStatus/' . $produto->idProduto) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <button class="btn btn-warning btn-sm">
                                                {{ $produto->ativo ? 'Inativar' : 'Ativar' }}
                                            </button>

                                        </form>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Nenhum produto encontrado
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- VOLTAR --}}
        <div class="mt-3">
            <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">
                Voltar
            </a>
        </div>

    </div>

    {{--                   MODAL DE ADD PRODUTO             --}}

    <div class="modal fade" id="modalAdd" tabindex="-1" data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered">

            <form action="#" method="POST" class="modal-content bg-dark text-white">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title text-white">Adicionar Produto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" name="nome_produto" class="form-control mb-2" placeholder="Nome">

                    <input type="text" name="descricao_produto" class="form-control mb-2" placeholder="Descrição">

                    <input type="number" name="preco_atual" class="form-control mb-2" placeholder="Preço">

                    <select name="tipoProduto" class="form-select bg-dark text-white">

                        <option value="Lanches">Lanches</option>
                        <option value="Porções">Porções</option>
                        <option value="Bebidas">Bebidas</option>

                    </select>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-success">
                        Salvar
                    </button>
                </div>

            </form>

        </div>

    </div>
    {{--                   FIM DO MODAL DE ADD PRODUTO             --}}

    {{--                   MODAL DE EDITAR PRODUTO             --}}
    @foreach ($produtos as $produto)
        <div class="modal fade" id="edit{{ $produto->idProduto }}" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <form action="{{ url('produtos/update/' . $produto->idProduto) }}" method="POST"
                    class="modal-content bg-dark text-white">

                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title text-white">{{ $produto->nome_produto }}</h5>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <label class="form-label">Nova descrição</label>
                        <input type="text" name="descricao_produto" value="{{ $produto->descricao_produto }}"
                            class="form-control mb-3">

                        <label class="form-label">Valor</label>
                        <input type="text" inputmode="decimal" step="0.01" name="preco_atual"
                            value="{{ $produto->preco_atual }}" class="for">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Atualizar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    @endforeach

    {{--                 FIM DO MODAL DE EDITAR PRODUTO             --}}

    {{--                 MODAL DE EDITAR PRODUTO             --}}

    <div class="modal fade" id="status{{ $produto->id }}">

        <div class="modal-dialog modal-dialog-centered">

            <form action="{{ url('produtos/alterarStatus/' . $produto->id) }}" method="POST"
                class="modal-content bg-dark text-white">

                @csrf
                @method('PUT')

                <div class="modal-body text-center">
                    <p>Deseja alterar status deste produto?</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-warning">Confirmar</button>
                </div>

            </form>

        </div>

    </div>

    {{--                 FIM DO MODAL DE EDITAR PRODUTO             --}}
@endsection
