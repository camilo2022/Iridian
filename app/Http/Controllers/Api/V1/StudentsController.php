<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\StudentsDeleteRequest;
use App\Http\Requests\Students\StudentsIndexRequest;
use App\Http\Requests\Students\StudentsRestoreRequest;
use App\Http\Requests\Students\StudentsStoreRequest;
use App\Http\Requests\Students\StudentsUpdateRequest;
use App\Http\Resources\Students\StudentsIndexCollection;
use App\Models\Students;
use App\Traits\ApiMessage;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class StudentsController extends Controller
{
    use ApiResponser;
    use ApiMessage;

    public function index(StudentsIndexRequest $request)
    {
        try {
            $students = Students::when($request->filled('search'),
                    function ($query) use ($request) {
                        $query->search($request->input('search'));
                    }
                )
                ->withTrashed() //Trae los registros 'eliminados'
                ->paginate($request->input('perPage'));

            return $this->successResponse(
                new StudentsIndexCollection($students),
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

    public function store(StudentsStoreRequest $request)
    {
        try {
            $student = new Students();
            $student->name = $request->input('name');
            $student->lastname = $request->input('lastname');
            $student->document = $request->input('document');
            $student->phone = $request->input('phone');
            $student->birth_date = Carbon::parse($request->input('birth_date'))->format('Y-m-d');
            $student->email = $request->input('email');
            $student->save();

            return $this->successResponse(
                '',
                'EL Estudiante fue registrado exitosamente.',
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

    public function update(StudentsUpdateRequest $request, $id)
    {
        try {
            $student = Students::findOrFail($id);
            $student->name = $request->input('name');
            $student->lastname = $request->input('lastname');
            $student->document = $request->input('document');
            $student->phone = $request->input('phone');
            $student->birth_date = Carbon::parse($request->input('birth_date'))->format('Y-m-d');
            $student->email = $request->input('email');
            $student->save();

            return $this->successResponse(
                '',
                'El Estudiante fue actualizado exitosamente.',
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

    public function delete(StudentsDeleteRequest $request)
    {
        try {
            $student = Students::withTrashed()->findOrFail($request->input('id'))->delete();
            return $this->successResponse(
                '',
                'El Estudiante fue eliminado exitosamente.',
                204
            );
        } catch (ModelNotFoundException $e) {
            // Manejar excepcion por si el registro no existe
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('ModelNotFoundException'),
                    'error' => $e->getMessage()
                ],
                404
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

    public function restore(StudentsRestoreRequest $request)
    {
        try {
            $student = Students::withTrashed()->findOrFail($request->input('id'))->restore();
            return $this->successResponse(
                '',
                'El Estudiante fue restaurado exitosamente.',
                204
            );
        } catch (ModelNotFoundException $e) {
            // Manejar excepcion por si el registro no existe
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('ModelNotFoundException'),
                    'error' => $e->getMessage()
                ],
                404
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
