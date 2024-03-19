<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sections\Database\factories\SubSectionFactory;
use Spatie\Translatable\HasTranslations;

class SubSection extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name'];
    protected $table = 'sub_sections';
    protected $fillable = ['name', 'image', 'section_id'];

    public $casts = [
        'name' => 'array'
    ];


    protected static function newFactory()
    {
        return SubSectionFactory::new();
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // public function getNameAttribute($value)
    // {
    //     return json_decode($value)->{\App::getLocale()};
    // }
}
