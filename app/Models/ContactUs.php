<?php

namespace App\Models;

use Database\Factories\ContactUsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactUs extends Model
{
    use HasFactory, HasTranslations;
    protected static function newFactory()
    {
        return ContactUsFactory::new();
    }
    public $translatable = ['name', 'message'];
    protected $table = 'contact_us';
    protected $fillable = ['name', 'email', 'message'];
}
