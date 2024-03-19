<?php

namespace Modules\Sections\Entities\Subjects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;

    protected $table = 'student_subjects';

    protected $fillable = ['subject_id', 'student_id'];

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\StudentSubjectFactory::new();
    }
}
