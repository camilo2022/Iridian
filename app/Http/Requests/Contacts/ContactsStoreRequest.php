<?php

namespace App\Http\Requests\Contacts;

use App\Rules\UniqueToday;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ContactsStoreRequest extends FormRequest
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
          'email' => ['required', 'string', 'email', 'max:255', new UniqueToday($this->input('email'))],
          'phone' => ['required', 'string', 'size:10'],
          'contact_area_id' => ['required', 'numeric', 'exists:contact_areas,id'],
          'message' => ['required', 'string', 'min:5', 'max:255'],
      ];
  }

  public function messages()
  {
      return [
          'required' => 'El campo :attribute es requerido.',
          'string' => 'El campo :attribute debe ser una cadena de caracteres.',
          'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
          'max' => 'El campo :attribute no debe exceder los :max caracteres.',
          'exists' => 'El campo :attribute no es valido.',
          'size' => 'El campo :attribute debe tener :size caracteres.',
      ];
  }

  public function attributes()
  {
      return [
          'name' => 'nombres',
          'lastname' => 'apellidos',
          'email' => 'correo electrónico',
          'document' => 'numero de documento',
          'phone' => 'numero de telefono',
          'address' => 'direccion',
          'contact_area_id' => 'identificador del area de contacto'
      ];
  }
}
