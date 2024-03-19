<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Entities\Subscription;

class StudentSpend extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'student_receiver_id', 'balance_before', 'balance', 'balance_after', 'subscription_id', 'is_aproved'];
    protected $table = 'student_spends';


    protected static function newFactory()
    {
        return \Modules\Students\Database\factories\StudentSpendFactory::new();
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function studentReceiver()
    {
        return $this->belongsTo(Student::class, 'student_receiver_id');
    }
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
