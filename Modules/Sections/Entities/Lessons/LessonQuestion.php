<?php

namespace Modules\Sections\Entities\Lessons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\Student;
use Spatie\Translatable\HasTranslations;

class LessonQuestion extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['question', 'options'];
    protected $table = 'lesson_questions';

    protected $fillable = ['question', 'options', 'point', 'lesson_id', 'time_question'];
    protected $casts = [
        'options' => 'array',
    ];

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\LessonQuestionFactory::new();
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function student()
    {
        return $this->belongsToMany(Student::class, 'student_lesson_questions');
    }
}
