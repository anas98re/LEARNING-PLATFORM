<?php

namespace Modules\Students\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Sections\Entities\AutomatedQuizQuestion;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Lessons\LessonQuestion;
use Modules\Sections\Entities\Lessons\StudentLesson;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Entities\Subjects\SubjectComment;
use Modules\Sections\Entities\Units\StudentUnit;
use Modules\Students\Database\factories\StudentFactory;


class Student extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return StudentFactory::new();
    }
    protected $table = "students";
    protected $fillable = [
        'user_id',
        'class', 'school', 'weaknesses_subjects',
        'strong_subjects', 'father_name', 'mother_name',
        'birthday', 'address', 'city', 'points', 'balance'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function languages()
    {
        return $this->hasMany(StudentLanguage::class );
    }

    public function comments()
    {
        return $this->belongsToMany(SubjectComment::class);
    }

    public function LessonQuestion()
    {
        return $this->belongsToMany(LessonQuestion::class, 'student_lesson_questions');
    }


    public function subject_student_units()
    {
        return $this->hasMany(StudentUnit::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects');
    }
    public function certificates()
    {
        return $this->hasMany(StudentCertificate::class);
    }
    public function automatedQuizQuestion()
    {
        return $this->belongsToMany(AutomatedQuizQuestion::class, 'student_aqq', 'student_id');
    }

    public function automatedQuiz()
    {
        return $this->belongsToMany(AutomatedQuiz::class);
    }
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'student_lessons', 'student_id', 'lesson_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
