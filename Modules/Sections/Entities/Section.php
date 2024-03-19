<?php

namespace Modules\Sections\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sections\Database\factories\SectionFactory;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;
    protected $translatable = ['name'];
    protected $table = 'sections';
    protected $fillable = ['name', 'image'];

    protected static function newFactory()
    {
        return SectionFactory::new();
    }

    public function sub_section()
    {
        return $this->hasMany(SubSection::class);
    }

    // public function getNameAttribute($value)
    // {
    //     return json_decode($value)->{\App::getLocale()};
    // }
}
