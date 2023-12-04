<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answers\AnswersIndexRequest;
use App\Http\Requests\Answers\AnswersStoreRequest;
use App\Http\Requests\Answers\AnswersUpdateRequest;
use App\Http\Resources\Answers\AnswersIndexCollection;
use App\Models\Answers;
use App\Traits\ApiMessage;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AnswersController extends Controller
{
    use ApiResponser;
    use ApiMessage;

    public function index(AnswersIndexRequest $request)
    {
        try {
            $answers = Answers::with('question')->paginate($request->input('perPage'));

            return $this->successResponse(
                new AnswersIndexCollection($answers),
                $this->getMessage('Success'),
                200
            );
        } catch (QueryException $e) {
            // Manejar la excepción de la base de datos
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('QueryException'),
                    'error' => $e->getMessage()
                ],
                500
            );
        } catch (Exception $e) {
            // Manejar cualquier otro tipo de excepcion
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('Exception'),
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }

    public function store(AnswersStoreRequest $request)
    {
        try {
            $answer = new Answers();
            $answer->question_id = $request->input('question_id');
            $answer->answer = $request->input('answer');
            $answer->correct = $request->input('correct');
            $answer->save();

            return $this->successResponse(
                '',
                'El respuesta fue registrado exitosamente.',
                201
            );
        } catch (QueryException $e) {
            // Manejar excepcion por si algun campo no existe o formato erroneo
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('QueryException'),
                    'error' => $e->getMessage()
                ],
                500
            );
        } catch (Exception $e) {
            // Manejar cualquier otro tipo de excepcion
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('Exception'),
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }

    public function update(AnswersUpdateRequest $request, $id)
    {
        try {
            $answer = Answers::findOrFail($id);
            $answer->question_id = $request->input('question_id');
            $answer->answer = $request->input('answer');
            $answer->correct = $request->input('correct');
            $answer->save();

            return $this->successResponse(
                '',
                'El respuesta fue actualizado exitosamente.',
                200
            );
        } catch (ModelNotFoundException $e) {
            // Manejar excepcion por si el registro no existe o tiene borrado logico
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('ModelNotFoundException'),
                    'error' => $e->getMessage()
                ],
                404
            );
        } catch (QueryException $e) {
            // Manejar excepcion por si algun campo no existe o formato erroneo
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('QueryException'),
                    'error' => $e->getMessage()
                ],
                500
            );
        } catch (Exception $e) {
            // Manejar cualquier otro tipo de excepcion
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('Exception'),
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }
}
