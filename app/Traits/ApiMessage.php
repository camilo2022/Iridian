<?php

namespace App\Traits;

trait ApiMessage
{
	private $messages = [
		'Success' => 'Operación completada con éxito.',
		'ModelNotFoundException' => 'No se encontraron resultados para la búsqueda.',
		'QueryException' => 'Error en la base de datos, por favor, inténtelo de nuevo más tarde.',
		'Exception' => 'Se ha producido un error inesperado, por favor, inténtelo de nuevo más tarde.',
        'ValidationException' => 'Error de validación.'
	];

    public function getMessage($key) {
        return isset($this->messages[$key]) ? $this->messages[$key] : 'Mensaje no encontrado';
    }
}
