<?php

namespace Modules\Sections\Entities\Lessons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LessonAttachment extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['title'];

    protected $table = 'lesson_attachments';

    protected $fillable = ['title', 'file', 'type'];

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\LessonAttachmentFactory::new();
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
