<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Modules\Sections\Entities\Lessons\LessonComment;
use Modules\Sections\Http\Requests\CommentRequest;
use Modules\Sections\Http\Requests\LessonCommentRequest;
use Modules\Sections\Transformers\LessonCommentResource;
use Modules\Students\Entities\Student;

class LessonCommentController extends ApiController
{
    public function post_lesson_comment(LessonCommentRequest $request)
    {
        $user = auth('sanctum')->user();
        if ($user && $user->role_id == 1) {
            $student = Student::select('id')->where('user_id', $user->id)->first();
            $records = new LessonComment();
            $records->student_id = $student->id;
            $records->lesson_id = $request->lesson_id;
            $records->comment = $request->comment;
            $records->save();
            return $this->success($records, 200);
        }else{
            return $this->error(["the user is not a student"],"the user is not a student", 401);
        }
    }

    public function get_all_comments_of_lesson_by_lesson_id(CommentRequest $request, $lesson_id)
    {
        $comments = LessonComment::where('lesson_id', $lesson_id)->with('student.user', 'lesson')->paginate($request->limit);
        if ($comments->first()) {
            return  $this->success(LessonCommentResource::collection($comments), 200);
        } else {
            return $this->error(["There'\s no such comments"], "There'\s no such comments", 204);
        }
    }
}
