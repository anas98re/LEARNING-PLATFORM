<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AcceptController;
use Modules\Admin\Http\Controllers\Sections\TraditionalQuizController;
use Modules\Admin\Http\Controllers\AutomatedQuizeController;
use Modules\Admin\Http\Controllers\AutomatedQuizQuestionController;
use Modules\Admin\Http\Controllers\ContentAdminController;
use Modules\Admin\Http\Controllers\FinanceAdminController;
use Modules\Admin\Http\Controllers\PaymentController;
use Modules\Admin\Http\Controllers\SubscriptionController;
use Modules\Admin\Http\Controllers\TransferCenterCodeController;
use Modules\Admin\Http\Controllers\TransferCenterController;
use Modules\Admin\Http\Controllers\UsersAdminController;
use Modules\Admin\Http\Controllers\BookController;
use Modules\Admin\Http\Controllers\CommentController;
use Modules\Admin\Http\Controllers\FaqsController;
use Modules\Admin\Http\Controllers\LessonController;
use Modules\Admin\Http\Controllers\Parent1Controller;
use Modules\Admin\Http\Controllers\SectionController;
use Modules\Admin\Http\Controllers\SiteInfoController;
use Modules\Admin\Http\Controllers\StudentController;
use Modules\Admin\Http\Controllers\SubjectController;
use Modules\Admin\Http\Controllers\SubSectionController;
use Modules\Admin\Http\Controllers\TeacherController;
use Modules\Admin\Http\Controllers\UnitController;
use Modules\Admin\Http\Controllers\WebsiteLibraryController;

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

// Route::middleware('auth:api')->get('/admin', function (Request $request) {
//     return $request->user();
// });


