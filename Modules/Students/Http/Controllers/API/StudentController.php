<?php

namespace Modules\Students\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\SubjectSubscription;
use Modules\Admin\Entities\Subscription;
use Modules\Admin\Entities\TransferCenterCode;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Sections\Entities\Subjects\StudentSubject;
use Modules\Sections\Transformers\AutomatedQuizQuestionResource;
use Modules\Students\Entities\Student;
use Modules\Students\Entities\StudentAutomatedQuiz;
use Modules\Students\Http\Requests\PostSubscribtionForStudentRequest;
use Modules\Students\Entities\Payment;
use Modules\Students\Entities\StudentSpend;
use Modules\Students\Http\Requests\ChargeBalanceByStudentRequest;
use Modules\Students\Http\Requests\StudentTreansferCenterCodeRequest;
use Modules\Students\Http\Requests\UpdatePasswordRequest;
use Modules\Students\Http\Transformers\StudentResource;
use Modules\Students\Transformers\ChargeBalanceByStudentResource;
use Modules\Students\Transformers\StudentsTransferCenterCodeResource;

class StudentController extends ApiController
{
    public function show($id)
    {
        if (Student::find($id)) {
            $student = Student::where('students.id', $id)
                ->join('users', 'users.id', '=', 'students.user_id')
                ->get();
            return $this->respond(StudentResource::collection([$student[0]])[0]);
        } else {
            return $this->respondError(204, "There's no such student");
        }
    }


    public function update_student_password(UpdatePasswordRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->get();
        if (!empty($student) && $user->role_id == 1) {
            $user = User::find($user->id);
            $user->password = Hash::make($request->new_password);
            $user->update();
            $response = [
                'user' => $user,
            ];
            return $this->success($response, 200);
        } else {
            return $this->error('Can not access', "There's no such student", 401);
        }
    }
    public function get_student_by_guardian($guardian_id)
    {
        $student = Student::where('guardian_id', $guardian_id)->with('user')->get();
        return  $this->success(StudentResource::collection($student), 200);
    }
    public function get_student_points()
    {
        $user = auth('sanctum')->user();
        if (!$user || $user->role_id != 1) {
            return $this->error('Can not access', 'You cannot know your points if you are not logged in', 401);
        } else {

            $student = Student::where('user_id', $user->id)->pluck('points');
            return $this->success($student);
        }
    }
    public function get_student_balance()
    {
        $user = auth('sanctum')->user();
        if (!$user || $user->role_id != 1) {
            return $this->error('Can not access', 'You cannot know your balance if you are not logged in', 401);
        } else {
            $student = Student::where('user_id', $user->id)->pluck('balance');
            return $this->success($student);
        }
    }

    public function get_all_teachers_for_specific_student()
    {
        $user = auth('sanctum')->user();
        $student = Student::select('id')->where('user_id', $user->id)->first();

        $teachers = User::with('teacher')
            ->whereHas('teacher', function ($query) use ($student) {
                $query->whereHas('subjects', function ($query) use ($student) {
                    $query->whereHas('students', function ($query) use ($student) {
                        $query->where('student_id', $student->id);
                    });
                });
            })->get();



        if ($teachers->first()) {
            return  $this->success($teachers, 200);
        } else {
            return  $this->error(['There\'s no such teachers'], 'There\'s no such teachers', 204);
        }
    }
    public function get_student_automated_quizzes_question_by_lesson($lesson_id)
    {

        $user = auth('sanctum')->user();

        $student = Student::where('user_id', $user->id)->pluck('id');

        if (!$student || $user->role_id != 1) {
            return $this->error('Can not access', 'You cannot know your automated quizzes question if you are not logged in', 401);
        } else {
            $studentAutometed = StudentAutomatedQuiz::where('student_id', $student)->pluck('automated_quiz_id');
            $Automated = AutomatedQuiz::where('lesson_id', $lesson_id)->whereIn('id', $studentAutometed)->with(['automatedQuizQuestion.aqqOption', 'automatedQuizQuestion.student' => function ($query) use ($student) {
                $query->where('student_id', $student)->select('aqq_id', 'student_id', 'aqq_option_id', 'point')->first();
            }])->get();
            return  $this->success(AutomatedQuizQuestionResource::collection($Automated), 200);
        }
    }

    public function get_student_automated_quizzes_question_by_subject($subject_id)
    {
        $user = auth('sanctum')->user();

        $student = Student::where('user_id', $user->id)->pluck('id');

        if (!$student || $user->role_id != 1) {
            return $this->error('Can not access', 'You cannot know your automated quizzes question if you are not logged in', 401);
        } else {
            $studentAutometed = StudentAutomatedQuiz::where('student_id', $student)->pluck('automated_quiz_id');
            $Automated = AutomatedQuiz::where('subject_id', $subject_id)->whereIn('id', $studentAutometed)->with(['automatedQuizQuestion.aqqOption', 'automatedQuizQuestion.student' => function ($query) use ($student) {
                $query->where('student_id', $student)->select('aqq_id', 'student_id', 'aqq_option_id', 'point')->first();
            }])->get();
            return  $this->success(AutomatedQuizQuestionResource::collection($Automated), 200);
        }
    }

