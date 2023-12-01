<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
	/**
	 * Devuelve una respuesta exitosa con datos y código de respuesta personalizado.
	 *
	 * @param array $data Los datos que se incluirán en la respuesta.
	 * @param int $code El código de respuesta HTTP.
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function successResponse($data = [], $message ='Success',  $status = 200 )
	{
		return response()->json(['data' => $data, 'message' => $message, 'error' => false, 'status' => $status]);
	}

	/**
	 * Devuelve una respuesta de error con mensaje y código de respuesta personalizado.
	 *
	 * @param array $message El mensaje de error.
	 * @param int $code El código de respuesta HTTP.
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message], $code);
	}

	/**
	 * Devuelve una respuesta exitosa con una colección de datos y código de respuesta personalizado.
	 *
	 * @param \Illuminate\Support\Collection $collection La colección de datos.
	 * @param int $code El código de respuesta HTTP.
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function showAll(Collection $collection, $code = 200)
	{
		return $this->successResponse(['data' => $collection], $code);
	}

	/**
	 * Devuelve una respuesta exitosa con un solo dato de tipo Eloquent Model y código de respuesta personalizado.
	 *
	 * @param \Illuminate\Database\Eloquent\Model $instance La instancia del modelo.
	 * @param int $code El código de respuesta HTTP.
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function showOne(Model $instance, $code = 200)
	{
		return $this->successResponse(['data' => $instance], $code);
	}

	/**
	 * Devuelve una respuesta exitosa con un mensaje y código de respuesta personalizado.
	 * Por ejemplo se usa para cuando se eliminea un dato y solo se necesita un mensaje
	 *
	 * @param mixed $message El mensaje.
	 * @param int $code El código de respuesta HTTP.
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function showMessage($message, $code = 200)
	{
		return $this->successResponse(['data' => $message], $code);
	}
}
