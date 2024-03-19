<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Lessons\StudentLesson;
use Modules\Sections\Entities\UnitStudentLesson;
use Modules\Sections\Http\Requests\GetOpenLessonsByUnitSubjectIdRequest;
use Modules\Sections\Http\Requests\LessonByUnitRequest;
use Modules\Sections\Transformers\LessonResource;
use Modules\Students\Entities\Student;

class LessonController extends ApiController
{

    public function get_lesson_by_lesson_id($id)
    {
        $lesson = Lesson::where('id', $id)->latest('created_at')->paginate(8);
        if ($lesson) {
            return $this->success(LessonResource::collection($lesson));
        } else {
            return $this->error(["The lesson does not exist"], "The lesson does not exist", 204);
        }
    }

    public function get_open_lessons_by_unit_id_and_subject_id(GetOpenLessonsByUnitSubjectIdRequest $request)
    {
        if ($request->has('subject_id') && is_numeric($request->subject_id) && Lesson::where('subject_id', $request->subject_id)->where('isFree', 1)->exists()) {
            $lessons = Lesson::where('subject_id', $request->subject_id)->where('isFree', 1)->paginate($request->limit);

            return  $this->success(LessonResource::collection($lessons)->hide(['lesson_points', 'unit_name', 'material_name', 'lesson_attachments']), 200);
        } else if ($request->has('unit_id') && is_numeric($request->unit_id) && Lesson::where('unit_id', $request->unit_id)->where('isFree', 1)->exists()) {
            $lessons = Lesson::where('unit_id', $request->unit_id)->where('isFree', 1)->paginate($request->limit);
            return  $this->success(LessonResource::collection($lessons)->hide(['lesson_points', 'unit_name', 'material_name', 'lesson_attachments']), 200);
        } else {
            return $this->error(["The unit id or subject id does not exist"], "The unit id or subject id does not exist", 204);
        }
    }


    public function get_all_lessons_by_unit_id(LessonByUnitRequest $request)
    {
        $user = auth('sanctum')->user();

        if (!$user || $user->role_id != 1) {
            $lessons = Lesson::where('unit_id', $request->unit_id)->latest('created_at')->paginate($request->limit);
            return  $this->success(LessonResource::collection($lessons)->hide(['lesson_attachments']), 200);
        }
        $student = Student::where('user_id', $user->id)->first();
        if ($request->has('unit_id') && is_numeric($request->unit_id) && StudentLesson::where('unit_id', $request->unit_id)->where('student_id', $student->id)->exists()) {
            $lessonsStudents = StudentLesson::where('student_id', $student->id)->pluck('lesson_id');

            $lessons = Lesson::whereIn('id', $lessonsStudents)->with(['student' => function ($query) use ($student) {
                $query->where('student_id', $student->id)
                    ->select('student_id', 'lesson_id', 'unit_id', 'can_access')->first();
            }])->paginate($request->limit);

            return  $this->success(LessonResource::collection($lessons), 200);
        } else {
            return $this->error(["The unit id does not exists for this student"], "The unit id does not exists for this student", 204);
        }
    }
}
