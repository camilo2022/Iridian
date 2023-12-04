<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Questions\QuestionsIndexRequest;
use App\Http\Requests\Questions\QuestionsStoreRequest;
use App\Http\Requests\Questions\QuestionsUpdateRequest;
use App\Http\Resources\Questions\QuestionsIndexCollection;
use App\Models\Questions;
use App\Traits\ApiMessage;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class QuestionsController extends Controller
{
    use ApiResponser;
    use ApiMessage;

    public function index(QuestionsIndexRequest $request)
    {
        try {
            $questions = Questions::with('evaluation', 'answers')->paginate($request->input('perPage'));

            return $this->successResponse(
                new QuestionsIndexCollection($questions),
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

    public function store(QuestionsStoreRequest $request)
    {
        try {
            $question = new Questions();
            $question->evaluation_id = $request->input('evaluation_id');
            $question->question = $request->input('question');
            $question->multiple = $request->input('multiple');
            $question->save();

            return $this->successResponse(
                '',
                'La pregunta fue registrado exitosamente.',
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

    public function update(QuestionsUpdateRequest $request, $id)
    {
        try {
            $question = Questions::findOrFail($id);
            $question->evaluation_id = $request->input('evaluation_id');
            $question->question = $request->input('question');
            $question->multiple = $request->input('multiple');
            $question->save();

            return $this->successResponse(
                '',
                'La pregunta fue actualizado exitosamente.',
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
