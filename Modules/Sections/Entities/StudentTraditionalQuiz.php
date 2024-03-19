<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentTraditionalQuiz extends Model
{
    use HasFactory;





    protected $fillable = ['student_id', 'image_link', 'traditional_quiz_id', 'image_answers', 'deserved_mark', 'is_question', 'is_corrector'];

    protected $table = 'student_traditional_quizzes';

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\StudentTraditionalQuizFactory::new();
    }

    public  function traditional_quiz()
    {
        return $this->belongsTo(TraditionalQuiz::class);
    }
}
