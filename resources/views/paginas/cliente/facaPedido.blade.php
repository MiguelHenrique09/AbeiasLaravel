@extends('layouts.app')

@section('title', 'Fazer Pedido — Abeias Burguer')

@section('content')
    <form id="formPedido" action="{{ route('pedido.salvar') }}" method="POST">
        @csrf

        <div class="container bg-dark py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    {{-- Modal de erro (aberto pelo script no fim da página) --}}
                    @if ($errors->any())
                        <div class="modal fade" id="modalErro" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0">
                                    <div class="modal-header text-white" style="background-color: var(--dark);">
                                        <h5 class="modal-title text-white">Não foi possível confirmar o pedido</h5>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($errors->all() as $erro)
                                            <p class="mb-1">{{ $erro }}</p>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn text-white"
                                            style="background-color: var(--primary);"
                                            data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                        <div class="card-header bg-dark text-white text-center py-4">
                            <h1 class="mb-0 text-white fw-bold">Fazer Pedido</h1>
                            <small class="text-light">Escolha seus produtos e finalize</small>
                        </div>

                        <div class="card-body bg-light p-4">

                            {{-- Produtos --}}
                            <div class="row g-4">
                                @foreach ($produtos as $produto)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                                            @if ($produto->imagem_url)
                                                <img src="{{ $produto->imagem_url }}" alt="{{ $produto->nome_produto }}"
                                                    class="card-img-top bg-white p-2"
                                                    style="height: 140px; object-fit: contain;">
                                            @endif

                                            <div class="card-body d-flex flex-column">

                                                <h5 class="fw-bold text-dark">{{ $produto->nome_produto }}</h5>

                                                <p class="text-muted small mb-2">{{ $produto->descricao }}</p>

                                                <p class="text-warning fw-bold fs-5 mb-3">
                                                    R$ {{ number_format($produto->preco_atual, 2, ',', '.') }}
                                                </p>

                                                <label class="form-label small text-muted">Quantidade</label>
                                                <div class="input-group mt-auto" style="width: 150px;">
                                                    <button class="btn bg-dark text-white" type="button"
                                                        onclick="alterarQtde('prod-{{ $produto->idProduto }}', -1)">-</button>

                                                    <input type="text" id="prod-{{ $produto->idProduto }}"
                                                        inputmode="numeric" pattern="[0-9]*"
                                                        name="produto[{{ $produto->idProduto }}]"
                                                        value="{{ old('produto.' . $produto->idProduto, 0) }}"
                                                        data-preco="{{ $produto->preco_atual }}"
                                                        data-nome="{{ $produto->nome_produto }}"
                                                        class="form-control text-center">

                                                    <button class="btn bg-dark text-white" type="button"
                                                        onclick="alterarQtde('prod-{{ $produto->idProduto }}', 1)">+</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Ações --}}
                            <div class="d-flex flex-column flex-md-row gap-3 mt-4">
                                <button type="button" class="btn btn-warning btn-lg fw-bold flex-fill"
                                    data-bs-toggle="modal" data-bs-target="#modalPedido" onclick="abrirResumo()">
                                    Enviar Pedido
                                </button>

                                <a href="{{ route('home') }}" class="btn btn-secondary btn-lg fw-bold flex-fill">
                                    Cancelar
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- Modal de confirmação --}}
        <div class="modal fade" id="modalPedido" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <h6 class="fw-bold">Itens selecionados:</h6>
                        <ul id="listaItens" class="list-group mb-3"></ul>

                        <p>
                            <strong>Total de itens:</strong>
                            <span id="totalItens">0</span>
                        </p>

                        <p>
                            <strong>Valor total:</strong>
                            R$ <span id="totalValor">0.00</span>
                        </p>

                        <label class="form-label mt-3">Observações</label>
                        <textarea id="observacoes" class="form-control" placeholder="Ex: sem cebola, troco pra R$50...">{{ old('observacoes') }}</textarea>
                        <input type="hidden" name="observacoes" id="observacoesHidden">

                        <label class="form-label mt-3">Endereço de entrega</label>
                        <input type="text" id="endereco" class="form-control" placeholder="Digite o endereço"
                            value="{{ old('endereco') }}">
                        <input type="hidden" name="endereco" id="enderecoHidden">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="confirmarPedido()">
                            Confirmar Pedido
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        function alterarQtde(id, delta) {
            const input = document.getElementById(id);
            const novoValor = (parseInt(input.value) || 0) + delta;

            if (novoValor >= 0) {
                input.value = novoValor;
            }
        }

        function abrirResumo() {
            let totalItens = 0;
            let totalValor = 0;
            const lista = document.getElementById("listaItens");
            lista.innerHTML = "";

            document.querySelectorAll("input[name^='produto']").forEach(input => {
                const qtd = parseInt(input.value) || 0;

                if (qtd > 0) {
                    totalItens += qtd;
                    totalValor += qtd * parseFloat(input.dataset.preco);

                    const li = document.createElement("li");
                    li.className = "list-group-item";
                    li.textContent = qtd + "x " + input.dataset.nome;
                    lista.appendChild(li);
                }
            });

            document.getElementById("totalItens").innerText = totalItens;
            document.getElementById("totalValor").innerText = totalValor.toFixed(2);
        }

        function confirmarPedido() {
            if (parseInt(document.getElementById("totalItens").innerText) === 0) {
                alert("Selecione ao menos um produto.");
                return;
            }

            const endereco = document.getElementById("endereco").value.trim();

            if (endereco.length < 7) {
                alert("Por favor, insira um endereço válido.");
                return;
            }

            document.getElementById("enderecoHidden").value = endereco;
            document.getElementById("observacoesHidden").value = document.getElementById("observacoes").value;
            document.getElementById("formPedido").submit();
        }

        @if ($errors->any())
            new bootstrap.Modal(document.getElementById("modalErro")).show();
        @endif
    </script>
@endpush
