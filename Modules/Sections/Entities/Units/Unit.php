<?php

namespace Modules\Sections\Entities\Units;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Entities\TraditionalQuiz;
use Spatie\Translatable\HasTranslations;

class Unit extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'description', 'requirements'];

    protected $fillable = ['name', 'description', 'requirements', 'subject_id', 'points', 'cover', 'start_date', 'end_date'];

    protected $table = 'units';

    protected $casts = [
        'faqs' => 'array'
    ];


    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\UnitFactory::new();
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function traditional_quizzes()
    {
        return $this->hasMany(TraditionalQuiz::class);
    }
    public function automatedQuiz()
    {
        return $this->hasMany(AutomatedQuiz::class);
    }

    public function subject_student_units()
    {
        return $this->hasMany(StudentUnit::class);
    }
    public function faqs()
    {
        return $this->hasMany(Faqs::class);
    }
}
