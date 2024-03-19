<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Students\Entities\Student;
use Modules\Students\Entities\StudentAutomatedQuiz;
use Spatie\Translatable\HasTranslations;

class AutomatedQuizQuestion extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['question'];
    protected $fillable = ['question', 'point', 'automated_quiz_id'];

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\AutomatedQuizQuestionFactory::new();
    }
    public function automatedQuiz()
    {
        return $this->belongsTo(AutomatedQuiz::class);
    }
    public function student()
    {
        return $this->belongsToMany(Student::class, 'student_aqq', 'aqq_id');
    }
    public function aqqOption()
    {
        return $this->hasMany(AqqOption::class, 'aqq_id');
    }
}
