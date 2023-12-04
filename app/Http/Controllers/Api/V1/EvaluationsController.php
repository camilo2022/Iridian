<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Evaluations\EvaluationsCalculateRequest;
use App\Http\Requests\Evaluations\EvaluationsIndexRequest;
use App\Http\Requests\Evaluations\EvaluationsStoreRequest;
use App\Http\Requests\Evaluations\EvaluationsUpdateRequest;
use App\Http\Resources\Evaluations\EvaluationsIndexCollection;
use App\Models\Courses;
use App\Models\Evaluations;
use App\Models\StudentCourses;
use App\Models\Students;
use App\Traits\ApiMessage;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class EvaluationsController extends Controller
{
    use ApiResponser;
    use ApiMessage;

    public function index(EvaluationsIndexRequest $request)
    {
        try {
            $evaluations = Evaluations::with('questions.answers')->paginate($request->input('perPage'));

            return $this->successResponse(
                new EvaluationsIndexCollection($evaluations),
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

    public function store(EvaluationsStoreRequest $request)
    {
        try {
            $evaluation = new Evaluations();
            $evaluation->course_id = $request->input('course_id');
            $evaluation->name = $request->input('name');
            $evaluation->date = Carbon::parse($request->input('date'))->format('Y-m-d');
            $evaluation->save();

            return $this->successResponse(
                '',
                'La evaluacion fue registrado exitosamente.',
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

    public function update(EvaluationsUpdateRequest $request, $id)
    {
        try {
            $evaluation = Evaluations::findOrFail($id);
            $evaluation->course_id = $request->input('course_id');
            $evaluation->name = $request->input('name');
            $evaluation->date = Carbon::parse($request->input('date'))->format('Y-m-d');
            $evaluation->save();

            return $this->successResponse(
                '',
                'La evaluacion fue actualizado exitosamente.',
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

    public function calculate(EvaluationsCalculateRequest $request){
        try {
            $calculate = DB::table('students as s')
            ->selectRaw('s.name, s.lastname, 
                COUNT(eq.question_id) AS total_questions,
                SUM(CASE WHEN a.correct = 1 THEN 1 ELSE 0 END) AS correct_answers,
                ROUND(100.0 * SUM(CASE WHEN a.correct = 1 THEN 1 ELSE 0 END) / COUNT(eq.question_id), 2) AS percentage')
            ->join('student_question_answers AS eq','eq.student_id','=','s.id')
            ->join('questions AS q','q.id','=','eq.question_id')
            ->join('answers AS a','a.id','=','eq.answer_id') 
            ->join('evaluations AS e','e.id','=','q.evaluation_id')
            ->where('e.id', $request->input('id'))
            ->groupBy('s.id')
            ->get();

            //Esta es la query son sql puro para calcular porcentaje de aciertos sin contar las preguntas abiertas
            $queryWithSql = `select s.name, s.lastname, COUNT(eq.question_id) AS total_questions, 
            SUM(CASE WHEN a.correct = 1 THEN 1 ELSE 0 END) AS correct_answers,
            ROUND(100.0 * SUM(CASE WHEN a.correct = 1 THEN 1 ELSE 0 END) / COUNT(eq.question_id), 2) AS percentage from students as s 
            inner join student_question_answers as eq on eq.student_id = s.id inner join questions as q on q.id = eq.question_id inner join 
            answers as a on a.id = eq.answer_id inner join evaluations as e on e.id = q.evaluation_id where e.id = ? group by s.id`;

            return $this->successResponse(
                $calculate,
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
}
