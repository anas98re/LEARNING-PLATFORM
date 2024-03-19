<?php

namespace Modules\Sections\Http\Controllers\API;

use Modules\Sections\Http\Controllers\API\SectionController;
use Modules\Sections\Http\Controllers\API\UnitCommentController;
use Modules\Sections\Http\Controllers\API\SubSectionController;
use Modules\Sections\Http\Controllers\API\LessonController;
use Modules\Sections\Http\Controllers\API\UnitController;
use Modules\Sections\Http\Controllers\API\SubjectController;
use Modules\Sections\Http\Controllers\API\AutomatedQuizController;
use Modules\Sections\Http\Controllers\SiteLibrary\WebSiteLibraryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Sections\Http\Controllers\SiteLibrary\BookController;
use Modules\Sections\Http\Controllers\API\LessonCommentController;
use Modules\Sections\Http\Controllers\API\LessonQuestionController;
use Modules\Sections\Http\Controllers\API\AutomatedQuizQuestionController;
use Modules\Sections\Http\Controllers\SubjectStudentController;

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


//reviewed
Route::middleware(['setLocal'])->group(function () {

    //units starts 
    Route::get('/get_unit_details_by_unit_id/{id}', [UnitController::class, 'get_unit_details_by_unit_id']);
    //units ends 

    //sections starts
    Route::get('/get_all_sections', [SectionController::class, 'get_all_sections']);
    //sections ends

    //sub sections starts
    Route::get('/get_sub_sections_by_section_id/{id}', [SubSectionController::class, 'get_sub_sections_by_section_id']);
    //sub sections ends

    
    //subject comment
    Route::get('/get_all_comments_by_subject_id/{subject_id}', [SubjectCommentController::class, 'get_all_comments_by_subject_id']);
    //subject comments ends 
    
    //unit comments
    Route::get('/get_all_comments_of_unit_by_unit_id/{unit_id}', [UnitCommentController::class, 'get_all_comments_of_unit_by_unit_id']);
    //unit comments ends

    //lesson comments
    Route::get('/get_all_comments_of_lesson_by_lesson_id/{lesson_id}', [LessonCommentController::class, 'get_all_comments_of_lesson_by_lesson_id']);
    //lesson comments ends 

});
Route::middleware(['auth:sanctum', 'setLocal'])->group(function () {
    //Routes that needs Authentication to access
    Route::post('/post_lesson_comment', [LessonCommentController::class, 'post_lesson_comment']);
    Route::post('/post_unit_comment', [UnitCommentController::class, 'post_unit_comment']);
    Route::post('/post_subject_comment', [SubjectCommentController::class, 'post_subject_comment']);
   
});

//reviewed
// don't put any new route in reviewed section
// you can put it here  
//Route::get('/new_route ', [new_route::class, 'new_route']);
    Route::post('/set_student_subscription_for_the_subject', [SubjectStudentController::class, 'set_student_subscription_for_the_subject']);
    Route::post('/post_the_the_answer_for_automated_quizzes_question', [AutomatedQuizQuestionController::class, 'post_the_the_answer_for_automated_quizzes_question']);





Route::middleware(['setLocal'])->group(function () {

  


   



    //lessons starts
    Route::get('/get_all_lessons_by_unit_id', [LessonController::class, 'get_all_lessons_by_unit_id']);
    Route::get('/get_lesson_by_lesson_id/{id}', [LessonController::class, 'get_lesson_by_lesson_id']);
    Route::get('/get_open_lessons_by_unit_id_and_subject_id', [LessonController::class, 'get_open_lessons_by_unit_id_and_subject_id']);
    //lessons ends



    //units srarts
    Route::get('/get_all_units_by_subject_id', [UnitController::class, 'get_all_units_by_subject_id']);
    //units ends


    Route::get('/get_all_automated_quizzes', [AutomatedQuizController::class, 'get_all_automated_quizzes']);
    //AutomatedQuizQuestion end

   



    //subject
    Route::get('/get_subjects_by_sub_section', [SubjectController::class, 'get_subjects_by_sub_section']);
    Route::get('/get_subject_by_subject_id/{id}', [SubjectController::class, 'get_subject_by_subject_id']);
    Route::get('/get_subjects_by_student_id/{student_id}', [SubjectController::class, 'get_subjects_by_student_id']);
    Route::get('/get_subjects_by_student_id/{student_id}', [SubjectController::class, 'get_subjects_by_student_id']);
    //subjects ends



    //site library
    Route::get('/get_website_library_info', [WebSiteLibraryController::class, 'get_website_library_info']);
    Route::get('/get_books_by_website_library_id/{id}', [BookController::class, 'get_books_by_website_library_id']);
    //site library ends




    // traditional quiz
    Route::get('/get_traditional_quiz_by_quiz_id/{id}', [TraditionalQuizController::class, 'get_traditional_quiz_by_quiz_id']);
    Route::get('/get_all_above_level_traditional_quizzes_by_unit_id', [TraditionalQuizController::class, 'get_all_above_level_traditional_quizzes_by_unit_id']);
    Route::get('/get_all_traditional_quizzes_by_unit_id', [TraditionalQuizController::class, 'get_all_traditional_quizzes_by_unit_id']);
    // traditional quiz ends

    //automated quiz
    Route::get('/get_all_above_level_automated_quiz_by_unit_id', [AutomatedQuizController::class, 'get_all_above_level_automated_quiz_by_unit_id']);
    Route::get('/get_all_automated_quizzes_question_by_automated_quiz/{automated_quiz_id}', [AutomatedQuizQuestionController::class, 'get_all_automated_quizzes_question_by_automated_quiz']);
    Route::get('/get_all_automated_quizzes_question_by_lesson/{lesson_id}', [AutomatedQuizQuestionController::class, 'get_all_automated_quizzes_question_by_lesson']);
    Route::get('/get_all_automated_quizzes_question_by_subject/{subject_id}', [AutomatedQuizQuestionController::class, 'get_all_automated_quizzes_question_by_subject']);
    Route::get('/get_all_automated_quizzes_question_by_unit/{unit_id}', [AutomatedQuizQuestionController::class, 'get_all_automated_quizzes_question_by_unit']);
    //AutomatedQuiz ends


    Route::post('/post_the_the_answer_for_question_lesson', [StudentLessonQuestionController::class, 'post_the_the_answer_for_question_lesson']);
    Route::get('/get_question_by_lesson/{lesson_id}', [LessonQuestionController::class, 'get_question_by_lesson']);
});
