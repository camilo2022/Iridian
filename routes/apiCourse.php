<?php

use App\Http\Controllers\Api\V1\CoursesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('Courses/Index',  [CoursesController::class, 'index']);
Route::post('Courses/Store',  [CoursesController::class, 'store']);
Route::put('Courses/Update/{id}',  [CoursesController::class, 'update']);
Route::post('Courses/AssignStudent',  [CoursesController::class, 'assignStudents']);
Route::delete('Courses/RemoveStudent',  [CoursesController::class, 'removeStudents']);
