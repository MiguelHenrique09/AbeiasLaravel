@extends('layouts.app')

@section('title', 'Cardápio — Abeias Burguer')

@section('content')
    <div class="container-xl py-5 bg-dark hero-headerC mb-5">    
         <div class="txtHHC">
            <h1 class="section-title text-center text-primary ">Conheça nossos Produtos</h1>
            
          </div>
     </div>
    <div class="container py-5">
@foreach($produtos as $produto)
    <div>
        <h3>{{ $produto->nome_produto }}</h3>

        <p>{{ $produto->descricao }}</p>

        <p><strong>R$ {{ number_format($produto->preco_atual, 2, ',', '.') }}</strong></p>

        <hr>
    </div>
@endforeach




    </div>
@endsection