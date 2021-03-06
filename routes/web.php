<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\CatController as AdminCatController;
use App\Http\Controllers\admin\skillController as AdminSkillController;
use App\Http\Controllers\admin\ExamController as AdminExamController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('web/home/index');
// });
Route::middleware('lang')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('categories/show/{id}', [CatController::class, 'show']);
    Route::get('skills/show/{id}', [SkillController::class, 'show']);
    Route::get('exams/show/{id}', [ExamController::class, 'show']);
    Route::get('exams/questions/{id}', [ExamController::class, 'questions'])->middleware(['auth', 'verified', 'student']);
    Route::post('contact/message/send', [ContactController::class, 'sendMessage']);
    Route::get('profile', [ProfileController::class, 'profile'])->middleware(['auth', 'verified', 'student']);
    Route::get('contact', [ContactController::class, 'index']);
});

Route::post('exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth', 'verified', 'student', 'can-enter-exam']);
Route::post('exams/submit/{id}', [ExamController::class, 'submit'])->middleware(['auth', 'verified', 'student']);

Route::get('lang/set/{lang}', [LangController::class, 'set']);


Route::prefix('dashboard')->middleware(['auth', 'verified', 'can-enter-dashboard'])->group(function () {

    //cats
    Route::get('/', [AdminHomeController::class, 'index']);
    Route::get('/categories', [AdminCatController::class, 'cats']);
    Route::post('/categories/store', [AdminCatController::class, 'store']);
    Route::post('/categories/update', [AdminCatController::class, 'update']);
    Route::get('/categories/toggle/{cat}', [AdminCatController::class, 'toggle']);
    Route::get('/categories/delete/{cat}', [AdminCatController::class, 'delete']);

    //skills
    Route::get('/skills', [AdminSkillController::class, 'skills']);
    Route::post('/skills/store', [AdminSkillController::class, 'store']);
    Route::post('/skills/update', [AdminSkillController::class, 'update']);
    Route::get('/skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);
    Route::get('/skills/delete/{skill}', [AdminSkillController::class, 'delete']);

    //exams
    Route::get('/exams', [AdminExamController::class, 'exams']);
    Route::get('/exams/show/{exam}', [AdminExamController::class, 'show']);
    Route::get('/exams/show/{exam}/questions', [AdminExamController::class, 'showQuestions']);
    Route::get('/exams/create', [AdminExamController::class, 'create']);
    Route::get('/exams/create-questions/{exam}', [AdminExamController::class, 'createQuestions']);
    Route::post('/exams/store-questions/{exam}', [AdminExamController::class, 'storeQuestions']);
    Route::post('/exams/store', [AdminExamController::class, 'store']);
    Route::get('/exams/edit/{exam}', [AdminExamController::class, 'edit']);
    Route::post('/exams/update/{exam}', [AdminExamController::class, 'update']);
    Route::get('/exams/edit-question/{exam}/{question}', [AdminExamController::class, 'editQuestion']);
    Route::post('/exams/update-question/{exam}/{question}', [AdminExamController::class, 'updateQuestion']);
    Route::get('/exams/toggle/{exam}', [AdminExamController::class, 'toggle']);
    Route::get('/exams/delete/{exam}', [AdminExamController::class, 'delete']);

    //student
    Route::get('/students', [StudentController::class, 'students']);
    Route::get('/students/show-scores/{user}', [StudentController::class, 'showScores']);
    Route::get('/students/toggle-status/{student}/{exam}', [StudentController::class, 'toggleStatus']);

    //superAdmins
    Route::prefix('/admins')->middleware('superadmin')->group(function () {

        Route::get('/', [AdminController::class, 'admins']);
        Route::get('/create', [AdminController::class, 'create']);
        Route::post('/store', [AdminController::class, 'store']);
        Route::get('/promote-toggle/{user}', [AdminController::class, 'promoteToggle']);
        Route::get('/delete/{user}', [AdminController::class, 'delete']);
    });

    //message
    Route::get('/messages', [MessageController::class, 'messages']);
    Route::get('/messages/show/{message}', [MessageController::class, 'show']);
    Route::post('/messages/response/{message}', [MessageController::class, 'response']);
});