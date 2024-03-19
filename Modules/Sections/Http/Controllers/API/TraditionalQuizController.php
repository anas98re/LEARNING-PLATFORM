<?php

namespace Modules\Sections\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\ApiController;
use Modules\Sections\Entities\TraditionalQuiz;
use Modules\Sections\Entities\StudentTraditionalQuiz;
use Modules\Sections\Http\Requests\QuizByUnitRequest;
use Modules\Sections\Http\Requests\StudentTraditionalQuizzesRequest;
use Modules\Sections\Transformers\TraditionalQuizResource;
use Modules\Sections\Http\Requests\CreateStudentTraditionalQuizAnswersRequest;
use Modules\Sections\Http\Requests\GetTraditionalQuizByTraditionalQuizIdRequest;
use Modules\Sections\Http\Requests\QuizByUnitIdRequest;
use Modules\Students\Entities\Student;

class TraditionalQuizController extends ApiController
{
    public function get_all_above_level_traditional_quizzes_by_unit_id(QuizByUnitIdRequest $request)
    {
        $quizzes = TraditionalQuiz::where('unit_id', $request->unit_id)->where('isAboveLevel', '>', 0)->paginate($request->limit);
        if ($quizzes->first()) {
            return  $this->success(TraditionalQuizResource::collection($quizzes)->hide(['quiz_unit_id', 'quiz_lesson_id', 'quiz_subject_id', 'quiz_description', 'isFinal', 'isAboveLevel', 'quiz_correction_Ladder_file_link', 'traditional_quiz_images']), 200);
        } else {
            return  $this->error(["There's no such quizzes"], "There's no such quizzes", 204);
        }
    }

    public function get_all_traditional_quizzes_by_unit_id(QuizByUnitIdRequest $request)
    {
        $quizzes = TraditionalQuiz::where('unit_id', $request->unit_id)->paginate($request->limit);
        if ($quizzes->first()) {
            return  $this->success(TraditionalQuizResource::collection($quizzes)->hide(['quiz_unit_id', 'quiz_lesson_id', 'quiz_subject_id', 'quiz_description', 'isFinal', 'isAboveLevel', 'quiz_correction_Ladder_file_link', 'traditional_quiz_images']), 200);
        } else {
            return  $this->error(["There's no such quizzes"], "There's no such quizzes", 204);
        }
    }

    public function get_traditional_quiz_by_quiz_id(GetTraditionalQuizByTraditionalQuizIdRequest $request, $id)
    {
        $quiz = TraditionalQuiz::where('id', $id)->paginate($request->limit);
        if ($quiz->first()) {
            return  $this->success(TraditionalQuizResource::collection($quiz), 200);
        } else {
            return  $this->error(["There's no such quiz"], "There's no such quiz", 204);
        }
    }

    public function create_student_traditional_quiz_answers(CreateStudentTraditionalQuizAnswersRequest $request)
    {
        $user = auth('sanctum')->user();
        if ($user && $user->role_id == 1) {
            $student = Student::select('id')->where('user_id', $user->id)->first();
            $quiz = TraditionalQuiz::select('id', 'points')->where('lesson_id', $request->lesson_id)->first();
            $all_images = '';
            if ($request->hasFile('image_answers')) {
                $image_answers = $request->file('image_answers');
                foreach ($image_answers as $image) {
                    $path = $image->store('public/section/traditionalQuizFiles/image-answers');
                    $all_images = $all_images . $path . ',';
                }
            }

            $traditional_quiz_image = StudentTraditionalQuiz::create([
                'student_id' => $student->id,
                'traditional_quiz_id' => $quiz->id,
                'deserved_mark' => $quiz->points,
                'image_answers' => rtrim($all_images, ","),
            ]);

            return  $this->success($traditional_quiz_image, 200);
        } else {
            return  $this->error(['the user is not a student'], 'the user is not a student', 401);
        }
    }
}
