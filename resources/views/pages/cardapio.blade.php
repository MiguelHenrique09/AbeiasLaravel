@extends('layouts.app')

@section('title', 'Cardápio — Abeias Burguer')

@section('content')
    <div class="container-xl py-4 bg-dark hero-headerC mb-2">
        <div class="txtHHC">
            <h1 class="section-title text-center text-primary ">Conheça nossos Produtos</h1>

        </div>
    </div>




    <div class="d-flex mb-3 justify-content-center">
    <form method="GET" class="w-100">
        <select name="status" class="form-select bg-primary text-dark" onchange="this.form.submit()">
            <option value="todos" {{ $filtro === 'todos' ? 'selected' : '' }}>Todos</option>
            <option value="Lanche" {{ $filtro === 'Lanche' ? 'selected' : '' }}>Lanches</option>
            <option value="Porção" {{ $filtro === 'Porção' ? 'selected' : '' }}>Porções</option>
            <option value="Bebida" {{ $filtro === 'Bebida' ? 'selected' : '' }}>Bebidas</option>
        </select>
    </form>
</div>

        @foreach ($produtos as $produto)
            <div class="card border-0  p-3 mb-3">
                <h3>{{ $produto->nome_produto }}</h3>

                <p>{{ $produto->descricao }}</p>

                <p><strong>R$ {{ number_format($produto->preco_atual, 2, ',', '.') }}</strong></p>

                <hr>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $produtos->links() }}
        </div>


    </div>
@endsection
