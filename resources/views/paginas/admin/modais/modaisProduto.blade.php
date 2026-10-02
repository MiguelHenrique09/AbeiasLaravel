{{-- MODAL: ADICIONAR PRODUTO --}}
<div class="modal fade" id="modalAdd" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">

        <form action="{{ route('criarProduto') }}" method="POST" enctype="multipart/form-data"
            class="modal-content bg-dark text-white">
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

                <input type="file" name="imagem" accept="image/*" class="form-control mb-2">

                <select name="tipo_Produto" class="form-select bg-dark text-white">
                    <option value="Lanche">Lanches</option>
                    <option value="Porção">Porções</option>
                    <option value="Bebida">Bebidas</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Adicionar</button>
            </div>

        </form>
    </div>
</div>

{{-- MODAIS POR PRODUTO: EDITAR e ATIVAR/INATIVAR --}}
@foreach ($produtos as $produto)

    {{-- Editar --}}
    <div class="modal fade" id="edit{{ $produto->idProduto }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

            <form action="{{ route('atualizarProduto', $produto->idProduto) }}" method="POST"
                enctype="multipart/form-data" class="modal-content bg-dark text-white">
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
                    <input type="text" inputmode="decimal" name="preco_atual" value="{{ $produto->preco_atual }}"
                        class="form-control mb-3">

                    <label class="form-label">Nova imagem</label>
                    <input type="file" name="imagem" accept="image/*" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>

            </form>
        </div>
    </div>

    {{-- Ativar / Inativar --}}
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
