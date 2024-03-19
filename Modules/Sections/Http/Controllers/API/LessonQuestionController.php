<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Modules\Sections\Entities\Lessons\LessonQuestion;
use Modules\Sections\Http\Requests\LessonQuestionRequest;
use Modules\Sections\Transformers\LessonQuestionResource;

class LessonQuestionController extends ApiController
{
    public function get_question_by_lesson(LessonQuestionRequest $request, $lesson_id)
    {
        $questions = LessonQuestion::where('lesson_id', $lesson_id)->paginate($request->limit);
        if ($questions->first()) {
            return  $this->success(LessonQuestionResource::collection($questions), 200);
        } else {
            return  $this->error(['There\'s no such questions'], 'There\'s no such questions', 204);
        }
    }
}
