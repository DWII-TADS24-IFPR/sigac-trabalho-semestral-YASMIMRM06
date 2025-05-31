<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoRequest extends FormRequest
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
            'url' => 'required|url',
            'descricao' => 'required|string|max:255',
            'horas_in' => 'required|numeric',
            'status' => 'required|in:pendente,aprovado,rejeitado',
            'horas_out' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
