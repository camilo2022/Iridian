<?php

namespace App\Http\Requests\Answers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AnswersIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function failedValidation(Validator $validator)
    {
        // Lanzar una excepción de validación con los errores de validación obtenidos
        throw new HttpResponseException(response()->json([
            'message' => 'Error de validación.',
            'errors' => $validator->errors()
        ], 422));
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'perPage' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'perPage.numeric' => 'El campo :attribute debe ser un valor numérico.',
            'perPage.required' => 'El campo :attribute es requerido.'
        ];
    }

    public function attributes()
    {
        return [
            'perPage' => 'numero de registros por página'
        ];
    }
}
