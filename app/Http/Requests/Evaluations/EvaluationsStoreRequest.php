<?php

namespace App\Http\Requests\Evaluations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EvaluationsStoreRequest extends FormRequest
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
            'course_id' => ['required', 'numeric', 'exists:courses,id'],
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'numeric' => 'El campo :attribute debe ser numerico.',
            'exists' => 'El campo :attribute no es valido.',
            'date' => 'El campo :attribute debe ser una fecha.',
            'max' => 'El campo :attribute no debe exceder los :max caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'course_id' => 'identificador de curso',
            'name' => 'nombre de la evaluacion',
            'date' => 'fecha de evaluacion',
        ];
    }
}