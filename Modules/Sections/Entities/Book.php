<?php

namespace Modules\Sections\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['title'];
    protected $table = 'books';
    protected $fillable = ['title', 'pdf_path', 'website_library_id', 'author_name'];


    protected static function newFactory()
    {
        return \Modules\Sections\Database\factories\BookFactory::new();
    }

    public function websiteLibrary()
    {
        return $this->belongsTo(WebsiteLibrary::class);
    }
}
