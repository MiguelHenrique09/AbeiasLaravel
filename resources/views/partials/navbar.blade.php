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
            <div class="navbar-nav ms-auto align-items-center">

                @auth

                    @if (auth()->user()->tipo_usuario === 'Cliente')
                        <a href="{{ route('home') }}" class="nav-item nav-link">
                            Início
                        </a>

                        <a href="{{ route('facaPedido') }}" class="btn btn-primary ms-3">
                            <i class="fa fa-shopping-cart me-1"></i> Fazer Pedidos
                        </a>
                          <a href="{{ route('cardapio') }}" class="nav-item nav-link">
                        Ver Cardápio
                    </a>
                    @endif

                    @if (auth()->user()->tipo_usuario === 'Administrador')
                        <a href="{{ route('homeAdmin') }}" class="btn btn-primary ms-3">
                            <i class="fa me-1"></i> Área de administração
                        </a>
                          <a href="{{ route('cardapio') }}" class="nav-item nav-link">
                        Ver Cardápio
                    </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="ms-3">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('cardapio') }}" class="nav-item nav-link">
                        Ver Cardápio
                    </a>
                    <a href="{{ route('usuarioLogin') }}" class="btn btn-primary ms-3">
                        Fazer Login
                    </a>

                @endauth

            </div>
        </div>
    </nav>

    {{-- Hero: só exibe na home --}}
    @hasSection('hero')
        @yield('hero')
    @endif

</div>
<!-- Navbar & Hero End -->
