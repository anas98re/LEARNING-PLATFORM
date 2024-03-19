<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Entities\Units\Unit;
use Spatie\Translatable\HasTranslations;

class TraditionalQuiz extends Model
{
    use HasFactory;

    use HasTranslations;

    protected $fillable = ['id', 'unit_id', 'lesson_id', 'subject_id', 'description', 'isFinal', 'isAboveLevel', 'correction_Ladder_file', 'nameOfQuiz', 'points', 'duration'];

    
    public $translatable = ['description', 'nameOfQuiz'];
    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\TraditionalQuizFactory::new();
    }


    protected $table = 'traditional_quizzes';

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

    public  function student_traditional_quizzes()
    {
        return $this->hasMany(StudentTraditionalQuiz::class);
    }

    public function traditional_quiz_question_files()
    {
        return $this->hasMany(TraditionalQuizQuestionFile::class);
    }
}
