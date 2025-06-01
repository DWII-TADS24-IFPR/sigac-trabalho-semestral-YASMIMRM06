<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Mostra o formulário de registro
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register', [
            'roles' => $this->getRoles()
        ]);
    }

    /**
     * Processa o registro de um novo usuário
     */
    public function register(Request $request): RedirectResponse
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Auth::login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Valida os dados do formulário
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'integer', 'in:1,2'],
        ]);
    }

    /**
     * Cria o novo usuário no banco de dados
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
        ]);
    }

    /**
     * Obtém os tipos de usuário disponíveis
     */
    protected function getRoles(): array
    {
        return [
            1 => 'Administrador',
            2 => 'Aluno'
        ];
    }

    /**
     * Redireciona após o registro
     */
    protected function registered(Request $request, $user)
    {
        // Lógica adicional após registro pode ser adicionada aqui
        return null;
    }

    /**
     * Define para onde redirecionar após registro
     */
    protected function redirectPath(): string
    {
        return route('home');
    }
}