    public function get_student_automated_quizzes_question_by_unit($unit_id)
    {
        $user = auth('sanctum')->user();

        $student = Student::where('user_id', $user->id)->pluck('id');

        if (!$student || $user->role_id != 1) {
            return $this->error('Can not access', 'You cannot know your automated quizzes question if you are not logged in', 401);
        } else {
            $studentAutometed = StudentAutomatedQuiz::where('student_id', $student)->pluck('automated_quiz_id');
            $Automated = AutomatedQuiz::where('unit_id', $unit_id)->whereIn('id', $studentAutometed)->with(['automatedQuizQuestion.aqqOption', 'automatedQuizQuestion.student' => function ($query) use ($student) {
                $query->where('student_id', $student)->select('aqq_id', 'student_id', 'aqq_option_id', 'point')->first();
            }])->get();
            return  $this->success(AutomatedQuizQuestionResource::collection($Automated), 200);
        }
    }

    public function post_subscription_for_student(PostSubscribtionForStudentRequest $request)
    {
        $user = auth('sanctum')->user();

        if ($user && $user->role_id == 1) {
            $student = Student::where('user_id', $user->id)->first();
            $subscription = Subscription::find($request->subscription_id);

            if ($student->balance >= $subscription->price) {
                $subject_subscription_ids = SubjectSubscription::select('subject_id')->where('subscription_id', $request->subscription_id)->get()->pluck('subject_id');

                foreach ($subject_subscription_ids as $subject_subscription_id) {
                    StudentSubject::create([
                        'subject_id' => $subject_subscription_id,
                        'student_id' => $student->id
                    ]);
                }

                $student->balance = $student->balance - $subscription->price;
                $student->update();

                return  $this->success("The records saved successfully", 204);
            } else {
                return  $this->error(["There\'s no enough balance"], "There\'s not enough balance", 204);
            }
        } else {
            return  $this->error(["The use is not a student"], "The use is not a student", 204);
        }
    }
    public function charge_student_balance_with_code(StudentTreansferCenterCodeRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();
        if ($student) {
            $data = $request->all();
            $transfer_center_code = TransferCenterCode::where('id', $request->transfer_center_code_id)->where('is_transfer', false)->with('transferCenter', 'student.user')->first();
            if ($transfer_center_code) {
                $data['is_transfer'] = true;
                $data['transfer_date'] =  date('Y-m-d');
                $data['student_id'] = $student->id;
                $transfer_center_code->update($data);
                $student->balance = $student->balance + $transfer_center_code->balance;
                $student->update();
                return  $this->success(new StudentsTransferCenterCodeResource($transfer_center_code), 200);
            } else
                return $this->error(["The transfer center code is incorrect or it is has used"], "The transfer center code is incorrect or it is has used", 404);
        } else {
            return $this->error(["The account entered is incorrect or it is not a student"], "The account entered is incorrect or it is not a student", 401);
        }
    }
    public function send_cash_to_another_student_using_email_or_username(ChargeBalanceByStudentRequest $request)
    {

        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();

        if ($student) {
            $data = $request->all();
            $user_receiver_id = User::where('username', $request->username_receiver)->where('role_id', 1)->first();
            $student_receiver = Student::where('user_id', $user_receiver_id->id)->first();
            $data['student_id'] = $student->id;
            $data['student_receiver_id'] = $student_receiver->id;
            $data['is_aproved'] = true;
            $data['balance_before'] = $student->balance;
            $data['balance_after'] = $student->balance - $request->balance;
            $Spend = StudentSpend::create($data);
            $student->balance = $Spend->balance_after;
            $student->update();
            $data_payment['balance_before']  = $student_receiver->balance;
            $student_receiver->balance = $data_payment['balance_before'] + $Spend->balance;
            $student_receiver->update();

            $data_payment['student_id'] = $student_receiver->id;

            $data_payment['balance'] = $Spend->balance;
            $data_payment['is_aproved'] = $Spend->is_aproved;
            $data_payment['balance_after']  =  $data_payment['balance_before'] + $Spend->balance;
            $data_payment['role_id'] = 1;
            Payment::create($data_payment);
            $Spend = StudentSpend::with('student.user', 'studentReceiver.user')->find($Spend->id);
            $Spend['student_receiver_balance_before'] = $data_payment['balance_before'];
            $Spend['student_receiver_balance_after'] = $data_payment['balance_after'];
            return $this->success(new ChargeBalanceByStudentResource($Spend));
        } else {
            return $this->error(["The account entered is incorrect or it is not a student"], "The account entered is incorrect or it is not a student", 401);
        }
    }
}
