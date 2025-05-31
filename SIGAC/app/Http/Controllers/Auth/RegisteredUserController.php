<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Turma;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $cursos = Curso::all();
        $turmas = Turma::with('curso')->get(); 
        return view('auth.register', compact('cursos', 'turmas'));
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'cpf' => ['required', 'string', 'unique:alunos,cpf'],
            'curso_id' => ['required', 'exists:cursos,id'],
            'turma_id' => ['required', 'exists:cursos,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'curso_id' => $request->curso_id,
            'turma_id' => $request->turma_id,
        ]);

        Aluno::create([
            'nome' => $request->name,
            'email' => $request->email,
            'senha' => Hash::make($request->password),
            'cpf' => $request->cpf,
            'user_id' => $user->id,
            'curso_id' => $request->curso_id,
            'turma_id' => $request->turma_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('aluno.dashboard');
    }
}
