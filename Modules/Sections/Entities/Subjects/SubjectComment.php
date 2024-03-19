<?php

namespace Modules\Sections\Entities\Subjects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Students\Entities\Student;

class SubjectComment extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'subject_id', 'student_id'];
    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\SubjectCommentFactory::new();
    }


    protected $table = 'subject_comments';

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
