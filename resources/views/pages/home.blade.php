@extends('layouts.app')

@section('title', 'Abeias Burguer — Início')

@section('hero')
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container my-5 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-3 text-white animated slideInLeft">
                        Aproveite nossa<br>deliciosa refeição!
                    </h1>
                    <p class="text-white animated slideInLeft mb-4 pb-2">
                        Estamos aqui para tornar sua experiência a mais simples e especial possível.
                        Navegue com calma, escolha o que combina com você e, quando estiver pronto,
                        faça seu pedido — estaremos ao seu lado em cada etapa, garantindo qualidade,
                        atenção e um atendimento feito com carinho de verdade.
                    </p>
                   
                    @guest
                         <a href="{{ route('usuarioCadastro') }}" class="btn btn-outline-light py-3 px-5 animated slideInLeft">
                            Cadastre-se
                        </a>
                    @endguest
                </div>
                <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                    <img class="img-fluid" src="{{ asset('img/logoABe.png') }}" alt="Abeias Burguer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    {{-- Alertas de sessão (ex: pedido realizado com sucesso) --}}
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Destaques do Cardápio Start -->
    @if(isset($destaques) && $destaques->count())
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Cardápio</h5>
                <h1 class="mb-5">Destaques da Casa</h1>
            </div>
            <div class="row g-4">
                @foreach($destaques as $item)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="rounded overflow-hidden h-100 d-flex flex-column">
                        @if($item->imagem)
                            <img class="img-fluid" src="{{ asset('storage/' . $item->imagem) }}"
                                 alt="{{ $item->nome }}" style="height:200px;object-fit:cover;">
                        @endif
                        <div class="p-4 border border-top-0 flex-grow-1 d-flex flex-direction-column justify-content-between">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $item->nome }}</h5>
                                <p class="text-muted small mb-2">{{ $item->descricao }}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <span class="text-primary fw-bold fs-5">
                                    R$ {{ number_format($item->preco, 2, ',', '.') }}
                                </span>
                                @auth
                                    <a 
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-shopping-cart me-1"></i> Pedir
                                    </a>
                                @else
                                    <a class="btn btn-outline-primary btn-sm">
                                        Pedir
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('cardapio') }}" class="btn btn-primary py-3 px-5">
                    Ver Cardápio Completo
                </a>
                
            </div>
        </div>
    </div>
    @endif
    <!-- Destaques do Cardápio End -->

    <!-- Sobre Nós Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center mb-4">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Nossa História</h5>
                <h1 class="mb-0">Um pouco sobre nós</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <p class="mb-3">
                            No começo, o trailer era bem simples — só um pequeno projeto, muitos amigos e conhecidos
                            e um trailer com o cheirinho de cachorro-quente, petiscos fritos na hora e caldo de feijão
                            fumegando saindo pela cozinha. Sem muito luxo, mas tinha aquele clima de comida feita com
                            carinho. Aos poucos, o movimento foi crescendo, os clientes voltavam sempre, e aquele
                            pequeno trailer começou a ficar conhecido pelo sabor caseiro que ninguém encontrava em
                            outro lugar.
                        </p>
                        <p class="mb-3">
                            Com o tempo, o trailer foi ganhando fama e os clientes começaram a pedir novidades.
                            Foi aí que veio a ideia de evoluir o cardápio: dos petiscos e caldos, nasceram os
                            primeiros sanduíches artesanais. Eram simples, mas caprichados, feitos com pão fresquinho
                            e ingredientes escolhidos a dedo. O cheiro dos lanches na chapa logo tomou conta da rua,
                            e o que antes era só um trailer de cachorro-quente virou referência para quem procurava
                            um bom sanduíche preparado na hora.
                        </p>
                        <p class="mb-0">
                            Hoje, mesmo com a clientela grande e fiel, o trailer continua com aquela essência de
                            sempre. O cardápio cresceu, os sanduíches ficaram famosos e o movimento quase não para,
                            mas o ambiente segue igual: simples, acolhedor e com aquele clima familiar que conquistou
                            todo mundo desde o início.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sobre Nós End -->
@if (session('aviso'))
    <div class="alert alert-warning">
        {{ session('aviso') }}
    </div>
@endif
@endsection
