<?php

use App\Http\Controllers\Api\V1\EvaluationsController;
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

Route::post('Evaluations/Index',  [EvaluationsController::class, 'index']);
Route::post('Evaluations/Store',  [EvaluationsController::class, 'store']);
Route::put('Evaluations/Update/{id}',  [EvaluationsController::class, 'update']);
Route::post('Evaluations/Calculate',  [EvaluationsController::class, 'calculate']);
