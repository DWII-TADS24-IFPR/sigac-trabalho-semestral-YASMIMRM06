<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'sigla' => 'required|string|max:10',
            'total_horas' => 'required|numeric|min:1',
            'nivel_id' => 'required|exists:niveis,id',
            'eixo_id' => 'required|exists:eixos,id',
        ];
    }
}
