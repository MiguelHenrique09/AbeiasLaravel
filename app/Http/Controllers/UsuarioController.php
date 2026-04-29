<?php
namespace App\Http\Controllers;

use App\Models\User;

class UsuarioController extends Controller
{
    // Método que mostra tla de login do usuario
    public function userLogin()
    {
  return view('pages/usuarioLogin');
  
    }
        // Método que mostra tela de cadastro do usuario

     public function userCadastro()
    {
  return view('pages/usuarioCadastro');
    }public function indexClientes()
{
    $clientes = User::all();
    return view('pages/listaClientes', compact('clientes'));
}
}