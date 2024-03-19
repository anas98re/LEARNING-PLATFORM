<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sections\Entities\Lessons\Lesson;

class StudentSavedLesson extends Model
{
    use HasFactory;

    protected $fillable = ['student_saved_subject_id', 'lesson_id'];
    protected $table = 'student_saved_lessons';


    // protected static function newFactory()
    // {
    //     return \Modules\Students\Database\factories\StudentSavedLessonFactory::new();
    // }

    public function student_saved_subject()
    {
        return $this->belongsTo(StudentSavedSubject::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

}
