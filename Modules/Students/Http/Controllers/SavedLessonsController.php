<?php

namespace Modules\Students\Http\Controllers;

use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Students\Entities\Student;
use Modules\Students\Entities\StudentSavedLesson;
use Modules\Students\Entities\StudentSavedSubject;
use App\Http\Controllers\ApiController;
use Modules\Students\Http\Requests\AddLessonToStudentSavedLessonRequest;
use Modules\Students\Http\Requests\GetAllStudentSavedLessonsByStudentSavedSubjectIdRequest;
use Modules\Students\Http\Requests\GetAllStudentSavedSubjectsRequest;
use Modules\Students\Http\Requests\RemoveLessonFromStudentSavedLessonsRequest;
use Modules\Students\Transformers\SavedStudentLessonResource;
use Modules\Students\Transformers\SavedStudentSubjectResource;

class SavedLessonsController extends ApiController
{
    public function add_lesson_to_student_saved_lessons(AddLessonToStudentSavedLessonRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();
        $subject_id = Lesson::select('subject_id')->where('id', $request->lesson_id)->pluck('subject_id')->first();
        $data = $request->all();

        if ($student_saved_subject = StudentSavedSubject::where('subject_id', $subject_id)->where('student_id', $student->id)->first()) {

            $data['student_saved_subject_id'] = $student_saved_subject->id;
            StudentSavedLesson::create($data);
            return $this->success(["student saved lesson was saved successfully"], 200);
        } else {

            $student_saved_subject =  StudentSavedSubject::create([
                'student_id' => $student->id,
                'subject_id' => $subject_id
            ]);

            $data['student_saved_subject_id'] = $student_saved_subject->id;
            StudentSavedLesson::create($data);
            return $this->success(["student saved lesson and subject was saved successfully"], 200);
        }
    }

    public function get_all_saved_student_subjects(GetAllStudentSavedSubjectsRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();
        $student_saved_subjects =  StudentSavedSubject::select('id', 'student_id', 'subject_id')
            ->where('student_id', $student->id)
            ->paginate($request->limit);

        if ($student_saved_subjects) {
            return $this->success(SavedStudentSubjectResource::collection($student_saved_subjects), 200);
        } else {
            return $this->error(["There\s no records"], "There\s no records", 200);
        }
    }

    public function remove_lesson_from_student_saved_lessons(RemoveLessonFromStudentSavedLessonsRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();

        $student_saved_lesson = StudentSavedLesson::where('lesson_id', $request->lesson_id)
            ->whereHas('student_saved_subject', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })->first();

        if ($student_saved_lesson) {

            $student_saved_subject_id = $student_saved_lesson->student_saved_subject_id;
            $student_saved_lesson->delete();

            $saved_lessons = StudentSavedLesson::where('student_saved_subject_id', $student_saved_subject_id)->get();
            if ($saved_lessons->count() == 0) {
                $saved_subject = StudentSavedSubject::where('id', $student_saved_subject_id)
                    ->where('student_id', $student->id)
                    ->delete();
            }

            return $this->success(["saved lesson was removed successfully"], 200);
        } else {
            return $this->error(["There\s no such record"], "There\s no such record", 200);
        }
    }

    public function get_all_student_saved_lessons_of_student_saved_subject_by_student_saved_subject_id(GetAllStudentSavedLessonsByStudentSavedSubjectIdRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();

        $student_saved_lessons = StudentSavedLesson::where('student_saved_subject_id', $request->student_saved_subject_id)
            ->whereHas('student_saved_subject', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })->get();


        if ($student_saved_lessons->first()) {
            return $this->success(SavedStudentLessonResource::collection($student_saved_lessons), 200);
        } else {
            return $this->error(["There's no records"], "There's no records", 200);
        }
    }
}
