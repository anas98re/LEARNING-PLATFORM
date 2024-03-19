<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransferCenter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'number', 'address'];
    protected $table = 'transfer_centers';
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\TransferCenterFactory::new();
    }
    public function codes()
    {
        return $this->hasMany(TransferCenterCode::class);
    }
}
