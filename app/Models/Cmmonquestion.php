<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmmonquestion extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'answer','unit_id','lesson_id'];

    public function units()
    {
        return $this->belongsTo('App\Models\Unit','unit_id','id');
    }
    public function lessons()
    {
        return $this->belongsTo('App\Models\Lesson','lesson_id','id');
    }
}
