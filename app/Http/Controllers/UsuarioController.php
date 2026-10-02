<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function userLogin()
    {
        return view('pages.auth.usuarioLogin');
    }

    public function userCadastro()
    {
        return view('pages.auth.usuarioCadastro');
    }

    public function indexClientes(Request $request)
    {
        $filtro = $request->query('status', 'todos');
        $busca = $request->query('busca');

        $query = User::query();

        if ($filtro === 'recentes') $query->orderBy('created_at', 'desc');
        if ($filtro === 'antigos') $query->orderBy('created_at', 'asc');
        if ($busca) $query->where('name', 'like', '%' . $busca . '%');

        if (! in_array($filtro, ['recentes', 'antigos'])) {
            $query->orderBy('created_at', 'desc');
        }

        $clientes = $query->paginate(10)->withQueryString();

        return view('pages.admin.listaClientes', compact('clientes', 'filtro', 'busca'));
    }
}
