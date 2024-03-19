<?php

namespace Modules\Sections\Entities\Lessons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Students\Entities\Student;

class LessonComment extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'lesson_id', 'student_id'];

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\LessonCommentFactory::new();
    }

    public function  lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function  student()
    {
        return $this->belongsTo(Student::class);
    }
}
