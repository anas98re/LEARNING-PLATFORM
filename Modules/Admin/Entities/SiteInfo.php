<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class SiteInfo extends Model
{
    use HasFactory,HasTranslations;
    
    protected $fillable = ['info', 'info_value'];
    public $translatable = ['info_value'];
    
}
