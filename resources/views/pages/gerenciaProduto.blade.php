@extends('layouts.app')

@section('content')
    <div class="container bg-dark py-5">

        <div class="mb-4 mt-5">
            <h2 class="fw-bold text-white">Gerenciar Produtos</h2>
            <small class="text-muted">Adicione, edite ou inative produtos do sistema</small>
        </div>


        <div class="d-flex gap-2 mb-3">

            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAdd">
                Adicionar Produto
            </button>

            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select bg-dark text-white" onchange="this.form.submit()">
                    <option value="todos" {{ $filtro === 'todos' ? 'selected' : '' }}>Todos</option>
                    <option value="ativos" {{ $filtro === 'ativos' ? 'selected' : '' }}>Ativos</option>
                    <option value="inativos" {{ $filtro === 'inativos' ? 'selected' : '' }}>Inativos</option>
                    <option value="recentes" {{ $filtro === 'recentes' ? 'selected' : '' }}>Recentes</option>
                    <option value="antigos" {{ $filtro === 'antigos' ? 'selected' : '' }}>Antigos</option>

                </select>

                <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar produto"
                    class="form-control">

            </form>

        </div>
    </div>



    {{-- TABELA --}}
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

                    @forelse($produtos as $produto)
                        <tr>

                            {{-- ID --}}
                            <td>{{ $produto->idProduto }}</td>
                            {{-- NOME --}}
                            <td>{{ $produto->nome_produto }}</td>
                            {{-- DESCRIÇÃO --}}
                            <td>{{ $produto->descricao }}</td>

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
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#status{{ $produto->idProduto }}">
                                    {{ $produto->ativo ? 'Inativar' : 'Ativar' }}
                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Nenhum produto encontrado
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
 <div class="d-flex justify-content-center mt-4">
            {{ $produtos->links() }}
        </div>
        
         <div class="mt-3">
        <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">
            Voltar
        </a>
    </div>
        </div>
       


    </div>

   

    </div>

    {{--                   MODAL DE ADD PRODUTO             --}}

    <div class="modal fade" id="modalAdd" tabindex="-1" data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered">

            <form action="{{ route('criarProduto') }}" method="POST" class="modal-content bg-dark text-white">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title text-white">Preencha todos os campos do produto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" name="nome_produto" class="form-control mb-2" placeholder="Nome" required>

                    <input type="text" name="descricao_produto" class="form-control mb-2" placeholder="Descrição">

                    <input type="number" step="0.01" name="preco_atual" class="form-control mb-2" placeholder="Preço"
                        required>

                    <select name="tipo_Produto" class="form-select bg-dark text-white">

                        <option value="Lanche">Lanches</option>
                        <option value="Porção">Porções</option>
                        <option value="Bebida">Bebidas</option>

                    </select>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-success">
                        Adicionar
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

                <form action="{{ route('atualizarProduto', $produto->idProduto) }}" method="POST"
                    class="modal-content bg-dark text-white">

                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title text-white">{{ $produto->nome_produto }}</h5>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <label class="form-label">Nova descrição</label>
                        <input type="text" name="descricao_produto" value="{{ $produto->descricao }}"
                            class="form-control mb-3">

                        <label class="form-label">Novo valor</label>
                        <input type="text" inputmode="decimal" step="0.01" name="preco_atual"
                            value="{{ $produto->preco_atual }}" class="form-control">

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

        {{--             MODAL DE INATIVAR/ATIVAR PRODUTO (agora dentro do loop, um por produto)          --}}
        <div class="modal fade" id="status{{ $produto->idProduto }}" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <form action="{{ route('atualizarStatusProduto', $produto->idProduto) }}" method="POST"
                    class="modal-content bg-dark text-white">

                    @csrf
                    @method('PUT')

                    <div class="modal-body text-center">
                        <p>
                            @if ($produto->ativo)
                                Deseja inativar o produto "{{ $produto->nome_produto }}"?
                            @else
                                Deseja ativar o produto "{{ $produto->nome_produto }}"?
                            @endif
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Confirmar</button>
                    </div>

                </form>

            </div>

        </div>
    @endforeach
@endsection
