@extends('layouts.app')

@section('title', 'Cardápio — Abeias Burguer')

@section('content')
    <div class="container-xl py-4 bg-dark hero-headerC mb-2">
        <div class="txtHHC">
            <h1 class="section-title text-center text-primary">Conheça nossos Produtos</h1>
        </div>
    </div>

    {{-- Filtro por tipo --}}
    <div class="d-flex mb-3 justify-content-center">
        <form method="GET" class="w-100">
            <select name="status" class="form-select bg-primary text-dark" onchange="this.form.submit()">
                <option value="todos" @selected($filtro === 'todos')>Todos</option>
                <option value="Lanche" @selected($filtro === 'Lanche')>Lanches</option>
                <option value="Porção" @selected($filtro === 'Porção')>Porções</option>
                <option value="Bebida" @selected($filtro === 'Bebida')>Bebidas</option>
            </select>
        </form>
    </div>

    {{-- Lista de produtos --}}
    @foreach ($produtos as $produto)
        <div class="card border-0 p-3 mb-3">
            <div class="d-flex align-items-center">
                @if ($produto->imagem_url)
                    <img src="{{ $produto->imagem_url }}" alt="{{ $produto->nome_produto }}"
                        class="produto-img rounded me-3 flex-shrink-0">
                @endif

                <div>
                    <h3>{{ $produto->nome_produto }}</h3>
                    <p>{{ $produto->descricao }}</p>
                    <p><strong>R$ {{ number_format($produto->preco_atual, 2, ',', '.') }}</strong></p>
                </div>
            </div>

            <hr>
        </div>
    @endforeach

    <div class="d-flex justify-content-center mt-4">
        {{ $produtos->links() }}
    </div>
@endsection
