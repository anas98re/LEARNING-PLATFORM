<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class AqqOption extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['answear'];
    protected $fillable = ['aqq_id', 'answear', 'is_true'];
    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\AqqOptionFactory::new();
    }
    protected $table = 'aqq_options';
    public function automatedQuizQuestion()
    {
        return $this->belongsTo(AutomatedQuizQuestion::class);
    }
}
