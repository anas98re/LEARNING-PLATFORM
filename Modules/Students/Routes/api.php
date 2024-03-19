<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Sections\Http\Controllers\API\SubjectController;
use Modules\Sections\Http\Controllers\API\TraditionalQuizController;
use Modules\Students\Http\Controllers\API\AuthController;
use Modules\Students\Http\Controllers\API\StudentController;
use Modules\Students\Http\Controllers\API\StudentLanguagesController;
use Modules\Students\Http\Controllers\PaymentController;
use Modules\Students\Http\Controllers\SavedLessonsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum', 'setLocal'])->group(function () {

    Route::post('post_subscription_for_student ', [StudentController::class, 'post_subscription_for_student']);

    Route::get('get_quizzes_for_specific_student_for_unit', [TraditionalQuizController::class, 'get_quizzes_for_specific_student_for_unit']);

    Route::get('get_the_answers_of_a_quiz_by_quiz_id', [TraditionalQuizController::class, 'get_the_answers_of_a_quiz_by_quiz_id']);

    Route::get('get_quizzes_for_specific_student_for_lesson', [TraditionalQuizController::class, 'get_quizzes_for_specific_student_for_lesson']);
    Route::get('get_all_teachers_for_specific_student', [StudentController::class, 'get_all_teachers_for_specific_student']);

    Route::get('get_student_points', [StudentController::class, 'get_student_points']);
    Route::get('get_student_balance', [StudentController::class, 'get_student_balance']);
    Route::post('update_student_password ', [StudentController::class, 'update_student_password']);
    Route::get('/get_student_automated_quizzes_question_by_lesson/{lesson_id}', [StudentController::class, 'get_student_automated_quizzes_question_by_lesson']);

    Route::get('/get_student_automated_quizzes_question_by_subject/{subject_id}', [StudentController::class, 'get_student_automated_quizzes_question_by_subject']);

    Route::get('/get_student_automated_quizzes_question_by_unit/{unit_id}', [StudentController::class, 'get_student_automated_quizzes_question_by_unit']);
    //payment start
    Route::post('/post_payment', [PaymentController::class, 'post_payment']);
    Route::post('/edit_payment_by_id/{id}', [PaymentController::class, 'edit_payment_by_id']);
    Route::post('/delete_payment_by_id/{id}', [PaymentController::class, 'delete_payment_by_id']);
    Route::get('/get_all_student_payments', [PaymentController::class, 'get_all_payments']);

    //payment end

    Route::post('/charge_student_balance_with_code', [StudentController::class, 'charge_student_balance_with_code']);

    Route::post('/send_cash_to_another_student_using_email_or_username', [StudentController::class, 'send_cash_to_another_student_using_email_or_username']);


    ///////////saved lesson and saved subjects
    Route::post('/add_lesson_to_student_saved_lessons', [SavedLessonsController::class, 'add_lesson_to_student_saved_lessons']);
    Route::get('/get_all_saved_student_subjects', [SavedLessonsController::class, 'get_all_saved_student_subjects']);
    Route::delete('/remove_lesson_from_student_saved_lessons', [SavedLessonsController::class, 'remove_lesson_from_student_saved_lessons']);
    Route::get('/get_all_student_saved_lessons_of_student_saved_subject_by_student_saved_subject_id', [SavedLessonsController::class, 'get_all_student_saved_lessons_of_student_saved_subject_by_student_saved_subject_id']);

   
});


Route::middleware(['setLocal'])->group(function () {
    Route::post('signup', [AuthController::class, 'signup']);
    Route::get('get_all_languages', [StudentLanguagesController::class, 'get_all_languages']);
});

Route::post('/post_student_traditional_quiz_answers', [TraditionalQuizController::class, 'create_student_traditional_quiz_answers']);
Route::get('/get_student_subjects', [SubjectController::class, 'get_student_subjects']);

//by token
