<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    //autentica e vê se é aluno ou admin e redireciona para as telas principais de cada um
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role->nome === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role->nome === 'aluno') {
            return redirect()->route('aluno.dashboard');
        }

        return redirect('/'); 
    }

    /**
     * Destroy an authenticated session.
     */

    //ao dar logout redireciona para tela de login
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

         return redirect('/login');
    }
}
