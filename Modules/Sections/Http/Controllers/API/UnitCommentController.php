<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Sections\Entities\Units\UnitComment;
use Modules\Sections\Http\Requests\CommentRequest;
use Modules\Sections\Http\Requests\UnitCommentRequest;
use Modules\Sections\Transformers\UnitCommentResource;
use Modules\Students\Entities\Student;

class UnitCommentController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function post_unit_comment(UnitCommentRequest $request)
    {
        $user = auth('sanctum')->user();
        if ($user && $user->role_id == 1) {
            $student = Student::select('id')->where('user_id', $user->id)->first();
            $records = new UnitComment();
            $records->student_id = $student->id;
            $records->unit_id = $request->unit_id;
            $records->comment = $request->comment;
            $records->save();
            return $this->success($records, 200);
        } else {
            return $this->error(["the user is not a student"], "the user is not a student", 401);
        }
    }
    public function get_all_comments_of_unit_by_unit_id(CommentRequest $request, $unit_id)
    {

        $comments = UnitComment::where('unit_id', $unit_id)->with('student.user', 'unit')->paginate($request->limit);
        if ($comments->first()) {
            return  $this->success(UnitCommentResource::collection($comments), 200);
        } else {
            return  $this->error(["There's no such comments"], "There's no such comments", 204);
        }
    }
}
