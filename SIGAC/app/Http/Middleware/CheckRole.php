<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    //protege com middleware na hora da autenticação ao se logar
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user() || $request->user()->role->nome !== $role) {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        return $next($request);
    }
}
