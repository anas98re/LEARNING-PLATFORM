<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentCertificate extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $hidden = ['updated_at' ,'created_at'] ; 
    protected $table = 'student_certificates';
    protected static function newFactory()
    {
        return \Modules\Students\Database\factories\StudentCertificateFactory::new();
    }
}
