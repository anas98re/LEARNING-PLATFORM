<?php

namespace Modules\Teachers\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\Subjects\Subject;
use Spatie\Translatable\HasTranslations;


class Teacher extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['description'];
    protected $table = 'teachers';
    protected $fillable = ['subjects_counts', 'user_id','description'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'subject_teachers');
    }
}
