<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Modules\Sections\Entities\Subjects\SubjectComment;
use Modules\Sections\Http\Requests\CommentRequest;
use Modules\Sections\Http\Requests\SubjectCommentRequest;
use Modules\Sections\Transformers\SubjectCommentResource;
use Modules\Students\Entities\Student;

class SubjectCommentController extends ApiController
{
    public function get_all_comments_by_subject_id(CommentRequest $request, $subject_id)
    {
        $subject_comments = SubjectComment::where('subject_id', $subject_id)->with('student.user')->paginate($request->limit);
        if ($subject_comments->first()) {
            return  $this->success(SubjectCommentResource::collection($subject_comments), 200);
        } else {
            return $this->error(["There\'s no such comments"], "Thers\'s no such comments", 204);
        }
    }
    public function post_subject_comment(SubjectCommentRequest $request)
    {
        $user = auth('sanctum')->user();
        if ($user->role_id == 1) {
            $student = Student::select('id')->where('user_id', $user->id)->first();
            $records = new SubjectComment();
            $records->student_id = $student->id;
            $records->subject_id = $request->subject_id;
            $records->comment = $request->comment;
            $records->save();
            return $this->success($records, 200);
        } else {
            return $this->error(["the user is not a student"], "the user is not a student", 401);
        }
    }
}
