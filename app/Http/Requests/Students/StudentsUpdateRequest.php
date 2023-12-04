<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentsUpdateRequest extends FormRequest
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
          'name' => ['required', 'string', 'max:255'],
          'lastname' => ['required', 'string', 'max:255'],
          'document' => ['required', 'string', 'min:5', 'max:20', 'unique:students,document,' . $this->route('id')],
          'phone' => ['required', 'string', 'size:10'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:students,email,' . $this->route('id')]
      ];
  }
  // Mensajes de error personalizados para cada regla de validación
  public function messages()
  {
      return [
          'required' => 'El campo :attribute es requerido.',
          'string' => 'El campo :attribute debe ser una cadena de caracteres.',
          'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
          'unique' => 'El campo :attribute ya ha sido tomado.',
          'max' => 'El campo :attribute no debe exceder los :max caracteres.',
          'min' => 'El campo :attribute debe tener al menos :min caracteres.',
          'size' => 'El campo :attribute debe tener :size caracteres.',
      ];
  }
  /**
   * Obtiene los atributos personalizados de los campos.
   *
   * @return array
   */
  public function attributes()
  {
      // Nombres personalizados para cada campo de la solicitud
      return [
          'name' => 'nombres',
          'lastname' => 'apellidos',
          'document' => 'numero de documento',
          'phone' => 'numero de telefono',
          'email' => 'correo electrónico',
      ];
  }
}
