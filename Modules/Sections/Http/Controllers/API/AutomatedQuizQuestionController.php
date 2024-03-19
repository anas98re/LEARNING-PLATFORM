<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sections\Entities\AqqOption;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Sections\Entities\AutomatedQuizQuestion;
use Modules\Sections\Entities\StudentAutomatedQuizQuestion;
use Modules\Sections\Http\Requests\GetAllAutomatedQuizzesQuestionRequest;
use Modules\Sections\Http\Requests\StudentAutomatedQuizQuestionRequest;
use Modules\Sections\Transformers\AutomatedQuizQuestionResource;
use Modules\Sections\Transformers\StudentAutomatedQuizQuestionResource;
use Modules\Students\Entities\Student;

class AutomatedQuizQuestionController extends ApiController
{
    public function get_all_automated_quizzes_question_by_automated_quiz(GetAllAutomatedQuizzesQuestionRequest $request, $automated_quiz_id)
    {
        $questions = AutomatedQuizQuestion::where('automated_quiz_id', $automated_quiz_id)->with('aqqOption')->paginate($request->limit);
        if ($questions->first()) {
            return  $this->success(AutomatedQuizQuestionResource::collection($questions), 200);
        } else {
            return  $this->error(['There\'s no such questions'], 'There\'s no such questions', 204);
        }
    }

    public function post_the_the_answer_for_automated_quizzes_question(StudentAutomatedQuizQuestionRequest $request)
    {
        $user = auth('sanctum')->user();
        $student_id = Student::where('user_id', $user->id)->first()->id;
        $aqq_id = [];
        if ($user && $user->role_id == 1) {
            foreach ($request->answers as $answer) {
                $point = AutomatedQuizQuestion::where('id', $answer['question_id'])->first()->point;
                $option = AqqOption::where('aqq_id', $answer['question_id'])->where('is_true', 1)->first()->id;
                $data = $request->all();
                $data['student_id'] = $student_id;
                $data['aqq_id'] = $answer['question_id'];
                if ($option == $answer['option_id']) {
                    $data['point'] = $point;
                } else {
                    $data['point'] = 0;
                }
                $data['student_has_show'] = true;
                $data['aqq_option_id'] =  $answer['option_id'];
                StudentAutomatedQuizQuestion::create($data);
                $aqq_id[] = $answer['question_id'];
            }
            $student_answer = StudentAutomatedQuizQuestion::where('student_id', $student_id)->whereIn('aqq_id', $aqq_id)->get();
            return $this->success(StudentAutomatedQuizQuestionResource::collection($student_answer), 200);
        } else {
            return $this->error(["the user is not student"], "the user is not student", 401);
        }
    }

    public function get_all_automated_quizzes_question_by_lesson(GetAllAutomatedQuizzesQuestionRequest $request, $lesson_id)
    {
        $Automated = AutomatedQuiz::where('lesson_id', $lesson_id)->pluck('id');
        $questions = AutomatedQuizQuestion::whereIn('automated_quiz_id', $Automated)->paginate($request->limit);
        if ($questions->first()) {
            return  $this->success(AutomatedQuizQuestionResource::collection($questions), 200);
        } else {
            return  $this->error(['There\'s no such questions'], 'There\'s no such questions', 204);
        }
    }

    public function get_all_automated_quizzes_question_by_subject(GetAllAutomatedQuizzesQuestionRequest $request, $subject_id)
    {
        $Automated = AutomatedQuiz::where('subject_id', $subject_id)->pluck('id');
        $questions = AutomatedQuizQuestion::whereIn('automated_quiz_id', $Automated)->paginate($request->limit);
        if ($questions->first()) {
            return  $this->success(AutomatedQuizQuestionResource::collection($questions), 200);
        } else {
            return  $this->error(['There\'s no such questions'], 'There\'s no such questions', 204);
        }
    }

    public function get_all_automated_quizzes_question_by_unit(GetAllAutomatedQuizzesQuestionRequest $request, $unit_id)
    {
        $Automated = AutomatedQuiz::where('unit_id', $unit_id)->pluck('id');
        $questions = AutomatedQuizQuestion::whereIn('automated_quiz_id', $Automated)->paginate($request->limit);
        if ($questions->first()) {
            return  $this->success(AutomatedQuizQuestionResource::collection($questions), 200);
        } else {
            return  $this->error(['There\'s no such questions'], 'There\'s no such questions', 204);
        }
    }
}
