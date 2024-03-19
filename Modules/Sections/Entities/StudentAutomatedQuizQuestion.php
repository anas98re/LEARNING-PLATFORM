<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAutomatedQuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['aqq_id', 'student_id', 'point', 'aqq_option_id'];

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\StudentAutomatedQuizQuestionFactory::new();
    }
    protected $table = 'student_aqq';

    public  function aqqOption()
    {
        return $this->belongsTo(AqqOption::class, 'aqq_option_id');
    }
}
