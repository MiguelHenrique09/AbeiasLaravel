<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->tipo_usuario === 'Administrador') {
            return $next($request);
        }

        return redirect('/')->with('aviso', 'Acesso não autorizado.');
    }
}