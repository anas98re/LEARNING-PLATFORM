<?php

namespace Modules\Students\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sections\Entities\StudentTraditionalQuiz;
use Modules\Sections\Entities\TraditionalQuiz;
use Modules\Students\Entities\Student;
use App\Http\Controllers\ApiController;
use Modules\Students\Http\Requests\GetAnswersOfQuizByQuizIdRequest;

class TraditionalQuizController extends ApiController
{
    public function get_quizzes_for_specific_student_for_lesson()
    {
        $user = auth('sanctum')->user();
        $student = Student::select('id')->where('user_id', $user->id)->first();

        $traditional_quizzes = TraditionalQuiz::whereHas('student_traditional_quizzes', function ($q) use ($student) {
            $q->where('student_id', $student->id)->whereNotNull('lesson_id');
        })->get();

        if ($traditional_quizzes->first()) {
            return  $this->success($traditional_quizzes, 200);
        } else {
            return  $this->error(['There\'s no traditional quizzes for this student'], 'There\'s no traditional quizzes for this student', 204);
        }
    }

    public function get_quizzes_for_specific_student_for_unit()
    {
        $user = auth('sanctum')->user();
        $student = Student::select('id')->where('user_id', $user->id)->first();

        $traditional_quizzes = TraditionalQuiz::whereHas('student_traditional_quizzes', function ($q) use ($student) {
            $q->where('student_id', $student->id)->whereNotNull('unit_id');
        })->get();

        if ($traditional_quizzes->first()) {
            return  $this->success($traditional_quizzes, 200);
        } else {
            return  $this->error(['There\'s no traditional quizzes for this student'], 'There\'s no traditional quizzes for this student', 204);
        }
    }

    public function get_the_answers_of_a_quiz_by_quiz_id(GetAnswersOfQuizByQuizIdRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::select('id')->where('user_id', $user->id)->first();

        $answers_and_questions_of_quiz = TraditionalQuiz::where('id', $request->traditional_quiz_id)->with([
            'traditional_quiz_question_files' => function ($query) {
                $query->select('question_file_link', 'traditional_quiz_id');
            },
            'student_traditional_quizzes' => function ($query) use ($student) {
                $query->where('student_id', $student->id)->select('student_id', 'traditional_quiz_id', 'image_answers');
            }
        ])->get(['id', 'nameOfQuiz', 'correction_Ladder_file_link']);

        if ($answers_and_questions_of_quiz->first()) {
            return  $this->success($answers_and_questions_of_quiz, 200);
        } else {
            return  $this->error(['There\'s no answers for such traditional quiz'], 'There\'s no answers for such traditional quiz', 204);
        }
    }
}
