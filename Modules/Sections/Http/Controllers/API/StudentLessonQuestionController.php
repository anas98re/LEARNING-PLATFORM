<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Modules\Sections\Entities\Lessons\LessonQuestion;
use Modules\Sections\Http\Requests\StudentLessonQuestionRequest;

class StudentLessonQuestionController extends ApiController
{
    public function post_the_the_answer_for_question_lesson(StudentLessonQuestionRequest $request)
    {
        $option_id = 0;
        $options = LessonQuestion::find($request->lesson_questions_id)->options;
        $point = LessonQuestion::find($request->lesson_questions_id)->point;
        foreach ($options as $option) {
            if ($option['is_true'] == true) {
                $option_id = $option['id'];
                break;
            }
        }

        $records = new LessonQuestion();
        $records->student_id = $request->student_id;
        $records->lesson_questions_id = $request->lesson_questions_id;
        if ($request->option_id == $option_id) {
            $records->point = $point;
        } else {
            $records->point = 0;
        }
        $records->student_has_show = true;
        $records->save();
        return $this->success($records, 200);
    }
}
