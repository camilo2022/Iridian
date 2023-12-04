<?php

namespace App\Http\Requests\Questions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuestionsStoreRequest extends FormRequest
{
    /**
     * Maneja una solicitud fallida de validación.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
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
            'evaluation_id' => ['required', 'numeric', 'exists:evaluations,id'],
            'question' => ['required', 'string', 'max:255'],
            'multiple' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'numeric' => 'El campo :attribute debe ser numerico.',
            'exists' => 'El campo :attribute no es valido.',
            'boolean' => 'El campo :attribute debe ser true o false.',
            'max' => 'El campo :attribute no debe exceder los :max caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'course_id' => 'identificador de curso',
            'name' => 'nombre de la evaluacion',
            'multiple' => 'opcion multiple',
        ];
    }
}
