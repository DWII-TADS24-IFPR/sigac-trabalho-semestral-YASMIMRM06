<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->user_type === 'admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Acesso permitido apenas para administradores.');
    }
}