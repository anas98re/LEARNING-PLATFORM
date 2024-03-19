<?php

namespace Modules\Sections\Entities\Lessons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Faqs;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Sections\Entities\TraditionalQuiz;
use Modules\Sections\Entities\Units\StudentUnit;
use Modules\Sections\Entities\Units\Unit;
use Modules\Students\Entities\Student;
use Modules\Sections\Entities\Quiz;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Students\Entities\StudentSavedLesson;
use Spatie\Translatable\HasTranslations;

class Lesson extends Model
{
    use HasFactory;
    use HasTranslations;

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\LessonFactory::new();
    }
    
    public $translatable = ['name', 'description','what_we_will_learn'];

    protected $fillable = ['name', 'unit_id', 'subject_id', 'description', 'cover', 'points', 'duration', 'attachments', 'what_we_will_learn'];


    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function lesson_attachments()
    {
        return $this->hasMany(LessonAttachment::class);
    }

    public function traditional_quizzes()
    {
        return $this->hasMany(TraditionalQuiz::class);
    }
    public function automatedQuiz()
    {
        return $this->hasMany(AutomatedQuiz::class);
    }

    public function subject_student_units()
    {
        return $this->hasMany(StudentUnit::class);
    }
    public function student()
    {
        return $this->belongsToMany(Student::class, 'student_lessons', 'lesson_id', 'student_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function student_saved_lessons()
    {
        return $this->hasMany(StudentSavedLesson::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faqs::class);
    }
}
