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
                    <a href="{{ route('cardapio') }}" class="btn btn-primary py-3 px-5 animated slideInLeft">
                        Ver Cardápio
                    </a>
                </div>
                <div class="col-lg-6 text-center text-lg-end overflow-hidden">
<img class="img-fluid" src="{{ asset('img/logoABe.jpg') }}" alt="Abeias Burguer">            </div>
        </div>
    </div>
@endsection

@section('content')

    <!-- Sobre Nós -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center mb-4">
                <h1 class="section-title ff-secondary text-center text-primary fw-normal">Um pouco sobre nós</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <p class="mb-3">
                            No começo, o trailer era bem simples — só um pequeno projeto, muitos amigos e
                            um trailer com o cheirinho de cachorro-quente, petiscos fritos na hora e caldo
                            de feijão fumegando. Sem muito luxo, mas tinha aquele clima de comida feita com
                            carinho.
                        </p>
                        <p class="mb-3">
                            Com o tempo, o trailer foi ganhando fama. Foi aí que veio a ideia de evoluir o
                            cardápio: dos petiscos e caldos, nasceram os primeiros sanduíches artesanais,
                            feitos com pão fresquinho e ingredientes escolhidos a dedo.
                        </p>
                        <p class="mb-0">
                            Hoje, mesmo com a clientela grande e fiel, o trailer continua com aquela essência
                            de sempre — simples, acolhedor e com aquele clima familiar que conquistou todo
                            mundo desde o início.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection