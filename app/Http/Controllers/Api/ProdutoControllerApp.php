<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;

class ProdutoControllerApp extends Controller
{
    public function index()
    {
        return Produto::where('ativo', 1)->get();
    }
}