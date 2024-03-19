<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sections\Entities\Subjects\Subject;
use Spatie\Translatable\HasTranslations;

class StudentSavedSubject extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = [];

    protected $fillable = ['student_id', 'subject_id'];
    protected $table = 'student_saved_subjects';


    // protected static function newFactory()
    // {
    //     return \Modules\Students\Database\factories\StudentSavedSubjectFactory::new();
    // }

    public function student_saved_lessons()
    {
        return $this->hasMany(StudentSavedLesson::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
