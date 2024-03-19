<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sections\Entities\Subjects\Subject;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'price','description'];

    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\SubscriptionFactory::new();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
