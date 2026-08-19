<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Models\User;

class UsuarioController extends Controller
{
    public function userLogin()
    {
        return view('pages/usuarioLogin');

    }

    public function userCadastro()
    {
        return view('pages/usuarioCadastro');
    }

 public function indexClientes(Request $request)
{
    $filtro = $request->query('status', 'todos');
    $busca = $request->query('busca');

    $query = User::query();

    if ($filtro === 'recentes') $query->orderBy('created_at', 'desc');
    if ($filtro === 'antigos') $query->orderBy('created_at', 'asc');
    if ($busca) $query->where('name', 'like', '%' . $busca . '%');

    if (!in_array($filtro, ['recentes', 'antigos'])) {
        $query->orderBy('created_at', 'desc');
    }

    $clientes = $query->paginate(10);

    return view('pages.listaClientes', compact('clientes', 'filtro', 'busca'));
}
}
