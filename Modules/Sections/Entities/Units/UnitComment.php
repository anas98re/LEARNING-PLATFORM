<?php

namespace Modules\Sections\Entities\Units;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Students\Entities\Student;


class UnitComment extends Model
{
    use HasFactory;
    protected $table = 'unit_comments';
    protected $fillable = ['comment', 'unit_id', 'student_id'];
    public $casts = [
        'comment' => 'array'
    ];
    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\UnitCommentFactory::new();
    }

    public function  unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function  student()
    {
        return $this->belongsTo(Student::class);
    }
}
