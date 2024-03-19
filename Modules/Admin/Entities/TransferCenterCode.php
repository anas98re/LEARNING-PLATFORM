<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Students\Entities\Student;

class TransferCenterCode extends Model
{
    use HasFactory;

    protected $fillable = ['transfer_center_id', 'code', 'is_transfer', 'transfer_date', 'balance', 'student_id'];

    protected $table = 'transfer_center_codes';

    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\TransferCenterCodeFactory::new();
    }
    public function transferCenter()
    {
        return $this->belongsTo(TransferCenter::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
