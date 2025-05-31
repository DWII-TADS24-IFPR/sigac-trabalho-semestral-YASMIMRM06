<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComprovanteRequest extends FormRequest
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
        return [
            'horas' => 'required|numeric|min:0.01',
            'atividade' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'aluno_id' => 'required|exists:alunos,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
