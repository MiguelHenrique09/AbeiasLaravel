<!-- Navbar & Hero Start -->
<div class="container-xxl position-relative p-0">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{ route('home') }}" class="navbar-brand p-0">
            <h1 class="text-primary m-0">Abeias Burguer</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">

                <a href="{{ route('home') }}"
                   class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Início
                </a>

                <a href="{{ route('cardapio') }}"
                   class="nav-item nav-link {{ request()->routeIs('cardapio') ? 'active' : '' }}">
                    Cardápio
                </a>

                <a 
                   class="nav-item nav-link {{ request()->routeIs('contato') ? 'active' : '' }}">
                    Fale Conosco
                </a>

            </div>

            {{-- Botão: muda conforme o usuário está logado ou não --}}
            @auth
                <a href="{{ route('pedidos.create') }}" class="btn btn-primary py-2 px-4">
                    <i class="fa fa-shopping-cart me-1"></i> Fazer Pedido
                </a>
            @else
                <a class="btn btn-primary py-2 px-4">
                    Faça já seu pedido
                </a>
            @endauth
        </div>
    </nav>

    {{-- Hero: só exibe na home --}}
    @hasSection('hero')
        @yield('hero')
    @endif

</div>
<!-- Navbar & Hero End -->
