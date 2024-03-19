<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Entities\Units\Unit;
use Modules\Students\Entities\Student;
use Spatie\Translatable\HasTranslations;

class AutomatedQuiz extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['description', 'nameOfQuiz'];
    protected $fillable = ['unit_id', 'lesson_id', 'subject_id', 'description', 'isFinal', 'isAboveLevel', 'nameOfQuiz', 'points', 'duration'];

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\AutomatedQuizFactory::new();
    }
    protected $table = 'automated_quizzes';

    public function lesson()
    {
        return $this->hasOne(Lesson::class);
    }
    public function unit()
    {
        return $this->hasOne(Unit::class);
    }
    public function subject()
    {
        return $this->hasOne(Subject::class);
    }
    public function automatedQuizQuestion()
    {
        return $this->hasMany(AutomatedQuizQuestion::class);
    }
    public function student()
    {
        return $this->belongsToMany(Student::class, 'student_automated_quizzes', 'automated_quiz_id');
    }
}