Route::middleware(['setLocal'])->group(function () {
    //reviewed 
    Route::post('/create_subscription', [SubscriptionController::class, 'create_subscription']);
    Route::post('/edit_subscription', [SubscriptionController::class, 'edit_subscription']);
    Route::get('/get_all_subscriptions', [SubscriptionController::class, 'get_all_subscriptions']);
    Route::post('/add_subject_to_subscription', [SubscriptionController::class, 'add_subject_to_subscription']);
    Route::delete('/delete_subject_from_subscription', [SubscriptionController::class, 'delete_subject_from_subscription']);
    Route::post('/edit_site_info', [SiteInfoController::class, 'edit']);
    Route::post('/create_traditional_quiz', [TraditionalQuizController::class, 'create_traditional_quiz']);
    Route::post('/edit_traditional_quiz/{id}', [TraditionalQuizController::class, 'edit_traditional_quiz']);
    Route::delete('/delete_traditional_quiz/{id}', [TraditionalQuizController::class, 'delete_traditional_quiz']);
    Route::post('/create_traditional_quiz_questions_files', [TraditionalQuizController::class, 'create_traditional_quiz_questions_files']);
    Route::post('/create_automated_quiz', [AutomatedQuizeController::class, 'create_automated_quiz']);
    Route::post('/edit_automated_quiz/{id}', [AutomatedQuizeController::class, 'edit_automated_quiz']);
    Route::delete('/delete_automated_quiz/{id}', [AutomatedQuizeController::class, 'delete_automated_quiz']);
    Route::post('/add_automated_quiz_question_with_its_options', [AutomatedQuizQuestionController::class, 'add_automated_quiz_question_with_its_options']);
    Route::post('/edit_automated_quiz_question_with_its_options_by_automated_quiz_question', [AutomatedQuizQuestionController::class, 'edit_automated_quiz_question_with_its_options_by_automated_quiz_question_id']);
    Route::delete('/delete_automated_quiz_question_with_its_options_by_automated_quiz_question/{id}', [AutomatedQuizQuestionController::class, 'delete_automated_quiz_question_with_its_options_by_automated_quiz_question_id']);
    Route::post('/student_payment_aprove/{payment_id}', [AcceptController::class, 'student_payment_aprove']);
    Route::post('/active_user_account/{user_id}', [AcceptController::class, 'active_user_account']);
    Route::get('/get_all_payments', [PaymentController::class, 'get_all_payments']);
   
   
   
   
   
   
   
    //reviewed
    // don't put any new route in reviewed section
    // you can put it here  
    //Route::get('/new_route ', [new_route::class, 'new_route']);
    Route::post('/edit_payment/{id}', [PaymentController::class, 'edit_payment']);
    Route::delete('/delete_payment/{id}', [PaymentController::class, 'delete_payment']);
    Route::post('/add_balance_to_student_by_admin', [PaymentController::class, 'add_balance_to_student_by_admin']);
    Route::get('/get_all_transfer_centers', [TransferCenterController::class, 'get_all_transfer_centers']);
    Route::post('/update_transfer_center/{id}', [TransferCenterController::class, 'update_transfer_center']);
    Route::delete('/delete_transfer_center/{id}', [TransferCenterController::class, 'delete_transfer_center']);
    Route::post('/add_transfer_center', [TransferCenterController::class, 'add_transfer_center']);
    Route::get('/get_all_transfer_center_code', [TransferCenterCodeController::class, 'get_all_transfer_center_code']);
    Route::post('/update_transfer_center_code/{id}', [TransferCenterCodeController::class, 'update_transfer_center_code']);
    Route::delete('/delete_transfer_center_code/{id}', [TransferCenterCodeController::class, 'delete_transfer_center_code']);
    Route::post('/add_transfer_center_code', [TransferCenterCodeController::class, 'add_transfer_center_code']);
    Route::delete('/delete_traditional_quiz_question_file_by_traditional_quiz_question_file_id/{id}', [TraditionalQuizController::class, 'delete_traditional_quiz_question_file_by_traditional_quiz_question_file_id']);
    //content admin
    Route::get('/get_all_content_admins', [ContentAdminController::class, 'get_all_content_admins']);
    Route::delete('/delete_content_admin/{id}', [ContentAdminController::class, 'delete_content_admin']);
    Route::post('/update_content_admin/{id}', [ContentAdminController::class, 'update_content_admin']);
    //finance admin
    Route::get('/get_all_finance_admins', [FinanceAdminController::class, 'get_all_finance_admins']);
    Route::delete('/delete_finance_admin/{id}', [FinanceAdminController::class, 'delete_finance_admin']);
    Route::post('/update_finance_admin/{id}', [FinanceAdminController::class, 'update_finance_admin']);
    //users admin
    Route::get('/get_all_users_admins', [UsersAdminController::class, 'get_all_users_admins']);
    Route::delete('/delete_users_admin/{id}', [UsersAdminController::class, 'delete_users_admin']);
    Route::post('/update_users_admin/{id}', [UsersAdminController::class, 'update_users_admin']);
    //Parents
    Route::post('/addParent', [Parent1Controller::class, 'addParent']);
    Route::post('/updateParent/{id}', [Parent1Controller::class, 'updateParent']);
    Route::delete('/deletedParent/{id}', [Parent1Controller::class, 'deletedParent']);
    Route::get('/getAllParents', [Parent1Controller::class, 'getAllParents']);
    //Teacher
    Route::post('/addTeacher', [TeacherController::class, 'addTeacher']);
    Route::post('/updateTeacher/{id}', [TeacherController::class, 'updateTeacher']);
    Route::delete('/deletedteacher/{id}', [TeacherController::class, 'deletedteacher']);
    Route::get('/getAllTeachers', [TeacherController::class, 'getAllTeachers']);
    //Student
    Route::post('/updateStudent/{id}', [StudentController::class, 'updateStudent']);
    Route::get('/getAllStudents', [StudentController::class, 'getAllStudents']);
    Route::delete('/deletedStudent/{id}', [StudentController::class, 'deletedStudent']);
    //Section
    Route::post('/addSection', [SectionController::class, 'addSection']);
    Route::post('/updateSection/{id}', [SectionController::class, 'updateSection']);
    Route::delete('/deletedSection/{id}', [SectionController::class, 'deletedSection']);
    //SubSection
    Route::post('/addSubSection', [SubSectionController::class, 'addSubSection']);
    Route::post('/updateSubSection/{id}', [SubSectionController::class, 'updateSubSection']);
    Route::delete('/deletedSubSection/{id}', [SubSectionController::class, 'deletedSubSection']);
    //Subject
    Route::post('/createSubject', [SubjectController::class, 'createSubject']);
    Route::post('/updateSubject/{id}', [SubjectController::class, 'updateSubject']);
    Route::delete('/deletedSubject/{id}', [SubjectController::class, 'deletedSubject']);
    //Unit
    Route::post('/CreateUnit', [UnitController::class, 'CreateUnit']);
    Route::post('/updateUnit/{id}', [UnitController::class, 'updateUnit']);
    Route::delete('/deletedUnit/{id}', [UnitController::class, 'deletedUnit']);
    //Lesson
    Route::post('/CreateLesson', [LessonController::class, 'CreateLesson']);
    Route::post('/updateLesson/{id}', [LessonController::class, 'updateLesson']);
    Route::delete('/deletedLesson/{id}', [LessonController::class, 'deletedLesson']);
    //Comments ForLesson
    Route::post('/CreateA_CommentForLesson', [CommentController::class, 'CreateA_CommentForLesson']);
    Route::post('/updateA_CommentForLesson/{id}', [CommentController::class, 'updateA_CommentForLesson']);
    Route::delete('/deletedA_CommentForLesson/{id}', [CommentController::class, 'deletedA_CommentForLesson']);
    //Comments ForUnit
    Route::post('/CreateA_CommentForUnit', [CommentController::class, 'CreateA_CommentForUnit']);
    Route::post('/updateA_CommentForUnit/{id}', [CommentController::class, 'updateA_CommentForUnit']);
    Route::delete('/deletedA_CommentForUnit/{id}', [CommentController::class, 'deletedA_CommentForUnit']);
    //Comments ForSubject
    Route::post('/CreateA_CommentForSubjects', [CommentController::class, 'CreateA_CommentForSubjects']);
    Route::post('/updateA_CommentForSubjects/{id}', [CommentController::class, 'updateA_CommentForSubjects']);
    Route::delete('/deletedA_CommentForSubjects/{id}', [CommentController::class, 'deletedA_CommentForSubjects']);
    //websteLibrary
    Route::post('/createWebsiteLibrary', [WebsiteLibraryController::class, 'createWebsiteLibrary']);
    Route::post('/updatedWebsiteLibrary/{id}', [WebsiteLibraryController::class, 'updatedWebsiteLibrary']);
    Route::delete('/deletedWebsiteLibrary/{id}', [WebsiteLibraryController::class, 'deletedWebsiteLibrary']);
    //book
    Route::post('/createBook', [BookController::class, 'createBook']);
    Route::post('/updatedBook/{id}', [BookController::class, 'updatedBook']);
    Route::delete('/deletedBook/{id}', [BookController::class, 'deletedBook']);
    //faqs
    Route::post('/add_faqs', [FaqsController::class, 'add_faqs']);
    Route::post('/update_faqs/{id}', [FaqsController::class, 'update_faqs']);
    Route::delete('/deleted_faqs/{id}', [FaqsController::class, 'deleted_faqs']);
});
