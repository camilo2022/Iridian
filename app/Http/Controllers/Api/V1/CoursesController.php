<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\CoursesAssignStudentsRequest;
use App\Http\Requests\Courses\CoursesIndexRequest;
use App\Http\Requests\Courses\CoursesRemoveStudentsRequest;
use App\Http\Requests\Courses\CoursesStoreRequest;
use App\Http\Requests\Courses\CoursesUpdateRequest;
use App\Http\Resources\Courses\CoursesIndexCollection;
use App\Models\Courses;
use App\Models\StudentCourses;
use App\Traits\ApiMessage;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CoursesController extends Controller
{
    use ApiResponser;
    use ApiMessage;

    public function index(CoursesIndexRequest $request)
    {
        try {
            $courses = Courses::with('students')->paginate($request->input('perPage'));

            return $this->successResponse(
                new CoursesIndexCollection($courses),
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

    public function store(CoursesStoreRequest $request)
    {
        try {
            $course = new Courses();
            $course->name = $request->input('name');
            $course->description = $request->input('description');
            $course->save();

            return $this->successResponse(
                '',
                'El curso fue registrado exitosamente.',
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

    public function update(CoursesUpdateRequest $request, $id)
    {
        try {
            $course = Courses::findOrFail($id);
            $course->name = $request->input('name');
            $course->description = $request->input('description');
            $course->save();

            return $this->successResponse(
                '',
                'El curso fue actualizado exitosamente.',
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

    public function assignStudents(CoursesAssignStudentsRequest $request)
    {
        try {
            $studentCourses = new StudentCourses();
            $studentCourses->student_id = $request->input('student_id');
            $studentCourses->course_id = $request->input('course_id');
            $studentCourses->save();

            return $this->successResponse(
                '',
                'El estudiante fue asignado al curso exitosamente.',
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

    public function removeStudents(CoursesRemoveStudentsRequest $request)
    {
        try {
            $studentCourses = StudentCourses::where('student_id', $request->input('student_id'))
            ->where('course_id', $request->input('course_id'))->firstOrFail();
            $studentCourses->delete();

            return $this->successResponse(
                '',
                'El estudiante fue removido del curso exitosamente.',
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
