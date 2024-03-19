<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'balance', 'payment_image', 'is_aproved', 'balance_before', 'balance_after', 'role_id'];

    protected $table = 'student_payments';


    protected static function newFactory()
    {
        return \Modules\Students\Database\factories\PaymentFactory::new();
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
