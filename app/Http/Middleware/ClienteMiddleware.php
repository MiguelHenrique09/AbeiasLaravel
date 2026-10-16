<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->tipo_usuario === 'Cliente') {
            return $next($request);
        }

return redirect('/')->with('warning', 'Acesso não autorizado,autentique-se.');    }
}