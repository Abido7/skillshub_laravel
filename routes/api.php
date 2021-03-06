<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CatController;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\API\SkillController;
use Illuminate\Http\Request;
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


Route::get('/categories', [CatController::class, 'index']);
Route::get('/categories/show/{id}', [CatController::class, 'show']);
Route::get('/skills/show/{id}', [SkillController::class, 'show']);
Route::get('/exams/show/{id}', [ExamController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/exams/show-questions/{id}', [ExamController::class, 'showQuestions']);
    Route::get('/exams/start/{id}', [ExamController::class, 'start']);
    Route::post('/exams/submit/{id}', [ExamController::class, 'submit']);
});