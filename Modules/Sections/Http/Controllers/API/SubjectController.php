<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Sections\Transformers\subjectResource;
use Modules\Sections\Entities\Subjects\StudentSubject;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Http\Requests\GetSubjectByStudentIdRequest;
use Modules\Sections\Http\Requests\GetSubjectBySubjectIdRequest;
use Modules\Students\Entities\Student;

class SubjectController extends ApiController
{
    public function get_subject_by_subject_id($id)
    {
        $subject = Subject::find($id);

        if ($subject) {

            return $this->success(SubjectResource::collection([$subject])[0]);
        } else {
            return $this->error(["The subject id must be integer and exists"], "The subject id must be integer and exists", 204);
        }
    }


    public function get_subjects_by_sub_section(GetSubjectBySubjectIdRequest $request)
    {
        $subjects = Subject::where('sub_section_id', $request->sub_section_id)->latest('created_at')->paginate($request->limit);
        if ($request->has('sub_section_id') && is_numeric($request->sub_section_id) && $subjects->first()) {
            return $this->success(subjectResource::collection($subjects));
        } else {
            return $this->error(["The sub section have no subjects yet or it does not exist"], "The sub section does not exist", 204);
        }
    }
    public function get_student_subjects(GetSubjectByStudentIdRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();

        if ($student && $user->role_id == 1) {
            $subjects = StudentSubject::where('student_id', $student->id)->pluck('subject_id');
            $subject = Subject::whereIn('id', $subjects)->latest('created_at')->paginate($request->limit);
            if ($subject) {
                return $this->success(SubjectResource::collection($subject), 200);
            } else {
                return $this->error(["The subject id must be integer and exists"], "The subject id must be integer and exists", 404);
            }
        } else {
            return $this->error(["The account entered is incorrect or it is not a student"], "The account entered is incorrect or it is not a student", 404);
        }
    }
}
