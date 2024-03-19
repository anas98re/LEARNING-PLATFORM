<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentLanguage extends Model
{
    use HasFactory;
    protected $table='student_languages' ;
    protected $fillable = ['student_id','language_id','level'];
    protected $hidden = ['updated_at' ,'created_at'] ; 

    // protected static function newFactory()
    // {
    //     return \Modules\Students\Database\factories\StudentLanguageFactory::new();
    // }
}
