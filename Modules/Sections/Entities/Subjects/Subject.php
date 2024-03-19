<?php

namespace Modules\Sections\Entities\Subjects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Subscription;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Sections\Entities\TraditionalQuiz;
use Modules\Sections\Entities\TraditionalQuizQuestionFile;
use Modules\Sections\Entities\Quiz;
use Modules\Sections\Entities\SubSection;
use Modules\Sections\Entities\Units\StudentUnit;
use Modules\Sections\Entities\Units\Unit;
use Modules\Students\Entities\Student;
use Modules\Students\Entities\StudentSavedSubject;
use Modules\Teachers\Entities\Teacher;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasTranslations;


    public $translatable = ['name', 'description', 'requirements'];
    protected $fillable = ['name', 'cover', 'points', 'introductory_video', 'description', 'requirements', 'sub_section_id', 'price'];
    protected $table = 'subjects';

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\SubjectFactory::new();
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Unit::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teachers');
    }

    public function traditional_quizzes()
    {
        return $this->hasMany(TraditionalQuiz::class);
    }



    public function traditional_quiz_questions()
    {
        return $this->hasMany(TraditionalQuizQuestionFile::class);
    }

    public function automatedQuiz()
    {
        return $this->hasMany(AutomatedQuiz::class);
    }

    public function subject_student_units()
    {
        return $this->hasMany(StudentUnit::class);
    }

    public function student_saved_subjects()
    {
        return $this->hasMany(StudentSavedSubject::class);
    }


    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subjects');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
    public function subSection()
    {
        return $this->belongsTo(SubSection::class);
    }
    public function faqs()
    {
        return $this->hasMany(Faqs::class);
    }
}
