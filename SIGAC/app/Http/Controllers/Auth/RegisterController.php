<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Mostrar o formulário de registro
     */
    public function showRegistrationForm()
    {
        // Permitir cadastro de admin apenas se já estiver logado como admin
        $showAdminOption = auth()->check() && auth()->user()->isAdmin();
        
        return view('auth.register', [
            'showAdminOption' => $showAdminOption
        ]);
    }

    /**
     * Processar o registro
     */
     public function register(Request $request)
    {

        $validated = $request->validate([
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
            'user_type' => ['required', 'in:student,admin']
        ], [
            'email.regex' => 'Por favor, use um e-mail institucional válido',
            'user_type.in' => 'Tipo de usuário inválido'
        ]);

        $request->user_type == 'student' ? $role_id = 1 : $role_id = 2;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $role_id,
            'curso_id' => $request->curso_id,
            'email_verified_at' => null
        ]);

        Auth::login($user);

        // Redirecionar conforme o tipo de usuário
        return $user->isAdmin()
            ? redirect()->route('admin.dashboard')->with('success', 'Admin cadastrado com sucesso!')
            : redirect()->route('student.activities.index')->with('success', 'Cadastro realizado com sucesso!');
    }
}