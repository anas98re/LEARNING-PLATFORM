<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAutomatedQuiz extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'automated_quiz_id'];
    protected $table = "student_automated_quizzes";
    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\StudentAutomatedQuizFactory::new();
    }
}
