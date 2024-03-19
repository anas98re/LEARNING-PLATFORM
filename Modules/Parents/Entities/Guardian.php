<?php

namespace Modules\Parents\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Students\Entities\Student;

class Guardian extends Model
{
    use HasFactory;
    protected $table = 'guardians';
    protected $fillable = ['user_id'];
    protected static function newFactory()
    {
        return \Modules\Parents\Database\factories\GuardianFactory::new();
    }
        public function User()          
        {
            return $this->belongsTo(User::class);
        }
    public function Student()
    {
        return $this->hasMany(Student::class);
    }
}
