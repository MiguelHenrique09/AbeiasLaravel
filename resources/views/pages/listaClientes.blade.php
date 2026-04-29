
@extends('layouts.app')

@section('content')

<div class="container bg-dark py-5">

    {{-- TÍTULO --}}
    <div class="mb-4 mt-3">
        <h2 class="fw-bold text-white">Lista Clientes</h2>
        <small class="text-muted">Lista de usuários cadastrados no sistema</small>
    </div>

    {{-- TABELA --}}
    <div class="card border-0 bg-dark shadow-sm p-3">

        <div class="table-responsive">

            <table class="table table-dark table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($clientes as $cliente)

                        <tr>

                            {{-- ID --}}
                            <td>{{ $cliente->id }}</td>

                            {{-- NOME --}}
                            <td>{{ $cliente->name }}</td>

                            {{-- EMAIL --}}
                            <td>{{ $cliente->email }}</td>

                                                       <td>{{ $cliente->tipo_usuario }} </td>


                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Nenhum cliente encontrado
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- VOLTAR --}}
    <div class="mt-3">
        <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">
            Voltar
        </a>
    </div>

</div>

@endsection