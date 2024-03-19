<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TraditionalQuizQuestionFile extends Model
{
    use HasFactory;

    protected $fillable = ['traditional_quiz_id','file_link'];
    protected $table = 'traditional_quiz_questions_files';


    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\TraditionalQuizQuestionFileFactory::new();
    }

    public function traditional_quiz()
    {
        return $this->belongsTo(TraditionalQuiz::class);
    }
}
