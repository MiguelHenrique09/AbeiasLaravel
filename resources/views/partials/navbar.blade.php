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
                    Ver Cardápio
                </a>

            </div>

           @auth
    @if (auth()->user()->tipo_usuario === 'Cliente')
        <a href="{{ route('facaPedido') }}" class="btn btn-primary py-2 px-4">
            <i class="fa fa-shopping-cart me-1"></i> Fazer Pedidos
        </a>
    @endif

    @if (auth()->user()->tipo_usuario === 'Administrador')
        
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-item nav-link btn btn-link">
            Sair
        </button>
    </form>
@else
    <a href="{{ route('usuarioLogin') }}" class="btn btn-primary py-2 px-4">
        Fazer Login
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