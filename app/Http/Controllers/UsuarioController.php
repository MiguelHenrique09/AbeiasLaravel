<?php
namespace App\Http\Controllers;

use App\Models\Usuario;

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
    }

}