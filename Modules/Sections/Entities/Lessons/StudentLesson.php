<?php

namespace Modules\Sections\Entities\Lessons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\Units\Unit;

class StudentLesson extends Model
{
    use HasFactory;

    protected $fillable = ['unit_id', 'student_id', 'lesson_id', 'can_access'];
    protected $table = 'student_lessons';
    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\StudentLessonFactory::new();
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
