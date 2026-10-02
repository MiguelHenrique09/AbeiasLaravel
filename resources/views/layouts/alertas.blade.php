{{-- Mensagens de sessão: success / successo (sucesso) e aviso (alerta) --}}
@php
    // Na home o hero já ocupa o topo; nas demais páginas a navbar fica sobreposta no desktop.
    $espacoTopo = $__env->hasSection('hero') ? 'mt-3' : 'mt-3 mt-lg-5 pt-lg-5';
    $tipos = ['success' => 'success', 'successo' => 'success', 'aviso' => 'warning'];
@endphp

@foreach ($tipos as $chave => $classe)
    @if (session($chave))
        <div class="container {{ $espacoTopo }}">
            <div class="alert alert-{{ $classe }} alert-dismissible fade show" role="alert">
                {{ session($chave) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
@endforeach
