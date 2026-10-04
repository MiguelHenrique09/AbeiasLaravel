@extends('layouts.app')

@section('title', 'Usuários — Abeias Burguer')

@section('content')
    <div class="container bg-dark py-5">

        <div class="mb-4 mt-5">
            <h2 class="fw-bold text-white">Lista Usuários</h2>
            <small class="text-muted">Lista de usuários cadastrados no sistema</small>
        </div>

        {{-- Filtro e busca --}}
        <form method="GET" class="d-flex gap-2 mb-3">
            <select name="status" class="form-select bg-dark text-white" onchange="this.form.submit()">
                <option value="todos" @selected($filtro === 'todos')>Todos</option>
                <option value="recentes" @selected($filtro === 'recentes')>Recentes</option>
                <option value="antigos" @selected($filtro === 'antigos')>Antigos</option>
            </select>

            <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar cliente" class="form-control">
        </form>

        {{-- Tabela --}}
        <div class="card border-0 bg-dark shadow-sm p-3">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nome }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->tipo_usuario }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Nenhum usuário encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $clientes->links() }}
            </div>

            <div class="mt-3">
                <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">Voltar</a>
            </div>
        </div>

    </div>
@endsection
