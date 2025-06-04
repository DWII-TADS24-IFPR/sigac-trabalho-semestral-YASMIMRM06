<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Mostrar o perfil do aluno
     */
    public function show()
    {
        $user = Auth::user();
        return view('student.profile.show', compact('user'));
    }

    /**
     * Editar o perfil do aluno
     */
    public function edit()
    {
        $user = Auth::user();
        return view('student.profile.edit', compact('user'));
    }

    /**
     * Atualizar o perfil do aluno
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            // Adicione outras validações conforme necessário
        ]);

        $user->update($request->all());

        return redirect()->route('student.profile.show')
                         ->with('success', 'Perfil atualizado com sucesso!');
    }
}