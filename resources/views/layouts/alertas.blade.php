@php
    $espacoTopo = $__env->hasSection('hero') ? 'mt-3' : 'mt-3 mt-lg-5 pt-lg-5';
    $tipos = ['success' => 'success', 'error' => 'danger', 'warning' => 'warning', 'info' => 'info'];
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