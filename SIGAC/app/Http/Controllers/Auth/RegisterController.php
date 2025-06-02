<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'cursos' => Curso::orderBy('nome')->get(),
            'roles' => [
                1 => 'Administrador',
                2 => 'Aluno'
            ]
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users',
                'regex:/@.+\.(edu|ac)\..+$/i'
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'integer', Rule::in([1, 2])],
            'curso_id' => ['required_if:role_id,2', 'nullable', 'exists:cursos,id']
        ], [
            'email.regex' => 'Por favor, use um e-mail institucional válido',
            'curso_id.required_if' => 'O campo curso é obrigatório para alunos'
        ]);

        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
            'curso_id' => $validatedData['role_id'] == 2 ? $validatedData['curso_id'] : null,
            'email_verified_at' => $validatedData['role_id'] == 1 ? now() : null
        ];

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Cadastro realizado com sucesso!');
    }
}