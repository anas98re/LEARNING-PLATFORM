<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class UserOpinion extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'user_opinions';
    public $translatable = ['opinion'];
}
