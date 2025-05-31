<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $alunoId = $this->route('aluno')?->id ?? $this->route('aluno');

        return [
            'nome' => 'required|string|max:255',
            'cpf' => 'required|unique:alunos,cpf,' . $alunoId,
            'email' => 'required|email|unique:alunos,email,' . $alunoId,
            'senha' => $this->isMethod('post') ? 'required|min:6' : 'nullable|min:6',
            'user_id' => 'required|exists:users,id',
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
        ];
    }
}
