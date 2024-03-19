<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id','subscription_id'];


    protected $table = 'subject_subscriptions';

    
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\SubjectSubscriptionFactory::new();
    }
}
