<?php

use App\Http\Controllers\Api\V1\StudentsController;
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

Route::post('Students/Index',  [StudentsController::class, 'index']);
Route::post('Students/Store',  [StudentsController::class, 'store']);
Route::put('Students/Update/{id}',  [StudentsController::class, 'update']);
Route::delete('Students/Delete',  [StudentsController::class, 'delete']);
Route::put('Students/Restore',  [StudentsController::class, 'restore']);
