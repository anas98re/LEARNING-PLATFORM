<?php

namespace Modules\Sections\Entities\Units;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Students\Entities\Student;


class StudentUnit extends Model
{
    use HasFactory;

    protected $table = 'student_units';
    protected $fillable = ['unit_id', 'subject_id', 'student_id', 'can_access'];
    protected $hidden = ['updated_at', 'student_id', 'created_at', 'subject_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'subject_id');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'unit_id');
    }

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\StudentUnitFactory::new();
    }
}
