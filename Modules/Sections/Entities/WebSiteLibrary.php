<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class WebSiteLibrary extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name'];
    protected $table = 'website_library';
    protected $fillable = ['name', 'is_free','image'];

    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\WebSiteLibraryFactory::new();
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
