<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Entities\Units\Unit;
use Spatie\Translatable\HasTranslations;

class Faqs extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['question', 'answer'];
    protected $fillable = ['question', 'answer', 'subject_id', 'unit_id', 'lesson_id'];
    protected $table = 'faqs';
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\FaqsFactory::new();
    }
    public function subject()
    {
        return  $this->belongsTo(Subject::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
